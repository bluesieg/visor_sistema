@extends('layouts.app')
@section('content')
<style>
#vw_em_rec_txt_detalle_total{
    background: #80B23E;
    color: white;
    border: 0px !important;
    font-size: 12px;
}
</style>
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Emision de Recibos de Pago...</b></h1>
                <div class="row">
                    <div class="col-xs-12">                        
                        <div class="text-right">
                            <div class="col-xs-2 col-sm-12 col-md-12 col-lg-3">
                                <label>Fecha:</label>
                                <label class="input">
                                    <input id="vw_emision_reg_pag_fil_fecha" type="text" data-mask="99/99/9999" data-mask-placeholder=".." value="<?php echo date('d-m-Y') ?>">
                                </label>
                            </div>
                            <button onclick="buscar_val_arancel();" style="display: none;" id="btn_vw_valores_arancelarios_Buscar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="fa fa-search"></i></span>Buscar
                            </button>
                            <button onclick="open_dialog_new_edit_Val_Arancel('NUEVO');" id="btn_vw_valores_arancelarios_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Rec. Impuesto Predial
                            </button>
                            <button id="btn_vw_valores_arancelarios_Editar" onclick="open_dialog_new_edit_Val_Arancel('EDITAR');" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-folder-close"></i></span>Fraccionamiento
                            </button>
                            <button onclick="dialog_emi_rec_pag_varios();" type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-tasks"></i></span>Varios
                            </button>
                            <button id="btn_vw_valores_arancelarios_Eliminar" onclick="eliminar_val_arancel();" type="button" class="btn btn-labeled btn-danger">
                                <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Anular
                            </button>
                        </div>
                    </div>
                </div> 
            </div>                   
        </div>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="table_Resumen_Recibos"></table>
            <div id="pager_table_Resumen_Recibos"></div>
        </article>
    </div>
</section>
@section('page-js-script')

<script type="text/javascript">
    sumTotal = 0;
    $(document).ready(function () {
        $("#menu_tesoreria").show();
        $("#li_tesoreria_emi_rec_pag").addClass('cr-active');
//        fecha = $("#vw_emision_reg_pag_fil_fecha").val();
        jQuery("#table_Resumen_Recibos").jqGrid({
            url: 'grid_Resumen_recibos?fecha='+$("#vw_emision_reg_pag_fil_fecha").val(),
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            colNames: ['id_rec_mtr', 'id_contrib', 'N°. Recibo', 'Fecha', 'Descripcion del Pago', 'Estado', 'Caja', 'Hora Pago', 'Total'],
            rowNum: 20, sortname: 'id_rec_mtr', sortorder: 'desc', viewrecords: true, caption: 'Resumen Recibos', align: "center",
            colModel: [
                {name: 'id_rec_mtr', index: 'id_rec_mtr', hidden: true},
                {name: 'id_contrib', index: 'id_contrib', hidden: true},
                {name: 'nro_recibo_mtr', index: 'nro_recibo_mtr', align: 'center', width: 60},
                {name: 'fecha', index: 'fecha', align: 'center', width: 80},
                {name: 'glosa', index: 'glosa', width: 250},
                {name: 'estad_recibo', index: 'estad_recibo', width: 60},
                {name: 'descrip_caja', index: 'descrip_caja', width: 50},
                {name: 'hora_pago', index: 'hora_pago', align: 'center', width: 50},
                {name: 'total', index: 'total', align: 'center', width: 80, sorttype: 'number', formatter: 'number', formatoptions: {decimalPlaces: 3}}
            ],
            pager: '#pager_table_Resumen_Recibos',
            rowList: [15, 25],
            gridComplete: function () {
                var rows = $("#table_Resumen_Recibos").getDataIDs();
                if (rows.length > 0) {
                    var firstid = jQuery('#table_Resumen_Recibos').jqGrid('getDataIDs')[0];
                    $("#table_Resumen_Recibos").setSelection(firstid);
                }                
                var sum = jQuery("#table_Resumen_Recibos").getGridParam('userData').sum_total;
//                alert(sum);
            },            
            ondblClickRow: function (Id) {}
        });

        $(window).on('resize.jqGrid', function () {
            $("#table_Resumen_Recibos").jqGrid('setGridWidth', $("#content").width());
        });
        $("#vw_emision_reg_pag_fil_fecha").keypress(function (e) {
            if (e.which == 13) {
                fn_actualizar_grilla('table_Resumen_Recibos', 'grid_Resumen_recibos?fecha=' + $("#vw_emision_reg_pag_fil_fecha").val());
            }
        });
        $("#vw_emi_rec_txt_tributo").keypress(function (e) {
            if (e.which == 13 && !e.shiftKey) {
                event.preventDefault();
                autocomplete_tributo('vw_emi_rec_txt_tributo', 'vw_emi_rec_txt_valor');
            }
        });
        $("#vw_emi_rec_txt_cantidad").keypress(function (e) {
            if (e.which == 13 && !e.shiftKey) {
                if($("#hiddenvw_emi_rec_txt_tributo").val()==''){
                    mostraralertasconfoco('Ingrese un Tributo','#hiddenvw_emi_rec_txt_tributo');
                    return false;
                }else detalle_recibo();
            }
        });
        
    });   
</script>
@stop
<div id="vw_emision_rec_pag_varios" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Datos de Recibo ::.</div>
                    <div class="panel-body">                        
                        <fieldset>
                            <section>
                                <label class="label">Tributo:</label>
                                <label class="textarea">
                                    <textarea id="vw_emi_rec_txt_tributo" type="text" rows="2" placeholder="Tributo" class="input-sm text-uppercase"></textarea>
                                </label>                      
                            </section>
                            <section>
                                <label class="label">Glosa:</label>
                                <label class="textarea">
                                    <textarea id="vw_emi_rec_txt_glosa" rows="2" placeholder="descripcion de recibo" class="input-sm text-uppercase"></textarea>                                    
                                </label>                      
                            </section>
                            <div class="row">
                                <section class="col col-3" style="padding-right: 5px">                                    
                                    <label class="label">Cod. Tributo:</label>
                                    <label class="input">
                                        <input id="hiddenvw_emi_rec_txt_tributo" type="text" placeholder="000000" class="input-sm" disabled="">
                                    </label>                        
                                </section>
                                <section class="col col-3" style="padding-left: 5px;padding-right: 5px">
                                    <input type="hidden">
                                    <label class="label">Cantidad:</label>
                                    <label class="input">
                                        <input id="vw_emi_rec_txt_cantidad" onkeypress="return soloDNI(event);" type="text" placeholder="00" class="input-sm">
                                    </label>                        
                                </section>
                                <section class="col col-3" style="padding-left: 5px;padding-right: 5px">
                                    <label class="label">Valor S/.:</label>
                                    <label class="input">
                                        <input id="vw_emi_rec_txt_valor" type="text" placeholder="000.00" class="input-sm" disabled="">
                                    </label>                      
                                </section>
                                <section class="col col-3 text-center" style="padding-left: 5px">
                                    <label class="label">&nbsp;</label>
                                    <a onclick="detalle_recibo();" class="btn btn-primary btn-sm">Agregar / Insertar</a>                    
                                </section>                                
                            </div> 
                            <section>
                                <div class="panel panel-success" style="border: 0px !important; margin-top: 8px;">
                                    <div class="panel-heading bg-color-primary">.:: Detalle de Recibo ::.</div>
                                    <div class="panel-body">

                                        <div style="border: 1px solid #DDD; margin-bottom: 6px;">
                                            <table id="t_dina_det_recibo" class="table table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th width="1%" align="center">N</th>
                                                        <th width="79%">Tributo</th>
                                                        <th width="15%" align="right">Costo</th>
                                                        <th width="5%" align="center">Elim.</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                            
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th width="1%" align="center"></th>
                                                        <th width="79%" style="text-align: right">Total S/.</th>
                                                        <th width="15%" style="border-top: 2px solid #017E42;">
                                                            <label class='input'><input id="vw_em_rec_txt_detalle_total" type="text" value="000.000" class="input-xs text-align-right" disabled=""></label>
                                                        </th>
                                                        <th width="5%" align="center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </fieldset>
                    </div>
                </div>

            </div>                   
        </div>        
    </div>
</div>

<script src="{{ asset('archivos_js/tesoreria/emision_rec_pago.js') }}"></script>
@endsection

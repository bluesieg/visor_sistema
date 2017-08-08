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
                <h1 class="txt-color-green"><b>Fraccionamiento...</b></h1>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-2 col-sm-12 col-md-12 col-lg-3">
                            <label class="select">Filtro Año:</label>
                            <select id="vw_val_arancel_cb_anio" class="input-sm">
                                @foreach ($anio as $anio1)
                                <option value='{{$anio1->anio}}' >{{$anio1->anio}}</option>
                                @endforeach
                            </select><i></i>                                
                        </div>  
                        <div class="text-right">
                            <button onclick="dialog_conve_fracc();" id="btn_vw_conve_fracc_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                            </button>
                            <button id="btn_vw_conve_fracc_Editar" onclick="" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-folder-close"></i></span>Editar
                            </button>                            
                            <button id="btn_vw_conve_fracc_Anular" onclick="" type="button" class="btn btn-labeled btn-danger">
                                <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Anular
                            </button>
                        </div>
                    </div>
                </div> 
            </div>                   
        </div>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="table_Resumen_Recibos"></table>
            <div id="pager_table_Resumen_Recibos">
                <div style="float: right; font-weight: bold;">
                    Total S/. <input type="text" id="vw_emision_rec_pago_total_global" class="input-sm text-right" style="width: 143px; height: 21px;padding-right: 4px;" readonly="">
                </div>                    
            </div>
        </article>
    </div>
</section>
@section('page-js-script')

<script type="text/javascript">    
    $(document).ready(function () {        
        $("#menu_admtri").show();
        $("#li_fraccionamiento").addClass('cr-active');
        jQuery("#table_Resumen_Recibos").jqGrid({
            url: 'grid_Resumen_recibos?fecha='+$("#vw_emision_reg_pag_fil_fecha").val(),
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            colNames: ['id_rec_mtr', 'id_contrib', 'N°. Recibo', 'Fecha', 'Descripcion del Pago', 'Estado', 'Caja', 'Hora Pago', 'Total'],
            rowNum: 20, sortname: 'id_rec_mtr', sortorder: 'desc', viewrecords: true, caption: 'Resumen Recibos', align: "center",
            colModel: [
                {name: 'id_rec_mtr', index: 'id_rec_mtr', hidden: true},
                {name: 'id_contrib', index: 'id_contrib', hidden: true},
                {name: 'nro_recibo_mtr', index: 'nro_recibo_mtr', hidden:true},
                {name: 'fecha', index: 'fecha', align: 'center', width: 60},
                {name: 'glosa', index: 'glosa', width: 250},
                {name: 'estad_recibo', index: 'estad_recibo', width: 60},
                {name: 'descrip_caja', index: 'descrip_caja', width: 130},
                {name: 'hora_pago', index: 'hora_pago', align: 'center', width: 50},
                {name: 'total', index: 'total', align: 'right', width: 80, sorttype: 'number', formatter: 'number', formatoptions: {decimalPlaces: 3}}
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
                if(sum==undefined){
                    $("#vw_emision_rec_pago_total_global").val('0000.00');
                }else{
                    $("#vw_emision_rec_pago_total_global").val(formato_numero(sum,2,'.',','));
                }                
            },            
            ondblClickRow: function (Id) {}
        });
        jQuery("#table_contrib").jqGrid({
            url: 'obtiene_cotriname?dat=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers','codigo','DNI/RUC','contribuyente','dom_fiscal'],
            rowNum: 20, sortname: 'contribuyente', sortorder: 'asc', viewrecords: true, caption: 'Contribuyentes', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_per', index: 'id_per', align: 'center',width: 100},
                {name: 'nro_doc', index: 'nro_doc', align: 'center',width: 100},
                {name: 'contribuyente', index: 'contribuyente', align: 'left',width: 260},
                {name: 'dom_fiscal', index: 'dom_fiscal', hidden: true}
            ],
            pager: '#pager_table_contrib',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_contrib').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_contrib').jqGrid('getDataIDs')[0];
                            $("#table_contrib").setSelection(firstid);    
                        }
                    jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_bus_contrib_list(rowid);} } ); 
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){fn_bus_contrib_list(Id)}
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_Resumen_Recibos").jqGrid('setGridWidth', $("#content").width());
        });
        $("#vw_emision_reg_pag_fil_fecha").keypress(function (e) {
            if (e.which == 13) {
                fn_actualizar_grilla('table_Resumen_Recibos', 'grid_Resumen_recibos?fecha=' + $("#vw_emision_reg_pag_fil_fecha").val());
            }
        });
        var globalvalidador=0;
        $("#vw_conve_fracc_contrib").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0){
                    fn_bus_contrib();
                    globalvalidador=1;
                }else{
                    globalvalidador=0;
                }                
            }
        });
    });    
</script>
@stop
<div id="vw_conve_fracc" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Datos del Contribuyente ::.</div>
                    <div class="panel-body cr-body">
                        <fieldset>
                            <div class="row">                                
                                <section class="col col-2" style="padding-right: 5px;">
                                    <input type="hidden" id="vw_conve_fracc_id_pers">
                                    <label class="label">Cod Contrib:</label>
                                    <label class="input">
                                        <input id="vw_conve_fracc_cod_contrib" type="text" onkeypress="return soloDNI(event);"  placeholder="00000000" class="input-sm">
                                    </label>                      
                                </section>
                                <section class="col col-8" style="padding-left: 5px;padding-right:5px; ">
                                    <label class="label">Contribuyente:</label>
                                    <label class="input">                                        
                                        <input id="vw_conve_fracc_contrib" type="text" placeholder="ejm. jose min 4 caracteres" class="input-sm text-uppercase">
                                    </label>
                                </section>
                                <section class="col col-2" style="padding-left:5px">
                                    <label class="label">Año:</label>                                   
                                    <label class="select">
                                        <select onchange="" id="vw_conve_fracc_anio" class="input-sm">                                       
                                        @foreach ($anio as $anio2)                                        
                                        <option value='{{$anio2->anio}}' >{{$anio2->anio}}</option>
                                        @endforeach                                    
                                    </select><i></i>                        
                                </section>
                            </div>
                            <section>
                                <label class="label">Domicilio:</label>
                                    <label class="input">                                        
                                        <input id="vw_conve_fracc_domicilio" type="text" class="input-sm text-uppercase" disabled="">
                                    </label>
                            </section>
                        </fieldset>
                    </div>
                </div>                
                <div class="panel panel-success" style="border: 0px !important">                    
                    <div class="panel-body">    
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px !important">
                            <table id="table_Deuda_Contrib_Arbitrios"></table>
                            <div id="pager_table_Deuda_Contrib_Arbitrios">
                                <div style="float: right; font-weight: bold;">
                                    Total S/. <input type="text" id="vw_conve_fracc_ttotal" class="input-xm text-right" style="width: 100px; height: 21px;padding-right: 4px;margin-bottom: -3px;" readonly="">
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>                   
        </div>        
    </div>
</div>
<div id="vw_conve_fracc_fraccionar" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Datos del Convenio ::.</div>
                    <div class="panel-body">
                        <fieldset>
                            <div class="row">
                                <section class="col col-2" style="padding-right: 5px;">                                    
                                    <label class="label">Fecha:</label>
                                    <label class="input">
                                        <input id="vw_conve_fracc_fracc_fecha" data-mask="99/99/9999" data-mask-placeholder=".." value="<?php date_default_timezone_set('America/Lima');echo date('d-m-Y') ?>" type="text" class="input-sm">
                                    </label>                      
                                </section>
                                <section class="col col-2" style="padding-right: 5px;padding-left: 5px;">                                    
                                    <label class="label">Total:</label>
                                    <label class="input">
                                        <input id="vw_conve_fracc_fracc_tot" type="text" class="input-sm" disabled="">
                                    </label>                      
                                </section>
                                <section class="col col-1" style="padding-left: 5px;padding-right:5px; ">
                                    <label class="label">Tim:</label>
                                    <label class="input">                                        
                                        <input id="vw_conve_fracc_fracc_tim" value="{{$cfracc[0]->tif}}" type="text" class="input-sm" disabled="">
                                    </label>
                                </section>
                                <section class="col col-2" style="padding-left:5px;padding-right:5px;">
                                    <label class="label">N Cuo.</label>
                                    <label class="input">                                        
                                        <input id="vw_conve_fracc_fracc_n_cuo" onkeypress="return soloDNI(event);" type="text" class="input-sm">
                                    </label>                       
                                </section>
                                <section class="col col-2" style="padding-left:5px;padding-right:5px;">
                                    <label class="label">Inicial:</label>
                                    <label class="input">                                        
                                        <input id="vw_conve_fracc_fracc_inicial" onkeypress="return soloNumeroTab(event);" type="text" class="input-sm">
                                    </label>                       
                                </section>
                                <section class="col col-3" style="padding-left:5px">
                                      <label class="label">&nbsp;</label>
                                        <a onclick="realizar_table_fracc();" class="btn btn-primary btn-sm">Ver Fraccionamiento</a>                    
                                </section>
                            </div>                            
                        </fieldset>
                    </div>
                </div>
                
                <div class="panel panel-success" style="border: 0px !important;height: 350px;">
                    <div class="panel-heading bg-color-success">.:: Vista Fraccionamiento ::.</div>
                    <div class="panel-body">    
                        <div style="border: 1px solid #DDD; margin-bottom: 6px;">
                            <table id="t_dina_conve_fracc" class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th width="2%" align="center">N</th>
                                        <th width="20%" style="text-align: center">SALDO</th>
                                        <th width="20%" style="text-align: center">AMORTIZACION</th>
                                        <th width="20%" style="text-align: center">INTERES</th>
                                        <th width="20%" style="text-align: center">TOTAL</th>
                                        <th width="20%" style="text-align: center">Fecha Vence</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th width="2%" align="center"></th>
                                        <th width="20%" style="text-align: right">Totales S/.</th>
                                        <th width="20%" style="border-top: 2px solid #017E42;">
                                            <label class='input'><input id="vw_con_fracc_tot_amor" type="text" value="000.00" class="input-xs text-align-right" disabled=""></label>
                                        </th>
                                        <th width="20%" style="border-top: 2px solid #017E42;">
                                            <label class='input'><input id="vw_con_fracc_tot_inter" type="text" value="000.00" class="input-xs text-align-right" disabled=""></label>
                                        </th>
                                        <th width="20%" style="border-top: 2px solid #017E42;">
                                            <label class='input'><input id="vw_con_fracc_tot_cc" type="text" value="000.00" class="input-xs text-align-right" disabled=""></label>
                                        </th>
                                        <th width="20%" align="center"></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                   
        </div>        
    </div>
</div>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div>
<script src="{{ asset('archivos_js/adm_tributaria/convenio.js') }}"></script>
@endsection



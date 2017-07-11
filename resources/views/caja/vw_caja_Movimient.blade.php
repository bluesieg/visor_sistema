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
                <h1 class="txt-color-green"><b>
                        <!--<input type="hidden" id="vw_caja_id_cajero" value="{{$cajero[0]->id_caj}}">-->
                        <input type="text" id="vw_caja_mov_cajero" class="input-sm" value="{{$cajero[0]->descrip_caja}}" style="font-size:20px;border: 0px" readonly=""></b></h1>
                <div class="row">
                    <div class="col-xs-12">                        
                        <div class="text-right">
                            <div class="col-xs-2 col-sm-12 col-md-12 col-lg-3">
                                <label>Tipo de Recibo:</label>
                                <label class="select">
                                    <select onchange="select_tipo_recibo(this.value);" id="vw_caja_mov_txt_tipo_recibo" class="input-sm">                                       
                                        @foreach ($est_recibos as $est_recibos)
                                        <option value='{{$est_recibos->id_est_rec}}' >{{$est_recibos->estad_recibo}}</option>
                                        @endforeach                                        
                                    </select><i></i>
                                </label>
                            </div>                            
                            <button onclick="dialog_caja_mov_realizar_pago();" id="btn_vw_valores_arancelarios_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Pago de Recibos
                            </button>
                            <button id="btn_vw_valores_arancelarios_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-folder-close"></i></span>Cerrar Caja
                            </button>
                            <button onclick="imp_pago_rec();" type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                            </button>
                        </div>
                    </div>
                </div> 
            </div>                   
        </div>        
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="tabla_Caja_Movimientos"></table>
            <div id="pag_tabla_Caja_Movimientos"></div>
        </article>
    </div>
</section>
@section('page-js-script')

<script type="text/javascript">
    
    var id_caja={!! json_encode($cajero[0]->id_caj) !!};
    sumTotal = 0;
    $(document).ready(function () {
        $("#menu_caja").show();
        $("#li_menu_caja_movimientos").addClass('cr-active');
        jQuery("#tabla_Caja_Movimientos").jqGrid({
            url: 'grid_Caja_Movimientos?est_recibo=' + $("#vw_caja_mov_txt_tipo_recibo").val(),
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            colNames: ['id_rec_mtr', 'id_contrib', 'N°. Recibo', 'Fecha', 'Descripcion del Pago', 'Estado', 'Forma Pago', 'Hora Pago', 'Total'],
            rowNum: 15, sortname: 'id_rec_mtr', sortorder: 'desc', viewrecords: true, caption: 'Caja Movimientos', align: "center",
            colModel: [
                {name: 'id_rec_mtr', index: 'id_rec_mtr', hidden: true},
                {name: 'id_contrib', index: 'id_contrib', hidden: true},
                {name: 'nro_recibo_mtr', index: 'nro_recibo_mtr', align: 'center', width: 60},
                {name: 'fecha', index: 'fecha', align: 'center', width: 80},
                {name: 'glosa', index: 'glosa', width: 250},
                {name: 'estad_recibo', index: 'estad_recibo', width: 60},
                {name: 'tipo_pago', index: 'descrip_caja', width: 50},
                {name: 'hora_pago', index: 'hora_pago', align: 'center', width: 50},
                {name: 'total', index: 'total', align: 'center', width: 80, sorttype: 'number', formatter: 'number', formatoptions: {decimalPlaces: 3}}
            ],
            pager: '#pag_tabla_Caja_Movimientos',
            rowList: [15, 25],
            gridComplete: function () {
                var rows = $("#tabla_Caja_Movimientos").getDataIDs();
                if (rows.length > 0) {
                    var firstid = jQuery('#tabla_Caja_Movimientos').jqGrid('getDataIDs')[0];
                    $("#tabla_Caja_Movimientos").setSelection(firstid);
                }
            },
            ondblClickRow: function (Id) {dialog_caja_mov_realizar_pago();}
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_Caja_Movimientos").jqGrid('setGridWidth', $("#content").width());
        });
//        $("#vw_emision_reg_pag_fil_fecha").keypress(function (e) {
//            if (e.which == 13) {
//                fn_actualizar_grilla('table_Resumen_Recibos', 'grid_Resumen_recibos?fecha=' + $("#vw_emision_reg_pag_fil_fecha").val());
//            }
//        });
//        $("#vw_emi_rec_txt_tributo").keypress(function (e) {
//            if (e.which == 13 && !e.shiftKey) {
//                event.preventDefault();
//                autocomplete_tributo('vw_emi_rec_txt_tributo', 'vw_emi_rec_txt_valor');
//            }
//        });
    });
</script>
@stop
<div id="vw_caja_mov_realizar_pago" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Datos de Recibo ::.</div>
                    <div class="panel-body">                        
                        <fieldset>
                            <section>
                                <label class="label">Nro Recibo:</label>
                                <label class="input">
                                    <input id="vw_caja_mov_txt_nro_recibo" type="text" placeholder="000000" disabled="">
                                </label>                      
                            </section>
                            <section>
                                <label class="label">Usuario / Cajero:</label>
                                <label class="input">
                                    <input id="vw_caja_mov_txt_usuario" type="text" value="{{ Auth::user()->ape_nom }}" class="text-uppercase" disabled="">
                                </label>                      
                            </section>
                            <section>
                                <label class="label">Descripción:</label>
                                <label class="textarea">
                                    <textarea id="vw_caja_mov_txt_descripcion" rows="2" placeholder="descripcion de recibo" class="text-uppercase" disabled=""></textarea>
                                </label>
                            </section>
                            <div class="row">
                                <section class="col col-6" style="padding-right: 5px">                                    
                                    <label class="label">Total a Pagar S/.:</label>
                                    <label class="input">
                                        <input id="vw_caja_mov_txt_tot_pagar" type="text" placeholder="000.000" class="input-sm" disabled="">
                                    </label>                        
                                </section>
                                <section class="col col-6" style="padding-left: 5px;">                                    
                                    <label class="label">Tipo de Pago:</label>
                                    <label class="select">
                                    <select id="vw_caja_mov_txt_tip_pago" class="input-sm">                                       
                                        @foreach ($tipo_pago as $tipo_pago)
                                        <option value='{{$tipo_pago->id_tip_pago}}' >{{$tipo_pago->tipo_pago}}</option>
                                        @endforeach                                        
                                    </select><i></i>
                                    </label>                      
                                </section>                                                            
                            </div>                            
                        </fieldset>
                    </div>
                </div>

            </div>                   
        </div>        
    </div>
</div>
<div id="vw_caja_mov_confirm_pago_reporte" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('archivos_js/caja/Caja_Movimientos.js') }}"></script>
@endsection

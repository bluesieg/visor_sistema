@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">                
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right">                            
                            <section>
                                <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 15px;"  >
                                    <header style="background: #01a858 !important;color: white" >
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>ESTADO DE CUENTA DE FRACCIONAMIENTO</h2>
                                    </header>
                                </div>
                            </section>
                            <div class="row" style="margin-top: 7px">                                
                                <section class="col-lg-3" style="padding-right: 5px;">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Codigo:</span>
                                        <div class="icon-addon addon-md">
                                            <input id="hiddenvw_fracc_est_cta_cod" type="hidden" value="0">
                                            <input id="vw_fracc_est_cta_cod" type="text" class="form-control input-sm" >
                                        </div>
                                    </div>                                    
                                </section>
                                <section class="col-lg-5" style="padding-left: 5px;">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Contribuyente:</span>
                                        <div class="icon-addon addon-md">
                                            <input id="vw_fracc_est_cta_contrib" class="form-control input-sm text-uppercase" type="text">
                                        </div>
                                    </div>
                                </section>
                                <section class="col-lg-2 text-align-left" style="padding-left: 5px;">
                                    <button 
                                        @if($permisos[0]->btn_imp==1) onclick="print_estcta_fracc();" @else onclick="sin_permiso();" @endif                                        
                                        type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                        <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                                    </button>
                                </section>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="well well-sm well-light" style="margin-top:-20px;">                
                <div class="row">
                    <div class="col-xs-12">                        
                        <div class="row">
                            <section id="content_2" class="col-lg-12">
                                <table id="table_Convenios_estcta"></table>
                                <div id="p_table_Convenios_estcta"></div>
                            </section>
                            <section id="content_2" class="col-lg-12" style="margin-top: 5px;">
                                <table id="t_fracc_detalle"></table>
                                <div id="p_t_fracc_detalle"></div>
                            </section>
                        </div>                                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_ventanilla").show();
        $("#li_vent_est_cta_fracc").addClass('cr-active');
        jQuery("#table_Convenios_estcta").jqGrid({
            url: 'get_conv_fracc_estcta?id_contrib=0',
            datatype: 'json', mtype: 'GET',
            height: 80, autowidth: true,
            colNames: ['Nro.Convenio', 'Año','id_contrib','Contribuyente', 'Fecha', 'Interes', 'N° Cuotas', 'Estado', 'Total'],
            rowNum: 20, sortname: 'id_conv', sortorder: 'desc', viewrecords: true, caption: 'Lista de Fraccionamientos del Contribuyente', align: "center",
            colModel: [                
                {name: 'nro_convenio', index: 'nro_convenio',align: 'center',width: 80},
                {name: 'anio', index: 'anio',width: 80,align: 'center'},
                {name: 'id_contribuyente', index: 'id_contribuyente',hidden:true},
                {name: 'contribuyente', index: 'contribuyente',width: 200},
                {name: 'fec_reg', index: 'fec_reg', width: 80,align: 'center'},
                {name: 'interes', index: 'interes',align: 'center', width: 80},
                {name: 'nro_cuotas', index: 'nro_cuotas', width: 80,align: 'center'},
                {name: 'estado', index: 'estado', align: 'center', width: 80},
                {name: 'total_convenio', index: 'total_convenio', align: 'right', width: 80}                
            ],
            pager: '#p_table_Convenios_estcta',
            rowList: [15, 25],
            gridComplete: function () {
                var rows = $("#table_Convenios_estcta").getDataIDs();
                if (rows.length > 0) {
                    var firstid = jQuery('#table_Convenios_estcta').jqGrid('getDataIDs')[0];
                    $("#table_Convenios_estcta").setSelection(firstid);
                }               
            },
            onSelectRow: function (Id) {fn_actualizar_grilla('t_fracc_detalle','get_det_fracc?id_conv='+Id);},
            ondblClickRow: function (Id) {}
        });
        setTimeout(function(){ 
            jQuery("#t_fracc_detalle").jqGrid({
                url: 'get_det_fracc?id_conv=0',
                datatype: 'json', mtype: 'GET',
                height: 250, autowidth: true,
                colNames: ['N° Cuota', 'Fecha de Pago', 'Estado', 'Fecha que pagó', 'Cuota Mensual'],
                rowNum: 12, sortname: 'nro_cuota', sortorder: 'asc', viewrecords: true,
                colModel: [
                    {name: 'nro_cuota', index: 'nro_cuota',width: 30,align:'center'},
                    {name: 'fec_pago', index: 'fec_pago',width: 60,align:'left'},
                    {name: 'estado', index: 'estado',width: 50, align:'center'},
                    {name: 'fecha_q_pago', index: 'fecha_q_pago', width: 50, align:'center'},
                    {name: 'total', index: 'total', width: 60, align:'center'}                
                ],        
                rowList: [12, 15],                
                gridComplete: function () {
//                    var rows = $("#t_fracc_detalle").getDataIDs();
//                    if (rows.length > 0) {
//                        var firstid = jQuery('#t_fracc_detalle').jqGrid('getDataIDs')[0];
//                        $("#t_fracc_detalle").setSelection(firstid);
//                    }            
//                    
//                    var verif = jQuery("#t_fracc_crono_contrib").getGridParam('userData').verif_cancela;
//                    if(verif==rows.length){
//                        $("#t_fracc_crono_contrib").closest(".ui-jqgrid").block({
//                            message:"<div style='font-size:1.5em;text-align:center;font-weight: bold'>Fraccionamiento Cancelado</div>",
//                            theme: true,
//                            themedCSS:{
//                                width: "40%",
//                                left: "30%",
//                                border: "3px solid #a00"
//                            }
//                        });
//                    }else{ $("#t_fracc_crono_contrib").closest(".ui-jqgrid").unblock(); }
                }
            });
        }, 500);
        $(window).on('resize.jqGrid', function () {
            $("#table_Convenios_estcta").jqGrid('setGridWidth', $("#content_2").width());
            $("#t_fracc_detalle").jqGrid('setGridWidth', $("#content_2").width());
        });
        jQuery("#table_contrib").jqGrid({
            url: 'obtiene_cotriname?dat=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers', 'codigo', 'DNI/RUC', 'contribuyente'],
            rowNum: 20, sortname: 'contribuyente', sortorder: 'asc', viewrecords: true, caption: 'Contribuyentes', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_per', index: 'id_per', align: 'center', width: 100},
                {name: 'nro_doc', index: 'nro_doc', align: 'center', width: 100},
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 260}
            ],
            pager: '#pager_table_contrib',
            rowList: [13, 20],
            gridComplete: function () {
                var idarray = jQuery('#table_contrib').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                    var firstid = jQuery('#table_contrib').jqGrid('getDataIDs')[0];
                    $("#table_contrib").setSelection(firstid);
                }                
            },
            onSelectRow: function (Id) {},
            ondblClickRow: function (Id) { fn_bus_contrib_list_fracc(Id);}
        });
        var globalvalidador = 0;
        $("#vw_fracc_est_cta_contrib").keypress(function (e) {
            if (e.which == 13) {
                if (globalvalidador == 0) {
                    fn_bus_contrib_fracc();
                    globalvalidador = 1;
                } else {
                    globalvalidador = 0;
                }
            }
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/caja/est_cta_fracc.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div>

@endsection

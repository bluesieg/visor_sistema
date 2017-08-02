@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Estado de Cuenta - Impuesto Predial...</b></h1>
                <div class="row">
                    <div class="col-xs-12">                        
                        <section>
                            <label class="control-label col-lg-2 text-align-right" style="padding-top:5px;">Rango Fecha:</label>
                            <div class='col-lg-2 col-md-2 col-sm-2'>                                
                                <input id="" type="text" placeholder="Desde" class="form-control" >
                            </div>                            
                            <div class="input-group col-md-2 col-sm-2" style="width:155px">                                
                                <input id="" type="text" placeholder="Hasta" class="form-control" >
                            </div>
                        </section>
                        <div class="col-xs-12" style="margin-bottom: 5px;"></div>
                        <section>
                            <label class="control-label col-lg-2 text-align-right" style="padding-top:5px;">Contribuyente:</label>
                            <div class='col-lg-2 col-md-2 col-sm-2'>
                                <input id="vw_caja_est_cta_id_contrib" type="hidden" value="0">
                                <input id="vw_caja_est_cta_cod_contrib" type="text" placeholder="Codigo" class="form-control" >
                            </div>
                            <div class="input-group col-lg-8 col-md-8 col-sm-8">                                
                                <input id="vw_caja_est_cta_contrib" class="form-control text-uppercase" type="text" placeholder="Contribuyente...">
                                <div class="input-group-btn">
                                    <button class="btn btn-default btn-primary" type="button" onclick="fn_bus_contrib()">
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>                                    
                            </div>                                
                        </section>
                    </div>
                </div> 
            </div>                   
        </div>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="tabla_est_Cuenta"></table>
            <div id="pager_tabla_est_Cuenta"></div>
        </article>
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_caja").show();
        $("#li_menu_caja_est_cta").addClass('cr-active');
        jQuery("#tabla_est_Cuenta").jqGrid({
            url: 'caja_est_cta_contrib?id_pers=0',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['cod', 'id_pers', 'Periodo', 'Trimestre', 'Impuesto/Tributo', 'Cuota S/.', 'Abono S/.', 'Fecha', 'Total S/.'],
            rowNum: 20, sortname: 'cod', sortorder: 'asc', viewrecords: true, caption: 'Estado de Cuenta de Contribuyente', align: "center",
            colModel: [
                {name: 'cod', index: 'cod', hidden: true},
                {name: 'id_pers', index: 'id_per', hidden: true},
                {name: 'ano_cta', index: 'ano_cta', align: 'center', width: 80},
                {name: 'trim', index: 'trim', align: 'center', width: 80},
                {name: 'descrip_tributo', index: 'descrip_tributo', align: 'left', width: 200},
                {name: 'cuota', index: 'cuota', align: 'center', width: 100},
                {name: 'abono', index: 'abono', align: 'center', width: 100},
                {name: 'fecha', index: 'fecha', align: 'center', width: 80},
                {name: 'total', index: 'total', align: 'right', width: 100}
            ],
            pager: '#pager_tabla_est_Cuenta',
            rowList: [13, 20],
            gridComplete: function () {
                var idarray = jQuery('#tabla_est_Cuenta').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                    var firstid = jQuery('#tabla_est_Cuenta').jqGrid('getDataIDs')[0];
                    $("#tabla_est_Cuenta").setSelection(firstid);
                }

            },
            onSelectRow: function (Id) {},
            ondblClickRow: function (Id) {}
        });
        $(window).on('resize.jqGrid', function () {
            $("#tabla_est_Cuenta").jqGrid('setGridWidth', $("#content").width());
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
                jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter": function (rowid) {
                        fn_bus_contrib_list(rowid);
                    }});
            },
            onSelectRow: function (Id) {},
            ondblClickRow: function (Id) {
                fn_bus_contrib_list(Id)
            }
        });
        var globalvalidador = 0;
        $("#vw_caja_est_cta_contrib").keypress(function (e) {
            if (e.which == 13) {
                if (globalvalidador == 0) {
                    fn_bus_contrib();
                    globalvalidador = 1;
                } else {
                    globalvalidador = 0;
                }
            }
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/caja/estado_cuentas.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div>

@endsection

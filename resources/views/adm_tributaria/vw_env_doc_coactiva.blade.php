@extends('layouts.app')
@section('content')
<style>
    .icon-addon .form-control, .icon-addon.addon-md .form-control {
        padding-left: 10px; 
    }
</style>
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Envio de OP a Ejecucion Coactiva...</b></h1>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right">
                            <div class="row">
                                <section class="col-lg-7" style="padding-right: 5px;">
                                    <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >
                                        <header style="background: #01a858 !important;color: white" >
                                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                                <h2>BUSQUEDA DE CONTRIBUYENTE</h2>
                                        </header>                                    
                                    </div>
                                </section>
                                <section class="col-lg-5" style="padding-left: 5px;">
                                    <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >
                                        <header style="background: #01a858 !important;color: white" >
                                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                                <h2>FILTRAR POR: FECHA / NUMERO DE DOCUMENTO</h2>
                                        </header>                                    
                                    </div>
                                </section>
                            </div>
                                                        
                            <div class="row" style="margin-top: 7px">
                                <section class="col-lg-2" style="padding-right: 5px;">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Cod.<i class="icon-append fa fa-lock" style="margin-left: 5px;"></i></span>
                                        <div class="icon-addon addon-md">
                                            <input id="hidden_vw_env_doc_codigo" type="hidden" value="0">
                                            <input id="vw_env_doc_codigo" type="text" class="form-control input-sm" style="padding-left:5px;padding-right: 5px;">
                                        </div>
                                    </div>
                                </section>
                                <section class="col-lg-5" style="padding-left: 5px;padding-right: 5px;">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Contribuyente<i class="icon-append fa fa-male" style="margin-left: 5px;"></i></span>
                                        <div class="icon-addon addon-md">
                                            <input id="vw_env_doc_contrib" class="form-control input-sm text-uppercase" type="text">
                                        </div>
                                    </div>
                                </section>
                                <section class="col-lg-5" style="padding-left: 5px;">
                                    <div class="row">
                                        <section class="col-lg-6" style="padding-right:5px">
                                            <div class="input-group">
                                                <span class="input-group-addon">De</span>
                                                <input placeholder="dd/mm/aaaa" class="form-control input-sm datepicker" data-dateformat='dd/mm/yy'>
                                                <span class="input-group-addon">a</span>
                                                <input placeholder="dd/mm/aaaa" class="form-control input-sm datepicker" data-dateformat='dd/mm/yy'>
                                            </div>                                            
                                        </section>
                                        <section class="col-lg-6" style="padding-left:5px">                                            
                                            <div class="input-group">
                                                <span class="input-group-addon">Del</span>
                                                <input class="form-control input-sm" id="appendprepend" type="text">
                                                <span class="input-group-addon">a</span>
                                                <input class="form-control input-sm" id="appendprepend" type="text">
                                            </div>                                            
                                        </section>                                        
                                    </div>
                                </section>
                            </div>                            
                        </div>                        
                    </div>
                </div> 
            </div>
            <div class="well well-sm well-light" style="margin-top:-20px;">
                <div class="row">                    
                    <section class="col-lg-5" id="content_2" style="padding-right:5px;width: 45%">
                        <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;">
                            <header style="background: #01a858 !important;color: white" >
                                    <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                    <h2>RECAUDACION</h2>
                            </header>                                    
                        </div>
                        <table id="tabla_Doc_OP"></table>
                        <div id="p_tabla_Doc_OP"></div>
                    </section>
                    <section class="col-lg-2 text-align-center" style="padding-right:5px;padding-left: 5px;width: 10%">
                        <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 15px;"  >
                            <header style="background: #01a858 !important;color: white" >
                                    <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                    <h2>Botones</h2>
                            </header>                                    
                        </div>
                        <a onclick="all_right();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-double-right"></i></a>
                        <br><br>
                        <a onclick="right();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-right"></i></a>
                        <br><br>
                        <a onclick="left();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-left"></i></a>
                        <br><br>
                        <a onclick="all_left();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-double-left"></i></a>
                    </section>
                    <section class="col-lg-5" id="content_3" style="padding-left: 5px;width: 45%">
                       <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >
                            <header style="background: #01a858 !important;color: white" >
                                    <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                    <h2>COACTIVA</h2>
                            </header>                                    
                        </div>
                        <table id="tabla_Doc_OP_2"></table>
                        <div id="p_tabla_Doc_OP_2"></div>
                    </section>
                </div> 
            </div>
        </div>       
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_admtri").show();
        $("#li_env_doc_a_coac").addClass('cr-active');
        jQuery("#tabla_Doc_OP").jqGrid({
            url: 'recaudacion_get_op?id_contrib=0&env_op=0',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_gen_fis', 'Nro', 'Fec. Emi', 'Año','N° Documento', 'Contribuyente o Razon Social','estado','verif'],
            rowNum: 15, sortname: 'id_gen_fis', sortorder: 'desc', viewrecords: true, align: "center",
            colModel: [
                {name: 'id_gen_fis', index: 'id_gen_fis', hidden: true},
                {name: 'nro_fis', index: 'nro_fis', align: 'center', width: 80},
                {name: 'fec_reg', index: 'fec_reg', hidden: true},
                {name: 'anio', index: 'anio', align: 'center', width: 60},
                {name: 'nro_doc', index: 'nro_doc',hidden: true},                
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250},
                {name: 'estado', index: 'estado', hidden: true},
                {name: 'verif_env', index: 'verif_env', hidden: true}
            ],
            pager: '#p_tabla_Doc_OP',
            rowList: [15, 20],
            gridComplete: function () {},
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        jQuery("#tabla_Doc_OP_2").jqGrid({
            url: 'recaudacion_get_op?id_contrib=0&env_op=0',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_gen_fis', 'Nro', 'Fec. Emi', 'Año','N° Documento', 'Contribuyente o Razon Social','estado','verif'],
            rowNum: 15, sortname: 'id_gen_fis', sortorder: 'desc', viewrecords: true, align: "center",
            colModel: [
                {name: 'id_gen_fis', index: 'id_gen_fis', hidden: true},
                {name: 'nro_fis', index: 'nro_fis', align: 'center', width: 80},
                {name: 'fec_reg', index: 'fec_reg', hidden: true},
                {name: 'anio', index: 'anio', align: 'center', width: 60},
                {name: 'nro_doc', index: 'nro_doc',hidden: true},                
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250},
                {name: 'estado', index: 'estado', hidden: true},
                {name: 'verif_env', index: 'verif_env', hidden: true}
            ],
            pager: '#p_tabla_Doc_OP_2',
            rowList: [15, 20],
            gridComplete: function () {},
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        $(window).on('resize.jqGrid', function () {
            $("#tabla_Doc_OP").jqGrid('setGridWidth', $("#content_2").width());
        });
        $(window).on('resize.jqGrid', function () {
            $("#tabla_Doc_OP_2").jqGrid('setGridWidth', $("#content_3").width());
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
            ondblClickRow: function (Id) { fn_bus_contrib_list_env_doc(Id);}
        });
        var globalvalidador = 0;
        $("#vw_env_doc_contrib").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0){
                    fn_bus_contrib_env_doc();
                    $("#chk_sel_todo_doc").removeAttr('disabled');
                    globalvalidador=1;
                }else{
                    globalvalidador=0;
                }
            }
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/adm_tributaria/envio_doc_coactiva.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div>
<div id="dlg_iframe_op" style="display: none;">
    <iframe id="myIframe_op" width="885" height="580"></iframe>
</div>

@endsection

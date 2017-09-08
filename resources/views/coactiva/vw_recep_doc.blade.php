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
                <h1 class="txt-color-green"><b>Recepcion de Documentos...</b></h1>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right">
                            <div class="row">
                                <section class="col-lg-3" style="padding-right:5px">
                                    <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >                                
                                        <header style="background: #01a858 !important;color: white; padding-right: 15px !important" >
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>TIPO DE DOCUMENTO</h2>
                                        </header>
                                    </div>                                   
                                </section>
                                <section class="col-lg-6" style="padding-left:5px">
                                    <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >
                                        <header style="background: #01a858 !important;color: white; padding-right: 15px !important" >
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>RANGO FECHA</h2>
                                        </header>
                                    </div>                                    
                                </section>     
                            </div>                    
                            <div class="row" style="margin-top: 7px">
                                <section class="col-lg-3" style="padding-right: 5px;">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Documento<i class="icon-append fa fa-file-text" style="margin-left: 5px;"></i></span>
                                        <div class="icon-addon addon-md">
                                            <select id="vw_recep_doc_tip_doc" class="form-control">
                                                <option value="1">OP</option>
                                                <option value="2">RD</option>
                                            </select>
                                        </div>
                                    </div>
                                </section>
                                <section class="col-lg-6" style="padding-left: 5px;">
                                    <div class="input-group">
                                        <span class="input-group-addon">Desde<i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                                        <input placeholder="dd/mm/aaaa" id="vw_env_doc_fdesde" class="form-control datepicker" data-dateformat='dd/mm/yy' value="{{date('d/m/Y')}}" maxlength="10">
                                        <span class="input-group-addon">Hasta<i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                                        <input placeholder="dd/mm/aaaa" id="vw_env_doc_fhasta" class="form-control datepicker" data-dateformat='dd/mm/yy' value="{{date('d/m/Y')}}" maxlength="10">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" id="vw_env_doc_btn1" type="button" onclick="fn_up_grid();" title="BUSCAR">
                                                <i class="glyphicon glyphicon-search"></i>&nbsp;Buscar
                                            </button>
                                        </span>
                                    </div>
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
                            <section id="content_2" class="col col-lg-10" style="padding-right:5px">
                                <table id="tabla_Doc_OP"></table>
                                <div id="p_tabla_Doc_OP"></div>
                            </section>
                            <section class="col col-lg-2" style="padding-left:5px"> 
                                <div style="background: #eee !important;padding:0px 7px; border: 1px solid #DDD;border-radius: 3px;margin-bottom: 8px;">
                                    <form class="smart-form">
                                        <label class="toggle" >
                                            <input type="checkbox" onclick="seleccionar_todo();" id="chk_sel_todo_doc" disabled="">
                                            <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Check Todo</label>
                                    </form>
                                </div>
                                <button class="btn bg-color-green txt-color-white cr-btn-big" onclick="clicknewpiso()" >
                                    <span>
                                        <i class="glyphicon glyphicon-plus-sign"></i>
                                    </span>
                                    <label>Recibir Doc.</label>
                                </button>                                                                                             
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
        $("#menu_coactiva").show();
        $("#li_recep_doc").addClass('cr-active');        
        jQuery("#tabla_Doc_OP").jqGrid({
            url: 'recaudacion_get_op?id_contrib=0&env_op=0',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_gen_fis', 'Nro', 'Fec. Emi', 'Año','N° Documento', 'Contribuyente o Razon Social','estado','verif'],
            rowNum: 15, sortname: 'id_gen_fis', sortorder: 'desc', viewrecords: true, caption:'Documentos Enviados', align: "center",
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
            gridComplete: function () {
                var idarray = jQuery('#tabla_Doc_OP').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#tabla_Doc_OP').jqGrid('getDataIDs')[0];
                            $("#tabla_Doc_OP").setSelection(firstid);    
                        }
            },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        $(window).on('resize.jqGrid', function () {
            $("#tabla_Doc_OP").jqGrid('setGridWidth', $("#content_2").width());
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
        $("#vw_recep_doc_contrib").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0){
                    fn_bus_contrib_recep_doc();
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
<script src="{{ asset('archivos_js/coactiva/resep_doc.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div>
<div id="vw_coact_ver_doc" style="display: none;">
    <iframe id="vw_coa_iframe_doc" width="885" height="580"></iframe>
</div>

@endsection


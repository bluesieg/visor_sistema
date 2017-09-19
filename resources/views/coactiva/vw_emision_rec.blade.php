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
                <h1 class="txt-color-green"><b>Emision de Resolucion de Ejecucion Coactiva...</b></h1>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right">                                                      
                            <div class="row">
                                <section class="col-lg-2" style="padding-right:5px">
                                    <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >                                
                                        <header style="background: #01a858 !important;color: white; padding-right: 15px !important" >
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>FECHA:</h2>
                                        </header>
                                    </div>                                   
                                </section>
                                <section class="col-lg-5" style="padding-left: 5px">
                                    <div class="input-group">
                                        <span class="input-group-addon">Desde<i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                                        <input placeholder="dd/mm/aaaa" id="vw_resep_doc_fdesde" class="form-control datepicker" data-dateformat='dd/mm/yy' value="{{date('d/m/Y')}}" maxlength="10">
                                        <span class="input-group-addon">Hasta<i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                                        <input placeholder="dd/mm/aaaa" id="vw_resep_doc_fhasta" class="form-control datepicker" data-dateformat='dd/mm/yy' value="{{date('d/m/Y')}}" maxlength="10">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" id="vw_resep_doc_btn1" type="button" title="BUSCAR">
                                                <i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;Buscar
                                            </button>
                                        </span>
                                    </div>
                                </section>
                                <section class="col-lg-5"> 
                                    <button onclick="dlg_gen_resol();" type="button" class="btn btn-labeled btn-success">
                                        <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Nuevo
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
                            <section id="content_2" class="col col-lg-12" style="padding-right:5px">
                                <table id="tabla_Rec"></table>
                                <div id="p_tabla_Rec"></div>
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
        $("#li_emision_rec").addClass('cr-active');
        jQuery("#tabla_Rec").jqGrid({
            url: 'fiscal_get_op?id_contrib=0&tip_doc=0',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_gen_fis', 'Nro', 'Fec. Emi', 'Año','N° Documento', 'Contribuyente o Razon Social','estado','OP','Enviar'],
            rowNum: 20, sortname: 'id_gen_fis', sortorder: 'desc', viewrecords: true, caption: 'Resoluciones De Apertura', align: "center",
            colModel: [
                {name: 'id_gen_fis', index: 'id_gen_fis', hidden: true},
                {name: 'nro_fis', index: 'nro_fis', align: 'center', width: 80},
                {name: 'fec_reg', index: 'fec_reg', align: 'center', width: 80},
                {name: 'anio', index: 'anio', align: 'center', width: 60},
                {name: 'nro_doc', index: 'nro_doc', align: 'center', width: 100},                
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250},
                {name: 'estado', index: 'estado', hidden: true},                
                {name: 'op', index: 'op', align: 'center', width: 100},
                {name: 'check', index: 'check', align: 'center', width: 50}
            ],
            pager: '#p_tabla_Rec',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#tabla_Rec').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#tabla_Rec').jqGrid('getDataIDs')[0];
                            $("#tabla_Rec").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        $(window).on('resize.jqGrid', function () {
            $("#tabla_Rec").jqGrid('setGridWidth', $("#content_2").width());
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
        jQuery("#t_doc_recibidos").jqGrid({
            url: 'coactiva_gen_resolucion',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_gen_fis', 'Nro', 'Fecha','Hora', 'Año','N° Documento', 'Contribuyente o Razon Social','estado','verif','Monto S/.','Selec.'],
            rowNum: 15, sortname: 'id_gen_fis', sortorder: 'desc', viewrecords: true, caption:'Documentos Recibidos', align: "center",
            colModel: [
                {name: 'id_gen_fis', index: 'id_gen_fis', hidden: true},
                {name: 'nro_fis', index: 'nro_fis', align: 'center', width: 80},
                {name: 'fec_reg', index: 'fec_reg', align: 'center', width: 80},
                {name: 'hora', index: 'hora', align: 'center', width: 70},
                {name: 'anio', index: 'anio', hidden: true},
                {name: 'nro_doc', index: 'nro_doc',hidden: true},                
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 280},
                {name: 'estado', index: 'estado', hidden: true},
                {name: 'verif_env', index: 'verif_env', hidden: true},
                {name: 'monto', index: 'monto', width: 85,align:'center'},
                {name: 'recibir', index: 'recibir', width: 70,align:'center'}
            ],
            pager: '#p_t_doc_recibidos',
            rowList: [15, 20],
            gridComplete: function () {
                var idarray = jQuery('#t_doc_recibidos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                        var firstid = jQuery('#t_doc_recibidos').jqGrid('getDataIDs')[0];
                        $("#t_doc_recibidos").setSelection(firstid);
//                        $("#chk_sel_todo_doc").attr('disabled',false);    
                    }else{
//                        $("#chk_sel_todo_doc").attr('disabled',true);
                    }
            },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        var globalvalidador = 0;
        $("#vw_coactiva_contrib").keypress(function (e) {
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
<script src="{{ asset('archivos_js/coactiva/emision_rec.js') }}"></script>
<div id="dialog_gen_resol" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">                
                <div class="panel panel-success" style="border: 0px !important;">
                    <div class="panel-heading bg-color-success">.:: Filtrar Por: ::.</div>
                    <div class="panel-body">
                        <fieldset>
                            <div class="row">
                                <section class="col col-4" style="padding-right:5px;">
                                    <label class="label">Tipo Documento:</label>                                   
                                    <label class="select">
                                        <select id="cb_tip_doc_3" onchange="filtro_tipo_doc_pers(this.value);">
                                            <option value="1">(OP) Orden de Pago</option>
                                            <option value="2">(RD) Resolucion Determinacion</option>
                                        </select><i></i> </label>                                                       
                                </section>                                
                                <section class="col col-2" style="padding-left:5px">
                                    <label class="label">&nbsp;</label>
                                    <a onclick=";" class="btn btn-primary btn-sm">Buscar</a>
                                </section>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Documentos Recibidos ::.</div>
                    <div class="panel-body">
                        <fieldset>                         
                            <section class="col-lg-12">
                                <table id="t_doc_recibidos"></table>
                                <div id="p_t_doc_recibidos"></div>                                                                                           
                            </section>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dlg_editor" style="display: none;">
    <iframe id="rec_editor" width="500" height="300"></iframe>
</div>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div>


@endsection



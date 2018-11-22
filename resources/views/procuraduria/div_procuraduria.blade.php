<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/procuraduria/escaneo_documentos.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/procuraduria/procuraduria.js') }}"></script>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px;display: none;" id="dlg_gerencia_procuraduria">
    <div class="well well-sm well-light">
        <div class="row">            
            <section class="col col-lg-12">                        
                <ul id="tabs1" class="nav nav-tabs bordered">
                    <li class="active">
                        <a href="#s1" data-toggle="tab" aria-expanded="true">
                            EXPEDIENTES
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#s2" data-toggle="tab" aria-expanded="false">
                           DOCUMENTOS ADJUNTOS
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>                            
                </ul>
            <div id="myTabContent1" class="tab-content padding-1"> 

                <div id="s1" class="tab-pane fade active in">
                <section class="col col-lg-12">
                <div class="col-xs-12">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section style="padding-right: 0px">
                                <div class="col-xs-12">                                            
                                    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
                                        <div class="col-xs-12 cr-body">
                                            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                                                <div>
                                                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                                                        <header>
                                                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                <h2>Información del Responsable::..</h2>
                                                        </header>
                                                    </div>
                                                </div>

                                                <input type="hidden" id="id_procuraduria" value="0">

                                                <div class="row">
                                                    <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI &nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div >
                                                                <label id="dlg_proc_dni_responsable" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">RESPONSABLE &nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div>
                                                                <label id="dlg_proc_nombre_responsable"  class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>  
                                                </div>   

                                                <div>
                                                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                                                        <header>
                                                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                <h2>Información del Expediente::..</h2>
                                                        </header>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI &nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div >
                                                                <label id="dlg_proc_dni_gestor" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">GESTOR &nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div>
                                                                <label id="dlg_proc_nombre_gestor"  class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>  
                                                    <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">NUMERO EXPEDIENTE &nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div >
                                                                <label id="dlg_proc_num_expe" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">FECHA INICIO &nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div>
                                                                <label id="dlg_proc_fec_inicio"  class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                                                        <header>
                                                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                <h2>Información Catastral::..</h2>
                                                        </header>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">CODIGO CATASTRAL &nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div >
                                                                <label id="dlg_proc_cod_catastral" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">HABILITACION URBANA &nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div>
                                                                <label id="dlg_proc_hab_urb"  class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>  
                                                </div> 

                                                <div>
                                                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                                                        <header>
                                                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                <h2>Información del Proceso::..</h2>
                                                        </header>
                                                    </div>
                                                </div> 
                                                 <div class="row">

                                                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 250px;">TIPO SANCION &nbsp;<i class="fa fa-"></i></span>
                                                            <div>
                                                                <label id="dlg_proc_tip_sancion"  class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 250px;">MATERIA &nbsp;<i class="fa fa-"></i></span>
                                                            <div>
                                                                <label id="dlg_proc_materia"  class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 250px;">PROCESO &nbsp;<i class="fa fa-"></i></span>
                                                            <div>
                                                                <label id="dlg_proc_proceso"  class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 250px;">CASO &nbsp;<i class="fa fa-users"></i></span>
                                                            <div>
                                                                <label id="dlg_proc_caso"  class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 250px;">REFERENCIA &nbsp;<i class="fa fa-"></i></span>
                                                            <div>
                                                                <label id="dlg_proc_referencia"  class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 250px;">PROCEDIMIENTO &nbsp;<i class="fa fa-"></i></span>
                                                            <div>
                                                                <label id="dlg_proc_procedimiento"  class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-md-6 col-lg-6" style="padding: 0px; margin-top: 0px;">
                                            <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_procuraduria();">
                                                <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
                                            </button>
                                        </div>

                                        <div class="col-xs-6 col-md-6 col-lg-6" style="padding: 0px; margin-top: 0px;">
                                            <button  type="button" class="btn btn-labeled bg-color-greenDark txt-color-white" onclick="traer_datos_observ_procuraduria($('#id_procuraduria').val());">
                                                <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>VER OBSERVACIONES
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            </section>

                        </div>
                    </div>
                   </div>
                </section>
                </div>

                <div id="s2" class="tab-pane fade" style="height: auto">
                <section class="col col-lg-12">
                <div class="col-xs-12">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section style="padding-right: 10px">
                                <div class="col-xs-12">

                                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                    <article class="col-xs-12" style=" padding: 0px !important">
                                            <table id="table_documentos_procuraduria"></table>
                                            <div id="pager_table_documentos_procuraduria"></div>
                                    </article>
                                    </div>

                                </div>

                            </section>

                        </div>

                    </div>
                </div>
                </section>
                </div>
            </div> 

           </section>
        </div>
    </div>            
</div>    

<div id="dlg_ver_observacion_procuraduria" style="display: none;">
    <div class="col-xs-12" id="observaciones_procuraduria" style="margin-bottom: 10px; padding: 0px; background-color: white"></div>
</div>


<script type="text/javascript">
    $(document).ready(function (){
        
        jQuery("#table_documentos_procuraduria").jqGrid({
        url: '',
        datatype: 'json', mtype: 'GET',
        height: '300px', autowidth: true,
        toolbarfilter: true,
        colNames: ['ID', 'DESCRIPCION','DOCUMENTOS ADJUNTOS'],
        rowNum: 50, sortname: 'id_doc_adj', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE EXPEDIENTES', align: "center",
        colModel: [
            {name: 'id_doc_adj', index: 'id_doc_adj', align: 'left',width: 20, hidden: true},
            {name: 'descripcion', index: 'descripcion', align: 'left', width: 550},
            {name: 'ver', index: 'ver', align: 'center', width: 300},
        ],
        pager: '#pager_table_documentos_procuraduria',
        rowList: [10, 20, 30, 40, 50],
        gridComplete: function () {
            var idarray = jQuery('#table_documentos_procuraduria').jqGrid('getDataIDs');
            if (idarray.length > 0) {
            var firstid = jQuery('#table_documentos_procuraduria').jqGrid('getDataIDs')[0];
                    $("#table_documentos_procuraduria").setSelection(firstid);    
                }
        }
    });
        
    });
</script>

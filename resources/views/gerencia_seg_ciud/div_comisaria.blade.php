
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/comisarias.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/doc_adj_comisarias.js') }}"></script>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px;display: none;" id="dlg_gsc_comisarias">
    <div class="well well-sm well-light">
        <div class="row">            
            <section class="col col-lg-12">                        
                <ul id="tabs1" class="nav nav-tabs bordered">
                    <li class="active">
                        <a href="#informacion_comisaria" data-toggle="tab" aria-expanded="true">
                            INFORMACION COMISARIA
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#doc_adj_comisaria" data-toggle="tab" aria-expanded="false">
                           DOCUMENTOS ADJUNTOS
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>                            
                </ul>
            <div id="myTabContent1" class="tab-content padding-1"> 

                <div id="informacion_comisaria" class="tab-pane fade active in">
                <section class="col col-lg-12">
                <div class="col-xs-12">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section style="padding-right: 0px">
                                <div class="col-xs-12">                                            
                                    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
                                        <div class="col-xs-12 cr-body" >
                                            <div class="col-xs-8 col-md-8 col-lg-8" style="padding: 0px; margin-top: 0px;">
                                                
                                                <input type="hidden" id="id_gsc_comisaria" value="0">
                                                
                                                <div class="col-xs-12" style="padding: 0px;">
                                                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                        <span class="input-group-addon" style="width: 35%">NOMBRE COMISARIA &nbsp;<i class="fa fa-home"></i></span>
                                                        <div >
                                                            <label id="dlg_gsc_comisaria_nombre"  class="form-control" style="height: 32px;"></label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                                                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                        <span class="input-group-addon" style="width: 35%">UBICACION &nbsp;<i class="fa fa-area-chart"></i></span>
                                                        <div >
                                                            <label id="dlg_gsc_comisaria_ubicacion"  class="form-control" style="height: 32px;"></label>
                                                        </div>

                                                    </div>
                                                </div>
                                               
                                                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                                                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                        <span class="input-group-addon" style="width: 35%">NRO. EFECTIVOS &nbsp;<i class="fa fa-phone"></i></span>
                                                        <div >
                                                            <label id="dlg_gsc_comisaria_nro_efectivos" class="form-control" style="height: 32px;"></label>
                                                        </div>

                                                    </div>
                                                </div>
                                                
                                                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                        <span class="input-group-addon" style="width: 35%">NRO. VEHICULOS &nbsp;<i class="fa fa-users"></i></span>
                                                        <div>
                                                            <label id="dlg_gsc_comisaria_nro_vehiculos"  class="form-control" style="height: 32px;"></label>
                                                        </div>

                                                    </div>
                                                </div>
                                                
                                                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                        <span class="input-group-addon" style="width: 35%">TELEFONO COMISARIA &nbsp;<i class="fa fa-users"></i></span>
                                                        <div>
                                                            <label id="dlg_gsc_comisaria_telefono"  class="form-control" style="height: 32px;"></label>
                                                        </div>

                                                    </div>
                                                </div>
                                                 
                                            </div>
                                            
                                            <div class="col-xs-4 col-md-4 col-lg-4" style="padding: 0px; margin-top: 0px;">
                                                
                                                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                    <center><img id="dlg_gsc_comisaria_foto" class="col-xs-12 text-align-center" style="max-height:250px; max-width:400px;"></center>
                                                </div>
                                                 
                                            </div>
                                        </div>

                                        <div class="col-xs-4 col-md-4 col-lg-4" style="padding: 0px; margin-top: 0px;">
                                            <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_comisarias();">
                                                <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
                                            </button>
                                        </div>
                                    
                                        <div class="col-xs-4 col-md-4 col-lg-4" style="padding: 0px; margin-top: 0px;">
                                            <button  type="button" class="btn btn-labeled bg-color-greenDark txt-color-white" onclick="traer_datos_gsc_personal_comisaria($('#id_gsc_comisaria').val());">
                                                <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>VER PERSONAL
                                            </button>
                                        </div>
                                    
                                        <div class="col-xs-4 col-md-4 col-lg-4" style="padding: 0px; margin-top: 0px;">
                                            <button  type="button" class="btn btn-labeled bg-color-greenDark txt-color-white" onclick="traer_datos_gsc_observ_comisarias($('#id_gsc_comisaria').val());">
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

                <div id="doc_adj_comisaria" class="tab-pane fade" style="height: auto">
                <section class="col col-lg-12">
                <div class="col-xs-12">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section style="padding-right: 10px">
                                <div class="col-xs-12">

                                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                    <article class="col-xs-12" style=" padding: 0px !important">
                                            <table id="table_documentos_comisaria"></table>
                                            <div id="pager_table_documentos_comisaria"></div>
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

<div id="dlg_ver_observacion_comisarias" style="display: none;">
    <div class="col-xs-12" id="gsc_observ_comisarias" style="margin-bottom: 10px; padding: 0px; background-color: white"></div>
</div>

<div id="dlg_ver_personal_comisarias" style="display: none;">
    <div class="col-xs-12" id="gsc_personal_comisarias" style="margin-bottom: 10px; padding: 0px; background-color: white"></div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        
        jQuery("#table_documentos_comisaria").jqGrid({
        url: '',
        datatype: 'json', mtype: 'GET',
        height: '300px', autowidth: true,
        toolbarfilter: true,
        colNames: ['ID', 'DESCRIPCION','DOCUMENTOS ADJUNTOS'],
        rowNum: 50, sortname: 'id_doc_adj_com', sortorder: 'desc', viewrecords: true, caption: 'DOCUMENTOS ADJUNTOS', align: "center",
        colModel: [
            {name: 'id_doc_adj_com', index: 'id_doc_adj_com', align: 'left',width: 20, hidden: true},
            {name: 'descripcion', index: 'descripcion', align: 'left', width: 550},
            {name: 'ver', index: 'ver', align: 'center', width: 300},
        ],
        pager: '#pager_table_documentos_comisaria',
        rowList: [10, 20, 30, 40, 50],
        gridComplete: function () {
            var idarray = jQuery('#table_documentos_comisaria').jqGrid('getDataIDs');
            if (idarray.length > 0) {
            var firstid = jQuery('#table_documentos_comisaria').jqGrid('getDataIDs')[0];
                    $("#table_documentos_comisaria").setSelection(firstid);    
                }
        }
    });
        
    });
</script>
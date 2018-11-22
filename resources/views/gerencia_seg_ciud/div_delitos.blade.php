
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/mapa_delito.js') }}"></script>

<div id="dlg_gsc_mapa_delitos" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body">
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información de Personas::..</h2>
                        </header>
                    </div>
                </div>
                
                <input type="hidden" id="id_gsc_mapa_delito" value="0">
                
                <div class="row">
                    <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">DNI &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div >
                                <label id="dlg_gsc_map_delito_dni_infractor" class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                
                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">INFRACTOR &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_nomb_infractor"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>  
                    <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">DNI &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div >
                                <label id="dlg_gsc_map_delito_dni_encargado" class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                
                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">ENCARGADO &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_nomb_encargado"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                </div>                
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información del Delito::..</h2>
                        </header>
                    </div>
                </div> 
                 <div class="row">
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">UBICACION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_ubicacion"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">FECHA REGISTRO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_fec_reg"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">TIPO DELITO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_tip_delito"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">VEHICULO &nbsp;<i class="fa fa-users"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_vehiculo"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">OBSERVACIONES &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_observaciones"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <center><img id="dlg_gsc_map_delito_imagen" class="col-xs-12 text-align-center" style="max-height:250px; max-width:400px;"></center>
                    
                    </div>
                     
                </div>
            </div>
        </div>
        <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_mapa_delitos();">
            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
        </button>
    </div>
</div>
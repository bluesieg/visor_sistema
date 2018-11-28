
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/rutas_serenazgo.js') }}"></script>

<div id="dlg_gsc_rutas_serenazgo" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body">
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">            
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información Ruta Serenazgo::..</h2>
                        </header>
                    </div>
                </div> 
                 <div class="row">
                     
                     <input type="hidden" id="id_gsc_ruta_serenazgo" value="0">
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">UBICACION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_ruta_serenazgo_ubicacion"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">UNIDAD &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_ruta_serenazgo_unidad"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">PLACA &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_ruta_serenazgo_placa"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">TIPO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_ruta_serenazgo_tipo"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">PERSONAL &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_ruta_serenazgo_personal"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                </div>
            </div>
        </div>
        <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_mapa_rutas_serenazgo();">
            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
        </button>
    </div>
</div>
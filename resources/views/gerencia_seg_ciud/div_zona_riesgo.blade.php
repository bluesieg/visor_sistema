
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/zonas_riesgo.js') }}"></script>

<div id="dlg_gsc_zona_riesgo" style="display: none;">
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
                
                <input type="hidden" id="id_gsc_zona_riesgo" value="0">
                
                <div class="row">
                    <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">DNI &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div >
                                <label id="dlg_gsc_zona_riesgo_dni_prop" class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                
                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">PROPIETARIO &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div>
                                <label id="dlg_gsc_zona_riesgo_nomb_prop"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>  
                </div>                
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información del Zona Riesgo::..</h2>
                        </header>
                    </div>
                </div> 
                 <div class="row">
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">UBICACION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_zona_riesgo_ubicacion"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">TIPO RIESGO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_zona_riesgo_tip_riesgo"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                </div>
            </div>
        </div>
        <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_mapa_zona_riesgo();">
            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
        </button>
    </div>
</div>

<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_obras_pub_infra/expediente_tecnico.js') }}"></script>

<div id="dlg_gopi_expedientes_tecnicos" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body">
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información de Persona::..</h2>
                        </header>
                    </div>
                </div>
                
                <input type="hidden" id="id_gopi_exp_tecnico" value="0">
                
                <div class="row">
                   <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                        <div >
                            <label id="dlg_gopi_exp_tecnico_dni" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                
                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">NOMBRE &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                                <label id="dlg_gopi_exp_tecnico_nombre"  class="form-control" style="height: 32px;"></label>
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
                    <div class="col-xs-3" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">CODIGO CATASTRAL &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_cod_catastral"  class="form-control" style="height: 32px;"></label>
                            </div>
                
                        </div>
                    </div>

                    <div class="col-xs-9" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">HABILITACION URBANA &nbsp;<i class="fa fa-p"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_hab_urb"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                </div>
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información del Expediente Tecnico::..</h2>
                        </header>
                    </div>
                </div> 
                 <div class="row">
                     
                <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">MONTO EXP TEC &nbsp;<i class="fa fa-"></i></span>
                        <div>
                                <label id="dlg_gopi_exp_tecnico_monto_exp_tec"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">CODIGO SNIP &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_codigo_snip"  class="form-control" style="height: 32px;"></label>
                </div>
              
                        </div>
                    </div>

                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">NOMBRE PIP &nbsp;<i class="fa fa-users"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_nombre_pip"  class="form-control" style="height: 32px;"></label>
                            </div>
                    
                </div>
                    </div>
                
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">MONTO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_monto"  class="form-control" style="height: 32px;"></label>
                            </div>
                    
                        </div>
                    </div>
                    
                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">DESCRIPCION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_descripcion"  class="form-control" style="height: 32px;"></label>
                </div>
                
                        </div>
                    </div>
           
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">TIEMPO EJECUCION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_tiempo_ejec"  class="form-control" style="height: 32px;"></label>
            </div>
          
        </div>
    </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">APROBACION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_aprob"  class="form-control" style="height: 32px;"></label>
</div> 

                        </div>
                    </div>
                     
                </div>
            </div>
        </div>
        <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_expedientes_tecnicos();">
            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
        </button>
    </div>
</div>

<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_obras_pub_infra/perfil.js') }}"></script>

<div id="dlg_gopi_perfiles" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body">
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información de Responsable::..</h2>
                        </header>
                    </div>
                </div>
                
                <input type="hidden" id="id_gopi_perfil" value="0">
                
                <div class="row">
                   <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                        <div >
                            <label id="dlg_gopi_perfiles_dni" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                
                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">NOMBRE &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                                <label id="dlg_gopi_perfiles_nombre"  class="form-control" style="height: 32px;"></label>
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
                                <label id="dlg_gopi_perfiles_codigo_catastral"  class="form-control" style="height: 32px;"></label>
                            </div>
                
                        </div>
                    </div>

                    <div class="col-xs-9" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">HABILITACION URBANA &nbsp;<i class="fa fa-p"></i></span>
                        <div>
                                <label id="dlg_gopi_perfiles_hab_urb"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                </div>
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información del Perfil::..</h2>
                        </header>
                    </div>
                </div> 
                 <div class="row">
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">CODIGO SNIP &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_codigo_snip"  class="form-control" style="height: 32px;"></label>
                            </div>
                
                        </div>
                    </div>

                    <div class="col-xs-5" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">NOMBRE PIP &nbsp;<i class="fa fa-users"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_nombre_pip"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-3" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">MONTO PIP &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_monto_perfil"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">RESPONSABILIDAD FUNCIONAL &nbsp;<i class="fa fa-"></i></span>
                        <div>
                                <label id="dlg_gopi_perfiles_respon_funcional"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">UNIDAD FORMULADORA &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_uni_formuladora"  class="form-control" style="height: 32px;"></label>
                            </div>
                    
                </div>
                    </div>
                
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">UNIDAD EJECUTORA &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_uni_ejecutora"  class="form-control" style="height: 32px;"></label>
                            </div>
           
            </div>
                    </div>
          
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">NIVEL &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_nivel"  class="form-control" style="height: 32px;"></label>
        </div>

    </div>
</div> 

                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">NUM. BENEFICIARIOS &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_num_beneficiarios"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">CANT. ALTERNATIVAS &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_cant_alternativas"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">MONTO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_monto"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">VIABILIDAD &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_viabilidad"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div> 
                     
                </div>
            </div>
        </div>
        <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_perfiles();">
            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
        </button>
    </div>
</div>
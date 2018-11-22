
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_obras_pub_infra/mantenimiento.js') }}"></script>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px;display: none;" id="dlg_gopi_mantenimientos">
    <div class="well well-sm well-light">
        <div class="row">            
            <section class="col col-lg-12">                        
                <ul id="tabs1mantenimiento" class="nav nav-tabs bordered">
                    <li class="active">
                        <a href="#mantenimiento1" data-toggle="tab" aria-expanded="true">
                            EXPEDIENTE MANTENIMIENTO
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#mantenimiento2" data-toggle="tab" aria-expanded="false">
                           FOTOS
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>                            
                </ul>
            <div id="myTabContent1" class="tab-content padding-1"> 
                
                <div id="mantenimiento1" class="tab-pane fade active in">
                <section class="col col-lg-12">
                <div class="col-xs-12">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section style="padding-right: 0px">
                                <div class="col-xs-12">                                            
                                    <div>
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

                                                    <input type="hidden" id="id_gopi_mantenimiento" value="0">

                <div class="row">
                   <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div>
                                                                <label id="dlg_gopi_mantenimiento_dni_ejec" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">EJECUTOR &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_nomb_ejec"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>  

                                                        <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                        <div >
                                                                <label id="dlg_gopi_mantenimiento_dni_sup" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                    </div>
                
                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">SUPERVISOR &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_nomb_sup"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div> 

                                                        <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div >
                                                                <label id="dlg_gopi_mantenimiento_dni_res" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">RESIDENTE &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_nomb_res"  class="form-control" style="height: 32px;"></label>
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
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">CODIGO CATASTRAL &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_cod_cat"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div> 
                    
                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">HABILITACION URBANA &nbsp;<i class="fa fa-p"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_hab_urb"  class="form-control" style="height: 32px;"></label>
                </div>                

                                                            </div>
                                                        </div>
                                                    </div>
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                    <h2>Información del Mantenimiento::..</h2>
                        </header>
                    </div>
                </div> 
                <div class="row">

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">NOMBRE MANTENIMIENTO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_nomb_mant"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">TIPO MANTENIMIENTO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_tip_mant"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">MODALIDAD EJECUCION &nbsp;<i class="fa fa-users"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_mod_ejec"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">OBSERVACIONES &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_observ"  class="form-control" style="height: 32px;"></label>
                </div>
                
                                                            </div>
                                                        </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">INFORME TECNICO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_inf_tec"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">TIEMPO EJECUCION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_tiem_ejec"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">BENEFICIARIOS &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_bene"  class="form-control" style="height: 32px;"></label>
                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">FECHA INICIO &nbsp;<i class="fa fa-"></i></span>
                <div>
                                                                    <label id="dlg_gopi_mantenimiento_fec_ini"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">FECHA TERMINO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_fec_term"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">DESCRIPCION &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_descr"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">ESTADO MANTENIMIENTO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_est_mant"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">AVANCE FISICO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_av_fis"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">AVANCE FINANCIERO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_av_fin"  class="form-control" style="height: 32px;"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_mantenimientos();">
                                                <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
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
                
                <div id="mantenimiento2" class="tab-pane fade" style="height: auto">
                <section class="col col-lg-12">
                <div class="col-xs-12">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section style="padding-right: 10px">
                                <div class="col-xs-12">
                                    <div class="col-md-12 col-lg-12 hidden-xs">
                                        <div class="panel panel-success cr-panel-sep" style="border:0px; margin-top: 10px">
                                            <div class="panel-body cr-body">
                                                <div id="dlg_gopi_mantenimiento_fotos" style="padding-top: 0px; margin-top: 15px;"></div>
                                            </div>
                                        </div>
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
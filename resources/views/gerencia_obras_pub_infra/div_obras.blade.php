
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_obras_pub_infra/obras_publicas.js') }}"></script>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px;display: none;" id="dlg_gopi_obras">
    <div class="well well-sm well-light">
        <div class="row">            
            <section class="col col-lg-12">                        
                <ul id="tabs1obras" class="nav nav-tabs bordered">
                    <li class="active">
                        <a href="#obras1" data-toggle="tab" aria-expanded="true">
                            EXPEDIENTE MANTENIMIENTO
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#obras2" data-toggle="tab" aria-expanded="false">
                           FOTOS
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>                            
                </ul>
            <div id="myTabContent2" class="tab-content padding-1"> 
                
                <div id="obras1" class="tab-pane fade active in">
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

                                                    <input type="hidden" id="id_gopi_obra" value="0">

                 <div class="row">
                                                       <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div>
                                                                <label id="dlg_gopi_obra_dni_ejec" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">EJECUTOR &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_nomb_ejec"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>  

                                                        <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div >
                                                                <label id="dlg_gopi_obra_dni_sup" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">SUPERVISOR &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_nomb_sup"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>  

                                                        <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div >
                                                                <label id="dlg_gopi_obra_dni_res" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">RESIDENTE &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_nomb_res"  class="form-control" style="height: 32px;"></label>
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
                                                                    <label id="dlg_gopi_obra_cod_cat"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">HABILITACION URBANA &nbsp;<i class="fa fa-p"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_hab_urb"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                                                            <header>
                                                                    <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                    <h2>Información de la Obra::..</h2>
                                                            </header>
                                                        </div>
                                                    </div> 
                                                     <div class="row">

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">NOMBRE OBRA &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_obra_nomb_obra"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">TIPO OBRA &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_obra_tip_obra"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">MODALIDAD EJECUCION &nbsp;<i class="fa fa-users"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_mod_ejec"  class="form-control" style="height: 32px;"></label>
                </div>
                
                                                            </div>
                                                        </div>
           
                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">MONTO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_monto"  class="form-control" style="height: 32px;"></label>
            </div>
          
        </div>
    </div>

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">OBSERVACIONES &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_observaciones"  class="form-control" style="height: 32px;"></label>
</div> 

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">CODIGO SNIP &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_cod_snip"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">PERFIL &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_perfil"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">EXPEDIENTE TECNICO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_exp_tec"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">TIEMPO EJECUCION &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_tiem_ejec"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">BENEFICIARIOS &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_beneficiarios"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">FECHA INICIO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_fec_ini"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">FECHA TERMINO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_fec_term"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">DESCRIPCION &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_descripcion"  class="form-control" style="height: 32px;"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         
                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">ESTADO OBRA &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_est_obra"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                         
                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">AVANCE FISICO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_av_fis"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                         
                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">AVANCE FINANCIERO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_av_fin"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_obras();">
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
                
                <div id="obras2" class="tab-pane fade" style="height: auto">
                <section class="col col-lg-12">
                <div class="col-xs-12">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section style="padding-right: 10px">
                                <div class="col-xs-12">
                                    <div class="col-md-12 col-lg-12 hidden-xs">
                                        <div class="panel panel-success cr-panel-sep" style="border:0px; margin-top: 10px">
                                            <div class="panel-body cr-body">
                                                <div id="dlg_gopi_obra_fotos" style="padding-top: 0px; margin-top: 15px;"></div>
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
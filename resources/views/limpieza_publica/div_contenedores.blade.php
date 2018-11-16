
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/limpieza_publica/contenedores.js') }}"></script>
<div id="dlg_contenedores" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-8" style="padding: 0px">
            <section class="col-xs-12" style="padding: 0px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-map"></i> </span>
                            <h2>Ingresar Información ::..</h2>
                    </header>
                </div>
            </section>
           
           
            <div class="col-xs-12" style="padding-left: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Codigo de contendor &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                    <div class="icon-addon addon-md">
                        <input type="hidden" id="hidden_contenedor" value="0"/>
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cod_contenedor" type="text" disabled="" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px;  margin-top: 5px ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Cantidad de contendores &nbsp;&nbsp;<i class="fa fa-hashtag"></i></span>
                    <div class="icon-addon addon-md">
                        <input type="hidden" id="hidden_contenedor" value="0"/>
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cantidad_contenedor" type="text" disabled="">
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Ubicación de Contenedor &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_ubicacion_contendor" disabled="" >
                    </div>
                </div>
            </div>
            
            </div>
            <div class="col-xs-4" style="padding: 0px">
           
            <section class="col-xs-12" style="padding: 0px;">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 5px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-search"></i> </span>
                            <h2>Foto ::..</h2>
                    </header>
                </div>
            </section>
            <div  class="col-xs-12" id="foto_contenedor">
                    
             </div>
            </div>
            <section class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 5px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-search"></i> </span>
                            <h2>Observaciones ::..</h2>
                    </header>
                </div>
            </section>
    <div class="col-xs-12" id="cuerpo_obs_contenedores" style="margin-bottom: 10px; padding: 0px; background-color: white"></div>
        </div>
    </div>
</div>


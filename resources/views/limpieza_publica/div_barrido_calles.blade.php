
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/limpieza_publica/rutas_barrido.js') }}"></script>

<div id="dlg_ruta_barrido" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            
           
           
           
            <div class="col-xs-12" style="padding-left: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Codigo de Ruta &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                    <div class="icon-addon addon-md">
                        <input type="hidden" id="hidden_ruta" value="0"/>
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cod_ruta" type="text" maxlength="20" disabled="" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Descripción de Ruta &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_des_ruta" type="text" disabled="">
                    </div>
                </div>
            </div>
            
            <section class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 5px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                            <h2>Personal ::..</h2>
                    </header>
                </div>
            </section>
            
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <article class="col-xs-12" style=" padding: 0px !important">
                    <input id="del_token" data-token="{{ csrf_token() }}" type="hidden" />
                        <table id="table_rutas_personal_barrido"></table>
                        <div id="pager_table_rutas_personal_barrido"></div>
                </article>
            </div>
            <section class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 5px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-search"></i> </span>
                            <h2>Observaciones ::..</h2>
                    </header>
                </div>
            </section>
                <div class="col-xs-12" id="cuerpo_obs_barrido_mapa" style="margin-bottom: 10px; padding: 0px; background-color: white"></div>

        </div>
    </div>
</div>




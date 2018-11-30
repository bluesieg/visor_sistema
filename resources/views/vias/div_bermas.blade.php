
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/vias/bermas.js') }}"></script>

<div id="dlg_edit_berma" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            
            <section class="col-xs-12" style="padding: 0px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-map"></i> </span>
                            <h2>Información ::..</h2>
                    </header>
                </div>
            </section>
           
           
            <div class="col-xs-12" style="padding-left: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Codigo de Via &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                    <div class="icon-addon addon-md">
                        <input type="hidden" id="hidden_berma" value="0"/>
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cod_via_berma" type="text" maxlength="6" disabled="" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; ">
                
                <div class="tree smart-form" >
                    <ul >
                        <li >
                            <span style="width: 170px;">
                                <label class="checkbox inline-block" >
                                    <input type="checkbox" name="checkbox-inline" id="chk_derecha_berma" disabled=""/>
                                    <i></i>
                                    Lateral Derecha
                                </labe>
                            </span>
                        </li>
                        <li >
                            <span style="width: 170px;">
                                <label class="checkbox inline-block" >
                                    <input type="checkbox" name="checkbox-inline" id="chk_central_berma" disabled=""/>
                                    <i></i>
                                    Central
                                </labe>
                            </span>
                        </li>
                        <li >
                            <span style="width: 170px;">
                                <label class="checkbox inline-block" >
                                    <input type="checkbox" name="checkbox-inline" id="chk_izquierda_berma" disabled=""/>
                                    <i></i>
                                    Lateral Izquierda
                                </labe>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>


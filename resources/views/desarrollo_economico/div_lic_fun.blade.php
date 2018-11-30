
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/desarrollo_economico/lic_fun.js') }}"></script>
<div id="dlg_lic_fun" style="display: none;">
    <input type="hidden" id="hidden_dlg_lic_fun" value="0">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12" style="padding: 0px">
            <section class="col-xs-12" style="padding: 0px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-map"></i> </span>
                            <h2>Información ::..</h2>
                    </header>
                </div>
            </section>
           
                <div class="col-xs-4" style="padding-left: 0px;">
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">Sector &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                            <div class="icon-addon addon-md">
                                <input class="text-center col-xs-12 form-control"  style="height: 32px;" id="dlg_sec_lic_fun" type="text" disabled="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4" style="padding-left: 0px;">
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">Manzana &nbsp;&nbsp;<i class="fa fa-apple"></i></span>
                            <div class="icon-addon addon-md">
                                <input class="text-center form-control" style="height: 32px;" id="dlg_mzna_lic_fun" type="text"  disabled="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4" style="padding-left: 0px;">
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">Lotes &nbsp;<i class="fa fa-home"></i></span>
                            <div class="icon-addon addon-md">
                                <input class="text-center form-control" style="height: 32px;" id="dlg_lot_lic_fun" type="text"  disabled="" >
                                <input type="hidden" id="hidden_dlg_lot" value="0">
                            </div>
                        </div>
                    </div>
                
           
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">RUC &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                    <div class="icon-addon addon-md">
                        <input type="hidden" id="hidden_lic_fun" value="0"/>
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_ruc_lic_fun" type="text" disabled="" >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Empresa &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_empresa_lic_fun" type="text"  disabled="" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Ubicación &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_ubicacion_lic_fun" type="text"  disabled="" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Representante &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_representante_lic_fun" type="text"  disabled="" >
                    </div>
                </div>
            </div>
            <div class="col-xs-6" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Tipo Empresa &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <select class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_tip_emp_lic_fun"  disabled="" >
                            <option value="1">Privada</option>
                            <option value="2">Publica</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-6" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Cnt. Trabajadores &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cnt_tra_lic_fun" type="text"  disabled="" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Uso &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_uso_lic_fun" type="text"  disabled="" >
                        
                    </div>
                </div>
            </div>
            <div class="col-xs-4" style="padding-left: 0px; ">

                <div class="tree smart-form" >
                    <ul >
                        <li  >
                            <span style="width: 170px;">
                                <label class="checkbox inline-block" >
                                    <input type="checkbox" name="checkbox-inline" id="chk_lic_fun_123"/>
                                    <i></i>
                                   Licencia Aprobada
                                </labe>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-4" style="padding-left: 0px; ">

                <div class="tree smart-form" >
                    <ul >
                        <li >
                            <span style="width: 170px;">
                                <label class="checkbox inline-block" >
                                    <input type="checkbox" name="checkbox-inline" id="chk_itse" />
                                    <i></i>
                                    Autorización Itse
                                </labe>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-4" style="padding-left: 0px; ">

                <div class="tree smart-form" >
                    <ul >
                        <li >
                            <span style="width: 170px;">
                                <label class="checkbox inline-block" >
                                    <input type="checkbox" name="checkbox-inline" id="chk_letreros" />
                                    <i></i>
                                    Autorización Letreros
                                </labe>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            
            
          
            </div>
            <div class="col-xs-12" id="div_scaneos_lic_fun" style="padding: 0px; margin-top: 10px;display: none">
           
                <section class="col-xs-12" style="padding: 0px;">
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 5px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-search"></i> </span>
                                <h2>Documentos ::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-12" id="div_scaneos_linea">
                    
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
           
            <section class="col-xs-12" style="padding: 0px;">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 5px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-search"></i> </span>
                            <h2>Foto ::..</h2>
                    </header>
                </div>
            </section>
            <div  class="col-xs-12" id="foto_lic_fun">
                    
             </div>
            </div>
            
        </div>
    </div>
</div>



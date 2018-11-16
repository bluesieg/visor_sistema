
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/areas_verdes/areas_verdes.js') }}"></script>
<div id="dlg_areas_verdes" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12" style="padding: 0px">
            
           
                <div class="col-xs-3" style="padding-left: 0px;">
                        <div class="input-group input-group-md">
                            <input type="hidden" id="dlg_idpre" value="0">
                            <span class="input-group-addon">Sector &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                            <div class="icon-addon addon-md">
                                <input class="text-center col-xs-12 form-control"  style="height: 32px;" id="dlg_sec" type="text" disabled="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3" style="padding-left: 0px;">
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">Manzana &nbsp;&nbsp;<i class="fa fa-apple"></i></span>
                            <div class="icon-addon addon-md">
                                <input class="text-center form-control" style="height: 32px;" id="dlg_mzna" type="text"  disabled="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3" style="padding-left: 0px;">
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">Lotes &nbsp;<i class="fa fa-home"></i></span>
                            <div class="icon-addon addon-md">
                                <input class="text-center form-control" style="height: 32px;" id="dlg_lot" type="text"  disabled="" >
                                <input type="hidden" id="hidden_dlg_lot" value="0">
                            </div>
                        </div>
                    </div>
               
           
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Codigo de Area Verde &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                    <div class="icon-addon addon-md">
                        <input type="hidden" id="hidden_area_ver" value="0"/>
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cod_area_verde" type="text" disabled="" >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Ubicación de Area Verde &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_ubicacion_area_verde" type="text" disabled="">
                    </div>
                </div>
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
            <div  class="col-xs-12" id="foto_area_verde">
                    
             </div>
            </div>
            
        </div>
    </div>
</div>





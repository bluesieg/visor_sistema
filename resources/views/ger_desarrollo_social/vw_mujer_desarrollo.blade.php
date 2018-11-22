@extends('layouts.edu_cult_dep')
@section('content')

<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <div class="row">            
                    <section class="col col-lg-12">                        
                        <ul id="tabs1" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#s1" data-toggle="tab" aria-expanded="true" onclick="actualizar_grilla();">
                                    CIAM
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   DEMUNA
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s3" data-toggle="tab" aria-expanded="false">
                                   OMAPED
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>                               
                        </ul>
                    <div id="myTabContent1" class="tab-content padding-1"> 
                      <div id="s1" class="tab-pane fade active in">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                       <div class="col-xs-12">
                                        <h1><b>MANTENIMIENTO DE CIAM</b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE :. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_ciam" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_ciam();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_ciam();">
                                                     <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_ciam();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_ciam"></table>
                                                    <div id="pager_table_ciam"></div>
                                            </article>
                                        </div>                                        
                                       </div>                                         
                                    </section>                                    
                                </div>                                
                            </div>
                        </div>
                        </section>                        
                      </div>
                      <div id="s2" class="tab-pane fade ">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                       <div class="col-xs-12">
                                        <h1><b>MANTENIMIENTO DE DEMUNA</b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_demuna" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_demuna();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_demuna();">
                                                     <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_demuna();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_demuna"></table>
                                                    <div id="pager_table_demuna"></div>
                                            </article>
                                        </div>                                        
                                       </div>                                         
                                    </section>                                    
                                </div>                                
                            </div>
                        </div>
                        </section>                        
                      </div>
                      <div id="s3" class="tab-pane fade">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                       <div class="col-xs-12">
                                        <h1><b>MANTENIMIENTO DE OMAPED</b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE :. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_omaped" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_omaped();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_omaped();">
                                                     <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_omaped();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_omaped"></table>
                                                    <div id="pager_table_omaped"></div>
                                            </article>
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
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
  $(document).ready(function (){
       jQuery("#table_ciam").jqGrid({
            url: 'mujer_desarrollo_humano/0?grid=ciam',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_ciam','FECHA','COD CATASTRAL','DNI','PERSONA'],
            rowNum: 50, sortname: 'id_ciam', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO CIAM - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_ciam', index: 'id_ciam', hidden: true},
                {name: 'fecha', index: 'fecha', align: 'center', width: 150},
                {name: 'cod_catastral', index: 'cod_catastral', align: 'center', width: 150},
                {name: 'pers_nro_doc', index: 'pers_nro_doc', align: 'center', width: 150},
                {name: 'persona', index: 'persona', align: 'left', width: 600}
            ],
            pager: '#pager_table_ciam',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_ciam').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_ciam').jqGrid('getDataIDs')[0];
                            $("#table_ciam").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_ciam();}
        });
       jQuery("#table_demuna").jqGrid({
            url: 'mujer_desarrollo_humano/0?grid=demuna',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_demuna','FECHA','COD CATASTRAL','DNI','PERSONA'],
            rowNum: 50, sortname: 'id_demuna', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DEMUNA - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_demuna', index: 'id_demuna', hidden: true},
                {name: 'fecha', index: 'fecha', align: 'center', width: 150},
                {name: 'cod_catastral', index: 'cod_catastral', align: 'center', width: 150},
                {name: 'pers_nro_doc', index: 'pers_nro_doc', align: 'center', width: 150},
                {name: 'persona', index: 'persona', align: 'left', width: 600}
            ],
            pager: '#pager_table_demuna',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_demuna').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_demuna').jqGrid('getDataIDs')[0];
                            $("#table_demuna").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_demuna();}
        });
       jQuery("#table_omaped").jqGrid({
            url: 'mujer_desarrollo_humano/0?grid=omaped',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_omaped','FECHA','COD CATASTRAL','DNI','PERSONA'],
            rowNum: 50, sortname: 'id_omaped', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO OMAPED - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_omaped', index: 'id_omaped', hidden: true},
                {name: 'fecha', index: 'fecha', align: 'center', width: 150},
                {name: 'cod_catastral', index: 'cod_catastral', align: 'center', width: 150},
                {name: 'pers_nro_doc', index: 'pers_nro_doc', align: 'center', width: 150},
                {name: 'persona', index: 'persona', align: 'left', width: 600}
            ],
            pager: '#pager_table_omaped',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_omaped').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_omaped').jqGrid('getDataIDs')[0];
                            $("#table_omaped").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_omaped();}
        });
        
       jQuery("#table_observaciones_ciam").jqGrid({
            url: 'mujer_desarrollo_humano/0?grid=table_observaciones_ciam&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES CIAM', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_ciam',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_ciam').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_ciam').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_ciam").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion_ciam()}
        });   
        jQuery("#table_observaciones_demuna").jqGrid({
            url: 'mujer_desarrollo_humano/0?grid=table_observaciones_demuna&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES DEMUNA', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_demuna',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_demuna').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_demuna').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_demuna").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion_demuna()}
        });   
        jQuery("#table_observaciones_omaped").jqGrid({
            url: 'mujer_desarrollo_humano/0?grid=table_observaciones_omaped&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES COLEGIO', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_omaped',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_omaped').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_omaped').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_omaped").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion_omaped()}
        });   
        $("#dlg_buscar_ciam").keypress(function (e) {
            if (e.which == 13) {
                   buscar_ciam();
            }
        });
        $("#dlg_buscar_demuna").keypress(function (e) {
            if (e.which == 13) {
                   buscar_demuna();
            }
        });
        $("#dlg_buscar_omaped").keypress(function (e) {
            if (e.which == 13) {
                   buscar_omaped();
            }
        });
        
        $("#inp_dni_ciam").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_ciam").val(),"hidden_inp_persona_ciam","inp_nombre_ciam","inp_fechanac_ciam");
            }
        });
        $("#inp_dni_demuna").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_demuna").val(),"hidden_inp_persona_demuna","inp_nombre_demuna","inp_fechanac_demuna");
            }
        });
        $("#inp_dni_omaped").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_omaped").val(),"hidden_inp_persona_omaped","inp_nombre_omaped","inp_fechanac_omaped");
            }
        });
         
        
    });
</script>

@stop

<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/ciam.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/demuna.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/omaped.js') }}"></script>


<div id="dlg_nuevo_ciam" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_ciam" class="col-xs-12 cr-body" >            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <input id="hidden_id_ciam" name="hidden_inp_ciam" type="hidden" class="form-control" style="height: 30px;" >
                            <h2>Ingresar Información de Persona::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PERSONA: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_ciam" name="inp_dni_ciam" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_persona_ciam" name="hidden_inp_persona_ciam" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_nombre_ciam" name="inp_nombre_ciam" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FEC.NACIMIENTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="inp_fechanac_ciam" name="inp_fechanac_ciam"  data-mask="9999/99/99" class="form-control" style="height: 30px;" >
                    </div>
                </div>
            </div> 
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Ubicación::..</h2>
                    </header>
                </div>
            </section> 
             <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion_ciam" type="text" name="inp_direccion_ciam" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>  
             <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_ciam" name="hidden_id_lote_ciam" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_ciam" name="inp_cod_catastral_ciam" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_ciam();" style=" " >
               <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
           </button>           
           </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de locales::..</h2>
                    </header>
                </div>
            </section>                              
            <div class="col-xs-12" style="margin-top: 5px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">LOCAL: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_local_ciam' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">-- NO --</option>  
                            <option value="1">LOCAL 1</option>  
                            <option value="2">LOCAL 2</option> 
                        </select>                     
                    </div>
                </div>
            </div>               
            </div> 
             <div id="btn_agregar_ciam">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_ciam(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_ciam">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_ciam(4);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-edit"></i></span>Modificar Datos
            </button>
            </div>
           
          
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                                <h2>Observaciones ::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-10">
                    <table id="table_observaciones_ciam" ></table>
                    <div id="pager_table_observaciones_ciam"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_ciam();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_ciam();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_ciam();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>
<div id="dlg_nuevo_demuna" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_demuna" class="col-xs-12 cr-body" >            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <input id="hidden_id_demuna" name="hidden_inp_demuna" type="hidden" class="form-control" style="height: 30px;" >
                            <h2>Ingresar Información de Persona::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PERSONA: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_demuna" name="inp_dni_demuna" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_persona_demuna" name="hidden_inp_persona_demuna" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_nombre_demuna" name="inp_nombre_demuna" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FEC.NACIMIENTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="inp_fechanac_demuna" name="inp_fechanac_demuna" type="text" data-mask="9999/99/99" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div> 
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Ubicación::..</h2>
                    </header>
                </div>
            </section> 
             <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion_demuna" type="text" name="inp_direccion_demuna" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>  
             <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_demuna" name="hidden_id_lote_demuna" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_demuna" name="inp_cod_catastral_demuna" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_demuna();" style=" " >
               <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
           </button>                             
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de locales::..</h2>
                    </header>
                </div>
            </section>                              
            <div class="col-xs-12" style="margin-top: 5px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">ALBERGUE: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_albergue_demuna' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">-- NO --</option>  
                            <option value="1">LOCAL 1</option>  
                            <option value="2">LOCAL 2</option> 
                        </select>                     
                    </div>
                </div>
            </div> 
                <div class="col-xs-12" style="margin-top: 5px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COMISARIA: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_comisaria_demuna' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">-- NO --</option>  
                            <option value="1">COMISARIA 1</option>  
                            <option value="2">COMISARIA 2</option> 
                        </select>                     
                    </div>
                </div>
            </div> 
                <div class="col-xs-12" style="margin-top: 5px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">TIPO DELITO: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_tipo_delito_demuna' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">-- NO --</option>  
                            <option value="1">TIPO DELITO 1</option>  
                            <option value="2">TIPO DELITO 2</option> 
                        </select>                     
                    </div>
                </div>
            </div> 
            </div> 
             <div id="btn_agregar_demuna">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_demuna(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_demuna">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_demuna(4);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-edit"></i></span>Modificar Datos
            </button>
            </div>
           
          
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                                <h2>Observaciones ::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-10">
                    <table id="table_observaciones_demuna" ></table>
                    <div id="pager_table_observaciones_demuna"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_demuna();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_demuna();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_demuna();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>
<div id="dlg_nuevo_omaped" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_omaped" class="col-xs-12 cr-body" >            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <input id="hidden_id_omaped" name="hidden_inp_omaped" type="hidden" class="form-control" style="height: 30px;" >
                            <h2>Ingresar Información de Persona::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PERSONA: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_omaped" name="inp_dni_omaped" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_persona_omaped" name="hidden_inp_persona_omaped" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_nombre_omaped" name="inp_nombre_omaped" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FEC.NACIMIENTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="inp_fechanac_omaped" name="inp_fechanac_omaped" type="text" data-mask="9999/99/99"class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div> 
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Ubicación::..</h2>
                    </header>
                </div>
            </section> 
             <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion_omaped" type="text" name="inp_direccion_omaped" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>  
             <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_omaped" name="hidden_id_lote_omaped" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_omaped" name="inp_cod_catastral_omaped" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_omaped();" style=" " >
               <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
           </button>
            
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de locales::..</h2>
                    </header>
                </div>
            </section>                              
            <div class="col-xs-12" style="margin-top: 5px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">ALBERGUE: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_albergue_omaped' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">-- NO --</option>  
                            <option value="1">LOCAL 1</option>  
                            <option value="2">LOCAL 2</option> 
                        </select>                     
                    </div>
                </div>
            </div>
                <div class="col-xs-12" style="margin-top: 5px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">LOCAL: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_local_omaped' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">-- NO --</option>  
                            <option value="1">LOCAL 1</option>  
                            <option value="2">LOCAL 2</option> 
                        </select>                     
                    </div>
                </div>
            </div>  
                
            </div> 
             <div id="btn_agregar_omaped">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_omaped(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_omaped">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_omaped(4);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-edit"></i></span>Modificar Datos
            </button>
            </div>
           
          
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                                <h2>Observaciones ::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-10">
                    <table id="table_observaciones_omaped" ></table>
                    <div id="pager_table_observaciones_omaped"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_omaped();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_omaped();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_omaped();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>

<!--mapas-->
<div id="dlg_mapa_ciam" >
    <input type="hidden" id="hidden_input_habilitacion_ciam" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_ciam" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>
<div id="dlg_mapa_demuna" >
    <input type="hidden" id="hidden_input_habilitacion_demuna" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_demuna" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>
<div id="dlg_mapa_omaped" >
    <input type="hidden" id="hidden_input_habilitacion_omaped" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_omaped" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>

<!--obseeeeeeeeeeeeervaciones-->

<div id="dlg_nueva_observacion_ciam" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_ciam" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>
<div id="dlg_nueva_observacion_demuna" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_demuna" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>
<div id="dlg_nueva_observacion_omaped" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_omaped" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>

@include('vw_personas')
@endsection


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
                                    COLEGIOS
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   CENTROS CULTURALES
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s3" data-toggle="tab" aria-expanded="false">
                                   COMPLEJOS DEPORTIVOS
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
                                        <h1><b>MANTENIMIENTO DE COLEGIOS</b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE :. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_colegio" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE DEL COLEGIO">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_colegio();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div> 
                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_colegio();">
                                                     <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_colegio();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_colegios"></table>
                                                    <div id="pager_table_colegios"></div>
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
                                        <h1><b>MANTENIMIENTO DE CENTROS CULTURALES</b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_ccultural" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE DEL C.CULTURAL">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_ccultural();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_ccultural();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_ccultural();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_ccultural"></table>
                                                    <div id="pager_table_ccultural"></div>
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
                                        <h1><b>MANTENIMIENTO DE COMPLEJOS DEPORTIVOS</b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE COLEGIO:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_cdeportivo" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE DEL C. DEPORTIVO">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_cdeportivo();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_cdeportivo();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_cdeportivo();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_cdeportivo"></table>
                                                    <div id="pager_table_cdeportivo"></div>
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
        jQuery("#table_colegios").jqGrid({
            url: 'educacion_cultura_deporte/0?grid=colegios',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id','N°', 'DESCRIPCION'],
            rowNum: 50, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE COLEGIOS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id', index: 'id', hidden: true},
                {name: 'numero', index: 'numero', align: 'left', width: 30},
                {name: 'nombre', index: 'nombre', align: 'left', width: 100}
            ],
            pager: '#pager_table_colegios',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_colegios').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_colegios').jqGrid('getDataIDs')[0];
                            $("#table_colegios").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_colegio();}
        });
        jQuery("#table_ccultural").jqGrid({
            url: 'educacion_cultura_deporte/0?grid=ccultural',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_ccultural','COD CATASTRAL', 'DESCRIPCION','DIRECCIÓN'],
            rowNum: 50, sortname: 'id_ccultural', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE CENTROS CULTURALES - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_ccultural', index: 'id_ccultural', hidden: true},
                {name: 'cod_catastral', index: 'cod_catastral', align: 'left', width: 150},
                {name: 'nombre', index: 'nombre', align: 'left', width: 400},
                {name: 'direccion', index: 'direccion', align: 'left', width: 400}
            ],
            pager: '#pager_table_ccultural',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_ccultural').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_ccultural').jqGrid('getDataIDs')[0];
                            $("#table_ccultural").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_ccultural();}
        });
        jQuery("#table_cdeportivo").jqGrid({
            url: 'educacion_cultura_deporte/0?grid=cdeportivo',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_ccultural','COD CATASTRAL', 'DESCRIPCION','DIRECCIÓN'],
            rowNum: 50, sortname: 'id_cdeportivo', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE CENTROS DEPORTIVOS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_cdeportivo', index: 'V', hidden: true},
                {name: 'cod_catastral', index: 'cod_catastral', align: 'left', width: 150},
                {name: 'nombre', index: 'nombre', align: 'left', width: 400},
                {name: 'direccion', index: 'direccion', align: 'left', width: 400}
            ],
            pager: '#pager_table_cdeportivo',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_cdeportivo').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_cdeportivo').jqGrid('getDataIDs')[0];
                            $("#table_cdeportivo").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_colegio();}
        });
        jQuery("#table_observaciones_1").jqGrid({
            url: 'educacion_cultura_deporte/0?grid=table_observaciones_1&indice=0',
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
            pager: '#pager_table_observaciones_1',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_1').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_1').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_1").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion()}
        });         
        jQuery("#table_observaciones_2").jqGrid({
            url: 'educacion_cultura_deporte/0?grid=table_observaciones_2&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES CENTRO CULTURAL', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_2',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_2').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_2').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_2").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion()}
        });
        jQuery("#table_observaciones_3").jqGrid({
            url: 'educacion_cultura_deporte/0?grid=table_observaciones_3&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES CENTRO DEPORTIVO', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_3',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_3').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_3').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_3").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion()}
        });
        $("#dlg_buscar_colegio").keypress(function (e) {
            if (e.which == 13) {

                   buscar_colegio();

            }
        });
        $("#dlg_buscar_ccultural").keypress(function (e) {
            if (e.which == 13) {
                   buscar_ccultural();
            }
        });
        $("#dlg_buscar_cdeportivo").keypress(function (e) {
            if (e.which == 13) {
                   buscar_cdeportivo();
            }
        });
        
         $("#inp_dni_propietario").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_propietario").val(),"hidden_inp_propietario","inp_propietario");
            }
        });
        $("#inp_dni_propietario_ccultural").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_propietario_ccultural").val(),"hidden_inp_propietario_ccultural","inp_propietario_ccultural");              
            }
        });
         $("#inp_dni_propietario_cdeportivo").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_propietario_cdeportivo").val(),"hidden_inp_propietario_cdeportivo","inp_propietario_cdeportivo");              
            }
        });
         
        
    });
</script>

@stop

<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/colegios.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/ccultural.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/cdeportivo.js') }}"></script>


<div id="dlg_nuevo_colegio" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_adquiere" class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Colegio::..</h2>
                    </header>
                </div>
            </section>  
            <div class="col-xs-12" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_colegio" type="hidden" value="0" >
                        <input id="inp_nombre" name="inp_nombre" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="150" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top:5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion" type="text" name="inp_direccion" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>                        
            <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">N°. COLEGIO: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_nro_colegio" name="inp_nro_colegio" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 150px">N°. ALUMNOS: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_nro_alumnos" name="inp_nro_alumnos" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>            
           
            <div class="col-xs-4" style="margin-top: 10px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 150px">TIPO: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_tipo_colegio' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">--Seleccione tipo de colegio--</option>  
                            <option value="1">PUBLICO</option>  
                            <option value="2">PRIVADO</option>  


                        </select>                     
                    </div>
                </div>
            </div>                      
            </div>  
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Propietario::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-5" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PROPIETARIO: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_propietario" name="inp_dni_propietario" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-7" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">PROPIETARIO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_propietario" name="hidden_inp_propietario" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_propietario" name="inp_propietario" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de ubicación::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_colegio" name="hidden_id_lote_colegio" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_colegio" name="inp_cod_catastral_colegio" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
                <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_colegios();" style=" " >
                   <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
               </button>
            </div> 
             <div id="btn_agregar_colegio">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_colegio(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_colegio">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_colegio(4);" style="padding: 0px;margin-top: 10px ">
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
                    <table id="table_observaciones_1" ></table>
                    <div id="pager_table_observaciones_1"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_1();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_1();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_1();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>
<div id="dlg_nuevo_ccultural" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_adquiere" class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Centro Cultural::..</h2>
                    </header>
                </div>
            </section>  
            <div class="col-xs-12" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_ccultural" name="hidden_id_ccultural" type="hidden" class="form-control" style="height: 30px;" >
                        <input id="inp_nombre_ccultural" name="inp_nombre_ccultural" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="150" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top:5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion_ccultural" type="text" name="inp_direccion_ccultural" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>                        
            
            <div class="col-xs-12" style="margin-top: 10px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 180%">
                    <span class="input-group-addon" style="width: 180px">TIPO: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_tipo_ccultural' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">--Seleccione tipo de colegio--</option>  
                            <option value="1">PUBLICO</option>  
                            <option value="2">PRIVADO</option>  


                        </select>                     
                    </div>
                </div>
            </div>                      
            </div>  
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Propietario::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-5" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PROPIETARIO: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_propietario_ccultural" name="inp_dni_propietario_ccultural" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-7" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">PROPIETARIO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_propietario_ccultural" name="hidden_inp_propietario_ccultural" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_propietario_ccultural" name="inp_propietario_ccultural" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de ubicación::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_ccultural" name="hidden_id_lote_ccultural" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_ccultural" name="inp_cod_catastral_ccultural" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
                <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_ccultural();" style=" " >
                   <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
               </button>
            </div> 
             <div id="btn_agregar_ccultural">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_ccultural(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_ccultural">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_ccultural(4);" style="padding: 0px;margin-top: 10px ">
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
                    <table id="table_observaciones_2" ></table>
                    <div id="pager_table_observaciones_2"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_2();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_2();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_2();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>
<div id="dlg_nuevo_cdeportivo" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_adquiere" class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Centro Deportivo::..</h2>
                    </header>
                </div>
            </section>  
            <div class="col-xs-12" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_cdeportivo" name="hidden_id_cdeportivo" type="hidden" class="form-control" style="height: 30px;" >
                        <input id="inp_nombre_cdeportivo" name="inp_nombre_cdeportivo" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="150" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top:5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion_cdeportivo" type="text" name="inp_direccion_cdeportivo" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>                        
            
            <div class="col-xs-12" style="margin-top: 10px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 180%">
                    <span class="input-group-addon" style="width: 180px">TIPO: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_tipo_cdeportivo' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">--Seleccione tipo de colegio--</option>  
                            <option value="1">PUBLICO</option>  
                            <option value="2">PRIVADO</option>  


                        </select>                     
                    </div>
                </div>
            </div>                      
            </div>  
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Propietario::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-5" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PROPIETARIO: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_propietario_cdeportivo" name="inp_dni_propietario_cdeportivo" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-7" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">PROPIETARIO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_propietario_cdeportivo" name="hidden_inp_propietario__cdeportivo" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_propietario_cdeportivo" name="inp_propietario_cdeportivo" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de ubicación::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_cdeportivo" name="hidden_id_lote_cdeportivo" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_cdeportivo" name="inp_cod_catastral_cdeportivo" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
                <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_cdeportivo();" style=" " >
                   <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
               </button>
            </div> 
             <div id="btn_agregar_cdeportivo">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_cdeportivo(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_cdeportivo">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_cdeportivo(4);" style="padding: 0px;margin-top: 10px ">
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
                    <table id="table_observaciones_3" ></table>
                    <div id="pager_table_observaciones_3"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_3();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_3();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_3();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>


<!--colegiossssss-->
<div id="dlg_mapa_colegio" >
    <input type="hidden" id="hidden_input_habilitacion_colegio" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_colegio" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>
<!--CCULTURAL-->
<div id="dlg_mapa_ccultural" >
    <input type="hidden" id="hidden_input_habilitacion_ccultural" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_ccultural" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>
<!--DEPORTIVO-->
<div id="dlg_mapa_cdeportivo" >
    <input type="hidden" id="hidden_input_habilitacion_cdeportivo" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_cdeportivo" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>

<!--obseeeeeeeeeeeeervaciones-->

<div id="dlg_nueva_observacion_1" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_1" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>
<div id="dlg_nueva_observacion_2" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_2" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>
<div id="dlg_nueva_observacion_3" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_3" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>
@include('vw_personas')

@endsection

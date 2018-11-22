@extends('layouts.control_patrimonial')
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
                                    CONTROL PATRIMONIAL
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
                                        <h1><b>MANTENIMIENTO DE CONTROL PATRIMONIAL</b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">COD. PATRIMONIAL :. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_cpatrimonial" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR CÓDIGO PATRIMONIAL">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_cpatrimonial();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_cpatrimonial();">
                                                     <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_cpatrimonial();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_cpatrimonial"></table>
                                                    <div id="pager_table_cpatrimonial"></div>
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
       jQuery("#table_cpatrimonial").jqGrid({
            url: 'control_patrimonial/0?grid=cpatrimonial',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_cpatrimonial','FECHA','PARTIDA REG.','COD PATRIMONIAL','COD CATASTRAL','DNI','PERSONA'],
            rowNum: 50, sortname: 'id_cpatrimonial', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO CONTROL PATRIMONIAL - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_cpatrimonial', index: 'id_cpatrimonial', hidden: true},
                {name: 'fecha', index: 'fecha', align: 'center', width: 150},
                {name: 'partida_registral', index: 'partida_registral', align: 'center', width: 150},
                {name: 'cod_patrimonial', index: 'cod_patrimonial', align: 'center', width: 150},
                {name: 'cod_catastral', index: 'cod_catastral', align: 'center', width: 150},
                {name: 'pers_nro_doc', index: 'pers_nro_doc', align: 'center', width: 150},
                {name: 'persona', index: 'persona', align: 'left', width: 600}
            ],
            pager: '#pager_table_cpatrimonial',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_cpatrimonial').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_cpatrimonial').jqGrid('getDataIDs')[0];
                            $("#table_cpatrimonial").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_cpatrimonial();}
        });   
       jQuery("#table_observaciones_cpatrimonial").jqGrid({
            url: 'control_patrimonial/0?grid=table_observaciones_cpatrimonial&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES CONTROL PATRIMONIAL', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_cpatrimonial',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_cpatrimonial').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_cpatrimonial').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_cpatrimonial").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion_cpatrimonial()}
        });    
        $("#dlg_buscar_cpatrimonial").keypress(function (e) {
            if (e.which == 13) {
                   buscar_cpatrimonial();
            }
        });
        $("#inp_dni_cpatrimonial").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_cpatrimonial").val(),"hidden_inp_persona_cpatrimonial","inp_nombre_cpatrimonial","inp_fechanac_cpatrimonial");
            }
        });
        
    });
</script>

@stop

<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/ger_admin_finanzas/control_patrimonial.js') }}"></script>

<div id="dlg_nuevo_cpatrimonial" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_cpatrimonial" class="col-xs-12 cr-body" >            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <input id="hidden_id_cpatrimonial" name="hidden_id_cpatrimonial" type="hidden" class="form-control" style="height: 30px;" >
                            <h2>Ingresar Información General::..</h2>
                    </header>
                </div>
            </section>    
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">PARTIDA REGISTRAL: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_partida_registral" name="inp_partida_registral" type="text" class="form-control" style="height: 30px;" maxlength="10" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. PATRIMONIAL: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_cod_patrimonial" name="inp_cod_patrimonial" type="text" class="form-control" style="height: 30px;" maxlength="10" onkeypress="return soloNumeroTab(event);">
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
            <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_cpatrimonial" name="hidden_id_lote_cpatrimonial" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_cpatrimonial" name="inp_cod_catastral_cpatrimonial" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_cpatrimonial();" style=" " >
               <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
           </button>   
           <div class="col-xs-6" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. URBANO: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_cod_urbano" name="inp_cod_patrimonial" type="text" class="form-control" style="height: 30px;" maxlength="10" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div> 
            <div class="col-xs-6" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. DE NUMERACIÓN: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_cod_numeracion" name="inp_cod_patrimonial" type="text" class="form-control" style="height: 30px;" maxlength="10" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div> 
           </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Responsable::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PERSONA: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_cpatrimonial" name="inp_dni_cpatrimonial" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_persona_cpatrimonial" name="hidden_inp_persona_cpatrimonial" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_nombre_cpatrimonial" name="inp_nombre_cpatrimonial" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECCIÓN: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="inp_direccion_cpatrimonial" name="inp_direccion_cpatrimonial" type="text" class="form-control" style="height: 30px;" maxlength="250">
                    </div>
                </div>
            </div>
               
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Predio::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">N° EXPEDIENTE: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_num_expediente" name="inp_num_expediente" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-6" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">AÑO: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_anio" name="inp_anio" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            <div class="col-xs-6" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">SINABIF: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_sinabif" name="inp_sinabif" type="text" class="form-control" style="height: 30px;" maxlength="250"onkeypress="return soloNumeroTab(event);" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">REFERENCIA: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_referencia" name="inp_referencia" type="text" class="form-control" style="height: 30px;" maxlength="250" >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="margin-top: 5px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">USO: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_uso_cpatrimonial' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">-- SELECCIONE USO --</option>  
                            <option value="1">CASA HABITACIÓN</option>  
                            <option value="2">COMPLEJO DEPORTIVO</option> 
                        </select>                     
                    </div>
                </div>
            </div> 
            <div class="col-xs-6" style="margin-top: 5px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">ESTADO: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_estado_cpatrimonial' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">-- SELECCIONE ESTADO --</option>  
                            <option value="1">CASA HABITACIÓN</option>  
                            <option value="2">COMPLEJO DEPORTIVO</option> 
                        </select>                     
                    </div>
                </div>
            </div> 
            <div class="col-xs-6" style="margin-top: 5px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">SITUACIÓN: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_situacion_cpatrimonial' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">-- SELECCIONE SITUACIÓN --</option>  
                            <option value="1">MUY BUENO</option>  
                            <option value="2">BUENO</option> 
                            <option value="3">REGULAR</option> 
                            <option value="4">MALO</option> 
                            <option value="5">MUY MALO</option> 
                        </select>                     
                    </div>
                </div>
            </div> 
            <div class="col-xs-12" style="margin-top: 5px;padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">PROCESO: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <select id='sel_proceso_cpatrimonial' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">-- SELECCIONE PROCESO --</option>  
                            <option value="1">NO</option>  
                            <option value="2">EN TRAMITE</option> 
                            <option value="3">EN APROBACIÓN</option> 
                            <option value="4">APROBADO</option> 
                        </select>                     
                    </div>
                </div>
            </div> 
         
            </div> 
           
             <div id="btn_agregar_cpatrimonial">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_cpatrimonial(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_cpatrimonial">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_cpatrimonial(4);" style="padding: 0px;margin-top: 10px ">
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
                    <table id="table_observaciones_cpatrimonial" ></table>
                    <div id="pager_table_observaciones_cpatrimonial"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_cpatrimonial();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_cpatrimonial();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_cpatrimonial();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>


<!--mapas-->
<div id="dlg_mapa_cpatrimonial" >
    <input type="hidden" id="hidden_input_habilitacion_cpatrimonial" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_cpatrimonial" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>

<!--obseeeeeeeeeeeeervaciones-->

<div id="dlg_nueva_observacion_cpatrimonial" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_cpatrimonial" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>


@include('vw_personas')
@endsection


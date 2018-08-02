@extends('layouts.hab_urbana')
@section('content')
<style>
        
        .ol-touch .rotate-north {
            top: 80px;
        }
        .ol-mycontrol {
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 4px;
            padding: 2px;
            position: absolute;
            width:300px;
            top: 5px;
            left:40px;
        }
        #legend{
        right:10px; 
        top:20px; 
        z-index:10000; 
        width:130px; 
        height:370px; 
        background-color:#FFFFFF;
        display: none;
        }
    </style>
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <div class="row">                    
                    
                    <section class="col col-lg-12">
                        
                        <ul id="tabs1" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#s1" data-toggle="tab" aria-expanded="true">
                                    Reg. Expedientes
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="true" onclick="selecciona_fecha2();" >
                                  Verif. Administrativa
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s3" data-toggle="tab" aria-expanded="true" onclick="selecciona_fecha3();" >
                                  Crear Poligono
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s4" data-toggle="tab" aria-expanded="true" onclick="selecciona_fecha4();" >
                                  Verif. Técnica
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s5" data-toggle="tab" aria-expanded="true" >
                                  Crear Resolución
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
                                            
                                        <h1 ><b>REGISTRO DE EXPEDIENTES</b></h1>
                                        <div class="col-lg-3" style="padding-right: 0px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="dlg_fec_desde1" name="dlg_fec" type="text"  onchange="selecciona_fecha1();" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="dlg_fec_hasta1" name="dlg_fec" type="text" onchange="selecciona_fecha1();"  class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="text-right" style=" padding-top: 20px">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nuevo_exp_hab_urb();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                               </button>

                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_exp_hab_urb();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                                <button type="button" class="btn btn-labeled bg-color-orange txt-color-white" onclick="enviar_a_verif_administrativa();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-send"></i></span>Enviar
                                                </button>

                                           <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_exp_hab_urb();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                           </button>

                                           <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_expedientes_hab_urb"></table>
                                                        <div id="pager_table_expedientes_hab_urb"></div>
                                                </article>
                                            </div>


                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                                
                            </div>
                           </div>
                        </section>
                        
                      </div>
                      <div id="s2" class="tab-pane fade" style="height: auto">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 10px">
                                        <div class="col-xs-12">
                                            
                                    <h1 ><b>VERIFICACIÓN ADMINISTRATIVA</b></h1>
                                    <div class="text-right" style=" padding-top: 20px">
                                            <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_verificacion_admin(0);">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                            </button>
                                            <button type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="notificar_verif_admin();">
                                                <span class="btn-label"><i class="glyphicon glyphicon-file"></i></span>Notificar
                                            </button>
                                            <button type="button" class="btn btn-labeled bg-color-orange txt-color-white" onclick="enviar_a_crear_poligono();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-send"></i></span>Enviar
                                            </button>
                                            <button  type="button" class="btn btn-labeled btn-danger" onclick="enviar_a_improcedente_admin();">
                                                <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>Improcedente
                                            </button>  
                                            <button  type="button" class="btn btn-labeled btn-primary" onclick="crear_verificacion_admin(1);">
                                               <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>Regularizar
                                            </button> 
                                       </div>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="dlg_fec_desde2" name="dlg_fec" onchange="selecciona_fecha2();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="dlg_fec_hasta2" name="dlg_fec" onchange="selecciona_fecha2();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_verificacion_admin"></table>
                                                    <div id="pager_table_verificacion_admin"></div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        </div> 
                        <div id="s3" class="tab-pane fade" style="height: auto">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 10px">
                                        <div class="col-xs-12">
                                            
                                    <h1 ><b>CREAR POLÍGONO</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="dlg_fec_desde3" name="dlg_fec" onchange="selecciona_fecha3();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="dlg_fec_hasta3" name="dlg_fec" onchange="selecciona_fecha3();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                        
                                       <div class="text-right" style=" padding-top: 20px">
                                                <button type="button" class="btn btn-labeled bg-color-orange txt-color-white" onclick="aprobar_poligono();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Aprobar
                                                </button>
                                                
                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_crear_poligono"></table>
                                                    <div id="pager_table_crear_poligono"></div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        </div> 
                         <div id="s4" class="tab-pane fade" style="height: auto">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 10px">
                                        <div class="col-xs-12">
                                            
                                    <h1 ><b>VERIFICACIÓN TÉCNICA</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="dlg_fec_desde4" name="dlg_fec" onchange="selecciona_fecha4();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="dlg_fec_hasta4" name="dlg_fec" onchange="selecciona_fecha4();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                        
                                       <div class="text-right" style=" padding-top: 20px">
                                            <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_verificacion_tecnica();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                            </button>
                                            <button type="button" class="btn btn-labeled bg-color-orange txt-color-white" onclick="enviar_a_aprobados();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Aprobar
                                            </button>
                                            <button type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="notificar_verif_tecnica();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-bell"></i></span>Notificar
                                            </button>
                                            <button  type="button" class="btn btn-labeled btn-danger" onclick="enviar_a_improcedente();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>Improcedente
                                            </button> 
                                           
                                       </div>
                                       </div>
                                        
                                    </section>
                                    
                                </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_verif_tecnica"></table>
                                                    <div id="pager_table_verif_tecnica"></div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        </div> 
                        <div id="s5" class="tab-pane fade" style="height: auto">
                            <section class="col col-lg-12">
                                <div class="col-xs-12">               
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style='padding: 0px'>
                                            <section style="padding-right: 10px">
                                                <div class="col-xs-12" style='padding: 0px'>
                                                     <h1 ><b>CREAR RESOLUCIÓN</b></h1>
                                                    <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; padding-left: 0px ">
                                                       <div class="input-group input-group-md">
                                                           <span class="input-group-addon">Desde:</span>
                                                           <div class="icon-addon addon-md">
                                                                <input  id="dlg_fec_desde5" name="dlg_fec" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                           </div> 
                                                       </div>
                                                    </div>
                                                    <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                                        <div class="input-group input-group-md">
                                                            <span class="input-group-addon">Hasta:</span>
                                                            <div class="icon-addon addon-md">
                                                                <input id="dlg_fec_hasta5" name="dlg_fec" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                                        <button  type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="busqueda_escaneo_hab_urb();">
                                                            <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                                                        </button>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px; ">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_escaneos"></table>
                                                    <div id="pager_table_escaneos"></div>
                                            </article>
                                        </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px; ">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_doc"></table>
                                                    <div id="pager_table_doc"></div>
                                            </article>
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
<script src="js/plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function (){
        $("#menu_fisca").show();
        $("#li_fisca_carta").addClass('cr-active')
        fecha_desde1 = $("#dlg_fec_desde1").val(); 
        fecha_hasta1 = $("#dlg_fec_hasta1").val(); 
        jQuery("#table_expedientes_hab_urb").jqGrid({
            url: 'getExpedientesHabUrb?fecha_desde='+fecha_desde1 +'&fecha_hasta='+fecha_hasta1,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'NRO. EXPEDIENTE', 'FASE', 'GESTOR DEL TRAMITE','FECHA INICIO','FECHA REGISTRO'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 10},
                {name: 'fase', index: 'fase', align: 'left', width: 10},
                {name: 'gestor', index: 'gestor', align: 'left', width: 40},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 20},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 15}
            ],
            pager: '#pager_table_expedientes_hab_urb',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_expedientes_hab_urb').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_expedientes_hab_urb').jqGrid('getDataIDs')[0];
                            $("#table_expedientes_hab_urb").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){actualizar_exp_hab_urb();}
        });
        
        
        fecha_desde = $("#dlg_fec_desde2").val(); 
        fecha_hasta = $("#dlg_fec_hasta2").val(); 
       
        jQuery("#table_verificacion_admin").jqGrid({
            url: 'getExpedientesVerif?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'NRO. EXPEDIENTE', 'FASE', 'GESTOR DEL TRAMITE','FECHA INICIO','FECHA REGISTRO','NOTIFICAR'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 100},
                {name: 'fase', index: 'fase', align: 'left', width: 80},
                {name: 'gestor', index: 'gestor', align: 'left', width: 320},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 200},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 150},
                {name: 'btn', index: 'btn', align: 'left', width: 160}
            ],
            pager: '#pager_table_verificacion_admin',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_verificacion_admin').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_verificacion_admin').jqGrid('getDataIDs')[0];
                            $("#table_verificacion_admin").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
        });
        
        jQuery("#table_requisitos").jqGrid({
            url: 'getRequisitos?id='+$('#select_requisito').val(),
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'REQUISITOS', 'ESTADO'],
            rowNum: 200, sortname: 'id_requisito', sortorder: 'desc', viewrecords: true, caption: 'REQUISITOS', align: "center",
            colModel: [
                {name: 'id_requisito', index: 'id_requisito', align: 'left', width: 40},
                {name: 'desc_requisito', index: 'desc_requisito', align: 'left', width: 620},
                {name: 'estado', index: 'estado', align: 'left', width: 80},
            ],
            pager: '#pager_table_requisitos',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_requisitos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_requisitos').jqGrid('getDataIDs')[0];
                            $("#table_requisitos").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            
        });
        
        fecha_desde = $("#dlg_fec_desde3").val(); 
        fecha_hasta = $("#dlg_fec_hasta3").val(); 
       
        jQuery("#table_crear_poligono").jqGrid({
            url: 'getCrearPoligono?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'NRO. EXPEDIENTE', 'FASE', 'GESTOR DEL TRAMITE','FECHA INICIO','FECHA REGISTRO'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 100},
                {name: 'fase', index: 'fase', align: 'left', width: 100},
                {name: 'gestor', index: 'gestor', align: 'left', width: 400},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 200},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 150}
            ],
            pager: '#pager_table_crear_poligono',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_crear_poligono').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_crear_poligono').jqGrid('getDataIDs')[0];
                            $("#table_crear_poligono").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){actualizar_exp_hab_urb();}
        });
        
        fecha_desde = $("#dlg_fec_desde4").val(); 
        fecha_hasta = $("#dlg_fec_hasta4").val(); 
       
        jQuery("#table_verif_tecnica").jqGrid({
            url: 'getVerifTecnica?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'NRO. EXPEDIENTE', 'FASE', 'GESTOR DEL TRAMITE','FECHA INICIO','FECHA REGISTRO','NOTIFICAR'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 100},
                {name: 'fase', index: 'fase', align: 'left', width: 100},
                {name: 'gestor', index: 'gestor', align: 'left', width: 400},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 120},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 120},
                {name: 'btn', index: 'btn', align: 'left', width: 150}
            ],
            pager: '#pager_table_verif_tecnica',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_verif_tecnica').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_verif_tecnica').jqGrid('getDataIDs')[0];
                            $("#table_verif_tecnica").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            
        });
        fecha_desde = $("#dlg_fec_desde5").val(); 
        fecha_hasta = $("#dlg_fec_hasta5").val(); 
        jQuery("#table_escaneos").jqGrid({
            url: 'get_expedientes_resolucion_hab_urb?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'NRO. EXPEDIENTE',  'GESTOR DEL TRAMITE','FECHA INICIO','SUBIR'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 100},
                
                {name: 'gestor', index: 'gestor', align: 'left', width: 400},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 200},
                {name: 'btn', index: 'btn', align: 'left', width: 160},
            ],
            pager: '#pager_table_escaneos',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_escaneos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                        var firstid = jQuery('#table_escaneos').jqGrid('getDataIDs')[0];
                            $("#table_escaneos").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id)
            {
                jQuery("#table_doc").jqGrid('setGridParam', {url: 'cargar_documetos?&id='+Id}).trigger('reloadGrid');
            },
            ondblClickRow: function (Id){}
        });
        jQuery("#table_doc").jqGrid({
            url: '',
            datatype: 'json', mtype: 'GET',
            height: '200px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_doc_adj', 'Documento', 'Descripcion','Ver','Eliminar'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'DOCUMENTOS ESCANEADOS', align: "center",
            colModel: [
                {name: 'id_doc_adj', index: 'id_doc_adj', hidden: true},
                {name: 't_documento', index: 't_documento', align: 'center', width: 250},
                {name: 'descripcion', index: 'descripcion', align: 'left', width: 400},
                {name: 'ver', index: 'ver', align: 'center', width: 160},
                {name: 'del', index: 'del', align: 'center', width: 150},
            ],
            pager: '#pager_table_doc',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_doc').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                        var firstid = jQuery('#table_doc').jqGrid('getDataIDs')[0];
                            $("#table_doc").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        
        
        
        
        
       
    });
function autocompletar_haburb(textbox){
    $.ajax({
        type: 'GET',
        url: 'autocomplete_hab_urba',
        success: function (data) {
            var $datos = data;
            $("#"+ textbox).autocomplete({
                source: $datos,
                focus: function (event, ui) {
                    $("#" + textbox).val(ui.item.label);
                    $("#hidden_"+ textbox).val(ui.item.value);
                    $("#" + textbox).attr('maxlength', ui.item.label.length);
                    return false;
                },
                select: function (event, ui) {
                    $("#" + textbox).val(ui.item.label);
                    $("#hidden_"+ textbox).val(ui.item.value);
                    
                    return false;
                }
            });
        }
    });
}
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/hab_urbana/registro_expendientes_hab_urb.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/hab_urbana/verificacion_admin.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/hab_urbana/crear_poligono.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/hab_urbana/escaneo_hab_urb.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/hab_urbana/verificacion_tecnica.js') }}"></script>

<div id="dlg_nuevo_exp" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Cod. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_cod_exp" type="text" class="form-control" style="height: 30px;" maxlength="20">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dlg_nuevo_exp_edit" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 150px">Nro. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="nro_expediente" type="text" class="form-control" style="height: 30px;" maxlength="20">
                        </div>
                    </div>
                    
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 150px">Gestor del Tramite: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="gestor_tramite" type="text" class="form-control" style="height: 30px;" maxlength="100">
                        </div>
                    </div>
                    
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 150px">Fecha Inicio: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="fecha_inicio" type="text"  class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                    
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 150px">Fecha Registro: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="fecha_registro" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dlg_nuevo_verificacion_admin" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Cod. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input type="hidden"id="hidden_id_expediente" value="0"/>
                            <input id="inp_nro_exp" type="text" class="form-control" style="height: 30px;" disabled="" >
                        </div>
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Gestor: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_gestor" type="text" class="form-control" style="height: 30px;"  disabled="">
                        </div>
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Fecha inicio: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_fecha_inicio_tramite" type="text" class="form-control" style="height: 30px;"  disabled="">
                        </div>
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Procedimientos: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <select id='select_requisito' class="form-control col-lg-8" style="height: 30px; " onchange="seleccionar_requisito()"> 
                           @foreach ($procedimiento as $tip)
                           <option value='{{$tip->id_procedimiento}}' >{{$tip->descr_procedimiento}}</option>
                           @endforeach
                        </select> 
                    </div>
                   
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <article class="col-xs-11" style=" padding: 0px !important">
                            <table id="table_requisitos"></table>
                            <div id="pager_table_requisitos"></div>
                    </article>
                </div>
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Observaciones: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <textarea id="inp_observacion" type="text" class="form-control" style="height: 65px;"  ></textarea>
                        </div>
                    </div>
                    
                   
                </div>
                  
            </div>
        </div> 
    </div>
   
</div>
<div id="dlg_nuevo_verificacion_tecnica" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
         <form id="FormularioScans1" name="FormularioScans1" method="post" enctype="multipart/form-data"  >
                <input type="hidden" name="_token" id="_token2" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}"> 
                <input type="hidden" value='0' id='id_scan1' name="id_scan1"/>
                <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Cod. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input type="hidden"id="hidden_id_expediente_tec" name="hidden_id_expediente_tec" value="0"/>
                            <input id="inp_nro_exp_tec" name="inp_nro_exp_tec" type="text" class="form-control" style="height: 30px;" disabled="" >
                        </div>
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Encargado: &nbsp;<i class="fa fa-user"></i></span>
                        <select id='select_encargado' name="select_encargado" class="form-control col-lg-8" style="height: 30px; " onchange="seleccionar_requisito()"> 
                           @foreach ($encargado as $tip)
                           <option value='{{$tip->id_encargado}}' >{{$tip->descripcion}}</option>
                           @endforeach
                        </select> 
                    </div>
                <div class="col-xs-12" style="padding: 0px; padding-top: 10px ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Documento &nbsp;<i class="fa fa-file-archive-o"></i></span>
                        <div>
                            <input name="dlg_documento_file1" id="dlg_documento_file1" type="file"  class="form-control" style="height: 32px; width: 100%" >
                        </div>
                    </div>
                </div>
            </form>
           
        </div> 
    </div>
   
</div>
<div id="dlg_notificacion_admin" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_adquiere" class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <textarea name="ckeditor" id="ckeditor" >
                
                </textarea> 
            </div>
        </div>
    </div>
</div> 
<div id="dlg_notificacion_tecnica" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_adquiere" class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <textarea name="ckeditor1" id="ckeditor1" >
                   
                </textarea> 
            </div>
        </div>
    </div>
</div> 
<div id="dlg_subir_escaneo" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <form id="FormularioScans" name="FormularioScans" method="post" enctype="multipart/form-data" action="callpdf"  target="ifrafile">
                <input type="hidden" name="_token" id="_token1" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}"> 
                <input type="hidden" value='0' id='id_scan' name="id_scan"/>
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon"  style="width: 165px" >Tipo Documento &nbsp;<i class="fa fa-file"></i></span>
                        <div class="icon-addon addon-md">
                            <select id='seltipdoc' name="seltipdoc" class="form-control col-lg-8" style="height: 32px;">
                            @foreach ($tip_doc as $docs)
                            <option value='{{$docs->id_tip_doc}}' >{{$docs->t_documento}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; padding-top: 10px ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Documento &nbsp;<i class="fa fa-file-archive-o"></i></span>
                        <div>
                            <input name="dlg_documento_file" id="dlg_documento_file" type="file"  class="form-control" style="height: 32px; width: 100%" onchange="llamarsubmitscan();">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; padding-top: 10px ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Descripción &nbsp;<i class="fa fa-text-height"></i></span>
                        <div>
                            <input name="dlg_documento_des" id="dlg_documento_des" type="text"  class="form-control" style="height: 32px; width: 100%">
                        </div>
                    </div>
                </div>
                
            </form>
            <div id="dlg_sub_frame" class='cr_content col-xs-12 ' style="margin-bottom: 10px; padding-top: 10px ">
                <iframe name="ifrafile" id="ifrafile" class="form-control col-xs-12"  style=" height: 400px; padding: 0px"></iframe>
            </div>
    </div>
    </div>
</div>
<div id="dlg_aprobar_poligono" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Cod. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_cod_exp_poli" type="text" class="form-control" style="height: 30px;" disabled="">
                        </div>
                    </div> 
                    <div class="input-group input-group-md" style="width: 100% ;padding-top: 10px;">
                        <span class="input-group-addon" style="width: 150px">Habilitación Urbana &nbsp;<i class="fa fa-hashtag"></i></span>
                        <input type="hidden" id="hidden_inp_hab_urb_poligono" value="0">
                        <div>
                            <input id="inp_hab_urb_poligono" type="text" class="form-control" style="height: 30px;" placeholder="Escriba una Habilitación Urbana">
                        </div>
                    </div>
                     
                </div>
                <div class="col-xs-12" style="padding-top: 10px; ">
                                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


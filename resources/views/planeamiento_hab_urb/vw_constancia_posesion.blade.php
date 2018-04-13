@extends('layouts.map')
@section('content')
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
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   Reg. Datos Lote
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s3" data-toggle="tab" aria-expanded="false" onclick="grilla_control_calidad();">
                                   Control Calidad
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s4" data-toggle="tab" aria-expanded="false">
                                   Inspeccion de Campo
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   Verif. Tecnica
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   Vistos Legales
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   Visto y Firma
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   Firma Gerencia
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   Entrega Constancias
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
                                                   <input  id="dlg_fec_desde" name="dlg_fec" type="text"  onchange="selecciona_fecha();" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="dlg_fec_hasta" name="dlg_fec" type="text" onchange="selecciona_fecha();"  class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="text-right" style=" padding-top: 20px">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nuevo_exp();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                               </button>

                                               <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_exp();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                               </button>

                                           <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_exp();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                           </button>

                                           <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_expedientes"></table>
                                                        <div id="pager_table_expedientes"></div>
                                                </article>
                                            </div>


                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                    <article class="col-xs-11" style=" padding: 0px !important">
                                            <table id="table_expedientes"></table>
                                            <div id="pager_table_expedientes"></div>
                                    </article>
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
                                            
                                    <h1 ><b>REGISTRO DE DATOS DEL LOTE</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                               <input  id="fec_ini_datos_lote" name="dlg_fec" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                <input id="fec_fin_datos_lote" name="dlg_fec" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="text-right" style=" padding-top: 20px">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_reg_datos_lote();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                               </button>

                                               <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_datos_lote();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                               </button>

                                           <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_datos_lote();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                           </button>


                                       </div>
                                        </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_datos_predio"></table>
                                                    <div id="pager_table_datos_predio"></div>
                                            </article>
                                        </div>
                                    </section>
                                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                        <article class="col-xs-11" style=" padding: 0px !important">
                                                <table id="table_expedientes"></table>
                                                <div id="pager_table_expedientes"></div>
                                        </article>
                                    </div>
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
                                            
                                    <h1 ><b>CONTROL DE CALIDAD</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                               <input  id="dlg_fecha_desde_cc" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div> 
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                <input id="dlg_fecha_hasta_cc" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                       
                                               <div class="icon-addon addon-md">
                                                   <input type="checkbox" id="dlg_ver_expediente" onclick="check_cambiar_estado('#dlg_ver_expediente')" style="width:22px;height:22px">VER EXPEDIENTES CON NOTIFICACION
                                               </div>
                                           </div>
                                       </div>
                                        
                                       <div class="text-right" style=" padding-top: 20px">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nueva_notificacion();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Reg. Notificacion
                                               </button>

                                               <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="pasar_inspeccion();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Pasar a Inspeccion
                                               </button>

                                       </div>
                                        <div class="col-lg-4" style="margin-top: 10px;">
                                            <label>Inspector:</label>
                                            <label class="select">
                                                <select id="select_inspector" class="input-sm">
                                                    @foreach ($inspectores as $inspector)
                                                        <option value='{{$inspector->id_inspector}}' >{{$inspector->apenom}}</option>
                                                    @endforeach
                                                </select><i></i>
                                            </label>
                                        </div>
                                        </div>
                                    </section>
                                    <div class="col-xs-12">
                                        <article class="col-xs-12" style=" padding: 0px !important">
                                                <table id="table_control_calidad"></table>
                                                <div id="pager_table_control_calidad"></div>
                                        </article>
                                    </div>
                                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                        <article class="col-xs-12" style=" padding-top: 0px !important">
                                                <table id="table_inspeccion"></table>
                                                <div id="pager_table_inspeccion"></div>
                                        </article>
                                    </div>
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
        $("#menu_fisca").show();
        $("#li_fisca_carta").addClass('cr-active')
        fecha_desde = $("#dlg_fec_desde").val(); 
        fecha_hasta = $("#dlg_fec_hasta").val(); 
        jQuery("#table_expedientes").jqGrid({
            url: 'getExpedientes?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta,
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
            pager: '#pager_table_expedientes',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_expedientes').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_expedientes').jqGrid('getDataIDs')[0];
                            $("#table_expedientes").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){actualizar_exp();}
        });
        jQuery("#table_datos_predio").jqGrid({
            url: 'datos_predio?grid=1',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'AÑO', 'N° EXPEDIENTE', 'GESTOR DEL TRAMITE','HAB.URB','FECHA INICIO'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'anio', index: 'anio', align: 'center', width: 100},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'center', width: 100},
                {name: 'gestor', index: 'gestor', align: 'center', width: 100},
                {name: 'gestor', index: 'gestor', align: 'center', width: 100},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'center', width: 100}
            ],
            pager: '#pager_table_datos_predio',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_datos_predio').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_datos_predio').jqGrid('getDataIDs')[0];
                            $("#table_datos_predio").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){fn_new_carta(Id);}
        });
        $("#inp_cod_exp_lote").keypress(function (e) {
            if (e.which == 13) {
                traer_cod_expediente();
            }
        });
        
       
    });
</script>
@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/registro_expendientes.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/control_calidad.js') }}"></script>
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
<div id="dlg_nuevo_reg_datos_lote" style="display: none;">
    
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Cod. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input type="hidden"id="hidden_inp_cod_exp_lote" value="0"/>
                            <input id="inp_cod_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="20" >
                        </div>
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Posesionario: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_posesionario_exp_lote" type="text" class="form-control" style="height: 30px;"  disabled="">
                        </div>
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Sector: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_sector_exp_lote" type="text" class="form-control" style="height: 30px;"  >
                        </div>
                        
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        
                        <span class="input-group-addon" style="width: 180px">Zona: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div> 
                             <input type="hidden" id="hidden_inp_zona_exp_lote" value="0">
                             <input  id="inp_zona_exp_lote" type="text" placeholder="Escriba una Habilitación Urbana" class="form-control" style="height: 32px; padding-left: 10px"  >
                       </div>
                        
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Super Manzana: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_super_mzna_exp_lote" type="text" class="form-control" style="height: 30px;" >
                        </div>
                        <span class="input-group-addon" style="width: 180px">Manzana: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_mzna_exp_lote" type="text" class="form-control" style="height: 30px;" >
                        </div>
                        
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Lote: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_lote_exp_lote" type="text" class="form-control" style="height: 30px;" >
                        </div>
                        <span class="input-group-addon" style="width: 180px">Sub Lote: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_sub_lote_exp_lote" type="text" class="form-control" style="height: 30px;" >
                        </div>                        
                    </div>
                    
                </div>
                
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Año inicio de Posesión: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_anio_ini_exp_lote" type="text" class="form-control" style="height: 30px;"  maxlength="4" onkeypress="return soloNumeroTab(event);">
                        </div>
                        <span class="input-group-addon" style="width: 180px">Area: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_area_exp_lote" type="text" class="form-control" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                        </div>
                    </div>
                </div>     
            </div>
        </div> 
    </div>
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">                
                
                <input type="hidden" id="id_expediente" value="0">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Por el Frente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_frente_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="100">
                        </div>
                        <span class="input-group-addon" style="width: 180px">Con: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_con_frente_exp_lote" type="text" class="form-control" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                        </div>
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Por Costado Derecho: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_derecho_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="100" >
                        </div>
                        <span class="input-group-addon" style="width: 180px">Con: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_con_derecho_exp_lote" type="text" class="form-control" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                        </div>
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Por Costado Izquierdo: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_izquierdo_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="100">
                        </div>
                        <span class="input-group-addon" style="width: 180px">Con: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_con_izquierdo_exp_lote" type="text" class="form-control" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                        </div>
                    </div>
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Por el Fondo: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_fondo_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="100">
                        </div>
                        <span class="input-group-addon" style="width: 180px">Con: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_con_fondo_exp_lote" type="text" class="form-control" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
     <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">         
                <input type="hidden" id="id_expediente" value="0">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 180px">Tipo de Solicitud: &nbsp;<i class="fa fa-hashtag"></i></span>
                             <select id='select_tip_sol_exp_lote' class="form-control col-lg-8" style="height: 32px; width: 90%" onchange="callfilltab()"> 
                                @foreach ($tip_sol as $tip)
                                <option value='{{$tip->id}}' >{{$tip->tipo}}</option>
                                @endforeach
                             </select> 
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>

<div id="dlg_registrar_notificacion" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Notificacion: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="hidden_id" type="hidden">
                            <input id="inp_reg_noti" type="text" class="form-control" style="height: 30px;" maxlength="50">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


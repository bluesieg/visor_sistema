@extends('layouts.planeamiento_hab_urb')
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
                                <a href="#s2" data-toggle="tab" aria-expanded="false" onclick="selecciona_fecha_datos_lote();">
                                   Reg. Datos Lote
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s3" data-toggle="tab" aria-expanded="false" onclick="selecciona_fecha_cc();">
                                   Control Calidad
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s4" data-toggle="tab" aria-expanded="false" onclick="selecciona_fecha_insp_campo();">
                                   Inspeccion de Campo
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s5" data-toggle="tab" aria-expanded="false" onclick="selecciona_fecha_eva_t();">
                                   Verif. Tecnica
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s6" data-toggle="tab" aria-expanded="false" onclick="selecciona_visto_legal();">
                                   Vistos Legales
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s7" data-toggle="tab" aria-expanded="false" onclick="selecciona_visto_firma();">
                                   Visto y Firma
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s8" data-toggle="tab" aria-expanded="false" onclick="selecciona_entregar_constancia();">
                                   Entrega Constancias
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s9" data-toggle="tab" aria-expanded="false">
                                   Escaneo Documentos
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
                                                   <input  id="fec_ini_datos_lote" name="dlg_fec" onchange="selecciona_fecha_datos_lote();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="fec_fin_datos_lote" name="dlg_fec" onchange="selecciona_fecha_datos_lote();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
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
                                        
                                    </section>
                                    
                                </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_datos_predio"></table>
                                                    <div id="pager_table_datos_predio"></div>
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
                                            
                                    <h1 ><b>CONTROL DE CALIDAD</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="dlg_fecha_desde_cc" type="text"  onchange="selecciona_fecha_cc();" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div> 
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="dlg_fecha_hasta_cc" type="text"  onchange="selecciona_fecha_cc();" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                       
                                               <div class="icon-addon addon-md">
                                                   <input type="checkbox" id="dlg_ver_expediente" onclick="check_cambiar_estado('#dlg_ver_expediente')" style="width:22px;height:22px">NOTIFICADOS
                                               </div>
                                           </div>
                                       </div>
                                        
                                       <div class="text-right" style=" padding-top: 20px">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nueva_notificacion();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Notificacion
                                               </button>

                                               <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="pasar_inspeccion();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Inspeccion
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
                        
                        
                        <div id="s4" class="tab-pane fade" style="height: auto">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 10px">
                                        <div class="col-xs-12">
                                            
                                    <h1 ><b>INSPECCION DE CAMPO</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="fec_ini_ins_campo" name="dlg_fec" onchange="selecciona_fecha_insp_campo();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="fec_fin_ins_campo" name="dlg_fec" onchange="selecciona_fecha_insp_campo();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="text-right" style=" padding-top: 20px">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_ins_campo();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                               </button>

                                               <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_ins_campo();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                               </button>

                                           <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_ins_campo();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                           </button>


                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px;">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_inspeccion_campo"></table>
                                                    <div id="pager_table_inspeccion_campo"></div>
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
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 10px">
                                        <div class="col-xs-12">
                                            
                                    <h1 ><b>EXPEDIENTES PARA EVALUACION TECNICA</b></h1>
                                        <div class="col-lg-3" style="padding-right: 0px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="fec_ini_eva_tecnica" type="text" onchange="selecciona_fecha_eva_t();" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                <input id="fec_fin_eva_tecnica" type="text"  onchange="selecciona_fecha_eva_t();" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                       
                                               <div class="icon-addon addon-md">
                                                   <input type="checkbox" id="dlg_ver_improcedentes" onclick="check_ver_improcedentes('#dlg_ver_improcedentes')" style="width:22px;height:22px">IMPROCEDENTES
                                               </div>
                                           </div>
                                       </div>
                                       <div class="" style="float:right; padding-top: 20px">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="emitir_ofic_impro();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Emitir Ofic. de Impro.
                                               </button>

                                               <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="aprobar_expediente();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Aprob. Exp.
                                               </button>

                                                <button  type="button" class="btn btn-labeled bg-color-orange txt-color-white" onclick="imprimir_evaluacion_tecnica();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                                               </button>

                                               <button  type="button" class="btn btn-labeled bg-color-magenta txt-color-white" onclick="enviar_legar();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Enviar a Legal
                                                </button>


                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                                           <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_evaluacion_tecnica"></table>
                                                        <div id="pager_table_evaluacion_tecnica"></div>
                                                </article>
                                            </div>
                                    </div>
                                </div>
                        </section>
                        </div> 

                        <div id="s6" class="tab-pane fade" style="height: auto">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 10px">
                                        <div class="col-xs-12">
                                            
                                    <h1 ><b>EXPEDIENTES PARA VISTO LEGAL</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="fec_ini_visto_legal" type="text" onchange="selecciona_visto_legal();"  class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="fec_fin_visto_legal" type="text" onchange="selecciona_visto_legal();"  class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="text-right" style=" padding-top: 20px">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="aprobar_para_firmas();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Aprobar para Firmas
                                               </button>

                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_expediente_visto_legal"></table>
                                                    <div id="pager_table_expediente_visto_legal"></div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        </div> 
                        
                        
                        <div id="s7" class="tab-pane fade" style="height: auto">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 10px">
                                        <div class="col-xs-12">
                                            
                                    <h1 ><b>EXPEDIENTES PARA VISTO Y FIRMA</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="fec_ini_exp_visto_firma" name="dlg_fec" type="text"  onchange="selecciona_visto_firma();" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                <input id="fec_fin_exp_visto_firma" name="dlg_fec" type="text"  onchange="selecciona_visto_firma();" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="text-right" style=" padding-top: 20px">

                                               
                                               <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="aprobar_para_visto_y_firma();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Aprobar para Visto y Firma
                                               </button>




                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_expediente_visto_firma"></table>
                                                    <div id="pager_table_expediente_visto_firma"></div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        </div>
                        
                        
                        <div id="s8" class="tab-pane fade" style="height: auto">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px">
                                    <section style="padding-right: 10px">
                                        <div class="col-xs-12">
                                            
                                    <h1 ><b>ENTREGA DE CONSTANCIAS DE POSESION</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="fec_ini_entr_const_pos" name="dlg_fec" type="text" onchange="selecciona_entregar_constancia();"  class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="fec_fin_entr_const_pos" name="dlg_fec" type="text"  onchange="selecciona_entregar_constancia();" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="" style="float:right; padding-top: 20px">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="entregar_a();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Entregar a
                                               </button>
                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px; ">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_entr_const_pos"></table>
                                                    <div id="pager_table_entr_const_pos"></div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        </div> 
                                     
                        
                        <div id="s9" class="tab-pane fade" style="height: auto">
                            <section class="col col-lg-12">
                                <div class="col-xs-12">               
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style='padding: 0px'>
                                            <section style="padding-right: 10px">
                                                <div class="col-xs-12" style='padding: 0px'>
                                                    <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; padding-left: 0px ">
                                                       <div class="input-group input-group-md">
                                                           <span class="input-group-addon">Desde:</span>
                                                           <div class="icon-addon addon-md">
                                                                <input  id="fec_ini_escaneo" name="dlg_fec" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                            </div> 
                                                       </div>
                                                    </div>
                                                    <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                                        <div class="input-group input-group-md">
                                                            <span class="input-group-addon">Hasta:</span>
                                                            <div class="icon-addon addon-md">
                                                                <input id="fec_fin_escaneo" name="dlg_fec" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                                        <button  type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="busqueda_escaneo();">
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
        
        
        fecha_inicio_datos_lote = $('#fec_ini_datos_lote').val();
        fecha_fin_datos_lote = $('#fec_fin_datos_lote').val();
        
        jQuery("#table_datos_predio").jqGrid({
            url: 'datos_predio?grid=1&fecha_inicio='+fecha_inicio_datos_lote+'&fecha_fin='+fecha_fin_datos_lote,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'AÑO', 'N° EXPEDIENTE', 'GESTOR DEL TRAMITE','HAB.URB','FECHA INICIO'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'anio', index: 'anio', align: 'center', width: 100},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'center', width: 100},
                {name: 'gestor', index: 'gestor', align: 'left', width: 300},
                {name: 'hab_urb', index: 'hab_urb', align: 'center', width: 300},
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
        
        fecha_desde = $("#dlg_fecha_desde_cc").val(); 
        fecha_hasta = $("#dlg_fecha_hasta_cc").val();
        jQuery("#table_control_calidad").jqGrid({
            url: 'getExpedientes_ControlCalidad?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta,
            datatype: 'json', mtype: 'GET',
            height: '120px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'CODIGO EXPEDIENTE','GESTOR DEL TRAMITE','FECHA INICIO','FECHA REGISTRO','ESTADO'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 200},
                {name: 'gestor', index: 'gestor', align: 'left', width: 300},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 200},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'fase', index: 'fase', align: 'left', width: 15, hidden:true}
            ],
            pager: '#pager_table_control_calidad',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_control_calidad').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_control_calidad').jqGrid('getDataIDs')[0];
                            $("#table_control_calidad").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){
                 $('#hidden_id').val($("#table_control_calidad").getCell(Id, "nro_expediente"));
            },
            ondblClickRow: function (Id){actualizar_expediente();}
        });
       
        
        jQuery("#table_inspeccion").jqGrid({
            url: 'traer_inspecciones',
            datatype: 'json', mtype: 'GET',
            height: '90px', width: 950,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'CODIGO EXPEDIENTE','GESTOR DEL TRAMITE','INSPECTOR'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'INSPECCION', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 20},
                {name: 'gestor', index: 'gestor', align: 'left', width: 40},
                {name: 'apenom', index: 'apenom', align: 'left', width: 40}
            ],
            pager: '#pager_table_inspeccion',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_inspeccion').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_inspeccion').jqGrid('getDataIDs')[0];
                            $("#table_inspeccion").setSelection(firstid);    
                        }
                },
            ondblClickRow: function (Id){actualizar_inspeccion();}
    });
        
        //NUEVOS
        fecha_inicio_ins_campo = $('#fec_ini_ins_campo').val();
        fecha_fin_ins_campo = $('#fec_fin_ins_campo').val();
        jQuery("#table_inspeccion_campo").jqGrid({
            url: 'datos_predio?grid=2&fecha_inicio='+fecha_inicio_ins_campo+'&fecha_fin='+fecha_fin_ins_campo,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_asig_exp','id_reg_exp','ide', 'COD. EXPEDIENTE', 'GESTOR DEL TRAMITE','HABILITACION','FECHA DE ASIGNACION','FECHA INSPECCION','ENVIAR'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'INSPECCION DE CAMPO', align: "center",
            colModel: [
                {name: 'id_asig_exp', index: 'id_reg_exp', hidden: true},
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'ide', index: 'ide', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 100},
                {name: 'gestor', index: 'gestor', align: 'left', width: 200},
                {name: 'nomb_hab_urba', index: 'nomb_hab_urba', align: 'left', width: 200},
                {name: 'fec_asig', index: 'fec_asig', align: 'left', width: 150},
                {name: 'fec_asig', index: 'fch_inspeccion', align: 'left', width: 150},
                {name: 'btn', index: 'btn', align: 'left', width: 150}
            ],
            pager: '#pager_table_inspeccion_campo',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_inspeccion_campo').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_inspeccion_campo').jqGrid('getDataIDs')[0];
                            $("#table_inspeccion_campo").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){actualizar_ins_campo();}
        });
        
        fecha_ini_eva_tecnica = $("#fec_ini_eva_tecnica").val();
        fecha_fin_eva_tecnica = $("#fec_fin_eva_tecnica").val();
        jQuery("#table_evaluacion_tecnica").jqGrid({
            url: 'get_evaluacion_tecnica?fecha_ini_eva_tecnica='+fecha_ini_eva_tecnica+'&fecha_fin_eva_tecnica='+fecha_fin_eva_tecnica,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'FECHA INSPECCION', 'CODIGO EXPEDIENTE', 'GESTOR DEL TRAMITE','FECHA DE REGISTRO','FASE'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'EXPEDIENTES PARA EVALUACION TECNICA', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'fch_inspeccion', index: 'fch_inspeccion', align: 'left', width: 200},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 200},
                {name: 'gestor', index: 'gestor', align: 'left', width: 300},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'fase', index: 'fase', align: 'left', width: 200, hidden:true}
            ],
            pager: '#pager_table_evaluacion_tecnica',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_evaluacion_tecnica').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_evaluacion_tecnica').jqGrid('getDataIDs')[0];
                            $("#table_evaluacion_tecnica").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){actualizar_evaluacion_tecnica(Id);}
        });
        
        
        fecha_inicio_visto_legal = $('#fec_ini_visto_legal').val();
        fecha_fin_visto_legal = $('#fec_fin_visto_legal').val();
        jQuery("#table_expediente_visto_legal").jqGrid({
            url: 'datos_predio?grid=3&fecha_inicio='+fecha_inicio_visto_legal+'&fecha_fin='+fecha_fin_visto_legal,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'CODIGO EXPEDIENTE', 'GESTOR DEL TRAMITE','FECHA DE REGISTRO','FECHA INSPECCION'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'EXPEDIENTES PARA VISTO LEGAL', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 300},
                {name: 'gestor', index: 'gestor', align: 'left', width: 200},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'fch_inspeccion', index: 'fch_inspeccion', align: 'left', width: 200},
            ],
            pager: '#pager_table_expediente_visto_legal',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_expediente_visto_legal').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_expediente_visto_legal').jqGrid('getDataIDs')[0];
                            $("#table_expediente_visto_legal").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        
        fecha_inicio_visto_firma = $('#fec_ini_exp_visto_firma').val();
        fecha_fin_visto_firma = $('#fec_fin_exp_visto_firma').val();
        jQuery("#table_expediente_visto_firma").jqGrid({
            url: 'datos_predio?grid=4&fecha_inicio='+fecha_inicio_visto_firma+'&fecha_fin='+fecha_fin_visto_firma,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'CODIGO EXPEDIENTE', 'GESTOR DEL TRAMITE','FECHA DE REGISTRO','FECHA INSPECCION'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'EXPEDIENTES PARA VISTO Y FIRMA', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 300},
                {name: 'gestor', index: 'gestor', align: 'left', width: 200},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'fch_inspeccion', index: 'fch_inspeccion', align: 'left', width: 200},
            ],
            pager: '#pager_table_expediente_visto_firma',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_expediente_visto_firma').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_expediente_visto_firma').jqGrid('getDataIDs')[0];
                            $("#table_expediente_visto_firma").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        
        
        fecha_inicio_entr_const = $('#fec_ini_entr_const_pos').val();
        fecha_fin_entr_const = $('#fec_fin_entr_const_pos').val();
        jQuery("#table_entr_const_pos").jqGrid({
            url: 'datos_predio?grid=5&fecha_inicio='+fecha_inicio_entr_const+'&fecha_fin='+fecha_fin_entr_const,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'CODIGO EXPEDIENTE', 'SOLICITANTE','FECHA DE REGISTRO',],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'ENTREGA DE CONSTANCIAS DE POSESION', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 200},
                {name: 'gestor', index: 'gestor', align: 'left', width: 600},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 100},
            ],
            pager: '#pager_table_entr_const_pos',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_entr_const_pos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_entr_const_pos').jqGrid('getDataIDs')[0];
                            $("#table_entr_const_pos").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        jQuery("#table_escaneos").jqGrid({
            url: 'datos_predio?grid=9&fecini='+$("#fec_ini_escaneo").val()+'&fecfin='+$("#fec_fin_escaneo").val(),
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'CODIGO EXPEDIENTE', 'SOLICITANTE','Nro CONSTANCIA','FECHA DE ENTREGA','SUBIR'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'CONSTANCIAS', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 200},
                {name: 'gestor', index: 'gestor', align: 'left', width: 380},
                {name: 'nro_constancia', index: 'nro_constancia', align: 'left', width: 120},
                {name: 'fecha_entrega', index: 'fecha_entrega', align: 'left', width: 100},
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
                jQuery("#table_doc").jqGrid('setGridParam', {url: 'datos_predio?grid=9_1&id='+Id}).trigger('reloadGrid');
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
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/registro_expendientes.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/control_calidad.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/mapa_lote.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/inspeccion_campo.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/evaluacion_tecnica.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/visto_legal.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/visto_y_firma.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/entregar_cons.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/escaneo.js') }}"></script>

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
                <div class="col-xs-3" style="padding-left: 0px;">
                    <button style="width: 100%" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="map_reg_lote();">
                        <span class="btn-label"><i class="glyphicon glyphicon-globe"></i></span>Buscar en Mapa
                    </button>
                </div>
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
<div id="dlg_nuevo_acta_ins" style="display: none;">    
    
    <section class="col col-lg-12">
                        <ul id="tab_insp1" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#insp1" data-toggle="tab" aria-expanded="true">
                                    Datos Expedientes
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#insp2" data-toggle="tab" aria-expanded="false">
                                   Datos Vecino
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                        </ul>
        
                        <div id="myTabContent1" class="tab-content padding-1"> 
                            <input type="hidden" id="hidden_ide_inps" value="0">
                            <div id="insp1" class="tab-pane fade active in">
                                <section class="col col-lg-12">
                                  <div class="widget-body">
                                   <div  class="smart-form">
                                     <div class='cr_content col-xs-12 ' style="padding-bottom:  1px;padding-bottom:  1px;">
                                        <div class="col-xs-12 cr-body" style="padding-bottom:  1px;padding-top:  5px;">
                                             <div>
                                                <div class="col col-xs-2">
                                                    <label class="label">Cod. Expediente:</label>
                                                    <label class="input">
                                                        <input id="hidden_inp_cod_expe_ins" type="hidden" value="0">
                                                        <input id="inp_cod_expe_ins" type="text"  class="input-sm"  disabled="">
                                                    </label>
                                                </div>
                                                <div class="col col-xs-8">
                                                    <label class="label">Solicitante:</label>
                                                    <label class="input">
                                                        <input id="inp_solicitante_ins" type="text"  class="input-sm" disabled="">
                                                    </label>
                                                </div>
                                                <div class="col col-2">
                                                    <label class="label">Fecha Inspención:</label>
                                                            <label class="input">
                                                                <input id="inp_fecha_inspec" type="text"  class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                            </label>
                                                </div>     
                                             </div>
                                        </div>   
                                         <div class="col-xs-12 cr-body" style="padding-bottom:  1px;padding-top:  5px;">
                                             <div>
                                                <div class="col col-xs-12">
                                                    <input type="hidden" id="hidden_inp_hab_urb_ins" value="0">
                                                    <label class="label">Habilitación Urbana:</label>
                                                    <label class="input">
                                                        <input id="inp_hab_urb_ins" type="text"   class="input-sm" disabled="">
                                                    </label>
                                                </div>
                                             </div>
                                        </div>   
                                         <div class="col-xs-12 cr-body" style="padding-top:  5px;" >
                                             <div>
                                                <div class="col col-xs-2">
                                                    <label class="label">Super Mzna:</label>
                                                    <label class="input">
                                                        <input id="inp_super_mzna_ins" type="text"  class="input-sm" disabled="">
                                                    </label>
                                                </div>
                                                <div class="col col-xs-2">
                                                    <label class="label">Mzna:</label>
                                                    <label class="input">
                                                        <input id="inp_mzna_ins" type="text"  class="input-sm" disabled="">
                                                    </label>
                                                </div>
                                                <div class="col col-xs-2">
                                                    <label class="label">Lote:</label>
                                                    <label class="input">
                                                        <input id="inp_lote_ins" type="text"  class="input-sm" disabled="">
                                                    </label>
                                                </div>
                                                <div class="col col-xs-3">
                                                    <label class="label">Sector:</label>
                                                    <label class="input">
                                                        <input id="inp_sector_ins" type="text"  class="input-sm" disabled="">
                                                    </label>
                                                </div>
                                                <div class="col col-xs-3">
                                                    <label class="label">Zona:</label>
                                                    <label class="input">
                                                        <input id="inp_zona_ins" type="text"  class="input-sm" disabled="">
                                                    </label>
                                                </div>



                                             </div>
                                        </div>  
                                     </div>
                                     <div>
                                         <section class="col-xs-4">
                                              <div class='cr_content col-xs-12 ' style="padding-bottom:  1px;padding-top:  0px">
                                                <div class="col-xs-12 cr-body panel-success" style="margin-top:5px;margin-bottom:5px" >
                                                   <div class="panel-heading bg-color-success">Tipo de Suelo</div>
                                                      <div class="col col-xs-12">
                                                               <select id="inp_tipo_suelo"  class="form-control" onchange="" >
                                                                    <option value='1' >Urbano</option>
                                                                    <option value='2' >Rural</option>
                                                               </select>
                                                       </div>
                                                </div>  
                                              </div>
                                              <div class='cr_content col-xs-12 ' style="margin-top:0px;padding-bottom:10px">
                                                      <div class="col-xs-12 cr-body panel-success" >
                                                         <div class="panel-heading bg-color-success">Consideraciones</div>
                                                         <div class="col-xs-12" >
                                                                        <form style="padding-left:20px" class="col-xs-12">
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                            <input id="inp_zonificacion_ins"type="checkbox" name="toggle" checked> <span class="label-text" >Zonificación &emsp; &emsp;</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_planos_ins" type="checkbox" name="toggle"> <span class="label-text">Planos MPA &emsp; &emsp;</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_res_hab_ins" type="checkbox" name="toggle"> <span class="label-text">Res. Hab. Urbana</span>
                                                                                        </label>
                                                                                </div>
                                                                        </form>
                                                                </div>
                                                     </div>  
                                              </div>
                                         </section>
                                        <section class="col-xs-4">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-top:  0px">
                                                      <div class="col-xs-12 cr-body panel-success" >
                                                         <div class="panel-heading bg-color-success" >Condición del predio</div>
                                                         <div class="panel-heading" style="background-color:#F8F8FF	;color:#000000" >Tipo de cerco</div>
                                                         <div class="col-xs-12" >
                                                                        <form style="padding-left:20px" class="col-xs-12">
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                            <input id="inp_piedra_cerco"type="checkbox" name="toggle" checked> <span class="label-text" >Piedra </span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_sillar_cerco" type="checkbox" name="toggle"> <span class="label-text">Sillar</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_bloqueta_cerco" type="checkbox" name="toggle"> <span class="label-text">Bloqueta</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_ladrillo_cerco" type="checkbox" name="toggle"> <span class="label-text">Ladrillo</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_concreto_cerco" type="checkbox" name="toggle"> <span class="label-text">Concreto</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_estera_cerco" type="checkbox" name="toggle"> <span class="label-text">Estera</span>
                                                                                        </label>
                                                                                </div>                                                                     
                                                                        </form>
                                                         </div>
                                                     </div>  
                                              </div>
                                         </section>
                                         <section class="col-xs-4">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-top:  0px">
                                                      <div class="col-xs-12 cr-body panel-success" >
                                                         <div class="panel-heading bg-color-success" >Condición del predio</div>
                                                         <div class="panel-heading" style="background-color:#F8F8FF	;color:#000000" >Habitaciones</div>
                                                         <div class="col-xs-12" >
                                                                        <form style="padding-left:20px" class="col-xs-12">
                                                                               <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_sillar_hab" type="checkbox" name="toggle"> <span class="label-text">Sillar</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_bloqueta_hab" type="checkbox" name="toggle"> <span class="label-text">Bloqueta</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="in_ladrillo_hab" type="checkbox" name="toggle"> <span class="label-text">Ladrillo</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_concreto_hab" type="checkbox" name="toggle"> <span class="label-text">Concreto</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_fabricado_hab" type="checkbox" name="toggle"> <span class="label-text">Pre fabricado</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_dry_hab" type="checkbox" name="toggle"> <span class="label-text">Dry-wall</span>
                                                                                        </label>
                                                                                </div>
                                                                        </form>
                                                         </div>
                                                     </div>  
                                              </div>
                                           </section>
                                     </div>
                                      <div>
                                         <section class="col-xs-4">
                                              <div class='cr_content col-xs-12 ' style="padding-bottom:  1px;padding-top:  5px">
                                                <div class="col-xs-12 cr-body panel-success" style="margin-bottom:5px" >
                                                   <div class="panel-heading bg-color-success" >Condición del predio</div>
                                                         <div class="panel-heading" style="background-color:#F8F8FF	;color:#000000" >Tipo de Techo</div>
                                                         <div class="col-xs-12" >
                                                                        <form style="padding-left:20px" class="col-xs-12">
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                            <input id="inp_calamina"type="checkbox" name="toggle" checked> <span class="label-text" >Calamina </span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_madera" type="checkbox" name="toggle"> <span class="label-text">Madera</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_mdf" type="checkbox" name="toggle"> <span class="label-text">MDF</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_concreto" type="checkbox" name="toggle"> <span class="label-text">Concreto</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_plasticos" type="checkbox" name="toggle"> <span class="label-text">Plasticos</span>
                                                                                        </label>
                                                                                </div>
                                                                        </form>
                                                         </div>
                                                </div>  
                                              </div>
                                              <div class='cr_content col-xs-12 ' style="margin-top:0px;padding-bottom:10px">
                                                      <div class="col-xs-12 cr-body panel-success" >
                                                         <div class="panel-heading bg-color-success">Ocupación del Predio</div>
                                                         <div class="col-xs-12" >
                                                                        <form style="padding-left:20px" class="col-xs-12">
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                            <input id="inp_habita_pred"type="checkbox" name="toggle" checked> <span class="label-text" >Habita el Predio</span>
                                                                                        </label>
                                                                                </div>
                                                                                
                                                                        </form>
                                                             
                                                         </div>
                                                     </div>  
                                              </div>
                                         </section>
                                        <section class="col-xs-4"style="margin-top:5px;padding-bottom:70px">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-top:  0px">
                                                      <div class="col-xs-12 cr-body panel-success" >
                                                         <div class="panel-heading bg-color-success" >Condición del predio</div>
                                                         <div class="col-xs-12" >
                                                                <div class="col col-xs-12">
                                                                <label class="label">N°Personas:</label>
                                                                <label class="input">
                                                                    <input id="inp_nro_pers" type="text"  pclass="input-sm" onkeypress="return soloDNI(event);">
                                                                </label>
                                                                </div>
                                                                 <div class="col col-xs-12">
                                                                    <label class="label">N°Habitaciones:</label>
                                                                    <label class="input">
                                                                        <input id="inp_nro_habita" type="text" class="input-sm" onkeypress="return soloDNI(event);">
                                                                    </label>

                                                                </div>
                                                         </div>
                                                     </div>  
                                              </div>
                                         </section>
                                         <section class="col-xs-4"style="margin-top:5px;padding-bottom:70px">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-top:  0px">
                                                      <div class="col-xs-12 cr-body panel-success" >
                                                         <div class="panel-heading bg-color-success" >Servicios</div>
                                                         <div class="col-xs-12" >
                                                                        <form style="padding-left:20px" class="col-xs-12">
                                                                               <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_pileta" type="checkbox" name="toggle"> <span class="label-text">Pileta Comunal</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_agua_med" type="checkbox" name="toggle"> <span class="label-text">Agua/Medidor</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_luz_colec" type="checkbox" name="toggle"> <span class="label-text">Luz Colectiva</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_luz_med" type="checkbox" name="toggle"> <span class="label-text">Luz Medidor</span>
                                                                                        </label>
                                                                                </div>
                                                                                
                                                                        </form>
                                                         </div>
                                                     </div>  
                                              </div>
                                           </section>
                                     </div>
                                     <div>
                                           <section class="col-xs-4">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-top:  0px">
                                                      <div class="col-xs-12 cr-body panel-success" >
                                                         <div class="panel-heading bg-color-success" >Mobiliario</div>
                                                         <div class="panel-heading" style="background-color:#F8F8FF	;color:#000000" >Habitación</div>
                                                         <div class="col-xs-12" >
                                                                        <form style="padding-left:20px" class="col-xs-12">
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                            <input id="inp_tarima"type="checkbox" name="toggle" checked> <span class="label-text" >Tarima &emsp; &emsp;</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_colchon" type="checkbox" name="toggle"> <span class="label-text">Colchón &emsp; &emsp;</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_comoda" type="checkbox" name="toggle"> <span class="label-text">Cómoda</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_ropero" type="checkbox" name="toggle"> <span class="label-text">Ropero</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_ropa" type="checkbox" name="toggle"> <span class="label-text">Ropa/Canasto</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_aparador" type="checkbox" name="toggle"> <span class="label-text">Aparador</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_tv" type="checkbox" name="toggle"> <span class="label-text">Televisor</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_radio" type="checkbox" name="toggle"> <span class="label-text">Radio/E. Sonido</span>
                                                                                        </label>
                                                                                </div>
                                                                        </form>
                                                         </div>
                                                     </div>  
                                              </div>
                                           </section>
                                           <section class="col-xs-4">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-top:  0px">
                                                      <div class="col-xs-12 cr-body panel-success" >
                                                         <div class="panel-heading bg-color-success" >Mobiliario</div>
                                                         <div class="panel-heading" style="background-color:#F8F8FF	;color:#000000" >Cocina</div>
                                                         <div class="col-xs-12" >
                                                                        <form style="padding-left:20px" class="col-xs-12">
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                            <input id="inp_cocina"type="checkbox" name="toggle" checked > <span class="label-text" > Cocina</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_gas" type="checkbox" name="toggle"> <span class="label-text">Balón de gas</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_mesas" type="checkbox" name="toggle"> <span class="label-text">Mesas</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_sillas" type="checkbox" name="toggle"> <span class="label-text">Sillas</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_viveres" type="checkbox" name="toggle"> <span class="label-text">Viveres</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_ollas" type="checkbox" name="toggle"> <span class="label-text">Ollas</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_repostero" type="checkbox" name="toggle"> <span class="label-text">Repostero</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_servicios" type="checkbox" name="toggle"> <span class="label-text">Servicios</span>
                                                                                        </label>
                                                                                </div>
                                                                        </form>
                                                                </div>
                                                     </div>  
                                              </div>
                                           </section>
                                           <section class="col-xs-4">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-top:  0px">
                                                      <div class="col-xs-12 cr-body panel-success" >
                                                         <div class="panel-heading bg-color-success" >Mobiliario</div>
                                                         <div class="panel-heading" style="background-color:#F8F8FF	;color:#000000" >Patio</div>
                                                         <div class="col-xs-12" >
                                                                        <form style="padding-left:20px" class="col-xs-12">
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                            <input id="inp_cordeles"type="checkbox" name="toggle" checked> <span class="label-text" >Cordeles</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                            <input id="inp_baldes"type="checkbox" name="toggle" checked> <span class="label-text" >Baldes/Lavadores</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_bidones" type="checkbox" name="toggle"> <span class="label-text">Bidones/Agua</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_lavatorio" type="checkbox" name="toggle"> <span class="label-text">Lavatorio</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_corral" type="checkbox" name="toggle"> <span class="label-text">Corral/Mascotas</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_plantas" type="checkbox" name="toggle"> <span class="label-text">Plantas</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_silo" type="checkbox" name="toggle"> <span class="label-text">Silo</span>
                                                                                        </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                        <label class="toggle">
                                                                                                <input id="inp_baño" type="checkbox" name="toggle"> <span class="label-text">Baño</span>
                                                                                        </label>
                                                                                </div>
                                                                                
                                                                        </form>
                                                                </div>
                                                     </div>  
                                              </div>
                                           </section>                               
                                     </div>
                                     <div>
                                           <section class="col-xs-12">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-bottom:  1px;padding-top:  0px">
                                                <div class="col-xs-12 cr-body panel-success" >
                                                   <div class="panel-heading bg-color-success">Área total Aproximada del predio</div>
                                                      <div class="col col-xs-8">
                                                        <label class="label input">El predio se encuentra encerrado en un area aproximado de (M2):<input id="inp_area_pred_ins" type="text"  class="input" onkeypress="return soloNumeroTab(event);">
                                                        </label>

                                                       </div>
                                                </div>  
                                              </div>
                                         </section>
                                     </div>
                                     <div>
                                            <section class="col-xs-6 ">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-bottom:  1px;padding-top:  0px">
                                                <div class="col-xs-12 cr-body panel-success" >
                                                      <div class="col col-xs-12">
                                                               <label class="label">Linea Recta Frente</label>
                                                                    <label class="input">
                                                                    <input id="inp_linea_frente_ins" type="text"  class="input-sm" onkeypress="return soloNumeroTab(event);">
                                                                </label>
                                                       </div>
                                                   <div class="col col-xs-12">
                                                               <label class="label">Linea Recta Derecha</label>
                                                                    <label class="input">
                                                                    <input id="inp_linea_der_ins" type="text"  class="input-sm" onkeypress="return soloNumeroTab(event);">
                                                                </label>
                                                       </div>
                                                   <div class="col col-xs-12">
                                                               <label class="label">Linea Recta Izquierda</label>
                                                                    <label class="input">
                                                                    <input id="inp_linea_izq_ins" type="text"  class="input-sm" onkeypress="return soloNumeroTab(event);">
                                                                </label>
                                                       </div>
                                                   <div class="col col-xs-12">
                                                               <label class="label">Linea Recta Fondo</label>
                                                                    <label class="input">
                                                                    <input id="inp_linea_fondo_ins" type="text"  class="input-sm" onkeypress="return soloNumeroTab(event);">
                                                                </label>
                                                       </div>

                                                </div>  
                                              </div>                                  
                                            </section>
                                            <section class="col-xs-6 ">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-bottom:  1px;padding-top:  0px">
                                                <div class="col-xs-12 cr-body panel-success" >
                                                      <div class="col col-xs-12">
                                                               <label class="label">Por el frente con</label>
                                                                    <label class="input">
                                                                        <input id="inp_por_frente_ins" type="text"  class="input-sm" maxlength="50">
                                                                </label>
                                                       </div>
                                                   <div class="col col-xs-12">
                                                               <label class="label">Por la Derecha con</label>
                                                                    <label class="input">
                                                                    <input id="inp_por_der_ins" type="text"  class="input-sm" maxlength="50">
                                                                </label>
                                                       </div>
                                                   <div class="col col-xs-12">
                                                               <label class="label">Por Izquierda con</label>
                                                                    <label class="input">
                                                                    <input id="inp_por_izq_ins" type="text"  class="input-sm" maxlength="50">
                                                                </label>
                                                       </div>
                                                   <div class="col col-xs-12">
                                                               <label class="label">Por el Fondo con</label>
                                                                    <label class="input">
                                                                    <input id="inp_por_fondo_ins" type="text"  class="input-sm" maxlength="50">
                                                                </label>
                                                       </div>

                                                </div>  
                                              </div>

                                            </section>
                                     </div>
                                     <div>
                                           <section class="col-xs-12">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-bottom:  1px;padding-top:  0px">
                                                <div class="col-xs-12 cr-body panel-success" >
                                                   <div class="panel-heading bg-color-success">Observaciones</div>
                                                      <div class="col col-xs-12">
                                                        <label class="label input">
                                                            <textarea id="inp_obs_ins" type="text"  class="input" autofocus="" style="margin: 0px 369px 0px 0px; width: 100%; height: 76px;"></textarea>
                                                        </label>

                                                       </div>
                                                </div>  
                                              </div>
                                         </section>
                                     </div>

                                </div>



                            </div>
                                </section>
                            </div>
                            <div id="insp2" class="tab-pane fade" style="height: auto">
                                <section class="col col-lg-12">
                                  <div class="widget-body">
                                   <div  class="smart-form">
                                    
                                     <div class='cr_content col-xs-12 ' style="padding-bottom:  1px;padding-bottom:  1px;">
                                         <section class="col-xs-12">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-bottom:  1px;padding-top:  0px">
                                                <div class="col-xs-12 cr-body panel-success" >
                                                   <div class="panel-heading bg-color-success">Vecino 01</div>
                                                        <div class="col col-xs-2">
                                                            <label class="label">DNI:</label>
                                                            <label class="input">
                                                                <input id="inp_dni_vec1" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-10">
                                                            <label class="label">Nombre y Apellidos:</label>
                                                            <label class="input">
                                                                <input id="inp_nom_vec1" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-12">
                                                            <label class="label">Dirección:</label>
                                                            <label class="input">
                                                                <input id="inp_dir_vec1" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                </div>  
                                               
                                              </div>  
                                         </section>
                                          <section class="col-xs-12">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-bottom:  1px;padding-top:  0px">
                                                <div class="col-xs-12 cr-body panel-success" >
                                                   <div class="panel-heading bg-color-success">Vecino 02</div>
                                                        <div class="col col-xs-2">
                                                            <label class="label">DNI:</label>
                                                            <label class="input">
                                                                <input id="inp_dni_vec2" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-10">
                                                            <label class="label">Nombre y Apellidos:</label>
                                                            <label class="input">
                                                                <input id="inp_nom_vec2" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-12">
                                                            <label class="label">Dirección:</label>
                                                            <label class="input">
                                                                <input id="inp_dir_vec2" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                </div>  
                                               
                                              </div>  
                                         </section>
                                          <section class="col-xs-12">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-bottom:  1px;padding-top:  0px">
                                                <div class="col-xs-12 cr-body panel-success" >
                                                   <div class="panel-heading bg-color-success">Vecino 03</div>
                                                        <div class="col col-xs-2">
                                                            <label class="label">DNI:</label>
                                                            <label class="input">
                                                                <input id="inp_dni_vec3" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-10">
                                                            <label class="label">Nombre y Apellidos:</label>
                                                            <label class="input">
                                                                <input id="inp_nom_vec3" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-12">
                                                            <label class="label">Dirección:</label>
                                                            <label class="input">
                                                                <input id="inp_dir_vec3" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                </div>  
                                               
                                              </div>  
                                         </section>
                                     </div>
                                    <form id="FormularioFiles" name="FormularioFiles" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}"> 
                                        <div class='cr_content col-xs-12 ' style="padding-bottom:  1px;padding-bottom:  1px;">
                                           <section class="col-xs-4 ">
                                                   <div class="col-xs-12 cr-body panel-success"style="height: 161px;overflow-y: scroll;" >
                                                      <div class="panel-heading bg-color-success">Foto del Predio 1</div>
                                                         <div class="col col-xs-12">
                                                                  <div class="panel-body cr-body">
                                                                      <input type="hidden" id="hidden_inp_foto_pred1" name="hidden_inp_foto_pred1" value="0">
                                                                      <div id="inp_foto_pred1" style="padding: 5px; ">

                                                                      </div>
                                                                   </div>
                                                          </div>
                                                   </div>  
                                                   <div class="col-xs-12 cr-body panel-success" >
                                                       <div class="col col-xs-12" >
                                                           <section>
                                                               <div class="input input-file col-xs-10" style="padding: 0px">
                                                                   <span class="button " style="padding-top: 5px;padding-bottom: 5px"><input type="file" id="file1" name="file1">Subir imagen</span><input id="textfile1" type="text" placeholder="Incluir Archivo" readonly="" style="height: 39px">
                                                               </div>
                                                               <div class="col-xs-2"  style="padding: 0px">
                                                                   <button type="button" class="btn btn-danger btn-lg"style="margin-left:10px;"onclick="borrar_foto(1);">
                                                                       <span class="glyphicon glyphicon-trash"></span> 
                                                                   </button>
                                                               </div>
                                                           </section>

                                                          </div>  

                                                   </div> 
                                            </section>

                                           <section class="col-xs-4 ">
                                                   <div class="col-xs-12 cr-body panel-success"style="height: 161px;overflow-y: scroll;" >
                                                      <div class="panel-heading bg-color-success">Foto del Predio 2</div>
                                                         <div class="col col-xs-12">
                                                                      <input type="hidden" id="hidden_inp_foto_pred2" name="hidden_inp_foto_pred2" value="0">
                                                                  <div class="panel-body cr-body">
                                                                      <div id="inp_foto_pred2" style="padding: 5px; ">

                                                                      </div>
                                                                   </div>
                                                          </div>
                                                   </div>  
                                                   <div class="col-xs-12 cr-body panel-success" >
                                                       <div class="col col-xs-12" >
                                                           <section>
                                                               <div class="input input-file col-xs-10" style="padding: 0px">
                                                                   <span class="button " style="padding-top: 5px;padding-bottom: 5px"><input type="file" id="file2" name="file2">Subir imagen</span><input id="textfile2" type="text" placeholder="Incluir Archivo" readonly="" style="height: 39px">
                                                               </div>
                                                               <div class="col-xs-2"  style="padding: 0px">
                                                                   <button type="button" class="btn btn-danger btn-lg"style="margin-left:10px;"onclick="borrar_foto(2);">
                                                                       <span class="glyphicon glyphicon-trash"></span> 
                                                                   </button>
                                                               </div>
                                                           </section>

                                                          </div>  

                                                   </div> 
                                            </section>

                                           <section class="col-xs-4 ">
                                                   <div class="col-xs-12 cr-body panel-success"style="height: 161px;overflow-y: scroll;" >
                                                      <div class="panel-heading bg-color-success">Foto del Predio 3</div>
                                                         <div class="col col-xs-12">
                                                                      <input type="hidden" id="hidden_inp_foto_pred3" name="hidden_inp_foto_pred3" value="0">
                                                                  <div class="panel-body cr-body">
                                                                      <div id="inp_foto_pred3" style="padding: 5px;  ">

                                                                      </div>
                                                                   </div>
                                                          </div>
                                                   </div>  
                                                   <div class="col-xs-12 cr-body panel-success" >
                                                       <div class="col col-xs-12" >
                                                           <section>
                                                               <div class="input input-file col-xs-10" style="padding: 0px">
                                                                   <span class="button " style="padding-top: 5px;padding-bottom: 5px"><input type="file" id="file3" name="file3">Subir imagen</span><input id="textfile3" type="text" placeholder="Incluir Archivo" readonly="" style="height: 39px">
                                                               </div>
                                                               <div class="col-xs-2"  style="padding: 0px">
                                                                   <button type="button" class="btn btn-danger btn-lg"style="margin-left:10px;"onclick="borrar_foto(3);">
                                                                       <span class="glyphicon glyphicon-trash"></span> 
                                                                   </button>
                                                               </div>
                                                           </section>
                                                          </div>  
                                                   </div> 
                                            </section>

                                           <section class="col-xs-12 ">
                                                   <div class="col-xs-12 cr-body panel-success"style="height: 161px;overflow-y: scroll;" >
                                                      <div class="panel-heading bg-color-success">Subir Firma (.jpg)</div>
                                                         <div class="col col-xs-12">
                                                                      <input type="hidden" id="hidden_inp_foto_pred4" name="hidden_inp_foto_pred4" value="0">
                                                                  <div class="panel-body cr-body">
                                                                      <div id="inp_foto_pred4" style="padding: 5px;  ">

                                                                      </div>
                                                                   </div>
                                                          </div>
                                                   </div>  
                                                   <div class="col-xs-12 cr-body panel-success" >
                                                       <div class="col col-xs-12" >
                                                           <section>
                                                               <div class="input input-file col-xs-4" style="padding: 0px">
                                                                   <span class="button " style="padding-top: 5px;padding-bottom: 5px"><input type="file" id="file4" name="file4">Subir imagen</span><input id="textfile4" type="text" placeholder="Incluir Archivo" readonly="" style="height: 39px">
                                                               </div>
                                                               <div class="col-xs-1"  style="padding: 0px">
                                                                   <button type="button" class="btn btn-danger btn-lg"style="margin-left:10px;"onclick="borrar_foto(4);">
                                                                       <span class="glyphicon glyphicon-trash"></span> 
                                                                   </button>
                                                               </div>
                                                           </section>
                                                          </div>  
                                                   </div> 
                                            </section>
                                        </div>
                                    </form>
                                        
                                </div>



                            </div>
                                </section>
                            </div> 
                        </div>            
    </section>
</div>



<div id="dlg_mapa_reg_lote" >
    <input type="hidden" id="hidden_inp_habilitacion" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
            <div id="legend"></div>
        </div>
    </form>
</div>
<div id="dlg_view_foto" style="display: none;">
    <div class="col-xs-12">
       <div class=" col-xs-3">
            <div class="input-group input-group-md">
                <input type="hidden" id="dlg_idpre" value="0">
                <span class="input-group-addon">Sector &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                <div class="icon-addon addon-md">
                    <input class="text-center col-xs-12 form-control"  style="height: 32px;" id="dlg_sec_foto" type="text" name="dlg_sec" disabled="" >
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="input-group input-group-md">
                <span class="input-group-addon">Manzana &nbsp;&nbsp;<i class="fa fa-apple"></i></span>
                <div class="icon-addon addon-md">
                    <input class="text-center form-control" style="height: 32px;" id="dlg_mzna_foto" type="text" name="dlg_mzna" disabled="" >
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="input-group input-group-md">
                <span class="input-group-addon">Lotes &nbsp;<i class="fa fa-home"></i></span>
                <div class="icon-addon addon-md">
                    <input class="text-center form-control" style="height: 32px;" id="dlg_lot_foto" type="text" name="dlg_mzna" disabled="" >
                    <input type="hidden" id="hidden_dlg_lot_foto" value="0">
                </div>
            </div>
        </div>
        <div class="col-xs-3" style="padding-left: 0px;">
            <button style="width: 100%" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="selec_reg_lote();">
                <span class="btn-label"><i class="glyphicon glyphicon-check"></i></span>Seleccinar Lote
            </button>
        </div>
    </div>
    <div class="panel panel-success cr-panel-sep" style="border:0px; margin-top: 10px">
        <div class="panel-body cr-body">
            <div id="dlg_img_view_big" style="padding-top: 0px"></div>
        </div>
    </div>
</div> 

<div id="dlg_aprobar_expediente" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Nro. Informe: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_aprob_exp" type="text" class="form-control" style="height: 30px;" maxlength="30">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<div id="dlg_notificaciones_eva_tec" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Notificacion: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_notificacion_eva_tec" type="text" class="form-control" style="height: 30px;" maxlength="50">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


<div id="dlg_entregar_a_usuario" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">DNI: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_dni_entregar" type="text" class="form-control" onkeypress="return soloNumeroTab(event);" style="height: 30px;" maxlength="8">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">                   
                     <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Usuario: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_nombre_entregar" type="text" class="form-control" style="height: 30px;" maxlength="30">
                        </div>
                    </div>
                </div>
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
@endsection


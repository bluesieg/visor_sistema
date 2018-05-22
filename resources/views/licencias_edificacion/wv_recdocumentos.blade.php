@extends('layouts.licencia_edificacion')
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
                                <a href="#s1" data-toggle="tab" aria-expanded="true" onclick="actualizar_grilla();">
                                    RECEPCION DOCUMENTOS
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false" onclick="seleccionafecha_asignacion();">
                                   ASIGNACION
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s3" data-toggle="tab" aria-expanded="false" onclick="seleccionafecha_verif_adm();">
                                   VERIFICACION ADMINISTRATIVA
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s4" data-toggle="tab" aria-expanded="false" onclick="seleccionafecha_verif_tec();">
                                   VERIFICACION TECNICA
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s5" data-toggle="tab" aria-expanded="false">
                                   EMITIR RESOLUCION
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
                                            
                                        <h1 ><b>RECEPCION DE DOCUMENTOS</b></h1>

                                        <div class="text-right" style=" padding-top: 20px">

                                             <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nuevo_documento();">
                                                     <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                             </button>
                                             <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_documento();">
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
                                    <article class="col-xs-12" style=" padding: 0px !important">
                                            <table id="table_recdocumentos"></table>
                                            <div id="pager_table_recdocumentos"></div>
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
                                            
                                    <h1 ><b>ASIGNACION</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="fec_ini_asignacion" type="text" onchange="seleccionafecha_asignacion();" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="fec_fin_asignacion" type="text" onchange="seleccionafecha_asignacion();" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="text-right" style=" padding-top: 20px">

                                           <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nueva_asignacion();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                           </button>

                                           <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_asignacion();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                           </button>

                                           <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_exp_asignacion();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                           </button>
                                           
                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                    </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_asignacion"></table>
                                                    <div id="pager_table_asignacion"></div>
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
                                            
                                    <h1><b>VERIFICACION ADMINISTRATIVA</b></h1>
                                        <div class="col-lg-3" style="padding-right: 0px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="fec_ini_verif_administrativa" onchange="seleccionafecha_verif_adm();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                        </div>
                                        <div class="col-lg-3" style="padding-right: 3px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="fec_fin_verif_administrativa" onchange="seleccionafecha_verif_adm();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-2" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                       
                                               <div class="icon-addon addon-md">
                                                   <input type="checkbox" id="dlg_ver_notificados" onclick="check_cambiar_estado('#dlg_ver_notificados')" style="width:22px;height:22px">VER NOTIFICADOS
                                               </div>
                                           </div>
                                        </div>
                                    
                                        <div class="text-right" style=" padding-top: 20px" id="botones_admin">

                                           <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nueva_verif_administrativa();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                           </button>

                                           <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_verif_administrativa();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                           </button>
                                           
                                           <button  type="button" class="btn btn-labeled bg-color-red txt-color-white" onclick="notificar();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Notificar
                                           </button>
                                           
                                           <button  type="button" class="btn btn-labeled bg-color-red txt-color-white" onclick="improcedente_verif_admin();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Improcedente
                                           </button>
                                           
                                           <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="revision_tecnica();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Enviar a Revision Tecnica
                                           </button>
                                           
                                           <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="regularizacion();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Regularizacion
                                           </button>
                                            
                                           <button  type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="cargar_lote();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Cargar Lote
                                           </button>
                                           
                                        </div>
                                        
                                        <div class="text-right" style=" padding-top: 20px" id="botones_notificacion">
                                            <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="ver_notificaciones_verif_admin();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir Notificacion
                                           </button>
                                        </div>
                                    
                                        
                                        </div>
                                        
                                    </section>
                                    
                                    </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_verif_administrativa"></table>
                                                    <div id="pager_table_verif_administrativa"></div>
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
                                            
                                    <h1 ><b>VERIFICACION TECNICA</b></h1>
                                        <div class="col-lg-3" style="padding-right: 0px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="fec_ini_verif_tecnica" onchange="seleccionafecha_verif_tec();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 3px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="fec_fin_verif_tecnica" onchange="seleccionafecha_verif_tec();" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="text-right" style=" padding-top: 20px">

                                           <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nueva_verif_tecnica();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                           </button>

                                           <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_verif_tecnica();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                           </button>
                                         
                                           <button  type="button" class="btn btn-labeled bg-color-red txt-color-white" onclick="improcedente_verif_tecnica();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Improcedente
                                           </button>
                                           
                                           <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="emitir_resolucion();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Emitir Resolucion
                                           </button>

                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                    </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px;">
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
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px; padding-left: 80px;">
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
        
        jQuery("#table_recdocumentos").jqGrid({
            url: 'get_documentos',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'NUMERO EXPEDIENTE','FASE','GESTOR','FECHA INICIO TRAMITE','FECHA REGISTRO'],
            rowNum: 50, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'RECEPCION DE DOCUMENTOS', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', align: 'left',width: 20, hidden: true},
                {name: 'nro_exp', index: 'nro_exp', align: 'left', width: 20},
                {name: 'fase', index: 'fase', align: 'left', width: 10},
                {name: 'gestor', index: 'gestor', align: 'left', width: 40},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 20},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 20}
            ],
            pager: '#pager_table_table_recdocumentos',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_recdocumentos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_recdocumentos').jqGrid('getDataIDs')[0];
                            $("#table_recdocumentos").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_documento();}
        });
        
        fecha_inicio_asignacion = $('#fec_ini_asignacion').val();
        fecha_fin_asignacion = $('#fec_fin_asignacion').val();
        jQuery("#table_asignacion").jqGrid({
            url: 'get_asignacion?fecha_inicio='+fecha_inicio_asignacion+'&fecha_fin='+fecha_fin_asignacion,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'NUMERO EXPEDIENTE','FECHA INGRESO','SOLICITANTE','CODIGO INTERNO','MODALIDAD'],
            rowNum: 50, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'ASIGNACION', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', align: 'left',width: 20, hidden: true},
                {name: 'nro_exp', index: 'nro_exp', align: 'left', width: 130},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 110},
                {name: 'gestor', index: 'gestor', align: 'left', width: 180},
                {name: 'cod_interno', index: 'cod_interno', align: 'left', width: 130},
                {name: 'descr_procedimiento', index: 'descr_procedimiento', align: 'left', width: 480}
            ],
            pager: '#pager_table_asignacion',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_asignacion').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_asignacion').jqGrid('getDataIDs')[0];
                            $("#table_asignacion").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){actualizar_asignacion();}
        });
        
        $("#dlg_asignacion").keypress(function (e) {
            if (e.which == 13) {

                   fn_obtener_exp();

            }
        });
        
        fecha_inicio_verif_admin = $('#fec_ini_verif_administrativa').val();
        fecha_fin_verif_admin = $('#fec_fin_verif_administrativa').val();
        $('#botones_notificacion').hide();
        jQuery("#table_verif_administrativa").jqGrid({
            url: 'get_verif_administrativa?fecha_inicio='+fecha_inicio_verif_admin+'&fecha_fin='+fecha_fin_verif_admin,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'CODIGO INTERNO','FECHA REGISTRO','DOC. GESTOR','GESTOR','MODALIDAD','FASE'],
            rowNum: 50, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'VERIFICACION ADMINISTRATIVA', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', align: 'left',width: 20, hidden: true},
                {name: 'cod_interno', index: 'nro_exp', align: 'left', width: 150},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 120},
                {name: 'nro_doc_gestor', index: 'nro_doc_gestor', align: 'left', width: 100},
                {name: 'gestor', index: 'gestor', align: 'left', width: 150},
                {name: 'descr_procedimiento', index: 'descr_procedimiento', align: 'left', width: 480},
                {name: 'fase', index: 'fase', align: 'left', width: 50, hidden:true}
            ],
            pager: '#pager_table_verif_administrativa',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_verif_administrativa').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_verif_administrativa').jqGrid('getDataIDs')[0];
                            $("#table_verif_administrativa").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){
                fase = $('#table_verif_administrativa').jqGrid ('getCell', Id, 'fase');
                if (fase == 3) {
                    modificar_verif_administrativa();
                }else{
                    elminar_notificacion(Id);
                } 
            }
        });
        
        
        $("#dlg_cod_interno").keypress(function (e) {
            if (e.which == 13) {

                   fn_obtener_exp_cod();

            }
        });
        
        jQuery("#table_requisito_admin").jqGrid({
            url: 'buscar_requisitos?indice='+0,
            datatype: 'json', mtype: 'GET',
            height: '240px', autowidth: true,
            toolbarfilter: true,
            colNames: ['COD.', 'REQUISITO','VERIFICACION','CHECKS'],
            rowNum: 50, sortname: 'id_requisito', sortorder: 'desc', viewrecords: true, caption: 'REQUISITOS', align: "center",
            colModel: [
                {name: 'id_requisito', index: 'id_reg_exp', align: 'left',width: 50},
                {name: 'cod_interno', index: 'nro_exp', align: 'left', width: 550},
                {name: 'checks', index: 'checks', align: 'center', width: 120},
                {name: 'checks1', index: 'checks1', align: 'center', width: 120, hidden:true}
            ],
            pager: '#pager_table_requisito_admin',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                  
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_documento();}
        });
        
        fecha_inicio_verif_tec = $('#fec_ini_verif_tecnica').val();
        fecha_fin_verif_tec = $('#fec_fin_verif_tecnica').val();
        jQuery("#table_verif_tecnica").jqGrid({
            url: 'get_verif_tecnica?fecha_inicio='+fecha_inicio_verif_tec+'&fecha_fin='+fecha_fin_verif_tec,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'CODIGO INTERNO','FECHA REGISTRO','DOC. GESTOR','GESTOR','MODALIDAD'],
            rowNum: 50, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'VERIFICACION TECNICA', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', align: 'left',width: 20, hidden: true},
                {name: 'cod_interno', index: 'nro_exp', align: 'left', width: 150},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 120},
                {name: 'nro_doc_gestor', index: 'nro_doc_gestor', align: 'left', width: 100},
                {name: 'gestor', index: 'gestor', align: 'left', width: 150},
                {name: 'descr_procedimiento', index: 'descr_procedimiento', align: 'left', width: 480}
            ],
            pager: '#pager_table_verif_tecnica',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_verif_tecnica').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_verif_tecnica').jqGrid('getDataIDs')[0];
                            $("#table_verif_tecnica").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_verif_tecnica()}
        });
        
        id_encargado = $('#dlg_encargado').val();
        jQuery("#table_revision_expediente").jqGrid({
            url: 'get_revision_expediente',
            datatype: 'json', mtype: 'GET',
            height: '240px', autowidth: true,
            toolbarfilter: true,
            colNames: ['CODIGO', 'DESCRIPCION','ESTADO','DOCUMENTOS','VERIFICACION','NOTIFICACION'],
            rowNum: 50, sortname: 'id_rev', sortorder: 'asc', viewrecords: true, caption: 'REVISION EXPEDIENTE', align: "center",
            colModel: [
                {name: 'id_rev', index: 'id_rev', align: 'left',width: 80},
                {name: 'descripcion', index: 'descripcion', align: 'left', width: 200},
                {name: 'estado', index: 'estado', align: 'center', width: 80},
                {name: 'documento', index: 'documento', align: 'left', width: 320},
                {name: 'verificacion', index: 'verificacion', align: 'left', width: 20, hidden:true},
                {name: 'notificacion', index: 'notificacion', align: 'center', width: 320}
            ],
            pager: '#pager_table_revision_expediente',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                  
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        
        jQuery("#table_rec_revision_expediente").jqGrid({
            url: '',
            datatype: 'json', mtype: 'GET',
            height: '240px', autowidth: true,
            toolbarfilter: true,
            colNames: ['CODIGO', 'DESCRIPCION','ESTADO','DOCUMENTOS','VER DOC.','VERIFICACION','NOTIFICACION','VER NOT.'],
            rowNum: 50, sortname: 'id_rev', sortorder: 'asc', viewrecords: true, caption: 'REVISION EXPEDIENTE', align: "center",
            colModel: [
                {name: 'id_rev', index: 'id_rev', align: 'left',width: 80},
                {name: 'descripcion', index: 'descripcion', align: 'left', width: 200},
                {name: 'estado', index: 'estado', align: 'center', width: 80},
                {name: 'documento', index: 'documento', align: 'left', width: 280},
                {name: 'verdocumento', index: 'documento', align: 'left', width: 120},
                {name: 'verificacion', index: 'verificacion', align: 'left', width: 20, hidden:true},
                {name: 'notificacion', index: 'notificacion', align: 'center', width: 280},
                {name: 'vernotificacion', index: 'notificacion', align: 'left', width: 120}
            ],
            pager: '#pager_table_rec_revision_expediente',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                  
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        
        
        jQuery("#table_escaneos").jqGrid({
            url: 'get_expedientes_resolucion?fecini='+$("#fec_ini_escaneo").val()+'&fecfin='+$("#fec_fin_escaneo").val(),
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'CODIGO EXPEDIENTE', 'SOLICITANTE','FECHA REGISTRO','SUBIR'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'CONSTANCIAS', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 200},
                {name: 'gestor', index: 'gestor', align: 'left', width: 380},
                {name: 'fecha_entrega', index: 'fecha_entrega', align: 'left', width: 150},
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
                jQuery("#table_doc").jqGrid('setGridParam', {url: 'get_docs?id='+Id}).trigger('reloadGrid');
            },
            ondblClickRow: function (Id){}
        });
        jQuery("#table_doc").jqGrid({
            url: '',
            datatype: 'json', mtype: 'GET',
            height: '200px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_doc_adj', 'Descripcion','Ver','Eliminar'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'DOCUMENTOS ESCANEADOS', align: "center",
            colModel: [
                {name: 'id_doc_adj', index: 'id_doc_adj', hidden: true},
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
        
        
        jQuery("#table_verif_admin_multas").jqGrid({
            url: '',
            datatype: 'json', mtype: 'GET',
            height: '240px', autowidth: true,
            toolbarfilter: true,
            colNames: ['COD.', 'REQUISITO','VERIFICACION'],
            rowNum: 50, sortname: 'id_requisito', sortorder: 'desc', viewrecords: true, caption: 'MULTAS', align: "center",
            colModel: [
                {name: 'id_requisito', index: 'id_reg_exp', align: 'left',width: 50},
                {name: 'cod_interno', index: 'nro_exp', align: 'left', width: 550},
                {name: 'checks', index: 'checks', align: 'center', width: 120}
            ],
            pager: '#pager_table_verif_admin_multas',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                  
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/licencias_edificacion/recdocumentos.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/licencias_edificacion/asignacion.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/licencias_edificacion/verificacion_administrativa.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/licencias_edificacion/verificacion_tecnica.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/licencias_edificacion/escaneo.js') }}"></script>

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


<div id="dlg_nueva_asignacion" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Cod. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input type="hidden" id="id_asignacion">
                            <input id="dlg_asignacion" type="text" class="form-control text-center" style="height: 30px;" maxlength="20">
                        </div>
                    </div>
                </div>
            </div>
 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Modalidad: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <select id="dlg_modalidad" class="form-control" style="height: 30px;" >
                                @foreach($modalidad as $modalidades)
                                <option value="{{$modalidades->id_procedimiento}}">{{$modalidades->descr_procedimiento}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Cod. Interno: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_codigo_interno" type="text" class="form-control text-center" style="height: 30px;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dlg_verif_administrativa" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Cod. Interno: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_cod_interno" type="text" class="form-control text-center" style="height: 30px;" maxlength="20">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Num. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_hidden_id_reg_exp" type="hidden">
                            <input id="dlg_num_expediente" type="text" class="form-control text-center" style="height: 30px;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Gestor: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_gestor" type="text" class="form-control text-center" style="height: 30px;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Modalidad: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_hidden_id_procedimiento" type="hidden">
                            <input id="dlg_modalidad_administrativa" type="text" class="form-control text-center" style="height: 30px;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px">
                <center>
                <article class="col-xs-11" style=" padding: 0px !important">
                        <table id="table_requisito_admin"></table>
                        <div id="pager_table_requisito_admin"></div>
                </article></center>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Observaciones: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <textarea id="dlg_observaciones" type="text" class="form-control text-left" style="height: 65px;"  ></textarea>
                        </div>
                    </div>
                </div>
            </div>
        
        
        </div>
    </div>
</div>



<div id="dlg_verif_tecnica" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
        <form id="FormularioEscaneo" name="FormularioEscaneo" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" id="_token1" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}"> 
            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Cod. Interno: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_cod_interno_verif_tecnica" type="text" class="form-control text-center" style="height: 30px;" maxlength="20" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Num. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_hidden_verif_tecnica_id_reg_exp" name="dlg_hidden_verif_tecnica_id_reg_exp" type="hidden">
                            <input id="dlg_num_expediente_verif_tecnica" type="text" class="form-control text-center" style="height: 30px;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Gestor: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_gestor_verif_tecnica" type="text" class="form-control text-center" style="height: 30px;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Modalidad: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_modalidad_administrativa_verif_tecnica" type="text" class="form-control text-center" style="height: 30px;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Encargado: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                        <select id='dlg_encargado' name="dlg_encargado" onchange="cambiar_encargado();" class="form-control col-lg-8" style="height: 32px;">
                        @foreach ($encargados as $encargado)
                        <option value='{{$encargado->id_encargado}}' >{{$encargado->descripcion}}</option>
                        @endforeach
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <input type="hidden" value='' id='notificacion_1' name="notificacion1"/>
            <input type="hidden" value='' id='notificacion_2' name="notificacion2"/>
            <input type="hidden" value='' id='notificacion_3' name="notificacion3"/>
            <input type="hidden" value='' id='notificacion_4' name="notificacion4"/>
            <input type="hidden" value='' id='notificacion_5' name="notificacion5"/>
            <input type="hidden" value='' id='notificacion_6' name="notificacion6"/>
        
            <div class="col-xs-12 col-md-12 col-lg-12" id="tabla1" style="padding: 0px; margin-top: 10px">
                <center>
                <article class="col-xs-11" style=" padding: 0px !important">
                        <table id="table_revision_expediente"></table>
                        <div id="pager_table_revision_expediente"></div>
                </article></center>
            </div>
            
            <div class="col-xs-12" id="tabla2" style="padding: 0px; margin-top: 10px">
                <article class="col-xs-11" style=" padding: 0px !important">
                        <table id="table_rec_revision_expediente"></table>
                        <div id="pager_table_rec_revision_expediente"></div>
                </article>
            </div>
            
           </form>
        </div>
    </div>
</div>

<div id="dlg_editor" style="display: none;">
    <div class="widget-body no-padding">
                <textarea id="ckeditor" name="ckeditor">
                    
                </textarea>
            </div>
</div>

<div id="dlg_subir_escaneo" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <form id="FormularioScans" name="FormularioScans" method="post" enctype="multipart/form-data" action="callpdf_resolucion"  target="ifrafile">
                <input type="hidden" name="_token" id="_token2" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}"> 
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


<div id="dlg_verif_admin_regularizacion" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Cod. Interno: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_cod_interno_reg" type="text" class="form-control text-center" style="height: 30px;" maxlength="20">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Num. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_hidden_id_reg_exp_reg" type="hidden">
                            <input id="dlg_num_expediente_reg" type="text" class="form-control text-center" style="height: 30px;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Gestor: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_gestor_reg" type="text" class="form-control text-center" style="height: 30px;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; padding-top: 10px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Modalidad: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <select id='dlg_modalidad_administrativa_reg' class="form-control col-lg-8" style="height: 32px;" disabled="">
                            @foreach ($multas as $multa)
                            <option value='{{$multa->id_procedimiento}}' >{{$multa->descr_procedimiento}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px">
                <center>
                <article class="col-xs-11" style=" padding: 0px !important">
                        <table id="table_verif_admin_multas"></table>
                        <div id="pager_table_verif_admin_multas"></div>
                </article></center>
            </div>

        </div>
    </div>
</div>

<div id="dlg_editor_1" style="display: none;">
    <div class="widget-body no-padding">
        <textarea id="ckeditor_1" name="ckeditor_1">
            Escribir Notificacion 1
        </textarea>
    </div>
</div>

<div id="dlg_editor_2" style="display: none;">
    <div class="widget-body no-padding">
        <textarea id="ckeditor_2" name="ckeditor_2">
            Escribir Notificacion 1
        </textarea>
    </div>
</div>

<div id="dlg_editor_3" style="display: none;">
    <div class="widget-body no-padding">
        <textarea id="ckeditor_3" name="ckeditor_3">
            Escribir Notificacion 3
        </textarea>
    </div>
</div>

<div id="dlg_editor_4" style="display: none;">
    <div class="widget-body no-padding">
        <textarea id="ckeditor_4" name="ckeditor_4">
            Escribir Notificacion 4
        </textarea>
    </div>
</div>

<div id="dlg_editor_5" style="display: none;">
    <div class="widget-body no-padding">
        <textarea id="ckeditor_5" name="ckeditor_5">
            Escribir Notificacion 5
        </textarea>
    </div>
</div>

<div id="dlg_editor_6" style="display: none;">
    <div class="widget-body no-padding">
        <textarea id="ckeditor_6" name="ckeditor_6">
            Escribir Notificacion 6
        </textarea>
    </div>
</div>


<div id="dlg_cargar_lote" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                
                <div class="col-xs-8" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Cod. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input type="hidden" id="id_reg_exp_lote">
                            <input type="hidden" id="id_expediente_lote">
                            <input id="codigo_expediente_lote" type="text" class="form-control" style="height: 30px;" disabled="">
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-4" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <button  type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="cargar_mapa();">
                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Cargar Mapa
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                
                <div class="col-xs-8" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Lote Seleccionado: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="lote_verif_admin" type="text" class="form-control" style="height: 30px;" disabled="">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div id="dlg_mapa_verif_admin" >
    <input type="hidden" id="hidden_inp_habilitacion" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>

@endsection


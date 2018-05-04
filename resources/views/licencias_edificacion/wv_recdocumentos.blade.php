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
                                <a href="#s1" data-toggle="tab" aria-expanded="true">
                                    RECEPCION DOCUMENTOS
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   ASIGNACION
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s3" data-toggle="tab" aria-expanded="false">
                                   VERIFICACION ADMINISTRATIVA
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
                                                   <input  id="fec_ini_asignacion" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="fec_fin_asignacion" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="text-right" style=" padding-top: 20px">

                                           <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nueva_asignacion();">
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
                                            
                                    <h1 ><b>VERIFICACION ADMINISTRATIVA</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="fec_ini_verif_administrativa" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="fec_fin_verif_administrativa" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="text-right" style=" padding-top: 20px">

                                           <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nueva_verif_administrativa();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                           </button>

                                           <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_verif_administrativa();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
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
        
        jQuery("#table_asignacion").jqGrid({
            url: 'get_asignacion',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'NUMERO EXPEDIENTE','FECHA INGRESO','SOLICITANTE','CODIGO INTERNO','MODALIDAD'],
            rowNum: 50, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'ASIGNACION', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', align: 'left',width: 20, hidden: true},
                {name: 'nro_exp', index: 'nro_exp', align: 'left', width: 150},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 120},
                {name: 'gestor', index: 'gestor', align: 'left', width: 120},
                {name: 'cod_interno', index: 'cod_interno', align: 'left', width: 150},
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
            ondblClickRow: function (Id){modificar_documento();}
        });
        
        $("#dlg_asignacion").keypress(function (e) {
            if (e.which == 13) {

                   fn_obtener_exp();

            }
        });
        
        jQuery("#table_verif_administrativa").jqGrid({
            url: 'get_verif_administrativa',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'CODIGO INTERNO','FECHA REGISTRO','DOC. GESTOR','GESTOR','MODALIDAD'],
            rowNum: 50, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'VERIFICACION ADMINISTRATIVA', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', align: 'left',width: 20, hidden: true},
                {name: 'cod_interno', index: 'nro_exp', align: 'left', width: 150},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 120},
                {name: 'nro_doc_gestor', index: 'nro_doc_gestor', align: 'left', width: 100},
                {name: 'gestor', index: 'gestor', align: 'left', width: 150},
                {name: 'descr_procedimiento', index: 'descr_procedimiento', align: 'left', width: 480}
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
            ondblClickRow: function (Id){modificar_verif_administrativa();}
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
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/licencias_edificacion/recdocumentos.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/licencias_edificacion/asignacion.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/licencias_edificacion/verificacion_administrativa.js') }}"></script>

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
                            <input id="dlg_observaciones" type="text" class="form-control text-left" style="height: 30px;">
                        </div>
                    </div>
                </div>
            </div>
        
        
        </div>
    </div>
</div>


@endsection


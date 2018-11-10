@extends('layouts.gerencia_obras_pub_infra')
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
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                        <div class="col-xs-12">
                                            
                                        <h1 ><b>MODULO DE MANTENIMIENTO</b></h1>
                                        
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">MANTENIMIENTO:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_mantenimiento" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="NOMBRE MANTENIMIENTO">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="fn_buscar_nombre_mantenimiento();">
                                                            <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>BUSCAR
                                                        </button>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-5 text-center">

                                                <button  type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="nuevo_mantenimiento();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>NUEVO
                                                </button>
                                                
                                                 <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_mantenimiento();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>MODIFICAR
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_mantenimiento"></table>
                                                        <div id="pager_table_mantenimiento"></div>
                                                </article>
                                            </div>
                                        
                                        </div> 
                                    </section> 
                                </div>
                            </div>
                           </div>
                        </section>
                    </section>
                </div>
            </div>            
        </div>       
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function (){
        
        jQuery("#table_mantenimiento").jqGrid({
            url: 'sub_geren_apoyo_matenimiento/0?grid=mantenimiento',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'MANTENIMIENTO', 'MODALIDAD','HAB. URB.','FEC. INICIO','FEC. TERMINO'],
            rowNum: 50, sortname: 'id_mantenimiento', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE MANTENIMIENTOS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_mantenimiento', index: 'id_mantenimiento', hidden: true},
                {name: 'nombre', index: 'nombre', align: 'left', width: 30},
                {name: 'estado', index: 'estado', align: 'center', width: 15},
                {name: 'nomb_hab_urba', index: 'nomb_hab_urba', align: 'center', width: 40},
                {name: 'fecha_inicio', index: 'fecha_inicio', align: 'center', width: 14},
                {name: 'fecha_termino', index: 'fecha_termino', align: 'center', width: 14}
            ],
            pager: '#pager_table_mantenimiento',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_mantenimiento').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_mantenimiento').jqGrid('getDataIDs')[0];
                            $("#table_mantenimiento").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_mantenimiento();}
        });
        
        $("#dlg_buscar_mantenimiento").keypress(function (e) {
            if (e.which == 13) {

                   fn_buscar_nombre_mantenimiento();

            }
        });
        
        $("#dlg_dni_ejecutor").keypress(function (e) {
            if (e.which == 13) {
                consultar_dni($("#dlg_dni_ejecutor").val(),'hidden_dlg_ejecutor','dlg_ejecutor');
            }
        });
        
        $("#dlg_dni_supervisor").keypress(function (e) {
            if (e.which == 13) {
                consultar_dni($("#dlg_dni_supervisor").val(),'hidden_dlg_supervisor','dlg_supervisor');
            }
        });
        
        $("#dlg_dni_residente").keypress(function (e) {
            if (e.which == 13) {
                consultar_dni($("#dlg_dni_residente").val(),'hidden_dlg_residente','dlg_residente');
            }
        });
        
        jQuery("#table_fotos_mantenimiento").jqGrid({
            url: 'sub_geren_apoyo_matenimiento/0?grid=fotos_mantenimiento&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'FECHA REGISTRO','FOTOS','ESTADO'],
            rowNum: 50, sortname: 'id_foto_mant', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE FOTOS', align: "center",
            colModel: [
                {name: 'id_foto_mant', index: 'id_foto_mant', align: 'left',width: 20, hidden: true},
                {name: 'fecha_creacion', index: 'fecha_creacion', align: 'center', width: 300},
                {name: 'foto', index: 'foto', align: 'center', width: 200},
                {name: 'estado', index: 'estado', align: 'center', width: 200}
            ],
            pager: '#pager_table_fotos_mantenimiento',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_fotos_mantenimiento').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_fotos_mantenimiento').jqGrid('getDataIDs')[0];
                            $("#table_fotos_mantenimiento").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_foto()}
        });
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_obras_pub_infra/mantenimiento.js') }}"></script>

<div id="dlg_nuevo_mantenimiento" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS PERSONAS</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">DNI: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_dni_ejecutor" type="text" maxlength="8" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">EJECUTOR: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input type="hidden" id="hidden_dlg_ejecutor" value="0">
                        <input id="dlg_ejecutor" type="text" maxlength="250" class="form-control text-uppercase" style="height: 30px;"  disabled="">
                    </div>
                </div>
            </div> 
            
            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">DNI: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_dni_supervisor" type="text" maxlength="8" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">SUPERVISOR: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input type="hidden" id="hidden_dlg_supervisor" value="0">
                        <input id="dlg_supervisor" type="text" maxlength="250" class="form-control text-uppercase" style="height: 30px;"  disabled="">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">DNI: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_dni_residente" type="text" maxlength="8" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">RESIDENTE: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input type="hidden" id="hidden_dlg_residente" value="0">
                        <input id="dlg_residente" type="text" maxlength="250" class="form-control text-uppercase" style="height: 30px;"  disabled="">
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    </div>
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">INFORMACION CATASTRAL</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-10" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">UBICACION: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input type="hidden" id="id_lote_mantenimiento" value="0">
                        <input id="dlg_ubicacion" type="text" maxlength="20" class="form-control text-uppercase" style="height: 30px;"  disabled="">
                    </div>
                </div>
            </div> 

            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_mantenimiento();" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>VER MAPA
            </button>
            
        </div>
    </div>
    </div>
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">INFORMACION MANTENIMIENTO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-4" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" style="width: 120px">DISTRITO: &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='distrito' class="form-control col-xs-12 col-md-12 col-lg-12" style="height: 32px;">
                            <option value="CERRO COLORADO">CERRO COLORADO</option>
                        </select>                       
                    </div>
                </div>
            </div>

            <div class="col-xs-4" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" style="width: 192px">PROVINCIA: &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='provincia' class="form-control col-xs-12 col-md-12 col-lg-12" style="height: 32px;">
                            <option value="AREQUIPA">AREQUIPA</option>
                        </select>                       
                    </div>
                </div>
            </div> 

            <div class="col-xs-4" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" style="width: 192px">DEPARTAMENTO: &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='departamento' class="form-control col-xs-12 col-md-12 col-lg-12" style="height: 32px;">
                            <option value="AREQUIPA">AREQUIPA</option>
                        </select>                       
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">NOMBRE MANTENIMIENTO: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_nombre_mant" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>

            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">TIPO MANTENIMIENTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_tipo_mant" type="text" maxlength="250" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" style="width: 192px">MODALIDAD EJECUCION: &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='modalidad_ejecucion' class="form-control col-xs-12 col-md-12 col-lg-12" style="height: 32px;">
                            <option value="0">-- SELECCIONAR UNA OPCION --</option>
                             @foreach($modalidad as $mod)
                             <option value="{{ $mod->id_modalidad_ejec }}">-- {{ $mod->descripcion }} --</option>
                             @endforeach
                        </select>                       
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACION: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <textarea id="dlg_observacion" rows="6" type="text" class="form-control text-uppercase" style="height: 90px;"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">INFORME TECNICO: &nbsp;<i class="fa fa-angle-up"></i></span>
                    <div>
                        <input id="chkbox_informe_tecnico" type="checkbox" class="form-control" style="height: 30px;">
                    </div>
                </div>
            </div>

            <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">TIEMPO EJECUCION: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_tiempo_ejecucion" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>

            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">BENEFICIARIOS: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_beneficiarios" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FECHA INICIO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_fecha_inicio" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 30px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FECHA TERMINO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_fecha_termino" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 30px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                    </div>
                </div>
            </div>

            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DESCRIPCION: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <textarea id="dlg_descripcion" rows="6" type="text" class="form-control text-uppercase" style="height: 90px;"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" style="width: 192px">EST. MANTE.: &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='est_mantenimiento' class="form-control col-xs-12 col-md-12 col-lg-12" style="height: 32px;">
                            <option value="0">-- SELECCIONAR UNA OPCION --</option>
                             @foreach($estado as $est)
                             <option value="{{ $est->id_estado_mant }}">-- {{ $est->descripcion }} --</option>
                             @endforeach
                        </select>                       
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">AVANCE FISICO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_avance_fisico" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">AVANCE FINANCIERO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_avance_financiero" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div id="btn_agregar_mantenimiento">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="guardar_editar_datos(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>GUARDAR DATOS
            </button>
            </div>
            
            <div id="btn_modificar_mantenimiento">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="guardar_editar_datos(2);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-edit"></i></span>MODIFICAR DATOS
            </button>
            </div>
        </div>
    </div>
    </div>
    
    <input type="hidden" id="id_mantenimiento">
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">FOTOS</div>
    
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <div class="col-xs-10" style="padding-left: 40px">
                    <table id="table_fotos_mantenimiento" ></table>
                    <div id="pager_table_fotos_mantenimiento"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_foto();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_foto();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_foto();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dlg_nueva_foto" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">FOTOS</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <form id="FormularioFotosMantenimiento" name="FormularioFotosMantenimiento" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token1" id="_token1" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}">
                
                <input type="hidden" id="id_mantenimiento_foto" name="id_mantenimiento_foto">
                
                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 180px">SUBIR FOTO: &nbsp;<i class="fa fa-search"></i></span>
                        <div>
                            <input id="dlg_foto_mantenimiento" name="dlg_foto_mantenimiento" type="file" maxlength="255" class="form-control text-uppercase" style="height: 30px;" onchange="return validarExtensionArchivo();">
                        </div>
                    </div>
                </div> 
            </form>
            
        </div>
    </div>
    </div>    
</div>

<div id="dlg_ver_foto" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">FOTO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <img id="form_foto" name="form_foto" style="width: 718px;height: 400px;border: 1px solid #fff; outline: 1px solid #bfbfbf;">   
                </div>
            </div> 

        </div>
    </div>
    </div>    
</div>

<div id="dlg_mapa_mantenimiento" >
    <input type="hidden" id="hidden_input_habilitacion_mantenimiento" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_mantenimiento" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>

@include('vw_personas')

@endsection


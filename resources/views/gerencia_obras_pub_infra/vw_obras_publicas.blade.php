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
                                            
                                        <h1 ><b>MODULO DE OBRAS PUBLICAS</b></h1>
                                        
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">OBRA:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_obra" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="NOMBRE DE LA OBRA">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="fn_buscar_nombre_obras();">
                                                            <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>BUSCAR
                                                        </button>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-5 text-center">

                                                <button  type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="nueva_obra();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>NUEVO
                                                </button>
                                                
                                                 <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_obra();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>MODIFICAR
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_obras"></table>
                                                        <div id="pager_table_obras"></div>
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
        
        jQuery("#table_obras").jqGrid({
            url: 'sub_geren_obras_publicas/0?grid=obras_publicas',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'OBRA', 'TIPO','HAB. URB.','MODALIDAD','ESTADO'],
            rowNum: 50, sortname: 'id_obra', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE OBRAS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_obra', index: 'id_obra', hidden: true},
                {name: 'nombre', index: 'nombre', align: 'left', width: 30},
                {name: 'tipo_obra', index: 'tipo_obra', align: 'center', width: 35},
                {name: 'nomb_hab_urba', index: 'nomb_hab_urba', align: 'center', width: 40},
                {name: 'modalidad', index: 'modalidad', align: 'center', width: 35},
                {name: 'estado_obra', index: 'estado_obra', align: 'center', width: 20}
            ],
            pager: '#pager_table_obras',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_obras').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_obras').jqGrid('getDataIDs')[0];
                            $("#table_obras").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_obra();}
        });
        
        $("#dlg_buscar_obra").keypress(function (e) {
            if (e.which == 13) {

                   fn_buscar_nombre_obras();

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
        
        jQuery("#table_fotos_obra").jqGrid({
            url: 'sub_geren_obras_publicas/0?grid=fotos_obra&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'FECHA REGISTRO','FOTOS','ESTADO'],
            rowNum: 50, sortname: 'id_foto_obra', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE FOTOS', align: "center",
            colModel: [
                {name: 'id_foto_obra', index: 'id_foto_obra', align: 'left',width: 20, hidden: true},
                {name: 'fecha_creacion', index: 'fecha_creacion', align: 'center', width: 300},
                {name: 'foto', index: 'foto', align: 'center', width: 200},
                {name: 'estado', index: 'estado', align: 'center', width: 200}
            ],
            pager: '#pager_table_fotos_obra',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_fotos_obra').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_fotos_obra').jqGrid('getDataIDs')[0];
                            $("#table_fotos_obra").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_foto()}
        });
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_obras_pub_infra/obras_publicas.js') }}"></script>

<div id="dlg_nueva_obra" style="display: none;">
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
                        <input type="hidden" id="id_lote_obra" value="0">
                        <input id="dlg_ubicacion" type="text" maxlength="20" class="form-control text-uppercase" style="height: 30px;"  disabled="">
                    </div>
                </div>
            </div> 

            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_obra();" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>VER MAPA
            </button>
            
        </div>
    </div>
    </div>
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">INFORMACION OBRA</div>
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
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">NOMBRE DE LA OBRA: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_nombre_obra" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" style="width: 192px">TIPO DE OBRA: &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='tipo_obra' class="form-control col-xs-12 col-md-12 col-lg-12" style="height: 32px;">
                            <option value="0">-- SELECCIONAR UNA OPCION --</option>
                            @foreach($tipo_obra as $tip_o)
                                <option value="{{ $tip_o->id_tipo_obra }}">-- {{ $tip_o->descripcion }} --</option>
                            @endforeach
                        </select>                       
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" style="width: 192px">MODALIDAD EJECUCION: &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='modalidad_ejecucion' class="form-control col-xs-12 col-md-12 col-lg-12" style="height: 32px;">
                            <option value="0">-- SELECCIONAR UNA OPCION --</option>
                            @foreach($modalidad_ejecucion as $modalidad_ejec)
                                <option value="{{ $modalidad_ejec->id_modalidad_ejec }}">-- {{ $modalidad_ejec->descripcion }} --</option>
                            @endforeach
                        </select>                       
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">MONTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_monto" type="text" class="form-control text-uppercase" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
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
                    <span class="input-group-addon" style="width: 192px">CODIGO SNIP: &nbsp;<i class="fa fa-angle-up"></i></span>
                    <div>
                        <input id="dlg_codigo_snip" type="text" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">PERFIL: &nbsp;<i class="fa fa-angle-up"></i></span>
                    <div>
                        <input id="chkbox_perfil" type="checkbox" class="form-control" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">EXPEDIENTE TECNICO: &nbsp;<i class="fa fa-angle-up"></i></span>
                    <div>
                        <input id="chkbox_expediente_tecnico" type="checkbox" class="form-control" style="height: 30px;">
                    </div>
                </div>
            </div>

            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">TIEMPO EJECUCION: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_tiempo_ejecucion" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>

            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
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
                    <span class="input-group-addon" style="width: 192px">ESTADO DE LA OBRA: &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='id_estado_obra' class="form-control col-xs-12 col-md-12 col-lg-12" style="height: 32px;">
                            <option value="0">-- SELECCIONAR UNA OPCION --</option>
                            @foreach($estado_obra as $est_obr)
                                <option value="{{ $est_obr->id_estado_obra }}">-- {{ $est_obr->descripcion }} --</option>
                            @endforeach
                        </select>                       
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">AVANCE FISICO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_avance_fisico" type="text" class="form-control text-uppercase" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">AVANCE FINANCIERO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_avance_financiero" type="text" class="form-control text-uppercase" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div id="btn_agregar_obra">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="guardar_editar_datos(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>GUARDAR DATOS
            </button>
            </div>
            
            <div id="btn_modificar_obra">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="guardar_editar_datos(2);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-edit"></i></span>MODIFICAR DATOS
            </button>
            </div>
        </div>
    </div>
    </div>
    
    <input type="hidden" id="id_obra">
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">FOTOS</div>
    
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <div class="col-xs-10" style="padding-left: 40px">
                    <table id="table_fotos_obra" ></table>
                    <div id="pager_table_fotos_obra"></div>
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
            
            <form id="FormularioFotosObra" name="FormularioFotosObra" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token1" id="_token1" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}">
                
                <input type="hidden" id="id_obra_foto" name="id_obra_foto">
                
                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 180px">SUBIR FOTO: &nbsp;<i class="fa fa-search"></i></span>
                        <div>
                            <input id="dlg_foto_obra" name="dlg_foto_obra" type="file" class="form-control text-uppercase" style="height: 30px;" onchange="validarExtensionArchivo();">
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

<div id="dlg_mapa_obra" >
    <input type="hidden" id="hidden_input_habilitacion_obra" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_obra" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>

@include('vw_personas')

@endsection


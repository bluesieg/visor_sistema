@extends('layouts.gerencia_seg_ciud')
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
                                            
                                        <h1 ><b>MANTENIMIENTO DE COMISARIAS</b></h1>
                                        
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">COMISARIA:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_comisaria" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE COMISARIA">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="fn_buscar_comisaria();">
                                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                        </button>
                                                </div>
                                            </div>
                                            
                                           <div class="col-xs-5 text-center">
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_comisarias();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar Comisaria
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_comisarias"></table>
                                                        <div id="pager_table_comisarias"></div>
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
        
        jQuery("#table_comisarias").jqGrid({
            url: 'sub_geren_op_vigilancia_interna/0?grid=comisarias',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'NOMBRE COMISARIA', 'TELEFONO', 'Nº VEHICULOS','Nº EFECTIVOS','UBICACION'],
            rowNum: 50, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE COMISARIAS REGISTRADAS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id', index: 'id', hidden: true},
                {name: 'nombre', index: 'nombre', align: 'left', width: 35},
                {name: 'telefono', index: 'telefono', align: 'center', width: 10},
                {name: 'nro_vehiculos', index: 'nro_vehiculos', align: 'center', width: 12},
                {name: 'nro_efectivos', index: 'nro_efectivos', align: 'center', width: 12},
                {name: 'ubicacion', index: 'ubicacion', align: 'left', width: 40}
            ],
            pager: '#pager_table_comisarias',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_comisarias').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_comisarias').jqGrid('getDataIDs')[0];
                            $("#table_comisarias").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_comisarias();}
        });
        
        $("#dlg_buscar_comisaria").keypress(function (e) {
            if (e.which == 13) {

                   fn_buscar_comisaria();

            }
        });
        
        jQuery("#table_observaciones").jqGrid({
            url: 'sub_geren_op_vigilancia_interna/0?grid=observaciones_comisarias&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'FECHA REGISTRO','OBSERVACIONES'],
            rowNum: 50, sortname: 'id_observacion', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES', align: "center",
            colModel: [
                {name: 'id_observacion', index: 'id_observacion', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 130},
                {name: 'observacion', index: 'observacion', align: 'left', width: 730}
            ],
            pager: '#pager_table_observaciones',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones').jqGrid('getDataIDs')[0];
                            $("#table_observaciones").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion()}
        });
        
        jQuery("#table_personal_comisaria").jqGrid({
            url: 'sub_geren_op_vigilancia_interna/0?grid=personal_comisaria&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'DNI','PERSONA','TELEFONO','TIPO','FEC. REGISTRO','ESTADO'],
            rowNum: 50, sortname: 'id_personal_comisaria', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE PERSONAS', align: "center",
            colModel: [
                {name: 'id_personal_comisaria', index: 'id_personal_comisaria', align: 'left',width: 20, hidden: true},
                {name: 'dni', index: 'dni', align: 'center', width: 100},
                {name: 'persona', index: 'persona', align: 'left', width: 310},
                {name: 'telefono', index: 'telefono', align: 'center', width: 100},
                {name: 'descripcion', index: 'descripcion', align: 'left', width: 100},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'center', width: 120},
                {name: 'estado', index: 'estado', align: 'left', width: 110}
            ],
            pager: '#pager_table_personal_comisaria',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_personal_comisaria').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_personal_comisaria').jqGrid('getDataIDs')[0];
                            $("#table_personal_comisaria").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_persona()}
        });
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/comisarias.js') }}"></script>

<div id="dlg_nuevo_comisarias" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS COMISARIA</div>
        <div class="col-xs-8 col-md-8 col-lg-8" style="padding: 0px; margin-top: 0px;">
            <form id="FormularioComisarias" name="FormularioComisarias" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">UBICACION: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="dlg_ubicacion" type="text" name="dlg_ubicacion" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 175px">NOMBRE COMISARIA: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="dlg_nombre_comisaria" name="dlg_nombre_comisaria" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">TEL. COMISARIA: &nbsp;<i class="fa fa-phone"></i></span>
                    <div> 
                        <input id="dlg_telefono_comisaria" name="dlg_telefono_comisaria" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px"> 
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">Nº EFECTIVOS: &nbsp;<i class="fa fa-user-plus"></i></span>
                    <div>
                        <input id="dlg_nro_efectivos" type="text" name="dlg_nro_efectivos" class="form-control" maxlength="20" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>

            <div class="col-xs-6" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 160px">Nº VEHICULOS: &nbsp;<i class="fa fa-car"></i></span>
                    <div>
                        <input id="dlg_nro_vehiculos" type="text" name="dlg_nro_vehiculos" class="form-control" style="height: 30px;" maxlength="20" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
                
            <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FOTO COMISARIA: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_foto_comisaria" name="dlg_foto_comisaria" type="file" class="form-control" style="height: 30px;" onchange="validar_foto_comisaria();">
                    </div>
                </div>
            </div>

            </form>        
        </div>
        
        <div class="col-xs-4 col-md-4 col-lg-4" style="padding: 0px; margin-top: 0px;">
            <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <center><img id="dlg_mostrar_foto_comisaria" class="col-xs-12 text-align-center" style="max-height:350px; max-width:280px; padding-left: 80px;"></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">PERSONAL COMISARIA</div>
    
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <div class="col-xs-10">
                    <table id="table_personal_comisaria" ></table>
                    <div id="pager_table_personal_comisaria"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_persona();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_persona();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_persona();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
        </div>
    </div>
    
    <input type="hidden" id="id_comisaria">
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">OBSERVACIONES</div>
    
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <div class="col-xs-10">
                    <table id="table_observaciones" ></table>
                    <div id="pager_table_observaciones"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dlg_nueva_observacion" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body panel-success">
            <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">

                <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 180px">FECHA REGISTRO &nbsp;<i class="fa fa-calendar"></i></span>
                        <div>
                            <input id="dlg_fecha_observacion" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 30px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                </div>

                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                        <div>
                            <textarea id="dlg_observacion" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                        </div>
                    </div>
                </div> 

            </div>
        </div>
    </div>
</div>

<div id="dlg_nueva_persona" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS PERSONA</div>
        <div id="formulario_persona" class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <form id="FormularioPersonas" name="FormularioPersonas" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token1" id="_token1" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}">
            
                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 192px">DNI: &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_dni" name="dlg_dni" type="text" class="form-control text-uppercase" maxlength="8" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                        </div>
                    </div>
                </div>

                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 192px">NOMBRES: &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_nombres" name="dlg_nombres" type="text" class="form-control text-uppercase" style="height: 30px;">
                        </div>
                    </div>
                </div>

                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 192px">AP. PATERNO: &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_apaterno" name="dlg_apaterno" type="text" class="form-control text-uppercase" style="height: 30px;">
                        </div>
                    </div>
                </div>

                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 192px">AP. MATERNO: &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_amaterno" name="dlg_amaterno" type="text" class="form-control text-uppercase" style="height: 30px;">
                        </div>
                    </div>
                </div>

                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 192px">TELEFONO: &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_telefono" name="dlg_telefono" type="text" maxlength="9" class="form-control text-uppercase" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                        </div>
                    </div>
                </div>

                <div class="col-xs-12" style="padding: 0px; margin-top:10px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon" style="width: 192px">TIPO PERSONA: &nbsp;<i class="fa fa-list"></i></span>
                        <div>
                            <select id='dlg_tipo_persona' name="dlg_tipo_persona" class="form-control" style="height: 32px;">
                                <option value="0">-- SELECCIONAR UNA OPCION --</option>
                                 @foreach($tipo_persona as $tip)
                                 <option value="{{ $tip->id_tipo_per }}">-- {{ $tip->descripcion }} --</option>
                                 @endforeach
                            </select>                       
                        </div>
                    </div>
                </div>

                <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 192px">FOTO PERSONA: &nbsp;<i class="fa fa-user"></i></span>
                        <div>
                            <input id="dlg_foto_persona" name="dlg_foto_persona" type="file" class="form-control" style="height: 30px;" onchange="validar_foto_persona();">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div id="foto_persona" class="col-xs-4 col-md-4 col-lg-4" style="padding: 0px; margin-top: 0px;">
            <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <center><img id="dlg_mostrar_foto_persona" class="col-xs-12 text-align-center" style="max-height:350px; max-width:280px; padding-left: 50px; padding-top: 30px;"></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
</div>

@endsection


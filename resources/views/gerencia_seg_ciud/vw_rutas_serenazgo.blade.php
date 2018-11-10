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
                                            
                                        <h1 ><b>MANTENIMIENTO DE RUTAS SERENAZGO</b></h1>
                                        
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">UBICACION:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_ruta" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR RUTA">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="fn_buscar_ruta_serenazgo();">
                                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                        </button>
                                                </div>
                                            </div>
                                            
                                           <div class="col-xs-5 text-center">

                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_ruta_serenazgo();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar ruta
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_rutas_serenazgo"></table>
                                                        <div id="pager_table_rutas_serenazgo"></div>
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
        
        jQuery("#table_rutas_serenazgo").jqGrid({
            url: 'sub_geren_op_vigilancia_interna/0?grid=rutas_serenazgo',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'UBICACION', 'UNIDAD','PLACA','PERSONAL','TIPO'],
            rowNum: 50, sortname: 'id_ruta_serenazgo', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE RUTAS SERENAZGO REGISTRADAS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_ruta_serenazgo', index: 'id_ruta_serenazgo', hidden: true},
                {name: 'ubicacion', index: 'ubicacion', align: 'center', width: 40},
                {name: 'unidad', index: 'unidad', align: 'center', width: 20},
                {name: 'placa', index: 'placa', align: 'center', width: 15},
                {name: 'personal', index: 'personal',align: 'center', width: 25},
                {name: 'descripcion', index: 'descripcion',align: 'center', width: 25}
                
            ],
            pager: '#pager_table_rutas_serenazgo',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_rutas_serenazgo').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_rutas_serenazgo').jqGrid('getDataIDs')[0];
                            $("#table_rutas_serenazgo").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_ruta_serenazgo();}
        });
        
        $("#dlg_buscar_ruta").keypress(function (e) {
            if (e.which == 13) {

                   fn_buscar_ruta_serenazgo();

            }
        });
        
        jQuery("#table_observaciones").jqGrid({
            url: 'sub_geren_op_vigilancia_interna/0?grid=observaciones_rutas_serenazgo&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'FECHA REGISTRO','OBSERVACIONES'],
            rowNum: 50, sortname: 'id_observ_ruta_srzgo', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES', align: "center",
            colModel: [
                {name: 'id_observ_ruta_srzgo', index: 'id_observ_ruta_srzgo', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 130},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 530}
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
        
        jQuery("#table_personal").jqGrid({
            url: 'sub_geren_op_vigilancia_interna/0?grid=personal_rutas_serenazgo&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'DNI','PERSONA','FECHA REGISTRO','TELEFONO'],
            rowNum: 50, sortname: 'id_per_ruta_serenazgo', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE PERSONAS', align: "center",
            colModel: [
                {name: 'id_per_ruta_serenazgo', index: 'id_per_ruta_serenazgo', align: 'left',width: 20, hidden: true},
                {name: 'dni', index: 'dni', align: 'left', width: 100},
                {name: 'persona', index: 'persona', align: 'center', width: 350},
                {name: 'fec_reg', index: 'fec_reg', align: 'center', width: 130},
                {name: 'telefono', index: 'telefono', align: 'left', width: 100}
            ],
            pager: '#pager_table_personal',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_personal').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_personal').jqGrid('getDataIDs')[0];
                            $("#table_personal").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_persona()}
        });
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/rutas_serenazgo.js') }}"></script>

<div id="dlg_nueva_ruta_serenazgo" style="display: none;">
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">INFORMACION RUTA SERENAZGO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">UBICACION: &nbsp;<i class="fa fa-map"></i></span>
                    <div>
                        <input id="dlg_ubicacion" type="text" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">UNIDAD: &nbsp;<i class="fa fa-user-times"></i></span>
                    <div>
                        <input id="dlg_unidad" type="text" class="form-control text-uppercase" maxlength="255" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" style="width: 192px">TIPO: &nbsp;<i class="fa fa-exclamation-circle"></i></span>
                    <div>
                        <select id='sel_tipo_transporte' class="form-control col-xs-12 col-md-12 col-lg-12" style="height: 32px;">
                            <option value="0">-- SELEECIONE UNA OPCION --</option>
                            @foreach($tipo_transporte as $tipo_trans)
                                <option value="{{ $tipo_trans->id_tipo_transporte }}">{{ $tipo_trans->descripcion }}</option>
                            @endforeach
                        </select>                       
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">PLACA: &nbsp;<i class="fa fa-exclamation-triangle"></i></span>
                    <div>
                        <input id="dlg_placa" type="text" class="form-control text-uppercase" maxlength="10" style="height: 30px;">
                    </div>
                </div>
            </div> 
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" style="width: 192px">PERSONAL: &nbsp;<i class="fa fa-exclamation-circle"></i></span>
                    <div>
                        <select id='sel_tipo_personal' class="form-control col-xs-12 col-md-12 col-lg-12" style="height: 32px;">
                            <option value="0">-- SELECCIONE UNA OPCION --</option>
                            <option value="1"> SERENAZGO </option>
                            <option value="2"> INTEGRADO </option>
                        </select>                       
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    </div>
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">PERSONAL</div>
    
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <div class="col-xs-10">
                    <table id="table_personal" ></table>
                    <div id="pager_table_personal"></div>
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
    
    <input type="hidden" id="id_ruta_serenazgo">
    
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
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-search"></i></span>
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
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">DNI: &nbsp;<i class="fa fa-map"></i></span>
                    <div>
                        <input id="dlg_dni" type="text" class="form-control text-uppercase" maxlength="8" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">NOMBRES: &nbsp;<i class="fa fa-map"></i></span>
                    <div>
                        <input id="dlg_nombres" type="text" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">AP. PATERNO: &nbsp;<i class="fa fa-map"></i></span>
                    <div>
                        <input id="dlg_apaterno" type="text" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">AP. MATERNO: &nbsp;<i class="fa fa-map"></i></span>
                    <div>
                        <input id="dlg_amaterno" type="text" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">TELEFONO: &nbsp;<i class="fa fa-map"></i></span>
                    <div>
                        <input id="dlg_telefono" type="text" class="form-control text-uppercase" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
      
        </div>
    </div>
    </div>
    
</div>

@endsection


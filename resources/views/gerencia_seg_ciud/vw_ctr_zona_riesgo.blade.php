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
                                            
                                        <h1 ><b>CONSTRUCCIONES EN ZONAS DE RIESGO</b></h1>
                                        
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">UBICACION:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_ubicacion" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR UBICACION">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="fn_buscar_ubicacion();">
                                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                        </button>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-5 text-center">

                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_const_zona_riesgo();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar Const. Zona de Riesgo
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_ctr_zona_riesgo"></table>
                                                        <div id="pager_table_ctr_zona_riesgo"></div>
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
        
        jQuery("#table_ctr_zona_riesgo").jqGrid({
            url: 'sub_geren_riesgos_desastres/0?grid=ctr_zona_riesgo',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'NROº DOC', 'PROPIETARIO', 'UBICACION','DESCRIPCION','NOTIFICACION'],
            rowNum: 50, sortname: 'id_ctr_zon_rg', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE CONSTRUCCIONES EN ZONAS DE RIESGO - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_ctr_zon_rg', index: 'id_ctr_zon_rg', hidden: true},
                {name: 'nro_doc_propietario', index: 'nro_doc_propietario', align: 'left', width: 10},
                {name: 'propietario', index: 'propietario', align: 'center', width: 25},
                {name: 'ubicacion', index: 'ubicacion', align: 'center', width: 20},
                {name: 'desripcion', index: 'desripcion', align: 'center', width: 25},  
                {name: 'notificacion', index: 'notificacion', align: 'center', width: 40}  
            ],
            pager: '#pager_table_ctr_zona_riesgo',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_ctr_zona_riesgo').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_ctr_zona_riesgo').jqGrid('getDataIDs')[0];
                            $("#table_ctr_zona_riesgo").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_const_zona_riesgo();}
        });
        
        $("#dlg_buscar_ubicacion").keypress(function (e) {
            if (e.which == 13) {

                   fn_buscar_ubicacion();

            }
        });
        
        $("#dlg_dni_propietario").keypress(function (e) {
            if (e.which == 13) {
                consultar_dni($("#dlg_dni_propietario").val(),'hidden_dlg_propietario','dlg_propietario');
            }
        });
        
        jQuery("#table_observaciones").jqGrid({
            url: 'sub_geren_riesgos_desastres/0?grid=observaciones_ctr_zona_riesgo&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'FECHA REGISTRO','OBSERVACIONES'],
            rowNum: 50, sortname: 'id_observ_ctr_zon_rg', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES', align: "center",
            colModel: [
                {name: 'id_observ_ctr_zon_rg', index: 'id_observ_ctr_zon_rg', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 130},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 520}
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
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/const_zonas_riesgo.js') }}"></script>

<div id="dlg_nueva_const_zona_riesgo" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS PROPIETARIO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">DNI: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_dni_propietario" type="text" maxlength="8" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE PROPIETARIO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input type="hidden" id="hidden_dlg_propietario" value="0">
                        <input id="dlg_propietario" type="text" maxlength="250" class="form-control text-uppercase" style="height: 30px;"  disabled="">
                    </div>
                </div>
            </div> 

        </div>
    </div>
    </div>
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">CONSTRUCCION ZONA DE RIESGO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <form id="FormularioComisarias" name="FormularioComisarias" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">UBICACION: &nbsp;<i class="fa fa-map"></i></span>
                    <div>
                        <input id="dlg_ubicacion" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" style="width: 192px">TIPO RIESGO: &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='sel_tipo_riesgo' class="form-control col-xs-12 col-md-12 col-lg-12" style="height: 32px;">
                            <option value="0">--Seleccione un Riesgo--</option>
                            @foreach($tipo_riesgo as $tip)
                                <option value="{{ $tip->id_ctr_tip_riesgo }}">{{ $tip->desripcion }}</option>
                            @endforeach
                        </select>                       
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">NOTIFICACION: &nbsp;<i class="fa fa-map"></i></span>
                    <div>
                        <input id="dlg_notificacion" type="text" class="form-control text-uppercase" style="height: 30px;"  >
                    </div>
                </div>
            </div>
            </form>        
        </div>
    </div>
    </div>
    
    <input type="hidden" id="id_const_zona_riesgo">
    
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

@include('vw_personas')

@endsection


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
                                            
                                        <h1><b>UBICACION - SEMAFOROS</b></h1>
                                        
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

                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_semaforos();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar Semaforo
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_semaforos"></table>
                                                        <div id="pager_table_semaforos"></div>
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
        
        jQuery("#table_semaforos").jqGrid({
            url: 'sub_geren_transito_seg_vial/0?grid=semaforos',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'COD. SEM.', 'UBICACION', 'COD. CTR.','DESCRIPCION','ESTADO'],
            rowNum: 50, sortname: 'id_semaforo', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE SEMAFOROS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_semaforo', index: 'id_semaforo', hidden: true},
                {name: 'cod_semaforo', index: 'cod_semaforo', align: 'left', width: 15},
                {name: 'ubicacion', index: 'ubicacion', align: 'center', width: 25},
                {name: 'cod_controlador', index: 'cod_controlador', align: 'left', width: 10},
                {name: 'controlador', index: 'controlador', align: 'center', width: 25},
                {name: 'estado', index: 'estado', align: 'center', width: 12}
            ],
            pager: '#pager_table_semaforos',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_semaforos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_semaforos').jqGrid('getDataIDs')[0];
                            $("#table_semaforos").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_semaforos();}
        });
        
        $("#dlg_buscar_ubicacion").keypress(function (e) {
            if (e.which == 13) {

                   fn_buscar_ubicacion();

            }
        });
        
        $("#dlg_dni_persona").keypress(function (e) {
            if (e.which == 13) {
                consultar_dni($("#dlg_dni_persona").val(),'hidden_dlg_persona','dlg_persona');
            }
        });
        
        jQuery("#table_observaciones").jqGrid({
            url: 'sub_geren_transito_seg_vial/0?grid=observaciones&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'FECHA REGISTRO','OBSERVACIONES'],
            rowNum: 50, sortname: 'id_observ_sem', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES', align: "center",
            colModel: [
                {name: 'id_observ_sem', index: 'id_observ_sem', align: 'left',width: 20, hidden: true},
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
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/semaforos.js') }}"></script>

<div id="dlg_nuevo_semaforo" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS SEMAFORO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <input type="hidden" id="dlg_id_semaforo" value="0">
            <div class="col-xs-7" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">UBICACION: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="dlg_ubicacion" type="text" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-5" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">CODIGO: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="dlg_codigo" type="text" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">TIPO &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='sel_tipo' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">--Seleccione un Tipo de Semaforo--</option>
                            @foreach($tipo_semaforo as $tipo)
                                <option value="{{ $tipo->id_tipo_semaforo }}">{{ $tipo->descripcion }}</option>
                            @endforeach
                        </select>                       
                    </div>
                </div>
            </div>
            
            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">PEATONAL: &nbsp;<i class="fa fa-angle-up"></i></span>
                    <div>
                        <input id="chkbox_peatonal" type="checkbox" class="form-control" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">CONTROLADOR &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='sel_controlador' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">--Seleccione un Controlador--</option>
                            @foreach($controlador as $ctrl)
                                <option value="{{ $ctrl->id_controlador }}">{{ $ctrl->descripcion }}</option>
                            @endforeach
                        </select>                       
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">ESTADO &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='sel_estado' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">--Seleccione un Estado--</option>
                            @foreach($estado as $est)
                                <option value="{{ $est->id_estado }}">{{ $est->descripcion }}</option>
                            @endforeach
                        </select>                       
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    
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

@endsection


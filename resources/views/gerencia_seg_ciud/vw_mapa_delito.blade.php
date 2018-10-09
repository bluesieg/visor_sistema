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
                                            
                                        <h1 ><b>MAPA DEL DELITO</b></h1>
                                        
                                        <div class="row" style="padding: 0px; padding-top: 20px;">
                                            <div class="col-xs-3" style="padding-right: 0px;">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Desde:</span>
                                                <div class="icon-addon addon-md">
                                                    <input  id="fecha_inicio" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-xs-3" style="padding-right: 0px;">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">Hasta:</span>
                                                    <div class="icon-addon addon-md">
                                                        <input id="fecha_fin" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="fn_buscar_delitos();">
                                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                        </button>
                                                </div>
                                            </div>
                                            
                                           <div class="col-xs-4 text-center">

                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_mapa_delito();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar Delito
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_mapa_delito"></table>
                                                        <div id="pager_table_mapa_delito"></div>
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
        jQuery("#table_mapa_delito").jqGrid({
            url: 'comisarias/0?grid=mapa_delito&data=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_mapa_delito', 'INFRACTOR', 'DELITO', 'UBICACION', 'FECHA'],
            rowNum: 50, sortname: 'id_mapa_delito', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE DELITOS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_mapa_delito', index: 'id_mapa_delito', hidden: true},
                {name: 'persona', index: 'persona', align: 'left', width: 40},
                {name: 'descripcion', index: 'descripcion', align: 'center', width: 15},
                {name: 'ubicacion', index: 'ubicacion', align: 'center', width: 40},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'center', width: 12}    
            ],
            pager: '#pager_table_mapa_delito',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_mapa_delito').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_mapa_delito').jqGrid('getDataIDs')[0];
                            $("#table_mapa_delito").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_mapa_delito();}
        });
        
        
        $("#dlg_dni_infractor").keypress(function (e) {
            if (e.which == 13) {
                consultar_dni($("#dlg_dni_infractor").val(),'hidden_dlg_infractor','dlg_infractor');
            }
        });
        
        $("#dlg_dni_encargado").keypress(function (e) {
            if (e.which == 13) {
                consultar_dni($("#dlg_dni_encargado").val(),'hidden_dlg_encargado','dlg_encargado');
            }
        });
        
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/mapa_delito.js') }}"></script>

<div id="dlg_nuevo_mapa_delito" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">MAPA DEL DELITO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <form id="FormularioComisarias" name="FormularioComisarias" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">UBICACION: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="dlg_ubicacion" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-7" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">TIPO DELITO: &nbsp;<i class="fa fa-list"></i></span>
                    <div>
                        <select id='sel_tipo_delito' class="form-control col-lg-8" style="height: 32px;">
                            <option value="0">--Seleccione un Delito--</option>
                            @foreach($tipo_delito as $tipo_d)
                                <option value="{{ $tipo_d->id_tipo_delito }}">{{ $tipo_d->descripcion }}</option>
                            @endforeach
                        </select>                       
                    </div>
                </div>
            </div>
            
            <div class="col-xs-5" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 175px">VEHICULO: &nbsp;<i class="fa fa-car"></i></span>
                    <div>
                        <input id="dlg_vehiculo" type="text" class="form-control text-uppercase" maxlength="50" style="height: 30px;">
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

            </form>        
        </div>
    </div>
    </div>
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS INFRACTOR</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_dni_infractor" type="text" maxlength="8" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE INFRACTOR: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input type="hidden" id="hidden_dlg_infractor" value="0">
                        <input id="dlg_infractor" type="text" maxlength="250" class="form-control text-uppercase" style="height: 30px;"  disabled="">
                    </div>
                </div>
            </div> 

        </div>
    </div>
    </div>
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS ENCARGADO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_dni_encargado" type="text" maxlength="8" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE ENCARGADO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input type="hidden" id="hidden_dlg_encargado" value="0">
                        <input id="dlg_encargado" type="text" maxlength="250" class="form-control text-uppercase" style="height: 30px;"  disabled="">
                    </div>
                </div>
            </div> 

        </div>
    </div>
    </div>
</div>

@include('vw_personas')

@endsection


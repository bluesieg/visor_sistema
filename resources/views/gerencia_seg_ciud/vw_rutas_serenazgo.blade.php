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
                                                        <input id="dlg_buscar_comisaria" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR RUTA">
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
                                            
                                           <div class="col-xs-5">

                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_comisarias();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar ruta
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
            url: '',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_inspector', 'UBICACION', 'TELEFONO','OBSERVACION','VER'],
            rowNum: 50, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE RUTAS SERENAZGO REGISTRADAS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id', index: 'id', hidden: true},
                {name: 'nombre', index: 'nombre', align: 'left', width: 40},
                {name: 'telefono', index: 'telefono', align: 'center', width: 15},
                {name: 'observacion', index: 'observacion', align: 'center', width: 17},
                {name: 'ver', index: 'ver',align: 'center', width: 12}
                
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
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/rutas_serenazgo.js') }}"></script>

<div id="dlg_nuevo_comisarias" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS COMISARIA</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
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
            <div class="col-xs-8" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 175px">NOMBRE COMISARIA: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="dlg_nombre_comisaria" name="dlg_nombre_comisaria" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 165px">TEL. COMISARIA: &nbsp;<i class="fa fa-phone"></i></span>
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
                
            <div class="col-xs-10" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FOTO COMISARIA: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_foto_comisaria" name="dlg_foto_comisaria" type="file" class="form-control" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-2 text-right" style="margin-top: 10px;padding: 0px; ">
                <button type="button" id="actualizar_comisaria" class="btn btn-labeled bg-color-green txt-color-white" onclick="modificar_comisaria();">
                    <span class="btn-label"><i class="glyphicon glyphicon-saved"></i></span>Guardar
                </button>
            </div>

            </form>        
        </div>
    </div>
    </div>
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS COMISARIO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <form id="FormularioComisarios" name="FormularioComisarios" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token1" id="_token1" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}">
            
            <input type="hidden" id="id_comisaria" name="id_comisaria">
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE COMISARIO: &nbsp;<i class="fa fa-user-secret"></i></span>
                    <div>
                        <input id="dlg_nombre_comisario" type="text" name="dlg_nombre_comisario" maxlength="150" class="form-control text-uppercase" style="height: 30px;"  >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI: &nbsp;<i class="fa fa-user-secret"></i></span>
                    <div>
                        <input id="dlg_dni_comisario" type="text" name="dlg_dni_comisario" maxlength="8" class="form-control text-uppercase" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 165px">TEL. COMISARIO: &nbsp;<i class="fa fa-phone"></i></span>
                    <div>
                        <input id="dlg_telefono_comisario" type="text" name="dlg_telefono_comisario" maxlength="9" class="form-control" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FECHA INICIO &nbsp;<i class="fa fa-calendar"></i></span>
                    <div>
                        <input id="dlg_fecha_inicio" name="dlg_fecha_inicio" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 30px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FOTO COMISARIO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_foto_comisario" name="dlg_foto_comisario" type="file" class="form-control" style="height: 30px;">
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
    </div>
</div>

<div id="dlg_nueva_observacion_comisaria" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FECHA REGISTRO &nbsp;<i class="fa fa-calendar"></i></span>
                    <div>
                        <input id="id_observacion" type="hidden" value="0">
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

<div id="dlg_ver_observacion_comisaria" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">OBSERVACIONES</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FECHA INICIO &nbsp;<i class="fa fa-calendar"></i></span>
                    <div>
                        <input id="hidden_id_observacion" type="hidden" value="0">
                        <input id="dlg_observacion_inicio" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 30px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FECHA FIN &nbsp;<i class="fa fa-calendar"></i></span>
                    <div>
                        <input id="dlg_observacion_fin" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 30px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                    </div>
                </div>
            </div>
      
        </div>
    </div>
    </div>
    
</div>
@endsection


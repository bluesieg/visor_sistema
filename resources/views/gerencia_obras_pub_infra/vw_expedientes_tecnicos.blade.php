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
                                            
                                        <h1 ><b>MODULO DE EXPEDIENTES TECNICOS</b></h1>
                                        
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">HAB. URB.:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_ubicacion" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR HAB. URBANA">
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

                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="nuevo_exp_tecnico();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>NUEVO
                                                </button>
                                                
                                                 <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_exp_tecnico();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>MODIFICAR
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_expediente_tecnico"></table>
                                                        <div id="pager_table_expediente_tecnico"></div>
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
        
        jQuery("#table_expediente_tecnico").jqGrid({
            url: 'sub_geren_estudios_proyectos/0?grid=expediente_tecnico',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'CODIGO SNIP', 'COD. CATASTRAL','HAB. URBANA','DESCRIPCION'],
            rowNum: 50, sortname: 'id_expediente_tecnico', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE EXPEDIENTES TECNICOS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_expediente_tecnico', index: 'id_expediente_tecnico', hidden: true},
                {name: 'codigo_snip', index: 'codigo_snip', align: 'left', width: 25},
                {name: 'ubicacion', index: 'ubicacion', align: 'center', width: 30},
                {name: 'nomb_hab_urba', index: 'nomb_hab_urba', align: 'center', width: 50},
                {name: 'descripcion', index: 'descripcion', align: 'center', width: 50}
            ],
            pager: '#pager_table_expediente_tecnico',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_expediente_tecnico').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_expediente_tecnico').jqGrid('getDataIDs')[0];
                            $("#table_expediente_tecnico").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_exp_tecnico();}
        });
        
        $("#dlg_buscar_ubicacion").keypress(function (e) {
            if (e.which == 13) {

                   fn_buscar_ubicacion();

            }
        });
        
        $("#dlg_dni_responsable_exp_tec").keypress(function (e) {
            if (e.which == 13) {
                consultar_dni($("#dlg_dni_responsable_exp_tec").val(),'hidden_dlg_responsable_exp_tec','dlg_responsable_exp_tec');
            }
        });
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_obras_pub_infra/expediente_tecnico.js') }}"></script>

<div id="dlg_nuevo_exp_tecnico" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS PERSONA</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <div class="col-xs-3" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">DNI: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_dni_responsable_exp_tec" type="text" maxlength="8" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">RESPONSABLE DEL EXP.TEC.: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input type="hidden" id="hidden_dlg_responsable_exp_tec" value="0">
                        <input id="dlg_responsable_exp_tec" type="text" maxlength="250" class="form-control text-uppercase" style="height: 30px;"  disabled="">
                    </div>
                </div>
            </div> 
            
            <div class="col-xs-3" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">MONTO EXP.TECNICO: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_monto_exp_tecnico" type="text" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
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
                        <input type="hidden" id="id_lote_exp_tecnico" value="0">
                        <input id="dlg_ubicacion" type="text" maxlength="20" class="form-control text-uppercase" style="height: 30px;"  disabled="">
                    </div>
                </div>
            </div> 

            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_exp_tec();" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>VER MAPA
            </button>
            
        </div>
    </div>
    </div>
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">INFORMACION EXPEDIENTE TECNICO</div>
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
                    <span class="input-group-addon" style="width: 192px">CODIGO SNIP: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_codigo_snip" type="text" maxlength="50" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>

            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">NOMBRE DEL PIP: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_nombre_pip" type="text" maxlength="250" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>

            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">MONTO: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_monto" type="text" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>

            <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DESCRIPCION: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_descripcion" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>

            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">TIEMPO EJECUCION: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_tiempo_ejecucion" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>

            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">APROBACION: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_aprobacion" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div id="dlg_mapa_expediente_tecnico" >
    <input type="hidden" id="hidden_input_habilitacion_exp_tec" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_exp_tec" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>

@include('vw_personas')

@endsection


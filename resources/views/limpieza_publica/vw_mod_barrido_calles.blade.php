@extends('layouts.rutas')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <div class="row">                    
                    
                    <section class="col col-lg-12">
                        
                    <ul id="tabs1" class="nav nav-tabs bordered">
                        <li class="active" onclick="valida_pestana(1)">
                            <a href="#s1" data-toggle="tab" aria-expanded="true">
                                Rutas Barrido
                                <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                            </a>
                        </li>
                        <li onclick="valida_pestana(2)">
                            <a href="#s1" data-toggle="tab" aria-expanded="true">
                                Puntos de Ruta
                                <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                            </a>
                        </li>
                    </ul>
                        
                    <div id="myTabContent1" class="tab-content padding-1"> 
                        
                        <div id="s1" class="tab-pane fade active in">
                            <div class="col-xs-12" style="padding: 5px">
                                <h1 id="titulo_1"><b>Mantenimiento de Rutas de Barrido de Calles</b></h1>
                                
                                <div class="col-lg-4" style="padding-right: 5px; padding-top: 10px; ">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Buscar por Código:</span>
                                        <div class="icon-addon addon-md">
                                            <input class="form-control" id="dlg_bus_cod" name="dlg_bus_cod" type="text"   style="height: 32px; width: 100%" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1" style="padding-right: 5px; padding-top: 10px; ">
                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_ruta_barrido()">
                                        <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                                    </button>
                                </div>
                                <div id="botones_1" class="text-right" style=" padding-top: 10px">

                                       <button  type="button" class="btn btn-labeled bg-color-red txt-color-white" onclick="imp_rep_barrido();">
                                           <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Reporte
                                       </button>
                                       <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_ruta();">
                                           <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                       </button>
                                </div>
                                
                                <div  class="text-right" style=" padding-top: 10px">
                                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                        <article class="col-xs-12" style=" padding: 0px !important">
                                                <table id="table_rutas"></table>
                                                <div id="pager_table_rutas"></div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            
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
        jQuery("#table_rutas").jqGrid({
            url: 'rutas_barrido_calles/0?grid=rutas_barrido&cod=0',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_exp_san', 'Codigo Ruta', 'Descripcion'],
            rowNum: 100, sortname: 'id_ruta_barrido', sortorder: 'desc', viewrecords: true, caption: 'Rutas Barrido Calles', align: "center",
            colModel: [
                {name: 'id_ruta_barrido', index: 'id_ruta_barrido', hidden: true},
                {name: 'cod_ruta_barrido', index: 'cod_ruta_barrido', align: 'left', width: 30},
                {name: 'descripcion', index: 'descripcion', align: 'left', width: 70},
            ],
            pager: '#pager_table_rutas',
            rowList: [100, 200],
            gridComplete: function () {
                    var idarray = jQuery('#table_rutas').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_rutas').jqGrid('getDataIDs')[0];
                            $("#table_rutas").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){actualizar_ruta();}
        });
        jQuery("#table_rutas_personal").jqGrid({
            url: '',
            datatype: 'json', mtype: 'GET',
            height: '100px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_per_barrido', 'DNI', 'Nombre','Teléfono','Quitar'],
            rowNum: 100, sortname: 'id_per_barrido', sortorder: 'desc', viewrecords: true, caption: 'Personal Barrido Calles', align: "center",
            colModel: [
                {name: 'id_per_barrido', index: 'id_per_barrido', hidden: true},
                {name: 'dni', index: 'dni', align: 'left', width: 100},
                {name: 'ape_pat', index: 'ape_pat', align: 'left', width: 600},
                {name: 'telefono', index: 'telefono', align: 'left', width: 93},
                {align: 'left', width: 100},
            ],
            pager: '#pager_table_rutas_personal',
            rowList: [100, 200],
            gridComplete: function () {
                    var idarray = jQuery('#table_rutas_personal').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_rutas_personal').jqGrid('getDataIDs')[0];
                            $("#table_rutas_personal").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
      
       
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/limpieza_publica/rutas_barrido.js') }}"></script>

<div id="dlg_edit_ruta" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            
            <section class="col-xs-12" style="padding: 0px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-map"></i> </span>
                            <h2>Ingresar Información ::..</h2>
                    </header>
                </div>
            </section>
           
           
            <div class="col-xs-12" style="padding-left: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Codigo de Ruta &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                    <div class="icon-addon addon-md">
                        <input type="hidden" id="hidden_ruta" value="0"/>
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cod_ruta" type="text" maxlength="20" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Descripción de Ruta &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_des_ruta" type="text" >
                    </div>
                </div>
            </div>
            <div  class="col-xs-12 text-right" style=" padding-top: 5px">
                    <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="save_ruta();">
                        <span class="btn-label"><i class="glyphicon glyphicon-save"></i></span>Modificar
                    </button>
             </div>
            
            <section class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 5px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                            <h2>Personal ::..</h2>
                    </header>
                </div>
            </section>
            <div  class="col-xs-12 text-right">
                    <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="agregar_personal();">
                        <span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>Agregar Personal
                    </button>
             </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <article class="col-xs-12" style=" padding: 0px !important">
                    <input id="del_token" data-token="{{ csrf_token() }}" type="hidden" />
                        <table id="table_rutas_personal"></table>
                        <div id="pager_table_rutas_personal"></div>
                </article>
            </div>
            <section class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 5px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-search"></i> </span>
                            <h2>Observaciones ::..</h2>
                    </header>
                </div>
            </section>
            <div  class="col-xs-12">
                    <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="agregar_observacion();">
                        <span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>Agregar Observación
                    </button>
                    <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="ver_observacion()">
                        <span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>Ver Observaciones
                    </button>
             </div>
        </div>
    </div>
</div>
<div id="dlg_new_personal" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            
            <section class="col-xs-12" style="padding: 0px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-male"></i> </span>
                            <h2>Ingresar Información ::..</h2>
                    </header>
                </div>
            </section>
           
           
            <div class="col-xs-12" style="padding-left: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Codigo de Ruta &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cod_ruta_personal" type="text" disabled="" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">DNI &nbsp;&nbsp;<i class="fa fa-info"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_personal_dni" type="text"  maxlength="8" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Nombres &nbsp;&nbsp;<i class="fa fa-user"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_personal_nombres" type="text" maxlength="50" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Apellido Paterno &nbsp;&nbsp;<i class="fa fa-user"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_personal_ape_pat" type="text" maxlength="50" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Apellido Materno &nbsp;&nbsp;<i class="fa fa-user"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_personal_ape_mat" type="text" maxlength="50" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Teléfono &nbsp;&nbsp;<i class="fa fa-phone"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_personal_fono" type="text" maxlength="50" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dlg_new_observacion" style="display: none;">
    <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px;">
        <div class="input-group input-group-md" style="width: 100%">
            <span class="input-group-addon" style="width: 200px">Ingresar Fecha &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
            <div class="icon-addon addon-md" >
                <input id="dlg_fec_obs" name="dlg_fec_obs" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}" autocomplete="false">
            </div>
        </div>
    </div>
    <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px; margin-bottom: 10px">
        <div class="input-group input-group-md" style="width: 100%">
            <span class="input-group-addon" style="width: 200px">Ingresar Observación &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
            <div class="icon-addon addon-md" >
                <textarea class="form-control" id="txt_observacion" style="height: 100px"></textarea>
            </div>
        </div>
    </div>
</div>


<div id="dlg_ver_observacion" style="display: none;">
    <div class="col-xs-12" id="cuerpo_obs" style="margin-bottom: 10px; padding: 0px; background-color: white"></div>
</div>

@endsection


@extends('layouts.procuraduria')
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
                        <ul id="tabs1" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#s1" data-toggle="tab" aria-expanded="true">
                                    EXPEDIENTES
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   ADJUNTAR DOCUMENTOS
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>                            
                        </ul>
                    <div id="myTabContent1" class="tab-content padding-1"> 
                        
                        <div id="s1" class="tab-pane fade active in">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                        <div class="col-xs-12">                                            
                                        <h1 ><b>EXPEDIENTES - PROCURADURIA</b></h1>
                                        <div class="text-right" style=" padding-top: 20px">

                                             <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_exp_procuraduria();">
                                                     <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                             </button>
                                             <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_exp_procuraduria();">
                                                 <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                             </button>
                                             <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                 <article class="col-xs-12" style=" padding: 0px !important">
                                                         <table id="table_expedientes"></table>
                                                         <div id="pager_table_expedientes"></div>
                                                 </article>
                                             </div>

                                        </div>
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                    <article class="col-xs-12" style=" padding: 0px !important">
                                            <table id="table_recdocumentos"></table>
                                            <div id="pager_table_recdocumentos"></div>
                                    </article>
                                </div>
                            </div>
                           </div>
                        </section>
                        
                      </div>
                        
                        <div id="s2" class="tab-pane fade" style="height: auto">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 10px">
                                        <div class="col-xs-12">
                                            
                                    <h1><b>ADJUNTAR DOCUMENTOS</b></h1>
                                        <div class="col-xs-5">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Nº EXPEDIENTE:. &nbsp;<i class="fa fa-male"></i></span>
                                                <div>
                                                    <input id="dlg_buscar_nro_expediente" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR Nº EXPEDIENTE">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="busqueda_escaneo();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                            </div>
                                        </div>
                                    
                                        </div>
                                        
                                    </section>
                                    
                                    </div>
                                
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px; padding-left: 35px;">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_escaneos"></table>
                                                    <div id="pager_table_escaneos"></div>
                                            </article>
                                        </div>
                                
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px; padding-left: 150px;">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_doc"></table>
                                                    <div id="pager_table_doc"></div>
                                            </article>
                                        </div>
                                
                                    </div>
                                </div>
                        </section>
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
        $('#btn_modificar_expediente').hide();
        
        jQuery("#table_expedientes").jqGrid({
            url: 'procuraduria/0?grid=expedientes',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'NUMERO EXPEDIENTE','Nº DOCUMENTO','GESTOR','FECHA INICIO TRAMITE','FECHA REGISTRO'],
            rowNum: 50, sortname: 'id_procuraduria', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_procuraduria', index: 'id_procuraduria', align: 'left',width: 20, hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 20},
                {name: 'nro_doc_gestor', index: 'nro_doc_gestor', align: 'left', width: 20},
                {name: 'gestor', index: 'gestor', align: 'left', width: 40},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 25},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 25}
            ],
            pager: '#pager_table_expedientes',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_expedientes').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_expedientes').jqGrid('getDataIDs')[0];
                            $("#table_expedientes").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_exp_procuraduria();}
        });
        
        jQuery("#table_observaciones").jqGrid({
            url: 'procuraduria/0?grid=observaciones&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_det_procuraduria', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES', align: "center",
            colModel: [
                {name: 'id_det_procuraduria', index: 'id_det_procuraduria', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
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
        
        jQuery("#table_escaneos").jqGrid({
            url: 'procuraduria/0?grid=escaneos',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'NUMERO EXPEDIENTE','Nº DOCUMENTO','GESTOR','SUBIR'],
            rowNum: 50, sortname: 'id_procuraduria', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_procuraduria', index: 'id_procuraduria', align: 'left',width: 20, hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 150},
                {name: 'nro_doc_gestor', index: 'nro_doc_gestor', align: 'left', width: 120},
                {name: 'gestor', index: 'gestor', align: 'left', width: 500},
                {name: 'archivo', index: 'archivo', align: 'center', width: 170}
            ],
            pager: '#pager_table_escaneos',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_escaneos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_escaneos').jqGrid('getDataIDs')[0];
                            $("#table_escaneos").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id)
            {
                jQuery("#table_doc").jqGrid('setGridParam', {url: 'procuraduria/0?grid=doc_adjuntos&id='+Id}).trigger('reloadGrid');
            },
            ondblClickRow: function (Id){}
        });
        
        jQuery("#table_doc").jqGrid({
            url: '',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_doc_adj', 'DESCRIPCION','VER','ELIMINAR'],
            rowNum: 200, sortname: 'id_doc_adj', sortorder: 'desc', viewrecords: true, caption: 'DOCUMENTOS ESCANEADOS', align: "center",
            colModel: [
                {name: 'id_doc_adj', index: 'id_doc_adj', hidden: true},
                {name: 'descripcion', index: 'descripcion', align: 'left', width: 400},
                {name: 'ver', index: 'ver', align: 'center', width: 160},
                {name: 'del', index: 'del', align: 'center', width: 150},
            ],
            pager: '#pager_table_doc',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_doc').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                        var firstid = jQuery('#table_doc').jqGrid('getDataIDs')[0];
                            $("#table_doc").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        
        $("#inp_nro_exp").keypress(function (e) {
            if (e.which == 13) {

                   fn_obtener_exp();

            }
        });
        
        $("#dlg_buscar_nro_expediente").keypress(function (e) {
            if (e.which == 13) {

                   busqueda_escaneo();

            }
        });
        
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/procuraduria/procuraduria.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/procuraduria/escaneo_documentos.js') }}"></script>

<div id="dlg_new_exp_procuraduria" style="display: none;">
    <input type="hidden" id="hidden_id_carta" value="0"/>
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_adquiere" class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                <h2>Buscar Expediente::..</h2>
                        </header>
                    </div>
                </section>                
                <div class="col-xs-6" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Nro. Expediente. &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div class=""  >
                            <input type="hidden" id="inp_id_procuraduria" value="0">
                            <input id="inp_nro_exp" type="text"  class="form-control text-uppercase text-center" style="height: 32px; ">
                        </div>
                    </div>
                </div>
                <button id="btn_bus_exp" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="fn_obtener_exp()">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                </button>              
            </div>
            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información del Expediente::..</h2>
                        </header>
                    </div>
                </section>     
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Gestor. &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div class=""  >
                            <input type="hidden" id="inp_id_gestor" value="0">
                            <input id="inp_gestor" type="text"  class="form-control" style="height: 32px; " disabled="" >
                        </div>
                    </div>
                </div>                               
                <div class="col-xs-7" style="padding: 0px; margin-top: 10px ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">DNI / RUC &nbsp;<i class="fa fa-calendar"></i></span>
                        <div>
                            <input id="inp_dni" type="text"  class="form-control" style="height: 32px; " disabled="">
                        </div>
                    </div>
                </div>
                <div class="col-xs-5" style="padding: 0px; margin-top: 10px ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Fecha Inicio &nbsp;<i class="fa fa-calendar"></i></span>
                        <div>
                            <input id="inp_fec_ini" type="text"  class="form-control" style="height: 32px; " disabled="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Llenado de Información::..</h2>
                        </header>
                    </div>
                </section>     
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Responsable &nbsp;<i class="fa fa-list"></i></span>
                        <div>
                            <select id='sel_responsable' class="form-control col-lg-8" style="height: 32px;">
                                <option value="0">--Seleccione Responsable--</option>
                                @foreach($abogados as $abogado)
                                    <option value="{{ $abogado->id_abogado }}">{{ $abogado->nombre }}</option>
                                @endforeach
                            </select>                       
                        </div>
                    </div>
                </div>
                <div class="col-xs-9" style="padding: 0px;margin-top: 10px;margin-bottom: 10px ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Tipo &nbsp;<i class="fa fa-list"></i></span>
                        <div>
                            <select id='sel_tipo' onchange="seleccion_tipo();" class="form-control col-lg-8" style="height: 32px;">
                                <option value="0">--Seleccione Tipo--</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id_tipo }}">{{ $tipo->descripcion }}</option>
                                @endforeach                                
                            </select>                       
                        </div>
                    </div>
                </div>
                <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_procuraduria();" style="padding: 0px;margin-top: 10px " disabled="">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
                </button>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                <h2>Datos del Mapa::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-8" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Habilitación Hurbana. &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div class=""  >
                            <input type="hidden" id="hidden_inp_hab_urb" value="0">
                            <input id="inp_hab_urb" type="text"  class="form-control" style="height: 32px; " disabled="">
                        </div>
                    </div>
                </div>
                <div class="col-xs-4" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Cod. Catastral.&nbsp;<i class="fa fa-hashtag"></i></span>
                        <div class=""  >
                            <input id="inp_cod_catastral" type="text"  class="form-control" style="height: 32px; " disabled="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
               <section>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                <h2>Llenado de información del Proceso::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-6" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Tipo sanción &nbsp;<i class="fa fa-list"></i></span>
                        <div>
                            <select id='sel_tipo_san' class="form-control col-lg-8" style="height: 32px;">
                                <option value="0">--Seleccione Tipo Sancion--</option>
                                @foreach($tipos_sanciones as $tipo_sancion)
                                    <option value="{{ $tipo_sancion->id_tipo_sancion }}">{{ $tipo_sancion->descripcion }}</option>
                                @endforeach
                            </select>                       
                        </div>
                    </div>
                </div>
                 <div class="col-xs-6" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Materia &nbsp;<i class="fa fa-list"></i></span>
                        <div>
                            <select id='sel_materia' class="form-control col-lg-8" style="height: 32px;">
                                <option value="0">--Seleccione Materia--</option>
                                @foreach($materias as $materia)
                                    <option value="{{ $materia->id_materia }}">{{ $materia->descripcion }}</option>
                                @endforeach
                            </select>                       
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Proceso &nbsp;<i class="fa fa-list"></i></span>
                        <div>
                            <select id='sel_proceso' class="form-control col-lg-8" style="height: 32px;">
                                <option value="0">--Seleccione Proceso--</option>
                                @foreach($procesos as $proceso)
                                    <option value="{{ $proceso->id_proceso }}">{{ $proceso->descripcion }}</option>
                                @endforeach
                            </select>                       
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Caso &nbsp;<i class="fa fa-list"></i></span>
                        <div>
                            <select id='sel_caso' class="form-control col-lg-8" style="height: 32px;">
                                <option value="0">--Seleccione Caso--</option>
                                @foreach($casos as $caso)
                                    <option value="{{ $caso->id_caso }}">{{ $caso->descripcion }}</option>
                                @endforeach
                            </select>                       
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px;margin-top: 10px">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Refencia. &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div class=""  >
                            <input id="inp_referencia" type="text"  class="form-control text-uppercase" style="height: 32px; ">
                        </div>
                    </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Procedimiento. &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div class=""  >
                        <input id="inp_procedimiento" type="text"  class="form-control text-uppercase" style="height: 32px; ">
                    </div>
                </div>
            </div>
            
            <div id="btn_agregar_expediente">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="guardar_editar_datos(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_expediente">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="guardar_editar_datos(4);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-edit"></i></span>Modificar Datos
            </button>
            </div>
            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                                <h2>Observaciones ::..</h2>
                        </header>
                    </div>
                </section>
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


<div id="dlg_mapa_procuraduria" >
    <input type="hidden" id="hidden_input_habilitacion_procuraduria" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_procuraduria" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>

<div id="dlg_nueva_observacion" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
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

<div id="dlg_subir_escaneo_procuraduria" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <form id="FormularioScans_procuraduria" name="FormularioScans_procuraduria" method="post" enctype="multipart/form-data" action="procuraduria?tipo=1"  target="ifrafile">
                <input type="hidden" name="_token" id="_token2" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}"> 
                <input type="hidden" value='0' id='id_scan_procuraduria' name="id_scan_procuraduria"/>
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon"  style="width: 165px" >Tipo Documento &nbsp;<i class="fa fa-file"></i></span>
                        <div class="icon-addon addon-md">
                            <select id='tipo_documento_procuraduria' name="tipo_documento_procuraduria" class="form-control col-lg-8" style="height: 32px;">
                            @foreach ($tip_doc as $docs)
                            <option value='{{$docs->id_tip_doc}}' >{{$docs->t_documento}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; padding-top: 10px ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Documento &nbsp;<i class="fa fa-file-archive-o"></i></span>
                        <div>
                            <input name="dlg_documento_file_procuraduria" id="dlg_documento_file_procuraduria" type="file"  class="form-control" style="height: 32px; width: 100%" onchange="llamarsubmitscan();">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; padding-top: 10px ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Descripción &nbsp;<i class="fa fa-text-height"></i></span>
                        <div>
                            <input name="dlg_documento_des_procuraduria" id="dlg_documento_des_procuraduria" type="text"  class="form-control text-uppercase" style="height: 32px; width: 100%">
                        </div>
                    </div>
                </div>
                
            </form>
            <div id="dlg_sub_frame" class='cr_content col-xs-12 ' style="margin-bottom: 10px; padding-top: 10px ">
                <iframe name="ifrafile" id="ifrafile" class="form-control col-xs-12"  style=" height: 400px; padding: 0px"></iframe>
            </div>
    </div>
    </div>
</div>

@endsection


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
                                <a href="#s1" data-toggle="tab" aria-expanded="true" onclick="actualizar_grilla();">
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
                                        <h1 ><b>MANTENIMIENTO DE EXPEDIENTES</b></h1>
                                        <div class="text-right" style=" padding-top: 20px">

                                             <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_exp_procuraduria();">
                                                     <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                             </button>
                                             <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_exp_procuraduria();">
                                                 <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                             </button>
                                             <button  type="button" class="btn btn-labeled btn-danger" onclick="del_exp_procuraduria();">
                                                 <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
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
                                            
                                    <h1 ><b>ADJUNTAR DOCUMENTOS</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="fec_ini_asignacion" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="fec_fin_asignacion" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-3" style="padding-right: 0px; padding-top: 20px; ">
                                            <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="seleccionafecha_asignacion();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span> BUSCAR
                                            </button>
                                        </div>
                                    
                                       <div class="text-right" style=" padding-top: 20px">

                                           <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nueva_asignacion();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                           </button>

                                           <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_asignacion();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                           </button>

                                           <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_exp_asignacion();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                           </button>
                                           
                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                    </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_asignacion"></table>
                                                    <div id="pager_table_asignacion"></div>
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
        jQuery("#table_recdocumentos").jqGrid({
            url: 'get_documentos',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'NUMERO EXPEDIENTE','FASE','GESTOR','FECHA INICIO TRAMITE','FECHA REGISTRO'],
            rowNum: 50, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'RECEPCION DE DOCUMENTOS', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', align: 'left',width: 20, hidden: true},
                {name: 'nro_exp', index: 'nro_exp', align: 'left', width: 20},
                {name: 'fase', index: 'fase', align: 'left', width: 10},
                {name: 'gestor', index: 'gestor', align: 'left', width: 40},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 20},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 20}
            ],
            pager: '#pager_table_table_recdocumentos',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_recdocumentos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_recdocumentos').jqGrid('getDataIDs')[0];
                            $("#table_recdocumentos").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_documento();}
        });
        
        fecha_inicio_verif_tec = $('#fec_ini_verif_tecnica').val();
        fecha_fin_verif_tec = $('#fec_fin_verif_tecnica').val();
        jQuery("#table_verif_tecnica").jqGrid({
            url: 'get_verif_tecnica?fecha_inicio='+fecha_inicio_verif_tec+'&fecha_fin='+fecha_fin_verif_tec,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'CODIGO INTERNO','FECHA REGISTRO','DOC. GESTOR','GESTOR','MODALIDAD'],
            rowNum: 50, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'VERIFICACION TECNICA', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', align: 'left',width: 20, hidden: true},
                {name: 'cod_interno', index: 'nro_exp', align: 'left', width: 150},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 120},
                {name: 'nro_doc_gestor', index: 'nro_doc_gestor', align: 'left', width: 100},
                {name: 'gestor', index: 'gestor', align: 'left', width: 150},
                {name: 'descr_procedimiento', index: 'descr_procedimiento', align: 'left', width: 480}
            ],
            pager: '#pager_table_verif_tecnica',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_verif_tecnica').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_verif_tecnica').jqGrid('getDataIDs')[0];
                            $("#table_verif_tecnica").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_verif_tecnica()}
        });
        
         jQuery("#table_pisos").jqGrid({
            url: 'gridpisos/0',
            datatype: 'json', mtype: 'GET',
            height: '100px', width: '700',
            toolbarfilter: true,
            colNames: ['id_pi','Piso', 'Fecha'],
            rowNum: 20, sortname: 'id_pi', sortorder: 'desc', viewrecords: true, caption: 'Pisos del Predio', align: "center",
            colModel: [
                {name: 'id_pi', index: 'id_pi', hidden: true},
                {name: 'piso', index: 'piso', align: 'center', width: 400},
                {name: 'fech', index: 'fech', align: 'center', width: 500}
                
            ],
            pager: '#pager_table_pisos',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_pisos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_pisos').jqGrid('getDataIDs')[0];
                            $("#table_pisos").setSelection(firstid);    
                        }
                },
            ondblClickRow: function (Id){clickmodpiso();}
        });
        
        $("#inp_nro_exp").keypress(function (e) {
            if (e.which == 13) {

                   fn_obtener_exp();

            }
        });
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/procuraduria/procuraduria.js') }}"></script>

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
                            <input id="inp_referencia" type="text"  class="form-control" style="height: 32px; ">
                        </div>
                    </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Procedimiento. &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div class=""  >
                        <input id="inp_procedimiento" type="text"  class="form-control" style="height: 32px; ">
                    </div>
                </div>
            </div>
            
            <div id="btn_agregar_expediente">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="guardar_editar_datos(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_expediente">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="guardar_editar_datos(2);" style="padding: 0px;margin-top: 10px ">
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
                    <table id="table_pisos" ></table>
                    <div id="pager_table_pisos"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="" >
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

@endsection


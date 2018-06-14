@extends('layouts.pas')
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
                                Inspección
                                <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                            </a>
                        </li>
                    </ul>
                        
                    <div id="myTabContent1" class="tab-content padding-1"> 
                        
                        <div id="s1" class="tab-pane fade active in">
                            <div class="col-xs-12" style="padding: 5px">
                                <h1><b>Inspección</b></h1>
                                <div class="col-lg-2" style="padding-left: 0px; padding-top: 10px; ">
                                   <div class="input-group input-group-md">
                                       <span class="input-group-addon">Desde:</span>
                                       <div class="icon-addon addon-md">
                                           <input  id="dlg_fec_desde" name="dlg_fec" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                       </div>
                                   </div>
                               </div>
                                <div class="col-lg-2" style="padding-right: 5px; padding-top: 10px; ">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Hasta:</span>
                                        <div class="icon-addon addon-md">
                                            <input id="dlg_fec_hasta" name="dlg_fec" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1" style="padding-right: 5px; padding-top: 10px; ">
                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="selecciona_fecha()">
                                        <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                                    </button>
                                </div>
                                <div class="text-right" style=" padding-top: 10px">

                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nuevo_exp();">
                                           <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                       </button>

                                       <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_exp();">
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
                            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                <article class="col-xs-11" style=" padding: 0px !important">
                                        <table id="table_expedientes"></table>
                                        <div id="pager_table_expedientes"></div>
                                </article>
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
        $("#menu_fisca").show();
        $("#li_fisca_carta").addClass('cr-active')
        fecha_desde = $("#dlg_fec_desde").val(); 
        fecha_hasta = $("#dlg_fec_hasta").val(); 
        jQuery("#table_expedientes").jqGrid({
            url: 'pas/0?grid=registro_expe_sancionador&fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_exp_san', 'NRO. EXPEDIENTE', 'FASE', 'GESTOR DEL TRAMITE','FECHA REGISTRO'],
            rowNum: 200, sortname: 'id_exp_san', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_exp_san', index: 'id_exp_san', hidden: true},
                {name: 'nro_exp_san', index: 'nro_exp_san', align: 'left', width: 10},
                {name: 'anio', index: 'anio', align: 'left', width: 10},
                {name: 'gestor', index: 'gestor', align: 'left', width: 40},
                {name: 'fec_reg', index: 'fec_reg', align: 'left', width: 15}
            ],
            pager: '#pager_table_expedientes',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_expedientes').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_expedientes').jqGrid('getDataIDs')[0];
                            $("#table_expedientes").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){actualizar_exp();}
        });
      
       
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/pas/reg_exp_san.js') }}"></script>

<div id="dlg_nuevo_exp" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            
            <section class="col-xs-12" style="padding: 0px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                            <h2>Ingresar Información ::..</h2>
                    </header>
                </div>
            </section>
            <div class="col-xs-12" style="padding: 0px; margin-bottom: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 150px">Tipo de Proceso: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div>
                        <select id='seltipdoc' name="seltipdoc" class="form-control col-lg-8" style="height: 32px;">
                            @foreach ($tipo_proceso as $tdoc)
                            <option value='{{$tdoc->id_tipo_proceso}}' >{{$tdoc->des_proceso}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-3" style="padding-left: 0px;">
                <div class="input-group input-group-md">
                        <span class="input-group-addon">Sector &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                    <div class="icon-addon addon-md">
                        <input class="text-center col-xs-12 form-control"  style="height: 32px;" id="dlg_sec" type="text" disabled="" >
                    </div>
                </div>
            </div>
            <div class="col-xs-3" style="padding-left: 0px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Manzana &nbsp;&nbsp;<i class="fa fa-apple"></i></span>
                    <div class="icon-addon addon-md">
                        <input class="text-center form-control" style="height: 32px;" id="dlg_mzna" type="text"  disabled="" >
                    </div>
                </div>
            </div>
            <div class="col-xs-3" style="padding-left: 0px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Lotes &nbsp;<i class="fa fa-home"></i></span>
                    <div class="icon-addon addon-md">
                        <input class="text-center form-control" style="height: 32px;" id="dlg_lot" type="text"  disabled="" >
                        <input type="hidden" id="hidden_dlg_lot" value="0">
                    </div>
                </div>
            </div>
            <div class="col-xs-3" style="padding-left: 0px;">
                <button style="width: 100%" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="map_reg_lote();">
                    <span class="btn-label"><i class="glyphicon glyphicon-globe"></i></span>Buscar en Mapa
                </button>
            </div>
            
            <section class="col-xs-12" style="padding: 0px; margin-top: 10px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 5px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                            <h2>Datos de Persona ::..</h2>
                    </header>
                </div>
            </section>
            
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 150px">Tipo de Proceso: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div>
                        <select id='seltipper' name="seltipdoc" class="form-control col-lg-8" style="height: 32px;" onchange="validatipopersona();">
                            <option value='1' >Persona Natural</option>
                            <option value='2' >Persona Jurídica</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 10px">
                <div class="input-group input-group-md">
                    <input type="hidden" id="dlg_idpre" value="0">
                    <span class="input-group-addon">Nro. Documento &nbsp;&nbsp;<i class="fa fa-inbox"></i></span>
                    <div class="icon-addon addon-md">
                        <input class="text-center col-xs-12 form-control"  style="height: 32px;" id="inp_nro_doc" type="text" onkeypress="return soloDNI(event);">
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px" id="div_per_natural">
                <div class="col-xs-4" style="padding-left: 0px;">
                    <div class="input-group input-group-md">
                        <input type="hidden" id="dlg_idpre" value="0">
                        <span class="input-group-addon">Ape. Paterno &nbsp;&nbsp;<i class="fa fa-male"></i></span>
                        <div class="icon-addon addon-md">
                            <input class=" col-xs-12 form-control"  style="height: 32px;" id="inp_ape_pat" type="text" maxlength="20" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-4" style="padding-left: 0px;">
                    <div class="input-group input-group-md">
                        <input type="hidden" id="dlg_idpre" value="0">
                        <span class="input-group-addon">Ape. Materno &nbsp;&nbsp;<i class="fa fa-male"></i></span>
                        <div class="icon-addon addon-md">
                            <input class=" col-xs-12 form-control"  style="height: 32px;" id="inp_ape_mat" type="text" maxlength="20" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-4" style="padding-right: 0px;">
                    <div class="input-group input-group-md">
                        <input type="hidden" id="dlg_idpre" value="0">
                        <span class="input-group-addon">Nombres &nbsp;&nbsp;<i class="fa fa-male"></i></span>
                        <div class="icon-addon addon-md">
                            <input class=" col-xs-12 form-control"  style="height: 32px;" id="inp_nom_per" type="text" maxlength="50" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px" id="div_per_juridica">
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <input type="hidden" id="dlg_idpre" value="0">
                        <span class="input-group-addon">Razon Social &nbsp;&nbsp;<i class="fa fa-cog"></i></span>
                        <div class="icon-addon addon-md">
                            <input class=" col-xs-12 form-control"  style="height: 32px;" id="inp_raz_soc" type="text" maxlength="200" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md">
                    <input type="hidden" id="dlg_idpre" value="0">
                    <span class="input-group-addon">Dom. Fiscal &nbsp;&nbsp;<i class="fa fa-map"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" col-xs-12 form-control"  style="height: 32px;" id="inp_dom_fis" type="text" maxlength="200" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dlg_mapa_reg_lote" >
    <input type="hidden" id="hidden_inp_habilitacion" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
            <div id="legend"></div>
        </div>
    </form>
</div>

<div id="dlg_view_foto" style="display: none;">
    <div class="col-xs-12">
       <div class=" col-xs-3">
            <div class="input-group input-group-md">
                <input type="hidden" id="dlg_idpre" value="0">
                <span class="input-group-addon">Sector &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                <div class="icon-addon addon-md">
                    <input class="text-center col-xs-12 form-control"  style="height: 32px;" id="dlg_sec_foto" type="text" name="dlg_sec" disabled="" >
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="input-group input-group-md">
                <span class="input-group-addon">Manzana &nbsp;&nbsp;<i class="fa fa-apple"></i></span>
                <div class="icon-addon addon-md">
                    <input class="text-center form-control" style="height: 32px;" id="dlg_mzna_foto" type="text" name="dlg_mzna" disabled="" >
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="input-group input-group-md">
                <span class="input-group-addon">Lotes &nbsp;<i class="fa fa-home"></i></span>
                <div class="icon-addon addon-md">
                    <input class="text-center form-control" style="height: 32px;" id="dlg_lot_foto" type="text" name="dlg_mzna" disabled="" >
                    <input type="hidden" id="hidden_dlg_lot_foto" value="0">
                </div>
            </div>
        </div>
        <div class="col-xs-3" style="padding-left: 0px;">
            <button style="width: 100%" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="selec_reg_lote();">
                <span class="btn-label"><i class="glyphicon glyphicon-check"></i></span>Seleccinar Lote
            </button>
        </div>
    </div>
    <div class="panel panel-success cr-panel-sep" style="border:0px; margin-top: 10px">
        <div class="panel-body cr-body">
            <div id="dlg_img_view_big" style="padding-top: 0px"></div>
        </div>
    </div>
</div> 
@endsection


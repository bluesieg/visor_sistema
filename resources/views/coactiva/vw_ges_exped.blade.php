@extends('layouts.app')
@section('content')
<style>
    .icon-addon .form-control, .icon-addon.addon-md .form-control {
        padding-left: 10px; 
    }
    .btn-label {        
        left: -12px;        
        padding: 5px 8px;        
    }
</style>
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">            
            <div class="well well-sm well-light" style="padding:0px;margin-bottom: 5px">                
                <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 1px;">
                    <header style="background: #01a858 !important;color: white; padding-right: 15px !important" >
                        <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                        <h2>GESTION DE EXPEDIENTES...</h2>
                    </header>                                
                </div>
                <ul id="tabs1" class="nav nav-tabs bordered">
                    <li class="active">
                        <a href="#s1" data-toggle="tab" aria-expanded="true">
                            POR CONTRIBUYENTE
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>
                    <li class="">
                        <a href="#s2" data-toggle="tab" aria-expanded="false">
                            POR EXPEDIENTE
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>                
                </ul>
                <div id="myTabContent1" class="tab-content padding-10">
                    <div id="s1" class="tab-pane fade active in" style="height: auto">
                        <section style="margin-top: 5px">                                                 
                            <div class="row">                                
                                <section class="col-lg-2" style="padding-right: 5px;">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Cod.<i class="icon-append fa fa-lock" style="margin-left: 5px;"></i></span>
                                        <div class="icon-addon addon-md">
                                            <input id="hidden_vw_ges_exped_codigo" type="hidden" value="0">
                                            <input id="vw_ges_exped_codigo" type="text" class="form-control" style="padding-left:6px;padding-right:6px">
                                        </div>
                                    </div>
                                </section>
                                <section class="col-lg-6" style="padding-left: 5px;padding-right:5px">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Contribuyente<i class="icon-append fa fa-male" style="margin-left: 5px;"></i></span>
                                        <div class="icon-addon addon-md">
                                            <input id="vw_ges_exped_contrib" class="form-control text-uppercase" type="text">
                                        </div>
                                        <span class="input-group-btn">
                                            <button onclick="bus_contrib();" class="btn btn-primary" type="button" title="BUSCAR">
                                                <i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;Buscar
                                            </button>
                                        </span>                                        
                                    </div>                                    
                                </section>
                                <section class="col-lg-4 text-right" style="padding-left: 5px;">                                    
                                    <button onclick="dlg_select_new_doc();" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                        <span class="btn-label"><i class="fa fa-file-text"></i></span>Nuevo Documento
                                    </button>
                                </section>
                            </div>
                        </section>                        
                        <hr style="border: 1px solid #DDD;margin: 10px -10px">
                        <section style="">              
                            <div class="row">
                                <section id="content_1" class="col col-lg-2" style="padding-right:5px"> 
                                    <table id="tabla_expedientes"></table>
                                    <div id="p_tabla_expedientes"></div>                     
                                </section>                                
                                <section id="content_2" class="col col-lg-10" style="padding-left:5px">
                                    <table id="tabla_doc_coactiva"></table>
                                    <div id="p_tabla_doc_coactiva"></div>
                                </section>                            
                            </div>
                        </section>        
                    </div>
                    <div id="s2" class="tab-pane fade" style="height: 300px">
                        asd                    
                    </div>
                </div>
            </div>
        </div>       
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_coactiva").show();
        $("#li_gesion_exped").addClass('cr-active');
        jQuery("#tabla_expedientes").jqGrid({
            url: 'get_exped?id_contrib=0',
            datatype: 'json', mtype: 'GET',
            height: 329, autowidth: true,
            toolbarfilter: true,
            colNames: ['Nro', 'Expediente'],
            rowNum: 20, sortname: 'nro_procedimiento', sortorder: 'asc', viewrecords: true, caption: 'Expedientes', align: "center",
            colModel: [
                {name: 'nro_procedimiento', index: 'nro_procedimiento',align: 'center', width: 30 },
                {name: 'nro_exped', index: 'nro_exped', align: 'center', width: 80}                
            ],            
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#tabla_expedientes').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#tabla_expedientes').jqGrid('getDataIDs')[0];
                            $("#tabla_expedientes").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){ ver_docum_exped(Id);}
        });
        jQuery("#tabla_doc_coactiva").jqGrid({
            url: 'get_doc_exped?id_coa_mtr=0',
            datatype: 'json', mtype: 'GET',
            height: 300, autowidth: true,
            toolbarfilter: true,
            colNames: ['Nro', 'Fch.Emision', 'Tipo Gestion', 'N° Resol / Docum.','Fch.Recep','Ver','Editar'],
            rowNum: 20, sortname: 'id_doc', sortorder: 'asc', viewrecords: true, caption: 'Documentos', align: "center",
            colModel: [
                {name: 'nro', index: 'nro', align: 'center', width: 20},
                {name: 'fch_emi', index: 'fch_emi', align: 'center', width: 50},
                {name: 'tip_gestion', index: 'tip_gestion', align: 'left', width: 230},
                {name: 'nro_resol', index: 'nro_resol', align: 'center', width: 80},
                {name: 'fch_recep', index: 'fch_recep', align: 'center', width: 50},                
                {name: 'ver', index: 'ver', align: 'center', width: 60},
                {name: 'edit', index: 'edit', align: 'center', width: 60} 
            ],
            pager: '#p_tabla_doc_coactiva',
            rowList: [13, 20],
            onRightClick: function (rowid, iRow, iCol, e) {
                alert(5);
            },
            gridComplete: function () {
                    var idarray = jQuery('#tabla_doc_coactiva').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#tabla_doc_coactiva').jqGrid('getDataIDs')[0];
                            $("#tabla_doc_coactiva").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        $(window).on('resize.jqGrid', function () {
            $("#tabla_expedientes").jqGrid('setGridWidth', $("#content_1").width());
            $("#tabla_doc_coactiva").jqGrid('setGridWidth', $("#content_2").width());
        });
        jQuery("#table_contrib").jqGrid({
            url: 'obtiene_cotriname?dat=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers', 'codigo', 'DNI/RUC', 'contribuyente'],
            rowNum: 20, sortname: 'contribuyente', sortorder: 'asc', viewrecords: true, caption: 'Contribuyentes', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_per', index: 'id_per', align: 'center', width: 100},
                {name: 'nro_doc', index: 'nro_doc', align: 'center', width: 100},
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 260}
            ],
            pager: '#pager_table_contrib',
            rowList: [13, 20],
            gridComplete: function () {
                var idarray = jQuery('#table_contrib').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                    var firstid = jQuery('#table_contrib').jqGrid('getDataIDs')[0];
                    $("#table_contrib").setSelection(firstid);
                }
            },
            onSelectRow: function (Id) {},
            ondblClickRow: function (Id) {fn_bus_contrib_select(Id);}
        });
        var globalvalidador = 0;
        $("#vw_ges_exped_contrib").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0){                    
                    bus_contrib();                    
                    globalvalidador=1;
                }else{
                    globalvalidador=0;
                }
            }
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/coactiva/gestion_expediente.js') }}"></script>
<div id="dlg_select_doc" style="display: none;">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <section style="margin-top: 10px;margin-left: 30px;">
                        <label class="radio">
                                <input type="radio" name="add_doc_radio" value="2">
                                <i></i>RESOLUCION DE EJECUCION COACTIVA</label>
                        <label class="radio">
                                <input type="radio" name="add_doc_radio" value="3">
                                <i></i>RESOLUCION DE SUSPENCION DE PROCEDIMIENTO</label>
                        <label class="radio">
                                <input type="radio" name="add_doc_radio" value="4">
                                <i></i>RESOLUCION DE EMBARGO EN FORMA DE RETENCION</label>
                        <label class="radio">
                                <input type="radio" name="add_doc_radio" value="5">
                                <i></i>RESOLUCION DE EMBARGO EN FORMA DE INSCRIPCION</label>
                        <label class="radio">
                                <input type="radio" name="add_doc_radio" value="6">
                                <i></i>CONSTANCIA DE NOTIFICACION</label>
                        <label class="radio">
                                <input type="radio" name="add_doc_radio" value="7">
                                <i></i>REQUERIMIENTO DE PAGO</label>
                        <label class="radio">
                                <input type="radio" name="add_doc_radio" value="8">
                                <i></i>CARTA INFORMATIVA</label>
                        <label class="radio">
                                <input type="radio" name="add_doc_radio" value="9">
                                <i></i>ACTA DE APERSONAMIENTO</label>
                </section>
            </div>
        </div>
    </div>    
</div>
<div id="vw_coa_acta_apersonamiento" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Acta de Apersonamiento ::.</div>
                    <div class="panel-body">
                        <fieldset>
                            <div class="row">                                
                                <section class="col col-3" style="padding-right: 5px;">                                    
                                    <label class="label">N° Cuotas:</label>
                                    <label class="input">
                                        <input id="nro_cuo_apersonamiento" type="text" class="input-sm">
                                    </label>                      
                                </section
                                <section class="col col-3" style="padding-right: 5px;">                                    
                                    <label class="label">Monto:</label>
                                    <label class="input">
                                        <input id="nro_cuo_monto" type="text" class="input-sm">
                                    </label>                      
                                </section>
                                <section class="col col-6" style="padding-right:5px;">                                    
                                    <button onclick="add_cuo_acta_aper();" class="btn btn-primary btn-lg" style="margin-top:11px" type="button" title="Agregar Cuotas al Acta">
                                        <i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Agregar Cuotas
                                    </button>
                                </section>                                                      
                            </div>
                        </fieldset>
                    </div>
                </div>                
                <div class="panel panel-success" style="border: 0px !important;height: 325px; overflow-y: scroll">
                    <div class="panel-heading bg-color-success">.:: Vista Cuotas ::.</div>
                    <div class="panel-body">    
                        <div style="border: 1px solid #DDD; margin-bottom: 6px;">
                            <table id="t_dina_acta_aper" class="table table-bordered table-sm" cellspacing="10px">
                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center">N°</th>                                        
                                        <th width="20%" style="text-align: center">Fecha de Pago</th>
                                        <th width="20%" style="text-align: center">Monto</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                   
        </div>        
    </div>
</div>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div>
<div id="dlg_editor" style="display: none;">
    <iframe id="ck_editor_resol" width="770" height="515" marginheight="0" marginwidth="0" noresize scrolling="No" frameborder="0" style="border:1px solid #DDD"></iframe>
</div>
<div id="vw_coact_ver_doc" style="display: none;">
    <iframe id="vw_coa_iframe_doc" width="885" height="580"></iframe>
</div>

@endsection


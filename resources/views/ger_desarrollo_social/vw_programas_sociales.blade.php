@extends('layouts.programas_soc')
@section('content')

<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <div class="row">            
                    <section class="col col-lg-12">                        
                        <ul id="tabs1" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#s1" data-toggle="tab" aria-expanded="true" onclick="actualizar_grilla();">
                                    SISFOH
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   PENSIÓN 65 
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s3" data-toggle="tab" aria-expanded="false">
                                   COMEDORES POPULARES 
                                   <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            
                            <li>
                                <a href="#s4" data-toggle="tab" aria-expanded="false">
                                   VASO DE LECHE     
                                   <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li> 
                            <li>
                                <a href="#s5" data-toggle="tab" aria-expanded="false">
                                   BIENESTAR SOCIAL 
                                   <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li> 
                            <li>
                                <a href="#s6" data-toggle="tab" aria-expanded="false">
                                   INS. ASOCIACIONES    
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
                                        <h1><b>MANTENIMIENTO SISFOH</b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE :. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_sisfoh" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_sisfoh();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_sisfoh();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_sisfoh();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                            
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_sisfoh"></table>
                                                    <div id="pager_table_sisfoh"></div>
                                            </article>
                                        </div>                                        
                                       </div>                                         
                                    </section>                                    
                                </div>                                
                            </div>
                        </div>
                        </section>                        
                      </div>
                      <div id="s2" class="tab-pane fade ">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                       <div class="col-xs-12">
                                        <h1><b>MANTENIMIENTO DE PENSIÓN 65 </b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_pension" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_pension();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_pension();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_pension();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_pension"></table>
                                                    <div id="pager_table_pension"></div>
                                            </article>
                                        </div>                                        
                                       </div>                                         
                                    </section>                                    
                                </div>                                
                            </div>
                        </div>
                        </section>                        
                      </div>
                      <div id="s3" class="tab-pane fade">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                       <div class="col-xs-12">
                                        <h1><b>MANTENIMIENTO DE COMEDORES POPULARES </b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_comedores" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_comedores();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_comedores();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_comedores();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_comedores"></table>
                                                    <div id="pager_table_comedores"></div>
                                            </article>
                                        </div>                                        
                                       </div>                                         
                                    </section>                                    
                                </div>                                
                            </div>
                        </div>
                        </section>                        
                      </div>
                      <div id="s4" class="tab-pane fade">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                       <div class="col-xs-12">
                                        <h1><b>MANTENIMIENTO DE VASO DE LECHE </b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_vaso" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_vaso();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_vaso();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_vaso();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_vaso"></table>
                                                    <div id="pager_table_vaso"></div>
                                            </article>
                                        </div>                                        
                                       </div>                                         
                                    </section>                                    
                                </div>                                
                            </div>
                        </div>
                        </section>                        
                      </div>
                      <div id="s5" class="tab-pane fade">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                       <div class="col-xs-12">
                                        <h1><b>MANTENIMIENTO DE BIENESTAR SOCIAL </b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_bienestar" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_bienestar();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_bienestar();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_bienestar();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_bienestar"></table>
                                                    <div id="pager_table_bienestar"></div>
                                            </article>
                                        </div>                                        
                                       </div>                                         
                                    </section>                                    
                                </div>                                
                            </div>
                        </div>
                        </section>                        
                      </div>
                      <div id="s6" class="tab-pane fade">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                       <div class="col-xs-12">
                                        <h1><b>INSCRIPCIÓN DE ASOCIACIONES </b></h1>
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_asociaciones" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_asociaciones();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                    </button>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_asociaciones();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>
                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_asociaciones();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>                                        
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                            <article class="col-xs-12" style=" padding: 0px !important">
                                                    <table id="table_asociaciones"></table>
                                                    <div id="pager_table_asociaciones"></div>
                                            </article>
                                        </div>                                        
                                       </div>                                         
                                    </section>                                    
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
        jQuery("#table_sisfoh").jqGrid({
            url: 'programas_sociales/0?grid=sisfoh',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_sisfoh','FECHA','COD CATASTRAL','DNI','PERSONA'],
            rowNum: 50, sortname: 'id_sisfoh', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO SISFOH - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_sisfoh', index: 'id_sisfoh', hidden: true},
                {name: 'fecha', index: 'fecha', align: 'center', width: 150},
                {name: 'cod_catastral', index: 'cod_catastral', align: 'center', width: 150},
                {name: 'pers_nro_doc', index: 'pers_nro_doc', align: 'center', width: 150},
                {name: 'persona', index: 'persona', align: 'left', width: 600}
            ],
            pager: '#pager_table_sisfoh',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_sisfoh').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_sisfoh').jqGrid('getDataIDs')[0];
                            $("#table_sisfoh").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_sisfoh();}
        });
        jQuery("#table_pension").jqGrid({
            url: 'programas_sociales/0?grid=pension',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pension','FECHA','COD CATASTRAL','DNI','PERSONA'],
            rowNum: 50, sortname: 'id_pension', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO PENSIÓN 65 - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_pension', index: 'id_pension', hidden: true},
                {name: 'fecha', index: 'fecha', align: 'center', width: 150},
                {name: 'cod_catastral', index: 'cod_catastral', align: 'center', width: 150},
                {name: 'pers_nro_doc', index: 'pers_nro_doc', align: 'center', width: 150},
                {name: 'persona', index: 'persona', align: 'left', width: 600}
            ],
            pager: '#pager_table_pension',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_pension').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_pension').jqGrid('getDataIDs')[0];
                            $("#table_pension").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_pension();}
        });
        jQuery("#table_comedores").jqGrid({
            url: 'programas_sociales/0?grid=comedores',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_comedores','FECHA','COD CATASTRAL','DNI','PERSONA'],
            rowNum: 50, sortname: 'id_comedores', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO COMEDORES POPULARES - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_comedores', index: 'id_comedores', hidden: true},
                {name: 'fecha', index: 'fecha', align: 'center', width: 150},
                {name: 'cod_catastral', index: 'cod_catastral', align: 'center', width: 150},
                {name: 'pers_nro_doc', index: 'pers_nro_doc', align: 'center', width: 150},
                {name: 'persona', index: 'persona', align: 'left', width: 600}
            ],
            pager: '#pager_table_comedores',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_comedores').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_comedores').jqGrid('getDataIDs')[0];
                            $("#table_comedores").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_comedores();}
        });
        jQuery("#table_vaso").jqGrid({
            url: 'programas_sociales/0?grid=vaso',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_vaso','FECHA','COD CATASTRAL','DNI','PERSONA'],
            rowNum: 50, sortname: 'id_vaso', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO VASO DE LECHE - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_vaso', index: 'id_vaso', hidden: true},
                {name: 'fecha', index: 'fecha', align: 'center', width: 150},
                {name: 'cod_catastral', index: 'cod_catastral', align: 'center', width: 150},
                {name: 'pers_nro_doc', index: 'pers_nro_doc', align: 'center', width: 150},
                {name: 'persona', index: 'persona', align: 'left', width: 600}
            ],
            pager: '#pager_table_vaso',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_vaso').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_vaso').jqGrid('getDataIDs')[0];
                            $("#table_vaso").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_vaso();}
        });
        jQuery("#table_bienestar").jqGrid({
            url: 'programas_sociales/0?grid=bienestar',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_bienestar','FECHA','COD CATASTRAL','DNI','PERSONA'],
            rowNum: 50, sortname: 'id_bienestar', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO BIENESTAR SOCIAL - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_bienestar', index: 'id_bienestar', hidden: true},
                {name: 'fecha', index: 'fecha', align: 'center', width: 150},
                {name: 'cod_catastral', index: 'cod_catastral', align: 'center', width: 150},
                {name: 'pers_nro_doc', index: 'pers_nro_doc', align: 'center', width: 150},
                {name: 'persona', index: 'persona', align: 'left', width: 600}
            ],
            pager: '#pager_table_bienestar',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_bienestar').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_bienestar').jqGrid('getDataIDs')[0];
                            $("#table_bienestar").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_bienestar();}
        });
        jQuery("#table_asociaciones").jqGrid({
            url: 'programas_sociales/0?grid=asociaciones',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_asociaciones','FECHA','NOMBRE','DNI','PERSONA'],
            rowNum: 50, sortname: 'id_asociaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE ASOCIACIONES - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_asociaciones', index: 'id_asociaciones', hidden: true},
                {name: 'fecha', index: 'fecha', align: 'center', width: 150},
                {name: 'nombre', index: 'nombre', align: 'center', width: 150},
                {name: 'pers_nro_doc', index: 'pers_nro_doc', align: 'center', width: 150},
                {name: 'persona', index: 'persona', align: 'left', width: 600}
            ],
            pager: '#pager_table_asociaciones',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_asociaciones').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_asociaciones').jqGrid('getDataIDs')[0];
                            $("#table_asociaciones").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_asociaciones();}
        });
        
        jQuery("#table_observaciones_sisfoh").jqGrid({
            url: 'programas_sociales/0?grid=table_observaciones_sisfoh&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES SISFOH', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_sisfoh',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_sisfoh').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_sisfoh').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_sisfoh").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion_sisfoh()}
        });   
        jQuery("#table_observaciones_pension").jqGrid({
            url: 'programas_sociales/0?grid=table_observaciones_pension&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES PENSIÓN 65', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_pension',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_pension').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_pension').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_pension").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion_pension()}
        });
        jQuery("#table_observaciones_comedores").jqGrid({
            url: 'programas_sociales/0?grid=table_observaciones_comedores&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES COMEDORES POPULARES', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_comedores',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_comedores').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_comedores').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_comedores").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion_comedores()}
        });
        jQuery("#table_observaciones_vaso").jqGrid({
            url: 'programas_sociales/0?grid=table_observaciones_vaso&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES VASO DE LECHE', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_vaso',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_vaso').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_vaso').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_vaso").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion_vaso()}
        });
        jQuery("#table_observaciones_bienestar").jqGrid({
            url: 'programas_sociales/0?grid=table_observaciones_bienestar&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES BIENESTAR SOCIAL', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_bienestar',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_bienestar').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_bienestar').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_bienestar").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion_bienestar()}
        });
        jQuery("#table_observaciones_asociaciones").jqGrid({
            url: 'programas_sociales/0?grid=table_observaciones_asociaciones&indice=0',
            datatype: 'json', mtype: 'GET',
            height: '150px', width: '200px',
            toolbarfilter: true,
            colNames: ['ID', 'FECHA DE REGISTRO','OBSERVACION'],
            rowNum: 50, sortname: 'id_observaciones', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE OBSERVACIONES ASOCIACIONES', align: "center",
            colModel: [
                {name: 'id_observaciones', index: 'id_observaciones', align: 'left',width: 20, hidden: true},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 200},
                {name: 'observaciones', index: 'observaciones', align: 'left', width: 500}
            ],
            pager: '#pager_table_observaciones_asociaciones',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_observaciones_asociaciones').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_observaciones_asociaciones').jqGrid('getDataIDs')[0];
                            $("#table_observaciones_asociaciones").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_observacion_asociaciones()}
        });
        
        $("#dlg_buscar_sisfoh").keypress(function (e) {
            if (e.which == 13) {

                   buscar_sisfoh();

            }
        });
        $("#dlg_buscar_pension").keypress(function (e) {
            if (e.which == 13) {

                   buscar_pension();

            }
        });
        $("#dlg_buscar_comedores").keypress(function (e) {
            if (e.which == 13) {

                   buscar_comedores();

            }
        });
        $("#dlg_buscar_vaso").keypress(function (e) {
            if (e.which == 13) {

                   buscar_vaso();

            }
        });
        $("#dlg_buscar_bienestar").keypress(function (e) {
            if (e.which == 13) {

                   buscar_bienestar();

            }
        });
        $("#dlg_buscar_asociaciones").keypress(function (e) {
            if (e.which == 13) {

                   buscar_asociaciones();

            }
        });
        $("#inp_dni_sisfoh").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_sisfoh").val(),"hidden_inp_persona_sisfoh","inp_nombre_sisfoh","inp_fechanac_sisfoh");
            }
        });
        $("#inp_dni_pension").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_pension").val(),"hidden_inp_persona_pension","inp_nombre_pension","inp_fechanac_pension");
            }
        });
        $("#inp_dni_comedores").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_comedores").val(),"hidden_inp_persona_comedores","inp_nombre_comedores","inp_fechanac_comedores");
            }
        });
        $("#inp_dni_vaso").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_vaso").val(),"hidden_inp_persona_vaso","inp_nombre_vaso","inp_fechanac_vaso");
            }
        });
        $("#inp_dni_bienestar").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_bienestar").val(),"hidden_inp_persona_bienestar","inp_nombre_bienestar","inp_fechanac_bienestar");
            }
        });
        $("#inp_dni_asociaciones").keypress(function (e) {
            if (e.which == 13) {

                   consultar_dni($("#inp_dni_asociaciones").val(),"hidden_inp_persona_asociaciones","inp_nombre_asociaciones","inp_fechanac_asociaciones");
            }
        });
        
       
         
        
    });
</script>

@stop

<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/sisfoh.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/pension.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/comedores.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/vaso.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/bienestar.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_desa_social/asociaciones.js') }}"></script>

<div id="dlg_nuevo_sisfoh" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_sisfoh" class="col-xs-12 cr-body" >            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <input id="hidden_id_sisfoh" name="hidden_id_sisfoh" type="hidden" class="form-control" style="height: 30px;" >
                            <h2>Ingresar Información de Jefe de Familia::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PERSONA: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_sisfoh" name="inp_dni_sisfoh" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_persona_sisfoh" name="hidden_inp_persona_sisfoh" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_nombre_sisfoh" name="inp_nombre_sisfoh" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FEC.NACIMIENTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="inp_fechanac_sisfoh" name="inp_fechanac_sisfoh"  data-mask="9999/99/99" class="form-control" style="height: 30px;" >
                    </div>
                </div>
            </div> 
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Familia::..</h2>
                    </header>
                </div>
            </section>                              
            <div class="col-xs-12" style="padding: 0px; margin-bottom: 10px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">N° FAMILIAS : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="inp_num_familias" name="inp_num_familias" type="number" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>                
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Ubicación::..</h2>
                    </header>
                </div>
            </section> 
             <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion_sisfoh" type="text" name="inp_direccion_sisfoh" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>  
             <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_sisfoh" name="hidden_id_lote_sisfoh" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_sisfoh" name="inp_cod_catastral_sisfoh" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_sisfoh();" style=" " >
               <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
           </button>           
           </div> 
            
             <div id="btn_agregar_sisfoh">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_sisfoh(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_sisfoh">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_sisfoh(4);" style="padding: 0px;margin-top: 10px ">
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
                    <table id="table_observaciones_sisfoh" ></table>
                    <div id="pager_table_observaciones_sisfoh"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_sisfoh();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_sisfoh();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_sisfoh();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>
<div id="dlg_nuevo_pension" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_pension" class="col-xs-12 cr-body" >            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <input id="hidden_id_pension" name="hidden_inp_pension" type="hidden" class="form-control" style="height: 30px;" >
                            <h2>Ingresar Información de Persona::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PERSONA: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_pension" name="inp_dni_pension" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_persona_pension" name="hidden_inp_persona_pension" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_nombre_pension" name="inp_nombre_pension" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FEC.NACIMIENTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="inp_fechanac_pension" name="inp_fechanac_pension"  data-mask="9999/99/99" class="form-control" style="height: 30px;" >
                    </div>
                </div>
            </div> 
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Ubicación::..</h2>
                    </header>
                </div>
            </section> 
             <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion_pension" type="text" name="inp_direccion_pension" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>  
             <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_pension" name="hidden_id_lote_pension" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_pension" name="inp_cod_catastral_pension" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_pension();" style=" " >
               <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
           </button>           
           </div> 
           
             <div id="btn_agregar_pension">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_pension(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_pension">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_pension(4);" style="padding: 0px;margin-top: 10px ">
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
                    <table id="table_observaciones_pension" ></table>
                    <div id="pager_table_observaciones_pension"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_pension();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_pension();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_pension();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>

<div id="dlg_nuevo_comedores" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_comedores" class="col-xs-12 cr-body" >            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <input id="hidden_id_comedores" name="hidden_inp_comedores" type="hidden" class="form-control" style="height: 30px;" >
                            <h2>Ingresar Información de Persona::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PERSONA: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_comedores" name="inp_dni_comedores" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_persona_comedores" name="hidden_inp_persona_comedores" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_nombre_comedores" name="inp_nombre_comedores" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FEC.NACIMIENTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="inp_fechanac_comedores" name="inp_fechanac_comedores"  data-mask="9999/99/99" class="form-control" style="height: 30px;" >
                    </div>
                </div>
            </div> 
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Ubicación::..</h2>
                    </header>
                </div>
            </section> 
             <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion_comedores" type="text" name="inp_direccion_comedores" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>  
             <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_comedores" name="hidden_id_lote_comedores" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_comedores" name="inp_cod_catastral_comedores" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_comedores();" style=" " >
               <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
           </button>           
           </div> 
            
             <div id="btn_agregar_comedores">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_comedores(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_comedores">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_comedores(4);" style="padding: 0px;margin-top: 10px ">
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
                    <table id="table_observaciones_comedores" ></table>
                    <div id="pager_table_observaciones_comedores"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_comedores();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_comedores();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_comedores();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>


<div id="dlg_nuevo_vaso" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_vaso" class="col-xs-12 cr-body" >            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <input id="hidden_id_vaso" name="hidden_inp_vaso" type="hidden" class="form-control" style="height: 30px;" >
                            <h2>Ingresar Información de Persona::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PERSONA: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_vaso" name="inp_dni_vaso" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_persona_vaso" name="hidden_inp_persona_vaso" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_nombre_vaso" name="inp_nombre_vaso" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FEC.NACIMIENTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="inp_fechanac_vaso" name="inp_fechanac_vaso"  data-mask="9999/99/99" class="form-control" style="height: 30px;" >
                    </div>
                </div>
            </div> 
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Ubicación::..</h2>
                    </header>
                </div>
            </section> 
             <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion_vaso" type="text" name="inp_direccion_vaso" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>  
             <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_vaso" name="hidden_id_lote_vaso" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_vaso" name="inp_cod_catastral_vaso" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_vaso();" style=" " >
               <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
           </button>           
           </div> 
            
             <div id="btn_agregar_vaso">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_vaso(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_vaso">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_vaso(4);" style="padding: 0px;margin-top: 10px ">
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
                    <table id="table_observaciones_vaso" ></table>
                    <div id="pager_table_observaciones_vaso"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_vaso();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_vaso();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_vaso();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>
<div id="dlg_nuevo_bienestar" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_bienestar" class="col-xs-12 cr-body" >            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <input id="hidden_id_bienestar" name="hidden_inp_bienestar" type="hidden" class="form-control" style="height: 30px;" >
                            <h2>Ingresar Información de Persona::..</h2>
                    </header>
                </div>
            </section>    
             <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PERSONA: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_bienestar" name="inp_dni_bienestar" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_persona_bienestar" name="hidden_inp_persona_bienestar" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_nombre_bienestar" name="inp_nombre_bienestar" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FEC.NACIMIENTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="inp_fechanac_bienestar" name="inp_fechanac_bienestar"  data-mask="9999/99/99" class="form-control" style="height: 30px;" >
                    </div>
                </div>
            </div> 
            </div> 
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <h2>Ingresar Información de Ubicación::..</h2>
                    </header>
                </div>
            </section> 
             <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion_bienestar" type="text" name="inp_direccion_bienestar" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>  
             <div class="col-xs-9" style="padding: 0px; margin-top:0px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">COD. CATASTRAL : &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="hidden_id_lote_bienestar" name="hidden_id_lote_bienestar" type="hidden"  style="height: 30px;"  >
                        <input id="inp_cod_catastral_bienestar" name="inp_cod_catastral_bienestar" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div> 
            <button id="btn_bus_mapa" type="button" class="btn btn-labeled bg-color-blue txt-color-white col-xs-2" onclick="cargar_mapa_bienestar();" style=" " >
               <span class="cr-btn-label"><i class="glyphicon glyphicon-search"></i></span>Ubicar Mapa
           </button>           
           </div> 
           
             <div id="btn_agregar_bienestar">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_bienestar(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_bienestar">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_bienestar(4);" style="padding: 0px;margin-top: 10px ">
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
                    <table id="table_observaciones_bienestar" ></table>
                    <div id="pager_table_observaciones_bienestar"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_bienestar();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_bienestar();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_bienestar();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>


<div id="dlg_nuevo_asociaciones" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_asociaciones" class="col-xs-12 cr-body" >            
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <input id="hidden_id_asociaciones" name="hidden_inp_asociaciones" type="hidden" class="form-control" style="height: 30px;" >
                            <h2>Ingresar Información de Asociación::..</h2>
                    </header>
                </div>
            </section>                  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">HAB. URBANA: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_hab_urb" name="hidden_inp_hab_urb" type="" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_hab_urb" name="inp_hab_urb" type="text" class="form-control" style="height: 30px;" maxlength="250">
                    </div>
                </div>
            </div>            
            </div> 
            <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">PARTIDA REGISTRAL: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_partida_registral" type="text" name="inp_partida_registral" class="form-control text-uppercase" maxlength="150" onkeypress="return soloNumeroTab(event);"style="height: 30px;"  >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">VIGENCIA: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_vigencia" type="text" name="inp_vigencia" class="form-control text-uppercase"onkeypress="return soloNumeroTab(event);" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
            <section>
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                            <input id="hidden_id_asociaciones" name="hidden_inp_asociaciones" type="hidden" class="form-control" style="height: 30px;" >
                            <h2>Ingresar Información de Personas::..</h2>
                    </header>
                </div>
            </section>
            <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECTIVA: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_directiva" type="text" name="inp_directiva" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>
                <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">PADRON DE SOCIOS: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_patron_socios" type="text" name="inp_patron_socios" class="form-control text-uppercase" maxlength="150" onkeypress="return soloNumeroTab(event);"style="height: 30px;"  >
                    </div>
                </div>
            </div>
             <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI PERSONA: &nbsp;<i class="fa fa-hashtag"></i></span>
                    <div> 
                        <input id="inp_dni_asociaciones" name="inp_dni_asociaciones" type="text" class="form-control" style="height: 30px;" maxlength="9" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>  
            <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="hidden_inp_persona_asociaciones" name="hidden_inp_persona_asociaciones" type="hidden" class="form-control" style="height: 30px;" maxlength="9" >
                        <input id="inp_nombre_asociaciones" name="inp_nombre_asociaciones" type="text" class="form-control" style="height: 30px;" maxlength="9" >
                    </div>
                </div>
            </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FEC.NACIMIENTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div> 
                        <input id="inp_fechanac_asociaciones" name="inp_fechanac_asociaciones"  data-mask="9999/99/99" class="form-control" style="height: 30px;" >
                    </div>
                </div>
            </div> 
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top:5px ;margin-bottom:5px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DIRECCIÓN: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="inp_direccion_asociaciones" type="text" name="inp_direccion_asociaciones" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>
             <div id="btn_agregar_asociaciones">
            <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-5" onclick="save_datos_asociaciones(1);" style="padding: 0px;margin-top: 10px ">
                <span class="cr-btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Guardar Datos
            </button>
            </div>
            
            <div id="btn_modificar_asociaciones">
            <button type="button" class="btn bg-color-blue txt-color-white btn-labeled col-xs-5" onclick="save_datos_asociaciones(4);" style="padding: 0px;margin-top: 10px ">
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
                    <table id="table_observaciones_asociaciones" ></table>
                    <div id="pager_table_observaciones_asociaciones"></div>
                </div>
                <div class="col-xs-2">
                    <button class="btn bg-color-green txt-color-white cr-btn-big" style="width: 120px;"onclick="nueva_observacion_asociaciones();" >
                       <i class="glyphicon glyphicon-plus-sign"></i>
                    </button>
                    <button class="btn bg-color-blue txt-color-white cr-btn-big"style="width: 120px;" onclick="modificar_observacion_asociaciones();" >
                       <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <button class="btn bg-color-red txt-color-white cr-btn-big"style="width: 120px;" onclick="eliminar_observacion_asociaciones();" >
                       <i class="glyphicon glyphicon-trash"></i
                    </button>                    
                </div>
            </div>
            
        </div>
    </div>
</div>




<!---------------mapas-------------->
<div id="dlg_mapa_sisfoh" >
    <input type="hidden" id="hidden_input_habilitacion_sisfoh" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_sisfoh" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>
<div id="dlg_mapa_pension" >
    <input type="hidden" id="hidden_input_habilitacion_pension" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_pension" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>
<div id="dlg_mapa_comedores" >
    <input type="hidden" id="hidden_input_habilitacion_comedores" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_comedores" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>
<div id="dlg_mapa_vaso" >
    <input type="hidden" id="hidden_input_habilitacion_vaso" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_vaso" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>
<div id="dlg_mapa_bienestar" >
    <input type="hidden" id="hidden_input_habilitacion_bienestar" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_bienestar" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>
<div id="dlg_mapa_asociaciones" >
    <input type="hidden" id="hidden_input_habilitacion_asociaciones" value="0"/>
    <form class="smart-form">
        <div id="id_map_reg_lote_asociaciones" style="background: white; height: 100% !important">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
        </div>
    </form>
</div>

<!--obseeeeeeeeeeeeervaciones-->

<div id="dlg_nueva_observacion_sisfoh" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_sisfoh" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>
<div id="dlg_nueva_observacion_pension" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_pension" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>
<div id="dlg_nueva_observacion_comedores" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_comedores" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>
<div id="dlg_nueva_observacion_vaso" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_vaso" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>
<div id="dlg_nueva_observacion_bienestar" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_bienestar" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>
<div id="dlg_nueva_observacion_asociaciones" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS OBSERVACION</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <textarea id="dlg_observacion_asociaciones" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                       
                    </div>
                </div>
            </div> 
      
        </div>
    </div>
    </div>    
</div>
@include('vw_personas')

@endsection

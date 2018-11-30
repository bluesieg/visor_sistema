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
                                Mantenimiento de Bermas
                                <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                            </a>
                        </li>
                        
                    </ul>
                        
                    <div id="myTabContent1" class="tab-content padding-1"> 
                        
                        <div id="s1" class="tab-pane fade active in">
                            <div class="col-xs-12" style="padding: 5px">
                                <h1 id="titulo_1"><b>Mantenimiento de Bermas</b></h1>
                                <div class="col-lg-4" style="padding-right: 5px; padding-top: 10px; ">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Buscar por Código:</span>
                                        <div class="icon-addon addon-md">
                                            <input class="form-control" id="dlg_bus_cod" name="dlg_bus_cod" type="text"   style="height: 32px; width: 100%" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1" style="padding-right: 5px; padding-top: 10px; ">
                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_man_bermas(1)">
                                        <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                                    </button>
                                </div>
                               
                                <div id="botones_1" class="text-right" style=" padding-top: 10px">

                                       <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_berma();">
                                           <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                       </button>
                                </div>
                                
                                <div  class="text-right" style=" padding-top: 10px">
                                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                        <article class="col-xs-12" style=" padding: 0px !important">
                                                <table id="table_bermas"></table>
                                                <div id="pager_table_bermas"></div>
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
        jQuery("#table_bermas").jqGrid({
            url: 'bermas/0?grid=bermas&cod=0',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id', 'Codigo Via', 'Lateral Derecha','Central','Lateral Izquierda'],
            rowNum: 100, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'Bermas', align: "center",
            colModel: [
                {name: 'id ', index: 'id ', hidden: true},
                {name: 'cod_via', index: 'cod_via', align: 'left', width: 50},
                {name: 'lateral_d', index: 'lateral_d', align: 'center', width: 50},
                {name: 'central', index: 'central', align: 'center', width: 50},
                {name: 'lateral_i', index: 'lateral_i', align: 'center', width: 50},
            ],
            pager: '#pager_table_bermas',
            rowList: [100, 200],
            gridComplete: function () {
                    var idarray = jQuery('#table_bermas').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_bermas').jqGrid('getDataIDs')[0];
                            $("#table_bermas").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){actualizar_berma();}
        });
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/vias/bermas.js') }}"></script>

<div id="dlg_edit_berma" style="display: none;">
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
                    <span class="input-group-addon" style="width: 200px">Codigo de Via &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                    <div class="icon-addon addon-md">
                        <input type="hidden" id="hidden_berma" value="0"/>
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cod_via" type="text" maxlength="6" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; ">
                
                <div class="tree smart-form" >
                    <ul >
                        <li >
                            <span style="width: 170px;">
                                <label class="checkbox inline-block" >
                                    <input type="checkbox" name="checkbox-inline" id="chk_derecha"/>
                                    <i></i>
                                    Lateral Derecha
                                </labe>
                            </span>
                        </li>
                        <li >
                            <span style="width: 170px;">
                                <label class="checkbox inline-block" >
                                    <input type="checkbox" name="checkbox-inline" id="chk_central" />
                                    <i></i>
                                    Central
                                </labe>
                            </span>
                        </li>
                        <li >
                            <span style="width: 170px;">
                                <label class="checkbox inline-block" >
                                    <input type="checkbox" name="checkbox-inline" id="chk_izquierda" />
                                    <i></i>
                                    Lateral Izquierda
                                </labe>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            
            
            <div  class="col-xs-12 text-right" style=" padding-top: 5px">
                    <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="save_berma();">
                        <span class="btn-label"><i class="glyphicon glyphicon-save"></i></span>Modificar
                    </button>
             </div>
            
            
        </div>
    </div>
</div>

@endsection


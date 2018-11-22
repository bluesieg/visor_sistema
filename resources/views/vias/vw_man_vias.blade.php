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
                                Mantenimiento de Vías
                                <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                            </a>
                        </li>
                        
                    </ul>
                        
                    <div id="myTabContent1" class="tab-content padding-1"> 
                        
                        <div id="s1" class="tab-pane fade active in">
                            <div class="col-xs-12" style="padding: 5px">
                                <h1 id="titulo_1"><b>Mantenimiento de Vías</b></h1>
                                <div class="col-xs-12" style="padding: 0px">
                                <div class="col-lg-4" style="padding-right: 5px; padding-top: 10px; ">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Buscar por Código:</span>
                                        <div class="icon-addon addon-md">
                                            <input class="form-control" id="dlg_bus_cod" name="dlg_bus_cod" type="text"   style="height: 32px; width: 100%" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1" style="padding-right: 5px; padding-top: 10px; ">
                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_man_vias(1)">
                                        <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                                    </button>
                                </div>
                                </div> 
                                <div class="col-lg-4" style="padding-right: 5px; padding-top: 10px; ">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Buscar por Nombre:</span>
                                        <div class="icon-addon addon-md">
                                            <input class="form-control" id="dlg_bus_nom" name="dlg_bus_nom" type="text"   style="height: 32px; width: 100%" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1" style="padding-right: 5px; padding-top: 10px; ">
                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_man_vias(2)">
                                        <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                                    </button>
                                </div>
                                <div id="botones_1" class="text-right" style=" padding-top: 10px">

                                       <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_ruta();">
                                           <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                       </button>
                                </div>
                                
                                <div  class="text-right" style=" padding-top: 10px">
                                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                        <article class="col-xs-12" style=" padding: 0px !important">
                                                <table id="table_vias"></table>
                                                <div id="pager_table_vias"></div>
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
        jQuery("#table_vias").jqGrid({
            url: 'vias/0?grid=vias&cod=0',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id', 'Codigo Via', 'Nombre Via','Tipo'],
            rowNum: 100, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'Vias', align: "center",
            colModel: [
                {name: 'id ', index: 'id ', hidden: true},
                {name: 'cod_via', index: 'cod_via', align: 'left', width: 30},
                {name: 'nombre_via', index: 'nombre_via', align: 'left', width: 70},
                {name: 'tipo_via', index: 'tipo_via', align: 'left', width: 70},
            ],
            pager: '#pager_table_vias',
            rowList: [100, 200],
            gridComplete: function () {
                    var idarray = jQuery('#table_vias').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_vias').jqGrid('getDataIDs')[0];
                            $("#table_vias").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){actualizar_via();}
        });
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/vias/vias.js') }}"></script>

<div id="dlg_edit_via" style="display: none;">
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
                        <input type="hidden" id="hidden_via" value="0"/>
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cod_via" type="text" maxlength="6" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Nombre de Via &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_nom_via" type="text" maxlength="50" >
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Tipo de Via &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_tip_via" type="text" maxlength="25" >
                    </div>
                </div>
            </div>
            <div  class="col-xs-12 text-right" style=" padding-top: 5px">
                    <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="save_via();">
                        <span class="btn-label"><i class="glyphicon glyphicon-save"></i></span>Modificar
                    </button>
             </div>
            
            
        </div>
    </div>
</div>

@endsection


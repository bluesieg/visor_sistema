@extends('layouts.rutas')
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
                                Mantenimiento de Areas Verdes
                                <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                            </a>
                        </li>
                    </ul>
                        
                    <div id="myTabContent1" class="tab-content padding-1"> 
                        
                        <div id="s1" class="tab-pane fade active in">
                            
                            <div class="col-xs-12" style="padding: 5px">
                                
                                <div  class="col-xs-12 text-right" style=" padding-top: 5px">
                                    <button  type="button" class="btn btn-labeled bg-color-red txt-color-white" onclick="imp_rep_areas_verdes();">
                                       <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Reporte
                                   </button>
                                        <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="nuevo_area_verde(0);">
                                            <span class="btn-label"><i class="glyphicon glyphicon-save"></i></span>Nuevo
                                        </button>
                                 </div>
                                <div id="id_mapa" style="background: white; height: 100% !important; margin-top: 10px">
                                    <div id="popup" class="ol-popup">
                                        <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                                        <div id="popup-content"></div>
                                    </div>
                                    <div id="legend"></div>
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
        
        
        window.app = {};
        var app = window.app;
        var layersList = [];
        var vectorSource = new ol.source.Vector({});
        
        app.CustomToolbarControl = function(opt_options) {

            var options = opt_options || {};

            var button = document.createElement('button');
            button.innerHTML = 'N';

            var button1 = document.createElement('button');
            button1.innerHTML = 'some button';

            var selectList = document.createElement("input");
            selectList.id = "inp_habilitacion";
            selectList.className = "input-sm col-xs-12 form-conttrol";
            selectList.type = "text";
            selectList.style = "height:32px";
            selectList.placeholder = "Seleccione Habilitación";

            var this_ = this;
            var handleRotateNorth = function(e) {
                this_.getMap().getView().setRotation(0);
            };

            button.addEventListener('click', handleRotateNorth, false);
            button.addEventListener('touchstart', handleRotateNorth, false);

            var element = document.createElement('div');
            element.className = 'ol-unselectable ol-mycontrol';
            element.style='width:700px !important'

            element.appendChild(selectList);

            ol.control.Control.call(this, {
                element: element,
                target: options.target
            });
        };
        ol.inherits(app.CustomToolbarControl, ol.control.Control);
        var map = new ol.Map({
            controls: ol.control.defaults({
                attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
                    collapsible: false
                })
            }).extend([
                new app.CustomToolbarControl()
            ]),
            layers: [
                new ol.layer.Group({
                    'title': 'Base maps',
                    layers: [
                        
                        new ol.layer.Tile({
                            title: 'OSM',
                            type: 'base',
                            visible: true,
                            source: new ol.source.OSM()
                        }),
                        new ol.layer.Tile({
                            title: 'Water color',
                            type: 'base',
                            visible: false,
                            source: new ol.source.Stamen({
                                layer: 'watercolor'
                            })
                        }),
                        new ol.layer.Tile({
                            title: 'Blanco',
                            type: 'base',
                            visible: false
                        }),
                        new ol.layer.Tile({
                            title: 'Satelite',
                            visible: false,
                            source: new ol.source.BingMaps({
                              key: 'EqfF5l6dY2LLMQa8JHlI~voA5TXsAVOQgFOP74piAbg~Aqg-emVFCImabFdRRDvdjqh1rB6Bl9l8ZkcmL7nGveSeeNkV7iSRC7XTHi1XeUVu',
                              imagerySet: 'Aerial'
                            })
                        })
                    ]
                })
            ],
            target: 'id_mapa',
            
        });
        $.ajax({url: 'areas_verdes/0?grid=mapa_areas_verdes',
                    type: 'GET',
                    async: false,
                    success: function(r)
                    {
                        mapa_bd = JSON.parse(r[0].json_build_object);
                        var format = new ol.format.GeoJSON();
                        var features = format.readFeatures(mapa_bd,
                                {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                        var jsonSource = new ol.source.Vector({
                            attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                        });
                        jsonSource.addFeatures(features);

                        lyr_areas_verdes = new ol.layer.Vector({
                            source:jsonSource,
                            style: areastyle,
                            title: "Area Verde",

                        });

                        map.addLayer(lyr_areas_verdes);
                        var scale = new ol.control.ScaleLine();
                        map.addControl(scale);
                        var extent = lyr_areas_verdes.getSource().getExtent();
                        map.getView().fit(extent, map.getSize());
                        var fullscreen = new ol.control.FullScreen();
                        map.addControl(fullscreen);
                    
            }
        });
        
  
        function areastyle(feature, resolution) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'green',
                    width: 2
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(0, 255, 0, 0.1)'
                }),
                text: new ol.style.Text({
                    font: '12px Calibri,sans-serif',
                    fill: new ol.style.Fill({ color: '#fff' }),
                    stroke: new ol.style.Stroke({
                        color: '#000', width: 2
                    }),
                    text:map.getView().getZoom() > 14 ? feature.get('codi_lote') : ""
                })
            });
        }
        autocompletar_haburb('inp_habilitacion');
        function autocompletar_haburb(textbox){
            $.ajax({
                type: 'GET',
                url: 'autocomplete_hab_urba',
                success: function (data) {

                    var $datos = data;
                    $("#"+ textbox).autocomplete({
                        source: $datos,
                        focus: function (event, ui) {
                            $("#" + textbox).val(ui.item.label);
                            return false;
                        },
                        select: function (event, ui) {
                            $("#" + textbox).val(ui.item.label);
                            $("#hidden_"+ textbox).val(ui.item.value);
                            traer_hab_by_id(ui.item.value);
                            return false;
                        }
                    });
                }
            });
        }
        
        function traer_hab_by_id(id)
        {
   
    
    MensajeDialogLoadAjax('dlg_map', '.:: Cargando ...');
    $.ajax({url: 'gethab_urb_by_id/'+id,
                type: 'GET',
                async: false,
                success: function(r)
                {
                    geojson_sectores_cat1 = JSON.parse(r[0].json_build_object);
                    var format_sectores_cat1 = new ol.format.GeoJSON();
                    var features_sectores_cat1 = format_sectores_cat1.readFeatures(geojson_sectores_cat1,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_sectores_cat1 = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_sectores_cat1.addFeatures(features_sectores_cat1);
                    lyr_sectores_cat1 = new ol.layer.Vector({
                        source:jsonSource_sectores_cat1,
                        style: polygonStyleFunction,
                        title: "Habilitaciones Urbanas"
                    });
                    map.addLayer(lyr_sectores_cat1);
                    var extent = lyr_sectores_cat1.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());

                }
            });
}
        function polygonStyleFunction(feature, resolution) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'blue',
                    width: 2
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(0, 0, 255, 0.1)'
                }),
                text: new ol.style.Text({
                    font: '12px Calibri,sans-serif',
                    fill: new ol.style.Fill({ color: '#fff' }),
                    stroke: new ol.style.Stroke({
                        color: '#000', width: 2
                    }),
                    text:map.getView().getZoom() > 14 ? feature.get('nomb_hab_urba') : ""
                })
            });
        }
       
        map.on('singleclick', function(evt) {

            
            mostrar=0;
            var fl = map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
               
                if(layer.get('title')=='Area Verde'&&mostrar==0)
                {
                    mostrar=1;
                    $("#hidden_area_ver").val(feature.get('id_lote'));
                    nuevo_area_verde(feature.get('id_lote'));
                    return false;
                }
            });
    
        });
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/areas_verdes/areas_verdes.js') }}"></script>
<div id="dlg_areas_verdes" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12" style="padding: 0px">
            <section class="col-xs-12" style="padding: 0px">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-map"></i> </span>
                            <h2>Ingresar Información ::..</h2>
                    </header>
                </div>
            </section>
           
                <div class="col-xs-3" style="padding-left: 0px;">
                        <div class="input-group input-group-md">
                            <input type="hidden" id="dlg_idpre" value="0">
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
                    <button style="width: 100%" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="map_reg_lote_areas();">
                        <span class="btn-label"><i class="glyphicon glyphicon-globe"></i></span>Buscar en Mapa
                    </button>
                </div>
           
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Codigo de Area Verde &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                    <div class="icon-addon addon-md">
                        <input type="hidden" id="hidden_area_ver" value="0"/>
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cod_area_verde" type="text" maxlength="8" >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Ubicación de Area Verde &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_ubicacion_area_verde" type="text" >
                    </div>
                </div>
            </div>
            
                
            <div  class="col-xs-12 text-right" style=" padding-top: 5px">
                    <button id="save_button"  type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="save_area_verde(1);">
                        <span class="btn-label"><i class="glyphicon glyphicon-save"></i></span>Grabar
                    </button>
            
                    <button id="mod_button"  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="save_area_verde(2);">
                        <span class="btn-label"><i class="glyphicon glyphicon-save"></i></span>modificar
                    </button>
             </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
           
            <section class="col-xs-12" style="padding: 0px;">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 5px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-search"></i> </span>
                            <h2>Foto ::..</h2>
                    </header>
                </div>
            </section>
            <div  class="col-xs-12" id="foto_area_verde">
                    
             </div>
            </div>
            
        </div>
    </div>
</div>



<div id="dlg_mapa_reg_lote" >
    <input type="hidden" id="hidden_inp_habilitacion_2" value="0"/>
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


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
                                Mantenimiento de Botaderos
                                <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                            </a>
                        </li>
                    </ul>
                        
                    <div id="myTabContent1" class="tab-content padding-1"> 
                        
                        <div id="s1" class="tab-pane fade active in">
                            <div id="botones_1" class="text-right" style=" padding-top: 10px">
                                    <button  type="button" class="btn btn-labeled bg-color-red txt-color-white" onclick="imp_rep_botaderos();">
                                       <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Reporte
                                   </button>
                            </div>
                            <div class="col-xs-12" style="padding: 5px">
                                
                                
                                <div id="id_mapa" style="background: white; height: 100% !important">
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
        $.ajax({url: 'botaderos/0?grid=mapa_botaderos',
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

                        lyr_botaderos = new ol.layer.Vector({
                            source:jsonSource,
                            style: botaderosstyle,
                            title: "Botaderos",

                        });

                        map.addLayer(lyr_botaderos);
                        var scale = new ol.control.ScaleLine();
                        map.addControl(scale);
                        var extent = lyr_botaderos.getSource().getExtent();
                        map.getView().fit(extent, map.getSize());
                        var fullscreen = new ol.control.FullScreen();
                        map.addControl(fullscreen);
                    
            }
        });
        
  
        function botaderosstyle(feature, resolution) {
            return  new ol.style.Style({
            image: new ol.style.Icon({
              scale: map.getView().getZoom() > 16 ? (map.getView().getZoom() > 18 ? 0.3 : 0.1) : 0.07,
              src: 'img/recursos/reciclaje.png',
            }),
            text: new ol.style.Text({
                
                Placement: 'point',
                textAlign: "center", 
                fill: new ol.style.Fill({
                    color: 'white',
                }),
                offsetY:map.getView().getZoom() > 16 ? 40 : 20
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
               
                if(layer.get('title')=='Botaderos'&&mostrar==0)
                {
                    mostrar=1;
                    limpiar_botadero('dlg_contenedores');
                    $("#foto_botadero").html("");
                    $("#hidden_botadero").val(feature.get('id_botadero'));
                    crear_edit_botaderos(feature.get('id_botadero'));
                    return false;
                }
            });
    
        });
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/limpieza_publica/botaderos.js') }}"></script>
<div id="dlg_botaderos" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-8" style="padding: 0px">
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
                    <span class="input-group-addon" style="width: 200px">Codigo de contendor &nbsp;&nbsp;<i class="fa fa-cogs"></i></span>
                    <div class="icon-addon addon-md">
                        <input type="hidden" id="hidden_botadero" value="0"/>
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_cod_botadero" type="text" maxlength="8" >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 200px">Ubicación de Botadero &nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
                    <div class="icon-addon addon-md">
                        <input class=" form-control" style="height: 32px; width: 100%" id="dlg_edit_ubicacion_botadero" type="text" >
                    </div>
                </div>
            </div>
            <div  class="col-xs-12 text-right" style=" padding-top: 5px">
                    <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="save_botadero();">
                        <span class="btn-label"><i class="glyphicon glyphicon-save"></i></span>Modificar
                    </button>
             </div>
            </div>
            <div class="col-xs-4" style="padding: 0px">
           
            <section class="col-xs-12" style="padding: 0px;">
                <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 5px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-search"></i> </span>
                            <h2>Foto ::..</h2>
                    </header>
                </div>
            </section>
            <div  class="col-xs-12" id="foto_botadero">
                    
             </div>
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


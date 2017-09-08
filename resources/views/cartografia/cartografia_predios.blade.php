@extends('layouts.app')

@section('content')
    <style>
        html, body {
            background-color: #ffffff;
        }
    </style>
    <style>
        html, body, #map {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
        }
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
    </style>
    <!--
    <div id="map">
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
        </div>
    </div>-->
    <form class="smart-form">


    <div id="map" style="background: white; height: 100%">
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
        </div>
    </div>
        </form>
    <!--
    <section class="col col-xs-12"style="position: absolute; alignment:center;width:150px;top:80px;left:10px;">
        <select id="sectores" class="input-sm col-xs-12" onchange="get_mzns_por_sector(this.value);">
            <option value='0' >--- Sector ---</option>
            @foreach ($sectores as $s)
                <option value='{{$s->codigo}}' >{{$s->sector}}</option>
            @endforeach
        </select><i></i>
    </section>
    -->
@section('page-js-script')
    <script type="text/javascript">

        $(document).ready(function () {
            $("#menu_cart_base").show();
            $("#li_ver_cart").addClass('cr-active');

        });
</script>
    <script>
        /*
        var url = 'https://sampleserver1.arcgisonline.com/ArcGIS/rest/services/' +
                'Specialty/ESRI_StateCityHighway_USA/MapServer';

        var layers = [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            }),
            new ol.layer.Image({
                source: new ol.source.ImageArcGISRest({
                    ratio: 1,
                    params: {},
                    url: url
                })
            })
        ];
        var map = new ol.Map({
            layers: layers,
            target: 'map',
            view: new ol.View({
                center: [-10997148, 4569099],
                zoom: 4
            })
        });
*/

        window.app = {};
        var app = window.app;
        var layersList = [];
        var vectorSource = new ol.source.Vector({});
        var lyr_sectores_cat1;
        var lyr_manzanas2;
        var lyr_limites_distritales0;
        var lyr_lotes3;
        var lyr_predios4;
        var LayersList2= [lyr_sectores_cat1,lyr_manzanas2,lyr_limites_distritales0,lyr_lotes3,lyr_predios4];

        var defaultCerroColorado = new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: '#0000ff',
                width: 2
            })
        });

        var manzanas_Style = new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: '#ff0000',
                width: 2
            })
        });

        var selectEuropa = new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: '#ff0000',
                width: 2
            })
        });

        app.CustomToolbarControl = function(opt_options) {

            var options = opt_options || {};

            var button = document.createElement('button');
            button.innerHTML = 'N';

            var button1 = document.createElement('button');
            button1.innerHTML = 'some button';

            var selectList = document.createElement("select");
            selectList.id = "sectores_map";
            selectList.className = "input-sm col-xs-5";
            selectList.onchange = function(e){
                console.log(e);
                get_mzns_por_sector(this.value);
                //alert(this.value);
            }

            var sectores = {!! json_encode($sectores) !!};
            var option = document.createElement("option");
            option.value = '0';
            option.text = "--- Sector ---";
            selectList.appendChild(option);
           // alert(global_cod_alm[0].codigo);
            for (var i = 0; i < sectores.length; i++) {
                var option = document.createElement("option");
                option.value = sectores[i].codigo;
                option.text = sectores[i].sector;
                selectList.appendChild(option);
            }

            var checkbox = document.createElement('input');
            checkbox.type = "checkbox";
            checkbox.name = "name"
            checkbox.value = "value";
            checkbox.id = "draw_predios";
            document.body.appendChild(checkbox);
            var div2 = document.createElement('div');
            div2.className = "col-xs-1";

            var label = document.createElement('label');
            label.className = 'toggle col-xs-2';
            label.innerHTML = '<input type="checkbox" id="draw_predios" name="checkbox-toggle" onclick="get_predios();"> <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Predios';

            var this_ = this;
            var handleRotateNorth = function(e) {
                this_.getMap().getView().setRotation(0);
            };


            button.addEventListener('click', handleRotateNorth, false);
            button.addEventListener('touchstart', handleRotateNorth, false);

            var element = document.createElement('div');
            element.className = 'ol-unselectable ol-mycontrol';

            element.appendChild(selectList);
            element.appendChild(div2);
            element.appendChild(label);

            ol.control.Control.call(this, {
                element: element,
                target: options.target
            });

        };
        ol.inherits(app.CustomToolbarControl, ol.control.Control);



        function styleFunction() {
            return [
                new ol.style.Style({
                    fill: new ol.style.Fill({
                        color: 'rgba(255,255,255,0.4)'
                    }),
                    stroke: new ol.style.Stroke({
                        color: '#3399CC',
                        width: 1.25
                    }),
                    text: new ol.style.Text({
                        font: '12px Calibri,sans-serif',
                        fill: new ol.style.Fill({ color: '#000' }),
                        stroke: new ol.style.Stroke({
                            color: '#fff', width: 2
                        }),
                        // get the text from the feature - `this` is ol.Feature
                        // and show only under certain resolution
                        text: map.getView().getZoom() > 12 ? this.get('description') : ''
                    })
                })
            ];
        }


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
                            title: 'Water color',
                            type: 'base',
                            visible: false,
                            source: new ol.source.Stamen({
                                layer: 'watercolor'
                            })
                        }),
                        new ol.layer.Tile({
                            title: 'OSM',
                            type: 'base',
                            visible: true,
                            source: new ol.source.OSM()
                        })
                    ]
                })
            ],
            target: 'map',
            view: new ol.View({
                center: [-11000000, 4600000],
                zoom: 4
            })
        });



        $.ajax({url: 'getlimites',
            type: 'GET',
            async: false,
            success: function(r)
            {
                geojson_limites_distritales0 = JSON.parse(r[0].json_build_object);
                var format_limites_distritales0 = new ol.format.GeoJSON();
                var features_limites_distritales0 = format_limites_distritales0.readFeatures(geojson_limites_distritales0,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_limites_distritales0 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_limites_distritales0.addFeatures(features_limites_distritales0);

                lyr_limites_distritales0 = new ol.layer.Vector({
                    source:jsonSource_limites_distritales0,
                    style: defaultCerroColorado,
                    title: "Límites Distritales"
                });

                map.addLayer(lyr_limites_distritales0);

            }
        });

        $.ajax({url: 'getsectores',
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
                    title: "Sectores Catastrales"
                });
                map.addLayer(lyr_sectores_cat1);
            }
        });

        map.getView().fit([-7986511.592568, -1853075.694599, -7949722.367052, -1825746.555644], map.getSize());
        var fullscreen = new ol.control.FullScreen();
        map.addControl(fullscreen);

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
                    text: feature.get('codigo')
                })
            });
        }

        function label_manzanas_full(feature) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'red',
                    width: 2
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(255, 0, 0, 0.1)'
                })
            });
        }


    </script>

    <script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/map/map.js') }}"></script>
@stop
    <div id="dlg_map" style="display: none;">
        <div class="widget-body">
            <div  class="smart-form">
                <div class="panel-group">
                    <div class="panel panel-success">
                        <div class="panel-heading bg-color-success">.:: Datos de la Manzana ::.</div>
                        <div class="panel-body">
                            <input type="hidden" id="id_mzna" value="0">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-2" style="padding-right: 5px; text-align: center">
                                        <label class="label" style="text-align: center">Id:</label>
                                        <label class="input">
                                            <input id="id" type="text" placeholder="" class="input-sm">
                                        </label><i></i>
                                    </section>

                                    <section class="col col-5" style="padding-left: 5px">
                                        <label class="label">Código:</label>
                                        <label class="input">
                                            <input id="codigo" type="text" placeholder="" class="input-sm">
                                        </label><i></i>
                                    </section>

                                    <section class="col col-5" style="padding-left: 5px">
                                        <label class="label">Sector:</label>
                                        <label class="input">
                                            <input id="sector" type="text" placeholder="" class="input-sm">
                                        </label><i></i>
                                    </section>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('configuracion/vw_general')

@endsection

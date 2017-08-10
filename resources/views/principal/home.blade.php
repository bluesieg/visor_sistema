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
    </style>
    <!--
    <div id="map">
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
        </div>
    </div>-->

    <div id="map" style="background: white; height: 100%">
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
        </div>
    </div>
    <section class="col col-xs-12"style="position: absolute; alignment:center;width:150px;top:80px;left:10px;">
        <select id="sectores" class="input-sm col-xs-12" onchange="get_mzns_por_sector(this.value);">
            <option value='0' >--- Sector ---</option>
            @foreach ($sectores as $s)
                <option value='{{$s->codigo}}' >{{$s->sector}}</option>
            @endforeach
        </select><i></i>
    </section>



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

        var layersList = [];
        var vectorSource = new ol.source.Vector({});
        var lyr_sectores_cat1;
        var lyr_manzanas2;
        var lyr_limites_distritales0;

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
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                }),
                new ol.layer.Vector({
                    source: vectorSource
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
                //features_limites_distritales0.set('description', "1");
                //features_limites_distritales0.set('description', "1");
                //features_limites_distritales0.setStyle(styleFunction);
                jsonSource_limites_distritales0.addFeatures(features_limites_distritales0);

                lyr_limites_distritales0 = new ol.layer.Vector({
                    source:jsonSource_limites_distritales0,
                    style: defaultCerroColorado,
                    title: "limites_distritales"
                });

                //lyr_limites_distritales0.set('fieldLabels', {'gid': 'no label', 'layer': 'no label', 'doctype': 'no label', });
                map.addLayer(lyr_limites_distritales0);
                layersList.push(lyr_limites_distritales0);

                //vectorSource.addFeature( featurething );
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
                    style: defaultCerroColorado,
                    title: "sectores_cat"
                });
                map.addLayer(lyr_sectores_cat1);
                layersList.push(lyr_sectores_cat1);
                lyr_sectores_cat1.set('fieldLabels', {'gid': 'no label', 'entity': 'no label', 'codigo': 'no label', 'sector': 'no label', });
            }
        });

        map.getView().fit([-7986511.592568, -1853075.694599, -7949722.367052, -1825746.555644], map.getSize());


        /*
        var thing = new ol.geom.Polygon( [[
            ol.proj.transform([-16,-22], 'EPSG:4326', 'EPSG:3857'),
            ol.proj.transform([-44,-55], 'EPSG:4326', 'EPSG:3857'),
            ol.proj.transform([-88,75], 'EPSG:4326', 'EPSG:3857')
        ]]);
        var featurething = new ol.Feature({
            name: "Thing",
            geometry: thing
        });*/


    </script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/map/map.js') }}"></script>

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

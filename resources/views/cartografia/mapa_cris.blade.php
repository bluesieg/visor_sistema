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

@section('page-js-script')
    <script type="text/javascript">

        $(document).ready(function () {
            $("#menu_cart_base").show();
            $("#li_map_cris").addClass('cr-active');

        });
</script>
    <script>
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
                color: 'red',
                width: 2,
                lineCap: 'butt',
            }),
            fill: new ol.style.Fill({
                color: 'rgba(255, 255, 0, 0.3)',
            }),
            text: new ol.style.Text({
            font: '12px Roboto',
            text: 'AAAAAAAAAAAAAAA',
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
            selectList.className = "input-sm col-xs-3";
            selectList.onchange = function(e){
                console.log(e);
                //get_mzns_por_sector(this.value);
                //alert(this.value);
            }

            var selectList_anio = document.createElement("select");
            selectList_anio.id = "anio_pred";
            selectList_anio.className = "input-sm col-xs-3";


            var sectores = {!! json_encode($sectores) !!};
            var option = document.createElement("option");
            option.value = '0';
            option.text = "- Sector -";
            selectList.appendChild(option);
           // alert(global_cod_alm[0].codigo);
            for (var i = 0; i < sectores.length; i++) {
                var option = document.createElement("option");
                option.value = sectores[i].id_sec;
                option.text = sectores[i].sector;
                selectList.appendChild(option);
            }

            var anio = {!! json_encode($anio_tra) !!};
            // alert(global_cod_alm[0].codigo);
            for (var i = 0; i < anio.length; i++) {
                var option_anio = document.createElement("option");
                option_anio.value = anio[i].anio;
                option_anio.text = anio[i].anio;
                selectList_anio.appendChild(option_anio);
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
            element.appendChild(selectList_anio);
            element.appendChild(div2);
            element.appendChild(label);

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
                        })
                    ]
                })
            ],
            target: 'map',
            
        });



        $.ajax({url: 'mapa_cris_getlimites',
            type: 'GET',
            async: false,
            success: function(r)
            {
                mapa_bd = JSON.parse(r[0].json_build_object);
                var format_limites_distritales0 = new ol.format.GeoJSON();
                var features_limites_distritales0 = format_limites_distritales0.readFeatures(mapa_bd,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_limites_distritales0 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_limites_distritales0.addFeatures(features_limites_distritales0);

                lyr_limites_distritales0 = new ol.layer.Vector({
                    source:jsonSource_limites_distritales0,
                    style: defaultCerroColorado,
                    title: "Cerro COlorado",
                   
                });
                
                map.addLayer(lyr_limites_distritales0);
                
                var extent = lyr_limites_distritales0.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                var fullscreen = new ol.control.FullScreen();
                map.addControl(fullscreen);

            }
        });

       
        
        
        

      
        

    </script>

    <script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/map/map_cris.js') }}"></script>
@stop
    


@endsection

@extends('layouts.map')

@section('content')
    <style>
        html, body {
            background-color: #ffffff;
        }
    </style>
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
    </style>
  
    <form class="smart-form">


    <div id="map" style="background: white; height: 100% !important">
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
        var lyr_sectores;
        var lyr_manzanas;
        var lyr_limites_distritales0;
        var lyr_lotes3;
        var lyr_predios4;
        var LayersList2= [lyr_sectores,lyr_manzanas,lyr_limites_distritales0,lyr_lotes3,lyr_predios4];
        
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
                get_mzns_por_sector(this.value);
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
            for (var i = 0; i < sectores.length; i++) {
                var option = document.createElement("option");
                option.value = sectores[i].id_sec;
                option.text = sectores[i].sector;
                selectList.appendChild(option);
            }

            var anio = {!! json_encode($anio_tra) !!};
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
                        }),
                        new ol.layer.Tile({
                            title: 'BLANK',
                            type: 'base',
                            visible: false
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
                    style: polygonStyleFunction,
                    title: "Limites",
                   
                });
                
                map.addLayer(lyr_limites_distritales0);
                var scale = new ol.control.ScaleLine();
                map.addControl(scale);
                var extent = lyr_limites_distritales0.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                var fullscreen = new ol.control.FullScreen();
                map.addControl(fullscreen);
            }
        });
       function polygonStyleFunction(feature, resolution) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: '#626C0E',
                    width: 2,
                    lineCap: 'butt',
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(255, 255, 0, 0.3)',
                }),
                text: new ol.style.Text({
                //font: '12px Roboto',
                text: feature.get('area_km2')+'km2'
                })
            });
        }
    </script>

    <script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/map/map_cris.js') }}"></script>
@stop
    
<div id="dlg_view_foto" style="display: none;">
    <div class="panel panel-success cr-panel-sep" style="height: 550px">
        <div class="panel-body cr-body">
            <div id="dlg_img_view_big" style="padding-top: 0px"></div>
        </div>
    </div>
</div> 
<div id="dlg_selecciona_sector" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                <h2>Selección de Sector::..</h2>
                        </header>
                    </div>
                </section>
                
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Sector &nbsp;<i class="fa fa-list"></i></span>
                        <div class="icon-addon addon-md">
                            <select id='selsec' class="form-control" onchange="callpredtab()" style="height: 32px;" >
                            <option id='op_sel_sector' value='0' >Todos</option>
                            @foreach ($sectores as $sec)
                            
                            <option value='{{$sec->id_sec}}' >{{$sec->sector}}</option>
                            @endforeach
                            </select>
                        </div>

                    </div>
                </div>
           
            </div>
          
        </div>
    </div>
</div> 
<div id="dlg_limites" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-7" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 28%">Area &nbsp;<i class="fa fa-area-chart"></i></span>
                        <div >
                            <label id="input_limit_area" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 28%">Perímetro &nbsp;<i class="fa fa-cube"></i></span>
                        <div >
                            <label id="input_limit_perimetro"   class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 28%">Población &nbsp;<i class="fa fa-users"></i></span>
                        <div>
                            <label id="input_limit_poblacion"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 28%">Creacion &nbsp;<i class="fa fa-globe"></i></span>
                        <div>
                            <label id="input_limit_creacion"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 28%">Colindantes Norte&nbsp;<i class="fa fa-map-signs"></i></span>
                        <div>
                            <label id="input_limit_norte"   class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 28%">Colindantes Sur &nbsp;<i class="fa fa-map-signs"></i></span>
                        <div>
                            <label id="input_limit_sur" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 28%">Colindantes Este &nbsp;<i class="fa fa-map-signs"></i></span>
                        <div>
                            <label id="input_limit_este" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 28%">Colindantes Oeste &nbsp;<i class="fa fa-map-signs"></i></span>
                        <div>
                            <label id="input_limit_oeste"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-xs-5" style="padding: 0px; margin-top: 0px;">                
                <div class="col-xs-12" style="padding: 0px;">
                    <img src="img/recursos/limites.jpg" width="400px"/>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" style="width: 100px">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Ley
                    </button>
                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" style="width: 100px;">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>CNA
                    </button>
                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" style="width: 100px;">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>CN
                    </button>
                </div>
           
            </div>
          
        </div>
    </div>
</div> 
<div id="dlg_agencias" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                
                
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Agencia &nbsp;<i class="fa fa-home"></i></span>
                        <div >
                            <input id="input_agencia" type="text"  class="form-control" style="height: 32px;">
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Area &nbsp;<i class="fa fa-area-chart"></i></span>
                        <div >
                            <input id="input_agencia_area" type="text"  class="form-control" style="height: 32px;">
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Direccion &nbsp;<i class="fa fa-map"></i></span>
                        <div >
                            <input id="input_agencia_dir" type="text"  class="form-control" style="height: 32px;">
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Teléfono &nbsp;<i class="fa fa-phone"></i></span>
                        <div >
                            <input id="input_agencia_fono" type="text"  class="form-control" style="height: 32px;">
                        </div>

                    </div>
                </div>
                
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Población &nbsp;<i class="fa fa-users"></i></span>
                        <div>
                            <input id="input_agencia_poblacion" type="text"  class="form-control" style="height: 32px;">
                        </div>

                    </div>
                </div>
                <div class="col-xs-12 text-align-center" style="padding: 0px; margin-top: 10px">
                    <img src="img/recursos/agencias.jpg"/>
                </div>
                
           
            </div>
          
        </div>
    </div>
</div> 
<div id="dlg_zonas_distritales" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                
                
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Zona &nbsp;<i class="fa fa-inbox"></i></span>
                        <div >
                            <input id="input_zona" type="text"  class="form-control" style="height: 32px;">
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Area &nbsp;<i class="fa fa-area-chart"></i></span>
                        <div >
                            <input id="input_zona_area" type="text"  class="form-control" style="height: 32px;">
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Cantidad Predios &nbsp;<i class="fa fa-home"></i></span>
                        <div >
                            <input id="input_zona_pred" type="text"  class="form-control" style="height: 32px;">
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Cantidad Aportes &nbsp;<i class="fa fa-shopping-cart"></i></span>
                        <div >
                            <input id="input_zona_aportes" type="text"  class="form-control" style="height: 32px;">
                        </div>

                    </div>
                </div>
                
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Población &nbsp;<i class="fa fa-users"></i></span>
                        <div>
                            <input id="input_zona_poblacion" type="text"  class="form-control" style="height: 32px;">
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Situación &nbsp;<i class="fa fa-info-circle"></i></span>
                        <div>
                            <input id="input_zona_situacion" type="text"  class="form-control" style="height: 32px;">
                        </div>
                    </div>
                </div>
           
            </div>
          
        </div>
    </div>
</div> 
    

@endsection

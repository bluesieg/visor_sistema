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
            width:900px;
            top: 5px;
            left:40px;
        }
        #legend{
        position:absolute; 
        left:10px; 
        top:100px; 
        z-index:10; 
        width:170px; 
        background-color:#FFFFFF;
        display: none;
        }
        .tooltip {
            position: relative;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 4px;
            color: white;
            padding: 4px 8px;
            opacity: 0.7;
            white-space: nowrap;
        }
        .tooltip-measure {
            opacity: 1  !important;
            font-weight: bold;
        }
        .tooltip-static {
            background-color: #ffcc33  !important;
            color: black  !important;
            border: 1px solid white  !important;
        }
        .tooltip-measure:before, .tooltip-static:before {
            border-top: 6px solid rgba(0, 0, 0, 0.5);
            border-right: 6px solid transparent;
            border-left: 6px solid transparent;
            content:"";
            position: absolute;
            bottom: -6px;
            margin-left: -7px;
            left: 50%;
        }
        .tooltip-static:before {
            border-top-color: #ffcc33;
        } 
    </style>
  
    <form >

    <input type="hidden" id="hidden_inp_habilitacion" value="0"/>
    
    <input type="hidden" id="hidden_inp_habilitacion_adm_tributaria" value="0"/>
    
    <input type="hidden" id="hidden_inp_habilitacion_gopi_perfiles" value="0"/>
    
    <input type="hidden" id="hidden_inp_habilitacion_gopi_exp_tecnico" value="0"/>
    
    <input type="hidden" id="hidden_inp_habilitacion_gopi_mantenimiento" value="0"/>
    
    <input type="hidden" id="hidden_inp_habilitacion_gopi_obra" value="0"/>
    
    <div id="map" style="background: white; height: 100% !important">
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
        </div>
        <div id="legend"></div>
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
        //var vectorSource = new ol.source.Vector({});
        var source_mesure = new ol.source.Vector();
        var vector_mesure = new ol.layer.Vector({
          source: source_mesure,
          style: new ol.style.Style({
            fill: new ol.style.Fill({
              color: 'rgba(255, 255, 255, 0.2)'
            }),
            stroke: new ol.style.Stroke({
              color: '#ffcc33',
              width: 2
            }),
            image: new ol.style.Circle({
              radius: 7,
              fill: new ol.style.Fill({
                color: '#ffcc33'
              })
            })
          })
        });
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

            var selectList = document.createElement("input");
            selectList.id = "inp_habilitacion";
            selectList.className = "input-sm col-xs-9";
            selectList.type = "text";
            selectList.style = "height:18px;display:none";
            selectList.placeholder = "Seleccione Habilitación";
            var selectList_anio = document.createElement("select");
            selectList_anio.id = "anio_pred";
            selectList_anio.className = "input-sm col-xs-2";
            
            
            var selectList_adm_tributaria = document.createElement("input");
            selectList_adm_tributaria.id = "inp_habilitacion_adm_tributaria";
            selectList_adm_tributaria.className = "input-sm col-xs-8";
            selectList_adm_tributaria.type = "text";
            selectList_adm_tributaria.style = "height:18px;display:none";
            selectList_adm_tributaria.placeholder = "ESCRIBIR NOMBRE DE UNA HABILITACION";
            
            var selectList_gopi_obra = document.createElement("input");
            selectList_gopi_obra.id = "inp_habilitacion_gopi_obra";
            selectList_gopi_obra.className = "input-sm col-xs-12";
            selectList_gopi_obra.type = "text";
            selectList_gopi_obra.style = "height:18px;display:none";
            selectList_gopi_obra.placeholder = "ESCRIBIR NOMBRE DE UNA HABILITACION";
            
            var selectList_gopi_mantenimiento = document.createElement("input");
            selectList_gopi_mantenimiento.id = "inp_habilitacion_gopi_mantenimiento";
            selectList_gopi_mantenimiento.className = "input-sm col-xs-12";
            selectList_gopi_mantenimiento.type = "text";
            selectList_gopi_mantenimiento.style = "height:18px;display:none";
            selectList_gopi_mantenimiento.placeholder = "ESCRIBIR NOMBRE DE UNA HABILITACION";
            
            var selectList_gopi_perfiles = document.createElement("input");
            selectList_gopi_perfiles.id = "inp_habilitacion_gopi_perfiles";
            selectList_gopi_perfiles.className = "input-sm col-xs-12";
            selectList_gopi_perfiles.type = "text";
            selectList_gopi_perfiles.style = "height:18px;display:none";
            selectList_gopi_perfiles.placeholder = "ESCRIBIR NOMBRE DE UNA HABILITACION";
            
            var selectList_gopi_exp_tecnico = document.createElement("input");
            selectList_gopi_exp_tecnico.id = "inp_habilitacion_gopi_exp_tecnico";
            selectList_gopi_exp_tecnico.className = "input-sm col-xs-10";
            selectList_gopi_exp_tecnico.type = "text";
            selectList_gopi_exp_tecnico.style = "height:18px;display:none";
            selectList_gopi_exp_tecnico.placeholder = "ESCRIBIR NOMBRE DE UNA HABILITACION";
            
            var boton_busqueda_gopi_exp_tecnico = document.createElement("button");
            boton_busqueda_gopi_exp_tecnico.id = "btn_busqueda_gopi_exp_tecnico";
            boton_busqueda_gopi_exp_tecnico.className = "input-sm col-xs-1";
            boton_busqueda_gopi_exp_tecnico.type = "button";
            boton_busqueda_gopi_exp_tecnico.style = "color:green;display:none";
            boton_busqueda_gopi_exp_tecnico.innerHTML = '<i class="glyphicon glyphicon-search" ></i>';
            boton_busqueda_gopi_exp_tecnico.onclick = function(e){
                cargar_habilitacion_gopi_exp_tecnico();
            }
            
            var boton_busqueda = document.createElement("button");
            boton_busqueda.id = "btn_busqueda";
            boton_busqueda.className = "input-sm col-xs-1";
            boton_busqueda.type = "button";
            boton_busqueda.style = "color:green;display:none";
            boton_busqueda.innerHTML = '<i class="glyphicon glyphicon-search" ></i>';
            boton_busqueda.onclick = function(e){
                cargar_habilitacion();
            }
            var boton_conf = document.createElement("button");
            boton_conf.id = "boton_conf";
            boton_conf.className = "input-sm col-xs-1 btn btn-labeled bg-color-blue txt-color-white";
            boton_conf.type = "button";
            boton_conf.style = "width: 30px; height: 30px;margin-right: 2px; margin-top: 1px;padding: 0px";
            boton_conf.innerHTML = '<i class="glyphicon glyphicon-cog" ></i>';
            boton_conf.title='Configuración';
            boton_conf.onclick = function(e){
                location.href="usuarios";
            }
            var boton_largo = document.createElement("button");
            boton_largo.id = "btn_largo";
            boton_largo.className = "input-sm col-xs-1 btn btn-labeled bg-color-blue txt-color-white";
            boton_largo.type = "button";
            boton_largo.style = "width: 30px; height: 30px;margin-right: 2px; margin-top: 1px;padding: 0px";
            boton_largo.innerHTML = '<i class="glyphicon glyphicon-resize-horizontal" ></i>';
            boton_largo.title='Largo';
            boton_largo.onclick = function(e){
                iniciar_largo();
            }
            var boton_print = document.createElement("button");
            boton_print.id = "btn_print";
            boton_print.className = "input-sm col-xs-1 btn btn-labeled bg-color-blue txt-color-white";
            boton_print.type = "button";
            boton_print.style = "width: 30px; height: 30px;margin-right: 2px; margin-top: 1px;padding: 0px";
            boton_print.innerHTML = '<i class="glyphicon glyphicon-print" ></i>';
            boton_print.title='Imprimir';
            boton_print.onclick = function(e){
                printMap();
            }
            var boton_coordendas = document.createElement("button");
            boton_coordendas.id = "btn_coordenadas";
            boton_coordendas.className = "input-sm col-xs-1 btn btn-labeled bg-color-blue txt-color-white";
            boton_coordendas.type = "button";
            boton_coordendas.style = "width: 30px; height: 30px;margin-right: 2px; margin-top: 1px;padding: 0px";
            boton_coordendas.innerHTML = '<i class="glyphicon glyphicon-map-marker" ></i>';
            boton_coordendas.title='Coordenadas UTM';
            boton_coordendas.onclick = function(e){
                iniciar_coordenadas();
            }
            var boton_ayuda = document.createElement("button");
            boton_ayuda.id = "btn_ayuda";
            boton_ayuda.className = "input-sm col-xs-1 btn btn-labeled bg-color-blue txt-color-white";
            boton_ayuda.type = "button";
            boton_ayuda.style = "width: 30px; height: 30px;margin-right: 2px; margin-top: 1px;padding: 0px";
            boton_ayuda.innerHTML = '<i class="glyphicon glyphicon-question-sign" ></i>';
            boton_ayuda.title='Ayuda';
            boton_ayuda.onclick = function(e){
                //iniciar_largo();
            }
            var boton_info = document.createElement("button");
            boton_info.id = "btn_info";
            boton_info.className = "input-sm col-xs-1 btn btn-labeled bg-color-blue txt-color-white";
            boton_info.type = "button";
            boton_info.style = "width: 30px; height: 30px;margin-right: 2px; margin-top: 1px;padding: 0px";
            boton_info.innerHTML = '<i class="glyphicon glyphicon-exclamation-sign" ></i>';
            boton_info.title='Información';
            boton_info.onclick = function(e){
                //iniciar_largo();
            }

//            var sectores = {!! json_encode($sectores) !!};
//            var option = document.createElement("option");
//            option.value = '0';
//            option.text = "- Sector -";
//            selectList.appendChild(option);
//            for (var i = 0; i < sectores.length; i++) {
//                var option = document.createElement("option");
//                option.value = sectores[i].id_sec;
//                option.text = sectores[i].sector;
//                selectList.appendChild(option);
//            }

            var anio = {!! json_encode($anio_tra) !!};
            for (var i = 0; i < anio.length; i++) {
                var option_anio = document.createElement("option");
                option_anio.value = anio[i].anio;
                option_anio.text = anio[i].anio;
                selectList_anio.appendChild(option_anio);
            }
           

//            var checkbox = document.createElement('input');
//            checkbox.type = "checkbox";
//            checkbox.name = "name"
//            checkbox.value = "value";
//            checkbox.id = "draw_predios";
//            document.body.appendChild(checkbox);
//            var div2 = document.createElement('div');
//            div2.className = "col-xs-1";
//
//            var label = document.createElement('label');
//            label.className = 'toggle col-xs-2';
//            label.innerHTML = '<input type="checkbox" id="draw_predios" name="checkbox-toggle" onclick="get_predios();"> <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Predios';

            var this_ = this;
            var handleRotateNorth = function(e) {
                this_.getMap().getView().setRotation(0);
            };

            button.addEventListener('click', handleRotateNorth, false);
            button.addEventListener('touchstart', handleRotateNorth, false);

            var element = document.createElement('div');
            element.className = 'ol-unselectable ol-mycontrol';
            
            element.appendChild(boton_conf);
            element.appendChild(boton_largo);
            element.appendChild(boton_print);
            element.appendChild(boton_coordendas);
            element.appendChild(boton_ayuda);
            element.appendChild(boton_info);
            element.appendChild(selectList_anio);
            element.appendChild(selectList);
            element.appendChild(selectList_adm_tributaria);
            element.appendChild(selectList_gopi_perfiles);
            element.appendChild(selectList_gopi_exp_tecnico);
            element.appendChild(boton_busqueda_gopi_exp_tecnico);
            element.appendChild(selectList_gopi_mantenimiento);
            element.appendChild(selectList_gopi_obra);
            element.appendChild(boton_busqueda);
            //element.appendChild(div2);
            //element.appendChild(label);
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
                            visible: false,
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
                            visible: true,
                            source: new ol.source.BingMaps({
                              key: 'EqfF5l6dY2LLMQa8JHlI~voA5TXsAVOQgFOP74piAbg~Aqg-emVFCImabFdRRDvdjqh1rB6Bl9l8ZkcmL7nGveSeeNkV7iSRC7XTHi1XeUVu',
                              imagerySet: 'Aerial'
                            })
                        }),
                        vector_mesure
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
                
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'get_limit_txt',
                    type: 'get',
                    success: function (data) {
                        var format = new ol.format.GeoJSON();
                        var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                        var jsonSource = new ol.source.Vector({
                            attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                        });
                        jsonSource.addFeatures(features);
                        lyr_limit_text= new ol.layer.Vector({
                            source:jsonSource,
                            style: stylez_2,
                            title: "Limite Nombres"
                        });
                        map.addLayer(lyr_limit_text);
                        var extent = lyr_limit_text.getSource().getExtent();
                        map.getView().fit(extent, map.getSize());
                        MensajeDialogLoadAjaxFinish('map');
                    },
                    error: function (data) {
                        MensajeAlerta('Predios','No se encontró.');
        //                        mostraralertas('* Error al Eliminar Contribuyente...');
                    }
                });
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'get_limit_veci',
                    type: 'get',
                    success: function (data) {
                        var format = new ol.format.GeoJSON();
                        var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                        var jsonSource = new ol.source.Vector({
                            attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                        });
                        jsonSource.addFeatures(features);
                        lyr_limit_vec= new ol.layer.Vector({
                            source:jsonSource,
                            style: stylez_3,
                            title: "Limite Vecinos"
                        });
                        map.addLayer(lyr_limit_vec);
                        var extent = lyr_limit_vec.getSource().getExtent();
                        map.getView().fit(extent, map.getSize());
                        MensajeDialogLoadAjaxFinish('map');
                    },
                    error: function (data) {
                        MensajeAlerta('Predios','No se encontró.');
        //                        mostraralertas('* Error al Eliminar Contribuyente...');
                    }
                });
            }
        });
        function stylez_2(feature, resolution){
            if(feature.get('refname')==null){
                text='';
            }
            else
            {
                text=feature.get('refname');
            }
            return new ol.style.Style({
                image: new ol.style.Circle({
                    fill: new ol.style.Fill({
                        color: 'rgba(255, 255, 255  , 0.3)',
                    }),
                    stroke: new ol.style.Stroke({
                        color: 'black',
                        width: 1,
                        lineCap: 'butt',
                    }),
                    radius: 5
                }),
                text: new ol.style.Text({
                    text: text,
                    offsetY: -10,
                    fill: new ol.style.Fill({
                        color: 'white',
                    }),
                    stroke: new ol.style.Stroke({
                        color: 'black',
                        width: 2,
                        lineCap: 'butt',
                    }),
                })
            });
        }
        
        function stylez_3(feature, resolution){

            return new ol.style.Style({
               stroke: new ol.style.Stroke({
                color: "white",
                width: 2
              })
            });
        }
  
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
        
        function estilos_adm_tributaria(feature, resolution) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: '#626C0E',
                    width: 2,
                    lineCap: 'butt',
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(0, 0, 255, 0.3)',
                }),
                text: new ol.style.Text({
                font: '12px Roboto',
                text: feature.get('nomb_hab_urba')
                })
            });
        }
    </script>

    <script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/map/map_cris.js') }}"></script>
@stop
    
<div id="dlg_view_foto" style="display: none;">
    <div class="panel panel-success cr-panel-sep" style="border:0px;">
        <div class="panel-body cr-body">
            <div id="dlg_img_view_big" style="padding-top: 0px"></div>
        </div>
    </div>
</div> 
<div id="dlg_zonificacion" style="display: none;">
    <div id="show_img_pdm_zonificaicon">
        
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
                            <select id='selsec' class="form-control" style="height: 32px;" >
                            
                            @foreach ($sectores as $sec)
                            
                            <option value='{{$sec->id_sec}}' >{{$sec->sector}}</option>
                            @endforeach
                            <option id='op_sel_sector' value='0' >Todos</option>
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
                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" style="width: 100px" onclick="verpdf('ley/ley.pdf')">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Ley
                    </button>
                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" style="width: 100px" title="LEY No 12075 (EXP. DE DIP.)" onclick="verpdf('ley/LEY_2075.pdf')">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Exp1
                    </button>
                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" style="width: 100px" title="LEY No 12075 (EXP. DEL SEN.)" onclick="verpdf('ley/LEY_12075_SEN.pdf')">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Exp2
                    </button>
                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" style="width: 100px" title="Cierre de Mesa GRA- Yanahuara y Cayma" onclick="verpdf('ley/cmcy.pdf')">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>CM1
                    </button>
                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" style="width: 100px; margin-top: 5px" title="Cierre de Mesa GRA- Yura" onclick="verpdf('ley/cmy.pdf')">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>CM2
                    </button>
                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" style="width: 100px;margin-top: 5px" title="Cierre de Mesa GRA- Sachaca" onclick="verpdf('ley/cms.pdf')">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>CM3
                    </button>
<!--                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" style="width: 100px;">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>CNA
                    </button>
                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" style="width: 100px;">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>CN
                    </button>-->
                </div>
           
            </div>
          
        </div>
    </div>
</div> 
<div id="dlg_agencias" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                
                
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Agencia &nbsp;<i class="fa fa-home"></i></span>
                        <div >
                            <label id="input_agencia"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Area &nbsp;<i class="fa fa-area-chart"></i></span>
                        <div >
                            <label id="input_agencia_area"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Direccion &nbsp;<i class="fa fa-map"></i></span>
                        <div >
                            <label id="input_agencia_dir" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Teléfono &nbsp;<i class="fa fa-phone"></i></span>
                        <div >
                            <label id="input_agencia_fono" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Población &nbsp;<i class="fa fa-users"></i></span>
                        <div>
                            <label id="input_agencia_poblacion"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <button   type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="verpdf('habilitaciones')">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Lista de Habilitaciones
                    </button>
                </div>
                <div id="div_img_agencias" class="col-xs-12 text-align-center" style="padding: 0px; margin-top: 10px">
                    
                </div>
                <input type="hidden" id="id_agencia" value="0">
           
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
                            <label id="input_zona_area"   class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Cantidad Predios &nbsp;<i class="fa fa-home"></i></span>
                        <div >
                            <label id="input_zona_pred"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Cantidad Aportes &nbsp;<i class="fa fa-shopping-cart"></i></span>
                        <div >
                            <label id="input_zona_aportes"   class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Población &nbsp;<i class="fa fa-users"></i></span>
                        <div>
                            <label id="input_zona_poblacion"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">Situación &nbsp;<i class="fa fa-info-circle"></i></span>
                        <div>
                            <label id="input_zona_situacion"   class="form-control" style="height: 32px;"></label>
                        </div>
                    </div>
                </div>
           
            </div>
          
        </div>
    </div>
</div> 
<div id="dlg_predio_lote" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                
                <div class="col-xs-9" style="padding: 0px;">
                    <div class="col-xs-12" style="padding: 0px;">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 20%">Año de consulta &nbsp;<i class="fa fa-power-off"></i></span>
                            <div >
                                <label id="anio_consulta_lote"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px;margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 20%">Codigo Catastral &nbsp;<i class="fa fa-power-off"></i></span>
                            <div >
                                <label id="input_pred_cod_cat"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 20%">Habilitación &nbsp;<i class="fa fa-map"></i></span>
                            <div >
                                <label id="input_pred_habilitacion"  class="form-control" style="height: 32px; overflow-y: scroll"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 20%">Contribuyente &nbsp;<i class="fa fa-male"></i></span>
                            <div >
                                <label id="input_pred_propietario"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 40%">Mzna Urb. &nbsp;<i class="fa fa-apple"></i></span>
                            <div >
                                <label id="input_pred_mzna_urb"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 40%">Lote Urb. &nbsp;<i class="fa fa-home"></i></span>
                            <div >
                                <label id="input_pred_lote_urb"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 20%">Partida Registral &nbsp;<i class="fa fa-file"></i></span>
                            <div >
                                <label id="input_pred_par_reg"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 40%">Area Titulo &nbsp;<i class="fa fa-area-chart"></i></span>
                            <div >
                                <label id="input_pred_are_tit"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 40%">Area Verificada &nbsp;<i class="fa fa-area-chart"></i></span>
                            <div >
                                <label id="input_pred_are_veri"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 40%">Perímetro &nbsp;<i class="fa fa-circle-o-notch"></i></span>
                            <div >
                                <label id="input_pred_perimetro_lote"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="panel panel-success cr-panel-sep" style="height: 180px;overflow-y: scroll;">
                        <div class="panel-heading bg-color-success" style="padding: 5px">.:: Foto Predio ::.</div>
                        <div class="panel-body cr-body" style="padding-top: 0px">
                            <div id="dlg_img_view" style="padding: 5px; " onclick="viewlong('')"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 100%">Linderos De Lote (ML)</span>
                        </div>
                    </div>
                    <div class="col-xs-2" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 100%">Medida en Campo</span>
                        </div>
                    </div>
                    <div class="col-xs-2" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 100%">Medida Según Título</span>
                        </div>
                    </div>
                    <div class="col-xs-2" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 100%">Colindancias en Campo</span>
                        </div>
                    </div>
                    <div class="col-xs-2" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 100%">Colindancias Según Título</span>
                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px" id="div_colindancias">
                        
                    </div>
                </div>  
            </div>
          
        </div>
    </div>
</div> 
<div id="dlg_exp_urba" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                
                    <div class="col-xs-12" style="padding: 0px;">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">Nombre &nbsp;<i class="fa fa-power-off"></i></span>
                            <div >
                                <label id="input_exur_nombre"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">Altura de Edificación &nbsp;<i class="fa fa-map"></i></span>
                            <div >
                                <label id="input_exur_altura"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">Material de Estructura Predominante &nbsp;<i class="fa fa-male"></i></span>
                            <div >
                                <label id="input_exur_mat"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">Estado de Conservación &nbsp;<i class="fa fa-male"></i></span>
                            <div >
                                <label id="input_exur_estconser"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">Estado de Construcción &nbsp;<i class="fa fa-male"></i></span>
                            <div >
                                <label id="input_exur_estconst"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">Servicio de Agua &nbsp;<i class="fa fa-male"></i></span>
                            <div >
                                <label id="input_exur_agua"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">Servicio de Luz &nbsp;<i class="fa fa-male"></i></span>
                            <div >
                                <label id="input_exur_luz"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">Servicio de Desague &nbsp;<i class="fa fa-male"></i></span>
                            <div >
                                <label id="input_exur_desague"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">Uso Principal &nbsp;<i class="fa fa-male"></i></span>
                            <div >
                                <label id="input_exur_uso_pri"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">Uso secundario &nbsp;<i class="fa fa-male"></i></span>
                            <div >
                                <label id="input_exur_uso_sec"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">Uso Terciario &nbsp;<i class="fa fa-male"></i></span>
                            <div >
                                <label id="input_exur_uso_ter"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                
            </div>
          
        </div>
    </div>
</div> 
    
<div id="dlg_hablitacion_urbana" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                <h2>Habilitación Urbana::..</h2>
                        </header>
                    </div>
                </section>
                
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 160px">Habilitación Urbana &nbsp;<i class="fa fa-list"></i></span>
                        <div class="icon-addon addon-md">
                            <label id='input_nom_haburb' class="form-control" style="min-height: 32px; height: auto;width: 100%" >
                            
                            </label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon"  style="width: 160px">Aprobado por &nbsp;<i class="fa fa-list"></i></span>
                        <div class="icon-addon addon-md">
                            <label id='input_aprobado' class="form-control" style="height: 32px; width: 100%" >
                            
                            </label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon"  style="width: 160px">Total de Lotes &nbsp;<i class="fa fa-list"></i></span>
                        <div class="icon-addon addon-md">
                            <label id='input_tot_lotes_haburb' class="form-control" style="height: 32px; width: 100%" >
                            
                            </label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon"  style="width: 160px">Area &nbsp;<i class="fa fa-list"></i></span>
                        <div class="icon-addon addon-md">
                            <label id='input_area_haburb' class="form-control" style="height: 32px; width: 100%" >
                            
                            </label>
                        </div>

                    </div>
                </div>
           
            </div>
          
        </div>
    </div>
</div> 
<div id="dlg_pdf" style="display: none;">
    <iframe id="iframe_pdf" style="width: 100%; height: 500px">
        
    </iframe>
</div> 
<div id="dlg_constancias_anios" style="display: none;">
    <div id="div_gduc_constacias" class="col-xs-12" style="padding: 0px; margin-top: 10px;">
<!--        <article class="col-xs-12" style=" padding: 0px !important">
            <table id="table_doc_constancias"></table>
            <div id="pager_table_doc_constancias"></div>
        </article>-->
    </div>
</div> 

<div id="dlg_gerencia_adm_tributaria" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información de Lotes::..</h2>
                        </header>
                    </div>
                </div> 
                <div class="row">
                   <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 30%">LOTES EXISTENTES&nbsp;<i class="fa fa-hashtag"></i></span>
                        <div >
                            <label id="dlg_geren_adm_tri_0" class="form-control" style="height: 32px;"></label>
                        </div>
                
                    </div>
                    </div>
                
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">LOTES DECLARADOS &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div>
                                <label id="dlg_geren_adm_tri_1"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">LOTES OMISOS&nbsp;<i class="fa fa-hashtag"></i></span>
                            <div>
                                <label id="dlg_geren_adm_tri_2"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                    
                </div>                
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información de Recaudación::..</h2>
                        </header>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">% DE MOROSIDAD AUTOVALÚO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_geren_adm_tri_3"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">% DE MOROSIDAD ARBITRIOS &nbsp;<i class="fa fa-p"></i></span>
                            <div>
                                <label id="dlg_geren_adm_tri_4"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">OP, RD ENVIADAS A COACTIVA &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div>
                                <label id="dlg_geren_adm_tri_5"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">OP, RD ENVIADAS A COACTIVA &nbsp;<i class="fa fa-dollar"></i></span>
                            <div>
                                <label id="dlg_geren_adm_tri_6"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                </div>
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información de recaudación general::..</h2>
                        </header>
                    </div>
                </div> 
                 <div class="row">
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">MONTO RECAUDACIÓN GENERAL &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_geren_adm_tri_7"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">% RECAUDACIÓN GENERAL &nbsp;<i class="fa fa-users"></i></span>
                            <div>
                                <label id="dlg_geren_adm_tri_8"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                </div>
                
           
            </div>
          
        </div>
    </div>
</div>

<div id="dlg_gopi_perfiles" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body">
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información de Responsable::..</h2>
                        </header>
                    </div>
                </div>
                
                <input type="hidden" id="id_gopi_perfil" value="0">
                
                <div class="row">
                   <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                        <div >
                            <label id="dlg_gopi_perfiles_dni" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                
                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">NOMBRE &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                                <label id="dlg_gopi_perfiles_nombre"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                </div>                
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información Catastral::..</h2>
                        </header>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-xs-3" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">CODIGO CATASTRAL &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_codigo_catastral"  class="form-control" style="height: 32px;"></label>
                            </div>
                
                        </div>
                    </div>

                    <div class="col-xs-9" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">HABILITACION URBANA &nbsp;<i class="fa fa-p"></i></span>
                        <div>
                                <label id="dlg_gopi_perfiles_hab_urb"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                </div>
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información del Perfil::..</h2>
                        </header>
                    </div>
                </div> 
                 <div class="row">
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">CODIGO SNIP &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_codigo_snip"  class="form-control" style="height: 32px;"></label>
                            </div>
                
                        </div>
                    </div>

                    <div class="col-xs-5" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">NOMBRE PIP &nbsp;<i class="fa fa-users"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_nombre_pip"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-3" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">MONTO PIP &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_monto_perfil"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">RESPONSABILIDAD FUNCIONAL &nbsp;<i class="fa fa-"></i></span>
                        <div>
                                <label id="dlg_gopi_perfiles_respon_funcional"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">UNIDAD FORMULADORA &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_uni_formuladora"  class="form-control" style="height: 32px;"></label>
                            </div>
                    
                </div>
                    </div>
                
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">UNIDAD EJECUTORA &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_uni_ejecutora"  class="form-control" style="height: 32px;"></label>
                            </div>
           
            </div>
                    </div>
          
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">NIVEL &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_nivel"  class="form-control" style="height: 32px;"></label>
        </div>

    </div>
</div> 

                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">NUM. BENEFICIARIOS &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_num_beneficiarios"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">CANT. ALTERNATIVAS &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_cant_alternativas"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">MONTO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_monto"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">VIABILIDAD &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_perfiles_viabilidad"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div> 
                     
                </div>
            </div>
        </div>
        <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_perfiles();">
            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
        </button>
    </div>
</div>

<div id="dlg_gopi_expedientes_tecnicos" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body">
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información de Persona::..</h2>
                        </header>
                    </div>
                </div>
                
                <input type="hidden" id="id_gopi_exp_tecnico" value="0">
                
                <div class="row">
                   <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                        <div >
                            <label id="dlg_gopi_exp_tecnico_dni" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                
                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">NOMBRE &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                                <label id="dlg_gopi_exp_tecnico_nombre"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                </div>                
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información Catastral::..</h2>
                        </header>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-xs-3" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">CODIGO CATASTRAL &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_cod_catastral"  class="form-control" style="height: 32px;"></label>
                            </div>
                
                        </div>
                    </div>

                    <div class="col-xs-9" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">HABILITACION URBANA &nbsp;<i class="fa fa-p"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_hab_urb"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                </div>
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información del Expediente Tecnico::..</h2>
                        </header>
                    </div>
                </div> 
                 <div class="row">
                     
                <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">MONTO EXP TEC &nbsp;<i class="fa fa-"></i></span>
                        <div>
                                <label id="dlg_gopi_exp_tecnico_monto_exp_tec"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">CODIGO SNIP &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_codigo_snip"  class="form-control" style="height: 32px;"></label>
                </div>
              
                        </div>
                    </div>

                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">NOMBRE PIP &nbsp;<i class="fa fa-users"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_nombre_pip"  class="form-control" style="height: 32px;"></label>
                            </div>
                    
                </div>
                    </div>
                
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">MONTO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_monto"  class="form-control" style="height: 32px;"></label>
                            </div>
                    
                        </div>
                    </div>
                    
                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">DESCRIPCION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_descripcion"  class="form-control" style="height: 32px;"></label>
                </div>
                
                        </div>
                    </div>
           
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">TIEMPO EJECUCION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_tiempo_ejec"  class="form-control" style="height: 32px;"></label>
            </div>
          
        </div>
    </div>
                     
                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">APROBACION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gopi_exp_tecnico_aprob"  class="form-control" style="height: 32px;"></label>
</div> 

                        </div>
                    </div>
                     
                </div>
            </div>
        </div>
        <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_expedientes_tecnicos();">
            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
        </button>
    </div>
</div>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px;display: none;" id="dlg_gopi_mantenimientos">
    <div class="well well-sm well-light">
        <div class="row">            
            <section class="col col-lg-12">                        
                <ul id="tabs1mantenimiento" class="nav nav-tabs bordered">
                    <li class="active">
                        <a href="#mantenimiento1" data-toggle="tab" aria-expanded="true">
                            EXPEDIENTE MANTENIMIENTO
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#mantenimiento2" data-toggle="tab" aria-expanded="false">
                           FOTOS
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>                            
                </ul>
            <div id="myTabContent1" class="tab-content padding-1"> 
                
                <div id="mantenimiento1" class="tab-pane fade active in">
                <section class="col col-lg-12">
                <div class="col-xs-12">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section style="padding-right: 0px">
                                <div class="col-xs-12">                                            
                                    <div>
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
                                            <div class="col-xs-12 cr-body">
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                    <h2>Información de Personas::..</h2>
                        </header>
                    </div>
                </div> 

                                                    <input type="hidden" id="id_gopi_mantenimiento" value="0">

                <div class="row">
                   <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div>
                                                                <label id="dlg_gopi_mantenimiento_dni_ejec" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">EJECUTOR &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_nomb_ejec"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>  

                                                        <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                        <div >
                                                                <label id="dlg_gopi_mantenimiento_dni_sup" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                    </div>
                
                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">SUPERVISOR &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_nomb_sup"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div> 

                                                        <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div >
                                                                <label id="dlg_gopi_mantenimiento_dni_res" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">RESIDENTE &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_nomb_res"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>  
                                                    </div>                
                                                    <div>
                                                        <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                                                            <header>
                                                                    <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                    <h2>Información Catastral::..</h2>
                                                            </header>
                                                        </div>
                                                    </div> 
                                                    <div class="row">
                    <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">CODIGO CATASTRAL &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_cod_cat"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div> 
                    
                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">HABILITACION URBANA &nbsp;<i class="fa fa-p"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_hab_urb"  class="form-control" style="height: 32px;"></label>
                </div>                

                                                            </div>
                                                        </div>
                                                    </div>
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                    <h2>Información del Mantenimiento::..</h2>
                        </header>
                    </div>
                </div> 
                <div class="row">

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">NOMBRE MANTENIMIENTO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_nomb_mant"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">TIPO MANTENIMIENTO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_tip_mant"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">MODALIDAD EJECUCION &nbsp;<i class="fa fa-users"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_mod_ejec"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">OBSERVACIONES &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_observ"  class="form-control" style="height: 32px;"></label>
                </div>
                
                                                            </div>
                                                        </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">INFORME TECNICO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_inf_tec"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">TIEMPO EJECUCION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_mantenimiento_tiem_ejec"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">BENEFICIARIOS &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_bene"  class="form-control" style="height: 32px;"></label>
                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">FECHA INICIO &nbsp;<i class="fa fa-"></i></span>
                <div>
                                                                    <label id="dlg_gopi_mantenimiento_fec_ini"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">FECHA TERMINO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_fec_term"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">DESCRIPCION &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_descr"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">ESTADO MANTENIMIENTO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_est_mant"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">AVANCE FISICO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_av_fis"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">AVANCE FINANCIERO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_mantenimiento_av_fin"  class="form-control" style="height: 32px;"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_mantenimientos();">
                                                <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                </section>
                
                </div>
                
                <div id="mantenimiento2" class="tab-pane fade" style="height: auto">
                <section class="col col-lg-12">
                <div class="col-xs-12">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section style="padding-right: 10px">
                                <div class="col-xs-12">
                                    <div class="col-md-12 col-lg-12 hidden-xs">
                                        <div class="panel panel-success cr-panel-sep" style="border:0px; margin-top: 10px">
                                            <div class="panel-body cr-body">
                                                <div id="dlg_gopi_mantenimiento_fotos" style="padding-top: 0px; margin-top: 15px;"></div>
                                            </div>
                                        </div>
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

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px;display: none;" id="dlg_gopi_obras">
    <div class="well well-sm well-light">
        <div class="row">            
            <section class="col col-lg-12">                        
                <ul id="tabs1obras" class="nav nav-tabs bordered">
                    <li class="active">
                        <a href="#obras1" data-toggle="tab" aria-expanded="true">
                            EXPEDIENTE MANTENIMIENTO
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#obras2" data-toggle="tab" aria-expanded="false">
                           FOTOS
                            <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                        </a>
                    </li>                            
                </ul>
            <div id="myTabContent2" class="tab-content padding-1"> 
                
                <div id="obras1" class="tab-pane fade active in">
                <section class="col col-lg-12">
                <div class="col-xs-12">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section style="padding-right: 0px">
                                <div class="col-xs-12">                                            
                                    <div>
                                        <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
                                            <div class="col-xs-12 cr-body">
                                                <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                                                    <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                    <h2>Información de Personas::..</h2>
                        </header>
                    </div>
                </div> 

                                                    <input type="hidden" id="id_gopi_obra" value="0">

                 <div class="row">
                                                       <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div>
                                                                <label id="dlg_gopi_obra_dni_ejec" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">EJECUTOR &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_nomb_ejec"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>  

                                                        <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div >
                                                                <label id="dlg_gopi_obra_dni_sup" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">SUPERVISOR &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_nomb_sup"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>  

                                                        <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                                                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                            <span class="input-group-addon" style="width: 30%">DNI&nbsp;<i class="fa fa-hashtag"></i></span>
                                                            <div >
                                                                <label id="dlg_gopi_obra_dni_res" class="form-control" style="height: 32px;"></label>
                                                            </div>

                                                        </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 30%">RESIDENTE &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_nomb_res"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>  
                                                    </div>                
                                                    <div>
                                                        <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                                                            <header>
                                                                    <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                    <h2>Información Catastral::..</h2>
                                                            </header>
                                                        </div>
                                                    </div> 
                                                    <div class="row">
                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">CODIGO CATASTRAL &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_cod_cat"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">HABILITACION URBANA &nbsp;<i class="fa fa-p"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_hab_urb"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                                                            <header>
                                                                    <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                                                    <h2>Información de la Obra::..</h2>
                                                            </header>
                                                        </div>
                                                    </div> 
                                                     <div class="row">

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">NOMBRE OBRA &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_obra_nomb_obra"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">TIPO OBRA &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                                                    <label id="dlg_gopi_obra_tip_obra"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">MODALIDAD EJECUCION &nbsp;<i class="fa fa-users"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_mod_ejec"  class="form-control" style="height: 32px;"></label>
                </div>
                
                                                            </div>
                                                        </div>
           
                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">MONTO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_monto"  class="form-control" style="height: 32px;"></label>
            </div>
          
        </div>
    </div>

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">OBSERVACIONES &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_observaciones"  class="form-control" style="height: 32px;"></label>
</div> 

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">CODIGO SNIP &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_cod_snip"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">PERFIL &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_perfil"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">EXPEDIENTE TECNICO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_exp_tec"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">TIEMPO EJECUCION &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_tiem_ejec"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">BENEFICIARIOS &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_beneficiarios"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">FECHA INICIO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_fec_ini"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">FECHA TERMINO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_fec_term"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 250px;">DESCRIPCION &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_descripcion"  class="form-control" style="height: 32px;"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         
                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">ESTADO OBRA &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_est_obra"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                         
                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">AVANCE FISICO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_av_fis"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                         
                                                        <div class="col-xs-4" style="padding: 0px; margin-top: 10px">
                                                            <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                                                                <span class="input-group-addon" style="width: 200px;">AVANCE FINANCIERO &nbsp;<i class="fa fa-"></i></span>
                                                                <div>
                                                                    <label id="dlg_gopi_obra_av_fin"  class="form-control" style="height: 32px;"></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_obras();">
                                                <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                </section>
                
                </div>
                
                <div id="obras2" class="tab-pane fade" style="height: auto">
                <section class="col col-lg-12">
                <div class="col-xs-12">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section style="padding-right: 10px">
                                <div class="col-xs-12">
                                    <div class="col-md-12 col-lg-12 hidden-xs">
                                        <div class="panel panel-success cr-panel-sep" style="border:0px; margin-top: 10px">
                                            <div class="panel-body cr-body">
                                                <div id="dlg_gopi_obra_fotos" style="padding-top: 0px; margin-top: 15px;"></div>
                                            </div>
                                        </div>
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

<div id="dlg_gsc_comisarias" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-8 col-md-8 col-lg-8" style="padding: 0px; margin-top: 0px;">
                
                <input type="hidden" id="id_gsc_comisaria" value="0">
                
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">NOMBRE COMISARIA &nbsp;<i class="fa fa-home"></i></span>
                        <div >
                            <label id="dlg_gsc_comisaria_nombre"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">UBICACION &nbsp;<i class="fa fa-area-chart"></i></span>
                        <div >
                            <label id="dlg_gsc_comisaria_ubicacion"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
               
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">NRO. EFECTIVOS &nbsp;<i class="fa fa-phone"></i></span>
                        <div >
                            <label id="dlg_gsc_comisaria_nro_efectivos" class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">NRO. VEHICULOS &nbsp;<i class="fa fa-users"></i></span>
                        <div>
                            <label id="dlg_gsc_comisaria_nro_vehiculos"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">TELEFONO COMISARIA &nbsp;<i class="fa fa-users"></i></span>
                        <div>
                            <label id="dlg_gsc_comisaria_telefono"  class="form-control" style="height: 32px;"></label>
                        </div>

                    </div>
                </div>
                 
            </div>
            
            <div class="col-xs-4 col-md-4 col-lg-4" style="padding: 0px; margin-top: 0px;">
                
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <center><img id="dlg_gsc_comisaria_foto" class="col-xs-12 text-align-center" style="max-height:250px; max-width:400px;"></center>
                </div>
                 
            </div>
        </div>
        
            <div class="col-xs-4 col-md-4 col-lg-4" style="padding: 0px; margin-top: 0px;">
                <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_comisarias();">
                    <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
                </button>
            </div>
        
            <div class="col-xs-4 col-md-4 col-lg-4" style="padding: 0px; margin-top: 0px;">
                <button  type="button" class="btn btn-labeled bg-color-greenDark txt-color-white" onclick="traer_datos_gsc_personal_comisaria($('#id_gsc_comisaria').val());">
                    <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>VER PERSONAL
                </button>
            </div>
        
            <div class="col-xs-4 col-md-4 col-lg-4" style="padding: 0px; margin-top: 0px;">
                <button  type="button" class="btn btn-labeled bg-color-greenDark txt-color-white" onclick="traer_datos_gsc_observ_comisarias($('#id_gsc_comisaria').val());">
                    <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>VER OBSERVACIONES
                </button>
            </div>
    </div>
</div>

<div id="dlg_ver_observacion_comisarias" style="display: none;">
    <div class="col-xs-12" id="gsc_observ_comisarias" style="margin-bottom: 10px; padding: 0px; background-color: white"></div>
</div>

<div id="dlg_ver_personal_comisarias" style="display: none;">
    <div class="col-xs-12" id="gsc_personal_comisarias" style="margin-bottom: 10px; padding: 0px; background-color: white"></div>
</div>

<div id="dlg_gsc_semaforos" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                
                <input type="hidden" id="id_gsc_semaforo" value="0">
                
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">UBICACION &nbsp;<i class="fa fa-home"></i></span>
                        <div >
                            <label id="dlg_gsc_semaforos_ubicacion"  class="form-control" style="height: 32px;"></label>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">CODIGO &nbsp;<i class="fa fa-area-chart"></i></span>
                        <div >
                            <label id="dlg_gsc_semaforos_codigo"  class="form-control" style="height: 32px;"></label>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-6" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">TIPO SEMAFORO &nbsp;<i class="fa fa-area-chart"></i></span>
                        <div >
                            <label id="dlg_gsc_semaforos_tip_sem"  class="form-control" style="height: 32px;"></label>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-6" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">ESTADO &nbsp;<i class="fa fa-area-chart"></i></span>
                        <div >
                            <label id="dlg_gsc_semaforos_estado"  class="form-control" style="height: 32px;"></label>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">PEATONAL &nbsp;<i class="fa fa-map"></i></span>
                        <div >
                            <label id="dlg_gsc_semaforos_peatonal" class="form-control" style="height: 32px;"></label>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-6" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">CODIGO CONTROLADOR &nbsp;<i class="fa fa-area-chart"></i></span>
                        <div >
                            <label id="dlg_gsc_semaforos_cod_controlador"  class="form-control" style="height: 32px;"></label>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-6" style="padding: 0px;  margin-top: 10px">
                    <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                        <span class="input-group-addon" style="width: 35%">CONTROLADOR &nbsp;<i class="fa fa-area-chart"></i></span>
                        <div >
                            <label id="dlg_gsc_semaforos_controlador"  class="form-control" style="height: 32px;"></label>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <center><img id="dlg_gsc_semaforos_imagen" class="col-xs-12 text-align-center" style="max-height:250px; max-width:400px;"></center>
                    
                </div>           
            </div>
        </div>
        
         <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_semaforos();">
            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
        </button>
        
    </div>
</div>

<div id="dlg_gsc_mapa_delitos" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body">
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información de Personas::..</h2>
                        </header>
                    </div>
                </div>
                
                <input type="hidden" id="id_gsc_mapa_delito" value="0">
                
                <div class="row">
                    <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">DNI &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div >
                                <label id="dlg_gsc_map_delito_dni_infractor" class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                
                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">INFRACTOR &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_nomb_infractor"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>  
                    <div class="col-xs-4" style="padding: 0px;  margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">DNI &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div >
                                <label id="dlg_gsc_map_delito_dni_encargado" class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                
                    <div class="col-xs-8" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 30%">ENCARGADO &nbsp;<i class="fa fa-hashtag"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_nomb_encargado"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                </div>                
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información del Delito::..</h2>
                        </header>
                    </div>
                </div> 
                 <div class="row">
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">UBICACION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_ubicacion"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">FECHA REGISTRO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_fec_reg"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">TIPO DELITO &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_tip_delito"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">VEHICULO &nbsp;<i class="fa fa-users"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_vehiculo"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">OBSERVACIONES &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_map_delito_observaciones"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <center><img id="dlg_gsc_map_delito_imagen" class="col-xs-12 text-align-center" style="max-height:250px; max-width:400px;"></center>
                    
                    </div>
                     
                </div>
            </div>
        </div>
        <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_mapa_delitos();">
            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
        </button>
    </div>
</div>

<div id="dlg_gsc_mapa_camaras" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 0px;padding-bottom: 0px;">
        <div class="col-xs-12 cr-body">
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
               
                <input type="hidden" id="id_gsc_camara" value="0">
                              
                <div>
                    <div class="jarviswidget jarviswidget-color-blue" style="margin-bottom: 10px; margin-top: 10px"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Información Camara::..</h2>
                        </header>
                    </div>
                </div> 
                 <div class="row">
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">
                            <span class="input-group-addon" style="width: 250px;">OBSERVACION &nbsp;<i class="fa fa-"></i></span>
                            <div>
                                <label id="dlg_gsc_camara_observacion"  class="form-control" style="height: 32px;"></label>
                            </div>

                        </div>
                    </div>
                     
                    <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                        <center><img id="dlg_gsc_camara_imagen" class="col-xs-12 text-align-center" style="max-height:250px; max-width:400px;"></center>
                    
                    </div>
                     
                </div>
            </div>
        </div>
        <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="imprimir_docs_expedientes_tecnicos();">
            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>EXPORTAR PDF
        </button>
    </div>
</div>

@include('limpieza_publica.div_barrido_calles')
@include('limpieza_publica.div_recojo_residuos')
@include('limpieza_publica.div_contenedores')
@include('limpieza_publica.div_botaderos')
@include('areas_verdes.div_areas_verdes')
@include('desarrollo_economico.div_mypes')

@endsection

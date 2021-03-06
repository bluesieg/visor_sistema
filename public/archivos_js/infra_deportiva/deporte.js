function limpiar_infra_deportiva(dialogo)
{
    $("#"+dialogo+" input[type='text']").val("");
    $("#"+dialogo+" input[type='hidden']").val(0);
    $("#"+dialogo+" textarea").val("");
    
}
function crear_dlg(dlg,ancho,titulo)
{
    $("#"+dlg).dialog({
    autoOpen: false, modal: true, width: ancho, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.: "+titulo+" :.</h4></div>",
    buttons: [
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
    }).dialog('open');
}
function nuevo_infra_deportiva(id)
{
    
    $("#foto_infra_deportiva").html("");
    limpiar_infra_deportiva("dlg_infra_deportiva");
    $("#save_button").show();
    $("#mod_button").hide();
    if(id>0)
    {
        
        $.ajax({url: 'infra_deportiva/'+id+'?grid=normal',
        type: 'GET',
        success: function(r) 
        {
            $("#dlg_edit_pertenencia_infra_deportiva").val(r[0].pertenencia);
            $("#dlg_edit_ubicacion_infra_deportiva").val(r[0].ubicacion);
            $("#dlg_edit_encargado_infra_deportiva").val(r[0].encargado);
            $("#dlg_sec").val(r[0].sector);
            $("#dlg_mzna").val(r[0].manzana);
            $("#dlg_lot").val(r[0].lote);
            $("#hidden_dlg_lot").val(id);
            carusel_infra_deportiva(id)
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);  
            MensajeDialogLoadAjaxFinish('dlg_infra_deportiva');
        }
        });
        $("#save_button").hide();
        $("#mod_button").show();
    }
    crear_dlg("dlg_infra_deportiva",1100,"Mantenimiento Infraestructura Deportiva");
}
function carusel_infra_deportiva(id)
{
 $.ajax({url: 'traefoto_lote_id/'+id,
    type: 'GET',
    success: function(r) 
    {
        texto1='';
        texto2='';
        if(r!=0)
        {
            for(i=0;i<r.length;i++)
            {
                if(i==0)
                {
                    texto1=texto1+'<li data-target="#myCarousel" data-slide-to="'+i+'" class="active"></li>';            
                    texto2=texto2+'<div class="item active"><center><img src="data:image/png;base64,'+r[i].foto+'" alt=""></center></div>';

                }
                else
                {
                    texto1=texto1+'<li data-target="#myCarousel" data-slide-to="'+i+'"></li>';            
                    texto2=texto2+'<div class="item"><center><img src="data:image/png;base64,'+r[i].foto+'" alt=""></center></div>\n\
                                  '
                }
            }
            final='<div id="myCarousel" class="carousel fade" style="margin-bottom: 20px;">\n\
                  <ol class="carousel-indicators">\n\
                  '+texto1+'\n\
                  </ol>\n\
                  <div class="carousel-inner">\n\
                    '+texto2+'\n\
                  </div>\n\
                <a class="left carousel-control" href="#myCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-left"></span> </a>\n\
                <a class="right carousel-control" href="#myCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-right"></span> </a>\n\
                </div>';
            $("#foto_infra_deportiva").html(final);
        }
        else
        {
            $("#foto_infra_deportiva").html('<center><img src="img/recursos/Home-icon.png" width="85%"/></center>');
        }
        
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_img_view');
    }
    });    
}
function save_infra_deportiva(tipo)
{
    if($("#hidden_dlg_lot").val()==""||$("#hidden_dlg_lot").val()==0)
    {
        mostraralertasconfoco("Seleccione Lote","#hidden_dlg_lot");
        return false;
    }
   if(tipo==1)
   {
       url='infra_deportiva/create';
   }
   else
   {
       url='infra_deportiva/'+$("#hidden_dlg_lot").val()+'/edit';
   }
    MensajeDialogLoadAjax('dlg_infra_deportiva', '.:: Cargando ...');
    $.ajax({url: url,
    type: 'GET',
    data:{id:$("#hidden_dlg_lot").val(),
        prop:$("#dlg_edit_pertenencia_infra_deportiva").val(),
        ubi:$("#dlg_edit_ubicacion_infra_deportiva").val(),
        encargado:$("#dlg_edit_encargado_infra_deportiva").val(),
        tipo_create:"infra_deportiva"},
    success: function(r) 
    {
        MensajeDialogLoadAjaxFinish('dlg_infra_deportiva'); 
        MensajeExito('Se Modificó con Exito','Su Registro fue modificado',5000);
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_infra_deportiva');
    }
    }); 
}
aux_mapa_lote=0;
function map_reg_lote_infra_derportiva()
{
    MensajeDialogLoadAjax('dlg_nuevo_exp', '.:: Cargando ...');
    if(aux_mapa_lote==0)
    {
        aux_mapa_lote=1;
        iniciar_mapa_infra_deportiva();
    }
    crear_dlg("dlg_mapa_reg_lote",1000,"Seleccione Lote");
}
function iniciar_mapa_infra_deportiva()
{
        autocompletar_haburb('inp_habilitacion_2');
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

            var selectList = document.createElement("input");
            selectList.id = "inp_habilitacion_2";
            selectList.className = "input-sm col-xs-12";
            selectList.type = "text";
            selectList.style = "height:18px";
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
            target: 'id_map_reg_lote',
            
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

                    $.ajax({url: 'gethab_urb_by_id/0',
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

                    }
                });
            }
        });
        
  
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
        map.removeLayer(lyr_sectores_cat1);
        map.removeLayer(lyr_lotes3);
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
                        traer_lote_by_hab(id);

                    }
                });
    }
        function traer_lote_by_hab(id)
        {
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'get_lotes_x_hab_urb',
                    type: 'GET',
                    data: {codigo: id},
                    success: function (data) {
                        //alert(data[0].json_build_object);
                        //alert(geojson_manzanas2);
                        map.removeLayer(lyr_lotes3);
                        var format_lotes3 = new ol.format.GeoJSON();
                        var features_lotes3 = format_lotes3.readFeatures(JSON.parse(data[0].json_build_object),
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                        var jsonSource_lotes3 = new ol.source.Vector({
                            attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                        });
                        //vectorSource.addFeatures(features_manzanas2);
                        jsonSource_lotes3.addFeatures(features_lotes3);
                        lyr_lotes3 = new ol.layer.Vector({
                            source:jsonSource_lotes3,
                            style: label_lotes,
                            title: "lotes"
                        });
                        map.addLayer(lyr_lotes3);
                        MensajeDialogLoadAjaxFinish('dlg_map');

                    },
                    error: function (data) {
                        MensajeAlerta('Predios','No se encontró ningún predio.');
                    }
                });
        }
        function label_lotes(feature) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'green',
            width: 1
        }),
        fill: new ol.style.Fill({
            color: 'rgba(0, 255, 0, 0.1)'
        }),
        text: new ol.style.Text({
            font: '12px Calibri,sans-serif',
            fill: new ol.style.Fill({ color: '#000' }),
            stroke: new ol.style.Stroke({
                color: '#fff', width: 2
            }),
            // get the text from the feature - `this` is ol.Feature
            // and show only under certain resolution
            text: map.getView().getZoom() > 17 ? feature.get('codi_lote') : ''
        })
        
    });
}

        map.on('singleclick', function(evt) {

            
            mostrar=0;
            var fl = map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
               
                if(layer.get('title')=='lotes'&&mostrar==0)
                {
                    mostrar=1;
                    $("#dlg_lot_foto").val(feature.get('codi_lote'));
                    $("#dlg_mzna_foto").val(feature.get('codi_mzna'));
                    $("#dlg_sec_foto").val(feature.get('sector'));
                    $("#hidden_dlg_lot_foto").val(feature.get('id_lote'));
                    viewlong_lote(feature.get('id_lote'));
                    return false;
                }
            });
    
        });
        MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
}
function viewlong_lote(id)
{
    
    $("#dlg_img_view_big").html("");
    $("#dlg_view_foto").dialog({
    autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  Foto del Predio :.</h4></div>",
    }).dialog('open');
   MensajeDialogLoadAjax('dlg_view_foto', '.:: Cargando ...');
    $.ajax({url: 'traefoto_lote_id/'+id,
    type: 'GET',
    success: function(r) 
    {
        texto1='';
        texto2='';
        $("#dlg_img_view_big").html("");
        if(r!=0)
        {
            $("#dlg_img_view").html('<center><img src="data:image/png;base64,'+r[0].foto+'" width="85%"/></center>');

            for(i=0;i<r.length;i++)
            {
                if(i==0)
                {
                    texto1=texto1+'<li data-target="#myCarousel" data-slide-to="'+i+'" class="active"></li>';            
                    texto2=texto2+'<div class="item active"><center><img src="data:image/png;base64,'+r[i].foto+'" alt=""></center></div>';

                }
                else
                {
                    texto1=texto1+'<li data-target="#myCarousel" data-slide-to="'+i+'"></li>';            
                    texto2=texto2+'<div class="item"><center><img src="data:image/png;base64,'+r[i].foto+'" alt=""></center></div>\n\
                                  '
                }
            }
            final='<div id="myCarousel" class="carousel fade" style="margin-bottom: 20px;">\n\
                  <ol class="carousel-indicators">\n\
                  '+texto1+'\n\
                  </ol>\n\
                  <div class="carousel-inner">\n\
                    '+texto2+'\n\
                  </div>\n\
                <a class="left carousel-control" href="#myCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-left"></span> </a>\n\
                <a class="right carousel-control" href="#myCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-right"></span> </a>\n\
                </div>';
            $("#dlg_img_view_big, #foto_infra_deportiva").html(final);
        }
        else
        {
            $("#dlg_img_view, #foto_infra_deportiva").html('<center><img src="img/recursos/Home-icon.png" width="85%"/></center>');
        }
        MensajeDialogLoadAjaxFinish('dlg_view_foto');
        
        
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_img_view');
    }
    }); 
}
function selec_reg_lote()
{
    $("#dlg_lot").val($("#dlg_lot_foto").val());
    $("#dlg_mzna").val($("#dlg_mzna_foto").val());
    $("#dlg_sec").val($("#dlg_sec_foto").val());
    $("#hidden_dlg_lot").val($("#hidden_dlg_lot_foto").val());
    $("#dlg_view_foto").dialog("close");
    $("#dlg_mapa_reg_lote").dialog("close");
    MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
}


/////////////mapa pantalla inicial
function crear_mapa_infra_deportiva()
{
    $.ajax({url: 'infra_deportiva/0?grid=mapa_infra_deportiva',
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

                        lyr_infra_deportiva = new ol.layer.Vector({
                            source:jsonSource,
                            style: infra_dep_style,
                            title: "Infraestructura Deportiva",

                        });

                        map.addLayer(lyr_infra_deportiva);
                        var extent = lyr_infra_deportiva.getSource().getExtent();
                        map.getView().fit(extent, map.getSize());

                        MensajeDialogLoadAjaxFinish('map');
                    
            }
        });
}
function infra_dep_style(feature, resolution) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'red',
                    width: 2
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(255, 0, 0, 0.1)'
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
function iniciar_infra_deportiva(id)
{
    $.ajax({url: 'infra_deportiva/'+id+'?grid=normal',
        type: 'GET',
        success: function(r) 
        {
            $("#dlg_edit_pertenencia_infra_deportiva").val(r[0].pertenencia);
            $("#dlg_edit_ubicacion_infra_deportiva").val(r[0].ubicacion);
            $("#dlg_edit_encargado_infra_deportiva").val(r[0].encargado);
            $("#dlg_sec_infra_deportiva").val(r[0].sector);
            $("#dlg_mzna_infra_deportiva").val(r[0].manzana);
            $("#dlg_lot_infra_deportiva").val(r[0].lote);
            carusel_infra_deportiva(id)
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);  
        }
        });
    
    
    crear_dlg("dlg_infra_deportiva",1100,"Infraestructura Deportiva");
}
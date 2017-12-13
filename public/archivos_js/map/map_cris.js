
map.on('singleclick', function(evt) {
//    map.getLayers().forEach(function(el) {
//        if(el.get('title')=='lotes')
//        { }});
            //alert(el.target.getFeatures().getLength());
            var fl = map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
                if(layer.get('title')=='lotes')
                {
//                    alert(feature.get('id_lote'));
//                    alert(layer.get('title'));
                    viewlong(feature.get('id_lote'));
                }
            });
    
});

var layerSwitcher = new ol.control.LayerSwitcher({
    tipLabel: 'Légende' // Optional label for button
});
map.addControl(layerSwitcher);



function get_mzns_por_sector(id_sec){
    if(id_sec != '0')
    {
        MensajeDialogLoadAjax('map', '.:: CARGANDO ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_centro_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
            success: function (data) {
                
                map.getView().setCenter(ol.proj.transform([parseFloat(data[0].lat),parseFloat(data[0].lon)], 'EPSG:4326', 'EPSG:3857'));
                map.getView().setZoom(16);
            },
            error: function (data) {
                MensajeAlerta('Cartografía', 'Error.');
            }
        });

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'mznas_x_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
            success: function (data) 
            {
                $('#select_manzanas').html(data);
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
            }
        });

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'geogetmznas_x_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
            success: function (data) {
                //alert(data[0].json_build_object);
                //alert(geojson_manzanas2);
                map.removeLayer(lyr_manzanas2);
                var format_manzanas2 = new ol.format.GeoJSON();
                var features_manzanas2 = format_manzanas2.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_manzanas2 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                //vectorSource.addFeatures(features_manzanas2);
                jsonSource_manzanas2.addFeatures(features_manzanas2);
                lyr_manzanas2 = new ol.layer.Vector({
                    source:jsonSource_manzanas2,
                    style: label_manzanas,
                    title: "manzanas"
                });

                map.addLayer(lyr_manzanas2);
                layersList[2] = lyr_manzanas2;
                //alert(layersList.length);
                MensajeDialogLoadAjaxFinish('map', '.:: CARGANDO ...');

            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_lotes_x_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
            success: function (data) {
                map.removeLayer(lyr_lotes3);
                var format_lotes3 = new ol.format.GeoJSON();
                var features_lotes3 = format_lotes3.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_lotes3 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_lotes3.addFeatures(features_lotes3);
                lyr_lotes3 = new ol.layer.Vector({
                    source:jsonSource_lotes3,
                    style: label_lotes,
                    title: "lotes"
                });

                map.addLayer(lyr_lotes3);
                layersList[3] = lyr_lotes3;
                //alert(layersList.length);
                MensajeDialogLoadAjaxFinish('map', '.:: CARGANDO ...');

            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
    }

    else{
        alert("Seleccione un sector");
    }

}
function label_manzanas(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'red',
            width: 2
        }),
        fill: new ol.style.Fill({
            color: 'rgba(255, 0, 0, 0.1)'
        }),
        text: new ol.style.Text({
            text: feature.get('codi_mzna')
        })
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
            text: map.getView().getZoom() > 16 ? feature.get('codi_lote') : ''
        })
         /*
        text: new ol.style.Text({
            text: feature.get('nom_lote')
        })
       text: map.getView().getZoom() > 12 ? feature.get('nom_lote') : ''*/
    });
}

function viewlong(id)
{
    $("#dlg_img_view_big").html("");
    $("#dlg_view_foto").dialog({
    autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  Foto del Predio :.</h4></div>",
    }).dialog('open');
    MensajeDialogLoadAjax('dlg_img_view_big', '.:: Cargando ...');
        $.ajax({url: 'traefoto_lote_id/'+id,
        type: 'GET',
        success: function(r) 
        {
            if(r!=0)
            {
                $("#dlg_img_view_big").html('<center><img src="data:image/png;base64,'+r+'" height="500px" width="90%"/></center>');
            }
            else
            {
                $("#dlg_img_view_big").html('<center><img src="img/recursos/Home-icon.png" height="500px" width="65%"/></center>');
            }
            MensajeDialogLoadAjaxFinish('dlg_img_view_big');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_img_view_big');
        }
        }); 
    
}
function dlg_sector(val)
{
    if(val==1)
    {
        texto='Traer Manzanas';
    }
    if(val==2)
    {
        texto='Traer Lotes';
    }
   
    $("#dlg_selecciona_sector").dialog({
    autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.: Seleccione Sector :.</h4></div>",
    buttons: [
            {
                html: '<span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>'+texto,
                "class": "btn btn-labeled bg-color-green txt-color-white",
                click: function () 
                {
                    if(val==1)
                    {
                        crearmanzana(1)
                    }
                    if(val==2)
                    {
                        crearlotes();
                    }
                  
                }
            },

            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
    }).dialog('open');
    
}

function valida_capa(check)
{
    if($("#"+check).prop('checked'))
    {
        MensajeDialogLoadAjax('map', '.:: Cargando ...');
        if(check=='chk_limite')
        {
            crearlimites();
        }
        if(check=='chk_sector')
        {
            crearsector();
        }
        if(check=='chk_mzna')
        {
            dlg_sector(1);
        }
        if(check=='chk_lote')
        {
            dlg_sector(2);
        }
        if(check=='chk_hab_urb')
        {
            crearhaburb();
        }
    }
    else
    {
        if(check=='chk_limite')
        {
            map.removeLayer(lyr_limites_distritales0);
        }
        if(check=='chk_sector')
        {
            map.removeLayer(lyr_sectores);
        }
        if(check=='chk_mzna')
        {
            map.removeLayer(lyr_manzanas);
        }
        if(check=='chk_lote')
        {
            map.removeLayer(lyr_lotes);
        }
        if(check=='chk_hab_urb')
        {
            map.removeLayer(lyr_hab_urb);
        }
    }
}
function crearlimites()
{
    MensajeDialogLoadAjax('map', '.:: CARGANDO ...');
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
                    title: "Cerro Colorado",
                   
                });
                
                map.addLayer(lyr_limites_distritales0);
                var scale = new ol.control.ScaleLine();
                map.addControl(scale);
                var extent = lyr_limites_distritales0.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                var fullscreen = new ol.control.FullScreen();
                map.addControl(fullscreen);
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
        
function crearsector()
{
    MensajeDialogLoadAjax('map', '.:: CARGANDO ...');
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
                lyr_sectores = new ol.layer.Vector({
                    source:jsonSource_sectores_cat1,
                    style: stylesector,
                    title: "Sectores Catastrales"
                });
                map.addLayer(lyr_sectores);
                //var extent = lyr_sectores.getSource().getExtent();
                //map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
                
            }
        });
}
function stylesector(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'blue',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(102, 102, 255, 0.3)',
        }),
        text: new ol.style.Text({
        //font: '12px Roboto',
        text: feature.get('sector')
        })
    });
}
function crearmanzana(val)
{
    $("#dlg_selecciona_sector").dialog('close');
    map.removeLayer(lyr_sectores);
    crearsector();
    $("#chk_sector").prop("checked", true);
    MensajeDialogLoadAjax('map', '.:: CARGANDO ...');
    $.ajax({url: 'getmznas',
            type: 'GET',
            async: false,
            data:{sector:$("#selsec").val()},
            success: function(r)
            {
                geojson_mzn_cat1 = JSON.parse(r[0].json_build_object);
                var format_sectores_cat1 = new ol.format.GeoJSON();
                var features_sectores_cat1 = format_sectores_cat1.readFeatures(geojson_mzn_cat1,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_sectores_cat1 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_sectores_cat1.addFeatures(features_sectores_cat1);
                lyr_manzanas = new ol.layer.Vector({
                    source:jsonSource_sectores_cat1,
                    style: stylemanzana,
                    title: "Manzanas Catastrales"
                });
                map.addLayer(lyr_manzanas);
                if(val==1)
                {
                    var extent = lyr_manzanas.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                }
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function stylemanzana(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'green',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(0, 153, 0, 0.3)',
        }),
        text: new ol.style.Text({
        //font: '12px Roboto',
        text: feature.get('codi_mzna')
        })
    });
}
        
function crearlotes()
{
    $("#dlg_selecciona_sector").dialog('close');
    MensajeDialogLoadAjax('map', '.:: CARGANDO ...');
     $("#chk_sector").prop("checked", true);
     $("#chk_mzna").prop("checked", true);
    map.removeLayer(lyr_sectores);
    map.removeLayer(lyr_manzanas);
    crearsector();
    crearmanzana(0);
    
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_lotes_x_sector',
            type: 'POST',
            data: {codigo: $("#selsec").val()+""},
            success: function (data) {
                var format_lotes3 = new ol.format.GeoJSON();
                var features_lotes3 = format_lotes3.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_lotes3 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_lotes3.addFeatures(features_lotes3);
                lyr_lotes = new ol.layer.Vector({
                    source:jsonSource_lotes3,
                    style: stylelotes,
                    title: "lotes"
                });

                map.addLayer(lyr_lotes);
                var extent = lyr_lotes.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map', '.:: CARGANDO ...');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}

function stylelotes(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'red',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(180, 4, 17, 0.3)',
        }),
        text: new ol.style.Text({
        //font: '12px Roboto',
        text: feature.get('codi_lote')
        })
    });
}

function crearhaburb()
{
    MensajeDialogLoadAjax('map', '.:: CARGANDO ...');
    $.ajax({url: 'gethab_urb',
            type: 'GET',
            async: false,
            data:{sector:$("#selsec").val()},
            success: function(r)
            {
                geojson_hab_urb = JSON.parse(r[0].json_build_object);
                var format_sectores_cat1 = new ol.format.GeoJSON();
                var features_sectores_cat1 = format_sectores_cat1.readFeatures(geojson_hab_urb,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_sectores_cat1 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_sectores_cat1.addFeatures(features_sectores_cat1);
                lyr_hab_urb = new ol.layer.Vector({
                    source:jsonSource_sectores_cat1,
                    style: stylehaburb,
                    title: "Habilitacion Urbana"
                });
                map.addLayer(lyr_hab_urb);
                var extent = lyr_hab_urb.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}

function stylehaburb(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#B40477',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(180, 4, 119 , 0.3)',
        }),
        text: new ol.style.Text({
        //font: '12px Roboto',
        text: feature.get('codi_hab_urba')
        })
    });
}
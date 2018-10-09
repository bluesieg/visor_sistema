mapa_lote_exp_tec=0;
function cargar_mapa_exp_tec()
{
    if(mapa_lote_exp_tec==0)
    {
        mapa_lote_exp_tec=1;
        cargar_mapa_lotes_exp_tec();
    }
    crear_dlg_mapa_exp_tec("dlg_mapa_expediente_tecnico",1250,"SELECCIONE UN LOTE");
}

function crear_dlg_mapa_exp_tec(dlg,ancho,titulo)
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

function cargar_mapa_lotes_exp_tec()
{
        autocompletar_map_haburb_perfiles('input_habilitacion_exp_tecnico');
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

            var input_habilitacion = document.createElement("input");
            input_habilitacion.id = "input_habilitacion_exp_tecnico";
            input_habilitacion.className = "input-sm col-xs-12";
            input_habilitacion.type = "text";
            input_habilitacion.style = "height:18px";
            input_habilitacion.placeholder = "ESCRIBIR EL NOMBRE DE UNA HABILITACION";

            var this_ = this;
            var handleRotateNorth = function(e) {
                this_.getMap().getView().setRotation(0);
            };

            button.addEventListener('click', handleRotateNorth, false);
            button.addEventListener('touchstart', handleRotateNorth, false);

            var element = document.createElement('div');
            element.className = 'ol-unselectable ol-mycontrol';
            element.style='width:700px !important'

            element.appendChild(input_habilitacion);

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
            target: 'id_map_reg_lote_exp_tec',
            
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
        
        function autocompletar_map_haburb_perfiles(textbox){
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
                            traer_haburb_by_id(ui.item.value);
                            return false;
                        }
                    });
                }
            });
        }

        function traer_haburb_by_id(id)
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
                    traer_lote_by_haburb(id);

                }
            });
        }
        
        function traer_lote_by_haburb(id)
        {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: 'get_lotes_x_hab_urb',
                type: 'GET',
                data: {codigo: id},
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
                    var codlote = feature.get('sector')+feature.get('codi_mzna')+feature.get('codi_lote');
                    $("#dlg_ubicacion").val(codlote);
                    $("#id_lote_exp_tecnico").val(feature.get('id_lote'));
                    
                    if($("#dlg_ubicacion").val() == '')
                    {
                        MensajeAlerta('Mensaje del Sistema' ,'No se Selecciono ningun poligono');
                        return false;
                    }else
                    { 
                        MensajeExito('Lote Seleccionado Correctamente', 'Operacion Ejecutada Correctamente.');
                        $("#dlg_mapa_expediente_tecnico").dialog('close');
                        return false;
                    } 
                }
            });
            
        });
}

function limpiar_campos()
{
    $('#dlg_dni_responsable_exp_tec').val('');
    $('#hidden_dlg_responsable_exp_tec').val('0');
    $('#dlg_ubicacion').val('');
    $('#dlg_responsable_exp_tec').val('');
    $('#id_lote_exp_tecnico').val('0');
    $('#dlg_monto_exp_tecnico').val('');
    $('#dlg_codigo_snip').val('');
    $('#dlg_nombre_pip').val('');
    $('#dlg_monto').val('');
    $('#dlg_descripcion').val('');
    $('#dlg_tiempo_ejecucion').val('');
    $('#dlg_aprobacion').val('');
}

function nuevo_exp_tecnico()
{
    limpiar_campos();
    $("#dlg_nuevo_exp_tecnico").dialog({
        autoOpen: false, modal: true, width: 1250, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO EXPEDIENTE TECNICO  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_editar_datos(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_exp_tecnico").dialog('open');
}

function fn_buscar_ubicacion(){
    ubicacion = $("#dlg_buscar_ubicacion").val();
    fn_actualizar_grilla('table_expediente_tecnico','sub_geren_estudios_proyectos/0?grid=expediente_tecnico&ubicacion='+ubicacion);
}

function guardar_editar_datos(tipo) {
    id_responsable = $('#hidden_dlg_responsable_exp_tec').val();
    id_lote = $('#id_lote_exp_tecnico').val();
    ubicacion = $('#dlg_ubicacion').val();
    codigo_snip = $('#dlg_codigo_snip').val();
    nombre_pip = $('#dlg_nombre_pip').val();
    monto_exp_tec = $('#dlg_monto_exp_tecnico').val();
    distrito = $('#distrito').val();
    provincia = $('#provincia').val();
    departamento = $('#departamento').val();
    monto = $('#dlg_monto').val();
    descripcion = $('#dlg_descripcion').val();
    tiempo_ejecucion = $('#dlg_tiempo_ejecucion').val();
    aprobacion = $('#dlg_aprobacion').val();

    if(id_responsable == "0")
    {
        mostraralertasconfoco("* El Campo RESPONSABLE es Obligatorio","#dlg_dni_responsable");
        return false;
    }
    if(monto_exp_tec == "")
    {
        mostraralertasconfoco("* El Campo MONTO EXP. TECNICO es Obligatorio","#dlg_monto_exp_tecnico");
        return false;
    }
    if(id_lote == "0")
    {
        mostraralertasconfoco("* El Campo UBICACION es Obligatorio","#dlg_ubicacion");
        return false;
    }
    if(codigo_snip == "")
    {
        mostraralertasconfoco("* El Campo CODIGO SNIP es Obligatorio","#dlg_codigo_snip");
        return false;
    }
    if(nombre_pip == "")
    {
        mostraralertasconfoco("* El Campo NOMBRE SNIP es Obligatorio","#dlg_nombre_pip");
        return false;
    }
    if(monto == "")
    {
        mostraralertasconfoco("* El Campo MONTO es Obligatorio","#dlg_monto");
        return false;
    }
    if(descripcion == "")
    {
        mostraralertasconfoco("* El Campo DESCRIPCION es Obligatorio","#dlg_descripcion");
        return false;
    }
    if(tiempo_ejecucion == "")
    {
        mostraralertasconfoco("* El Campo TIEMPO DE EJECUCION es Obligatorio","#dlg_tiempo_ejecucion");
        return false;
    }
    if(aprobacion == "")
    {
        mostraralertasconfoco("* El Campo APROBACION es Obligatorio","#dlg_aprobacion");
        return false;
    }
    
    if (tipo == 1) {

        MensajeDialogLoadAjax('dlg_nuevo_exp_tecnico', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_estudios_proyectos/create',
            type: 'GET',
            data: {
        	id_responsable :id_responsable,
                id_lote :id_lote,
                ubicacion :ubicacion,
                codigo_snip  :codigo_snip ,
                nombre_pip  :nombre_pip,
                monto_exp_tec  :monto_exp_tec,
                distrito  :distrito,
                provincia  :provincia,
                departamento  :departamento,
                monto :monto,
                descripcion :descripcion,
                tiempo_ejecucion :tiempo_ejecucion,
                aprobacion :aprobacion,
                tipo:2           
            },
            success: function(data) 
            {
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_tecnico');
                fn_actualizar_grilla('table_expediente_tecnico');
                $("#dlg_nuevo_exp_tecnico").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_expediente_tecnico');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_expediente_tecnico = $('#table_expediente_tecnico').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nuevo_exp_tecnico', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_estudios_proyectos/'+id_expediente_tecnico+'/edit',
            type: 'GET',
            data: {
        	id_responsable :id_responsable,
                id_lote :id_lote,
                ubicacion :ubicacion,
                codigo_snip  :codigo_snip ,
                nombre_pip  :nombre_pip,
                monto_exp_tec  :monto_exp_tec,
                distrito  :distrito,
                provincia  :provincia,
                departamento  :departamento,
                monto :monto,
                descripcion :descripcion,
                tiempo_ejecucion :tiempo_ejecucion,
                aprobacion :aprobacion,
                tipo:2
            },
            success: function(data) 
            {
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_tecnico');
                fn_actualizar_grilla('table_expediente_tecnico');
                $("#dlg_nuevo_exp_tecnico").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_expediente_tecnico');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function modificar_exp_tecnico()
{
    id_expediente_tecnico = $('#table_expediente_tecnico').jqGrid ('getGridParam', 'selrow');
    
    if (id_expediente_tecnico) {
        
        $("#dlg_nuevo_exp_tecnico").dialog({
            autoOpen: false, modal: true, width: 1250, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: INFORMACION DE EXPEDIENTE TECNICO :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    guardar_editar_datos(2);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_exp_tecnico").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_exp_tecnico', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_estudios_proyectos/'+id_expediente_tecnico+'?show=expediente_tecnico',
            type: 'GET',
            success: function(data)
            {
                $("#hidden_dlg_responsable_exp_tec").val(data[0].id_responsable_exp);
                $("#dlg_dni_responsable_exp_tec").val(data[0].nro_doc_persona);
                $("#dlg_responsable_exp_tec").val(data[0].persona);
                $("#dlg_monto_exp_tecnico").val(data[0].monto_exp_t);
                $("#id_lote_exp_tecnico").val(data[0].id_lote);
                $("#dlg_ubicacion").val(data[0].ubicacion);
                $("#dlg_codigo_snip").val(data[0].codigo_snip);
                $("#dlg_nombre_pip").val(data[0].nombre_pip);
                $("#distrito").val(data[0].distrito);
                $("#provincia").val(data[0].provincia);
                $("#departamento").val(data[0].departamento);
                $("#dlg_monto").val(data[0].monto);
                $("#dlg_descripcion").val(data[0].descripcion);
                $("#dlg_tiempo_ejecucion").val(data[0].tiempo_ejecucion);
                $("#dlg_aprobacion").val(data[0].aprobacion);
               
                MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_tecnico');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_tecnico');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_expediente_tecnico");
    }
}


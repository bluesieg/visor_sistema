 function limpiar_datos_vaso(){
    $("#hidden_id_vaso").val("");
    $("#inp_dni_vaso").val(""); 
    $("#hidden_inp_persona_vaso").val("");
    $("#inp_nombre_vaso").val("");
    $("#inp_fechanac_vaso").val("");
    $("#inp_direccion_vaso").val("");
    $("#hidden_id_lote_vaso").val("");
    $("#inp_cod_catastral_vaso").val(""); 
    $('#btn_modificar_vaso').hide();
    $('#btn_agregar_vaso').show();
    jQuery("#table_vaso").jqGrid('setGridParam', {url: 'programas_sociales/0?grid=table_observaciones_vaso&indice='+0 }).trigger('reloadGrid');
}
function buscar_vaso(){
    nombre = $("#dlg_buscar_vaso").val();
    fn_actualizar_grilla('table_vaso','programas_sociales/0?grid=vaso&nombre='+nombre);
}
function new_vaso()
{
    limpiar_datos_vaso();
    $("#dlg_nuevo_vaso").dialog({
        autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGISTRO DE VASO DE LECHE:.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    save_datos_vaso(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_vaso").dialog('open');
}
function edit_vaso()
{
    id_vaso = $('#table_vaso').jqGrid ('getGridParam', 'selrow');

    if (id_vaso) {
        
        $('#btn_agregar_vaso').hide();
        $('#btn_modificar_vaso').show();
        $("#dlg_nuevo_vaso").dialog({
            autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION DE VASO DE LECHE :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_vaso").dialog('open');
        


        MensajeDialogLoadAjax('dlg_nuevo_vaso', '.:: Cargando ...');

        $.ajax({url: 'programas_sociales/'+id_vaso+'?show=vaso',
            type: 'GET',
            success: function(data)
            {                         
                $("#inp_dni_vaso").val(data[0].pers_nro_doc); 
                $("#hidden_inp_persona_vaso").val(data[0].id_persona);                 
                $("#inp_nombre_vaso").val(data[0].persona);
                $("#inp_fechanac_vaso").val(data[0].pers_fnac);
                $("#inp_direccion_vaso").val(data[0].direccion);
                $("#hidden_id_lote_vaso").val(data[0].id_lote);
                $("#inp_cod_catastral_vaso").val(data[0].cod_catastral);
                         
                id_vaso = $("#hidden_id_vaso").val(data[0].id_vaso);
                if (id_vaso == null) {
                    jQuery("#table_observaciones_vaso").jqGrid('setGridParam', {url: 'programas_sociales/0?grid=table_observaciones_vaso&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_observaciones_vaso").jqGrid('setGridParam', {url: 'programas_sociales/0?grid=table_observaciones_vaso&indice='+$('#hidden_id_vaso').val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_nuevo_vaso');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_vaso');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_vaso");
    }
  
}

function save_datos_vaso(variable)
{
    id_persona=$("#hidden_inp_persona_vaso").val(); 
    direccion=$("#inp_direccion_vaso").val(); 
    id_lote=$("#hidden_id_lote_vaso").val(); 
    cod_catastral=$("#inp_cod_catastral_vaso").val(); 
    
    
    if(id_persona == "")
    {   mostraralertasconfoco("* El campo DNI es Obligatorio","#inp_dni_vaso");
        return false;
    }
    if(direccion == "")
    {   mostraralertasconfoco("* El Campo DIRECCIÓN es Obligatorio","#inp_direccion_vaso");
        return false;
    }
    if(id_lote == "")
    {   mostraralertasconfoco("* Debe seleccionar un lote ","#hidden_id_lote_vaso");
        return false;
    }
    if(cod_catastral == "")
    {   mostraralertasconfoco("* Debe seleccionar un lote","#inp_cod_catastral_vaso");
        return false;
    }
    
    
    id = $('#table_vaso').jqGrid ('getGridParam', 'selrow');
    
    if (variable == 1) {
        
        MensajeDialogLoadAjax('dlg_nuevo_vaso', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'programas_sociales/create?tipo=vaso',
            type: 'GET',
            data: {                   
                id_persona:id_persona,
                direccion:direccion,
                id_lote:id_lote,
                cod_catastral:cod_catastral,
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_vaso');
                $('#hidden_id_vaso').val(data.id_vaso);
                $('#btn_agregar_vaso').hide();
                $('#btn_modificar_vaso').show();
                fn_actualizar_grilla('table_vaso');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_vaso');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 2){
        
        observaciones = $('#dlg_observacion_vaso').val();
        if(observaciones == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion_vaso");
            return false;
        }
        MensajeDialogLoadAjax('dlg_nueva_observacion_vaso', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'programas_sociales/create?tipo=observaciones_vaso',
            type: 'GET',
            data: {
        	id_vaso : $('#hidden_id_vaso').val(),
                observaciones : $('#dlg_observacion_vaso').val()
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_vaso');
                jQuery("#table_observaciones_vaso").jqGrid('setGridParam', {url: 'programas_sociales/0?grid=table_observaciones_vaso&indice='+$('#hidden_id_vaso').val() }).trigger('reloadGrid');
                $("#dlg_nueva_observacion_vaso").dialog("close");

            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones_vaso');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 3){
        
        observacion = $('#dlg_observacion_vaso').val();
        if(observacion == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion_vaso");
            return false;
        }
        
        id_observaciones = $('#table_observaciones_vaso').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_nueva_observacion_vaso', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'programas_sociales/'+id_observaciones+'/edit?tipo=observaciones_vaso',
            type: 'GET',
            data: {
                observacion : $('#dlg_observacion_vaso').val()                
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_vaso');
                fn_actualizar_grilla('table_observaciones_vaso');
                $("#dlg_nueva_observacion_vaso").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones_vaso');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 4){
        
        id = $('#table_vaso').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_nuevo_vaso', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'programas_sociales/'+id+'/edit?tipo=vaso',
            type: 'GET',
            data: {
                id_persona: id_persona,
                id_lote:id_lote,
                direccion:direccion,
                cod_catastral:cod_catastral
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_vaso');
                fn_actualizar_grilla('table_vaso');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_vaso');
                console.log('error');
                console.log(data);
            }
        });
    }
}

///////////mapa

mapa_vaso=0;
function cargar_mapa_vaso()
{
    if(mapa_vaso==0)
    {
        mapa_vaso=1;
        cargar_mapa_lotes_vaso();
    }
    crear_dlg_mapa_vaso("dlg_mapa_vaso",1000,"SELECCIONE UN LOTE");
}

function crear_dlg_mapa_vaso(dlg,ancho,titulo)
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

function cargar_mapa_lotes_vaso()
{
        autocompletar_map_haburb_vaso('input_habilitacion_vaso');
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
            input_habilitacion.id = "input_habilitacion_vaso";
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
            target: 'id_map_reg_lote_vaso',
            
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
        
        function autocompletar_map_haburb_vaso(textbox){
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
                    //$("#id_expediente_lote").val(feature.get('id_lote'));
                    var codlote = feature.get('sector')+feature.get('codi_mzna')+feature.get('codi_lote');
                    $("#inp_cod_catastral_vaso").val(codlote);
                    $("#hidden_id_lote_vaso").val(feature.get('id_lote'));
                    
                    if($("#inp_cod_catastral_vaso").val() == '')
                    {
                        MensajeAlerta('Mensaje del Sistema' ,'No se Selecciono ningun poligono');
                        return false;
                    }else
                    { 
                        MensajeExito('Lote Seleccionado Correctamente', 'Operacion Ejecutada Correctamente.');
                        $("#dlg_mapa_vaso").dialog('close');
                        return false;
                    } 
                }
            });
            
        });
}

/////////////observaciones
function nueva_observacion_vaso()
{   
    id_vaso = $('#hidden_id_vaso').val();
    if (id_vaso != '0') 
    {
        $('#dlg_observacion_vaso').val(''),
        $("#dlg_nueva_observacion_vaso").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE OBSERVACION  :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        save_datos_vaso(2);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion_vaso").dialog('open');
    
    }
    else
    {
        mostraralertasconfoco("DEBE AGREGAR UN REGISTRO DE VASO DE LECHE","#inp_direccion");
    }
}

function modificar_observacion_vaso()
{
    id_observaciones = $('#table_observaciones_vaso').jqGrid ('getGridParam', 'selrow');
    
    if (id_observaciones) {
        
        $("#dlg_nueva_observacion_vaso").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION OBSERVACION :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    save_datos_vaso(3);
                }
            },{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion_vaso").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_observacion_vaso', '.:: Cargando ...');

        $.ajax({url: 'programas_sociales/'+id_observaciones+'?show=observaciones_vaso',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_observacion_vaso").val(data[0].observaciones);                
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_vaso');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_vaso');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones_vaso");
    }
}

function eliminar_observacion_vaso()
{
    id_observaciones = $('#table_observaciones_vaso').jqGrid ('getGridParam', 'selrow');
    
    if (id_observaciones) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'programas_sociales/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_observaciones: id_observaciones, tipo: 4},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones_vaso');
                            MensajeExito('Eliminar Observacion', id_observaciones + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Observacion', id_observaciones + ' - No se pudo Eliminar.');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Eliminar Observacion','Operacion Cancelada.');
                }

            }
        });
        
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones_vaso");
    }   
}

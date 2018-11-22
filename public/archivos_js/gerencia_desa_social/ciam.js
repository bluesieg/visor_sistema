 function limpiar_datos_ciam(){
    $("#hidden_id_ciam").val("");
    $("#inp_dni_ciam").val(""); 
    $("#hidden_inp_persona_ciam").val("");
    $("#inp_nombre_ciam").val("");
    $("#inp_fechanac_ciam").val("");
    $("#inp_direccion_ciam").val("");
    $("#hidden_id_lote_ciam").val("");
    $("#inp_cod_catastral_ciam").val("");
    $("#sel_local_ciam").val("");       
    $('#btn_modificar_ciam').hide();
    $('#btn_agregar_ciam').show();
    jQuery("#table_ciam").jqGrid('setGridParam', {url: 'mujer_desarrollo_humano/0?grid=table_observaciones_ciam&indice='+0 }).trigger('reloadGrid');
}
function buscar_ciam(){
    nombre = $("#dlg_buscar_ciam").val();
    fn_actualizar_grilla('table_ciam','mujer_desarrollo_humano/0?grid=ciam&nombre='+nombre);
}
function new_ciam()
{
    limpiar_datos_ciam();
    $("#dlg_nuevo_ciam").dialog({
        autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGISTRO DE CIAM:.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    save_datos_ciam(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_ciam").dialog('open');
}
function edit_ciam()
{
    id_ciam = $('#table_ciam').jqGrid ('getGridParam', 'selrow');

    if (id_ciam) {
        
        $('#btn_agregar_ciam').hide();
        $('#btn_modificar_ciam').show();
        $("#dlg_nuevo_ciam").dialog({
            autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION DE CIAM :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_ciam").dialog('open');
        


        MensajeDialogLoadAjax('dlg_nuevo_ciam', '.:: Cargando ...');

        $.ajax({url: 'mujer_desarrollo_humano/'+id_ciam+'?show=ciam',
            type: 'GET',
            success: function(data)
            {                         
                $("#inp_dni_ciam").val(data[0].pers_nro_doc); 
                $("#hidden_inp_persona_ciam").val(data[0].id_persona);                 
                $("#inp_nombre_ciam").val(data[0].persona);
                $("#inp_fechanac_ciam").val(data[0].pers_fnac);
                $("#inp_direccion_ciam").val(data[0].direccion);
                $("#hidden_id_lote_ciam").val(data[0].id_lote);
                $("#inp_cod_catastral_ciam").val(data[0].cod_catastral);
                $("#sel_local_ciam").val(data[0].id_local);
                         
                
      
                id_ciam = $("#hidden_id_ciam").val(data[0].id_ciam);
                if (id_ciam == null) {
                    jQuery("#table_observaciones_ciam").jqGrid('setGridParam', {url: 'mujer_desarrollo_humano/0?grid=table_observaciones_ciam&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_observaciones_ciam").jqGrid('setGridParam', {url: 'mujer_desarrollo_humano/0?grid=table_observaciones_ciam&indice='+$('#hidden_id_ciam').val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_nuevo_ciam');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_ciam');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_ciam");
    }
  
}

function save_datos_ciam(variable)
{
    id_persona=$("#hidden_inp_persona_ciam").val(); 
    direccion=$("#inp_direccion_ciam").val(); 
    id_lote=$("#hidden_id_lote_ciam").val(); 
    cod_catastral=$("#inp_cod_catastral_ciam").val(); 
    id_local=$("#sel_local_ciam").val();     
    
    
    if(id_persona == "")
    {   mostraralertasconfoco("* El campo DNI es Obligatorio","#inp_dni_ciam");
        return false;
    }
    if(direccion == "")
    {   mostraralertasconfoco("* El Campo DIRECCIÓN es Obligatorio","#inp_direccion_ciam");
        return false;
    }
    if(id_lote == "")
    {   mostraralertasconfoco("* Debe seleccionar un lote ","#hidden_id_lote_ciam");
        return false;
    }
    if(cod_catastral == "")
    {   mostraralertasconfoco("* Debe seleccionar un lote","#inp_cod_catastral_ciam");
        return false;
    }
    if(id_local == "")
    {   mostraralertasconfoco("* Debe seleccionar un Local","#sel_local_ciam");
        return false;
    }
    
    id = $('#table_ciam').jqGrid ('getGridParam', 'selrow');
    
    if (variable == 1) {
        
        MensajeDialogLoadAjax('dlg_nuevo_ciam', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'mujer_desarrollo_humano/create?tipo=ciam',
            type: 'GET',
            data: {                   
                id_persona:id_persona,
                direccion:direccion,
                id_lote:id_lote,
                cod_catastral:cod_catastral,
                id_local:id_local                
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_ciam');
                $('#hidden_id_ciam').val(data.id_ciam);
                $('#btn_agregar_ciam').hide();
                $('#btn_modificar_ciam').show();
                fn_actualizar_grilla('table_ciam');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_ciam');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 2){
        
        observaciones = $('#dlg_observacion_ciam').val();
        if(observaciones == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion_ciam");
            return false;
        }
        MensajeDialogLoadAjax('dlg_nueva_observacion_ciam', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'mujer_desarrollo_humano/create?tipo=observaciones_ciam',
            type: 'GET',
            data: {
        	id_ciam : $('#hidden_id_ciam').val(),
                observaciones : $('#dlg_observacion_ciam').val()
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_ciam');
                jQuery("#table_observaciones_ciam").jqGrid('setGridParam', {url: 'mujer_desarrollo_humano/0?grid=table_observaciones_ciam&indice='+$('#hidden_id_ciam').val() }).trigger('reloadGrid');
                $("#dlg_nueva_observacion_ciam").dialog("close");

            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones_ciam');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 3){
        
        observacion = $('#dlg_observacion_ciam').val();
        if(observacion == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion_ciam");
            return false;
        }
        
        id_observaciones = $('#table_observaciones_ciam').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_nueva_observacion_ciam', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'mujer_desarrollo_humano/'+id_observaciones+'/edit?tipo=observaciones_ciam',
            type: 'GET',
            data: {
                observacion : $('#dlg_observacion_ciam').val()                
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_ciam');
                fn_actualizar_grilla('table_observaciones_ciam');
                $("#dlg_nueva_observacion_ciam").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones_ciam');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 4){
        
        id = $('#table_ciam').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_nuevo_ciam', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'mujer_desarrollo_humano/'+id+'/edit?tipo=ciam',
            type: 'GET',
            data: {
                id_persona: id_persona,
                id_lote:id_lote,
                direccion:direccion,
                cod_catastral:cod_catastral,
                id_local:id_local                 
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_ciam');
                fn_actualizar_grilla('table_ciam');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_ciam');
                console.log('error');
                console.log(data);
            }
        });
    }
}

///////////mapa

mapa_ciam=0;
function cargar_mapa_ciam()
{
    if(mapa_ciam==0)
    {
        mapa_ciam=1;
        cargar_mapa_lotes_ciam();
    }
    crear_dlg_mapa_ciam("dlg_mapa_ciam",1000,"SELECCIONE UN LOTE");
}

function crear_dlg_mapa_ciam(dlg,ancho,titulo)
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

function cargar_mapa_lotes_ciam()
{
        autocompletar_map_haburb_ciam('input_habilitacion_ciam');
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
            input_habilitacion.id = "input_habilitacion_ciam";
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
            target: 'id_map_reg_lote_ciam',
            
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
        
        function autocompletar_map_haburb_ciam(textbox){
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
                    $("#inp_cod_catastral_ciam").val(codlote);
                    $("#hidden_id_lote_ciam").val(feature.get('id_lote'));
                    
                    if($("#inp_cod_catastral_ciam").val() == '')
                    {
                        MensajeAlerta('Mensaje del Sistema' ,'No se Selecciono ningun poligono');
                        return false;
                    }else
                    { 
                        MensajeExito('Lote Seleccionado Correctamente', 'Operacion Ejecutada Correctamente.');
                        $("#dlg_mapa_ciam").dialog('close');
                        return false;
                    } 
                }
            });
            
        });
}

/////////////observaciones
function nueva_observacion_ciam()
{   
    id_ciam = $('#hidden_id_ciam').val();
    if (id_ciam != '0') 
    {
        $('#dlg_observacion_ciam').val(''),
        $("#dlg_nueva_observacion_ciam").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE OBSERVACION  :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        save_datos_ciam(2);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion_ciam").dialog('open');
    
    }
    else
    {
        mostraralertasconfoco("DEBES AGREGAR UN REGISTRO CIAM","#inp_direccion");
    }
}

function modificar_observacion_ciam()
{
    id_observaciones = $('#table_observaciones_ciam').jqGrid ('getGridParam', 'selrow');
    
    if (id_observaciones) {
        
        $("#dlg_nueva_observacion_ciam").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION OBSERVACION :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    save_datos_ciam(3);
                }
            },{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion_ciam").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_observacion_ciam', '.:: Cargando ...');

        $.ajax({url: 'mujer_desarrollo_humano/'+id_observaciones+'?show=observaciones_ciam',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_observacion_ciam").val(data[0].observaciones);                
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_ciam');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_ciam');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones_ciam");
    }
}

function eliminar_observacion_ciam()
{
    id_observaciones = $('#table_observaciones_ciam').jqGrid ('getGridParam', 'selrow');
    
    if (id_observaciones) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'mujer_desarrollo_humano/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_observaciones: id_observaciones, tipo: 1},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones_ciam');
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
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones_ciam");
    }   
}

//MAPA CIAM

function valida_capa_desarrollo_social(check)
{
    if($("#"+check).prop('checked'))
    {
        MensajeDialogLoadAjax('map', '.:: Cargando ...');
        if(check=='chk_mapa_ciam')
        {
            crear_mapa_ciam();
        }
    }
    else
    {
        if(check=='chk_mapa_ciam')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_ciam").hide();
            $("#anio_pred").show();
        }
    }
}

function crear_mapa_ciam()
{
    var aux_haburb_ciam=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_ciam").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_ciam==0)
    {
        aux_haburb_ciam=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}

var lyr_gerencia_desarrollo_social;
function cargar_habilitacion_ciam()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=ciam&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('EXPEDIENTES CIAM','NO SE ENCONTRO EXPEDIENTES TECNICOS EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_ciam = JSON.parse(data[0].json_build_object);
                    var format_gds_ciam = new ol.format.GeoJSON();
                    var features_gds_ciam = format_gds_ciam.readFeatures(geojson_gds_ciam,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_ciam = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_ciam.addFeatures(features_gds_ciam);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_ciam,
                        style: EstilosCiam,
                        title: "gds_ciam"
                    });
                    map.addLayer(lyr_gerencia_desarrollo_social);
                    var extent = lyr_gerencia_desarrollo_social.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                }
                    MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
            }
        });
}

function EstilosCiam(feature, resolution)
{
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#C1BF28',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(169, 50, 38, 0.5)'
        }),
        text: new ol.style.Text({
            font: '12px Roboto',
            text: feature.get('direccion')
        })
    });
}
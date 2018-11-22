 function limpiar_datos_ccultural(){
    $("#inp_nombre_ccultural").val("");
    $("#inp_direccion_ccultural").val(""); 
    $("#sel_tipo_ccultural").val("");
    $("#inp_dni_propietario_ccultural").val("");
    $("#hidden_inp_propietario_ccultural").val("");
    $("#hidden_inp_propietario_ccultural").val("");
    $("#inp_propietario_ccultural").val("");
    $("#hidden_id_lote_ccultural").val("");
    $("#inp_cod_catastral_ccultural").val("");
    $('#btn_modificar_ccultural').hide();
    $('#btn_agregar_ccultural').show();
    $('#hidden_id_ccultural').val(0);
    jQuery("#table_ccultural").jqGrid('setGridParam', {url: 'educacion_cultura_deporte/0?grid=table_observaciones_2&indice='+0 }).trigger('reloadGrid');
}
function buscar_ccultural(){
    nombre = $("#dlg_buscar_ccultural").val();
    fn_actualizar_grilla('table_ccultural','educacion_cultura_deporte/0?grid=ccultural&nombre='+nombre);
}
function new_ccultural()
{
    limpiar_datos_ccultural();
    $("#dlg_nuevo_ccultural").dialog({
        autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO CENTRO CULTURAL :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }],
    });
    $("#dlg_nuevo_ccultural").dialog('open');
   
}
function edit_ccultural()
{
    id_ccultural = $('#table_ccultural').jqGrid ('getGridParam', 'selrow');
    if (id_ccultural) {        
        $('#btn_agregar_ccultural').hide();
        $('#btn_modificar_ccultural').show();
        $("#dlg_nuevo_ccultural").dialog({
            autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION DE CENTRO CULTURAL :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_ccultural").dialog('open');
        


        MensajeDialogLoadAjax('dlg_nuevo_ccultural', '.:: Cargando ...');

        $.ajax({url: 'educacion_cultura_deporte/'+id_ccultural+'?show=cculturales',
            type: 'GET',
            success: function(data)
            {                         
                $("#inp_direccion_ccultural").val(data[0].direccion); 
                $("#inp_nombre_ccultural").val(data[0].nombre);               
                $("#sel_tipo_ccultural").val(data[0].id_tipo);
                $("#hidden_inp_propietario_ccultural").val(data[0].id_persona);
                $("#hidden_id_lote_ccultural").val(data[0].id_lote);
                $("#inp_cod_catastral_ccultural").val(data[0].cod_catastral);                           
      
                id_ccultural = $("#hidden_id_ccultural").val(data[0].id_ccultural);
                if (id_ccultural == null) {
                    jQuery("#table_observaciones_2").jqGrid('setGridParam', {url: 'educacion_cultura_deporte/0?grid=table_observaciones_2&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_observaciones_2").jqGrid('setGridParam', {url: 'educacion_cultura_deporte/0?grid=table_observaciones_2&indice='+$('#hidden_id_ccultural').val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_nuevo_ccultural');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_ccultural');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones_2");
    }
}

function save_datos_ccultural(variable)
{
    direccion = $("#inp_direccion_ccultural").val(); 
    nombre = $("#inp_nombre_ccultural").val();     
    id_tipo = $("#sel_tipo_ccultural").val(); 
    id_persona = $("#hidden_inp_propietario_ccultural").val(); 
    id_lote = $("#hidden_id_lote_ccultural").val(); 
    cod_catastral = $("#inp_cod_catastral_ccultural").val(); 
    if(direccion == "")
    {   mostraralertasconfoco("* El Campo Dirección es Obligatorio","#inp_direccion_ccultural");
        return false;
    }
    if(nombre == "")
    {   mostraralertasconfoco("* El Campo Nombre es Obligatorio","#inp_nombre_ccultural");
        return false;
    }   
    if(id_persona == "")
    {   mostraralertasconfoco("* Debe ingresar el DNI de propietario","#hidden_inp_propietario_ccultural");
        return false;
    }
    if(id_tipo == "")
    {
        mostraralertasconfoco("* El Campo tipo es Obligatorio","#sel_tipo_ccultural");
        return false;
    }
    if(cod_catastral == "")
    {   mostraralertasconfoco("* El campo Código catastral es Obligatorio","#inp_cod_catastral_ccultural");
        return false;
    }
    if(id_lote == "")
    {   mostraralertasconfoco("* Debe seleccionar el Lote","#hidden_id_lote_ccultural");
        return false;
    }
    id = $('#table_ccultural').jqGrid ('getGridParam', 'selrow');
    
    if (variable == 1) {
        
        MensajeDialogLoadAjax('dlg_nuevo_ccultural', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'educacion_cultura_deporte/create?tipo=ccultural',
            type: 'GET',
            data: {
                direccion: direccion,
                nombre:nombre,                
                id_tipo:id_tipo,
                id_persona:id_persona,
                id_lote:id_lote,
                cod_catastral:cod_catastral
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_ccultural');
                $('#hidden_id_ccultural').val(data.id_ccultural);
                $('#btn_agregar_ccultural').hide();
                $('#btn_modificar_ccultural').show();
                fn_actualizar_grilla('table_ccultural');
                //$("#dlg_new_exp_asesoria").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_ccultural');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 2){
        
        observaciones = $('#dlg_observacion_2').val();
        if(observaciones == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion_2");
            return false;
        }
        MensajeDialogLoadAjax('dlg_nueva_observacion_2', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'educacion_cultura_deporte/create?tipo=2',
            type: 'GET',
            data: {
        	id_ccultural : $('#hidden_id_ccultural').val(),
                observaciones : $('#dlg_observacion_2').val()
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_2');
                jQuery("#table_observaciones_2").jqGrid('setGridParam', {url: 'educacion_cultura_deporte/0?grid=table_observaciones_2&indice='+$('#hidden_id_ccultural').val() }).trigger('reloadGrid');
                $("#dlg_nueva_observacion_2").dialog("close");

            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones_2');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 3){
        
        observacion = $('#dlg_observacion_2').val();
        if(observacion == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion_2");
            return false;
        }
        
        id_observaciones = $('#table_observaciones_2').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_nueva_observacion_2', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'educacion_cultura_deporte/'+id_observaciones+'/edit?tipo=observaciones_2',
            type: 'GET',
            data: {
                observacion : $('#dlg_observacion_2').val()                
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_2');
                fn_actualizar_grilla('table_observaciones_2');
                $("#dlg_nueva_observacion_2").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones_2');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 4){
        
        id = $('#table_ccultural').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_nuevo_ccultural', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'educacion_cultura_deporte/'+id+'/edit?tipo=cculturales',
            type: 'GET',
            data: {
                direccion: direccion,
                nombre:nombre,                
                id_tipo:id_tipo,
                id_persona:id_persona,
                id_lote:id_lote,
                cod_catastral:cod_catastral
                
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_ccultural');
                fn_actualizar_grilla('table_ccultural');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_ccultural');
                console.log('error');
                console.log(data);
            }
        });
    }
}



///////////mapa

mapa_ccultural=0;
function cargar_mapa_ccultural()
{
    if(mapa_ccultural==0)
    {
        mapa_ccultural=1;
        cargar_mapa_lotes_ccultural();
    }
    crear_dlg_mapa_ccultural("dlg_mapa_ccultural",1000,"SELECCIONE UN LOTE");
}

function crear_dlg_mapa_ccultural(dlg,ancho,titulo)
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

function cargar_mapa_lotes_ccultural()
{
        autocompletar_map_haburb_ccultural('input_habilitacion_ccultural');
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
            input_habilitacion.id = "input_habilitacion_ccultural";
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
            target: 'id_map_reg_lote_ccultural',
            
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
        
        function autocompletar_map_haburb_ccultural(textbox){
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
                    $("#inp_cod_catastral_ccultural").val(codlote);
                    $("#hidden_id_lote_ccultural").val(feature.get('id_lote'));
                    
                    if($("#inp_cod_catastral_ccultural").val() == '')
                    {
                        MensajeAlerta('Mensaje del Sistema' ,'No se Selecciono ningun poligono');
                        return false;
                    }else
                    { 
                        MensajeExito('Lote Seleccionado Correctamente', 'Operacion Ejecutada Correctamente.');
                        $("#dlg_mapa_ccultural").dialog('close');
                        return false;
                    } 
                }
            });
            
        });
}

/////////////////////OBSERVACIONES
function nueva_observacion_2()
{   
    id_ccultural = $('#hidden_id_ccultural').val();
    if (id_ccultural != '0') 
    {
        $('#dlg_observacion_2').val(''),
        $("#dlg_nueva_observacion_2").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE OBSERVACION  :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        save_datos_ccultural(2);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion_2").dialog('open');
    
    }
    else
    {
        mostraralertasconfoco("DEBES AGREGAR UN CENTRO CULTURAL","#inp_direccion");
    }
}
function modificar_observacion_2()
{
    id_observaciones = $('#table_observaciones_2').jqGrid ('getGridParam', 'selrow');
    
    if (id_observaciones) {
        
        $("#dlg_nueva_observacion_2").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION OBSERVACION :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    save_datos_ccultural(3);
                }
            },{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion_2").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_observacion_2', '.:: Cargando ...');

        $.ajax({url: 'educacion_cultura_deporte/'+id_observaciones+'?show=observaciones_2',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_observacion_2").val(data[0].observaciones);
                
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_2');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_2');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones_2");
    }
}
function eliminar_observacion_2()
{
    id_observaciones = $('#table_observaciones_2').jqGrid ('getGridParam', 'selrow');
    
    if (id_observaciones) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'educacion_cultura_deporte/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_observaciones: id_observaciones, tipo: 2},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones_2');
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
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones_2");
    }   
}
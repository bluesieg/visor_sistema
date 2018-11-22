 function limpiar_datos_colegio(){
    $("#inp_dni").val("");
    $("#inp_direccion").val(""); 
    $("#inp_nombre").val("");
    $("#inp_nro_colegio").val("");
    $("#inp_nro_alumnos").val("");
    $("#sel_tipo_colegio").val("");
    $("#hidden_inp_propietario").val("");
    $("#inp_dni_propietario").val("");
    $("#inp_propietario").val("");
    $("#hidden_id_lote_colegio").val("");    
    $("#inp_cod_catastral_colegio").val("");
    $('#btn_modificar_colegio').hide();
    $('#btn_agregar_colegio').show();
    $('#hidden_id_colegio').val(0);
    jQuery("#table_colegios").jqGrid('setGridParam', {url: 'educacion_cultura_deporte/0?grid=table_observaciones_1&indice='+0 }).trigger('reloadGrid');
}
function buscar_colegio(){
    nombre = $("#dlg_buscar_colegio").val();
    fn_actualizar_grilla('table_colegios','educacion_cultura_deporte/0?grid=colegios&nombre='+nombre);
}
function new_colegio()
{
    limpiar_datos_colegio();
    $("#dlg_nuevo_colegio").dialog({
        autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO COLEGIO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }],
    });
    $("#dlg_nuevo_colegio").dialog('open');
   
}

function edit_colegio()
{
    id_colegio = $('#table_colegios').jqGrid ('getGridParam', 'selrow');

    if (id_colegio) {
        
        $('#btn_agregar_colegio').hide();
        $('#btn_modificar_colegio').show();
        $("#dlg_nuevo_colegio").dialog({
            autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION DE COLEGIO :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_colegio").dialog('open');
        


        MensajeDialogLoadAjax('dlg_nuevo_colegio', '.:: Cargando ...');

        $.ajax({url: 'educacion_cultura_deporte/'+id_colegio+'?show=colegios',
            type: 'GET',
            success: function(data)
            {                         
                $("#inp_direccion").val(data[0].direccion); 
                $("#inp_nombre").val(data[0].cen_edu_l);
                $("#inp_nro_colegio").val(data[0].numero);
                $("#inp_nro_alumnos").val(data[0].nro_alumnos);
                $("#sel_tipo_colegio").val(data[0].id_tipo);
                $("#hidden_inp_propietario").val(data[0].id_persona);
                $("#hidden_id_lote_colegio").val(data[0].id_lote);
                $("#inp_cod_catastral_colegio").val(data[0].cod_catastral);
                
      
                id_colegio = $("#hidden_id_colegio").val(data[0].id);
                if (id_colegio == null) {
                    jQuery("#table_observaciones_1").jqGrid('setGridParam', {url: 'educacion_cultura_deporte/0?grid=table_observaciones_1&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_observaciones_1").jqGrid('setGridParam', {url: 'educacion_cultura_deporte/0?grid=table_observaciones_1&indice='+$('#hidden_id_colegio').val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_nuevo_colegio');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_colegio');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_colegios");
    }
  
}

function save_datos_colegio(variable)
{
    direccion = $("#inp_direccion").val(); 
    cen_edu_l = $("#inp_nombre").val();
    numero = $("#inp_nro_colegio").val();
    nro_alumnos = $("#inp_nro_alumnos").val();
    id_tipo = $("#sel_tipo_colegio").val();
    id_persona = $("#hidden_inp_propietario").val();
    id_lote= $("#hidden_id_lote_colegio").val();
    cod_catastral  = $("#inp_cod_catastral_colegio").val();
    
    
    if(direccion == "")
    {   mostraralertasconfoco("* El Campo Dirección es Obligatorio","#inp_direccion");
        return false;
    }
    if(cen_edu_l == "")
    {   mostraralertasconfoco("* El Campo Nombre es Obligatorio","#inp_nombre");
        return false;
    }
    if(numero == "")
    {   mostraralertasconfoco("* El Campo Número colegio es Obligatorio","#inp_nro_colegio");
        return false;
    }
    if(nro_alumnos == "")
    {   mostraralertasconfoco("* El Campo Número alumnos es Obligatorio","#inp_nro_alumnos");
        return false;
    }
    if(id_persona == "")
    {   mostraralertasconfoco("* Debe ingresar el DNI de propietario","#hidden_inp_propietario");
        return false;
    }
    if(id_tipo == "")
    {
        mostraralertasconfoco("* El Campo tipo es Obligatorio","#sel_tipo_colegio");
        return false;
    }
    if(cod_catastral == "")
    {   mostraralertasconfoco("* El campo Código catastral es Obligatorio","#inp_cod_catastral_colegio");
        return false;
    }
    if(id_lote == "")
    {   mostraralertasconfoco("* Debe seleccionar el Lote","#hidden_id_lote_colegio");
        return false;
    }
    id = $('#table_colegios').jqGrid ('getGridParam', 'selrow');
    
    if (variable == 1) {
        
        MensajeDialogLoadAjax('dlg_nuevo_colegio', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'educacion_cultura_deporte/create?tipo=colegios',
            type: 'GET',
            data: {
                direccion: direccion,
                cen_edu_l:cen_edu_l,
                numero:numero,
                nro_alumnos:nro_alumnos,
                id_tipo:id_tipo,
                id_persona:id_persona,
                id_lote:id_lote,
                cod_catastral:cod_catastral
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_colegio');
                $('#hidden_id_colegio').val(data.id);
                $('#btn_agregar_colegio').hide();
                $('#btn_modificar_colegio').show();
                fn_actualizar_grilla('table_colegios');
                //$("#dlg_new_exp_asesoria").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_colegios');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 2){
        
        observaciones = $('#dlg_observacion_1').val();
        if(observaciones == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion_1");
            return false;
        }
        MensajeDialogLoadAjax('dlg_nueva_observacion_1', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'educacion_cultura_deporte/create?tipo=1',
            type: 'GET',
            data: {
        	id_colegios : $('#hidden_id_colegio').val(),
                observaciones : $('#dlg_observacion_1').val()
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_1');
                jQuery("#table_observaciones_1").jqGrid('setGridParam', {url: 'educacion_cultura_deporte/0?grid=table_observaciones_1&indice='+$('#hidden_id_colegio').val() }).trigger('reloadGrid');
                $("#dlg_nueva_observacion_1").dialog("close");

            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones_1');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 3){
        
        observacion = $('#dlg_observacion_1').val();
        if(observacion == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion_1");
            return false;
        }
        
        id_observaciones = $('#table_observaciones_1').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_nueva_observacion_1', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'educacion_cultura_deporte/'+id_observaciones+'/edit?tipo=observaciones_1',
            type: 'GET',
            data: {
                observacion : $('#dlg_observacion_1').val()                
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_1');
                fn_actualizar_grilla('table_observaciones_1');
                $("#dlg_nueva_observacion_1").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones_1');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 4){
        
        id = $('#table_colegios').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_nuevo_colegio', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'educacion_cultura_deporte/'+id+'/edit?tipo=colegios',
            type: 'GET',
            data: {
                direccion: direccion,
                cen_edu_l:cen_edu_l,
                numero:numero,
                nro_alumnos:nro_alumnos,
                id_tipo:id_tipo,
                id_persona:id_persona,
                id_lote:id_lote,
                cod_catastral:cod_catastral
                
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_colegio');
                fn_actualizar_grilla('table_colegios');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_colegios');
                console.log('error');
                console.log(data);
            }
        });
    }
}

///////////mapa

mapa_colegio=0;
function cargar_mapa_colegios()
{
    if(mapa_colegio==0)
    {
        mapa_colegio=1;
        cargar_mapa_lotes_colegio();
    }
    crear_dlg_mapa_colegios("dlg_mapa_colegio",1000,"SELECCIONE UN LOTE");
}

function crear_dlg_mapa_colegios(dlg,ancho,titulo)
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

function cargar_mapa_lotes_colegio()
{
        autocompletar_map_haburb_colegio('input_habilitacion_colegio');
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
            input_habilitacion.id = "input_habilitacion_colegio";
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
            target: 'id_map_reg_lote_colegio',
            
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
        
        function autocompletar_map_haburb_colegio(textbox){
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
                    $("#inp_cod_catastral_colegio").val(codlote);
                    $("#hidden_id_lote_colegio").val(feature.get('id_lote'));
                    
                    if($("#inp_cod_catastral_colegio").val() == '')
                    {
                        MensajeAlerta('Mensaje del Sistema' ,'No se Selecciono ningun poligono');
                        return false;
                    }else
                    { 
                        MensajeExito('Lote Seleccionado Correctamente', 'Operacion Ejecutada Correctamente.');
                        $("#dlg_mapa_colegio").dialog('close');
                        return false;
                    } 
                }
            });
            
        });
}

/////////////observaciones
function nueva_observacion_1()
{   
    id_colegio = $('#hidden_id_colegio').val();
    if (id_colegio != '0') 
    {
        $('#dlg_observacion_1').val(''),
        $("#dlg_nueva_observacion_1").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE OBSERVACION  :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        save_datos_colegio(2);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion_1").dialog('open');
    
    }
    else
    {
        mostraralertasconfoco("DEBES AGREGAR UN COLEGIO","#inp_direccion");
    }
}

function modificar_observacion_1()
{
    id_observaciones = $('#table_observaciones_1').jqGrid ('getGridParam', 'selrow');
    
    if (id_observaciones) {
        
        $("#dlg_nueva_observacion_1").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION OBSERVACION :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    save_datos_colegio(3);
                }
            },{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion_1").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_observacion_1', '.:: Cargando ...');

        $.ajax({url: 'educacion_cultura_deporte/'+id_observaciones+'?show=observaciones_1',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_observacion_1").val(data[0].observaciones);
                
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_1');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_1');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones_1");
    }
}

function eliminar_observacion_1()
{
    id_observaciones = $('#table_observaciones_1').jqGrid ('getGridParam', 'selrow');
    
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
                        data: {_method: 'delete', id_observaciones: id_observaciones, tipo: 1},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones_1');
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
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones_1");
    }   
}

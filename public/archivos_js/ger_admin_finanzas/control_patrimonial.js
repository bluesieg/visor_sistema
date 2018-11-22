 function limpiar_datos_cpatrimonial(){
    $("#hidden_id_cpatrimonial").val("");
    $("#inp_partida_registral").val(""); 
    $("#inp_cod_patrimonial").val("");
    $("#hidden_id_lote_cpatrimonial").val("");
    $("#inp_cod_catastral_cpatrimonial").val("");
    $("#inp_dni_cpatrimonial").val("");
    $("#hidden_inp_persona_cpatrimonial").val("");
    $("#inp_nombre_cpatrimonial").val("");
    $("#inp_num_expediente").val("");       
    $("#inp_anio").val("");       
    $("#inp_referencia").val("");       
    $("#inp_sinabif").val("");       
    $("#sel_uso_cpatrimonial").val("");       
    $("#sel_estado_cpatrimonial").val("");       
    $("#sel_situacion_cpatrimonial").val("");  
    $("#inp_direccion_cpatrimonial").val(""); 
    $("#sel_proceso_cpatrimonial").val(""); 
    $("#inp_cod_urbano").val(""); 
    $("#inp_cod_numeracion").val(""); 
    $('#btn_modificar_cpatrimonial').hide();
    $('#btn_agregar_cpatrimonial').show();
    jQuery("#table_cpatrimonial").jqGrid('setGridParam', {url: 'control_patrimonial/0?grid=table_observaciones_cpatrimonial&indice='+0 }).trigger('reloadGrid');
}
function buscar_cpatrimonial(){
    nombre = $("#dlg_buscar_cpatrimonial").val();
    fn_actualizar_grilla('table_cpatrimonial','control_patrimonial/0?grid=cpatrimonial&nombre='+nombre);
}
function new_cpatrimonial()
{
    limpiar_datos_cpatrimonial();
    $("#dlg_nuevo_cpatrimonial").dialog({
        autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGISTRO DE CONTROL PATRIMONIAL:.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    save_datos_cpatrimonial(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_cpatrimonial").dialog('open');
}
function edit_cpatrimonial()
{
    id_cpatrimonial = $('#table_cpatrimonial').jqGrid ('getGridParam', 'selrow');

    if (id_cpatrimonial) {
        
        $('#btn_agregar_cpatrimonial').hide();
        $('#btn_modificar_cpatrimonial').show();
        $("#dlg_nuevo_cpatrimonial").dialog({
            autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION DE CONTROL PATRIMONIAL :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_cpatrimonial").dialog('open');
        


        MensajeDialogLoadAjax('dlg_nuevo_cpatrimonial', '.:: Cargando ...');

        $.ajax({url: 'control_patrimonial/'+id_cpatrimonial+'?show=cpatrimonial',
            type: 'GET',
            success: function(data)
            {                         
                $("#inp_partida_registral").val(data[0].inp_partida_registral); 
                $("#inp_cod_patrimonial").val(data[0].inp_cod_patrimonial);                 
                $("#hidden_id_lote_cpatrimonial").val(data[0].hidden_id_lote_cpatrimonial);
                $("#inp_cod_catastral_cpatrimonial").val(data[0].inp_cod_catastral_cpatrimonial);
                $("#inp_dni_cpatrimonial").val(data[0].inp_dni_cpatrimonial);
                $("#hidden_inp_persona_cpatrimonial").val(data[0].hidden_inp_persona_cpatrimonial);
                $("#inp_nombre_cpatrimonial").val(data[0].inp_nombre_cpatrimonial);
                $("#inp_num_expediente").val(data[0].inp_num_expediente);
                $("#inp_anio").val(data[0].inp_anio);
                $("#inp_referencia").val(data[0].inp_referencia);
                $("#inp_sinabif").val(data[0].inp_sinabif);
                $("#sel_uso_cpatrimonial").val(data[0].sel_uso_cpatrimonial);
                $("#sel_estado_cpatrimonial").val(data[0].sel_estado_cpatrimonial);
                $("#sel_situacion_cpatrimonial").val(data[0].sel_situacion_cpatrimonial);
            
      
                id_cpatrimonial = $("#hidden_id_cpatrimonial").val(data[0].id_cpatrimonial);
                if (id_cpatrimonial == null) {
                    jQuery("#table_observaciones_cpatrimonial").jqGrid('setGridParam', {url: 'control_patrimonial/0?grid=table_observaciones_cpatrimonial&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_observaciones_cpatrimonial").jqGrid('setGridParam', {url: 'control_patrimonial/0?grid=table_observaciones_cpatrimonial&indice='+$('#hidden_id_cpatrimonial').val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_nuevo_cpatrimonial');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_cpatrimonial');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_cpatrimonial");
    }
  
}

function save_datos_cpatrimonial(variable)
{     
    partida_registral=$("#inp_partida_registral").val(); 
    cod_patrimonial=$("#inp_cod_patrimonial").val(); 
    cod_catastral =$("#inp_cod_catastral_cpatrimonial").val(); 
    id_lote =$("#hidden_id_lote_cpatrimonial").val(); 
    cod_urbano=$("#inp_cod_urbano").val(); 
    cod_numeracion=$("#inp_cod_numeracion").val(); 
    id_persona =$("#hidden_inp_persona_cpatrimonial").val(); 
    direccion =$("#inp_direccion_cpatrimonial").val(); 
    num_expediente=$("#inp_num_expediente").val(); 
    anio=$("#inp_anio").val(); 
    referencia =$("#inp_referencia").val(); 
    id_uso =$("#sel_uso_cpatrimonial").val(); 
    sinabif =$("#inp_sinabif").val(); 
    id_situacion=$("#sel_situacion_cpatrimonial").val(); 
    id_estado=$("#sel_estado_cpatrimonial").val(); 
    id_proceso=$("#sel_proceso_cpatrimonial").val(); 
    
    if(partida_registral == "")
    {   mostraralertasconfoco("* El campo partida regitral es Obligatorio","#inp_partida_registral");
        return false;
    }
    if(cod_patrimonial == "")
    {   mostraralertasconfoco("* El Campo código patrimonial es Obligatorio","#inp_cod_patrimonial");
        return false;
    }
    if(id_lote == "")
    {   mostraralertasconfoco("* Debe seleccionar un lote ","#hidden_id_lote_cpatrimonial");
        return false;
    }
    if(cod_catastral == "")
    {   mostraralertasconfoco("* Debe seleccionar un lote","#inp_cod_catastral_cpatrimonial");
        return false;
    }
    if(cod_urbano == "")
    {   mostraralertasconfoco("* El campo cod urbano regitral es Obligatorio","#inp_cod_urbano");
        return false;
    }
    if(cod_numeracion == "")
    {   mostraralertasconfoco("* El campo cod de numeración  es Obligatorio","#inp_cod_numeracion");
        return false;
    }    
    if(id_persona == "")
    {   mostraralertasconfoco("* El campo DNI es Obligatorio","#inp_dni_cpatrimonial");
        return false;
    }
    if(direccion == "")
    {   mostraralertasconfoco("* El Campo DIRECCIÓN es Obligatorio","#inp_direccion_cpatrimonial");
        return false;
    }
    if(num_expediente == "")
    {   mostraralertasconfoco("* El campo partida regitral es Obligatorio ","#inp_num_expediente");
        return false;
    }
    if(anio == "")
    {   mostraralertasconfoco("* El campo año es Obligatorio","#inp_anio");
        return false;
    }
    if(referencia == "")
    {   mostraralertasconfoco("* El campo año es Obligatorio","#inp_referencia");
        return false;
    }
    if(id_uso == "")
    {   mostraralertasconfoco("* El campo año es Obligatorio","#inp_id_uso");
        return false;
    }
    if(sinabif == "")
    {   mostraralertasconfoco("* El campo año es Obligatorio","#inp_sinabif");
        return false;
    }
    if(id_situacion == "")
    {   mostraralertasconfoco("* El campo año es Obligatorio","#inp_id_situacion");
        return false;
    }
    if(id_estado == "")
    {   mostraralertasconfoco("* El campo año es Obligatorio","#inp_id_estado");
        return false;
    }
    if(id_proceso == "")
    {   mostraralertasconfoco("* El campo año es Obligatorio","#inp_id_proceso");
        return false;
    }
    
    id = $('#table_cpatrimonial').jqGrid ('getGridParam', 'selrow');
    
    if (variable == 1) {
        
        MensajeDialogLoadAjax('dlg_nuevo_cpatrimonial', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'control_patrimonial/create?tipo=cpatrimonial',
            type: 'GET',
            data: {                   
                    partida_registral:partida_registral,
                    cod_patrimonial:cod_patrimonial,
                    cod_catastral:cod_catastral,
                    id_lote:id_lote,
                    cod_urbano:cod_urbano,
                    cod_numeracion:cod_numeracion,
                    id_persona:id_persona,
                    direccion:direccion,
                    num_expediente:num_expediente,
                    anio:anio,
                    referencia:referencia,
                    id_uso:id_uso,
                    sinabif:sinabif,
                    id_situacion:id_situacion,
                    id_estado:id_estado,
                    id_proceso:id_proceso
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_cpatrimonial');
                $('#hidden_id_cpatrimonial').val(data.id_cpatrimonial);
                $('#btn_agregar_cpatrimonial').hide();
                $('#btn_modificar_cpatrimonial').show();
                fn_actualizar_grilla('table_cpatrimonial');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_cpatrimonial');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 2){
        
        observaciones = $('#dlg_observacion_cpatrimonial').val();
        if(observaciones == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion_cpatrimonial");
            return false;
        }
        MensajeDialogLoadAjax('dlg_nueva_observacion_cpatrimonial', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'control_patrimonial/create?tipo=observaciones_cpatrimonial',
            type: 'GET',
            data: {
        	id_cpatrimonial : $('#hidden_id_cpatrimonial').val(),
                observaciones : $('#dlg_observacion_cpatrimonial').val()
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_cpatrimonial');
                jQuery("#table_observaciones_cpatrimonial").jqGrid('setGridParam', {url: 'control_patrimonial/0?grid=table_observaciones_cpatrimonial&indice='+$('#hidden_id_cpatrimonial').val() }).trigger('reloadGrid');
                $("#dlg_nueva_observacion_cpatrimonial").dialog("close");

            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones_cpatrimonial');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 3){
        
        observacion = $('#dlg_observacion_cpatrimonial').val();
        if(observacion == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion_cpatrimonial");
            return false;
        }
        
        id_observaciones = $('#table_observaciones_cpatrimonial').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_nueva_observacion_cpatrimonial', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'control_patrimonial/'+id_observaciones+'/edit?tipo=observaciones_cpatrimonial',
            type: 'GET',
            data: {
                observacion : $('#dlg_observacion_cpatrimonial').val()                
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_cpatrimonial');
                fn_actualizar_grilla('table_observaciones_cpatrimonial');
                $("#dlg_nueva_observacion_cpatrimonial").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones_cpatrimonial');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 4){
        
        id = $('#table_cpatrimonial').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_nuevo_cpatrimonial', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'control_patrimonial/'+id+'/edit?tipo=cpatrimonial',
            type: 'GET',
            data: {
                partida_registral:partida_registral,
                    cod_patrimonial:cod_patrimonial,
                    cod_catastral:cod_catastral,
                    id_lote:id_lote,
                    cod_urbano:cod_urbano,
                    cod_numeracion:cod_numeracion,
                    id_persona:id_persona,
                    direccion:direccion,
                    num_expediente:num_expediente,
                    anio:anio,
                    referencia:referencia,
                    id_uso:id_uso,
                    sinabif:sinabif,
                    id_situacion:id_situacion,
                    id_estado:id_estado,
                    id_proceso:id_proceso               
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_cpatrimonial');
                fn_actualizar_grilla('table_cpatrimonial');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_cpatrimonial');
                console.log('error');
                console.log(data);
            }
        });
    }
}

///////////mapa

mapa_cpatrimonial=0;
function cargar_mapa_cpatrimonial()
{
    if(mapa_cpatrimonial==0)
    {
        mapa_cpatrimonial=1;
        cargar_mapa_lotes_cpatrimonial();
    }
    crear_dlg_mapa_cpatrimonial("dlg_mapa_cpatrimonial",1000,"SELECCIONE UN LOTE");
}

function crear_dlg_mapa_cpatrimonial(dlg,ancho,titulo)
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

function cargar_mapa_lotes_cpatrimonial()
{
        autocompletar_map_haburb_cpatrimonial('input_habilitacion_cpatrimonial');
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
            input_habilitacion.id = "input_habilitacion_cpatrimonial";
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
            target: 'id_map_reg_lote_cpatrimonial',
            
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
        
        function autocompletar_map_haburb_cpatrimonial(textbox){
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
                    $("#inp_cod_catastral_cpatrimonial").val(codlote);
                    $("#hidden_id_lote_cpatrimonial").val(feature.get('id_lote'));
                    
                    if($("#inp_cod_catastral_cpatrimonial").val() == '')
                    {
                        MensajeAlerta('Mensaje del Sistema' ,'No se Selecciono ningun poligono');
                        return false;
                    }else
                    { 
                        MensajeExito('Lote Seleccionado Correctamente', 'Operacion Ejecutada Correctamente.');
                        $("#dlg_mapa_cpatrimonial").dialog('close');
                        return false;
                    } 
                }
            });
            
        });
}

/////////////observaciones
function nueva_observacion_cpatrimonial()
{   
    id_cpatrimonial = $('#hidden_id_cpatrimonial').val();
    if (id_cpatrimonial != '0') 
    {
        $('#dlg_observacion_cpatrimonial').val(''),
        $("#dlg_nueva_observacion_cpatrimonial").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE OBSERVACION  :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        save_datos_cpatrimonial(2);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion_cpatrimonial").dialog('open');
    
    }
    else
    {
        mostraralertasconfoco("DEBES AGREGAR UN REGISTRO CONTROL PATRIMONIAL","#inp_direccion");
    }
}

function modificar_observacion_cpatrimonial()
{
    id_observaciones = $('#table_observaciones_cpatrimonial').jqGrid ('getGridParam', 'selrow');
    
    if (id_observaciones) {
        
        $("#dlg_nueva_observacion_cpatrimonial").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR OBSERVACION :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    save_datos_cpatrimonial(3);
                }
            },{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion_cpatrimonial").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_observacion_cpatrimonial', '.:: Cargando ...');

        $.ajax({url: 'control_patrimonial/'+id_observaciones+'?show=observaciones_cpatrimonial',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_observacion_cpatrimonial").val(data[0].observaciones);                
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_cpatrimonial');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_cpatrimonial');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones_cpatrimonial");
    }
}

function eliminar_observacion_cpatrimonial()
{
    id_observaciones = $('#table_observaciones_cpatrimonial').jqGrid ('getGridParam', 'selrow');
    
    if (id_observaciones) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'control_patrimonial/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_observaciones: id_observaciones, tipo: 1},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones_cpatrimonial');
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
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones_cpatrimonial");
    }   
}

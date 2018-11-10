
function limpiar_datos(){
    $("#inp_nro_exp").val('');
    $("#inp_id_gestor").val('');
    $("#inp_gestor").val('');
    $("#inp_dni").val('');
    $("#inp_fec_ini").val('');
    $("#sel_responsable").val(0);
    $("#inp_id_lote").val(0);
    $("#inp_cod_catastral").val('');
    $("#sel_tipo_san").val(0);
    $("#sel_materia").val(0);
    $("#sel_proceso").val(0);
    $("#sel_caso").val(0);
    $("#inp_referencia").val('');
    $("#inp_procedimiento").val('');
    $("#dlg_dni_abogado").val('');
    $("#dlg_abogado").val('');
    $("#hidden_dlg_abogado").val(0);
    $('#btn_modificar_expediente').hide();
    $('#btn_agregar_expediente').show();
    $('#inp_id_procuraduria').val(0);
    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'procuraduria/0?grid=observaciones&indice='+0 }).trigger('reloadGrid');
}

function new_exp_procuraduria()
{
    limpiar_datos();
    $("#dlg_new_exp_procuraduria").dialog({
        autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO EXPEDIENTE :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }],
    });
    $("#dlg_new_exp_procuraduria").dialog('open');
    
}

function fn_obtener_exp()
{
    codigo_exp = $("#inp_nro_exp").val();

    if (codigo_exp == '') {
        mostraralertasconfoco('* El campo Codigo de Expediente es obligatorio...', '#inp_nro_exp');
        return false;
    }
    
    MensajeDialogLoadAjax('inp_nro_exp', '.:: Cargando ...');
    $.ajax({url: 'procuraduria/0?datos=datos_expediente',
    type: 'GET',
    data:{codigo_exp:codigo_exp},
    success: function(data) 
    {
        if (data.msg === 'no'){
            mostraralertasconfoco("Mensaje del Sistema, NO EXISTE EL NUMERO DE EXPEDIENTE");
            //limpiar_datos();
            MensajeDialogLoadAjaxFinish('inp_nro_exp');
            $('#inp_nro_exp').val('');
        }
        else if(data.msg === 'repetido'){
            mostraralertasconfoco("Mensaje del Sistema, EL NUMERO DE EXPEDIENTE YA FUE REGISTRADO");
            MensajeDialogLoadAjaxFinish('inp_nro_exp');
        }
        else{
            MensajeDialogLoadAjaxFinish('inp_nro_exp');
            MensajeExito('Numero de Expediente Encontrado', 'La Operacion fue realizada con Exito.');
            $('#inp_id_gestor').val(data.id_gestor);
            $('#inp_gestor').val(data.gestor);
            $('#inp_dni').val(data.dni);
            $('#inp_fec_ini').val(data.fecha_inicio);
        }
    },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
        }
    });
}

//CODIGO DEL MAPA

mapa_lote_procuraduria=0;
function cargar_mapa_procuraduria()
{
    if(mapa_lote_procuraduria==0)
    {
        mapa_lote_procuraduria=1;
        cargar_mapa_lotes_procuraduria();
    }
    crear_dlg_mapa("dlg_mapa_procuraduria",1000,"SELECCIONE UN LOTE");
}

function crear_dlg_mapa(dlg,ancho,titulo)
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

function cargar_mapa_lotes_procuraduria()
{
        autocompletar_map_haburb_procuraduria('input_habilitacion_procuraduria');
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
            input_habilitacion.id = "input_habilitacion_procuraduria";
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
            target: 'id_map_reg_lote_procuraduria',
            
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
        
        function autocompletar_map_haburb_procuraduria(textbox){
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
                    $("#inp_cod_catastral").val(codlote);
                    $("#inp_id_lote").val(feature.get('id_lote'));
                    
                    if($("#inp_cod_catastral").val() == '')
                    {
                        MensajeAlerta('Mensaje del Sistema' ,'No se Selecciono ningun poligono');
                        return false;
                    }else
                    { 
                        MensajeExito('Lote Seleccionado Correctamente', 'Operacion Ejecutada Correctamente.');
                        $("#dlg_mapa_procuraduria").dialog('close');
                        return false;
                    } 
                }
            });
            
        });
}

function guardar_editar_datos(variable)
{
    nro_expediente = $("#inp_nro_exp").val();
    id_gestor = $("#inp_id_gestor").val();
    gestor = $("#inp_gestor").val();
    dni = $("#inp_dni").val();
    fecha_ini = $("#inp_fec_ini").val();
    id_abogado = $("#hidden_dlg_abogado").val();
    id_lote = $("#inp_id_lote").val();
    codigo_catastral = $("#inp_cod_catastral").val();
    id_tipo_sancion = $("#sel_tipo_san").val();
    id_materia = $("#sel_materia").val();
    id_proceso = $("#sel_proceso").val();
    id_caso = $("#sel_caso").val();
    referencia = $("#inp_referencia").val();
    procedimiento = $("#inp_procedimiento").val();
    
    
    if(nro_expediente == "")
    {
        mostraralertasconfoco("* El Campo Nombre Nro Expediente es Obligatorio","#inp_nro_exp");
        return false;
    }
    if(gestor == "")
    {
        mostraralertasconfoco("* El Campo Gestor es Obligatorio","#inp_gestor");
        return false;
    }
    if(dni == "")
    {
        mostraralertasconfoco("* El Campo DNI es Obligatorio","#inp_dni");
        return false;
    }
    if(fecha_ini == "")
    {
        mostraralertasconfoco("* El Campo Fecha Inicio es Obligatorio","#inp_fec_ini");
        return false;
    }
    
    if(id_abogado == '0')
    {
        mostraralertasconfoco("* Debes buscar un Abogado","#dlg_dni_abogado");
        return false;
    }
    
    if(id_lote == '0')
    {
        mostraralertasconfoco("* Debes Seleccionar un Lote","#btn_bus_mapa");
        return false;
    }
    
    if(id_tipo_sancion == '0')
    {
        mostraralertasconfoco("* Debes Seleccionar un Tipo Sancion","#sel_tipo_san");
        return false;
    }
    
    if(id_materia == '0')
    {
        mostraralertasconfoco("* Debes Seleccionar una Materia","#sel_materia");
        return false;
    }
    
    if(id_proceso == '0')
    {
        mostraralertasconfoco("* Debes Seleccionar un Tipo","#sel_proceso");
        return false;
    }
    
    if(id_caso == '0')
    {
        mostraralertasconfoco("* Debes Seleccionar un Caso","#sel_caso");
        return false;
    }
    
    if(referencia == "")
    {
        mostraralertasconfoco("* El Campo Nombre Referencia es Obligatorio","#inp_referencia");
        return false;
    }
    
    if(procedimiento == "")
    {
        mostraralertasconfoco("* El Campo Nombre Procedimiento es Obligatorio","#inp_procedimiento");
        return false;
    }
    
    if (variable == 1) {
        
        MensajeDialogLoadAjax('dlg_new_exp_procuraduria', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria/create',
            type: 'GET',
            data: {
        	nro_expediente : nro_expediente,
                id_gestor : id_gestor,
                gestor : gestor,
                dni : dni,
                fecha_ini : fecha_ini,
                id_abogado : id_abogado,
                id_lote : id_lote,
                codigo_catastral : codigo_catastral,
                id_tipo_sancion : id_tipo_sancion,
                id_materia : id_materia,
                id_proceso : id_proceso,
                id_caso : id_caso,
                referencia : referencia,
                procedimiento : procedimiento,
                tipo:1
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_new_exp_procuraduria');
                $('#inp_id_procuraduria').val(data.id_procuraduria);
                $('#btn_agregar_expediente').hide();
                $('#btn_modificar_expediente').show();
                fn_actualizar_grilla('table_expedientes');
                fn_actualizar_grilla('table_escaneos');
                //$("#dlg_new_exp_procuraduria").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_comisarias');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 2){
        
        observacion = $('#dlg_observacion').val();
        if(observacion == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion");
            return false;
        }
        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria/create',
            type: 'GET',
            data: {
        	id_procuraduria : $('#inp_id_procuraduria').val(),
                observacion : $('#dlg_observacion').val(),
                tipo : 2
            },
            success: function(data) 
            {   
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion');
                jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'procuraduria/0?grid=observaciones&indice='+$('#inp_id_procuraduria').val() }).trigger('reloadGrid');
                $("#dlg_nueva_observacion").dialog("close");

            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 3){
        
        observacion = $('#dlg_observacion').val();
        if(observacion == "")
        {
            mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion");
            return false;
        }
        
        id_det_procuraduria = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria/'+id_det_procuraduria+'/edit',
            type: 'GET',
            data: {
                observacion : $('#dlg_observacion').val(),
                tipo : 2
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion');
                fn_actualizar_grilla('table_observaciones');
                $("#dlg_nueva_observacion").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if(variable == 4){
        
        id_procuraduria = $('#table_expedientes').jqGrid ('getGridParam', 'selrow');
        
        MensajeDialogLoadAjax('dlg_new_exp_procuraduria', '.:: Cargando ...');
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria/'+id_procuraduria+'/edit',
            type: 'GET',
            data: {
                nro_expediente : nro_expediente,
                id_gestor : id_gestor,
                gestor : gestor,
                dni : dni,
                fecha_ini : fecha_ini,
                id_abogado : id_abogado,
                id_lote : id_lote,
                codigo_catastral : codigo_catastral,
                id_tipo_sancion : id_tipo_sancion,
                id_materia : id_materia,
                id_proceso : id_proceso,
                id_caso : id_caso,
                referencia : referencia,
                procedimiento : procedimiento,
                tipo : 1
            },
            success: function(data) 
            {     
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_new_exp_procuraduria');
                fn_actualizar_grilla('table_expedientes');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_expedientes');
                console.log('error');
                console.log(data);
            }
        });
    }
    
}

function nueva_observacion()
{   
    id_procuraduria = $('#inp_id_procuraduria').val();
    if (id_procuraduria != '0') 
    {
        $('#dlg_observacion').val(''),
        $("#dlg_nueva_observacion").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE OBSERVACION  :.</h4></div>",
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
        $("#dlg_nueva_observacion").dialog('open');
    
    }
    else
    {
        mostraralertasconfoco("DEBES AGREGAR UN EXPEDIENTE","#inp_nro_exp");
    }
}

function modificar_observacion()
{
    id_det_procuraduria = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_det_procuraduria) {
        
        $("#dlg_nueva_observacion").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION OBSERVACION :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    guardar_editar_datos(3);
                }
            },{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');

        $.ajax({url: 'procuraduria/'+id_det_procuraduria+'?show=observaciones',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_observacion").val(data[0].observaciones);
                
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones");
    }
}

function eliminar_observacion()
{
    id_det_procuraduria = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_det_procuraduria) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'procuraduria/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_det_procuraduria: id_det_procuraduria, tipo: 1},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones');
                            MensajeExito('Eliminar Tributo', id_det_procuraduria + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Tributo', id_det_procuraduria + ' - No se pudo Eliminar.');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Eliminar Observacion','Operacion Cancelada.');
                }

            }
        });
        
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones");
    }   
}

function edit_exp_procuraduria()
{
    id_procuraduria = $('#table_expedientes').jqGrid ('getGridParam', 'selrow');
    
    if (id_procuraduria) {
        
        $('#btn_agregar_expediente').hide();
        $('#btn_modificar_expediente').show();
        $("#dlg_new_exp_procuraduria").dialog({
            autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION EXPEDIENTE PROCURADURIA :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_new_exp_procuraduria").dialog('open');


        MensajeDialogLoadAjax('dlg_new_exp_procuraduria', '.:: Cargando ...');

        $.ajax({url: 'procuraduria/'+id_procuraduria+'?show=procuraduria',
            type: 'GET',
            success: function(data)
            {          
                $("#inp_nro_exp").val(data[0].nro_expediente);
                $("#inp_id_gestor").val(data[0].id_gestor);
                $("#inp_gestor").val(data[0].gestor);
                $("#inp_dni").val(data[0].nro_doc_gestor);
                $("#inp_fec_ini").val(data[0].fecha_inicio_tramite);
                $("#dlg_dni_abogado").val(data[0].nro_doc_persona);
                $("#hidden_dlg_abogado").val(data[0].id_abogado);
                $("#dlg_abogado").val(data[0].persona);
                $("#inp_id_lote").val(data[0].id_lote);
                $("#inp_cod_catastral").val(data[0].cod_catastral);
                $("#sel_tipo_san").val(data[0].id_tipo_sancion);
                $("#sel_materia").val(data[0].id_materia);
                $("#sel_proceso").val(data[0].id_proceso);
                $("#sel_caso").val(data[0].id_caso);
                $("#inp_referencia").val(data[0].referencia);
                $("#inp_procedimiento").val(data[0].procedimiento);
                
                id_procuraduria = $("#inp_id_procuraduria").val(data[0].id_procuraduria);
                if (id_procuraduria == null) {
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'procuraduria/0?grid=observaciones&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'procuraduria/0?grid=observaciones&indice='+$('#inp_id_procuraduria').val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_new_exp_procuraduria');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_new_exp_procuraduria');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_expedientes");
    }
}

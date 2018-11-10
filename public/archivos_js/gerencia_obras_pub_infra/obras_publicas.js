mapa_lote_obra=0;
function cargar_mapa_obra()
{
    if(mapa_lote_obra==0)
    {
        mapa_lote_obra=1;
        cargar_mapa_lotes_obras();
    }
    crear_dlg_mapa_obras("dlg_mapa_obra",1250,"SELECCIONE UN LOTE");
}

function crear_dlg_mapa_obras(dlg,ancho,titulo)
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

function cargar_mapa_lotes_obras()
{
        autocompletar_map_haburb_obra('input_habilitacion_obra');
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
            input_habilitacion.id = "input_habilitacion_obra";
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
            target: 'id_map_reg_lote_obra',
            
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
        
        function autocompletar_map_haburb_obra(textbox){
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
                    $("#dlg_ubicacion").val(codlote);
                    $("#id_lote_obra").val(feature.get('id_lote'));
                    
                    if($("#dlg_ubicacion").val() == '')
                    {
                        MensajeAlerta('Mensaje del Sistema' ,'No se Selecciono ningun poligono');
                        return false;
                    }else
                    { 
                        MensajeExito('Lote Seleccionado Correctamente', 'Operacion Ejecutada Correctamente.');
                        $("#dlg_mapa_obra").dialog('close');
                        return false;
                    } 
                }
            });
            
        });
}

function limpiar_campos()
{
    $('#dlg_dni_ejecutor').val('');
    $('#hidden_dlg_ejecutor').val('0');
    $('#dlg_ejecutor').val('');
    $('#dlg_dni_supervisor').val('');
    $('#hidden_dlg_supervisor').val('0');
    $('#dlg_supervisor').val('');
    $('#dlg_dni_residente').val('');
    $('#hidden_dlg_residente').val('0');
    $('#dlg_residente').val('');
    $('#id_lote_obra').val('0');
    $('#dlg_ubicacion').val('');
    $('#dlg_nombre_obra').val('');
    $('#dlg_nombre_obra').val('');
    $('#tipo_obra').val('0');
    $('#modalidad_ejecucion').val('0');
    $('#dlg_monto').val('');
    $('#dlg_observacion').val('');
    $('#dlg_codigo_snip').val('');
    $("#chkbox_perfil").prop('checked', false);
    $("#chkbox_expediente_tecnico").prop('checked', false);
    $('#dlg_tiempo_ejecucion').val('');
    $('#dlg_beneficiarios').val('');
    $('#dlg_descripcion').val('');
    $('#id_estado_obra').val('0');
    $('#dlg_avance_fisico').val('');
    $('#dlg_avance_financiero').val('');
    $('#id_obra').val('');
    $('#btn_modificar_obra').hide();
    $('#btn_agregar_obra').show();
    jQuery("#table_fotos_obra").jqGrid('setGridParam', {url: 'sub_geren_obras_publicas/0?grid=fotos_obra&indice='+0 }).trigger('reloadGrid');
}

function nueva_obra()
{
    limpiar_campos();
    $("#dlg_nueva_obra").dialog({
        autoOpen: false, modal: true, width: 1050, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVA OBRA  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nueva_obra").dialog('open');
}

function fn_buscar_nombre_obras(){
    nombre = $("#dlg_buscar_obra").val();
    fn_actualizar_grilla('table_obras','sub_geren_obras_publicas/0?grid=obras_publicas&nombre='+nombre);
}

function guardar_editar_datos(tipo) {
    id_ejecutor = $('#hidden_dlg_ejecutor').val();
    id_supervisor = $('#hidden_dlg_supervisor').val();
    id_residente = $('#hidden_dlg_residente').val();
    id_lote = $('#id_lote_obra').val();
    ubicacion = $('#dlg_ubicacion').val();
    distrito = $('#distrito').val();
    provincia = $('#provincia').val();
    departamento = $('#departamento').val();
    nombre = $('#dlg_nombre_obra').val();
    tipo_obra = $('#tipo_obra').val();
    id_modalidad_ejecucion = $('#modalidad_ejecucion').val();
    monto = $('#dlg_monto').val();
    observacion = $('#dlg_observacion').val();
    codigo_snip = $('#dlg_codigo_snip').val();
    tiempo_ejecucion = $('#dlg_tiempo_ejecucion').val();
    beneficiarios = $('#dlg_beneficiarios').val();
    fecha_inicio = $('#dlg_fecha_inicio').val();
    fecha_termino = $('#dlg_fecha_termino').val();
    descripcion = $('#dlg_descripcion').val();
    id_estado_obra = $('#id_estado_obra').val();
    avance_fisico = $('#dlg_avance_fisico').val();
    avance_financiero = $('#dlg_avance_financiero').val();

    if(id_ejecutor == "0")
    {
        mostraralertasconfoco("* El Campo EJECUTOR es Obligatorio","#dlg_dni_ejecutor");
        return false;
    }
    if(id_supervisor == "0")
    {
        mostraralertasconfoco("* El Campo SUPERVISOR es Obligatorio","#dlg_dni_supervisor");
        return false;
    }
    if(id_residente == "0")
    {
        mostraralertasconfoco("* El Campo RESIDENTE es Obligatorio","#dlg_dni_residente");
        return false;
    }
    if(id_lote == "0")
    {
        mostraralertasconfoco("* El Campo UBICACION es Obligatorio","#dlg_ubicacion");
        return false;
    }
    if(nombre == "")
    {
        mostraralertasconfoco("* El Campo NOMBRE OBRA es Obligatorio","#dlg_nombre_obra");
        return false;
    }
    if(tipo_obra == "0")
    {
        mostraralertasconfoco("* Debe Seleccionar un Tipo de Obra","#tipo_obra");
        return false;
    }
    if(id_modalidad_ejecucion == "0")
    {
        mostraralertasconfoco("* Debe Seleccionar una Modalidad","#modalidad_ejecucion");
        return false;
    }
    if(monto == "")
    {
        mostraralertasconfoco("* El Campo MONTO es Obligatorio","#dlg_monto");
        return false;
    }
    if(observacion == "")
    {
        mostraralertasconfoco("* El Campo OBSERVACION es Obligatorio","#dlg_observacion");
        return false;
    }
    if(codigo_snip == "")
    {
        mostraralertasconfoco("* El Campo CODIGO SNIP es Obligatorio...","#dlg_codigo_snip");
        return false;
    }
    if(tiempo_ejecucion == "")
    {
        mostraralertasconfoco("* El Campo TIEMPO EJECUCION es Obligatorio","#dlg_tiempo_ejecucion");
        return false;
    }
    if(beneficiarios == "")
    {
        mostraralertasconfoco("* El Campo BENEFICIARIOS es Obligatorio","#dlg_beneficiarios");
        return false;
    }
    if(fecha_inicio == "")
    {
        mostraralertasconfoco("* El Campo FECHA INICIO es Obligatorio","#dlg_fecha_inicio");
        return false;
    }
    if(fecha_termino == "")
    {
        mostraralertasconfoco("* El Campo FECHA TERMINO es Obligatorio","#dlg_fecha_termino");
        return false;
    }
    if(descripcion == "")
    {
        mostraralertasconfoco("* El Campo DESCRIPCION es Obligatorio","#dlg_descripcion");
        return false;
    }
    if(id_estado_obra == "0")
    {
        mostraralertasconfoco("* Debe Seleccionar un Estado","#id_estado_obra");
        return false;
    }
    if(avance_fisico == "")
    {
        mostraralertasconfoco("* El Campo AVANCE FISICO es Obligatorio","#dlg_avance_fisico");
        return false;
    }
    if(avance_financiero == "")
    {
        mostraralertasconfoco("* El Campo AVANCE FINANCIERO es Obligatorio","#dlg_avance_financiero");
        return false;
    }
    
    if($("#chkbox_perfil").is(':checked')){
       var perfil = 1;
    }else{
        perfil = 0;
    }
    
    if($("#chkbox_expediente_tecnico").is(':checked')){
       var expediente_tecnico = 1;
    }else{
        expediente_tecnico = 0;
    }
    
    if (tipo == 1) {

        MensajeDialogLoadAjax('dlg_nueva_obra', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_obras_publicas/create',
            type: 'GET',
            data: {
        	nombre :nombre,
                tipo_obra :tipo_obra,
                id_modalidad_ejecucion :id_modalidad_ejecucion,
                observacion :observacion,
                codigo_snip:codigo_snip,
                perfil :perfil,
                expediente_tecnico:expediente_tecnico,
                tiempo_ejecucion :tiempo_ejecucion,
                monto:monto,
                beneficiarios :beneficiarios,
                id_ejecutor :id_ejecutor,
                id_supervisor :id_supervisor,
                id_residente :id_residente,
                fecha_inicio :fecha_inicio,
                fecha_termino :fecha_termino,
                id_lote :id_lote,
                distrito :distrito,
                provincia :provincia,
                departamento :departamento,
                descripcion :descripcion,
                id_estado_obra :id_estado_obra,
                avance_fisico :avance_fisico,
                avance_financiero :avance_financiero,
                ubicacion:ubicacion
            },
            success: function(data) 
            {
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nueva_obra');
                fn_actualizar_grilla('table_obras');
                id_obra = $('#id_obra').val(data.id_obra);
                if (id_obra == null) {
                    jQuery("#table_fotos_obra").jqGrid('setGridParam', {url: 'sub_geren_obras_publicas/0?grid=fotos_obra&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_fotos_obra").jqGrid('setGridParam', {url: 'sub_geren_obras_publicas/0?grid=fotos_obra&indice='+$("#id_obra").val() }).trigger('reloadGrid');
                }
                $('#btn_agregar_obra').hide();
                $('#btn_modificar_obra').show();
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_obras');
                 MensajeDialogLoadAjaxFinish('dlg_nueva_obra');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_obra = $('#table_obras').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nueva_obra', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_obras_publicas/'+id_obra+'/edit',
            type: 'GET',
            data: {
        	nombre :nombre,
                tipo_obra :tipo_obra,
                id_modalidad_ejecucion :id_modalidad_ejecucion,
                observacion :observacion,
                codigo_snip:codigo_snip,
                perfil :perfil,
                expediente_tecnico:expediente_tecnico,
                tiempo_ejecucion :tiempo_ejecucion,
                monto:monto,
                beneficiarios :beneficiarios,
                id_ejecutor :id_ejecutor,
                id_supervisor :id_supervisor,
                id_residente :id_residente,
                fecha_inicio :fecha_inicio,
                fecha_termino :fecha_termino,
                id_lote :id_lote,
                distrito :distrito,
                provincia :provincia,
                departamento :departamento,
                descripcion :descripcion,
                id_estado_obra :id_estado_obra,
                avance_fisico :avance_fisico,
                avance_financiero :avance_financiero,
                ubicacion:ubicacion,
                tipo:1
            },
            success: function(data) 
            {
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nueva_obra');
                fn_actualizar_grilla('table_obras');
                $("#dlg_nueva_obra").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_obras');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function modificar_obra()
{
    id_obra = $('#table_obras').jqGrid ('getGridParam', 'selrow');
    
    if (id_obra) {
        
        $('#btn_agregar_obra').hide();
        $('#btn_modificar_obra').show();
        $("#dlg_nueva_obra").dialog({
            autoOpen: false, modal: true, width: 1050, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: INFORMACION DE OBRA :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_obra").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_obra', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_obras_publicas/'+id_obra+'?show=obras',
            type: 'GET',
            success: function(data)
            {
                $("#dlg_dni_ejecutor").val(data[0].dni_ejecutor);
                $("#hidden_dlg_ejecutor").val(data[0].id_ejecutor);
                $("#dlg_ejecutor").val(data[0].ejecutor);
                $("#dlg_dni_supervisor").val(data[0].dni_supervisor);
                $("#hidden_dlg_supervisor").val(data[0].id_supervisor);
                $("#dlg_supervisor").val(data[0].supervisor);
                $("#dlg_dni_residente").val(data[0].dni_residente);
                $("#hidden_dlg_residente").val(data[0].id_residente);
                $("#dlg_residente").val(data[0].residente);
                $("#id_lote_obra").val(data[0].id_lote);
                $("#dlg_ubicacion").val(data[0].ubicacion);
                $("#distrito").val(data[0].distrito);
                $("#provincia").val(data[0].provincia);
                $("#departamento").val(data[0].departamento);
                $("#dlg_nombre_obra").val(data[0].nombre);
                $("#tipo_obra").val(data[0].id_tipo_obra);
                $("#modalidad_ejecucion").val(data[0].id_modalidad_ejec);
                $("#id_estado_obra").val(data[0].id_estado_obra);
                $("#dlg_monto").val(data[0].monto);
                $("#dlg_observacion").val(data[0].observacion);
                $("#dlg_codigo_snip").val(data[0].codigo_snip);
                if (data[0].perfil == '1') {
                    $("#chkbox_perfil").prop('checked', true);
                }else{
                    $("#chkbox_perfil").prop('checked', false);
                }
                if (data[0].expediente_tecnico == '1') {
                    $("#chkbox_expediente_tecnico").prop('checked', true);
                }else{
                    $("#chkbox_expediente_tecnico").prop('checked', false);
                }
                $("#dlg_tiempo_ejecucion").val(data[0].tiempo_ejecucion);
                $("#dlg_beneficiarios").val(data[0].beneficiarios);
                $("#dlg_fecha_inicio").val(data[0].fecha_inicio);
                $("#dlg_fecha_termino").val(data[0].fecha_termino);
                $("#dlg_descripcion").val(data[0].descripcion);
                $("#estado_obra").val(data[0].estado_obra);
                $("#dlg_avance_fisico").val(data[0].avance_fisico);
                $("#dlg_avance_financiero").val(data[0].avance_financiero);
                
                id_obra = $("#id_obra").val(data[0].id_obra);
                if (id_obra == null) {
                    jQuery("#table_fotos_obra").jqGrid('setGridParam', {url: 'sub_geren_obras_publicas/0?grid=fotos_obra&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_fotos_obra").jqGrid('setGridParam', {url: 'sub_geren_obras_publicas/0?grid=fotos_obra&indice='+$("#id_obra").val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_nueva_obra');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_obra');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_obras");
    }
}

//FOTOS

function limpiar_campos_foto()
{
    $("#dlg_foto_obra").val('');
}

function nueva_foto()
{
    id_obra = $('#id_obra').val();
    if (id_obra != '') 
    { 
        limpiar_campos_foto();
        $("#id_obra_foto").val($("#id_obra").val());
        $("#dlg_nueva_foto").dialog({
            autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  SUBIDA DE FOTOS  :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        guardar_editar_fotos(1);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_foto").dialog('open');
    
    }
    else
    {
        mostraralertasconfoco("DEBES AGREGAR UNA OBRA","#dlg_dni_ejecutor");
    }
}

function guardar_editar_fotos(tipo) {
    
    foto_obra = $("#dlg_foto_obra").val();
    
    if(foto_obra == "")
    {
        mostraralertasconfoco("* El Campo FOTO es Obligatorio","#dlg_foto_obra");
        return false;
    }

    if (tipo == 1) {
        MensajeDialogLoadAjax('dlg_nueva_foto', '.:: Cargando ...');
        
        var form= new FormData($("#FormularioFotosObra")[0]);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_obras_publicas?tipo=1',
            type: 'POST',
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success: function(data) 
            {   
                if (data > 0) {
                    MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                    MensajeDialogLoadAjaxFinish('dlg_nueva_foto');
                    fn_actualizar_grilla('table_fotos_obra');
                    $("#dlg_nueva_foto").dialog("close");
                }   
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_fotos_obra');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {
        id_foto_obra = $('#table_fotos_obra').jqGrid ('getGridParam', 'selrow');
        MensajeDialogLoadAjax('dlg_nueva_foto', '.:: Cargando ...');
        var form= new FormData($("#FormularioFotosObra")[0]);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_obras_publicas?tipo=2&id_foto_obra='+id_foto_obra,
            type: 'POST',
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success: function(data) 
            {
                if (data > 0) {
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');   
                MensajeDialogLoadAjaxFinish('dlg_nueva_foto');
                fn_actualizar_grilla('table_fotos_obra');
                $("#dlg_nueva_foto").dialog("close");
                }
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_fotos_obra');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function modificar_foto()
{
    id_foto_obra = $('#table_fotos_obra').jqGrid ('getGridParam', 'selrow');
    
    if (id_foto_obra) 
    { 
        limpiar_campos_foto();
        $("#id_obra_foto").val($("#id_obra").val());
        $("#dlg_nueva_foto").dialog({
            autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: MODIFICAR - SUBIDA DE FOTOS  :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        guardar_editar_fotos(2);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_foto").dialog('open');
    }
    else
    {
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_fotos_obra");
    }
}


function ver_foto(id_foto_obra_controller)
{
    id_foto_obra = $('#table_fotos_obra').jqGrid ('getGridParam', 'selrow');
    
    if (id_foto_obra) {
        $("#form_foto").attr("src","");
        $("#dlg_ver_foto").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: VISUALIZAR FOTO :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_ver_foto").dialog('open');


        MensajeDialogLoadAjax('dlg_ver_foto', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_obras_publicas/'+id_foto_obra_controller+'?show=foto_obra',
            type: 'GET',
            success: function(data)
            {
                $("#form_foto").attr("src","data:image/png;base64,"+data[0].foto);
                
                MensajeDialogLoadAjaxFinish('dlg_ver_foto');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_ver_foto');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_fotos_obra");
    }
}

function eliminar_foto()
{
    id_foto_obra = $('#table_fotos_obra').jqGrid ('getGridParam', 'selrow');
    
    if (id_foto_obra) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'sub_geren_obras_publicas/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_foto_obra: id_foto_obra},
                        success: function (data) {
                            fn_actualizar_grilla('table_fotos_obra');
                            MensajeExito('Eliminar Foto Obra', id_foto_obra + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Foto Obra', id_foto_obra + ' - No se pudo Eliminar.');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Eliminar Foto Mantenimiento','Operacion Cancelada.');
                }

            }
        });
        
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_fotos_obra");
    }   
}

function Cambiar_estado(id_foto_obra,id_obra,estado)
{
    $.ajax({
        url: 'sub_geren_obras_publicas/'+id_foto_obra+'/edit',
        type:'GET',
        data: {
            id_obra:id_obra,
            estado:estado,
            tipo:2
        },
        success: function(data)
        {
            MensajeExito('FOTO OBRA', 'EL REGISTRO HA SIDO ACTUALIZADO');
            id_obra = $('#id_obra').val();
            if (id_obra == null) {
                jQuery("#table_fotos_obra").jqGrid('setGridParam', {url: 'sub_geren_obras_publicas/0?grid=fotos_obra&indice='+0 }).trigger('reloadGrid');
            }else{
                jQuery("#table_fotos_obra").jqGrid('setGridParam', {url: 'sub_geren_obras_publicas/0?grid=fotos_obra&indice='+$("#id_obra").val() }).trigger('reloadGrid');
            }
        }        
    });
}

function validarExtensionArchivo()
{
    var fileInput = document.getElementById('dlg_foto_obra');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.png|\.jpg|\.jpeg)$/i;
    if(!allowedExtensions.exec(filePath)){
        mostraralertasconfoco("ARCHIVO INCORRECTO SOLO SE PUEDEN SUBIR ARCHIVOS DE TIPO .PNG / .JPG / .JPEG","#dlg_foto_obra");
        fileInput.value = '';
        return false;
    }else{
        MensajeExito('ARCHIVO CORRECTO','PRESIONE GUARDAR PARA FINALIZAR');
    }
}
 function limpiar_datos_comisario(){
    $("#dlg_nombre_comisario").val("");
    $("#dlg_dni_comisario").val("");
    $("#dlg_telefono_comisario").val("");
    $("#dlg_foto_comisario").val("");
}

function fn_buscar_comisaria(){
    nombre = $("#dlg_buscar_comisaria").val();
    fn_actualizar_grilla('table_comisarias','comisarias/0?grid=comisarias&nombre='+nombre);
}

function crear_nueva_comisaria()
{
    id_comisaria = $('#table_comisarias').jqGrid ('getGridParam', 'selrow');
    if (id_comisaria) {
        activar_desactivar_inputs(2);
        $("#id_comisaria").val($('#table_comisarias').jqGrid ('getCell', id_comisaria, 'id'));
        $("#dlg_ubicacion").val($('#table_comisarias').jqGrid ('getCell', id_comisaria, 'ubicacion')).attr('disabled',true);
        $("#dlg_nombre_comisaria").val($('#table_comisarias').jqGrid ('getCell', id_comisaria, 'nombre')).attr('disabled',true);
        $("#dlg_telefono_comisaria").val($('#table_comisarias').jqGrid ('getCell', id_comisaria, 'telefono')).attr('disabled',true);
        $("#dlg_nro_efectivos").val($('#table_comisarias').jqGrid ('getCell', id_comisaria, 'nro_efectivos')).attr('disabled',true);
        $("#dlg_nro_vehiculos").val($('#table_comisarias').jqGrid ('getCell', id_comisaria, 'nro_vehiculos')).attr('disabled',true);
        $("#dlg_foto_comisaria").attr('disabled',true);
        $("#actualizar_comisaria").attr('disabled',true);
        
        limpiar_datos_comisario();
        $("#dlg_nuevo_comisarias").dialog({
            autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE COMISARIAS:.</h4></div>",
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
        $("#dlg_nuevo_comisarias").dialog('open');
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_comisarias");
    }
}

function guardar_editar_datos(tipo) {
    
    nombre_comisario = $("#dlg_nombre_comisario").val();
    dni_comisario = $("#dlg_dni_comisario").val();
    telefono_comisario = $("#dlg_telefono_comisario").val();
    fecha_inicio = $("#dlg_fecha_inicio").val();
    foto_comisario = $("#dlg_foto_comisario").val();
    
    if(nombre_comisario == "")
    {
        mostraralertasconfoco("* El Campo Nombre Comisario es Obligatorio","#dlg_nombre_comisario");
        return false;
    }
    if(dni_comisario == "")
    {
        mostraralertasconfoco("* El Campo DNI es Obligatorio","#dlg_dni_comisario");
        return false;
    }
    if(telefono_comisario == "")
    {
        mostraralertasconfoco("* El Campo Telefono es Obligatorio","#dlg_telefono_comisario");
        return false;
    }
    if(fecha_inicio == "")
    {
        mostraralertasconfoco("* El Campo Fecha Inicio es Obligatorio","#dlg_fecha_inicio");
        return false;
    }

    if (tipo == 1) {
        MensajeDialogLoadAjax('dlg_nuevo_comisarias', '.:: Cargando ...');
        
        var form= new FormData($("#FormularioComisarios")[0]);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'comisarias?tipo=1',
            type: 'POST',
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success: function(data) 
            {   
                if (data > 0) {
                    MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                    MensajeDialogLoadAjaxFinish('dlg_nuevo_comisarias');
                    fn_actualizar_grilla('table_comisarias');
                    $("#dlg_nuevo_comisarias").dialog("close");
                }   
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_comisarias');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_comisaria = $('#table_comisarias').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('table_comisarias', '.:: Cargando ...');
        var form= new FormData($("#FormularioComisarios")[0]);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'comisarias?tipo=2&id_comisario='+id_comisaria,
            type: 'POST',
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success: function(data) 
            {
                if (data > 0) {
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');   
                MensajeDialogLoadAjaxFinish('table_comisarias');
                fn_actualizar_grilla('table_comisarias');
                $("#dlg_nuevo_comisarias").dialog("close");
                }
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_comisarias');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function modificar_comisaria() {
    
    ubicacion = $("#dlg_ubicacion").val();
    nombre_comisaria = $("#dlg_nombre_comisaria").val();
    telefono_comisaria = $("#dlg_telefono_comisaria").val();
    nro_efectivos = $("#dlg_nro_efectivos").val();
    nro_vehiculos = $("#dlg_nro_vehiculos").val();
    
    if(ubicacion == "")
    {
        mostraralertasconfoco("* El Campo Ubicacion Comisaria es Obligatorio","#dlg_ubicacion");
        return false;
    }
    if(nombre_comisaria == "")
    {
        mostraralertasconfoco("* El Campo Nombre Comisaria es Obligatorio","#dlg_nombre_comisaria");
        return false;
    }
    if(telefono_comisaria == "")
    {
        mostraralertasconfoco("* El Campo Telefono es Obligatorio","#dlg_telefono_comisaria");
        return false;
    }
    if(nro_efectivos == "")
    {
        mostraralertasconfoco("* El Campo Nro Efectivos Inicio es Obligatorio","#dlg_nro_efectivos");
        return false;
    }
    if(nro_vehiculos == "")
    {
        mostraralertasconfoco("* El Campo Nro Vehiculos Inicio es Obligatorio","#dlg_nro_vehiculos");
        return false;
    }

    id_comisaria = $('#table_comisarias').jqGrid ('getGridParam', 'selrow');
    
    MensajeDialogLoadAjax('dlg_nuevo_comisarias', '.:: Cargando ...');

    var form= new FormData($("#FormularioComisarias")[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'comisarias?tipo=3&id_comisaria='+id_comisaria,
        type: 'POST',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function(data) 
        {   
            if (data > 0) {
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_comisarias');
                fn_actualizar_grilla('table_comisarias');
            }   
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('table_comisarias');
            console.log('error');
            console.log(data);
        }
    });
 
}

function modificar_comisarias()
{   
    id_comisaria = $('#table_comisarias').jqGrid ('getGridParam', 'selrow');
    activar_desactivar_inputs(1);
    if (id_comisaria) {
        
        $("#dlg_ubicacion").val($('#table_comisarias').jqGrid ('getCell', id_comisaria, 'ubicacion'));
        $("#dlg_nombre_comisaria").val($('#table_comisarias').jqGrid ('getCell', id_comisaria, 'nombre'));
        $("#dlg_telefono_comisaria").val($('#table_comisarias').jqGrid ('getCell', id_comisaria, 'telefono'));
        $("#dlg_nro_efectivos").val($('#table_comisarias').jqGrid ('getCell', id_comisaria, 'nro_efectivos'));
        $("#dlg_nro_vehiculos").val($('#table_comisarias').jqGrid ('getCell', id_comisaria, 'nro_vehiculos'));
        
        $("#dlg_nuevo_comisarias").dialog({
            autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION COMISARIAS :.</h4></div>",
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
        $("#dlg_nuevo_comisarias").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_comisarias', '.:: Cargando ...');

        $.ajax({url: 'comisarias/'+id_comisaria,
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_nombre_comisario").val(data[0].nombre_comisario);
                $("#dlg_dni_comisario").val(data[0].dni);
                $("#dlg_telefono_comisario").val(data[0].telefono_comisario);
                $("#dlg_fecha_inicio").val(data[0].fecha_inicio);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_comisarias');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_comisarias');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_comisarias");
    }
    
}

function activar_desactivar_inputs(tipo)
{
    if (tipo == 1) 
    {
        $('#dlg_ubicacion').removeAttr('disabled');
        $('#dlg_nombre_comisaria').removeAttr('disabled');
        $('#dlg_telefono_comisaria').removeAttr('disabled');
        $('#dlg_nro_efectivos').removeAttr('disabled');
        $('#dlg_nro_vehiculos').removeAttr('disabled');
        $('#dlg_foto_comisaria').removeAttr('disabled');
        $('#actualizar_comisaria').removeAttr('disabled');
    }
    
    if (tipo == 2) 
    {
        $('#dlg_ubicacion').attr('disabled',true);
        $('#dlg_nombre_comisaria').attr('disabled',true);
        $('#dlg_telefono_comisaria').attr('disabled',true);
        $('#dlg_nro_efectivos').attr('disabled',true);
        $('#dlg_nro_vehiculos').attr('disabled',true);
        $('#dlg_foto_comisaria').attr('disabled',true);
        $('#actualizar_comisaria').attr('disabled',true);
    }
}

function crear_observacion(id_comisaria)
{
    $('#id_observacion').val(id_comisaria);
    $("#dlg_nueva_observacion_comisaria").dialog({
        autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE OBSERVACIONES:.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_observacion(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nueva_observacion_comisaria").dialog('open');
}

function guardar_observacion()
{
    id_comisaria = $('#id_observacion').val();
    fecha_observacion = $("#dlg_fecha_observacion").val();
    observacion = $("#dlg_observacion").val();
    
    if(fecha_observacion == "")
    {
        mostraralertasconfoco("* El Campo Fecha Registro es Obligatorio","#dlg_fecha_observacion");
        return false;
    }
    if(observacion == "")
    {
        mostraralertasconfoco("* El Campo Nombre es Obligatorio","#dlg_observacion");
        return false;
    }

    MensajeDialogLoadAjax('dlg_nueva_observacion_comisaria', '.:: Cargando ...');
    
    $.confirm({
        title: '.:Esta Seguro de guardar esta Observacion... ?',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: 'comisarias/create',
                type: 'GET',
                data: {
                    id_comisaria:id_comisaria,
                    fecha_observacion:fecha_observacion,
                    observacion:observacion
                },
                success: function(data) 
                {
                    MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                    MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_comisaria');
                    $("#dlg_nueva_observacion_comisaria").dialog("close");
                    limpiar_observacion();
                },
                error: function(data) {
                    mostraralertas("hubo un error, Comunicar al Administrador");
                    MensajeDialogLoadAjaxFinish('table_comisarias');
                    console.log('error');
                    console.log(data);
                }
            });
            },
            Cancelar: function () {
                MensajeAlerta('Guardar Observacion','Operacion Cancelada.');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion_comisaria');
            }

        }
    });
}

function ver_observacion(id_comisaria)
{
    $('#hidden_id_observacion').val(id_comisaria);
    $("#dlg_ver_observacion_comisaria").dialog({
        autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.: BUSCAR OBSERVACIONES :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-file'></i>&nbsp; Abrir",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    abrir_reporte();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_ver_observacion_comisaria").dialog('open');
}

function abrir_reporte()
{
    id_comisaria = $('#hidden_id_observacion').val();
    fecha_inicio = $('#dlg_observacion_inicio').val();
    fecha_fin = $('#dlg_observacion_fin').val();
    
    window.open('comisarias/0?reporte=observaciones&id_comisaria='+id_comisaria+'&fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin);
}

function limpiar_observacion()
{
    $('#id_observacion').val('0');
    $("#dlg_fecha_observacion").val('');
    $("#dlg_observacion").val('');
}

function valida_capa_gerencia_seg_ciud(check)
{
    if($("#"+check).prop('checked'))
    {
        MensajeDialogLoadAjax('map', '.:: Cargando ...');
        if(check=='chk_geren_seg_ciud_comisarias')
        {
            Crear_Comisarias();
        }
        
        if(check=='chk_geren_seg_ciud_delitos')
        {
            Crear_Delitos();
        }
        
    }
    else
    {
        if(check=='chk_geren_seg_ciud_comisarias')
        {
            map.removeLayer(lyr_comisarias);
        }
        
        if(check=='chk_geren_seg_ciud_delitos')
        {
            map.removeLayer(lyr_delitos);
        }
    }
}

function Crear_Comisarias()
{
    $.ajax({url: 'comisarias/0?mapa=comisarias',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                geojson_salud = JSON.parse(r[0].json_build_object);
                var format_salud= new ol.format.GeoJSON();
                var features_salud = format_salud.readFeatures(geojson_salud,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_salud = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_salud.addFeatures(features_salud);
                lyr_comisarias = new ol.layer.Vector({
                    source:jsonSource_salud,
                    style: stylecomisarias,
                    title: "Geren_seg_ciudadana"
                });
                map.addLayer(lyr_comisarias);
                var extent = lyr_comisarias.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function stylecomisarias(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 16 ? 0.05 : 0.08,
          src: 'img/recursos/comisaria.png',
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('cen_edu_l') : '',
            Placement: 'point',
            textAlign: "center", 
            fill: new ol.style.Fill({
                color: 'white',
            }),
            offsetY:map.getView().getZoom() > 16 ? 40 : 20
        })
      });
}


function Crear_Delitos()
{
    $.ajax({url: 'comisarias/0?mapa=delitos',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                geojson_delitos = JSON.parse(r[0].json_build_object);
                var format_delitos= new ol.format.GeoJSON();
                var features_delitos = format_delitos.readFeatures(geojson_delitos,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_delitos = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_delitos.addFeatures(features_delitos);
                lyr_delitos = new ol.layer.Vector({
                    source:jsonSource_delitos,
                    style: estilos_lotes,
                    title: "Geren_seg_ciudadana1"
                });
                map.addLayer(lyr_delitos);
                var extent = lyr_delitos.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function estilos_lotes(feature, resolution){

        return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 16 ? 0.05 : 0.08,
          src: 'img/recursos/contenedores_sev_ciud.png',
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('x_utm') : '',
            Placement: 'point',
            textAlign: "center", 
            fill: new ol.style.Fill({
                color: 'white',
            }),
            offsetY:map.getView().getZoom() > 16 ? 40 : 20
        })
      });
}


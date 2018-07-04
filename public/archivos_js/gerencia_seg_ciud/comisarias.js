 function limpiar_datos(){
    $("#dlg_nombre_comisaria").val("");
    $("#dlg_telefono_comisaria").val("");
    $("#dlg_ubicacion").val("");
    $("#dlg_nombre_comisario").val("");
    $("#dlg_telefono_comisario").val("");
    $("#dlg_nro_efectivos").val("");
    $("#dlg_nro_vehiculos").val("");
    $("#dlg_foto_comisario").val("");
    $("#dlg_observaciones").val("");
}

 
function crear_nueva_comisaria()
{
    limpiar_datos();
    $("#dlg_nuevo_comisarias").dialog({
        autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE COMISARIAS:.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_editar_comisarias(1);
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
}

function guardar_editar_comisarias(tipo) {
    
    nombre_comisaria = $("#dlg_nombre_comisaria").val();
    telefono_comisaria = $("#dlg_telefono_comisaria").val();
    ubicacion = $("#dlg_ubicacion").val();
    nombre_comisario = $("#dlg_nombre_comisario").val();
    telefono_comisario = $("#dlg_telefono_comisario").val();
    nro_efectivos = $("#dlg_nro_efectivos").val();
    nro_vehiculos = $("#dlg_nro_vehiculos").val();
    foto = $("#dlg_foto_comisario").val();
    observaciones = $("#dlg_observaciones").val();
    
    if(nombre_comisaria == "")
    {
        mostraralertasconfoco("* El Campo Nombre Comisaria es Obligatorio","#dlg_nombre_comisaria");
        return false;
    }
    if(telefono_comisaria == "")
    {
        mostraralertasconfoco("* El Campo Telefono Comisaria es Obligatorio","#dlg_telefono_comisaria");
        return false;
    }
    if(ubicacion == "")
    {
        mostraralertasconfoco("* El Campo Ubicacion es Obligatorio","#dlg_ubicacion");
        return false;
    }
    if(nombre_comisario == "")
    {
        mostraralertasconfoco("* El Campo Nombre Comisaria es Obligatorio","#dlg_nombre_comisario");
        return false;
    }
    if(telefono_comisario == "")
    {
        mostraralertasconfoco("* El Campo Telefono Comisario es Obligatorio","#dlg_telefono_comisario");
        return false;
    }
    if(nro_efectivos == "")
    {
        mostraralertasconfoco("* El Campo Nro Efectivos es Obligatorio","#dlg_nro_efectivos");
        return false;
    }
    if(nro_vehiculos == "")
    {
        mostraralertasconfoco("* El Campo Nro Vehiculos es Obligatorio","#dlg_nro_vehiculos");
        return false;
    }
    if(observaciones == "")
    {
        mostraralertasconfoco("* El Campo Observaciones es Obligatorio","#dlg_observaciones");
        return false;
    }

    if (tipo == 1) {
        MensajeDialogLoadAjax('table_comisarias', '.:: Cargando ...');
        
        var form= new FormData($("#FormularioComisarias")[0]);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'comisarias?id_comisaria=0',
            type: 'POST',
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success: function(data) 
            {   
                if (data > 0) {
                    MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
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
    else if (tipo == 2) {

        id_comisaria = $('#table_comisarias').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('table_comisarias', '.:: Cargando ...');
        var form= new FormData($("#FormularioComisarias")[0]);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'comisarias?id_comisaria='+id_comisaria,
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

function modificar_comisarias()
{
    //limpiar_dl_ipm(1);
    id_comisaria = $('#table_comisarias').jqGrid ('getGridParam', 'selrow');
    
    if (id_comisaria) {
        
        $("#dlg_nuevo_comisarias").dialog({
            autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION COMISARIAS :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    guardar_editar_comisarias(2);
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
                $("#dlg_nombre_comisaria").val(data[0].nombre);
                $("#dlg_telefono_comisaria").val(data[0].tlfno_comsaria);
                $("#dlg_ubicacion").val(data[0].ubicacion);
                $("#dlg_nombre_comisario").val(data[0].comisario);
                $("#dlg_telefono_comisario").val(data[0].tlefno_comisario);
                $("#dlg_nro_efectivos").val(data[0].nro_efectivos);
                $("#dlg_nro_vehiculos").val(data[0].nro_vehiculos);
                $("#dlg_observaciones").val(data[0].observaciones);
                $("#foto_comisario").attr("src","data:image/jpg;base64,"+data[0].foto_comisario);
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

function valida_capa_gerencia_seg_ciud(check)
{
    if($("#"+check).prop('checked'))
    {
        MensajeDialogLoadAjax('map', '.:: Cargando ...');
        if(check=='chk_geren_seg_ciud_comisarias')
        {
            Crear_Comisarias();
        }
        
    }
    else
    {
        if(check=='chk_geren_seg_ciud_comisarias')
        {
            map.removeLayer(lyr_comisarias);
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
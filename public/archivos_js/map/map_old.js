function clicknewmznamasivo()
{
    $("#id_sector_masivo").val(0);
    $("#inicio").val('');
    $("#fin").val('');

    $("#dlg_manzana_masivo").dialog({
        autoOpen: false, modal: true, width: 400, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  CREAR MANZANAS MASIVO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                create_mznas_masivo();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_manzana_masivo").dialog('open');
}

function create_mznas_masivo() {

    id_sect = $("#id_sector_masivo").val();
    inicio = $("#inicio").val();
    fin = $("#fin").val();
    xsector = $("#id_sector_masivo option:selected").html();

    // alert(id_sect);
    if (id_sect == "" || codi_mzna == "" || mzna_dist == "") {
        mostraralertasconfoco('* Los campos son obligatorios...', 'id_sector_nuevo_editar');
        return false;
    }

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'create_mzna_masivo',
            type: 'POST',
            data: {
                xsector: xsector,
                id_sect: id_sect,
                inicio: inicio,
                fin:fin
            },
            success: function (data) {
                $("#id_sector_masivo").val(id_sect);
                dialog_close('dlg_manzana_masivo');
                fn_actualizar_grilla('tabla_manzanas', 'list_mzns_sector?id_sec=' + id_sect );
                MensajeExito('Nueva Manzana', 'La Manzana se a creado correctamente.');
            },
            error: function (data) {
                mostraralertas('* Contactese con el Administrador...');
            }
        });
}


function new_dlg_map(obj)
{
    $("#dlg_map").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVA MANZANA :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_manzana(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_map").dialog('open');

    $("#id").val(obj.get('gid'));
    $("#codigo").val(obj.get('nombre'));
    $("#sector").val(obj.get('mz_cat'));

}

function clickmodmzna()
{

    $("#dlg_manzana").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  EDITAR SECTOR :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_manzana(2);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_manzana").dialog('open');


    MensajeDialogLoadAjax('dlg_manzana', '.:: Cargando ...');

    id = $("#current_id").val();
    $.ajax({url: 'catastro_mzns/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#id_mzna").val(r[0].id_mzna);
            $("#id_sector_nuevo_editar").val(r[0].id_sect);
            $("#codi_mzna").val(r[0].codi_mzna);
            $("#mzna_dist").val(r[0].mzna_dist);
            MensajeDialogLoadAjaxFinish('dlg_manzana');

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_manzana');
        }
    });
}


function get_mzns_por_sector(id_sec){
    //var map = new ol.Map("map");
    // add layers here"POINT(-71.546226195617 -16.3045550718574)"
   // map.setCenter(new ol.LonLat(-71.546226195617, -16.3045550718574), 5);

    //alert(id_sec);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'get_centro_sector',
        type: 'POST',
        data: {codigo: id_sec+""},
        success: function (data) {
//                        $.alert(raz_soc + '- Ha sido Eliminado');
            //alert(data[0].lat + " / " + data[0].lon);
            map.getView().setCenter(ol.proj.transform([parseFloat(data[0].lat),parseFloat(data[0].lon)], 'EPSG:4326', 'EPSG:3857'));
            map.getView().setZoom(16);
        },
        error: function (data) {
            MensajeAlerta('Eliminar Arancel Rústico', id + ' - No se pudo Eliminar.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
        }
    });

        //alert($("#departamento").val());
        MensajeDialogLoadAjax('provincia', '.:: CARGANDO ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'mznas_x_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
            success: function (data) {
                //alert(data);
                $('#select_manzanas').html(data);
//                        $.alert(raz_soc + '- Ha sido Eliminado');
                //fn_actualizar_grilla('tabla_sectores', 'list_sectores');
                //dialog_close('dlg_nuevo_sector');
                //MensajeExito('Eliminar Sector', id + ' - Ha sido Eliminado');
                MensajeDialogLoadAjaxFinish('provincia', '.:: CARGANDO ...');

            },
            error: function (data) {
                MensajeAlerta('Eliminar Sector', id + ' - No se pudo Eliminar.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'geogetmznas_x_sector',
        type: 'POST',
        data: {codigo: id_sec+""},
        success: function (data) {
            //alert(data[0].json_build_object);
            //alert(geojson_manzanas2);
            map.removeLayer(lyr_manzanas2);
            var format_manzanas2 = new ol.format.GeoJSON();
            var features_manzanas2 = format_manzanas2.readFeatures(JSON.parse(data[0].json_build_object),
                {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
            var jsonSource_manzanas2 = new ol.source.Vector({
                attributions: [new ol.Attribution({html: '<a href=""></a>'})],
            });
            //vectorSource.addFeatures(features_manzanas2);
            jsonSource_manzanas2.addFeatures(features_manzanas2);
            lyr_manzanas2 = new ol.layer.Vector({
                source:jsonSource_manzanas2,
                style: manzanas_Style,
                title: "manzanas"
            });

            map.addLayer(lyr_manzanas2);
            layersList[2] = lyr_manzanas2;
            //alert(layersList.length);
            MensajeDialogLoadAjaxFinish('provincia', '.:: CARGANDO ...');

        },
        error: function (data) {
            MensajeAlerta('Eliminar Sector', id + ' - No se pudo Eliminar.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
        }
    });
}


var doHover = false;
var onSingleClick2 = function(evt) {
    if (doHover) {
        return;
    }
    var pixel = map.getEventPixel(evt.originalEvent);
    var coord = evt.coordinate;
    var popupField;
    var popupText = '';
    var currentFeature;
    var currentFeatureKeys;
    map.forEachFeatureAtPixel(pixel, function(feature, layer) {
        currentFeature = feature;
        currentFeatureKeys = currentFeature.getKeys();

        //alert(currentFeatureKeys);
        if(lyr_manzanas2 == layer){
            //alert(1);
            new_dlg_map(currentFeature);
        }

    });
};

map.on('singleclick', function(evt) {
    onSingleClick2(evt);
});

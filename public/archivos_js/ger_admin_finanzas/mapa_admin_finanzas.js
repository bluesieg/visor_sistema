//MAPA CIAM

function valida_capa_admin_finanzas(check)
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
            map.removeLayer(lyr_gerencia_admin_finanzas);
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

var lyr_gerencia_admin_finanzas;
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
                    lyr_gerencia_admin_finanzas = new ol.layer.Vector({
                        source:jsonSource_gds_ciam,
                        style: EstilosCiam,
                        title: "gds_ciam"
                    });
                    map.addLayer(lyr_gerencia_admin_finanzas);
                    var extent = lyr_gerencia_admin_finanzas.getSource().getExtent();
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
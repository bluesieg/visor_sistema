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
        if(check=='chk_mapa_demuna')
        {
            crear_mapa_demuna();
        }
        if(check=='chk_mapa_omaped')
        {
            crear_mapa_omaped();
        }
        if(check=='chk_mapa_colegio')
        {
            crear_mapa_colegio();
        }
        if(check=='chk_mapa_ccultural')
        {
            crear_mapa_ccultural();
        }
        if(check=='chk_mapa_cdeportivo')
        {
            crear_mapa_cdeportivo();
        }
        if(check=='chk_mapa_sisfoh')
        {
            crear_mapa_sisfoh();
        }
        if(check=='chk_mapa_pension')
        {
            crear_mapa_pension();
        }
        if(check=='chk_mapa_comedores')
        {
            crear_mapa_comedores();
        }
        if(check=='chk_mapa_vaso')
        {
            crear_mapa_vaso();
        }
        if(check=='chk_mapa_bienestar')
        {
            crear_mapa_bienestar();
        }
        if(check=='chk_mapa_asociaciones')
        {
            crear_mapa_asociaciones();
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
        if(check=='chk_mapa_demuna')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_demuna").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_mapa_omaped')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_omaped").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_mapa_colegio')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_colegio").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_mapa_ccultural')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_ccultural").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_mapa_cdeportivo')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_cdeportivo").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_mapa_sisfoh')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_sisfoh").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_mapa_pension')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_pension").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_mapa_comedores')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_comedores").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_mapa_vaso')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_vaso").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_mapa_bienestar')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_bienestar").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_mapa_asociaciones')
        {
            map.removeLayer(lyr_gerencia_desarrollo_social);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_asociaciones").hide();
            $("#anio_pred").show();
        }
    }
}

// crear mapaaaaaaaaaa
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
function crear_mapa_demuna()
{
    var aux_haburb_demuna=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_demuna").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_demuna==0)
    {
        aux_haburb_demuna=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}
function crear_mapa_omaped()
{
    var aux_haburb_omaped=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_omaped").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_omaped==0)
    {
        aux_haburb_omaped=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}
function crear_mapa_colegio()
{
    var aux_haburb_colegio=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_colegio").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_colegio==0)
    {
        aux_haburb_colegio=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}
function crear_mapa_ccultural()
{
    var aux_haburb_ccultural=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_ccultural").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_ccultural==0)
    {
        aux_haburb_ccultural=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}
function crear_mapa_cdeportivo()
{
    var aux_haburb_cdeportivo=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_cdeportivo").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_cdeportivo==0)
    {
        aux_haburb_cdeportivo=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}
function crear_mapa_sisfoh()
{
    var aux_haburb_sisfoh=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_sisfoh").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_sisfoh==0)
    {
        aux_haburb_sisfoh=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}
function crear_mapa_pension()
{
    var aux_haburb_pension=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_pension").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_pension==0)
    {
        aux_haburb_pension=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}
function crear_mapa_comedores()
{
    var aux_haburb_comedores=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_comedores").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_comedores==0)
    {
        aux_haburb_comedores=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}
function crear_mapa_vaso()
{
    var aux_haburb_vaso=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_vaso").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_vaso==0)
    {
        aux_haburb_vaso=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}
function crear_mapa_bienestar()
{
    var aux_haburb_bienestar=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_bienestar").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_bienestar==0)
    {
        aux_haburb_bienestar=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}
function crear_mapa_asociaciones()
{
    var aux_haburb_asociaciones=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_asociaciones").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_asociaciones==0)
    {
        aux_haburb_asociaciones=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}
// cargaaaaaaaar hab urb
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
                    MensajeAlerta('REGISTROS CIAM','NO SE ENCONTRO REGISTROS CIAM EN ESTA HABILITACION.');
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
function cargar_habilitacion_demuna()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=demuna&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('EXPEDIENTES DEMUNA','NO SE ENCONTRO REGISTROS EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_demuna = JSON.parse(data[0].json_build_object);
                    var format_gds_demuna = new ol.format.GeoJSON();
                    var features_gds_demuna = format_gds_demuna.readFeatures(geojson_gds_demuna,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_demuna = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_demuna.addFeatures(features_gds_demuna);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_demuna,
                        style: EstilosDemuna,
                        title: "gds_demuna"
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
function cargar_habilitacion_omaped()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=omaped&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('EXPEDIENTES OMAPED','NO SE ENCONTRO REGISTROS EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_omaped = JSON.parse(data[0].json_build_object);
                    var format_gds_omaped = new ol.format.GeoJSON();
                    var features_gds_omaped = format_gds_omaped.readFeatures(geojson_gds_omaped,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_omaped = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_omaped.addFeatures(features_gds_omaped);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_omaped,
                        style: EstilosOmaped,
                        title: "gds_omaped"
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
function cargar_habilitacion_colegio()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=colegio&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta(' COLEGIOS','NO SE ENCONTRO COLEGIOS EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_colegio = JSON.parse(data[0].json_build_object);
                    var format_gds_colegio = new ol.format.GeoJSON();
                    var features_gds_colegio = format_gds_colegio.readFeatures(geojson_gds_colegio,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_colegio = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_colegio.addFeatures(features_gds_colegio);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_colegio,
                        style: EstilosCiam,
                        title: "gds_colegio"
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
function cargar_habilitacion_ccultural()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=ccultural&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('CENTROS CULTURALES','NO SE ENCONTRO CENTROS CULTURALES EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_ccultural = JSON.parse(data[0].json_build_object);
                    var format_gds_ccultural = new ol.format.GeoJSON();
                    var features_gds_ccultural = format_gds_ccultural.readFeatures(geojson_gds_ccultural,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_ccultural = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_ccultural.addFeatures(features_gds_ccultural);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_ccultural,
                        style: EstilosCiam,
                        title: "gds_ccultural"
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
function cargar_habilitacion_cdeportivo()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=cdeportivo&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('EXPEDIENTES CIAM','NO SE ENCONTRO REGISTROS EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_cdeportivo = JSON.parse(data[0].json_build_object);
                    var format_gds_cdeportivo = new ol.format.GeoJSON();
                    var features_gds_cdeportivo = format_gds_cdeportivo.readFeatures(geojson_gds_cdeportivo,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_cdeportivo = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_cdeportivo.addFeatures(features_gds_cdeportivo);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_cdeportivo,
                        style: EstilosCiam,
                        title: "gds_cdeportivo"
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
function cargar_habilitacion_sisfoh()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=sisfoh&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('REGISTROS CIAM','NO SE ENCONTRO REGISTROS CIAM EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_sisfoh = JSON.parse(data[0].json_build_object);
                    var format_gds_sisfoh = new ol.format.GeoJSON();
                    var features_gds_sisfoh = format_gds_sisfoh.readFeatures(geojson_gds_sisfoh,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_sisfoh = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_sisfoh.addFeatures(features_gds_sisfoh);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_sisfoh,
                        style: EstilosCiam,
                        title: "gds_sisfoh"
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
function cargar_habilitacion_pension()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=pension&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('REGISTROS CIAM','NO SE ENCONTRO REGISTROS CIAM EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_pension = JSON.parse(data[0].json_build_object);
                    var format_gds_pension = new ol.format.GeoJSON();
                    var features_gds_pension = format_gds_pension.readFeatures(geojson_gds_pension,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_pension = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_pension.addFeatures(features_gds_pension);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_pension,
                        style: EstilosCiam,
                        title: "gds_pension"
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
function cargar_habilitacion_comedores()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=comedores&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('REGISTROS CIAM','NO SE ENCONTRO REGISTROS CIAM EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_comedores = JSON.parse(data[0].json_build_object);
                    var format_gds_comedores = new ol.format.GeoJSON();
                    var features_gds_comedores = format_gds_comedores.readFeatures(geojson_gds_comedores,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_comedores = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_comedores.addFeatures(features_gds_comedores);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_comedores,
                        style: EstilosCiam,
                        title: "gds_comedores"
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
function cargar_habilitacion_vaso()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=vaso&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('REGISTROS CIAM','NO SE ENCONTRO REGISTROS CIAM EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_vaso = JSON.parse(data[0].json_build_object);
                    var format_gds_vaso = new ol.format.GeoJSON();
                    var features_gds_vaso = format_gds_vaso.readFeatures(geojson_gds_vaso,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_vaso = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_vaso.addFeatures(features_gds_vaso);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_vaso,
                        style: EstilosCiam,
                        title: "gds_vaso"
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
function cargar_habilitacion_bienestar()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=bienestar&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('REGISTROS CIAM','NO SE ENCONTRO REGISTROS CIAM EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_bienestar = JSON.parse(data[0].json_build_object);
                    var format_gds_bienestar = new ol.format.GeoJSON();
                    var features_gds_bienestar = format_gds_bienestar.readFeatures(geojson_gds_bienestar,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_bienestar = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_bienestar.addFeatures(features_gds_bienestar);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_bienestar,
                        style: EstilosCiam,
                        title: "gds_bienestar"
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
function cargar_habilitacion_asociaciones()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'mujer_desarrollo_humano/0?mapa=asociaciones&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('REGISTROS CIAM','NO SE ENCONTRO REGISTROS CIAM EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gds_asociaciones = JSON.parse(data[0].json_build_object);
                    var format_gds_asociaciones = new ol.format.GeoJSON();
                    var features_gds_asociaciones = format_gds_asociaciones.readFeatures(geojson_gds_asociaciones,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gds_asociaciones = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gds_asociaciones.addFeatures(features_gds_asociaciones);
                    lyr_gerencia_desarrollo_social = new ol.layer.Vector({
                        source:jsonSource_gds_asociaciones,
                        style: EstilosCiam,
                        title: "gds_asociaciones"
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
//estilosssssssssssss
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
function EstilosDemuna(feature, resolution)
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

function EstilosOmaped(feature, resolution)
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

function buscar_man_bermas(tip)
{
    if(tip==1)
    {
        codigo=$("#dlg_bus_cod").val();
        if(codigo=='')
        {
            mostraralertasconfoco('Ingresar Codigo a Buscar','#dlg_bus_cod');
            return false;
        }
    }
  
    jQuery("#table_bermas").jqGrid('setGridParam', {
         url: 'bermas/0?grid=bermas&cod='+codigo
    }).trigger('reloadGrid');
}
function crear_dlg(dlg,ancho,titulo)
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

function actualizar_berma()
{
    limpiar_bermas('dlg_edit_berma');
    $('#chk_derecha,#chk_central,#chk_izquierda').prop('checked', false);
    id=$('#table_bermas').jqGrid ('getGridParam', 'selrow');
    if(id==null)
    {
        MensajeAlerta("No hay Ruta Seleccionada","Seleccione una Ruta",4000);
        return false;
    }
    
    $("#hidden_berma").val(id);
    $.ajax({url: 'bermas/'+id+'?grid=normal',
    type: 'GET',
    success: function(r) 
    {
        $("#dlg_edit_cod_via").val(r[0].cod_via);
        if(r[0].lateral_d=="SI")
        {
            $('#chk_derecha').prop('checked', true);
        }
        if(r[0].central=="SI")
        {
            $('#chk_central').prop('checked', true);
        }
        if(r[0].lateral_i=="SI")
        {
            $('#chk_izquierda').prop('checked', true);
        }
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);  
        MensajeDialogLoadAjaxFinish('dlg_edit_via');
    }
    });
    
    crear_dlg('dlg_edit_berma','700','Editar Berma');
    
}
function save_berma()
{
    MensajeDialogLoadAjax('dlg_edit_berma', '.:: Cargando ...');
    $.ajax({url: 'bermas/'+$("#hidden_berma").val()+'/edit',
    type: 'GET',
    data:{cod:$("#dlg_edit_cod_via").val(),
        der:$('#chk_derecha').prop('checked')?'SI':'NO',
        cen:$('#chk_central').prop('checked')?'SI':'NO',
        izq:$('#chk_izquierda').prop('checked')?'SI':'NO'
        },
    success: function(r) 
    {
        MensajeDialogLoadAjaxFinish('dlg_edit_berma');
        MensajeExito('Se Modificó con Exito','Su Contenedor fue modificado',5000);
        $("#dlg_edit_berma").dialog('close');
        jQuery("#table_bermas").jqGrid('setGridParam', {
         url: 'bermas/0?grid=bermas&cod=0'
        }).trigger('reloadGrid');
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_edit_berma');
    }
    }); 
}

function limpiar_bermas(dialogo)
{
    $("#"+dialogo+" input[type='text']").val("");
    $("#"+dialogo+" input[type='hidden']").val(0);
    $("#"+dialogo+" textarea").val("");
    
}

/////////////mapa principal
function crearbermas(id)
{
    $.ajax({url: 'bermas/0?grid=mapa',
            type: 'GET',
                    async: false,
                    success: function(r)
                    {
                        mapa_bd = JSON.parse(r[0].json_build_object);
                        var format = new ol.format.GeoJSON();
                        var features = format.readFeatures(mapa_bd,
                                {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                        var jsonSource = new ol.source.Vector({
                            attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                        });
                        jsonSource.addFeatures(features);

                        lyr_bermas = new ol.layer.Vector({
                            source:jsonSource,
                            style: bermasrostyle,
                            title: "Bermas",

                        });
                        map.addLayer(lyr_bermas);
                        var extent = lyr_bermas.getSource().getExtent();
                        map.getView().fit(extent, map.getSize());
                        MensajeDialogLoadAjaxFinish('map');
            }
        });
}

function bermasrostyle(feature, resolution){
    return new ol.style.Style({
       stroke: new ol.style.Stroke({
        color: '#B40477',
        width: 2
      }),
        text: new ol.style.Text({
            Placement: 'line',
            textAlign: "center",
            text: map.getView().getZoom() > 16 ? feature.get('cod_via') : "", 
            Baseline:'middle',
            maxAngle: 6.283185307179586,
            rotation: 0,
            fill: new ol.style.Fill({
                color: 'white',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 2,
                lineCap: 'butt',
            }),
        })
    });
}



function iniciar_bermas(id)
{
    $.ajax({url: 'bermas/'+id+'?grid=normal',
    type: 'GET',
    success: function(r) 
    {
        $("#dlg_edit_cod_via_berma").val(r[0].cod_via);
        if(r[0].lateral_d=="SI")
        {
            $('#chk_derecha_berma').prop('checked', true);
        }
        if(r[0].central=="SI")
        {
            $('#chk_central_berma').prop('checked', true);
        }
        if(r[0].lateral_i=="SI")
        {
            $('#chk_izquierda_berma').prop('checked', true);
        }
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);  
        MensajeDialogLoadAjaxFinish('dlg_edit_berma');
    }
    });
    
    crear_dlg('dlg_edit_berma','700','Berma');
}


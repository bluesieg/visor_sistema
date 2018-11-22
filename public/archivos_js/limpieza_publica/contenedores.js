function limpiar_contenedor(dialogo)
{
    $("#"+dialogo+" input[type='text']").val("");
    $("#"+dialogo+" input[type='hidden']").val(0);
    $("#"+dialogo+" textarea").val("");
    
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
function crear_edit_contenedores(id)
{
    $.ajax({url: 'contenedores/'+id+'?grid=normal',
    type: 'GET',
    success: function(r) 
    {
        $("#dlg_edit_cod_contenedor").val(r[0].codigo);
        $("#dlg_edit_cantidad_contenedor").val(r[0].cantidad);
        $("#dlg_edit_ubicacion_contendor").val(r[0].ubicacion);
        $("#dlg_edit_estado_contendor").val(r[0].estado);
        $("#foto_contenedor").html("<center><img src= 'data:image/png;base64," + r[0].imagen+"'/></center>");
                    
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);  
        MensajeDialogLoadAjaxFinish('dlg_ver_observacion');
    }
    });
    crear_dlg("dlg_contenedores",1000,"Mantenimiento Contenedores");
}
function agregar_observacion()
{
    $("#dlg_new_observacion").dialog({
    autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.: Agregar Observacion:.</h4></div>",
    buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        grabar_observacion();
                }
            },
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
    }).dialog('open');
}
function grabar_observacion()
{
    if($("#dlg_fec_obs").val()=="")
    {
        mostraralertasconfoco("Ingresar fecha","#dlg_fec_obs");
        return false;
    }
    if($("#txt_observacion").val()=="")
    {
        mostraralertasconfoco("Ingresar Obsevación","#txt_observacion");
        return false;
    }
    MensajeDialogLoadAjax('dlg_new_observacion', '.:: Cargando ...');
    $.ajax({url: 'contenedores/create',
    type: 'GET',
    data:{fecha:$("#dlg_fec_obs").val(),
        obs:$("#txt_observacion").val(),
        id:$("#hidden_contenedor").val(),
        tipo_create:"observacion"},
    success: function(r) 
    {
        MensajeDialogLoadAjaxFinish('dlg_new_observacion'); 
        $("#dlg_new_observacion").dialog('close');
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_new_observacion');
    }
    }); 
}
function dlg_ver_observacion()
{
    $("#dlg_new_observacion").dialog({
    autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.: Agregar Observacion:.</h4></div>",
    buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        ver_observacion();
                }
            },
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
    }).dialog('open');
}
function ver_observacion()
{
    $("#cuerpo_obs").html("");
    $("#dlg_ver_observacion").dialog({
    autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.: Lista de Observaciones:.</h4></div>",
    buttons: [{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
    }).dialog('open');
    
    MensajeDialogLoadAjax('dlg_ver_observacion', '.:: Cargando ...');
    $.ajax({url: 'contenedores/0?grid=observacion&cod='+$("#hidden_contenedor").val(),
    type: 'GET',
    success: function(r) 
    {
        html="";
        for(i=0;i<r.length;i++)
        {
            html=html+'<div class="cuerpo_li_observacion col-xs-12"><div class="col-xs-2">'+r[i].fec_obs+'</div><div class="col-xs-10">'+r[i].observacion+'</div></div>';
        }
        $("#cuerpo_obs").html(html);
        MensajeDialogLoadAjaxFinish('dlg_ver_observacion'); 
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_ver_observacion');
    }
    }); 
}
function save_contenedor()
{
    MensajeDialogLoadAjax('dlg_contenedores', '.:: Cargando ...');
    $.ajax({url: 'contenedores/'+$("#hidden_contenedor").val()+'/edit',
    type: 'GET',
    data:{cod:$("#dlg_edit_cod_contenedor").val(),
        cant:$("#dlg_edit_cantidad_contenedor").val(),
        ubi:$("#dlg_edit_ubicacion_contendor").val(),
        estado:$("#dlg_edit_estado_contendor").val()},
    success: function(r) 
    {
        MensajeDialogLoadAjaxFinish('dlg_contenedores');
        MensajeExito('Se Modificó con Exito','Su Contenedor fue modificado',5000);
        
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_contenedores');
    }
    }); 
}
/////////////mapa pantalla inicial
function crear_mapa_contedores()
{
    $.ajax({url: 'contenedores/0?grid=mapa_contenedores',
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

                        lyr_contenedores = new ol.layer.Vector({
                            source:jsonSource,
                            style: contenedorstyle,
                            title: "Contenedores",

                        });

                        map.addLayer(lyr_contenedores);
                        var extent = lyr_contenedores.getSource().getExtent();
                        map.getView().fit(extent, map.getSize());

                        MensajeDialogLoadAjaxFinish('map');
                    
            }
        });
}
function contenedorstyle(feature, resolution) {
    return  new ol.style.Style({
    image: new ol.style.Icon({
      scale: map.getView().getZoom() > 16 ? (map.getView().getZoom() > 18 ? 0.3 : 0.1) : 0.07,
      src: 'img/recursos/contenedor.png',
    }),
    text: new ol.style.Text({

        Placement: 'point',
        textAlign: "center", 
        fill: new ol.style.Fill({
            color: 'white',
        }),
        offsetY:map.getView().getZoom() > 16 ? 40 : 20
    })
  });
}
function iniciar_contenedores(id)
{
    $.ajax({url: 'contenedores/'+id+'?grid=normal',
    type: 'GET',
    success: function(r) 
    {
        $("#dlg_edit_cod_contenedor").val(r[0].codigo);
        $("#dlg_edit_cantidad_contenedor").val(r[0].cantidad);
        $("#dlg_edit_ubicacion_contendor").val(r[0].ubicacion);
        $("#dlg_edit_estado_contendor").val(r[0].estado==1?'BUENO':r[0].estado==2?'REGULAR':r[0].estado==3?'MALO':'');
        $("#foto_contenedor").html("<center><img src= 'data:image/png;base64," + r[0].imagen+"'/></center>");
                    
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_ver_observacion');
    }
    });
    
    $.ajax({url: 'contenedores/0?grid=observacion&cod='+id,
    type: 'GET',
    success: function(r) 
    {
        html="";
        for(i=0;i<r.length;i++)
        {
            html=html+'<div class="cuerpo_li_observacion col-xs-12"><div class="col-xs-2">'+r[i].fec_obs+'</div><div class="col-xs-10">'+r[i].observacion+'</div></div>';
        }
        $("#cuerpo_obs_contenedores").html(html);
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_ver_observacion');
    }
    }); 
    crear_dlg("dlg_contenedores",1000,"Contenedores");
}
function imp_rep_contenedores()
{
    window.open('contenedores/0?grid=reporte');
}
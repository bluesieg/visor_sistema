function buscar_ruta_barrido()
{
    codigo=$("#dlg_bus_cod").val();
    if(codigo=='')
    {
        mostraralertasconfoco('Ingresar Codigo a Buscar','#dlg_bus_cod');
        return false;
    }
    jQuery("#table_rutas").jqGrid('setGridParam', {
         url: 'rutas_barrido_calles/0?grid=rutas_barrido&cod='+codigo
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

function actualizar_ruta()
{
    limpiar_rutas('dlg_edit_ruta');
    Id=$('#table_rutas').jqGrid ('getGridParam', 'selrow');
    if(Id==null)
    {
        MensajeAlerta("No hay Ruta Seleccionada","Seleccione una Ruta",4000);
        return false;
    }
    
    $("#hidden_ruta").val(Id);
    jQuery("#table_rutas_personal").jqGrid('setGridParam', {
         url: 'rutas_barrido_calles/0?grid=personal&cod='+$("#hidden_ruta").val()}).trigger('reloadGrid');
    $("#dlg_edit_cod_ruta").val($('#table_rutas').jqGrid ('getCell', Id, 'cod_ruta_barrido'));
    $("#dlg_edit_des_ruta").val($('#table_rutas').jqGrid ('getCell', Id, 'descripcion'));
    crear_dlg('dlg_edit_ruta','1000','Editar Ruta Barrido Calles');
    
}
function save_ruta()
{
    MensajeDialogLoadAjax('dlg_edit_ruta', '.:: Cargando ...');
    $.ajax({url: 'rutas_barrido_calles/'+$("#hidden_ruta").val()+'/edit',
    type: 'GET',
    data:{cod:$("#dlg_edit_cod_ruta").val(),des:$("#dlg_edit_des_ruta").val()},
    success: function(r) 
    {
        MensajeDialogLoadAjaxFinish('dlg_edit_ruta');
        jQuery("#table_rutas").jqGrid('setGridParam', {
         url: 'rutas_barrido_calles/0?grid=rutas_barrido&cod=0'
        }).trigger('reloadGrid');
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_edit_ruta');
    }
    }); 
}
function grabar_personal()
{
    if($("#dlg_personal_dni").val()=="")
    {
        mostraralertasconfoco("Ingresar DNI","#dlg_personal_dni");
        return false;
    }
    if($("#dlg_personal_nombres").val()=="")
    {
        mostraralertasconfoco("Ingresar Nombres","#dlg_personal_nombres");
        return false;
    }
    MensajeDialogLoadAjax('dlg_new_personal', '.:: Cargando ...');
    $.ajax({url: 'rutas_barrido_calles/create',
    type: 'GET',
    data:{dni:$("#dlg_personal_dni").val(),
        nombres:$("#dlg_personal_nombres").val(),
        ape_pat:$("#dlg_personal_ape_pat").val(),
        ape_mat:$("#dlg_personal_ape_mat").val(),
        fono:$("#dlg_personal_fono").val(),
        id_ruta_barrido:$("#hidden_ruta").val(),
        tipo_create:"personal"},
    success: function(r) 
    {
        jQuery("#table_rutas_personal").jqGrid('setGridParam', {
         url: 'rutas_barrido_calles/0?grid=personal&cod='+$("#hidden_ruta").val()}).trigger('reloadGrid');
        $("#dlg_new_personal").dialog('close');
        MensajeDialogLoadAjaxFinish('dlg_new_personal');        
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_new_personal');
    }
    }); 
}
function agregar_personal()
{
    limpiar_rutas("dlg_new_personal");
    $("#dlg_edit_cod_ruta_personal").val($("#dlg_edit_cod_ruta").val());
    $("#dlg_new_personal").dialog({
    autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.: Agregar Personal:.</h4></div>",
    buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        grabar_personal();
                }
            },
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
    }).dialog('open');
}

function limpiar_rutas(dialogo)
{
    $("#"+dialogo+" input[type='text']").val("");
    $("#"+dialogo+" input[type='hidden']").val(0);
    $("#"+dialogo+" textarea").val("");
    
}
function quitar_personal(id)
{
     $.SmartMessageBox({
            title : "Confirmación Final!",
            content : "Está por Eliminar este personal, Está seguro?. este cambio no se podrá revertir",
            buttons : '[Cancelar][Aceptar]'
    }, function(ButtonPressed) {
            if (ButtonPressed === "Aceptar") {

                    del_personal(id);
            }
            if (ButtonPressed === "Cancelar") {
                    $.smallBox({
                            title : "No se Eliminó",
                            content : "<i class='fa fa-clock-o'></i> <i>Puede Corregir...</i>",
                            color : "#C46A69",
                            iconSmall : "fa fa-times fa-2x fadeInRight animated",
                            timeout : 3000
                    });
            }
    });
}
function del_personal(id)
{
    MensajeDialogLoadAjax('dlg_edit_ruta', '.:: Eliminando ...');
        $.ajax({
            url: 'rutas_barrido_calles/destroy',
            type: 'post',
            data: {_method: 'delete', _token:$("#del_token").data('token'),id:id,tipo:'personal'},
            success: function(r) 
            {
                jQuery("#table_rutas_personal").jqGrid('setGridParam', {
                url: 'rutas_barrido_calles/0?grid=personal&cod='+$("#hidden_ruta").val()}).trigger('reloadGrid');                MensajeAlerta("Se Eliminó Correctamente","Su Registro Fue eliminado Correctamente...",4000)
                MensajeDialogLoadAjaxFinish('dlg_edit_ruta');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_predios');
                console.log('error');
                console.log(data);
            }
        });
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
    $.ajax({url: 'rutas_barrido_calles/create',
    type: 'GET',
    data:{fecha:$("#dlg_fec_obs").val(),
        obs:$("#txt_observacion").val(),
        id_ruta_barrido:$("#hidden_ruta").val(),
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
    $.ajax({url: 'rutas_barrido_calles/0?grid=observacion&cod='+$("#hidden_ruta").val(),
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
///////////////////////////mapa pantalla principal
function crear_rutas_barrido()
{
    $.ajax({url: 'rutas_barrido_calles/0?grid=rutas_geom',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                geojson = JSON.parse(r[0].json_build_object);
                var format= new ol.format.GeoJSON();
                var features = format.readFeatures(geojson,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource.addFeatures(features);
                lyr_rutas_barrido= new ol.layer.Vector({
                    source:jsonSource,
                    style: style_rutas_barrido,
                    title: "Rutas Barrido"
                });
                map.addLayer(lyr_rutas_barrido);
                var extent = lyr_rutas_barrido.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
              
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}

function style_rutas_barrido(feature, resolution){
    return new ol.style.Style({
       stroke: new ol.style.Stroke({
        color: '#B40477',
        width: 2
      }),
        text: new ol.style.Text({
            Placement: 'line',
            textAlign: "center",
            text: map.getView().getZoom() > 14 ? feature.get('cod_ruta_barrido') : "", 
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

var inicio_barrido=0;
function iniciar_visualizar_mapa_barrido(id,des,cod)
{
    $("#dlg_edit_des_ruta").val(des);
    $("#dlg_edit_cod_ruta").val(cod);
    if(inicio_barrido==0)
    {
        inicio_barrido=1;
        jQuery("#table_rutas_personal_barrido").jqGrid({
            url: 'rutas_barrido_calles/0?grid=personal&cod='+id,
            datatype: 'json', mtype: 'GET',
            height: '100px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_per_barrido', 'DNI', 'Nombre','Teléfono'],
            rowNum: 100, sortname: 'id_per_barrido', sortorder: 'desc', viewrecords: true, caption: 'Personal Barrido Calles', align: "center",
            colModel: [
                {name: 'id_per_barrido', index: 'id_per_barrido', hidden: true},
                {name: 'dni', index: 'dni', align: 'left', width: 100},
                {name: 'ape_pat', index: 'ape_pat', align: 'left', width: 600},
                {name: 'telefono', index: 'telefono', align: 'left', width: 200}
                
            ],
            pager: '#pager_table_rutas_personal_barrido',
            rowList: [100, 200],
            gridComplete: function () {
                    var idarray = jQuery('#table_rutas_personal_barrido').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_rutas_personal_barrido').jqGrid('getDataIDs')[0];
                            $("#table_rutas_personal_barrido").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
    }
    else
    {
        jQuery("#table_rutas_personal").jqGrid('setGridParam', {
         url: 'rutas_barrido_calles/0?grid=personal&cod='+id}).trigger('reloadGrid');
    }
    $.ajax({url: 'rutas_barrido_calles/0?grid=observacion&cod='+id,
    type: 'GET',
    success: function(r) 
    {
        html="";
        for(i=0;i<r.length;i++)
        {
            html=html+'<div class="cuerpo_li_observacion col-xs-12"><div class="col-xs-2">'+r[i].fec_obs+'</div><div class="col-xs-10">'+r[i].observacion+'</div></div>';
        }
        $("#cuerpo_obs_barrido_mapa").html(html);
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_ver_observacion');
    }
    }); 
    crear_dlg("dlg_ruta_barrido",1000,"Ruta Barrido Calles");
}


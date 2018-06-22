function limpiar_exp_san(dialogo)
{
    $("#"+dialogo+" input[type='text']").val("");
    $("#"+dialogo+" input[type='hidden']").val(0);
    if(dialogo=='dlg_nuevo_exp')
    {
        validatipopersona();
    }
}
function validatipopersona()
{
    $("#inp_nro_doc").val("");
    if($("#seltipper").val()==1)
    {
        $("#inp_nro_doc").attr('maxlength','8')
        $("#").val("");
        $("#div_per_juridica").hide();
        $("#div_per_natural").show();
    }
    if($("#seltipper").val()==2)
    {
        $("#inp_nro_doc").attr('maxlength','11')
        $("#div_per_juridica").show();
        $("#div_per_natural").hide();
    }
}
function crear_nuevo_exp()
{
    limpiar_exp_san('dlg_nuevo_exp');
    $("#dlg_nuevo_exp").dialog({
        autoOpen: false, modal: true, width: 900, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO EXPEDIENTE :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    grabar_exp_san();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_exp").dialog('open');
}

aux_mapa_lote=0;
function map_reg_lote()
{
    MensajeDialogLoadAjax('dlg_nuevo_exp', '.:: Cargando ...');
    if(aux_mapa_lote==0)
    {
        aux_mapa_lote=1;
        iniciar_mapa();
    }
    crear_dlg("dlg_mapa_reg_lote",1000,"Seleccione Lote");
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
function iniciar_mapa()
{
        autocompletar_haburb('inp_habilitacion');
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

            var selectList = document.createElement("input");
            selectList.id = "inp_habilitacion";
            selectList.className = "input-sm col-xs-12";
            selectList.type = "text";
            selectList.style = "height:18px";
            selectList.placeholder = "Seleccione Habilitación";

            var this_ = this;
            var handleRotateNorth = function(e) {
                this_.getMap().getView().setRotation(0);
            };

            button.addEventListener('click', handleRotateNorth, false);
            button.addEventListener('touchstart', handleRotateNorth, false);

            var element = document.createElement('div');
            element.className = 'ol-unselectable ol-mycontrol';
            element.style='width:700px !important'

            element.appendChild(selectList);

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
            target: 'id_map_reg_lote',
            
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
        function autocompletar_haburb(textbox){
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
                            traer_hab_by_id(ui.item.value);
                            return false;
                        }
                    });
                }
            });
        }

        function traer_hab_by_id(id)
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
                        traer_lote_by_hab(id);

                    }
                });
    }
        function traer_lote_by_hab(id)
        {
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'get_lotes_x_hab_urb',
                    type: 'GET',
                    data: {codigo: id},
                    success: function (data) {
                        //alert(data[0].json_build_object);
                        //alert(geojson_manzanas2);
                        map.removeLayer(lyr_lotes3);
                        var format_lotes3 = new ol.format.GeoJSON();
                        var features_lotes3 = format_lotes3.readFeatures(JSON.parse(data[0].json_build_object),
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                        var jsonSource_lotes3 = new ol.source.Vector({
                            attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                        });
                        //vectorSource.addFeatures(features_manzanas2);
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
            // get the text from the feature - `this` is ol.Feature
            // and show only under certain resolution
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
                    $("#dlg_lot_foto").val(feature.get('codi_lote'));
                    $("#dlg_mzna_foto").val(feature.get('codi_mzna'));
                    $("#dlg_sec_foto").val(feature.get('sector'));
                    $("#hidden_dlg_lot_foto").val(feature.get('id_lote'));
                    viewlong_lote(feature.get('id_lote'));
                    return false;
                }
            });
    
        });
        MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
}
function viewlong_lote(id)
{
    
    $("#dlg_img_view_big").html("");
    $("#dlg_view_foto").dialog({
    autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  Foto del Predio :.</h4></div>",
    }).dialog('open');
   MensajeDialogLoadAjax('dlg_view_foto', '.:: Cargando ...');
    $.ajax({url: 'traefoto_lote_id/'+id,
    type: 'GET',
    success: function(r) 
    {
        texto1='';
        texto2='';
        $("#dlg_img_view_big").html("");
        if(r!=0)
        {
            $("#dlg_img_view").html('<center><img src="data:image/png;base64,'+r[0].foto+'" width="85%"/></center>');

            for(i=0;i<r.length;i++)
            {
                if(i==0)
                {
                    texto1=texto1+'<li data-target="#myCarousel" data-slide-to="'+i+'" class="active"></li>';            
                    texto2=texto2+'<div class="item active"><center><img src="data:image/png;base64,'+r[i].foto+'" alt=""></center></div>';

                }
                else
                {
                    texto1=texto1+'<li data-target="#myCarousel" data-slide-to="'+i+'"></li>';            
                    texto2=texto2+'<div class="item"><center><img src="data:image/png;base64,'+r[i].foto+'" alt=""></center></div>\n\
                                  '
                }
            }
            final='<div id="myCarousel" class="carousel fade" style="margin-bottom: 20px;">\n\
                  <ol class="carousel-indicators">\n\
                  '+texto1+'\n\
                  </ol>\n\
                  <div class="carousel-inner">\n\
                    '+texto2+'\n\
                  </div>\n\
                <a class="left carousel-control" href="#myCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-left"></span> </a>\n\
                <a class="right carousel-control" href="#myCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-right"></span> </a>\n\
                </div>';
            $("#dlg_img_view_big").html(final);
        }
        else
        {
            $("#dlg_img_view").html('<center><img src="img/recursos/Home-icon.png" width="85%"/></center>');
        }
        MensajeDialogLoadAjaxFinish('dlg_view_foto');
        
        
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_img_view');
    }
    }); 
}

function selec_reg_lote()
{
    $("#dlg_lot").val($("#dlg_lot_foto").val());
    $("#dlg_mzna").val($("#dlg_mzna_foto").val());
    $("#dlg_sec").val($("#dlg_sec_foto").val());
    $("#hidden_dlg_lot").val($("#hidden_dlg_lot_foto").val());
    $("#dlg_view_foto").dialog("close");
    $("#dlg_mapa_reg_lote").dialog("close");
    MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
}

function grabar_exp_san()
{
    if($("#hidden_dlg_lot").val()==0||$("#hidden_dlg_lot").val()=='')
    {
        mostraralertasconfoco('Seleccione Lote Catastral', "#dlg_lot");
        return false;
    }
    if($("#seltipper").val()==1&&($("#inp_ape_pat").val()+$("#inp_ape_mat").val()+$("#inp_nom_per").val())=='')
    {
        mostraralertasconfoco('Ingresar Persona', "#inp_ape_pat");
        return false;
    }
    if($("#seltipper").val()==2&&$("#inp_raz_soc").val()=='')
    {
        mostraralertasconfoco('Ingresar Persona', "#inp_ape_pat");
        return false;
    }
    $.SmartMessageBox({
            title : "Confirmación Final!",
            content : "Está por generar Un expediente de Proceso Administrativo Sancionador, Seguro que deseea Grabar la información?...",
            buttons : '[Cancelar][Aceptar]'
    }, function(ButtonPressed) {
            if (ButtonPressed === "Aceptar") {

                    fn_save_exp_san();
            }
            if (ButtonPressed === "Cancelar") {
                    $.smallBox({
                            title : "No se Guardo",
                            content : "<i class='fa fa-clock-o'></i> <i>Puede Corregir...</i>",
                            color : "#C46A69",
                            iconSmall : "fa fa-times fa-2x fadeInRight animated",
                            timeout : 3000
                    });
            }
    });
}
function fn_save_exp_san()
{
    MensajeDialogLoadAjax('dlg_nuevo_exp', '.:: CARGANDO ...');
    $.ajax({url: 'pas/create',
    type: 'GET',
    data:{
        tip_doc:$("#seltipdoc").val(),
        id_lote:$("#hidden_dlg_lot").val(),
        tip_per:$("#seltipper").val(),
        ape_pat:$("#inp_ape_pat").val(),
        ape_mat:$("#inp_ape_mat").val(),
        nombres:$("#inp_nom_per").val(),
        raz_soc:$("#inp_raz_soc").val(),
        dom_fis:$("#inp_dom_fis").val(),
        nro_doc:$("#inp_nro_doc").val(),
        tipo_create:'registro_expe_sancionador'
    },
    success: function(r) 
    {
        MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
        selecciona_fecha();
        MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
        
        $("#dlg_nuevo_exp").dialog("close");
        
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
        console.log('error');
        console.log(data);
    }
    });
}
function selecciona_fecha()
{
    fecha_desde = $("#dlg_fec_desde").val(); 
    fecha_hasta = $("#dlg_fec_hasta").val(); 

    jQuery("#table_expedientes").jqGrid('setGridParam', {
         url: 'pas/0?grid=registro_expe_sancionador&fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta
    }).trigger('reloadGrid');
}
function valida_pestana(tip)
{
    if(tip==1)
    {
        $("#titulo_1, #botones_1").show();
        $("#titulo_2, #botones_2").hide();
    }
    if(tip==2)
    {
        $("#titulo_2, #botones_2").show();
        $("#titulo_1, #botones_1").hide();
    }
}
var autocomplete=0;
function crear_verific()
{
    Id=$('#table_expedientes').jqGrid ('getGridParam', 'selrow');
    if(Id==null)
    {
        MensajeAlerta("No hay Expediente Seleccionado","Seleccione un Expediente",4000);
        return false;
    } 
    else
    {
        limpiar_exp_san('dlg_verificación');
        $("#inp_veri_cod_exp_san").val($('#table_expedientes').jqGrid ('getCell', Id, 'nro_exp_san'));
        $("#inp_veri_gestor").val($('#table_expedientes').jqGrid ('getCell', Id, 'gestor'));
        if(autocomplete==0)
        {
            autocomplete=1;
            auto_input("ipn_sancion","pas/0?grid=autocompleta_sancion",1);
        }
        $("#dlg_verificación").dialog({
            autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  VERIFICAR EXPEDIENTE :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        //grabar_exp_san();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_verificación").dialog('open');
    }
}
function auto_input(textbox,url,extra){
    $.ajax({
           type: 'GET',
           url: url,
           success: function(data){               
                var $local_todo=data;          
                 $("#"+textbox).autocomplete({
                      source: $local_todo,
                      focus: function(event, ui) {
                             $("#"+textbox).val(ui.item.label);                             
                             return false;
                      },
                      select: function(event, ui) {
                             $("#"+textbox).val(ui.item.label);
                             $("#hidden_"+textbox).val(ui.item.value);
                             if(extra==1)
                             {
                                $("#ipn_accion_san").val(ui.item.sancion);
                                $("#ipn_tipo_cobro_porcentaje").val(ui.item.porcentaje_cobro);
                                if(ui.item.tipo==1)
                                {   
                                    $("#ipn_tipo_cobro").val('SOBRE MONTO DE OBRA');
                                    $("#ipn_monto_obra").val(0);
                                    validartotal();
                                    $("#sobreobra").show();
                                    $("#sobreuit").hide();
                                }
                                if(ui.item.tipo==2)
                                {    
                                    $("#sobreobra").hide();
                                    $("#sobreuit").show();
                                    $("#ipn_tipo_cobro").val('SOBRE UIT');
                                    $("#ipn_monto_uit").val(ui.item.uit);
                                    $("#ipn_san_total").val(parseFloat(ui.item.uit)*(parseFloat(ui.item.porcentaje_cobro)/100));
                                }
                                
                             }
                              return false;
                      }   
                  });  

            }
    });
}

function validartotal()
{
    $("#ipn_san_total").val(parseFloat($("#ipn_monto_obra").val())*(parseFloat($("#ipn_tipo_cobro_porcentaje").val())/100));
}

function confirmar_sancion()
{
    if($("#hidden_ipn_sancion").val()==0||$("#hidden_ipn_sancion").val()=='')
    {
        mostraralertasconfoco('Seleccione Sanción', "#ipn_sancion");
        return false;
    }
    if($("#ipn_san_total").val()==0)
    {
        mostraralertasconfoco('Ingrese Monto', "#ipn_monto_obra");
        return false;
    }
    $.SmartMessageBox({
            title : "Confirmación Final!",
            content : "Está por Agregar una Sancion a este Expediente, Seguro que deseea Grabar la información?...",
            buttons : '[Cancelar][Aceptar]'
    }, function(ButtonPressed) {
            if (ButtonPressed === "Aceptar") {

                    save_verifica_sancion();
            }
            if (ButtonPressed === "Cancelar") {
                    $.smallBox({
                            title : "No se Guardo",
                            content : "<i class='fa fa-clock-o'></i> <i>Puede Corregir...</i>",
                            color : "#C46A69",
                            iconSmall : "fa fa-times fa-2x fadeInRight animated",
                            timeout : 3000
                    });
            }
    });
}
function save_verifica_sancion()
{
    MensajeDialogLoadAjax('dlg_verificación', '.:: CARGANDO ...');
    $.ajax({url: 'pas/create',
    type: 'GET',
    data:{
        tip_doc:$("#seltipdoc").val(),
        id_lote:$("#hidden_dlg_lot").val(),
        tip_per:$("#seltipper").val(),
        ape_pat:$("#inp_ape_pat").val(),
        ape_mat:$("#inp_ape_mat").val(),
        nombres:$("#inp_nom_per").val(),
        raz_soc:$("#inp_raz_soc").val(),
        dom_fis:$("#inp_dom_fis").val(),
        nro_doc:$("#inp_nro_doc").val(),
        tipo_create:'registro_expe_sancionador'
    },
    success: function(r) 
    {
        MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
        selecciona_fecha();
        MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
        
        $("#dlg_nuevo_exp").dialog("close");
        
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
        console.log('error');
        console.log(data);
    }
    });
}
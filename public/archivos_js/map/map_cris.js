var lyr_map_cons_2015;
var lyr_map_cons_2016;
var lyr_map_cons_2017;
var lyr_map_cons_2018;

var lyr_map_edificaciones_amarillo;
var lyr_map_edificaciones_verde;
var lyr_map_edificaciones_rojo;

var lyr_map_mod_hab_urb_amarillo;
var lyr_map_mod_hab_urb_verde;
var lyr_map_mod_hab_urb_rojo;

var aux_constancias=0;
map.on('singleclick', function(evt) {
//    map.getLayers().forEach(function(el) {
//        if(el.get('title')=='lotes')
//        { }});
            //alert(el.target.getFeatures().getLength());
            
            mostrar=0;
            var fl = map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
                if(layer.get('title')=='Zonificación'&&mostrar==0)
                {   
                    $("#show_img_pdm_zonificaicon").html('');
                    mostrar=1;
                    crear_dlg("dlg_zonificacion",600,"Zonificación");
                    $("#show_img_pdm_zonificaicon").html('<center><img src="img/zonificacion/'+feature.get('id_zonif')+'.jpg"/></center>');
                    return false;
                }
                if(layer.get('title')=='Agencias Juridiccion'&&mostrar==0)
                {   
                    $("#div_img_agencias").html("");
                    mostrar=1;
                    $("#id_agencia").val(feature.get('gid'));
                    $("#input_agencia").text(feature.get('text'));
                    $("#input_agencia_area").text(feature.get('area'));
                    $("#input_agencia_poblacion").text('----- hab');;
                    $("#input_agencia_dir").text(feature.get('ubicacion'));;
                    $("#input_agencia_fono").text(feature.get('tlfno_anex'));
                    $("#div_img_agencias").html('<img src="img/recursos/agencias/'+feature.get('gid')+'.jpg" style="max-height:250px; max-width:400px" onclick="viewagencia('+feature.get('gid')+');"/>')
                    crear_dlg("dlg_agencias",600,"Agencias");
                    return false;
                }
                if(layer.get('title').match(/Constancias.*/)&&mostrar==0)
                {
                    mostrar=1;
                    if(aux_constancias==0)
                    {
                        aux_constancias=1;
                        crear_grilla_constancias();
                    }
                    jQuery("#table_doc_constancias").jqGrid('setGridParam', {url: 'datos_predio?grid=9_1&id='+feature.get('id_reg_exp')}).trigger('reloadGrid');
                    crear_dlg("dlg_constancias_anios",1100,"Constancias");
                    return false;
                }
                if(layer.get('title')=='lotes'&&mostrar==0)
                {
                    $("#dlg_predio_lote label").text("");
                    $("#div_colindancias").html("");
                    mostrar=1;
                    codlote=feature.get('sector')+feature.get('codi_mzna')+feature.get('codi_lote');
                    $("#input_pred_cod_cat").text(codlote);
                    $("#input_pred_habilitacion").text(feature.get('nomb_hab_urba'));
                    $("#input_pred_perimetro_lote").text(feature.get('st_perimeter'));
                    verlote(feature.get('id_lote'),codlote);
                    return false;
                    
                }
                if(layer.get('title')=='Zona Urbana'||layer.get('title')=='Zona Agricola'||layer.get('title')=='Zona Eriaza'&&mostrar==0)
                {
                    mostrar=1;
                    $("#input_zona").val(feature.get('zona'));
                    $("#input_zona_area").text(feature.get('area'));
                    $("#input_zona_poblacion").text(feature.get('poblacion'));
                    $("#input_zona_aportes").text(feature.get('tot_aportes'));
                    $("#input_zona_situacion").text(feature.get('situacion'));
                        $("#input_zona_pred").text(feature.get('total_predios'));
                    crear_dlg("dlg_zonas_distritales",600,"Zonas Distritales");
                    return false;
                }
                if(layer.get('title')=='Expediente Urbano'&&mostrar==0)
                {
                    mostrar=1;
                    $("#input_exur_nombre").text(feature.get('descrip'));
                    $("#input_exur_altura").text(feature.get('altura_de'));
                    $("#input_exur_mat").text(feature.get('material_1'));
                    $("#input_exur_estconser").text(feature.get('e_conserva'));
                    $("#input_exur_estconst").text(feature.get('e_construc'));
                    $("#input_exur_agua").text(feature.get('agua_'));
                    $("#input_exur_luz").text(feature.get('luz_'));
                    $("#input_exur_desague").text(feature.get('desague_'));
                    $("#input_exur_uso_pri").text(feature.get('uso_1'));
                    $("#input_exur_uso_sec").text(feature.get('uso_2'));
                    $("#input_exur_uso_ter").text(feature.get('uso_3'));
                    verexp_urb();
                    return false;
                    
                }
                if(layer.get('title')=='Habilitacion Urbana'&&mostrar==0)
                {
                    mostrar=1;
                    $("#input_nom_haburb").text(feature.get('nomb_hab_urba'));
                    $("#input_aprobado").text(feature.get('aprobado'));
                    $("#input_tot_lotes_haburb").text(feature.get('tot_lotes'));
                    $("#input_area_haburb").text(feature.get('area'));
                    crear_dlg("dlg_hablitacion_urbana",900,"Hablitación Urbana");
                }
                if(layer.get('title')=='Limites'&&mostrar==0)
                {
                    mostrar=1;
                    $("#input_limit_area").text(feature.get('area_km2')+" Km2");
                    $("#input_limit_poblacion").text(feature.get('poblacion'));
                    $("#input_limit_poblacion").text('113 171 hab');
                    $("#input_limit_norte").text(feature.get('lim_norte'));
                    $("#input_limit_sur").text(feature.get('lim_sur'));
                    $("#input_limit_este").text(feature.get('lim_este'));
                    $("#input_limit_oeste").text(feature.get('lim_oeste'));
                    $("#input_limit_creacion").text(feature.get('creacion'));
                    $("#input_limit_perimetro").text(feature.get('perimetro'));
                    crear_dlg("dlg_limites",1100,"Cerro Colorado");
                    return false;
                }
                
                
            });
    
});
function crear_grilla_constancias()
{
    jQuery("#table_doc_constancias").jqGrid({
            url: '',
            datatype: 'json', mtype: 'GET',
            height: '200px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_doc_adj', 'Documento', 'Descripcion','Ver','Eliminar'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'DOCUMENTOS ESCANEADOS', align: "center",
            colModel: [
                {name: 'id_doc_adj', index: 'id_doc_adj', hidden: true},
                {name: 't_documento', index: 't_documento', align: 'center', width: 250},
                {name: 'descripcion', index: 'descripcion', align: 'left', width: 400},
                {name: 'ver', index: 'ver', align: 'center', width: 160},
                {name: 'del', index: 'del', align: 'center', width: 150},
            ],
            pager: '#pager_table_doc_constancias',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_doc_constancias').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                        var firstid = jQuery('#table_doc_constancias').jqGrid('getDataIDs')[0];
                            $("#table_doc_constancias").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
}
function verlote(id,codlote)
{
    
    crear_dlg("dlg_predio_lote",1000,"Informacion Referencia del Lote");
    traerpredionuevo(id,codlote);
    traerfoto(id);
}
function verexp_urb()
{
    crear_dlg("dlg_exp_urba",900,"Informacion de Expediente Urbano");
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

var layerSwitcher = new ol.control.LayerSwitcher({
    tipLabel: 'Légende' // Optional label for button
});
map.addControl(layerSwitcher);

function get_mzns_por_sector(id_sec){
    if(id_sec != '0')
    {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_centro_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
            success: function (data) {
                
                map.getView().setCenter(ol.proj.transform([parseFloat(data[0].lat),parseFloat(data[0].lon)], 'EPSG:4326', 'EPSG:3857'));
                map.getView().setZoom(16);
            },
            error: function (data) {
                MensajeAlerta('Cartografía', 'Error.');
            }
        });

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'mznas_x_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
            success: function (data) 
            {
                $('#select_manzanas').html(data);
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
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
                    style: label_manzanas,
                    title: "manzanas"
                });

                map.addLayer(lyr_manzanas2);
                layersList[2] = lyr_manzanas2;
                //alert(layersList.length);
                MensajeDialogLoadAjaxFinish('map', '.:: CARGANDO ...');

            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_lotes_x_sector',
            type: 'POST',
            data: {codigo: id_sec+""},
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
                layersList[3] = lyr_lotes3;
                //alert(layersList.length);
                MensajeDialogLoadAjaxFinish('map', '.:: CARGANDO ...');

            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
    }

    else{
        alert("Seleccione un sector");
    }

}
function label_manzanas(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'red',
            width: 2
        }),
        fill: new ol.style.Fill({
            color: 'rgba(255, 0, 0, 0.1)'
        }),
        text: new ol.style.Text({
            text: feature.get('codi_mzna')
        })
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
function traerpredionuevo(id,codlote)
{
    $("#input_pred_propietario").text("");
    MensajeDialogLoadAjax('dlg_predio_lote', '.:: Cargando ...');
    $.ajax({url: 'traerlote/'+id+'/'+$("#anio_pred").val(),
    data:{tipo_consulta:1},
    type: 'GET',
    success: function(r) 
    {
        $("#anio_consulta_lote").text($("#anio_pred").val());
        if(r.length>0)
        {
            $("#input_pred_propietario").text(r[0].contribuyente);
            $("#input_pred_mzna_urb").text(r[0].mzna_dist);
            $("#input_pred_lote_urb").text(r[0].lote_dist);
        }
        traer_info_predio_aportes(codlote);
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_predio_lote');
    }
    }); 
}
function traer_info_predio_aportes(id)
{
   
    $("#input_pred_propietario").text("");
    $.ajax({url: 'traerlote/'+id+'/'+$("#anio_pred").val(),
    data:{tipo_consulta:2},
    type: 'GET',
    success: function(r) 
    {
        if(r.length>0)
        {
            $("#input_pred_par_reg").text(r[0].nume_partida);
            $("#input_pred_are_tit").text(r[0].area_titulo);
            $("#input_pred_are_veri").text(r[0].area_verificada);
            $("#div_colindancias").html('\
                    <div class="col-xs-4" style="padding: 0px;">\n\
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">\n\
                            <span class="input-group-addon" style="width: 100%;height:40px">Frente</span>\n\
                        </div>\n\
                    </div>\n\
                   <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].fren_campo+'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].fren_titulo+'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].fren_colinda_campo+'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].fren_colinda_titulo+'</div>\n\
                    <div class="col-xs-12"></div>\n\
                    <div class="col-xs-4" style="padding: 0px;">\n\
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">\n\
                            <span class="input-group-addon" style="width: 100%;height:40px">Derecha</span>\n\
                        </div>\n\
                    </div>\n\
                   <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].dere_campo+'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].dere_titulo+'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].dere_colinda_campo  +'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].dere_colinda_titulo+'</div>\n\
                    <div class="col-xs-12"></div>\n\
                    <div class="col-xs-4" style="padding: 0px;">\n\
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">\n\
                            <span class="input-group-addon" style="width: 100%;height:40px">Izquierda</span>\n\
                        </div>\n\
                    </div>\n\
                   <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].izqu_campo+'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].izqu_titulo+'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].izqu_colinda_campo  +'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].izqu_colinda_titulo+'</div>\n\
                    <div class="col-xs-12"></div>\n\
                    <div class="col-xs-4" style="padding: 0px;">\n\
                        <div class="input-group input-group-md col-xs-12" style="padding: 0px">\n\
                            <span class="input-group-addon" style="width: 100%;height:40px">Fondo</span>\n\
                        </div>\n\
                    </div>\n\
                   <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].fond_titulo+'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].fond_campo+'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].fond_colinda_campo  +'</div>\n\
                    <div class="col-xs-2" style="padding:0px; text-align:center;border:1px #ccc solid; min-height:40px">'+r[0].fond_colinda_titulo+'</div>\n\
                    '
                    );
        }
        MensajeDialogLoadAjaxFinish('dlg_predio_lote');
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_predio_lote');
    }
    }); 
}
function traerfoto(id)
    {
        texto1='';
        texto2='';
        MensajeDialogLoadAjax('dlg_img_view', '.:: Cargando ...');
        $.ajax({url: 'traefoto_lote_id/'+id,
        type: 'GET',
        success: function(r) 
        {
            if(r!=0)
            {
                $("#dlg_img_view").html('<center><img src="data:image/png;base64,'+r[0].foto+'" width="85%"/></center>');

                for(i=0;i<r.length;i++)
                {
                    if(i==0)
                    {
                        texto1=texto1+'<li data-target="#myCarousel" data-slide-to="'+i+'" class="active"></li>';            
                        texto2=texto2+'<div class="item active"><center><img src="data:image/png;base64,'+r[i].foto+'" alt=""></center></div>\n\
                                       '
                        
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
            MensajeDialogLoadAjaxFinish('dlg_img_view');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_img_view');
        }
        }); 
    }
function viewlong(ruta)
{
    //$("#dlg_img_view_big").html("");
    $("#dlg_view_foto").dialog({
    autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  Foto del Predio :.</h4></div>",
    }).dialog('open');
  
        if(ruta!="")
        {
            $("#dlg_img_view_big").html('<center><img src="img/recursos/'+ruta+'" width="85%"/></center>');
        }
//        else
//        {
//            //$("#dlg_img_view_big").html($("#dlg_img_view").html());
       // }
    
}
function viewagencia(id)
{
    $("#dlg_img_view_big").html("");
    $("#dlg_view_foto").dialog({
    autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  Foto del Predio :.</h4></div>",
    }).dialog('open');
  
        $("#dlg_img_view_big").html("");
        $("#dlg_view_foto").dialog({
        autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Agencia :.</h4></div>",
        }).dialog('open');
        $("#dlg_img_view_big").html('<center><img src="img/recursos/agencias/'+id+'.jpg"/></center>')

}
function dlg_sector(val)
{
    if(val==1)
    {
        texto='Traer Manzanas';
        $("#op_sel_sector").show();
    }
    if(val==2)
    {
        $("#op_sel_sector").hide();
        texto='Traer Lotes';
    }
    if(val==3)
    {
        $("#op_sel_sector").hide();
        texto='Traer Expediente Urbano';
    }
   
    $("#dlg_selecciona_sector").dialog({
    autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.: Seleccione Sector :.</h4></div>",
    buttons: [
            {
                html: '<span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>'+texto,
                "class": "btn btn-labeled bg-color-green txt-color-white",
                click: function () 
                {
                    if(val==1)
                    {
                        crearmanzana(1)
                    }
                    if(val==2)
                    {
                        crearlotes();
                    }
                    if(val==3)
                    {
                        crear_espe_urba();
                    }
                }
            },

            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");MensajeDialogLoadAjaxFinish('map');}
            }]
    }).dialog('open');
    
}

function valida_capa(check)
{
    if($("#"+check).prop('checked'))
    {
        MensajeDialogLoadAjax('map', '.:: Cargando ...');
        if(check=='chk_limite')
        {
            crearlimites();
        }
        if(check=='chk_sector')
        {
            crearsector(0);
        }
        if(check=='chk_mzna')
        {
            dlg_sector(1);
        }
        if(check=='chk_lote')
        {
            dlg_sector(2);
        }
        if(check=='chk_hab_urb')
        {
            crearhaburb();
        }
        if(check=='chk_agencias')
        {
            crearagencia();
        }
        if(check=='chk_camaras')
        {
            crearcamaras();
        }
        if(check=='chk_educacion')
        {
            crearcolegios();
        }
        if(check=='chk_salud')
        {
            crearhospitales();
        }
        if(check=='chk_a_comisarias')
        {
            crearcomisaria();
        }
        if(check=='chk_vias')
        {
            crearvias();
        }
        if(check=='chk_z_urbana')
        {
             crear_z_urbana();
        }
        if(check=='chk_z_agricola')
        {
             crear_z_agricola();
        }
        if(check=='chk_z_eriaza')
        {
             crear_z_eriaza();
        }
        if(check=='chk_aportes')
        {
             crear_aportes();
        }
        if(check=='chk_pdm_zonificacion')
        {
             crear_pdm_zonificacion();
        }
        if(check=='chk_pdm_plan_vial')
        {
             crear_pdm_plan_vial();
        }
        if(check=='chk_quebradas')
        {
             crear_quebrada();
        }
        if(check=='chk_topografia')
        {
             crear_topografía();
        }
        if(check=='chk_carta_nac')
        {
             crear_carta_nacional();
        }
        if(check=='chk_espe_urba')
        {
            dlg_sector(3);
             
        }
        if(check=='chk_ext_mat')
        {
            crear_exta_mat();
        }
        if(check=='chk_puntos_geo')
        {
            crear_puntos_geo();
        }
        if(check=='chk_lotes_rurales')
        {
            crear_lotes_rurales();
        }
        if(check=='chk_map_cons')
        {
            crear_constancias_mapa();
        }
        if(check=='chk_map_cons_2015')
        {
            crea_mapa_constancias(2015);
        }
        if(check=='chk_map_cons_2016')
        {
            crea_mapa_constancias(2016);
        }
        if(check=='chk_map_cons_2017')
        {
            crea_mapa_constancias(2017);
        }
        if(check=='chk_map_cons_2018')
        {
            crea_mapa_constancias(2018);
        }
        if(check=='chk_map_licencias')
        {
            crear_mapa_licencias();
        }
        if(check=='chk_amarillo')
        {
            crear_semaforo_mapa_licencias(1);
        }
        if(check=='chk_verde')
        {
            crear_semaforo_mapa_licencias(2);
        }
        if(check=='chk_rojo')
        {
            crear_semaforo_mapa_licencias(3);
        }
        if(check=='chk_map_mod_hab_urb')
        {
            crear_mapa_mod_hab_urb();
        }
        if(check=='chk_amarillo_mod_hab_urb')
        {
            crear_semaforo_mapa_mod_hab_urb('amarillo');
        }
        if(check=='chk_verde_mod_hab_urb')
        {
            crear_semaforo_mapa_mod_hab_urb('verde');
        }
        if(check=='chk_rojo_mod_hab_urb')
        {
            crear_semaforo_mapa_mod_hab_urb('rojo');
        }
    }
    else
    {
        if(check=='chk_limite')
        {
            map.removeLayer(lyr_limites_distritales0);
            map.removeLayer(lyr_limit_text);
            map.removeLayer(lyr_limit_vec);
            
        }
        if(check=='chk_ext_mat')
        {
            map.removeLayer(lyr_extra_mat);
            map.removeLayer(lyr_extra_mat_lin);
            map.removeLayer(lyr_extra_mat_pun);
        }
        if(check=='chk_sector')
        {
            map.removeLayer(lyr_sectores);
        }
        if(check=='chk_mzna')
        {
            map.removeLayer(lyr_manzanas);
        }
        if(check=='chk_lote')
        {
            map.removeLayer(lyr_lotes);
        }
        if(check=='chk_hab_urb')
        {
            map.removeLayer(lyr_hab_urb);
            $("#legend").hide();

        }
        if(check=='chk_agencias')
        {
            map.removeLayer(lyr_agencias);
            map.removeLayer(lyr_agencias_fondos);
        }
        if(check=='chk_camaras')
        {
            map.removeLayer(lyr_camaras);
        }
        if(check=='chk_vias')
        {
            map.removeLayer(lyr_vias);
        }
        if(check=='chk_z_urbana')
        {
            map.removeLayer(lyr_z_urbana);
        }
        if(check=='chk_z_agricola')
        {
            map.removeLayer(lyr_z_agricola);
        }
        if(check=='chk_z_eriaza')
        {
            map.removeLayer(lyr_z_eriaza);
        }
        if(check=='chk_aportes')
        {
            map.removeLayer(lyr_aportes);
            $("#legend").hide();
        }
        if(check=='chk_pdm_zonificacion')
        {
             map.removeLayer(lyr_pdm_zonificacion);
        }
        if(check=='chk_pdm_plan_vial')
        {
             map.removeLayer(lyr_pdm_plan_vial);
        }
        if(check=='chk_educacion')
        {
            map.removeLayer(lyr_colegios);
        }
        if(check=='chk_salud')
        {
            map.removeLayer(lyr_hospitales);
        }
        if(check=='chk_a_comisarias')
        {
            map.removeLayer(lyr_comisarias);
        }
         if(check=='chk_quebradas')
        {
             map.removeLayer(lyr_quebradas);
        }
        if(check=='chk_topografia')
        {
             map.removeLayer(lyr_topografia);
        }
        
        if(check=='chk_carta_nac')
        {
             map.removeLayer(lyr_cotas);
             map.removeLayer(lyr_cuadra);
             map.removeLayer(lyr_curvas);
             map.removeLayer(lyr_lagos);
             map.removeLayer(lyr_rios);
        }
        if(check=='chk_espe_urba')
        {
             map.removeLayer(lyr_esp_urba);
        }
        if(check=='chk_puntos_geo')
        {
            map.removeLayer(lyr_puntos_geo);
            map.removeLayer(lyr_puntos_geo_control);
        }
        if(check=='chk_lotes_rurales')
        {
           map.removeLayer(lyr_lotes_rurales);
        }
        if(check=='chk_map_cons')
        {
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            map.removeLayer(lyr_map_cons_2015);
            map.removeLayer(lyr_map_cons_2016);
            map.removeLayer(lyr_map_cons_2017);
            map.removeLayer(lyr_map_cons_2018);
            $("#inp_habilitacion,#legend").hide();
        }
        if(check=='chk_map_cons_2015')
        {
           map.removeLayer(lyr_map_cons_2015);
        }
        if(check=='chk_map_cons_2016')
        {
           
           map.removeLayer(lyr_map_cons_2016);
        }
        if(check=='chk_map_cons_2017')
        {
           
           map.removeLayer(lyr_map_cons_2017);
        }
        if(check=='chk_map_cons_2018')
        {
         
           map.removeLayer(lyr_map_cons_2018);
        }
        if(check=='chk_map_licencias')
        {
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            map.removeLayer(lyr_map_edificaciones_amarillo);
            map.removeLayer(lyr_map_edificaciones_verde);
            map.removeLayer(lyr_map_edificaciones_rojo);
            $("#inp_habilitacion,#legend").hide();
        }
        if(check=='chk_amarillo')
        {
            map.removeLayer(lyr_map_edificaciones_amarillo);
        }
        if(check=='chk_verde')
        {
            map.removeLayer(lyr_map_edificaciones_verde);
        }
        if(check=='chk_rojo')
        {
            map.removeLayer(lyr_map_edificaciones_rojo);
        }
         if(check=='chk_map_mod_hab_urb')
        {
            
            map.removeLayer(lyr_map_mod_hab_urb_amarillo);
            map.removeLayer(lyr_map_mod_hab_urb_verde);
            map.removeLayer(lyr_map_mod_hab_urb_rojo);
            $("#legend").hide();
        }
        if(check=='chk_amarillo_mod_hab_urb')
        {
            map.removeLayer(lyr_map_mod_hab_urb_amarillo);
        }
        if(check=='chk_verde_mod_hab_urb')
        {
            map.removeLayer(lyr_map_mod_hab_urb_verde);
        }
        if(check=='chk_rojo_mod_hab_urb')
        {
            map.removeLayer(lyr_map_mod_hab_urb_rojo);
        }
    }
}
function crearlimites()
{
    $.ajax({url: 'mapa_cris_getlimites',
            type: 'GET',
//            async: false,
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
                crear_limittxt();
            }
        });
}
function crear_limittxt()
{ 
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_limit_txt',
            type: 'get',
            success: function (data) {
                var format = new ol.format.GeoJSON();
                var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource.addFeatures(features);
                lyr_limit_text= new ol.layer.Vector({
                    source:jsonSource,
                    style: stylez_limite_puntos,
                    title: "Limite Nombres"
                });
                map.addLayer(lyr_limit_text);
                var extent = lyr_limit_text.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                crear_limitvecinos();
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
            }
        });
}
function stylez_limite_puntos(feature, resolution){
    if(feature.get('refname')==null){
                text='';
            }
            else
            {
                text=feature.get('refname');
            }
    return new ol.style.Style({
        image: new ol.style.Circle({
            fill: new ol.style.Fill({
                color: 'rgba(255, 255, 255  , 0.3)',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 2,
                lineCap: 'butt',
            }),
            radius: 5
        }),
        text: new ol.style.Text({
            text: text,
            offsetY: -10,
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
function crear_limitvecinos()
{ 
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_limit_veci',
            type: 'get',
            success: function (data) {
                var format = new ol.format.GeoJSON();
                var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource.addFeatures(features);
                lyr_limit_vec= new ol.layer.Vector({
                    source:jsonSource,
                    style: stylelimit_vecinos,
                    title: "Limite Vecinos"
                });
                map.addLayer(lyr_limit_vec);
                var extent = lyr_limit_vec.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
} 
function stylelimit_vecinos(feature, resolution){
    
    return new ol.style.Style({
       stroke: new ol.style.Stroke({
        color: "white",
        width: 2
      })
    });
}
        
function crearsector(tip)
{
    $.ajax({url: 'getsectores',
            type: 'GET',
//            async: false,
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
                lyr_sectores = new ol.layer.Vector({
                    source:jsonSource_sectores_cat1,
                    style: stylesector,
                    title: "Sectores Catastrales"
                });
                map.addLayer(lyr_sectores);
                //var extent = lyr_sectores.getSource().getExtent();
                //map.getView().fit(extent, map.getSize());
                if(tip==0)
                {
                    MensajeDialogLoadAjaxFinish('map');
                }
                
            }
        });
}
function stylesector(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'blue',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(102, 102, 255, 0.3)',
        }),
        text: new ol.style.Text({
        //font: '12px Roboto',
        text: feature.get('sector')
        })
    });
}
function crearmanzana(val)
{
    $("#dlg_selecciona_sector").dialog('close');
    map.removeLayer(lyr_sectores);
    crearsector(1);
    $("#chk_sector").prop("checked", true);
    $.ajax({url: 'getmznas',
            type: 'GET',
//            async: false,
            data:{sector:$("#selsec").val()},
            success: function(r)
            {
                geojson_mzn_cat1 = JSON.parse(r[0].json_build_object);
                var format_sectores_cat1 = new ol.format.GeoJSON();
                var features_sectores_cat1 = format_sectores_cat1.readFeatures(geojson_mzn_cat1,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_sectores_cat1 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_sectores_cat1.addFeatures(features_sectores_cat1);
                lyr_manzanas = new ol.layer.Vector({
                    source:jsonSource_sectores_cat1,
                    style: stylemanzana,
                    title: "Manzanas Catastrales"
                });
                map.addLayer(lyr_manzanas);
                if(val==1)
                {
                    var extent = lyr_manzanas.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                    MensajeDialogLoadAjaxFinish('map');
                }
                
            }
        });
}
function stylemanzana(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'green',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(0, 153, 0, 0.3)',
        }),
        text: new ol.style.Text({
        //font: '12px Roboto',
        text: feature.get('codi_mzna')
        })
    });
}
        
function crearlotes()
{ 
    $("#dlg_selecciona_sector").dialog('close');
     $("#chk_sector").prop("checked", true);
     $("#chk_mzna").prop("checked", true);
    map.removeLayer(lyr_sectores);
    map.removeLayer(lyr_manzanas);
    crearmanzana(0);
    
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_lotes_x_sector',
            type: 'POST',
            data: {codigo: $("#selsec").val()},
            success: function (data) {
                var format_lotes3 = new ol.format.GeoJSON();
                var features_lotes3 = format_lotes3.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_lotes3 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_lotes3.addFeatures(features_lotes3);
                lyr_lotes = new ol.layer.Vector({
                    source:jsonSource_lotes3,
                    style: stylelotes,
                    title: "lotes"
                });

                map.addLayer(lyr_lotes);
                var extent = lyr_lotes.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}


function stylelotes(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'red',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(180, 4, 17, 0.3)',
        }),
        text: new ol.style.Text({
        //font: '12px Roboto',
        text: feature.get('codi_lote')
        })
    });
}

function crearhaburb()
{
    $.ajax({url: 'gethab_urb',
            type: 'GET',
//            async: false,
            data:{sector:$("#selsec").val()},
            success: function(r)
            {
                llamar_leyenda_hab_urb();
                geojson_hab_urb = JSON.parse(r[0].json_build_object);
                var format_sectores_cat1 = new ol.format.GeoJSON();
                var features_sectores_cat1 = format_sectores_cat1.readFeatures(geojson_hab_urb,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_sectores_cat1 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_sectores_cat1.addFeatures(features_sectores_cat1);
                lyr_hab_urb = new ol.layer.Vector({
                    source:jsonSource_sectores_cat1,
                    style: stylehaburb,
                    title: "Habilitacion Urbana"
                });
                map.addLayer(lyr_hab_urb);
                var extent = lyr_hab_urb.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function  llamar_leyenda_hab_urb()
{
    $.ajax({url: 'get_leyenda_hab_urb',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                $("#legend").html("");
                html="";
                r.forEach(function(element) 
                {
                    html=html+'<div  >\n\
                                <div class="col-xs-3"><label style="background-color: rgba('+element.color.trim()+',1); width: 15px !important ; height: 15px !important; margin-left:5px; margin-top:5px; "></label></div>    \n\
                                    <div class="col-xs-9"><label class="checkbox inline-block" style="padding-left: 0px; font-size:8px" placehoder="'+element.aprobado.trim()+'">\n\
                                        '+element.aprobado.trim()+'    ('+element.total+')\n\
                                    </label></div>\n\
                                </div>';
                });
                $("#legend").html(html);
                $("#legend").show();
            }
        });
}
 
function stylehaburb(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#B40477',
            width: 1,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba('+feature.get('color')+' , 0.6)',
        }),
        text: new ol.style.Text({
        //font: '12px Roboto',
            text: map.getView().getZoom() > 14 ? feature.get('nomb_hab_urba') : "", 
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

function crearagencia()
{
    $.ajax({url: 'getagencias_polygono',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                geojson_agencias = JSON.parse(r[0].json_build_object);
                var format_sectores_cat1 = new ol.format.GeoJSON();
                var features_sectores_cat1 = format_sectores_cat1.readFeatures(geojson_agencias,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_sectores_cat1 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_sectores_cat1.addFeatures(features_sectores_cat1);
                lyr_agencias_fondos = new ol.layer.Vector({
                    source:jsonSource_sectores_cat1,
                    style: styleagencias_polygono,
                    title: "Agencias Juridiccion"
                });
                map.addLayer(lyr_agencias_fondos);
                var extent = lyr_agencias_fondos.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                
                llamar_agenciaspoint();
            }
        });
}
function llamar_agenciaspoint()
{
    $.ajax({url: 'getagencias',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                geojson_agencias = JSON.parse(r[0].json_build_object);
                var format_sectores_cat1 = new ol.format.GeoJSON();
                var features_sectores_cat1 = format_sectores_cat1.readFeatures(geojson_agencias,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_sectores_cat1 = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_sectores_cat1.addFeatures(features_sectores_cat1);
                lyr_agencias = new ol.layer.Vector({
                    source:jsonSource_sectores_cat1,
                    style: styleagencias,
                    title: "Agencias Punto"
                });
                map.addLayer(lyr_agencias);
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function styleagencias(feature, resolution){
    return new ol.style.Style({
        image: new ol.style.Circle({
            fill: new ol.style.Fill({
                color: 'rgba(4, 164, 180  , 0.3)',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 2,
                lineCap: 'butt',
            }),
            radius: 5
            
        }),
        text: new ol.style.Text({
            text: feature.get('agencia'),
            offsetY: -25,
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
function styleagencias_polygono(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#04A4B4',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba('+feature.get('color')+', 0.5)',
        }),
        text: new ol.style.Text({
        //font: '12px Roboto',
        })
    });
}


function crearcamaras()
{
    $.ajax({url: 'getcamaras',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                geojson_camaras = JSON.parse(r[0].json_build_object);
                var format_camaras= new ol.format.GeoJSON();
                var features_camaras = format_camaras.readFeatures(geojson_camaras,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_camaras = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_camaras.addFeatures(features_camaras);
                lyr_camaras = new ol.layer.Vector({
                    source:jsonSource_camaras,
                    style: stylecamaras,
                    title: "Camaras"
                });
                map.addLayer(lyr_camaras);
                var extent = lyr_camaras.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function stylecamaras(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: 0.2,
          src: 'img/recursos/camara-md.png',
        })
      });
}

function crearvias()
{
    $.ajax({url: 'getvias_lineas',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                geojson_vias = JSON.parse(r[0].json_build_object);
                var format_vias= new ol.format.GeoJSON();
                var features_vias = format_vias.readFeatures(geojson_vias,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_vias = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_vias.addFeatures(features_vias);
                lyr_vias = new ol.layer.Vector({
                    source:jsonSource_vias,
                    style: stylevias,
                    title: "Vias"
                });
                map.addLayer(lyr_vias);
                var extent = lyr_vias.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
              
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}

function stylevias(feature, resolution){
    return new ol.style.Style({
       stroke: new ol.style.Stroke({
        color: '#B40477',
        width: 2
      }),
        text: new ol.style.Text({
            Placement: 'line',
            textAlign: "center",
            text: map.getView().getZoom() > 16 ? feature.get('result') : "", 
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

function crear_z_urbana()
{
    $.ajax({url: 'get_z_urbana',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                z_urbana = JSON.parse(r[0].json_build_object);
                var format_z_urbana = new ol.format.GeoJSON();
                var features_limites_distritales0 = format_z_urbana.readFeatures(z_urbana,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_z_urbana = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_z_urbana.addFeatures(features_limites_distritales0);

                lyr_z_urbana = new ol.layer.Vector({
                    source:jsonSource_z_urbana,
                    style: stylez_urbana,
                    title: "Zona Urbana",
                   
                });
                
                map.addLayer(lyr_z_urbana);
                var scale = new ol.control.ScaleLine();
                map.addControl(scale);
                var extent = lyr_z_urbana.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                var fullscreen = new ol.control.FullScreen();
                map.addControl(fullscreen);
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}

function stylez_eriaza(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#000000',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(255, 195, 0 , 0.3)',
        }),
        text: new ol.style.Text({
        text: feature.get('zona')
        })
    });
}
function stylez_urbana(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#6666ff',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(12, 17, 178 , 0.3)',
        }),
        text: new ol.style.Text({
        text: feature.get('zona')
        })
    });
}
function stylez_agircola(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#009900',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(17, 178, 12   , 0.3)',
        }),
        text: new ol.style.Text({
        text: feature.get('zona')
        })
    });
}
function crear_z_agricola()
{
    $.ajax({url: 'get_z_agricola',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                z_agricola = JSON.parse(r[0].json_build_object);
                var format_z_agricola = new ol.format.GeoJSON();
                var features_z_agricola = format_z_agricola.readFeatures(z_agricola,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_z_agricola = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_z_agricola.addFeatures(features_z_agricola);

                lyr_z_agricola = new ol.layer.Vector({
                    source:jsonSource_z_agricola,
                    style: stylez_agircola,
                    title: "Zona Agricola",
                   
                });
                
                map.addLayer(lyr_z_agricola);
                var scale = new ol.control.ScaleLine();
                map.addControl(scale);
                var extent = lyr_z_agricola.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                var fullscreen = new ol.control.FullScreen();
                map.addControl(fullscreen);
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}


function crear_z_eriaza()
{
    $.ajax({url: 'get_z_eriaza',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                z_eriaza = JSON.parse(r[0].json_build_object);
                var format_z_eriaza = new ol.format.GeoJSON();
                var features_z_eriaza = format_z_eriaza.readFeatures(z_eriaza,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_z_agricola = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_z_agricola.addFeatures(features_z_eriaza);

                lyr_z_eriaza = new ol.layer.Vector({
                    source:jsonSource_z_agricola,
                    style: stylez_eriaza,
                    title: "Zona Eriaza",
                   
                });
                
                map.addLayer(lyr_z_eriaza);
                var scale = new ol.control.ScaleLine();
                map.addControl(scale);
                var extent = lyr_z_eriaza.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                var fullscreen = new ol.control.FullScreen();
                map.addControl(fullscreen);
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}


function crear_aportes()
{
    $.ajax({url: 'get_aportes',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                llamar_leyenda_aporte();
                z_aportes = JSON.parse(r[0].json_build_object);
                var format_z_aportes = new ol.format.GeoJSON();
                var features_z_aportes = format_z_aportes.readFeatures(z_aportes,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_aportes = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_aportes.addFeatures(features_z_aportes);

                lyr_aportes = new ol.layer.Vector({
                    source:jsonSource_aportes,
                    style: stylez_aportes,
                    title: "Aportes",
                   
                });
                
                map.addLayer(lyr_aportes);
                var scale = new ol.control.ScaleLine();
                map.addControl(scale);
                var extent = lyr_aportes.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                var fullscreen = new ol.control.FullScreen();
                map.addControl(fullscreen);
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function  llamar_leyenda_aporte()
{
    $.ajax({url: 'get_leyenda_aportes',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                $("#legend").html("");
                html="";
                r.forEach(function(element) 
                {
                    html=html+'<div >\n\
                                <div class="col-xs-3"><label style="background-color: rgba('+element.color.trim()+',1); width: 15px !important ; height: 15px !important; margin-left:5px; margin-top:5px"></label></div>    \n\
                                    <div class="col-xs-9"><label class="checkbox inline-block" style="padding-left: 0px; font-size:8px" placehoder="'+element.layer.trim()+'">\n\
                                        '+element.layer.trim()+'    ('+element.total+')\n\
                                    </label></div>\n\
                                </div>';
                });
                $("#legend").html(html);
                $("#legend").show();
            }
        });
}

function stylez_aportes(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#333',
            width: 1,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba('+feature.get('color')+' , 1)'
        }),
        text: new ol.style.Text({
            fill: new ol.style.Fill({
                color: 'white',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 2,
                lineCap: 'butt',
            }),
            text: map.getView().getZoom() > 14 ? feature.get('layer') : ''
        })
    });
}


function crear_pdm_zonificacion()
{
    
    $.ajax({url: 'mapa_cris_getpdmzonificacion',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                zonificacion_bd = JSON.parse(r[0].json_build_object);
                var format_zonificacion = new ol.format.GeoJSON();
                var features_zonificacion = format_zonificacion.readFeatures(zonificacion_bd,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_zonificacion = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_zonificacion.addFeatures(features_zonificacion);

                lyr_pdm_zonificacion = new ol.layer.Vector({
                    source:jsonSource_zonificacion,
                    style: stylez_zonificacion,
                    title: "Zonificación",
                   
                });
                
                map.addLayer(lyr_pdm_zonificacion);
                var scale = new ol.control.ScaleLine();
                map.addControl(scale);
                var extent = lyr_pdm_zonificacion.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                var fullscreen = new ol.control.FullScreen();
                map.addControl(fullscreen);
                MensajeDialogLoadAjaxFinish('map');
                
            }
        });
}
function stylez_zonificacion(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'rgba('+feature.get('color2')+')',
            width: 1,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba('+feature.get('color2')+', 0.8)'
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('zonificaci') : feature.get('id_zonif')
             
        })
    });
}
function crear_pdm_plan_vial()
{
    $.ajax({url: 'getpdm_plan_vial',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                geojson_plan_vial = JSON.parse(r[0].json_build_object);
                var format_plan_vial= new ol.format.GeoJSON();
                var features_plan_vial = format_plan_vial.readFeatures(geojson_plan_vial,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_plan_vial = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_plan_vial.addFeatures(features_plan_vial);
                lyr_pdm_plan_vial = new ol.layer.Vector({
                    source:jsonSource_plan_vial,
                    style: styleplanvial,
                    title: "Plan Vial"
                });
                map.addLayer(lyr_pdm_plan_vial);
                var extent = lyr_pdm_plan_vial.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
              
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function styleplanvial(feature, resolution){
    
    return new ol.style.Style({
       stroke: new ol.style.Stroke({
        color: feature.get('color'),
        width: 3
      }),
        text: new ol.style.Text({
            Placement: 'line',
            textAlign: "center",
            text: feature.get('layer'),
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

function crearcolegios()
{
    $.ajax({url: 'getcolegios',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                geojson_colegios = JSON.parse(r[0].json_build_object);
                var format_colegios= new ol.format.GeoJSON();
                var features_colegios = format_colegios.readFeatures(geojson_colegios,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_colegios = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_colegios.addFeatures(features_colegios);
                lyr_colegios = new ol.layer.Vector({
                    source:jsonSource_colegios,
                    style: stylecolegios,
                    title: "Colegios"
                });
                map.addLayer(lyr_colegios);
                var extent = lyr_colegios.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function stylecolegios(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 16 ? 0.05 : 0.07,
          src: 'img/recursos/colegio.png',
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
function crearhospitales()
{
    $.ajax({url: 'gethospitales',
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
                lyr_hospitales = new ol.layer.Vector({
                    source:jsonSource_salud,
                    style: stylehospitales,
                    title: "Hospitales"
                });
                map.addLayer(lyr_hospitales);
                var extent = lyr_hospitales.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function stylehospitales(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 16 ? 0.05 : 0.07,
          src: 'img/recursos/hospital.png',
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
function crearcomisaria()
{
    $.ajax({url: 'getcomisarias',
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
                    title: "Comisarias"
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

function crear_quebrada()
{
    $.ajax({url: 'mapa_cris_getquebradas',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                quebrada = JSON.parse(r[0].json_build_object);
                var format_quebrada = new ol.format.GeoJSON();
                var features_quebrada = format_quebrada.readFeatures(quebrada,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_quebrada = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_quebrada.addFeatures(features_quebrada);

                lyr_quebradas = new ol.layer.Vector({
                    source:jsonSource_quebrada,
                    style: stylequebrada,
                    title: "Quebradas",
                   
                });
                
                map.addLayer(lyr_quebradas);
                var scale = new ol.control.ScaleLine();
                map.addControl(scale);
                var extent = lyr_quebradas.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                var fullscreen = new ol.control.FullScreen();
                map.addControl(fullscreen);
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}

function stylequebrada(feature, resolution){
    if(feature.get('refname')==null)
    {
        texto="-";
    }
    else
    {
        texto=feature.get('refname');
    }
    return new ol.style.Style({
       stroke: new ol.style.Stroke({
        color: "#008000",
        width: 3
      }),
        text: new ol.style.Text({
            Placement: 'line',
            textAlign: "center",
            text: map.getView().getZoom() > 12 ? texto: '',
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
function crear_topografía()
{
    $.ajax({url: 'mapa_cris_gettopografia',
            type: 'GET',
//            async: false,
            success: function(r)
            {
                topografia = JSON.parse(r[0].json_build_object);
                var format_topografia = new ol.format.GeoJSON();
                var features_topografia = format_topografia.readFeatures(topografia,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_topografia = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_topografia.addFeatures(features_topografia);

                lyr_topografia = new ol.layer.Vector({
                    source:jsonSource_topografia,
                    style: styletopo,
                    title: "Topografia",
                   
                });
                
                map.addLayer(lyr_topografia);
                var scale = new ol.control.ScaleLine();
                map.addControl(scale);
                var extent = lyr_topografia.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                var fullscreen = new ol.control.FullScreen();
                map.addControl(fullscreen);
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}

function styletopo(feature, resolution){
    if(feature.get('layer')==null)
    {
        texto="-";
    }
    else
    {
        texto=feature.get('layer');
    }
    return new ol.style.Style({
       stroke: new ol.style.Stroke({
        color: "#6666ff",
        width: 3
      }),
        text: new ol.style.Text({
            Placement: 'line',
            textAlign: "center",
            text: map.getView().getZoom() > 12 ? texto: '',
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





function crear_carta_nacional()
{ 
//    map.removeLayer(lyr_cotas);
//    map.removeLayer(lyr_cuadra);
//    map.removeLayer(lyr_curvas);
//    map.removeLayer(lyr_lagos);
//    map.removeLayer(lyr_rios);
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_cua',
            type: 'get',
          
            success: function (data) {
                var format_cua = new ol.format.GeoJSON();
                var features_cua= format_cua.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_cua = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_cua.addFeatures(features_cua);
                lyr_cuadra = new ol.layer.Vector({
                    source:jsonSource_cua,
                    style: stylecua,
                    title: "Cuadro"
                });

                map.addLayer(lyr_cuadra);
                var extent = lyr_cuadra.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                obtenercurva();
                //MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún cotas.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}
function stylecua(feature, resolution){
    
    return new ol.style.Style({
       stroke: new ol.style.Stroke({
        color: "#008000",
        width: 3
      })
    });
}

function obtenercurva()
{ 
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_curvas',
            type: 'get',
          
            success: function (data) {
                var format_curva = new ol.format.GeoJSON();
                var features_curva= format_curva.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_curva = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_curva.addFeatures(features_curva);
                lyr_curvas = new ol.layer.Vector({
                    source:jsonSource_curva,
                    style: stylecurva,
                    title: "Curvas"
                });

                map.addLayer(lyr_curvas);
                obtenercota();
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún cotas.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}
function stylecurva(feature, resolution){
    
    return new ol.style.Style({
       stroke: new ol.style.Stroke({
        color: "#008000",
        width: 1
      })
    });
}
function obtenercota()
{ 

    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_cotas',
            type: 'get',
          
            success: function (data) {
                var format_cotas = new ol.format.GeoJSON();
                var features_cotas= format_cotas.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_cotas = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_cotas.addFeatures(features_cotas);
                lyr_cotas = new ol.layer.Vector({
                    source:jsonSource_cotas,
                    style: stylecotas,
                    title: "Cotas"
                });

                map.addLayer(lyr_cotas);
                obtenerlagos();
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún cotas.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}
function stylecotas(feature, resolution){
    return new ol.style.Style({
        image: new ol.style.Circle({
            fill: new ol.style.Fill({
                color: 'rgba(4, 164, 180  , 0.3)',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 2,
                lineCap: 'butt',
            }),
            radius: 5
        })
    });
}
function obtenerlagos()
{ 

    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_lagos',
            type: 'get',
          
            success: function (data) {
                var format_lagos = new ol.format.GeoJSON();
                var features_lagos= format_lagos.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_lagos = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_lagos.addFeatures(features_lagos);
                lyr_lagos = new ol.layer.Vector({
                    source:jsonSource_lagos,
                    style: stylez_lago,
                    title: "Lagos"
                });

                map.addLayer(lyr_lagos);
                obtenerrios();
                //MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún cotas.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}
function stylez_lago(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#000000',
            width: 2,
            lineCap: 'butt'
        }),
        fill: new ol.style.Fill({
            color: '#EA7D09'
        })
    });
}

function obtenerrios()
{ 
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_rios',
            type: 'get',
          
            success: function (data) {
                var format_rios = new ol.format.GeoJSON();
                var features_rios= format_rios.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_rios = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_rios.addFeatures(features_rios);
                lyr_rios = new ol.layer.Vector({
                    source:jsonSource_rios,
                    style: stylerios,
                    title: "Rios"
                });

                map.addLayer(lyr_rios);
                //obtenercota();
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún cotas.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}
function stylerios(feature, resolution){
    if(feature.get('nombre')==null)
    {
     texto="";
    }
    else
    {
        texto=feature.get('nombre');
    }
    return new ol.style.Style({
       stroke: new ol.style.Stroke({
        color: "blue",
        width: 2
      }),
            text: new ol.style.Text({
            Placement: 'line',
            textAlign: "center",
            text: texto,
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
function crear_espe_urba()
{ 
     $("#dlg_selecciona_sector").dialog("close");
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_espe_urba',
            type: 'get',
            data: {codigo: $("#selsec option:selected").text()},
            success: function (data) {
                var format_urb = new ol.format.GeoJSON();
                var features_urb= format_urb.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_urb = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_urb.addFeatures(features_urb);
                lyr_esp_urba = new ol.layer.Vector({
                    source:jsonSource_urb,
                    style: stylez_expe,
                    title: "Expediente Urbano"
                });

                map.addLayer(lyr_esp_urba);
                var extent = lyr_esp_urba.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
               
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún cotas.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}
function stylez_expe(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#000000',
            width: 2,
            lineCap: 'butt'
        }),
        fill: new ol.style.Fill({
            color: 'rgba(9, 115, 234, 0.5)'
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 16 ? feature.get('id_lote') : ''
             
        })
    });
}

function crear_exta_mat()
{ 
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_extrac_pg',
            type: 'get',
            success: function (data) {
                var format = new ol.format.GeoJSON();
                var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource.addFeatures(features);
                lyr_extra_mat = new ol.layer.Vector({
                    source:jsonSource,
                    style: stylez_extrac_poli,
                    title: "Extracción Poligono"
                });

                map.addLayer(lyr_extra_mat);
                var extent = lyr_extra_mat.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                crear_exta_mat_lineas();
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}
function stylez_extrac_poli(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#000000',
            width: 1,
            lineCap: 'butt'
        }),
        fill: new ol.style.Fill({
            color: 'rgba(9, 234, 217, 0.5)'
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('nombre') : ''
             
        })
    });
}

function crear_exta_mat_lineas()
{ 
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_extrac_pl',
            type: 'get',
            success: function (data) {
                var format = new ol.format.GeoJSON();
                var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource.addFeatures(features);
                lyr_extra_mat_lin = new ol.layer.Vector({
                    source:jsonSource,
                    style: stylez_extrac_linea,
                    title: "Extracción Lineas"
                });

                map.addLayer(lyr_extra_mat_lin);
                var extent = lyr_extra_mat_lin.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                crear_exta_mat_puntos();
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}
function stylez_extrac_linea(feature, resolution){
    return new ol.style.Style({
       stroke: new ol.style.Stroke({
        color: "blue",
        width: 1
      })
    });
}

function crear_exta_mat_puntos()
{ 
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_extrac_pt',
            type: 'get',
            success: function (data) {
                var format = new ol.format.GeoJSON();
                var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource.addFeatures(features);
                lyr_extra_mat_pun = new ol.layer.Vector({
                    source:jsonSource,
                    style: stylez_extrac_punto,
                    title: "Extracción Puntos"
                });

                map.addLayer(lyr_extra_mat_pun);
                var extent = lyr_extra_mat_pun.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
               
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}
function stylez_extrac_punto(feature, resolution){
    return new ol.style.Style({
        image: new ol.style.Circle({
            fill: new ol.style.Fill({
                color: 'rgba(4, 164, 180  , 0.3)',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 2,
                lineCap: 'butt',
            }),
            radius: 5
        })
    });
}


function crear_puntos_geo()
{ 
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_puntosgeo',
            type: 'get',
            success: function (data) {
                var format = new ol.format.GeoJSON();
                var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource.addFeatures(features);
                lyr_puntos_geo = new ol.layer.Vector({
                    source:jsonSource,
                    style: stylez_puntogeo,
                    title: "Puntos Geodésicos"
                });

                map.addLayer(lyr_puntos_geo);
                var extent = lyr_puntos_geo.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                crear_puntos_geo_control();
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
            }
        });
}
function stylez_puntogeo(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 16 ? 0.1 : 0.05,
          src: 'img/recursos/triangulo.png',
        })
      });
   
}


function crear_puntos_geo_control()
{ 
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_puntosgeo_control',
            type: 'get',
            success: function (data) {
                var format = new ol.format.GeoJSON();
                var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource.addFeatures(features);
                lyr_puntos_geo_control = new ol.layer.Vector({
                    source:jsonSource,
                    style: stylez_puntogeo_control,
                    title: "Puntos Geodésicos Control"
                });
                map.addLayer(lyr_puntos_geo_control);
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
            }
        });
}
function stylez_puntogeo_control(feature, resolution){
    return new ol.style.Style({
        image: new ol.style.Circle({
            fill: new ol.style.Fill({
                color: 'white',
            }),
            stroke: new ol.style.Stroke({
                color: 'black',
                width: 2,
                lineCap: 'butt',
            }),
            radius: 5
        })
    });
}
function crear_lotes_rurales()
{
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_lotes_rurales',
            type: 'get',
            success: function (data) {
                var format = new ol.format.GeoJSON();
                var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                    {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource.addFeatures(features);
                lyr_lotes_rurales = new ol.layer.Vector({
                    source:jsonSource,
                    style: stylez_lote_rural,
                    title: "Lotes Rurales"
                });
                map.addLayer(lyr_lotes_rurales);
                var extent = lyr_lotes_rurales.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
            }
        });
}
function stylez_lote_rural(feature, resolution) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#109528',
            width: 1,
            lineCap: 'butt'
        }),
        fill: new ol.style.Fill({
            color: 'rgba(16, 149, 40  , 0.5)'
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('uni_catas') : ''
             
        })
    });
}


aux_haburb=0;
function crear_constancias_mapa()
{
    $("#inp_habilitacion").show();
    $("#legend").html("");
    html=
        html='<div >\n\
                    <ul>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_map_cons_2015" onchange="valida_capa('+"'chk_map_cons_2015'"+')">\n\
                                    <i></i>\n\
                                    2015\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_map_cons_2016" onchange="valida_capa('+"'chk_map_cons_2016'"+')">\n\
                                    <i></i>\n\
                                    2016\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_map_cons_2017" onchange="valida_capa('+"'chk_map_cons_2017'"+')">\n\
                                    <i></i>\n\
                                    2017\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_map_cons_2018" onchange="valida_capa('+"'chk_map_cons_2018'"+')">\n\
                                    <i></i>\n\
                                    2018\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                    </ul>\n\
            </div>';
    $("#legend").html(html);
    $("#legend").show();
    
    if(aux_haburb==0)
    {
        aux_haburb=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');
    
    
}
function crea_mapa_constancias(anio)
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("Seleccione Hablitacion","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        $("#chk_map_cons_2015,#chk_map_cons_2016,#chk_map_cons_2017,#chk_map_cons_2018").prop("checked", false);
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_map_constancias/'+anio+'/'+$("#hidden_inp_habilitacion").val(),
            type: 'get',
            success: function (data) {
                if(data==0)
                {
                    MensajeAlerta('Constancias','No se encontró ningúna constancia en esta habilitación.');
                }
                else
                {
                    var format = new ol.format.GeoJSON();
                    var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource.addFeatures(features);
                    if(anio==2015)
                    {
                        lyr_map_cons_2015 = new ol.layer.Vector({
                            source:jsonSource,
                            style: stylez_constancias,
                            title: "Constancias 2015"
                        });
                        map.addLayer(lyr_map_cons_2015);
                        var extent = lyr_map_cons_2015.getSource().getExtent();
                    }
                    if(anio==2016)
                    {
                        lyr_map_cons_2016 = new ol.layer.Vector({
                            source:jsonSource,
                            style: stylez_constancias,
                            title: "Constancias 2016"
                        });
                        map.addLayer(lyr_map_cons_2016);
                        var extent = lyr_map_cons_2016.getSource().getExtent();
                    }
                    if(anio==2017)
                    {
                        lyr_map_cons_2017 = new ol.layer.Vector({
                            source:jsonSource,
                            style: stylez_constancias,
                            title: "Constancias 2017"
                        });
                        map.addLayer(lyr_map_cons_2017);
                        var extent = lyr_map_cons_2017.getSource().getExtent();
                    }
                    if(anio==2018)
                    {
                        lyr_map_cons_2018 = new ol.layer.Vector({
                            source:jsonSource,
                            style: stylez_constancias,
                            title: "Constancias 2018"
                        });
                        map.addLayer(lyr_map_cons_2018);
                        var extent = lyr_map_cons_2018.getSource().getExtent();
                    }
                    map.getView().fit(extent, map.getSize());
                }
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
            }
        });
}

function stylez_constancias(feature, resolution) {
    if(feature.get('nro_constancia')==null)
    {
        texto="";
    }
    else
    {
        texto=feature.get('nro_constancia');
    }
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'rgba('+feature.get('color')+' , 0.5)',
            width: 1,
            lineCap: 'butt'
        }),
        fill: new ol.style.Fill({
            color: 'rgba('+feature.get('color')+ ' , 0.5)'
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? texto : ''
             
        })
    });
}

function verpdf(ruta)
{
    
    crear_dlg("dlg_pdf",1000,"Ver Información");
    MensajeDialogLoadAjax('iframe_pdf', '.:: Cargando ...');
    var iFrameObj = document.getElementById('iframe_pdf'); 
    if(ruta=="habilitaciones")
    {
        iFrameObj.src = "img/recursos/habilitaciones/"+$("#id_agencia").val()+".pdf"; 
    }
    else
    {
        iFrameObj.src = "img/recursos/"+ruta; 
    }
    
    $(iFrameObj).load(function() 
    { 
        MensajeDialogLoadAjaxFinish('iframe_pdf');
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
                            return false;
                        }
                    });
                }
            });
        }
        
        
var lyr_sectores_cat1;        
function traer_hab_by_id(id,tip)
{
    if(lyr_sectores_cat1)
    {
        map.removeLayer(lyr_sectores_cat1);
        map.removeLayer(lyr_lotes3);
    }
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
                        traer_lote_by_hab(id,tip);

                    }
                });
    }
function traer_lote_by_hab(id,tip)
{
    if(tip==1)
    {
        nombre="lotes constancias";
    }
    else
    {
        nombre=lotes;
    }
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
                    title: nombre
                });
                map.addLayer(lyr_lotes3);
                MensajeDialogLoadAjaxFinish('dlg_map');

            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró ningún predio.');
            }
        });
}

//LICENCIAS EDIFICACION
aux_haburb_licencias=0;
function crear_mapa_licencias()
{
    $("#inp_habilitacion").show();
    $("#legend").html("");
    html=
        html='<div >\n\
                    <ul>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_amarillo" onchange="valida_capa('+"'chk_amarillo'"+')">\n\
                                    <i></i>\n\
                                    Amarillo\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_verde" onchange="valida_capa('+"'chk_verde'"+')">\n\
                                    <i></i>\n\
                                    Verde\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_rojo" onchange="valida_capa('+"'chk_rojo'"+')">\n\
                                    <i></i>\n\
                                    Rojo\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                    </ul>\n\
            </div>';
    $("#legend").html(html);
    $("#legend").show();
    
    if(aux_haburb_licencias==0)
    {
        aux_haburb_licencias=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');
    
    
}

function crear_semaforo_mapa_licencias(color)
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("Seleccione Hablitacion","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        $("#chk_rojo,#chk_amarillo,#chk_verde").prop("checked", false);
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_mapa_licencias_eficiacion/'+color+'/'+$("#hidden_inp_habilitacion").val(),
            type: 'get',
            success: function (data) {
                if(data==0)
                {
                    MensajeAlerta('Licencias','No Se Encontró Licencias en esta Habilitación.');
                }
                else
                {
                    var format = new ol.format.GeoJSON();
                    var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource.addFeatures(features);
                    if(color == 1)
                    {
                        lyr_map_edificaciones_amarillo = new ol.layer.Vector({
                            source:jsonSource,
                            style: semaforo_amarillo,
                            title: "Verificacion Administrativa"
                        });
                        map.addLayer(lyr_map_edificaciones_amarillo);
                        var extent = lyr_map_edificaciones_amarillo.getSource().getExtent();
                    }
                    if(color == 2)
                    {
                        lyr_map_edificaciones_verde = new ol.layer.Vector({
                            source:jsonSource,
                            style: semaforo_verde,
                            title: "Verificacion Tecnica"
                        });
                        map.addLayer(lyr_map_edificaciones_verde);
                        var extent = lyr_map_edificaciones_verde.getSource().getExtent();
                    }
                    if(color == 3)
                    {
                        lyr_map_edificaciones_rojo = new ol.layer.Vector({
                            source:jsonSource,
                            style: semaforo_rojo,
                            title: "Emitir Resolucion"
                        });
                        map.addLayer(lyr_map_edificaciones_rojo);
                        var extent = lyr_map_edificaciones_rojo.getSource().getExtent();
                    }
                    map.getView().fit(extent, map.getSize());
                }
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
            }
        });
}

function semaforo_amarillo(feature, resolution) {
    
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#C1BF28',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(243, 156, 18 , 0.5)',
        })
    });
    
}

function semaforo_rojo(feature, resolution) {
    
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#C1BF28',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(169, 50, 38, 0.5)',
        })
    });
    
}

function semaforo_verde(feature, resolution) {
    
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: '#C1BF28',
            width: 2,
            lineCap: 'butt',
        }),
        fill: new ol.style.Fill({
            color: 'rgba(25, 111, 61, 0.5)',
        })
    });
    
}

//HABILITACIONES URBBBBBBBBBBB
function crear_mapa_mod_hab_urb()
{

    $("#legend").html("");
    html=
        html='<div >\n\
                    <ul>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_amarillo_mod_hab_urb" onchange="valida_capa('+"'chk_amarillo_mod_hab_urb'"+')">\n\
                                    <i></i>\n\
                                    Amarillo\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_verde_mod_hab_urb" onchange="valida_capa('+"'chk_verde_mod_hab_urb'"+')">\n\
                                    <i></i>\n\
                                    Verde\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_rojo_mod_hab_urb" onchange="valida_capa('+"'chk_rojo_mod_hab_urb'"+')">\n\
                                    <i></i>\n\
                                    Rojo\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                    </ul>\n\
            </div>';
    $("#legend").html(html);
    $("#legend").show();
    
    
    MensajeDialogLoadAjaxFinish('map');
    
    
}

function crear_semaforo_mapa_mod_hab_urb(color)
{
    
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'get_map_mod_hab_urb/'+color,
            type: 'get',
            success: function (data) {
                if(data==0)
                {
                    MensajeAlerta('Habilitaciones','No Se Encontró  Habilitación.');
                }
                else
                {
                    var format = new ol.format.GeoJSON();
                    var features= format.readFeatures(JSON.parse(data[0].json_build_object),
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource.addFeatures(features);
                    if(color == 'amarillo')
                    {
                        lyr_map_mod_hab_urb_amarillo = new ol.layer.Vector({
                            source:jsonSource,
                            style: semaforo_amarillo,
                            title: "Verificacion Administrativa"
                        });
                        map.addLayer(lyr_map_mod_hab_urb_amarillo);
                        var extent = lyr_map_mod_hab_urb_amarillo.getSource().getExtent();
                    }
                    if(color == 'verde')
                    {
                        lyr_map_mod_hab_urb_verde = new ol.layer.Vector({
                            source:jsonSource,
                            style: semaforo_verde,
                            title: "Verificacion Tecnica"
                        });
                        map.addLayer(lyr_map_mod_hab_urb_verde);
                        var extent = lyr_map_mod_hab_urb_verde.getSource().getExtent();
                    }
                    if(color == 'rojo')
                    {
                        lyr_map_mod_hab_urb_rojo = new ol.layer.Vector({
                            source:jsonSource,
                            style: semaforo_rojo,
                            title: "Emitir Resolucion"
                        });
                        map.addLayer(lyr_map_mod_hab_urb_rojo);
                        var extent = lyr_map_mod_hab_urb_rojo.getSource().getExtent();
                    }
                    map.getView().fit(extent, map.getSize());
                }
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Error','Tiempo de espera agotado, actualizar.');
            }
        });
}


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

var lyr_map_gopi_perfiles_evaluacion;
var lyr_map_gopi_perfiles_pendiente;
var lyr_map_gopi_perfiles_aprobado;

var lyr_map_gopi_mantenimiento_inicio;
var lyr_map_gopi_mantenimiento_ejecucion;
var lyr_map_gopi_mantenimiento_paralizada;
var lyr_map_gopi_mantenimiento_culminada;
var lyr_map_gopi_mantenimiento_recepcionada;
var lyr_map_gopi_mantenimiento_liquidada;
var lyr_map_gopi_mantenimiento_entregada;

var lyr_map_gopi_obra_inicio;
var lyr_map_gopi_obra_ejecucion;
var lyr_map_gopi_obra_paralizada;
var lyr_map_gopi_obra_culminada;
var lyr_map_gopi_obra_recepcionada;
var lyr_map_gopi_obra_liquidada;
var lyr_map_gopi_obra_entregada;

var lyr_map_gsc_str_mal_estado;
var lyr_map_gsc_riesgo_derrum;
var lyr_map_gsc_caida_huayco;


var aux_constancias=0;
map.on('singleclick', function(evt) {
    if(inicio_largo==0&&inicio_coordenadas==0)
    {
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
                
                if(layer.get('title')=='gerencia_administracion_tributaria'&&mostrar==0)
                {
                    mostrar=1;
                    id_hab_urb = $('#hidden_inp_habilitacion_adm_tributaria').val();    
                                      
//                    $.ajax({url: 'asesoria_legal/'+id_hab_urb,
//                        type: 'GET',
//                        success: function(data)
//                        {          
//                            $("#dlg_descripcion").val(data[0].descripcion);
//                            MensajeDialogLoadAjaxFinish('dlg_nuevo_caso');
//                        },
//                        error: function(data) {
//                            mostraralertas("Hubo un Error, Comunicar al Administrador");
//                            console.log('error');
//                            console.log(data);
//                            MensajeDialogLoadAjaxFinish('dlg_nuevo_caso');
//                        }
//                    });
                    $('#dlg_geren_adm_tri_0').text(Math.round(Math.random()* (100-50) + 180));   
                    $('#dlg_geren_adm_tri_1').text(Math.round(Math.random()* (100-50) + 180));  
                    $('#dlg_geren_adm_tri_2').text(Math.round(Math.random()* (100-50) + 180)); 
                    $('#dlg_geren_adm_tri_3').text(Math.round(Math.random()* (20-6) + 15)); 
                    $('#dlg_geren_adm_tri_4').text(Math.round(Math.random()* (20-6) + 15)); 
                    $('#dlg_geren_adm_tri_5').text(Math.round(Math.random()* (100-50) + 180)); 
                    $('#dlg_geren_adm_tri_6').text(Math.round(Math.random()* (100-50) + 180)); 
                    $('#dlg_geren_adm_tri_7').text(Math.round(Math.random()* (100-50) + 180)); 
                    $('#dlg_geren_adm_tri_8').text(Math.round(Math.random()* (20-6) + 15)); 
                    
                    
                    crear_dlg("dlg_gerencia_adm_tributaria",1000,"INFORMACION DE HABILITACION");
                    return false;
                }
                
                if(layer.get('title')=='gopi_perfiles_evaluacion'||layer.get('title')=='gopi_perfiles_pendiente'||layer.get('title')=='gopi_perfiles_aprobado'&&mostrar==0)
                {
                    mostrar=1;
                    $("#id_gopi_perfil").val(feature.get('id_perfil'));
                    $("#dlg_gopi_perfiles_dni").text(feature.get('nro_doc_persona'));
                    $("#dlg_gopi_perfiles_nombre").text(feature.get('persona'));
                    $("#dlg_gopi_perfiles_codigo_catastral").text(feature.get('ubicacion'));
                    $("#dlg_gopi_perfiles_hab_urb").text(feature.get('nomb_hab_urba'));
                    $("#dlg_gopi_perfiles_codigo_snip").text(feature.get('codigo_snip'));
                    $("#dlg_gopi_perfiles_nombre_pip").text(feature.get('nombre_pip'));
                    $("#dlg_gopi_perfiles_monto_perfil").text(feature.get('monto_perfil'));
                    $("#dlg_gopi_perfiles_respon_funcional").text(feature.get('responsabilidad_func'));
                    $("#dlg_gopi_perfiles_uni_formuladora").text(feature.get('unidad_form'));
                    $("#dlg_gopi_perfiles_uni_ejecutora").text(feature.get('unidad_ejecutora'));
                    $("#dlg_gopi_perfiles_nivel").text(feature.get('nivel'));
                    $("#dlg_gopi_perfiles_num_beneficiarios").text(feature.get('num_beneficiarios'));
                    $("#dlg_gopi_perfiles_cant_alternativas").text(feature.get('cantidad'));
                    $("#dlg_gopi_perfiles_monto").text(feature.get('monto'));
                    if (feature.get('viabilidad') == '1') {
                        $("#dlg_gopi_perfiles_viabilidad").text('SI');
                    }else{
                        $("#dlg_gopi_perfiles_viabilidad").text('NO');
                    }
                                  
                    crear_dlg("dlg_gopi_perfiles",1200,"GOPI - PERFILES");
                    return false;
                }
                
                if(layer.get('title')=='gopi_expedientes_tecnicos'&&mostrar==0)
                {
                    mostrar=1;
                    $("#id_gopi_exp_tecnico").val(feature.get('id_expediente_tecnico'));
                    $("#dlg_gopi_exp_tecnico_dni").text(feature.get('nro_doc_persona'));
                    $("#dlg_gopi_exp_tecnico_nombre").text(feature.get('persona'));
                    $("#dlg_gopi_exp_tecnico_cod_catastral").text(feature.get('ubicacion'));
                    $("#dlg_gopi_exp_tecnico_hab_urb").text(feature.get('nomb_hab_urba'));
                    $("#dlg_gopi_exp_tecnico_monto_exp_tec").text(feature.get('monto_exp_t'));
                    $("#dlg_gopi_exp_tecnico_codigo_snip").text(feature.get('codigo_snip'));
                    $("#dlg_gopi_exp_tecnico_nombre_pip").text(feature.get('nombre_pip'));
                    $("#dlg_gopi_exp_tecnico_monto").text(feature.get('monto'));
                    $("#dlg_gopi_exp_tecnico_descripcion").text(feature.get('descripcion'));
                    $("#dlg_gopi_exp_tecnico_tiempo_ejec").text(feature.get('tiempo_ejecucion'));
                    $("#dlg_gopi_exp_tecnico_aprob").text(feature.get('aprobacion'));
                                  
                    crear_dlg("dlg_gopi_expedientes_tecnicos",1200,"GOPI - EXPEDIENTES TECNICOS");
                    return false;
                }
                
                if(layer.get('title')=='gopi_mantenimiento_inicio'||layer.get('title')=='gopi_mantenimiento_en_ejecucion'||layer.get('title')=='gopi_mantenimiento_paralizada'||layer.get('title')=='gopi_mantenimiento_culminada'||layer.get('title')=='gopi_mantenimiento_recepcionada'||layer.get('title')=='gopi_mantenimiento_liquidada'||layer.get('title')=='gopi_mantenimiento_entregada'&&mostrar==0)
                {
                    mostrar=1;
                    $("#id_gopi_mantenimiento").val(feature.get('id_mantenimiento'));
                    $("#dlg_gopi_mantenimiento_dni_ejec").text(feature.get('dni_ejecutor'));
                    $("#dlg_gopi_mantenimiento_nomb_ejec").text(feature.get('ejecutor'));
                    $("#dlg_gopi_mantenimiento_dni_sup").text(feature.get('dni_supervisor'));
                    $("#dlg_gopi_mantenimiento_nomb_sup").text(feature.get('supervisor'));
                    $("#dlg_gopi_mantenimiento_dni_res").text(feature.get('dni_residente'));
                    $("#dlg_gopi_mantenimiento_nomb_res").text(feature.get('residente'));
                    $("#dlg_gopi_mantenimiento_cod_cat").text(feature.get('ubicacion'));
                    $("#dlg_gopi_mantenimiento_hab_urb").text(feature.get('nomb_hab_urba'));
                    $("#dlg_gopi_mantenimiento_nomb_mant").text(feature.get('nombre'));
                    $("#dlg_gopi_mantenimiento_tip_mant").text(feature.get('tipo_mant'));
                    $("#dlg_gopi_mantenimiento_mod_ejec").text(feature.get('modalidad'));
                    $("#dlg_gopi_mantenimiento_observ").text(feature.get('observacion'));
                    $("#dlg_gopi_mantenimiento_tiem_ejec").text(feature.get('tiempo_ejecucion'));
                    $("#dlg_gopi_mantenimiento_bene").text(feature.get('beneficiarios'));
                    $("#dlg_gopi_mantenimiento_fec_ini").text(feature.get('fecha_inicio'));
                    $("#dlg_gopi_mantenimiento_fec_term").text(feature.get('fecha_termino'));
                    $("#dlg_gopi_mantenimiento_descr").text(feature.get('descripcion'));
                    $("#dlg_gopi_mantenimiento_est_mant").text(feature.get('estado'));
                    $("#dlg_gopi_mantenimiento_av_fis").text(feature.get('avance_fisico'));
                    $("#dlg_gopi_mantenimiento_av_fin").text(feature.get('avance_financiero'));
                    if (feature.get('informe_tecnico') == '1') {
                        $("#dlg_gopi_mantenimiento_inf_tec").text('SI');
                    }else{
                        $("#dlg_gopi_mantenimiento_inf_tec").text('NO');
                    }
                    
                    ver_galeria_fotos(feature.get('id_mantenimiento'),'sub_geren_apoyo_matenimiento','fotos_mantenimiento','dlg_gopi_mantenimiento_fotos');
                                  
                    crear_dlg("dlg_gopi_mantenimientos",1200,"GOPI - MANTENIMIENTOS");
                    return false;
                }
                
                if(layer.get('title')=='gopi_obra_inicio'||layer.get('title')=='gopi_obra_en_ejecucion'||layer.get('title')=='gopi_obra_paralizada'||layer.get('title')=='gopi_obra_culminada'||layer.get('title')=='gopi_obra_recepcionada'||layer.get('title')=='gopi_obra_liquidada'||layer.get('title')=='gopi_obra_entregada'&&mostrar==0)
                {
                    mostrar=1;
                    $("#id_gopi_obra").val(feature.get('id_obra'));
                    $("#dlg_gopi_obra_dni_ejec").text(feature.get('dni_ejecutor'));
                    $("#dlg_gopi_obra_nomb_ejec").text(feature.get('ejecutor'));
                    $("#dlg_gopi_obra_dni_sup").text(feature.get('dni_supervisor'));
                    $("#dlg_gopi_obra_nomb_sup").text(feature.get('supervisor'));
                    $("#dlg_gopi_obra_dni_res").text(feature.get('dni_residente'));
                    $("#dlg_gopi_obra_nomb_res").text(feature.get('residente'));
                    $("#dlg_gopi_obra_cod_cat").text(feature.get('ubicacion'));
                    $("#dlg_gopi_obra_hab_urb").text(feature.get('nomb_hab_urba'));
                    $("#dlg_gopi_obra_nomb_obra").text(feature.get('nombre'));
                    $("#dlg_gopi_obra_tip_obra").text(feature.get('tipo_obra'));
                    $("#dlg_gopi_obra_mod_ejec").text(feature.get('modalidad'));
                    $("#dlg_gopi_obra_monto").text(feature.get('monto'));
                    $("#dlg_gopi_obra_observaciones").text(feature.get('observacion'));
                    $("#dlg_gopi_obra_cod_snip").text(feature.get('codigo_snip'));
                    $("#dlg_gopi_obra_tiem_ejec").text(feature.get('tiempo_ejecucion'));
                    $("#dlg_gopi_obra_beneficiarios").text(feature.get('beneficiarios'));
                    $("#dlg_gopi_obra_fec_ini").text(feature.get('fecha_inicio'));
                    $("#dlg_gopi_obra_fec_term").text(feature.get('fecha_termino'));
                    $("#dlg_gopi_obra_descripcion").text(feature.get('descripcion'));
                    $("#dlg_gopi_obra_est_obra").text(feature.get('estado_obra'));
                    $("#dlg_gopi_obra_av_fis").text(feature.get('avance_fisico'));
                    $("#dlg_gopi_obra_av_fin").text(feature.get('avance_financiero'));
                    if (feature.get('perfil') == '1') {
                        $("#dlg_gopi_obra_perfil").text('SI');
                    }else{
                        $("#dlg_gopi_obra_perfil").text('NO');
                    }
                    if (feature.get('expediente_tecnico') == '1') {
                        $("#dlg_gopi_obra_exp_tec").text('SI');
                    }else{
                        $("#dlg_gopi_obra_exp_tec").text('NO');
                    }
                    
                    ver_galeria_fotos(feature.get('id_obra'),'sub_geren_obras_publicas','fotos_obra','dlg_gopi_obra_fotos');
                                  
                    crear_dlg("dlg_gopi_obras",1200,"GOPI - OBRAS");
                    return false;
                }
                
                if(layer.get('title')=='geren_seg_ciudadana_comisarias'&&mostrar==0)
                {
                    $("#dlg_gsc_comisaria_foto").html("");
                    mostrar=1;
                    $("#id_gsc_comisaria").val(feature.get('id'));
                    $("#dlg_gsc_comisaria_nombre").text(feature.get('nombre'));
                    $("#dlg_gsc_comisaria_ubicacion").text(feature.get('ubicacion'));
                    $("#dlg_gsc_comisaria_nro_efectivos").text(feature.get('nro_efectivos'));
                    $("#dlg_gsc_comisaria_nro_vehiculos").text(feature.get('nro_vehiculos'));
                    $("#dlg_gsc_comisaria_telefono").text(feature.get('telefono'));
                    if (feature.get('foto') == null) 
                    {
                        $("#dlg_gsc_comisaria_foto").attr("src","img/recursos/Home-icon.png");
                    }
                    else
                    {
                        $("#dlg_gsc_comisaria_foto").attr("src","data:image/png;base64,"+feature.get('foto'));
                    }
                    
                    crear_dlg("dlg_gsc_comisarias",1100,"Cerro Colorado - COMISARIAS");
                    jQuery("#table_documentos_comisaria").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=documentos_adj_comisaria&id_comisaria='+feature.get('id') }).trigger('reloadGrid');
                    return false;
                }
                
                if(layer.get('title')=='geren_seg_ciudadana_semaforos'&&mostrar==0)
                {
                    $("#dlg_gsc_semaforos_imagen").html("");
                    mostrar=1;
                    $("#id_gsc_semaforo").val(feature.get('id_semaforo'));
                    $("#dlg_gsc_semaforos_ubicacion").text(feature.get('ubicacion'));
                    $("#dlg_gsc_semaforos_codigo").text(feature.get('cod_semaforo'));
                    $("#dlg_gsc_semaforos_tip_sem").text(feature.get('tipo_semaforo'));
                    $("#dlg_gsc_semaforos_estado").text(feature.get('estado'));
                    $("#dlg_gsc_semaforos_cod_controlador").text(feature.get('cod_controlador'));
                    $("#dlg_gsc_semaforos_controlador").text(feature.get('controlador'));
                    $("#dlg_gsc_semaforos_imagen").attr("src","data:image/png;base64,"+feature.get('imagen'));
                    
                    if (feature.get('peatonal') == '1') {
                        $("#dlg_gsc_semaforos_peatonal").text('SI');
                    }else{
                        $("#dlg_gsc_semaforos_peatonal").text('NO');
                    }
                    
                    crear_dlg("dlg_gsc_semaforos",1100,"GSC - SEMAFOROS");
                    return false;
                }
                
                if(layer.get('title')=='geren_seg_ciudadana_mapa_delitos'&&mostrar==0)
                {
                    mostrar=1;
                    $("#id_gsc_mapa_delito").val(feature.get('id_mapa_delito'));
                    $("#dlg_gsc_map_delito_dni_infractor").text(feature.get('nro_doc_infractor'));
                    $("#dlg_gsc_map_delito_nomb_infractor").text(feature.get('infractor'));
                    $("#dlg_gsc_map_delito_dni_encargado").text(feature.get('nro_doc_encargado')); 
                    $("#dlg_gsc_map_delito_nomb_encargado").text(feature.get('encargado'));
                    $("#dlg_gsc_map_delito_ubicacion").text(feature.get('ubicacion'));
                    $("#dlg_gsc_map_delito_tip_delito").text(feature.get('descripcion'));
                    $("#dlg_gsc_map_delito_fec_reg").text(feature.get('fecha_registro'));
                    $("#dlg_gsc_map_delito_vehiculo").text(feature.get('vehiculo'));
                    $("#dlg_gsc_map_delito_observaciones").text(feature.get('observacion'));
                    
                    traer_foto_gsc_mapa_delito(feature.get('id_mapa_delito'));
                    
                    crear_dlg("dlg_gsc_mapa_delitos",1000,"GSC - MAPA DELITOS");
                    return false;
                }
                
                if(layer.get('title')=='gsc_str_mal_estado'||layer.get('title')=='gsc_riesgo_derrumbe'||layer.get('title')=='gsc_caida_huayco'&&mostrar==0)
                {
                    mostrar=1;
                    $("#id_gsc_zona_riesgo").val(feature.get('id_zona_riesgo'));
                    $("#dlg_gsc_zona_riesgo_dni_prop").text(feature.get('nro_doc_propietario'));
                    $("#dlg_gsc_zona_riesgo_nomb_prop").text(feature.get('propietario'));
                    $("#dlg_gsc_zona_riesgo_ubicacion").text(feature.get('ubicacion'));
                    $("#dlg_gsc_zona_riesgo_tip_riesgo").text(feature.get('descripcion'));
                                  
                    crear_dlg("dlg_gsc_zona_riesgo",1000,"GSC - ZONAS DE RIESGO");
                    return false;
                }
                
                if(layer.get('title')=='gsc_rutas_serenazgo'&&mostrar==0)
                {
                    mostrar=1;
                    $("#id_gsc_ruta_serenazgo").val(feature.get('id_ruta_serenazgo'));
                    $("#dlg_gsc_ruta_serenazgo_ubicacion").text(feature.get('ubicacion'));
                    $("#dlg_gsc_ruta_serenazgo_unidad").text(feature.get('unidad'));
                    $("#dlg_gsc_ruta_serenazgo_placa").text(feature.get('placa'));
                    $("#dlg_gsc_ruta_serenazgo_tipo").text(feature.get('descripcion'));
                    
                    if (feature.get('personal') == '1') {
                        $("#dlg_gsc_ruta_serenazgo_personal").text('SERENAZGO');
                    }else{
                        $("#dlg_gsc_ruta_serenazgo_personal").text('INTEGRADO');
                    }

                    crear_dlg("dlg_gsc_rutas_serenazgo",1000,"GSC - RUTAS DE SERENAZGO");
                    return false;
                }
                
                if(layer.get('title')=='geren_seg_ciudadana_camaras'&&mostrar==0)
                {
                    mostrar=1;
                    $("#id_gsc_camara").val(feature.get('id_mapa_delito'));
                    $("#dlg_gsc_camara_observacion").text(feature.get('observacion'));
                    $("#dlg_gsc_camara_imagen").attr("src","data:image/png;base64,"+feature.get('imagen'));
                    
                    crear_dlg("dlg_gsc_mapa_camaras",1000,"GSC - MAPA CAMARAS");
                    return false;
                }
                
                if(layer.get('title')=='gerencia_procuraduria'&&mostrar==0)
                {
                    mostrar=1;
                    $("#id_procuraduria").val(feature.get('id_procuraduria'));
                    $("#dlg_proc_dni_responsable").text(feature.get('nro_doc_persona'));
                    $("#dlg_proc_nombre_responsable").text(feature.get('persona'));
                    $("#dlg_proc_dni_gestor").text(feature.get('nro_doc_gestor')); 
                    $("#dlg_proc_nombre_gestor").text(feature.get('gestor'));
                    $("#dlg_proc_num_expe").text(feature.get('nro_expediente'));
                    $("#dlg_proc_fec_inicio").text(feature.get('fecha_inicio_tramite'));
                    $("#dlg_proc_cod_catastral").text(feature.get('cod_catastral'));
                    $("#dlg_proc_hab_urb").text(feature.get('nomb_hab_urba'));
                    $("#dlg_proc_tip_sancion").text(feature.get('tipo_sancion'));
                    $("#dlg_proc_materia").text(feature.get('materia'));
                    $("#dlg_proc_proceso").text(feature.get('proceso'));
                    $("#dlg_proc_caso").text(feature.get('caso'));
                    $("#dlg_proc_referencia").text(feature.get('referencia'));
                    $("#dlg_proc_procedimiento").text(feature.get('procedimiento'));
                    
                    crear_dlg("dlg_gerencia_procuraduria",1000,"EXPEDIENTE PROCURADURIA");
                    jQuery("#table_documentos_procuraduria").jqGrid('setGridParam', {url: 'procuraduria/0?grid=documentos_adj&id_procuraduria='+feature.get('id_procuraduria') }).trigger('reloadGrid');
                    return false;
                }
                if(layer.get('title')=='Rutas Barrido'&&mostrar==0)
                {
                    mostrar=1;
                    iniciar_visualizar_mapa_barrido(feature.get('id_ruta_barrido'),feature.get('descripcion'),feature.get('cod_ruta_barrido'))
                    return false;
                }
                if(layer.get('title')=='Rutas Recojo Residuos'&&mostrar==0)
                {
                    mostrar=1;
                    iniciar_visualizar_mapa_recojo(feature.get('id_ruta_recojo'),feature.get('descripcion'),feature.get('cod_ruta_recojo'),feature.get('placa'))
                    return false;
                }
                if(layer.get('title')=='Contenedores'&&mostrar==0)
                {
                    mostrar=1;
                    limpiar_contenedor('dlg_contenedores');
                    $("#foto_contenedor, #cuerpo_obs_contenedores").html("");
                    $("#hidden_contenedor").val(feature.get('id'));
                    iniciar_contenedores(feature.get('id'));
                    return false;
                }
                if(layer.get('title')=='Botaderos'&&mostrar==0)
                {
                    mostrar=1;
                    limpiar_contenedor('dlg_botaderos');
                    $("#foto_botadero, #cuerpo_obs_botaderos").html("");
                    $("#hidden_botadero").val(feature.get('id_botadero'));
                    iniciar_botaderos(feature.get('id_botadero'));
                    return false;
                }
                if(layer.get('title')=='Area Verde'&&mostrar==0)
                {
                    mostrar=1;
                    iniciar_area_verde(feature.get('id_lote'));
                    return false;
                }
                if(layer.get('title')=='MYPES'&&mostrar==0)
                {
                    mostrar=1;
                    iniciar_mypes(feature.get('id_lote'));
                    return false;
                }
                if(layer.get('title')=='Infraestructura Deportiva'&&mostrar==0)
                {
                    mostrar=1;
                    iniciar_infra_deportiva(feature.get('id_lote'));
                    return false;
                }
                
 if(layer.get('title')=='gds_ciam'&&mostrar==0)
                {
                    mostrar=1;
                    $("#inp_cod_catastral_ciam").text(feature.get('cod_catastral'));
                    $("#inp_dni_ciam").text(feature.get('pers_nro_doc'));
                    $("#inp_nombre_ciam").text(feature.get('persona'));
                    $("#inp_fechanac_ciam").text(feature.get('pers_fnac'));
                    $("#inp_direccion_ciam").text(feature.get('direccion'));
                    $("#sel_local_ciam").text(feature.get('descripcion'));                                        
                    crear_dlg("dlg_mapa_ciam",1000,"GDS - MAPA CIAM");
                    return false;
                }
                if(layer.get('title')=='gds_demuna'&&mostrar==0)
                {
                    mostrar=1;
                    $("#inp_cod_catastral_demuna").text(feature.get('cod_catastral'));
                    $("#inp_dni_demuna").text(feature.get('pers_nro_doc'));
                    $("#inp_nombre_demuna").text(feature.get('persona'));
                    $("#inp_fechanac_demuna").text(feature.get('pers_fnac'));
                    $("#inp_direccion_demuna").text(feature.get('direccion'));
                    $("#sel_albergue_demuna").text(feature.get('albergue'));  
                    $("#sel_comisaria_demuna").text(feature.get('nombre'));                                        
                    $("#sel_tipo_delito_demuna").text(feature.get('delito'));                                        

                    crear_dlg("dlg_mapa_demuna",1000,"GDS - MAPA DEMUNA");
                    return false;
                }
                if(layer.get('title')=='gds_omaped'&&mostrar==0)
                {
                    mostrar=1;
                    $("#inp_cod_catastral_omaped").text(feature.get('cod_catastral'));
                    $("#inp_dni_omaped").text(feature.get('pers_nro_doc'));
                    $("#inp_nombre_omaped").text(feature.get('persona'));
                    $("#inp_fechanac_omaped").text(feature.get('pers_fnac'));
                    $("#inp_direccion_omaped").text(feature.get('direccion'));
                    $("#sel_local_omaped").text(feature.get('local'));                                        
                    crear_dlg("dlg_mapa_omaped",1000,"GDS - MAPA OMAPED");
                    return false;
                }
                 if(layer.get('title')=='Bermas'&&mostrar==0)
                {
                    mostrar=1;
                    iniciar_bermas(feature.get('gid'));
                    return false;
                }
                if(layer.get('title')=='Lic. Funcionamiento'&&mostrar==0)
                {
                    mostrar=1;
                    iniciar_lic_fun(feature.get('id_lote'));
                    return false;
                }
                
            });  
    }
    if(inicio_coordenadas==1)
    {
        //alert(evt.coordinate);
        alert(ol.proj.toLonLat(evt.coordinate));
    }
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
    $("#mapa_delito_observaciones").text('');
    $("#seg_ciudadana_foto_mapa_detito").removeAttr("src");
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
            crearvias(0);
        }
        if(check=='chk_nuevo_vias')
        {
            crearvias(0);
            autocompletar_via("inp_vias");
            $("#inp_vias").show();
        }
        if(check=='chk_bermas')
        {
            crearbermas(0);
            autocompletar_via("inp_vias");
            $("#inp_vias").show();
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
        if(check=='chk_map_gerencia_adm_trib')
        {
            crear_mapa_adm_tributaria();
        }
        if(check=='chk_map_gopi_expedientes_tecnicos')
        {
            crear_mapa_gopi_expedientes_tecnicos();
        }
        if(check=='chk_map_gopi_perfiles')
        {
            crear_mapa_gopi_perfiles();
        }
        if(check=='chk_evaluacion')
        {
            crear_semaforo_mapa_gopi_perfiles('EVALUACION');
        }
        if(check=='chk_pendiente')
        {
            crear_semaforo_mapa_gopi_perfiles('PENDIENTE');
        }
        if(check=='chk_aprobado')
        {
            crear_semaforo_mapa_gopi_perfiles('APROBADO');
        }
        if(check=='chk_map_gopi_mantenimientos')
        {
            crear_mapa_gopi_mantenimientos();
        }
        if(check=='chk_inicio')
        {
            crear_estados_mapa_gopi_mantenimiento(1);
        }
        if(check=='chk_en_ejecucion')
        {
            crear_estados_mapa_gopi_mantenimiento(2);
        }
        if(check=='chk_paralizada')
        {
            crear_estados_mapa_gopi_mantenimiento(3);
        }
        if(check=='chk_culminada')
        {
            crear_estados_mapa_gopi_mantenimiento(4);
        }
        if(check=='chk_recepcionada')
        {
            crear_estados_mapa_gopi_mantenimiento(5);
        }
        if(check=='chk_liquidada')
        {
            crear_estados_mapa_gopi_mantenimiento(6);
        }
        if(check=='chk_entregada')
        {
            crear_estados_mapa_gopi_mantenimiento(7);
        }
        if(check=='chk_map_gopi_obras')
        {
            crear_mapa_gopi_obras();
        }
        if(check=='chk_inicio_obra')
        {
            crear_estados_mapa_gopi_obra(1);
        }
        if(check=='chk_en_ejecucion_obra')
        {
            crear_estados_mapa_gopi_obra(2);
        }
        if(check=='chk_paralizada_obra')
        {
            crear_estados_mapa_gopi_obra(3);
        }
        if(check=='chk_culminada_obra')
        {
            crear_estados_mapa_gopi_obra(4);
        }
        if(check=='chk_recepcionada_obra')
        {
            crear_estados_mapa_gopi_obra(5);
        }
        if(check=='chk_liquidada_obra')
        {
            crear_estados_mapa_gopi_obra(6);
        }
        if(check=='chk_entregada_obra')
        {
            crear_estados_mapa_gopi_obra(7);
        }
        if(check=='chk_geren_seg_ciud_comisarias')
        {
            crear_mapa_gsc_comisarias();
        }
        if(check=='chk_geren_seg_ciud_semaforos')
        {
            crear_mapa_gsc_semaforos();
        }
        if(check=='chk_geren_seg_ciud_delitos')
        {
            crear_mapa_gsc_mapa_delitos(1);
        }
        if(check=='chk_geren_seg_ciud_camaras')
        {
            crear_mapa_gsc_mapa_camaras();
        }
        if(check=='chk_map_procuraduria')
        {
            crear_mapa_geren_procuraduria();
        }
        if(check=='chk_rutas_barrido')
        {
            crear_rutas_barrido();
        }
        if(check=='chk_rutas_recojo')
        {
            crear_rutas_recojo();
        }
        if(check=='chk_contendores')
        {
            crear_mapa_contedores();
        }
        if(check=='chk_botaderos')
        {
            crear_mapa_botaderos();
        }
        if(check=='chk_are_verdes')
        {
            crear_mapa_areas_verdes();
        }
        if(check=='chk_mypes')
        {
            crear_mapa_mypes();
        }
        if(check=='chk_infra_deportiva')
        {
            crear_mapa_infra_deportiva();
        }
        if(check=='chk_gduc_salud')
        {
            crear_mapa_gduc_salud();
        }
	if(check=='chk_gduc_educacion')
        {
            crear_mapa_gduc_educacion();
        }
        if(check=='chk_gduc_gubernamental')
        {
            crear_mapa_gduc_gubernamental();
        }
        if(check=='chk_gduc_recreacion')
        {
            crear_mapa_gduc_recreacion();
        }
        if(check=='chk_gduc_equipamiento')
        {
            crear_mapa_gduc_equipamiento();
        }
        if(check=='chk_gduc_financiera')
        {
            crear_mapa_gduc_financiera();
        }
        if(check=='chk_gduc_turistico')
        {
            crear_mapa_gduc_turistico();
        }
        if(check=='chk_geren_seg_ciud_zon_riesgo')
        {
            crear_mapa_gsc_zona_riesgo();
        }
        if(check=='chk_estr_mal_estado')
        {
            crear_estados_mapa_gsc_zona_riesgo(1);
        }
        if(check=='chk_riesgo_derrum')
        {
            crear_estados_mapa_gsc_zona_riesgo(2);
        }
        if(check=='chk_caida_huayco')
        {
            crear_estados_mapa_gsc_zona_riesgo(3);
        }
        if(check=='chk_geren_seg_ciud_rut_serenazgo')
        {
            crear_mapa_gsc_rutas_serenazgo();
        }
        if(check=='chk_lic_fun')
        {
            crear_mapa_lic_fun();
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
        if(check=='chk_nuevo_vias')
        {
            $("#inp_vias").hide();
            map.removeLayer(lyr_vias);
        }
        if(check=='chk_bermas')
        {
            $("#inp_bermas").hide();
            map.removeLayer(lyr_bermas);
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
        if (check== 'chk_map_gerencia_adm_trib') {
            map.removeLayer(lyr_gerencia_adm_tributaria);
            $("#inp_habilitacion_adm_tributaria").hide();
            $("#btn_busqueda").hide();
            $("#anio_pred").show();
        }
        if (check== 'chk_map_gopi_expedientes_tecnicos') 
        {
            map.removeLayer(lyr_gopi_expedientes_tecnicos);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_gopi_exp_tecnico").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_map_gopi_perfiles')
        {
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            map.removeLayer(lyr_map_gopi_perfiles_evaluacion);
            map.removeLayer(lyr_map_gopi_perfiles_pendiente);
            map.removeLayer(lyr_map_gopi_perfiles_aprobado);
            $("#inp_habilitacion,#legend").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_evaluacion')
        {
            map.removeLayer(lyr_map_gopi_perfiles_evaluacion);
        }
        if(check=='chk_pendiente')
        {
            map.removeLayer(lyr_map_gopi_perfiles_pendiente);
        }
        if(check=='chk_aprobado')
        {
            map.removeLayer(lyr_map_gopi_perfiles_aprobado);
        }
        if(check=='chk_map_gopi_mantenimientos')
        {
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            map.removeLayer(lyr_map_gopi_mantenimiento_inicio);
            map.removeLayer(lyr_map_gopi_mantenimiento_ejecucion);
            map.removeLayer(lyr_map_gopi_mantenimiento_paralizada);
            map.removeLayer(lyr_map_gopi_mantenimiento_culminada);
            map.removeLayer(lyr_map_gopi_mantenimiento_recepcionada);
            map.removeLayer(lyr_map_gopi_mantenimiento_liquidada);
            map.removeLayer(lyr_map_gopi_mantenimiento_entregada);
            $("#inp_habilitacion,#legend").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_inicio')
        {
            map.removeLayer(lyr_map_gopi_mantenimiento_inicio);
        }
        if(check=='chk_en_ejecucion')
        {
            map.removeLayer(lyr_map_gopi_mantenimiento_ejecucion);
        }
        if(check=='chk_paralizada')
        {
            map.removeLayer(lyr_map_gopi_mantenimiento_paralizada);
        }
        if(check=='chk_culminada')
        {
            map.removeLayer(lyr_map_gopi_mantenimiento_culminada);
        }
        if(check=='chk_recepcionada')
        {
            map.removeLayer(lyr_map_gopi_mantenimiento_recepcionada);
        }
        if(check=='chk_liquidada')
        {
            map.removeLayer(lyr_map_gopi_mantenimiento_liquidada);
        }
        if(check=='chk_entregada')
        {
            map.removeLayer(lyr_map_gopi_mantenimiento_entregada);
        }
        if(check=='chk_map_gopi_obras')
        {
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            map.removeLayer(lyr_map_gopi_obra_inicio);
            map.removeLayer(lyr_map_gopi_obra_ejecucion);
            map.removeLayer(lyr_map_gopi_obra_paralizada);
            map.removeLayer(lyr_map_gopi_obra_culminada);
            map.removeLayer(lyr_map_gopi_obra_recepcionada);
            map.removeLayer(lyr_map_gopi_obra_liquidada);
            map.removeLayer(lyr_map_gopi_obra_entregada);
            $("#inp_habilitacion,#legend").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_inicio_obra')
        {
            map.removeLayer(lyr_map_gopi_obra_inicio);
        }
        if(check=='chk_en_ejecucion_obra')
        {
            map.removeLayer(lyr_map_gopi_obra_ejecucion);
        }
        if(check=='chk_paralizada_obra')
        {
            map.removeLayer(lyr_map_gopi_obra_paralizada);
        }
        if(check=='chk_culminada_obra')
        {
            map.removeLayer(lyr_map_gopi_obra_culminada);
        }
        if(check=='chk_recepcionada_obra')
        {
            map.removeLayer(lyr_map_gopi_obra_recepcionada);
        }
        if(check=='chk_liquidada_obra')
        {
            map.removeLayer(lyr_map_gopi_obra_liquidada);
        }
        if(check=='chk_entregada_obra')
        {
            map.removeLayer(lyr_map_gopi_obra_entregada);
        }
        if(check=='chk_geren_seg_ciud_comisarias')
        {
            map.removeLayer(lyr_gsc_comisarias);
        }
        if(check=='chk_geren_seg_ciud_semaforos')
        {
            map.removeLayer(lyr_gsc_semaforos);
        }
        if(check=='chk_geren_seg_ciud_delitos')
        {
            map.removeLayer(lyr_gsc_delitos);
            $("#fec_desde,#fec_hasta,#btn_busqueda_delitos").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_geren_seg_ciud_camaras')
        {
            map.removeLayer(lyr_gsc_camaras);
        }
        if(check=='chk_map_procuraduria')
        {
            map.removeLayer(lyr_geren_procuraduria);
            map.removeLayer(lyr_sectores_cat1);
            map.removeLayer(lyr_lotes3);
            $("#inp_habilitacion").hide();
            $("#btn_busqueda_procuraduria").hide();
            $("#anio_pred").show();
        }
        if(check=='chk_rutas_barrido')
        {
            map.removeLayer(lyr_rutas_barrido);
        }
        if(check=='chk_rutas_recojo')
        {
            map.removeLayer(lyr_rutas_recojo);
        }
        if(check=='chk_contendores')
        {
            map.removeLayer(lyr_contenedores);
        }
        if(check=='chk_botaderos')
        {
            map.removeLayer(lyr_contenedores);
        }
        if(check=='chk_are_verdes')
        {
            map.removeLayer(lyr_mapa_areas_verdes);
        }
        if(check=='chk_mypes')
        {
            map.removeLayer(lyr_mypes);
        }
        if(check=='chk_infra_deportiva')
        {
            map.removeLayer(lyr_infra_deportiva);
        }
        if(check=='chk_gduc_salud')
        {
            map.removeLayer(lyr_gduc_salud);
        }
        if(check=='chk_gduc_educacion')
        {
            map.removeLayer(lyr_gduc_educacion);
        }
        if(check=='chk_gduc_equipamiento')
        {
            map.removeLayer(lyr_gduc_equipamiento);
        }
        if(check=='chk_gduc_turistico')
        {
            map.removeLayer(lyr_gduc_turistico);
        }
        if(check=='chk_gduc_recreacion')
        {
            map.removeLayer(lyr_gduc_recreacion);
        }
        if(check=='chk_gduc_gubernamental')
        {
            map.removeLayer(lyr_gduc_gubernamental);
        }
        if(check=='chk_gduc_financiera')
        {
            map.removeLayer(lyr_gduc_financiera);
        }
        if(check=='chk_geren_seg_ciud_zon_riesgo')
        {
            map.removeLayer(lyr_map_gsc_str_mal_estado);
            map.removeLayer(lyr_map_gsc_riesgo_derrum);
            map.removeLayer(lyr_map_gsc_caida_huayco);
            $("#legend").hide();
        }
        if(check=='chk_estr_mal_estado')
        {
            map.removeLayer(lyr_map_gsc_str_mal_estado);
        }
        if(check=='chk_riesgo_derrum')
        {
            map.removeLayer(lyr_map_gsc_riesgo_derrum);
        }
        if(check=='chk_caida_huayco')
        {
            map.removeLayer(lyr_map_gsc_caida_huayco);
        }
        if(check=='chk_geren_seg_ciud_rut_serenazgo')
        {
            map.removeLayer(lyr_gsc_rutas_serenazgo);
        }
        if(check=='chk_lic_fun')
        {
            map.removeLayer(lyr_lic_fun);
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

function crearvias(id)
{
    $.ajax({url: 'getvias_lineas?id='+id,
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
var varcomplete_vias=0;
function autocompletar_via(textbox){
    if(varcomplete_vias==0)
    {
        varcomplete_vias=1;
            $.ajax({
                type: 'GET',
                url: 'vias/0?grid=completar_vias',
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
                            map.removeLayer(lyr_vias);
                            crearvias(ui.item.value);
                            return false;
                        }
                    });
                }
            });
        }
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

//ADMINISTRACION TRIBUTARIA
aux_adm_tributaria=0;
function crear_mapa_adm_tributaria()
{
    $("#inp_habilitacion_adm_tributaria").show();
    $("#btn_busqueda").show();
    $("#anio_pred").hide();
    
    if(aux_adm_tributaria==0)
    {
       aux_adm_tributaria=1;
       autocompletar_haburb('inp_habilitacion_adm_tributaria');
    }
    MensajeDialogLoadAjaxFinish('map'); 
}

var lyr_gerencia_adm_tributaria;
function cargar_habilitacion()
{
    if($("#hidden_inp_habilitacion_adm_tributaria").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion_adm_tributaria");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'gethab_urb_by_id/'+$("#hidden_inp_habilitacion_adm_tributaria").val(),
            type: 'GET',
            success: function(r)
            {
                geojson_adm_tributaria = JSON.parse(r[0].json_build_object);
                var format_adm_tributaria = new ol.format.GeoJSON();
                var features_adm_tributaria = format_adm_tributaria.readFeatures(geojson_adm_tributaria,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_adm_tributaria = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_adm_tributaria.addFeatures(features_adm_tributaria);
                lyr_gerencia_adm_tributaria = new ol.layer.Vector({
                    source:jsonSource_adm_tributaria,
                    style: estilos_adm_tributaria,
                    title: "gerencia_administracion_tributaria"
                });
                map.addLayer(lyr_gerencia_adm_tributaria);
                var extent = lyr_gerencia_adm_tributaria.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
              
                MensajeDialogLoadAjaxFinish('map');
            }
        });
    //alert($('#hidden_inp_habilitacion_adm_tributaria').val());
}

// GERENCIA OBRAS PUBLICAS E INFRAESTRUCTURA
// GOPI - EXPEDIENTES TECNICOS


function crear_mapa_gopi_expedientes_tecnicos()
{
    var aux_haburb_gopi_perfiles=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_gopi_exp_tecnico").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_gopi_perfiles==0)
    {
        aux_haburb_gopi_perfiles=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}

var lyr_gopi_expedientes_tecnicos;
function cargar_habilitacion_gopi_exp_tecnico()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'sub_geren_estudios_proyectos/0?mapa=expedientes_tecnicos&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('EXPEDIENTES TECNICOS','NO SE ENCONTRO EXPEDIENTES TECNICOS EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_gopi_exp_tecnico = JSON.parse(data[0].json_build_object);
                    var format_gopi_exp_tecnico = new ol.format.GeoJSON();
                    var features_gopi_exp_tecnico = format_gopi_exp_tecnico.readFeatures(geojson_gopi_exp_tecnico,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gopi_exp_tecnico = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gopi_exp_tecnico.addFeatures(features_gopi_exp_tecnico);
                    lyr_gopi_expedientes_tecnicos = new ol.layer.Vector({
                        source:jsonSource_gopi_exp_tecnico,
                        style: estilos_adm_tributaria,
                        title: "gopi_expedientes_tecnicos"
                    });
                    map.addLayer(lyr_gopi_expedientes_tecnicos);
                    var extent = lyr_gopi_expedientes_tecnicos.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                }
                    MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
            }
        });
}

function imprimir_docs_expedientes_tecnicos()
{
    window.open('sub_geren_estudios_proyectos/0?reporte=expedientes_tecnicos&id_expediente_tecnico='+$('#id_gopi_exp_tecnico').val());
}

// GOPI - PERFILES

function crear_mapa_gopi_perfiles()
{
    var aux_haburb_gopi_perfiles=0;
    $("#inp_habilitacion").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    $("#legend").html("");
    html=
        html='<div >\n\
                    <ul>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_evaluacion" onchange="valida_capa('+"'chk_evaluacion'"+')">\n\
                                    <i></i>\n\
                                    EVALUACION\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_pendiente" onchange="valida_capa('+"'chk_pendiente'"+')">\n\
                                    <i></i>\n\
                                    PENDIENTE\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_aprobado" onchange="valida_capa('+"'chk_aprobado'"+')">\n\
                                    <i></i>\n\
                                    APROBADO\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                    </ul>\n\
            </div>';
    $("#legend").html(html);
    $("#legend").show();
    
    if(aux_haburb_gopi_perfiles==0)
    {
        aux_haburb_gopi_perfiles=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}

function crear_semaforo_mapa_gopi_perfiles(color)
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("Seleccione Hablitacion","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        $("#chk_evaluacion,#chk_pendiente,#chk_aprobado").prop("checked", false);
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_estudios_proyectos/0?mapa=mapa_perfiles&nivel='+color+'&id_hab_urb='+$("#hidden_inp_habilitacion").val(),
            type: 'get',
            success: function (data) {
                if(data==0)
                {
                    MensajeAlerta('PERFILES','NO SE ENCONTRO PERFILES EN ESTA HABILITACION.');
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
                    if(color == 'EVALUACION')
                    {
                        lyr_map_gopi_perfiles_evaluacion = new ol.layer.Vector({
                            source:jsonSource,
                            style: gopi_perfiles_amarillo,
                            title: "gopi_perfiles_evaluacion"
                        });
                        map.addLayer(lyr_map_gopi_perfiles_evaluacion);
                        var extent = lyr_map_gopi_perfiles_evaluacion.getSource().getExtent();
                    }
                    if(color == 'PENDIENTE')
                    {
                        lyr_map_gopi_perfiles_pendiente = new ol.layer.Vector({
                            source:jsonSource,
                            style: gopi_perfiles_verde,
                            title: "gopi_perfiles_pendiente"
                        });
                        map.addLayer(lyr_map_gopi_perfiles_pendiente);
                        var extent = lyr_map_gopi_perfiles_pendiente.getSource().getExtent();
                    }
                    if(color == 'APROBADO')
                    {
                        lyr_map_gopi_perfiles_aprobado = new ol.layer.Vector({
                            source:jsonSource,
                            style: gopi_perfiles_rojo,
                            title: "gopi_perfiles_aprobado"
                        });
                        map.addLayer(lyr_map_gopi_perfiles_aprobado);
                        var extent = lyr_map_gopi_perfiles_aprobado.getSource().getExtent();
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

function gopi_perfiles_amarillo(feature, resolution) {
    
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

function gopi_perfiles_rojo(feature, resolution) {
    
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

function gopi_perfiles_verde(feature, resolution) {
    
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

function imprimir_docs_perfiles()
{
    window.open('sub_geren_estudios_proyectos/0?reporte=perfiles&id_perfil='+$('#id_gopi_perfil').val());
}

// GOPI - MANTENIMIENTOS

function crear_mapa_gopi_mantenimientos()
{
    var aux_haburb_gopi_mantenimiento=0;
    $("#inp_habilitacion").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    $("#legend").html("");
    html=
        html='<div >\n\
                    <ul>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_inicio" onchange="valida_capa('+"'chk_inicio'"+')">\n\
                                    <i></i>\n\
                                    INICIO\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_en_ejecucion" onchange="valida_capa('+"'chk_en_ejecucion'"+')">\n\
                                    <i></i>\n\
                                    EN EJECUCION\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_paralizada" onchange="valida_capa('+"'chk_paralizada'"+')">\n\
                                    <i></i>\n\
                                    PARALIZADA\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_culminada" onchange="valida_capa('+"'chk_culminada'"+')">\n\
                                    <i></i>\n\
                                    CULMINADA\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_recepcionada" onchange="valida_capa('+"'chk_recepcionada'"+')">\n\
                                    <i></i>\n\
                                    RECEPCIONADA\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_liquidada" onchange="valida_capa('+"'chk_liquidada'"+')">\n\
                                    <i></i>\n\
                                    LIQUIDADA\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_entregada" onchange="valida_capa('+"'chk_entregada'"+')">\n\
                                    <i></i>\n\
                                    ENTREGADA\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                    </ul>\n\
            </div>';
    $("#legend").html(html);
    $("#legend").show();
    
    if(aux_haburb_gopi_mantenimiento==0)
    {
        aux_haburb_gopi_mantenimiento=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}

function crear_estados_mapa_gopi_mantenimiento(estado)
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("SELECCIONE UNA HABILITACION","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        $("#chk_inicio,#chk_en_ejecucion,#chk_paralizada,#chk_culminada,#chk_recepcionada,#chk_liquidada,#chk_entregada").prop("checked", false);
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'sub_geren_apoyo_matenimiento/0?mapa=mapa_mantenimiento&id_estado_mant='+estado+'&id_hab_urb='+$("#hidden_inp_habilitacion").val(),
        type: 'get',
        success: function (data) {
            if(data==0)
            {
                MensajeAlerta('MANTENIMIENTOS','NO SE ENCONTRO MANTENIMIENTOS EN ESTA HABILITACION.');
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
                if(estado == 1)
                {
                    lyr_map_gopi_mantenimiento_inicio = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_mantenimiento_rojo,
                        title: "gopi_mantenimiento_inicio"
                    });
                    map.addLayer(lyr_map_gopi_mantenimiento_inicio);
                    var extent = lyr_map_gopi_mantenimiento_inicio.getSource().getExtent();
                }
                if(estado == 2)
                {
                    lyr_map_gopi_mantenimiento_ejecucion = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_mantenimiento_rojo,
                        title: "gopi_mantenimiento_en_ejecucion"
                    });
                    map.addLayer(lyr_map_gopi_mantenimiento_ejecucion);
                    var extent = lyr_map_gopi_mantenimiento_ejecucion.getSource().getExtent();
                }
                if(estado == 3)
                {
                    lyr_map_gopi_mantenimiento_paralizada = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_mantenimiento_rojo,
                        title: "gopi_mantenimiento_paralizada"
                    });
                    map.addLayer(lyr_map_gopi_mantenimiento_paralizada);
                    var extent = lyr_map_gopi_mantenimiento_paralizada.getSource().getExtent();
                }
                if(estado == 4)
                {
                    lyr_map_gopi_mantenimiento_culminada = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_mantenimiento_rojo,
                        title: "gopi_mantenimiento_culminada"
                    });
                    map.addLayer(lyr_map_gopi_mantenimiento_culminada);
                    var extent = lyr_map_gopi_mantenimiento_culminada.getSource().getExtent();
                }
                if(estado == 5)
                {
                    lyr_map_gopi_mantenimiento_recepcionada = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_mantenimiento_rojo,
                        title: "gopi_mantenimiento_recepcionada"
                    });
                    map.addLayer(lyr_map_gopi_mantenimiento_recepcionada);
                    var extent = lyr_map_gopi_mantenimiento_recepcionada.getSource().getExtent();
                }
                if(estado == 6)
                {
                    lyr_map_gopi_mantenimiento_liquidada = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_mantenimiento_rojo,
                        title: "gopi_mantenimiento_liquidada"
                    });
                    map.addLayer(lyr_map_gopi_mantenimiento_liquidada);
                    var extent = lyr_map_gopi_mantenimiento_liquidada.getSource().getExtent();
                }
                if(estado == 7)
                {
                    lyr_map_gopi_mantenimiento_entregada = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_mantenimiento_rojo,
                        title: "gopi_mantenimiento_entregada"
                    });
                    map.addLayer(lyr_map_gopi_mantenimiento_entregada);
                    var extent = lyr_map_gopi_mantenimiento_entregada.getSource().getExtent();
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

function gopi_mantenimiento_rojo(feature, resolution) {
    
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

function imprimir_docs_mantenimientos()
{
    window.open('sub_geren_apoyo_matenimiento/0?reporte=mantenimientos&id_mantenimiento='+$('#id_gopi_mantenimiento').val());
}

function ver_galeria_fotos(id,url,ruta,dlg_foto)
{  
    $.ajax({url: url+'/0?fotos='+ruta,
    type: 'GET',
    data:
    {
        id:id
    },
    success: function(r) 
    {
        texto1='';
        texto2='';
        $("#"+dlg_foto).html("");
        if(r!=0)
        {
            $("#"+dlg_foto).html('<center><img src="data:image/png;base64,'+r[0].foto+'" width="100%"/></center>');

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
            $("#"+dlg_foto).html(final);
        }
        else
        {
            $("#"+dlg_foto).html('<center><img src="img/recursos/Home-icon.png" width="100%"/></center>');
        }
        
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
    }
    }); 
}

// GOPI - OBRAS

function crear_mapa_gopi_obras()
{
    var aux_haburb_gopi_obra=0;
    $("#inp_habilitacion").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    $("#legend").html("");
    html=
        html='<div >\n\
                    <ul>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_inicio_obra" onchange="valida_capa('+"'chk_inicio_obra'"+')">\n\
                                    <i></i>\n\
                                    INICIO\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_en_ejecucion_obra" onchange="valida_capa('+"'chk_en_ejecucion_obra'"+')">\n\
                                    <i></i>\n\
                                    EN EJECUCION\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_paralizada_obra" onchange="valida_capa('+"'chk_paralizada_obra'"+')">\n\
                                    <i></i>\n\
                                    PARALIZADA\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_culminada_obra" onchange="valida_capa('+"'chk_culminada_obra'"+')">\n\
                                    <i></i>\n\
                                    CULMINADA\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_recepcionada_obra" onchange="valida_capa('+"'chk_recepcionada_obra'"+')">\n\
                                    <i></i>\n\
                                    RECEPCIONADA\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_liquidada_obra" onchange="valida_capa('+"'chk_liquidada_obra'"+')">\n\
                                    <i></i>\n\
                                    LIQUIDADA\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_entregada_obra" onchange="valida_capa('+"'chk_entregada_obra'"+')">\n\
                                    <i></i>\n\
                                    ENTREGADA\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                    </ul>\n\
            </div>';
    $("#legend").html(html);
    $("#legend").show();
    
    if(aux_haburb_gopi_obra==0)
    {
        aux_haburb_gopi_obra=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}

function crear_estados_mapa_gopi_obra(estado)
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("SELECCIONE UNA HABILITACION","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        $("#chk_inicio_obra,#chk_en_ejecucion_obra,#chk_paralizada_obra,#chk_culminada_obra,#chk_recepcionada_obra,#chk_liquidada_obra,#chk_entregada_obra").prop("checked", false);
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'sub_geren_obras_publicas/0?mapa=mapa_obra&id_estado_obra='+estado+'&id_hab_urb='+$("#hidden_inp_habilitacion").val(),
        type: 'get',
        success: function (data) {
            if(data==0)
            {
                MensajeAlerta('OBRAS','NO SE ENCONTRO OBRAS EN ESTA HABILITACION.');
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
                if(estado == 1)
                {
                    lyr_map_gopi_obra_inicio = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_obra_rojo,
                        title: "gopi_obra_inicio"
                    });
                    map.addLayer(lyr_map_gopi_obra_inicio);
                    var extent = lyr_map_gopi_obra_inicio.getSource().getExtent();
                }
                if(estado == 2)
                {
                    lyr_map_gopi_obra_ejecucion = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_obra_rojo,
                        title: "gopi_obra_en_ejecucion"
                    });
                    map.addLayer(lyr_map_gopi_obra_ejecucion);
                    var extent = lyr_map_gopi_obra_ejecucion.getSource().getExtent();
                }
                if(estado == 3)
                {
                    lyr_map_gopi_obra_paralizada = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_obra_rojo,
                        title: "gopi_obra_paralizada"
                    });
                    map.addLayer(lyr_map_gopi_obra_paralizada);
                    var extent = lyr_map_gopi_obra_paralizada.getSource().getExtent();
                }
                if(estado == 4)
                {
                    lyr_map_gopi_obra_culminada = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_obra_rojo,
                        title: "gopi_obra_culminada"
                    });
                    map.addLayer(lyr_map_gopi_obra_culminada);
                    var extent = lyr_map_gopi_obra_culminada.getSource().getExtent();
                }
                if(estado == 5)
                {
                    lyr_map_gopi_obra_recepcionada = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_obra_rojo,
                        title: "gopi_obra_recepcionada"
                    });
                    map.addLayer(lyr_map_gopi_obra_recepcionada);
                    var extent = lyr_map_gopi_obra_recepcionada.getSource().getExtent();
                }
                if(estado == 6)
                {
                    lyr_map_gopi_obra_liquidada = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_obra_rojo,
                        title: "gopi_obra_liquidada"
                    });
                    map.addLayer(lyr_map_gopi_obra_liquidada);
                    var extent = lyr_map_gopi_obra_liquidada.getSource().getExtent();
                }
                if(estado == 7)
                {
                    lyr_map_gopi_obra_entregada = new ol.layer.Vector({
                        source:jsonSource,
                        style: gopi_obra_rojo,
                        title: "gopi_obra_entregada"
                    });
                    map.addLayer(lyr_map_gopi_obra_entregada);
                    var extent = lyr_map_gopi_obra_entregada.getSource().getExtent();
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

function gopi_obra_rojo(feature, resolution) {
    
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
            text: feature.get('nomb_hab_urba')
        })
    });
    
}

function imprimir_docs_obras()
{
    window.open('sub_geren_obras_publicas/0?reporte=obras&id_obra='+$('#id_gopi_obra').val());
}

// GERENCIA DE SEGURIDAD CIUDADANA
// GSC - COMISARIAS

function crear_mapa_gsc_comisarias()
{
    $.ajax({url: 'sub_geren_op_vigilancia_interna/0?mapa=comisarias',
            type: 'GET',
            success: function(r)
            {
                geojson_gsc_comisarias = JSON.parse(r[0].json_build_object);
                var format_gsc_comisarias= new ol.format.GeoJSON();
                var features_gsc_comisarias = format_gsc_comisarias.readFeatures(geojson_gsc_comisarias,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_gsc_comisarias = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_gsc_comisarias.addFeatures(features_gsc_comisarias);
                lyr_gsc_comisarias = new ol.layer.Vector({
                    source:jsonSource_gsc_comisarias,
                    style: geren_seg_ciudadana_style_comisarias,
                    title: "geren_seg_ciudadana_comisarias"
                });
                map.addLayer(lyr_gsc_comisarias);
                var extent = lyr_gsc_comisarias.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}

function geren_seg_ciudadana_style_comisarias(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 14 ? 0.2 : 0.03,
          src: 'img/recursos/comisaria.png',
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('nombre') : '',
            Placement: 'point',
            textAlign: "center", 
            fill: new ol.style.Fill({
                color: 'white',
            }),
            offsetY:map.getView().getZoom() > 16 ? 40 : 20
        })
      });
}

function imprimir_docs_comisarias()
{
    window.open('sub_geren_op_vigilancia_interna/0?reporte=comisarias&id_comisaria='+$('#id_gsc_comisaria').val());
}

function traer_datos_gsc_personal_comisaria(id_comisaria)
{
    $("#gsc_personal_comisarias").html("");
    $("#dlg_ver_personal_comisarias").dialog({
        autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.: LISTA DE PERSONAL COMISARIA :.</h4></div>",
        buttons: [{
                    html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                    "class": "btn btn-primary bg-color-red",
                    click: function () {$(this).dialog("close");}
                }]
        }).dialog('open');

        MensajeDialogLoadAjax('dlg_ver_personal_comisarias', '.:: Cargando ...');
        $.ajax({
        url: 'sub_geren_op_vigilancia_interna/'+id_comisaria+'?show=datos_personal_comisaria',
        type: 'GET',
        success: function(data) 
        {
            if (data == 0) 
            {
                html="";
                html = html+'<div class="gsc_personal_comisarias col-xs-12">\n\
                            <div class="col-xs-12">NO PRESENTA PERSONAL</div>\n\
                        </div>';
                $("#gsc_personal_comisarias").html(html);
            }
            else
            {
                html="<div class='gsc_personal_comisarias col-xs-12'>\n\
                                <div class='col-xs-2 text-center'>DNI</div>\n\
                                <div class='col-xs-4 text-center'>NOMBRE PERSONA</div>\n\
                                <div class='col-xs-2 text-center'>TELEFONO</div>\n\
                                <div class='col-xs-2 text-center'>CARGO</div>\n\
                                <div class='col-xs-2 text-center'>FECHA REGISTRO</div>\n\
                            </div>";
                for(i=0;i<data.length;i++)
                {
                    html = html+'<div class="gsc_personal_comisarias col-xs-12">\n\
                                <div class="col-xs-2 text-center">'+data[i].dni+'</div>\n\
                                <div class="col-xs-4 text-center">'+data[i].persona+'</div>\n\
                                <div class="col-xs-2 text-center">'+data[i].telefono+'</div>\n\
                                <div class="col-xs-2 text-center">'+data[i].descripcion+'</div>\n\
                                <div class="col-xs-2 text-center">'+data[i].fecha_registro+'</div>\n\
                            </div>';
                }
                $("#gsc_personal_comisarias").html(html);
            }
            MensajeDialogLoadAjaxFinish('dlg_ver_personal_comisarias'); 
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_ver_personal_comisarias');
        }
    }); 
}

function traer_datos_gsc_observ_comisarias(id_comisaria)
{
    $("#gsc_observ_comisarias").html("");
    $("#dlg_ver_observacion_comisarias").dialog({
        autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.: LISTA DE OBSERVACIONES COMISARIA :.</h4></div>",
        buttons: [{
                    html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                    "class": "btn btn-primary bg-color-red",
                    click: function () {$(this).dialog("close");}
                }]
        }).dialog('open');

        MensajeDialogLoadAjax('dlg_ver_observacion_comisarias', '.:: Cargando ...');
        $.ajax({
        url: 'sub_geren_op_vigilancia_interna/'+id_comisaria+'?show=datos_observacion_comisaria',
        type: 'GET',
        success: function(data) 
        {
            if (data == 0) 
            {
                html="";
                html = html+'<div class="gsc_personal_comisarias col-xs-12">\n\
                            <div class="col-xs-12">NO PRESENTA OBSERVACIONES</div>\n\
                        </div>';
                $("#gsc_observ_comisarias").html(html);
            }
            else
            {
                html="<div class='gsc_personal_comisarias col-xs-12'>\n\
                                <div class='col-xs-3 text-center'>FECHA REGISTRO</div>\n\
                                <div class='col-xs-9 text-center'>OBSERVACION</div>\n\
                            </div>";
                for(i=0;i<data.length;i++)
                {
                    html = html+'<div class="gsc_personal_comisarias col-xs-12">\n\
                                <div class="col-xs-3 text-center">'+data[i].fecha_registro+'</div>\n\
                                <div class="col-xs-9 text-center">'+data[i].observacion+'</div>\n\
                            </div>';
                }
                $("#gsc_observ_comisarias").html(html);
            }
            MensajeDialogLoadAjaxFinish('dlg_ver_observacion_comisarias'); 
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_ver_observacion_comisarias');
        }
    });
}

// GSC - SEMAFOROS

function crear_mapa_gsc_semaforos()
{
    $.ajax({url: 'sub_geren_op_vigilancia_interna/0?mapa=semaforos',
            type: 'GET',
            success: function(data)
            {
                if(data == 0)
                {
                    MensajeAlerta('SEMAFOROS','NO SE ENCONTRO REGISTROS.');
                }
                else
                {
                    geojson_gsc_semaforos = JSON.parse(data[0].json_build_object);
                    var format_gsc_semaforos= new ol.format.GeoJSON();
                    var features_gsc_semaforos = format_gsc_semaforos.readFeatures(geojson_gsc_semaforos,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gsc_semaforos = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gsc_semaforos.addFeatures(features_gsc_semaforos);
                    lyr_gsc_semaforos = new ol.layer.Vector({
                        source:jsonSource_gsc_semaforos,
                        style: geren_seg_ciudadana_style_semaforos,
                        title: "geren_seg_ciudadana_semaforos"
                    });
                    map.addLayer(lyr_gsc_semaforos);
                    var extent = lyr_gsc_semaforos.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                }
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Problema de red','Contactar con el Administrador.');
            }
        });
}
function geren_seg_ciudadana_style_semaforos(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 16 ? 0.05 : 0.08,
          src: 'img/recursos/semaforo.png',
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

function imprimir_docs_semaforos()
{
    window.open('sub_geren_op_vigilancia_interna/0?reporte=semaforos&id_semaforo='+$('#id_gsc_semaforo').val());
}

// GSC - MAPA DELITOS

function crear_mapa_gsc_mapa_delitos(valor)
{
    $("#anio_pred").hide();
    $("#fec_desde").show();
    $("#fec_hasta").show();
    $("#btn_busqueda_delitos").show();
    
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
    if (valor == 1) 
    {
        $.ajax({url: 'sub_geren_op_vigilancia_interna/0?mapa=delitos&valor=1',
            type: 'GET',
            success: function(data)
            {
                if(data == 0)
                {
                    MensajeAlerta('DELITOS','NO SE ENCONTRO REGISTROS.');
                }
                else
                {
                    geojson_gsc_delitos = JSON.parse(data[0].json_build_object);
                    var format_gsc_delitos= new ol.format.GeoJSON();
                    var features_gsc_delitos = format_gsc_delitos.readFeatures(geojson_gsc_delitos,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gsc_delitos = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gsc_delitos.addFeatures(features_gsc_delitos);
                    lyr_gsc_delitos = new ol.layer.Vector({
                        source:jsonSource_gsc_delitos,
                        style: geren_seg_ciudadana_style_delitos,
                        title: "geren_seg_ciudadana_mapa_delitos"
                    });
                    map.addLayer(lyr_gsc_delitos);
                    var extent = lyr_gsc_delitos.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                }
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Problema de red','Contactar con el Administrador.');
            }
        });
    }
    else
    {
        $.ajax({url: 'sub_geren_op_vigilancia_interna/0?mapa=delitos&valor=2&fec_desde='+$("#fec_desde").val()+'&fec_hasta='+$("#fec_hasta").val(),
            type: 'GET',
            success: function(data)
            {
                if(data == 0)
                {
                    MensajeAlerta('DELITOS','NO SE ENCONTRO REGISTROS.');
                    map.removeLayer(lyr_gsc_delitos);
                }
                else
                {
                    map.removeLayer(lyr_gsc_delitos);
                    geojson_gsc_delitos = JSON.parse(data[0].json_build_object);
                    var format_gsc_delitos= new ol.format.GeoJSON();
                    var features_gsc_delitos = format_gsc_delitos.readFeatures(geojson_gsc_delitos,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gsc_delitos = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gsc_delitos.addFeatures(features_gsc_delitos);
                    lyr_gsc_delitos = new ol.layer.Vector({
                        source:jsonSource_gsc_delitos,
                        style: geren_seg_ciudadana_style_delitos,
                        title: "geren_seg_ciudadana_mapa_delitos"
                    });
                    map.addLayer(lyr_gsc_delitos);
                    var extent = lyr_gsc_delitos.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                }
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Problema de red','Contactar con el Administrador.');
            }
        });
    }
}
function geren_seg_ciudadana_style_delitos(feature, resolution){

        return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 14 ? 0.2 : 0.08,
          src: 'img/recursos/delito.png',
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('ubicacion') : '',
            Placement: 'point',
            textAlign: "center", 
            fill: new ol.style.Fill({
                color: 'white',
            }),
            offsetY:map.getView().getZoom() > 16 ? 40 : 20
        })
      });
}

function traer_foto_gsc_mapa_delito(id_mapa_delito)
{
    $.ajax({url: 'sub_geren_op_vigilancia_interna/0?fotos=fotos_delitos',
        type: 'GET',
        data:{id_mapa_delito:id_mapa_delito},
        success: function(data) 
        {
            $("#dlg_gsc_map_delito_imagen").html("");
            if (data == 0)
            {
                $("#dlg_gsc_map_delito_imagen").html('<center><img src="img/recursos/Home-icon.png" width="100%"/></center>');
            }
            else
            {
                $("#dlg_gsc_map_delito_imagen").attr("src","data:image/png;base64,"+data[0].imagen);
            }
        },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_gsc_mapa_delitos');
            }
        });
}

function imprimir_docs_mapa_delitos()
{
    window.open('sub_geren_op_vigilancia_interna/0?reporte=mapa_delito&id_mapa_delito='+$('#id_gsc_mapa_delito').val());
}

// GSC - CAMARAS

function crear_mapa_gsc_mapa_camaras()
{
    $.ajax({url: 'sub_geren_op_vigilancia_interna/0?mapa=camaras',
            type: 'GET',
            success: function(data)
            {
                if(data == 0)
                {
                    MensajeAlerta('CAMARAS','NO SE ENCONTRO REGISTROS.');
                }
                else
                {
                    geojson_gsc_camaras = JSON.parse(data[0].json_build_object);
                    var format_gsc_camaras= new ol.format.GeoJSON();
                    var features_gsc_camaras = format_gsc_camaras.readFeatures(geojson_gsc_camaras,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_gsc_camaras = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_gsc_camaras.addFeatures(features_gsc_camaras);
                    lyr_gsc_camaras = new ol.layer.Vector({
                        source:jsonSource_gsc_camaras,
                        style: geren_seg_ciudadana_style_camaras,
                        title: "geren_seg_ciudadana_camaras"
                    });
                    map.addLayer(lyr_gsc_camaras);
                    var extent = lyr_gsc_camaras.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                }
                MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Problema de red','Contactar con el Administrador.');
            }
        });
}
function geren_seg_ciudadana_style_camaras(feature, resolution){

        return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 16 ? 0.05 : 0.08,
          src: 'img/recursos/camara.jpg',
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

// GSC - ZONAS DE RIESGO

function crear_mapa_gsc_zona_riesgo()
{
    $("#anio_pred").hide();
    $("#legend").html("");
    html=
        html='<div >\n\
                    <ul>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_estr_mal_estado" onchange="valida_capa('+"'chk_estr_mal_estado'"+')">\n\
                                    <i></i>\n\
                                    ESTRUCTURA EN MAL ESTADO\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_riesgo_derrum" onchange="valida_capa('+"'chk_riesgo_derrum'"+')">\n\
                                    <i></i>\n\
                                    RIESGO DE DERRUMBE\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                        <li style="padding-left: 10px;">\n\
                            <span style="width: 120px">\n\
                                <label class="checkbox inline-block" style="color:black !important;font-weight: bold">\n\
                                    <input type="checkbox" name="checkbox-inline" id="chk_caida_huayco" onchange="valida_capa('+"'chk_caida_huayco'"+')">\n\
                                    <i></i>\n\
                                    CAIDA DE HUAYCO\n\
                                </label> \n\
                            </span> \n\
                        </li>\n\
                    </ul>\n\
            </div>';
    $("#legend").html(html);
    $("#legend").show();
  
    MensajeDialogLoadAjaxFinish('map');   
}

function crear_estados_mapa_gsc_zona_riesgo(estado)
{
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'sub_geren_riesgos_desastres/0?mapa=zona_riesgo&id_tipo_riesgo='+estado,
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('ZONA RIESGO','NO SE ENCONTRO DATOS.');
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
                    if(estado == 1)
                    {
                        lyr_map_gsc_str_mal_estado = new ol.layer.Vector({
                            source:jsonSource,
                            style: style_gsc_zona_riesgo,
                            title: "gsc_str_mal_estado"
                        });
                        map.addLayer(lyr_map_gsc_str_mal_estado);
                        var extent = lyr_map_gsc_str_mal_estado.getSource().getExtent();
                    }
                    if(estado == 2)
                    {
                        lyr_map_gsc_riesgo_derrum = new ol.layer.Vector({
                            source:jsonSource,
                            style: style_gsc_zona_riesgo,
                            title: "gsc_riesgo_derrumbe"
                        });
                        map.addLayer(lyr_map_gsc_riesgo_derrum);
                        var extent = lyr_map_gsc_riesgo_derrum.getSource().getExtent();
                    }
                    if(estado == 3)
                    {
                        lyr_map_gsc_caida_huayco = new ol.layer.Vector({
                            source:jsonSource,
                            style: style_gsc_zona_riesgo,
                            title: "gsc_caida_huayco"
                        });
                        map.addLayer(lyr_map_gsc_caida_huayco);
                        var extent = lyr_map_gsc_caida_huayco.getSource().getExtent();
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

function style_gsc_zona_riesgo(feature, resolution)
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
            text: feature.get('descripcion')
        })
    });
}

function imprimir_docs_mapa_zona_riesgo()
{
    window.open('sub_geren_riesgos_desastres/0?reporte=zona_riesgo&id_zona_riesgo='+$('#id_gsc_zona_riesgo').val());
}

// GSC - RUTAS SERENAZGO

function crear_mapa_gsc_rutas_serenazgo()
{
    $.ajax({url: 'sub_geren_op_vigilancia_interna/0?mapa=rutas_serenazgo',
            type: 'GET',
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
                lyr_gsc_rutas_serenazgo= new ol.layer.Vector({
                    source:jsonSource,
                    style: gsc_rutas_serenazgo,
                    title: "gsc_rutas_serenazgo"
                });
                map.addLayer(lyr_gsc_rutas_serenazgo);
                var extent = lyr_gsc_rutas_serenazgo.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
              
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}

function gsc_rutas_serenazgo(feature, resolution){
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

function imprimir_docs_mapa_rutas_serenazgo()
{
    window.open('sub_geren_op_vigilancia_interna/0?reporte=rutas_serenazgo&id_ruta_serenazgo='+$('#id_gsc_ruta_serenazgo').val());
}

// PROCURADURIA

function crear_mapa_geren_procuraduria()
{
    var aux_haburb_procuraduria=0;
    $("#inp_habilitacion").show();
    $("#btn_busqueda_procuraduria").show();
    $("#inp_habilitacion").val('');
    $("#hidden_inp_habilitacion").val('');
    $("#anio_pred").hide();
    
    
    if(aux_haburb_procuraduria==0)
    {
        aux_haburb_procuraduria=1;
        autocompletar_haburb('inp_habilitacion');
    }
    MensajeDialogLoadAjaxFinish('map');   
}

var lyr_geren_procuraduria;
function cargar_habilitacion_procuraduria()
{
    if($("#hidden_inp_habilitacion").val()==0)
    {
        mostraralertasconfoco("DEBE ESCRIBIR EL NOMBRE DE UNA HABILITACION URBANA","#inp_habilitacion");
        MensajeDialogLoadAjaxFinish('map');
        return false;
    }
    traer_hab_by_id($("#hidden_inp_habilitacion").val(),1);
    MensajeDialogLoadAjax('map', '.:: Cargando ...');
        $.ajax({url: 'procuraduria/0?mapa=procuraduria&id_hab_urb='+$('#hidden_inp_habilitacion').val(),
            type: 'GET',
            success: function(data)
            {
                if(data==0)
                {
                    MensajeAlerta('EXPEDIENTES PROCURADURIA','NO SE ENCONTRO EXPEDIENTES EN ESTA HABILITACION.');
                }
                else
                {
                    geojson_procuraduria = JSON.parse(data[0].json_build_object);
                    var format_procuraduria = new ol.format.GeoJSON();
                    var features_procuraduria = format_procuraduria.readFeatures(geojson_procuraduria,
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                    var jsonSource_procuraduria = new ol.source.Vector({
                        attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                    });
                    jsonSource_procuraduria.addFeatures(features_procuraduria);
                    lyr_geren_procuraduria = new ol.layer.Vector({
                        source:jsonSource_procuraduria,
                        style: geren_procuraduria,
                        title: "gerencia_procuraduria"
                    });
                    map.addLayer(lyr_geren_procuraduria);
                    var extent = lyr_geren_procuraduria.getSource().getExtent();
                    map.getView().fit(extent, map.getSize());
                }
                    MensajeDialogLoadAjaxFinish('map');
            },
            error: function (data) {
                MensajeAlerta('Predios','No se encontró.');
            }
        });
}

function geren_procuraduria(feature, resolution)
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
            text: feature.get('nro_expediente')
        })
    });
}

function traer_datos_observ_procuraduria(id_procuraduria)
{
    $("#observaciones_procuraduria").html("");
    $("#dlg_ver_observacion_procuraduria").dialog({
        autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.: LISTA DE OBSERVACIONES EXPEDIENTES PROCURADURIA :.</h4></div>",
        buttons: [{
                    html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                    "class": "btn btn-primary bg-color-red",
                    click: function () {$(this).dialog("close");}
                }]
        }).dialog('open');

        MensajeDialogLoadAjax('dlg_ver_observacion_procuraduria', '.:: Cargando ...');
        $.ajax({
        url: 'procuraduria/'+id_procuraduria+'?show=datos_observacion_procuraduria',
        type: 'GET',
        success: function(data) 
        {
            if (data == 0) 
            {
                html="";
                html = html+'<div class="gsc_personal_comisarias col-xs-12">\n\
                            <div class="col-xs-12">NO PRESENTA OBSERVACIONES</div>\n\
                        </div>';
                $("#observaciones_procuraduria").html(html);
            }
            else
            {
                html="<div class='gsc_personal_comisarias col-xs-12'>\n\
                                <div class='col-xs-3 text-center'>FECHA REGISTRO</div>\n\
                                <div class='col-xs-9 text-center'>OBSERVACION</div>\n\
                            </div>";
                for(i=0;i<data.length;i++)
                {
                    html = html+'<div class="gsc_personal_comisarias col-xs-12">\n\
                                <div class="col-xs-3 text-center">'+data[i].fecha_registro+'</div>\n\
                                <div class="col-xs-9 text-center">'+data[i].observaciones+'</div>\n\
                            </div>';
                }
                $("#observaciones_procuraduria").html(html);
            }
            MensajeDialogLoadAjaxFinish('dlg_ver_observacion_procuraduria'); 
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_ver_observacion_procuraduria');
        }
    });
}

function imprimir_docs_procuraduria()
{
    window.open('procuraduria/0?reporte=procuraduria&id_procuraduria='+$('#id_procuraduria').val());
}

function grilla_datos_procuraduria()
{
    jQuery("#table_documentos").jqGrid({
        url: 'procuraduria/0?grid=documentos_adj&id_procuraduria='+$('#id_procuraduria').val(),
        datatype: 'json', mtype: 'GET',
        height: '150px', autowidth: true,
        toolbarfilter: true,
        colNames: ['ID', 'DESCRIPCION','VER','DESCARGAR'],
        rowNum: 50, sortname: 'id_doc_adj', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO DE EXPEDIENTES', align: "center",
        colModel: [
            {name: 'id_doc_adj', index: 'id_doc_adj', align: 'left',width: 20, hidden: true},
            {name: 'descripcion', index: 'descripcion', align: 'left', width: 200},
            {name: 'ver', index: 'ver', align: 'left', width: 100},
            {name: 'descargar', index: 'descargar', align: 'left', width: 150},
        ],
        pager: '#pager_table_documentos',
        rowList: [10, 20, 30, 40, 50],
        gridComplete: function () {
            var idarray = jQuery('#table_documentos').jqGrid('getDataIDs');
            if (idarray.length > 0) {
            var firstid = jQuery('#table_documentos').jqGrid('getDataIDs')[0];
                    $("#table_documentos").setSelection(firstid);    
                }
        }
    });
}

// GDUC
// SALUD

function crear_mapa_gduc_salud()
{
    $.ajax({url: 'infraestructura_urbana/0?mapa=salud',
            type: 'GET',
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
                lyr_gduc_salud = new ol.layer.Vector({
                    source:jsonSource_salud,
                    style: stylehospitales,
                    title: "Hospitales"
                });
                map.addLayer(lyr_gduc_salud);
                var extent = lyr_gduc_salud.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function stylehospitales(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 14 ? 0.2 : 0.03,
          src: 'img/recursos/hospital.png',
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('text') : '',
            Placement: 'point',
            textAlign: "center", 
            fill: new ol.style.Fill({
                color: 'white',
            }),
            offsetY:map.getView().getZoom() > 16 ? 40 : 20
        })
      });
}

//EDUCACION

function crear_mapa_gduc_educacion()
{
    $.ajax({url: 'infraestructura_urbana/0?mapa=educacion',
            type: 'GET',
            success: function(r)
            {
                geojson_educacion = JSON.parse(r[0].json_build_object);
                var format_educacion= new ol.format.GeoJSON();
                var features_educacion = format_educacion.readFeatures(geojson_educacion,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_educacion = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_educacion.addFeatures(features_educacion);
                lyr_gduc_educacion = new ol.layer.Vector({
                    source:jsonSource_educacion,
                    style: styleEducacion,
                    title: "Educacion"
                });
                map.addLayer(lyr_gduc_educacion);
                var extent = lyr_gduc_educacion.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function styleEducacion(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 14 ? 0.4 : 0.08,
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

//GUBERNAMENTAL

function crear_mapa_gduc_gubernamental()
{
    $.ajax({url: 'infraestructura_urbana/0?mapa=gubernamental',
            type: 'GET',
            success: function(r)
            {
                geojson_gubernamental = JSON.parse(r[0].json_build_object);
                var format_gubernamental = new ol.format.GeoJSON();
                var features_gubernamental = format_gubernamental.readFeatures(geojson_gubernamental,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_gubernamental = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_gubernamental.addFeatures(features_gubernamental);
                lyr_gduc_gubernamental = new ol.layer.Vector({
                    source:jsonSource_gubernamental,
                    style: styleGubernamental,
                    title: "Gubernamental"
                });
                map.addLayer(lyr_gduc_gubernamental);
                var extent = lyr_gduc_gubernamental.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function styleGubernamental(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 14 ? 0.2 : 0.08,
          src: 'img/recursos/gubernamental.png',
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('text') : '',
            Placement: 'point',
            textAlign: "center", 
            fill: new ol.style.Fill({
                color: 'white',
            }),
            offsetY:map.getView().getZoom() > 16 ? 40 : 20
        })
      });
}

//RECREACION

function crear_mapa_gduc_recreacion()
{
    $.ajax({url: 'infraestructura_urbana/0?mapa=recreacion',
            type: 'GET',
            success: function(r)
            {
                geojson_recreacion = JSON.parse(r[0].json_build_object);
                var format_recreacion = new ol.format.GeoJSON();
                var features_recreacion = format_recreacion.readFeatures(geojson_recreacion,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_recreacion = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_recreacion.addFeatures(features_recreacion);
                lyr_gduc_recreacion = new ol.layer.Vector({
                    source:jsonSource_recreacion,
                    style: styleRecreacion,
                    title: "Recreacion"
                });
                map.addLayer(lyr_gduc_recreacion);
                var extent = lyr_gduc_recreacion.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function styleRecreacion(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 14 ? 0.2 : 0.08,
          src: 'img/recursos/recreacion.png',
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('nombre1') : '',
            Placement: 'point',
            textAlign: "center", 
            fill: new ol.style.Fill({
                color: 'white',
            }),
            offsetY:map.getView().getZoom() > 16 ? 40 : 20
        })
      });
}

//EQUIPAMIENTO

function crear_mapa_gduc_equipamiento()
{
    $.ajax({url: 'infraestructura_urbana/0?mapa=equipamiento',
            type: 'GET',
            success: function(r)
            {
                geojson_equipamiento = JSON.parse(r[0].json_build_object);
                var format_equipamiento = new ol.format.GeoJSON();
                var features_equipamiento = format_equipamiento.readFeatures(geojson_equipamiento,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_equipamiento = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_equipamiento.addFeatures(features_equipamiento);
                lyr_gduc_equipamiento = new ol.layer.Vector({
                    source:jsonSource_equipamiento,
                    style: styleEquipamiento,
                    title: "Equipamiento"
                });
                map.addLayer(lyr_gduc_equipamiento);
                var extent = lyr_gduc_equipamiento.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function styleEquipamiento(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 14 ? 0.2 : 0.08,
          src: 'img/recursos/equipamiento.png',
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('equi_impor') : '',
            Placement: 'point',
            textAlign: "center", 
            fill: new ol.style.Fill({
                color: 'white',
            }),
            offsetY:map.getView().getZoom() > 16 ? 40 : 20
        })
      });
}

//FINANCIERA

function crear_mapa_gduc_financiera()
{
    $.ajax({url: 'infraestructura_urbana/0?mapa=financiera',
            type: 'GET',
            success: function(r)
            {
                geojson_financiera = JSON.parse(r[0].json_build_object);
                var format_financiera = new ol.format.GeoJSON();
                var features_financiera = format_financiera.readFeatures(geojson_financiera,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_financiera = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_financiera.addFeatures(features_financiera);
                lyr_gduc_financiera = new ol.layer.Vector({
                    source:jsonSource_financiera,
                    style: styleFinanciera,
                    title: "Financiera"
                });
                map.addLayer(lyr_gduc_financiera);
                var extent = lyr_gduc_financiera.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function styleFinanciera(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 14 ? 0.1 : 0.08,
          src: 'img/recursos/financiera.png',
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('nombre') : '',
            Placement: 'point',
            textAlign: "center", 
            fill: new ol.style.Fill({
                color: 'white',
            }),
            offsetY:map.getView().getZoom() > 16 ? 40 : 20
        })
      });
}

//ATRACTIVOS TURISTICOS

function crear_mapa_gduc_turistico()
{
    $.ajax({url: 'infraestructura_urbana/0?mapa=turistico',
            type: 'GET',
            success: function(r)
            {
                geojson_turistico = JSON.parse(r[0].json_build_object);
                var format_turistico = new ol.format.GeoJSON();
                var features_turistico = format_turistico.readFeatures(geojson_turistico,
                        {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                var jsonSource_turistico = new ol.source.Vector({
                    attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                });
                jsonSource_turistico.addFeatures(features_turistico);
                lyr_gduc_turistico = new ol.layer.Vector({
                    source:jsonSource_turistico,
                    style: styleTuristico,
                    title: "Turistico"
                });
                map.addLayer(lyr_gduc_turistico);
                var extent = lyr_gduc_turistico.getSource().getExtent();
                map.getView().fit(extent, map.getSize());
                MensajeDialogLoadAjaxFinish('map');
            }
        });
}
function styleTuristico(feature, resolution){
    return  new ol.style.Style({
        image: new ol.style.Icon({
          scale: map.getView().getZoom() > 14 ? 0.2 : 0.08,
          src: 'img/recursos/turismo.png',
        }),
        text: new ol.style.Text({
            text: map.getView().getZoom() > 14 ? feature.get('nombre') : '',
            Placement: 'point',
            textAlign: "center", 
            fill: new ol.style.Fill({
                color: 'white',
            }),
            offsetY:map.getView().getZoom() > 16 ? 40 : 20
        })
      });
}




var sketch;
var helpTooltipElement;
var helpTooltip;
var measureTooltipElement;
var measureTooltip;
var continueLineMsg = 'Clic para seguir dibujando';
var draw;
var inicio_largo=0;

var formatLength = function (line) {
    var length = Math.round(line.getLength() * 100) / 100;
    var output;
    if (length > 100) {
        output = (Math.round(length / 1000 * 100) / 100) +
            ' ' + 'km';
    } else {
        output = (Math.round(length * 100) / 100) +
            ' ' + 'm';
    }
    return output;
};
function iniciar_largo()
{
    if(inicio_largo==0)
    {
        $("#btn_largo").removeClass("bg-color-blue");
        $("#btn_largo").addClass("bg-color-blueLight");
        inicio_largo=1;
        createMeasureTooltip();
        //createHelpTooltip();
        var pointerMoveHandler = function(evt) {
            if (evt.dragging) {
              return;
            }
            /** @type {string} */
            //var helpMsg = 'Click para iniciar';

            if (sketch) {
              var geom = (sketch.getGeometry());

            }
            helpTooltip.setPosition(evt.coordinate);
          };

        map.on('pointermove', pointerMoveHandler);
        addInteraction();
    }
    else
    {
        $("#btn_largo").removeClass("bg-color-blueLight");
        $("#btn_largo").addClass("bg-color-blue");
        inicio_largo=0;
        vector_mesure.getSource().clear();
        map.removeInteraction(draw);
        $(".tooltip-static").remove();
    }
    
}
var inicio_coordenadas=0;
function iniciar_coordenadas()
{
    if(inicio_coordenadas==0)
    {
        $("#btn_coordenadas").removeClass("bg-color-blue");
        $("#btn_coordenadas").addClass("bg-color-blueLight");
        inicio_coordenadas=1;
      
    }
    else
    {
        $("#btn_coordenadas").removeClass("bg-color-blueLight");
        $("#btn_coordenadas").addClass("bg-color-blue");
        inicio_coordenadas=0;
        
    }
    
}

function addInteraction() {
    
        draw = new ol.interaction.Draw({
          source: source_mesure,
          type: 'LineString'
          
        });
        
        map.addInteraction(draw);

        createMeasureTooltip();
        createHelpTooltip();

        var listener;
        draw.on('drawstart',
          function(evt) {
            // set sketch
            sketch = evt.feature;

            /** @type {module:ol/coordinate~Coordinate|undefined} */
            var tooltipCoord = evt.coordinate;

            listener = sketch.getGeometry().on('change', function(evt) {
              var geom = evt.target;
              var output;
              output = formatLength(geom);
              tooltipCoord = geom.getLastCoordinate();
              
              measureTooltipElement.innerHTML = output;
              measureTooltip.setPosition(tooltipCoord);
            });
          }, this);

        draw.on('drawend',
          function() {
            measureTooltipElement.className = 'tooltip tooltip-static';
            measureTooltip.setOffset([0, -7]);
            // unset sketch
            sketch = null;
            // unset tooltip so that a new one can be created
            measureTooltipElement = null;
            createMeasureTooltip();
            //unByKey(listener);
          }, this);
}
function createHelpTooltip() {
        if (helpTooltipElement) {
          helpTooltipElement.parentNode.removeChild(helpTooltipElement);
        }
        helpTooltipElement = document.createElement('div');
        helpTooltipElement.className = 'tooltip hidden';
        helpTooltip = new ol.Overlay({
          element: helpTooltipElement,
          offset: [15, 0],
          positioning: 'center-left'
        });
        map.addOverlay(helpTooltip);
      }
function createMeasureTooltip() {
  if (measureTooltipElement) {
    measureTooltipElement.parentNode.removeChild(measureTooltipElement);
  }
  measureTooltipElement = document.createElement('div');
  measureTooltipElement.className = 'tooltip tooltip-measure';
  measureTooltip = new ol.Overlay({
    element: measureTooltipElement,
    offset: [0, -15],
    positioning: 'bottom-center'
  });
  map.addOverlay(measureTooltip);
}



function crear_ins_campo()
{
    Id=$('#table_inspeccion_campo').jqGrid ('getGridParam', 'selrow');
    if(Id)
    {
        $("#hidden_inp_cod_expe_ins").val($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'id_reg_exp'));
        $("#inp_cod_expe_ins").val($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'nro_expediente'));
        $("#inp_solicitante_ins").val($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'gestor'));
        $("#inp_hab_urb_ins").val($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'nomb_hab_urba'));
        
        $("#dlg_nuevo_acta_ins").dialog({
            autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  ACTA DE INSPECCIÓN EFECTIVA :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        guardar_acta_ins_campo();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });

         $("#dlg_nuevo_acta_ins").dialog('open');
     }
     else
    {
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_inspeccion_campo");
    }
}
function guardar_acta_ins_campo()
{
 
    MensajeDialogLoadAjax('dlg_nuevo_acta_ins', '.:: Cargando ...');
        $.ajax({url: 'inspeccion_efectiva/create',
        type: 'GET',
        data:{  
            id_reg_exp:$("#hidden_inp_cod_expe_ins").val(),
            fch_inspeccion:$("#inp_fecha_inspec").val(),
            tipo_suelo:$("#inp_tipo_suelo").val(),
            zonificacion:$('#inp_zonificacion_ins').prop('checked') ? 1 : 0,
            planos_mpa:$('#inp_planos_ins').prop('checked') ? 1 : 0,
            res_habil_urbana:$('#inp_res_hab_ins').prop('checked') ? 1 : 0,
            nro_de_personas:$('#inp_nro_pers').val(),
            nro_de_habitaciones:$('#inp_nro_habita').val(),
            f_a_tarima:$('#inp_tarima').prop('checked') ? 1 : 0,
            f_a_colchon:$('#inp_colchon').prop('checked') ? 1 : 0,
            f_a_comoda:$('#inp_comoda').prop('checked') ? 1 : 0,
            f_a_ropero:$('#inp_ropero').prop('checked') ? 1 : 0,
            f_a_ropa_canasto:$('#inp_ropa').prop('checked') ? 1 : 0,
            f_a_aparador:$('#inp_aparador').prop('checked') ? 1 : 0,
            f_a_televisor:$('#inp_tv').prop('checked') ? 1 : 0,
            f_a_radio_e_sonido:$('#inp_radio').prop('checked') ? 1 : 0,
            f_c_cocina:$('#inp_cocina').prop('checked') ? 1 : 0,
            f_c_balon_gas:$('#inp_gas').prop('checked') ? 1 : 0,
            f_c_mesas:$('#inp_mesas').prop('checked') ? 1 : 0,
            f_c_sillas:$('#inp_sillas').prop('checked') ? 1 : 0,
            f_c_viveres:$('#inp_viveres').prop('checked') ? 1 : 0,
            f_c_ollas:$('#inp_ollas').prop('checked') ? 1 : 0,
            f_c_repostero:$('#inp_repostero').prop('checked') ? 1 : 0,
            f_c_servicios:$('#inp_servicios').prop('checked') ? 1 : 0,
            f_p_cordeles:$('#inp_cordeles').prop('checked') ? 1 : 0,
            f_p_baldes_lavadores:$('#inp_baldes').prop('checked') ? 1 : 0,
            fp_bidones_agua:$('#inp_bidones').prop('checked') ? 1 : 0,
            f_p_lavatorio:$('#inp_lavatorio').prop('checked') ? 1 : 0,
            f_p_corral_mascotas:$('#inp_corral').prop('checked') ? 1 : 0,
            f_p_plantas:$('#inp_plantas').prop('checked') ? 1 : 0,
            f_p_silo:$('#inp_silo').prop('checked') ? 1 : 0,
            f_p_bano:$('#inp_baño').prop('checked') ? 1 : 0,
            g_area_aprox:$('#inp_area_pred_ins').val(),
            g_lin_rec_frent:$('#inp_linea_frente_ins').val(),
            g_lin_rec_derecha:$('#inp_linea_der_ins').val(),
            g_lin_rec_izq:$('#inp_linea_izq_ins').val(),
            g_lin_rec_fondo:$('#inp_linea_fondo_ins').val(),
            por_el_frente:$('#inp_por_frente_ins').val(),
            por_la_derecha:$('#inp_por_der_ins').val(),
            por_la_izquierda:$('#inp_por_izq_ins').val(),
            por_el_fondo:$('#inp_por_fondo_ins').val(),
            observaciones:$('#inp_obs_ins').text(),
            vecin_01_apenom:$('#inp_nom_vec1').val(),
            vecin_01_dni:$('#inp_dni_vec1').val(),
            vecin_01_direcc:$('#inp_dir_vec1').val(),
            vecin_02_apenom:$('#inp_nom_vec2').val(),
            vecin_02_dni:$('#inp_dni_vec2').val(),
            vecin_02_direcc:$('#inp_dir_vec2').val(),
            vecin_03_apenom:$('#inp_nom_vec3').val(),
            vecin_03_dni:$('#inp_dni_vec3').val(),
            vecin_03_direcc:$('#inp_dir_vec3').val(),
            tipo_cerco1:$('#inp_piedra_cerco').prop('checked') ? 1 : 0,
            tipo_cerco2:$('#inp_sillar_cerco').prop('checked') ? 1 : 0,
            tipo_cerco3:$('#inp_bloqueta_cerco').prop('checked') ? 1 : 0,
            tipo_cerco4:$('#inp_ladrillo_cerco').prop('checked') ? 1 : 0,
            tipo_cerco5:$('#inp_concreto_cerco').prop('checked') ? 1 : 0,
            tipo_cerco6:$('#inp_estera_cerco').prop('checked') ? 1 : 0,
            habitacion1:$('#inp_sillar_hab').prop('checked') ? 1 : 0,
            habitacion2:$('#inp_bloqueta_hab').prop('checked') ? 1 : 0,
            habitacion3:$('#in_ladrillo_hab').prop('checked') ? 1 : 0,
            habitacion4:$('#inp_concreto_hab').prop('checked') ? 1 : 0,
            habitacion5:$('#inp_fabricado_hab').prop('checked') ? 1 : 0,
            habitacion6:$('#inp_dry_hab').prop('checked') ? 1 : 0,
            tipo_de_techo1:$('#inp_calamina').prop('checked') ? 1 : 0,
            tipo_de_techo2:$('#inp_madera').prop('checked') ? 1 : 0,
            tipo_de_techo3:$('#inp_mdf').prop('checked') ? 1 : 0,
            tipo_de_techo4:$('#inp_concreto').prop('checked') ? 1 : 0,
            tipo_de_techo5:$('#inp_plasticos').prop('checked') ? 1 : 0,
            servicios1:$('#inp_pileta').prop('checked') ? 1 : 0,
            servicios2:$('#inp_agua_med').prop('checked') ? 1 : 0,
            servicios3:$('#inp_luz_colec').prop('checked') ? 1 : 0,
            servicios4:$('#inp_luz_med').prop('checked') ? 1 : 0
        },
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_acta_ins');
            $("#dlg_nuevo_acta_ins").dialog('close');
            jQuery("#table_inspeccion_campo").jqGrid('setGridParam', {url: 'datos_predio?grid=2'}).trigger('reloadGrid');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
        }
        }); 
}

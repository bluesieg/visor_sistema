

function open_dialog_new_edit_Contribuyente(tipo, id) {

    limpiar_ctrl('dialog_new_edit_Contribuyentes');

    $("#dialog_new_edit_Contribuyentes").dialog({
        autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: " + tipo + " CONTRIBUYENTE :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-primary bg-color-blue",
                click: function () {
                    save_edit_contribuyentes(tipo, id);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-blue",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        close: function (event, ui) {
            global_prov = 0;
            document.getElementById('cb_tip_doc_1').options.length = 1;
            document.getElementById('cb_tip_doc_2').options.length = 1;
            document.getElementById('contrib_id_cond_exonerac').options.length = 1;
            document.getElementById('contrib_dpto').options.length = 1;
            document.getElementById('contrib_prov').options.length = 1;
            document.getElementById('contrib_dist').options.length = 1;
        }
    }).dialog('open');
    MensajeDialogLoadAjax('dialog_new_edit_Contribuyentes', '.:: CARGANDO ...');
    llenar_combo_tipo_documento(0);
    llenar_combo_cond_exonerac(0);
    llenar_combo_dpto(0);
    llenar_combo_prov(0);
    llenar_combo_dist(0, false, 'EDITAR');
    autocompletar_av_jr_call('txt_av_jr_calle_psje');
    if (tipo == 'NUEVO') {
        valores_defaul_form(0);//0 form contribuyentes
        MensajeDialogLoadAjaxFinish('dialog_new_edit_Contribuyentes');
    } else if (tipo == 'EDITAR') {
        $("#txt_av_jr_calle_psje").val($.trim($("#table_Contribuyentes").getCell(id, "nom_via")));
        $.ajax({
            url: 'llenar_form_contribuyentes?id_pers=' + id,
            type: 'GET',
            success: function (data) {
                $('#cb_tip_doc_1').val(data.tipo_doc);
                $('#txt_nro_doc').val(data.nro_doc);
                $('#contrib_ape_pat').val(data.ape_pat);
                $('#contrib_ape_mat').val(data.ape_mat);
                $('#contrib_nombres').val(data.nombres);
                $('#contrib_sexo').val(data.sexo);
                $('#contrib_fch_nac').val(data.fnac);
                $("input[name=radio_tip_per][value=" + data.tipo_persona + "]").prop('checked', true);
                $('#contrib_raz_soc').val(data.raz_soc);
                $('#contrib_tlfno_fijo').val(data.tlfno_fijo);
                $('#contrib_tlfono_celular').val(data.tlfono_celular);
                $('#contrib_email').val(data.email);
                $('#contrib_dom_fiscal').val(data.dom_fiscal);
                $('#contrib_est_civil').val(data.est_civil);
                $('#contrib_nro_doc_conv').val(data.nro_doc_conv);
                $('#contrib_conviviente').val(data.conviviente);
                $('#contrib_prov').val(data.id_prov);
                $('#contrib_dist').val(data.id_dist);
                $('#contrib_nro_mun').val(data.nro_mun);
                $('#contrib_dpto_depa').val(data.dpto);
                $('#contrib_manz').val(data.manz);
                $('#contrib_lote').val(data.lote);
//                $('#').val(data.activo);
                $('#contrib_dpto').val(data.id_dpto);
                $('#contrib_id_cond_exonerac').val(data.id_cond_exonerac);
                $('#hiddentxt_av_jr_calle_psje').val(data.id_via);
                $('#cb_tip_doc_2').val(data.tip_doc_conv);
                MensajeDialogLoadAjaxFinish('dialog_new_edit_Contribuyentes');
            },
            error: function (data) {
                alert('Contactese con el Administrador...');
            }
        });
    }
}


function save_edit_contribuyentes(tipo, id) {

    if (tipo === 'NUEVO' && id === undefined) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'insert_new_contribuyente',
            type: 'POST',
            data: {
                tipo_doc: $('#cb_tip_doc_1').val(),
                nro_doc: $('#txt_nro_doc').val(),
                ape_pat: ($('#contrib_ape_pat').val()).toUpperCase(),
                ape_mat: ($('#contrib_ape_mat').val()).toUpperCase(),
                nombres: ($('#contrib_nombres').val()).toUpperCase(),
                sexo: $('#contrib_sexo').val(),
                fnac: $('#contrib_fch_nac').val(),
                tipo_persona: $('input:radio[name=radio_tip_per]:checked').val(),
                raz_soc: ($('#contrib_raz_soc').val()).toUpperCase(),
                tlfno_fijo: $('#contrib_tlfno_fijo').val(),
                tlfono_celular: $('#contrib_tlfono_celular').val(),
                email: $('#contrib_email').val(),
                dom_fiscal: ($('#contrib_dom_fiscal').val()).toUpperCase(),
                est_civil: $('#contrib_est_civil').val(),
                nro_doc_conv: $('#contrib_nro_doc_conv').val(),
                conviviente: ($('#contrib_conviviente').val()).toUpperCase(),
                id_prov: $('#contrib_prov').val(),
                id_dist: $('#contrib_dist').val(),
                nro_mun: $('#contrib_nro_mun').val(),
                manz: $('#contrib_manz').val(),
                lote: $('#contrib_lote').val(),
                activo: 1,
                id_dpto: $('#contrib_dpto').val(),
                id_cond_exonerac: $('#contrib_id_cond_exonerac').val(),
                id_via: $('#hiddentxt_av_jr_calle_psje').val(),
                tip_doc_conv: $('#cb_tip_doc_2').val()
            },
            success: function (data) {
                dialog_close('dialog_new_edit_Contribuyentes');
                fn_actualizar_grilla('table_Contribuyentes', 'grid_contribuyentes');
            },
            error: function (data) {
                alert('Contactese con el Administrador...');
            }
        });
    } else if (tipo === 'EDITAR' && id != undefined) {
        MensajeDialogLoadAjax('dialog_new_edit_Contribuyentes', '.:: CARGANDO ...');
        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'contribuyente_update',
                        type: 'POST',
                        data: {
                            id_pers:id,
                            tipo_doc: $('#cb_tip_doc_1').val(),
                            nro_doc: $('#txt_nro_doc').val(),
                            ape_pat: ($('#contrib_ape_pat').val()).toUpperCase(),
                            ape_mat: ($('#contrib_ape_mat').val()).toUpperCase(),
                            nombres: ($('#contrib_nombres').val()).toUpperCase(),
                            sexo: $('#contrib_sexo').val(),
                            fnac: $('#contrib_fch_nac').val(),
                            tipo_persona: $('input:radio[name=radio_tip_per]:checked').val(),
                            raz_soc: ($('#contrib_raz_soc').val()).toUpperCase(),
                            tlfno_fijo: $('#contrib_tlfno_fijo').val(),
                            tlfono_celular: $('#contrib_tlfono_celular').val(),
                            email: $('#contrib_email').val(),
                            dom_fiscal: ($('#contrib_dom_fiscal').val()).toUpperCase(),
                            est_civil: $('#contrib_est_civil').val(),
                            nro_doc_conv: $('#contrib_nro_doc_conv').val(),
                            conviviente: ($('#contrib_conviviente').val()).toUpperCase(),
                            id_prov: $('#contrib_prov').val(),
                            id_dist: $('#contrib_dist').val(),
                            nro_mun: $('#contrib_nro_mun').val(),
                            manz: $('#contrib_manz').val(),
                            lote: $('#contrib_lote').val(),                            
                            id_dpto: $('#contrib_dpto').val(),
                            id_cond_exonerac: $('#contrib_id_cond_exonerac').val(),
                            id_via: $('#hiddentxt_av_jr_calle_psje').val(),
                            tip_doc_conv: $('#cb_tip_doc_2').val()
                        },
                        success: function (data) {
                            $.alert('El registro ha sido modificado...');                            
                            fn_actualizar_grilla('table_Contribuyentes', 'grid_contribuyentes');
                            dialog_close('dialog_new_edit_Contribuyentes');
                            MensajeDialogLoadAjaxFinish('dialog_new_edit_Contribuyentes', '.:: CARGANDO ...');
                        },
                        error: function (data) {
                            alert('Contactese con el Administrador...');
                            dialog_close('dialog_new_edit_Contribuyentes');
                            MensajeDialogLoadAjaxFinish('dialog_new_edit_Contribuyentes', '.:: CARGANDO ...');
                        }
                    });
                },
                Cancelar: function () {
                    $.alert('Canceled!');
                }
            }
        });

    }
}

function eliminar_contribuyente(id) {
    raz_soc = $.trim($("#table_Contribuyentes").getCell(id, "contribuyente"));
    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'contribuyente_delete',
                    type: 'POST',
                    data: {id: id},
                    success: function (data) {
                        $.alert(raz_soc + '- Ha sido Eliminado');
                        fn_actualizar_grilla('table_Contribuyentes', 'grid_contribuyentes');
                        dialog_close('dialog_new_edit_Contribuyentes');
                    },
                    error: function (data) {
                        alert(' Error al traer Tipo de Documentos');
                    }
                });
            },
            Cancelar: function () {
                $.alert('Canceled!');
            }

        }
    });
}





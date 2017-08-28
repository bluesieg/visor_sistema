
function open_dialog_new_edit_Contribuyente() {
    $("#dialog_new_edit_Contribuyentes").dialog({
        autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: CONTRIBUYENTE :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () { new_contrib(); }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () { $(this).dialog("close"); }
            }],
        close: function (event, ui) { limpiar_dlg_contrib(); },
        open: function(){ limpiar_dlg_contrib(); }
    }).dialog('open');
    $("#cb_tip_doc_2").val('02');
    $("#cb_tip_doc_1").val('02');
    $("#contrib_dpto").val('04');
    llenar_combo_prov('contrib_prov');
    llenar_combo_dist('contrib_dist');
    $("#contrib_dist").val('040104');
    autocompletar_av_jr_call('txt_av_jr_calle_psje');
}
function fn_consultar_persona(num){ 
    if(num==1){
        nro_doc=$("#txt_nro_doc").val();
    }else{
        nro_doc=$("#contrib_nro_doc_conv").val();
    }     
    $.ajax({        
        url: 'consultar_persona?nro_doc='+nro_doc,
        type: 'GET',        
        success: function (data) {
            if(data){
                if(num==1){
                    $("#vw_contrib_contribuyente").val(data.contrib);
                    $("#vw_contrib_id_pers").val(data.id_pers);
                }else{
                    $("#contrib_conviviente").val(data.contrib);
                    $("#vw_contrib_id_conv").val(data.id_pers);
                }                
            }else{
                MensajeExito('Personas','El Documento Ingresado no esta Registrado...');
                dlg_new_persona(nro_doc);
            }
        },
        error: function (data) {
            MensajeAlerta('* Error de Red...<br>* Contactese con el Administrador...');
        }
    });
}

function modificar_contrib(){
    MensajeDialogLoadAjax('dialog_new_edit_Contribuyentes','Cargando');
    id_contrib=$('#table_Contribuyentes').jqGrid ('getGridParam', 'selrow');
    $("#dialog_new_edit_Contribuyentes").dialog({
        autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: CONTRIBUYENTE :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar Modificaciones",
                "class": "btn btn-success bg-color-green",
                click: function () { update_contrib(); }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () { $(this).dialog("close"); }
            }],
        close: function (event, ui) { limpiar_dlg_contrib(); },
        open: function(){ limpiar_dlg_contrib(); }
    }).dialog('open');
    llenar_combo_prov('contrib_prov');
    llenar_combo_dist('contrib_dist');
    
    $("#cb_tip_doc_1").val($("#table_Contribuyentes").getCell(id_contrib, 'tipo_doc'));
    $("#txt_nro_doc").val($("#table_Contribuyentes").getCell(id_contrib, 'nro_doc'));
    $("#vw_contrib_sel_tip_contrib").val($("#table_Contribuyentes").getCell(id_contrib, 'tipo_persona'));
    $("#contrib_id_cond_exonerac").val($("#table_Contribuyentes").getCell(id_contrib, 'id_cond_exonerac'));
    $("#vw_contrib_id_pers").val($("#table_Contribuyentes").getCell(id_contrib, 'id_pers'));
    $("#vw_contrib_contribuyente").val($("#table_Contribuyentes").getCell(id_contrib, 'contribuyente'));
    $("#contrib_est_civil").val($("#table_Contribuyentes").getCell(id_contrib, 'est_civil'));
    $("#contrib_tlfno_fijo").val($("#table_Contribuyentes").getCell(id_contrib, 'tlfno_fijo'));
    $("#contrib_tlfono_celular").val($("#table_Contribuyentes").getCell(id_contrib, 'tlfono_celular'));
    $("#contrib_email").val($("#table_Contribuyentes").getCell(id_contrib, 'email'));
    $("#contrib_dpto").val($("#table_Contribuyentes").getCell(id_contrib, 'id_dpto'));
    $("#contrib_prov").val($("#table_Contribuyentes").getCell(id_contrib, 'id_prov'));
    $("#contrib_dist").val($("#table_Contribuyentes").getCell(id_contrib, 'id_dist'));
    $("#hiddentxt_av_jr_calle_psje").val($("#table_Contribuyentes").getCell(id_contrib, 'id_via'));
    $("#txt_av_jr_calle_psje").val($("#table_Contribuyentes").getCell(id_contrib, 'nom_via'));
    $("#contrib_nro_mun").val($("#table_Contribuyentes").getCell(id_contrib, 'nro_mun'));
    $("#contrib_dpto_depa").val($("#table_Contribuyentes").getCell(id_contrib, 'dpto'));
    $("#contrib_manz").val($("#table_Contribuyentes").getCell(id_contrib, 'manz'));
    $("#contrib_lote").val($("#table_Contribuyentes").getCell(id_contrib, 'lote'));
    $("#contrib_dom_fiscal").val($("#table_Contribuyentes").getCell(id_contrib, 'dom_fis'));
    $("#cb_tip_doc_2").val('02');
    $("#contrib_nro_doc_conv").val($("#table_Contribuyentes").getCell(id_contrib, 'nro_doc_conv'));
    $("#vw_contrib_id_conv").val($("#table_Contribuyentes").getCell(id_contrib, 'id_conv'));
    $("#contrib_conviviente").val($("#table_Contribuyentes").getCell(id_contrib, 'conviviente')); 
    MensajeDialogLoadAjaxFinish('dialog_new_edit_Contribuyentes');
}
function update_contrib(){
    id_contrib=$('#table_Contribuyentes').jqGrid ('getGridParam', 'selrow');
    $.ajax({
        url: 'contribuyentes/'+id_contrib+'/edit',
        type: 'GET',
        data:{   
            tipo_doc:$("#cb_tip_doc_1").val(),
            tipo_persona:$("#vw_contrib_sel_tip_contrib").val(),
            nro_doc:$("#txt_nro_doc").val(),
            tlfno_fijo:$("#contrib_tlfno_fijo").val() || '0', 
            tlfono_celular:$("#contrib_tlfono_celular").val() || '0', 
            email:$("#contrib_email").val() || '@',
            est_civil:$("#contrib_est_civil").val() || '0',            
            id_dpto:$("#contrib_dpto").val(),
            id_prov:$("#contrib_prov").val(), 
            id_dist:$("#contrib_dist").val(),            
            nro_mun:$("#contrib_nro_mun").val() || '0',
            dpto:$("#contrib_dpto_depa").val() || '0',
            manz:$("#contrib_manz").val() || '0',
            lote:$("#contrib_lote").val() || '0',
            id_cond_exonerac:$("#contrib_id_cond_exonerac").val() || '1', 
            id_via:$("#hiddentxt_av_jr_calle_psje").val() || '0',             
            id_pers:$("#vw_contrib_id_pers").val() || '0', 
            id_conv:$("#vw_contrib_id_conv").val() || '0',
            ref_dom_fis:$("#contrib_dom_fiscal").val() || '-'
        },
        success: function (data) {
            dialog_close('dialog_new_edit_Contribuyentes');            
            MensajeExito('Contribuyente','Se ha Modificado el Contribuyente...');
        },
        error: function (data) {
            MensajeAlerta('* Error de Red...<br>* Contactese con el Administrador...');
        }
    });
}

function dlg_new_persona(nro_doc){
    $("#dialog_Personas").dialog({
        autoOpen: false, modal: true, width: 700, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: PERSONAS :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () { new_persona(); }                
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () { $(this).dialog("close"); }
            }],
        close: function (event, ui) { limpiar_personas();},
        open: function (){ limpiar_personas(); }
    }).dialog('open');
    $("#cb_tip_doc_3").val($("#cb_tip_doc_1").val());
    $("#pers_nro_doc").val(nro_doc);
    tipo = $("#cb_tip_doc_3").val();
    if(tipo=='02'){
        fn_consultar_dni();
        $("#pers_pat,#pers_mat,#pers_nombres").removeAttr('disabled');
//        $("#pers_pat,#pers_mat,#pers_nombres").val('');
        $("#pers_raz_soc").removeAttr('disabled');        
        $("#pers_raz_soc").attr('disabled',true);
        $("#pers_nro_doc").removeAttr('maxlength');
        $("#pers_nro_doc").attr('maxlength',8);        
    }else if (tipo=='00'){
        fn_consultar_ruc();
        $("#pers_raz_soc").removeAttr('disabled');
        $("#pers_raz_soc").val('');
        $("#pers_pat,#pers_mat,#pers_nombres").attr('disabled',true);
        $("#pers_nro_doc").removeAttr('maxlength');
        $("#pers_nro_doc").attr('maxlength',11);        
    }
}
function new_persona(){
    $.ajax({  
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'insert_personas',
        type: 'POST',
        data:{
            pers_ape_pat : $("#pers_pat").val() || '-',
            pers_ape_mat : $("#pers_mat").val() || '-',
            pers_nombres : $("#pers_nombres").val() || '-',
            pers_raz_soc : $("#pers_raz_soc").val() || '-',
            pers_tip_doc : $("#cb_tip_doc_3").val() || '-',
            pers_nro_doc : $("#pers_nro_doc").val() || '-',
            pers_dom_fis : $("#pers_dom_fis").val() || '-',
            pers_sexo : $("#pers_sexo").val() || '-',
            pers_fnac : $("#pers_fnac").val() || '1600-01-01'
        },
        success: function (data) {
            dialog_close('dialog_Personas');
            fn_consultar_persona();
            MensajeExito('Personas','Nueva Personas Guardada Correctamente...');
        },
        error: function (data) {
            MensajeAlerta('* Error de Red...<br>* Contactese con el Administrador...');
        }
    });
}
function limpiar_personas(){
    $("#pers_nro_doc,#pers_pat,#pers_mat,#pers_nombres,#pers_raz_soc,#pers_fnac,#pers_dom_fis").val('');
}

function new_contrib() { 
    if ($("#txt_nro_doc").val() == '') {
        mostraralertasconfoco('Ingrese un Numero de Documento...', '#txt_nro_doc');
        return false;
    }
    if ($("#vw_contrib_id_pers").val() == '') {
        mostraralertasconfoco('Ingrese un Numero de Documento...', '#txt_nro_doc');
        return false;
    }
    
    $.ajax({  
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'contribuyentes/create',
        type: 'GET',
        data:{   
            tipo_doc:$("#cb_tip_doc_1").val(),
            tipo_persona:$("#vw_contrib_sel_tip_contrib").val(),
            nro_doc:$("#txt_nro_doc").val(),
            tlfno_fijo:$("#contrib_tlfno_fijo").val() || '0', 
            tlfono_celular:$("#contrib_tlfono_celular").val() || '0', 
            email:$("#contrib_email").val() || '@',
            est_civil:$("#contrib_est_civil").val() || '0',            
            id_dpto:$("#contrib_dpto").val(),
            id_prov:$("#contrib_prov").val(), 
            id_dist:$("#contrib_dist").val(),            
            nro_mun:$("#contrib_nro_mun").val() || '0',
            dpto:$("#contrib_dpto_depa").val() || '0',
            manz:$("#contrib_manz").val() || '0',
            lote:$("#contrib_lote").val() || '0',
            id_cond_exonerac:$("#contrib_id_cond_exonerac").val() || '1', 
            id_via:$("#hiddentxt_av_jr_calle_psje").val() || '0',             
            id_pers:$("#vw_contrib_id_pers").val() || '0', 
            id_conv:$("#vw_contrib_id_conv").val() || '0',
            ref_dom_fis:$("#contrib_dom_fiscal").val() || '-'
        },
        success: function (data) {
            dialog_close('dialog_new_edit_Contribuyentes');            
            MensajeExito('Contribuyente','Se ha Guardado un Nuevo Contribuyente...');
        },
        error: function (data) {
            MensajeAlerta('* Error de Red...<br>* Contactese con el Administrador...');
        }
    });   
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
//                        $.alert(raz_soc + '- Ha sido Eliminado');                        
                        fn_actualizar_grilla('table_Contribuyentes', 'grid_contribuyentes');
                        dialog_close('dialog_new_edit_Contribuyentes');
                        MensajeExito('Eliminar Contribuyente', raz_soc + '- Ha sido Eliminado');
                    },
                    error: function (data) {
                        MensajeAlerta('Eliminar Contribuyente', raz_soc + '- No se pudo Eliminar.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Eliminar Contribuyente','Operacion Cancelada.');
            }
        }
    });
}

function filtro_tipo_doc(tipo) {   
    if(tipo=='02'){
        $("#vw_contrib_sel_tip_contrib").val(1);
        $("#txt_nro_doc").removeAttr('maxlength');
        $("#txt_nro_doc").attr('maxlength',8);
        $("#txt_nro_doc").val('');
    }else if(tipo=='00'){
        $("#txt_nro_doc").removeAttr('maxlength');
        $("#txt_nro_doc").attr('maxlength',11);
        $("#txt_nro_doc").val('');
        $("#vw_contrib_sel_tip_contrib").val(2);
    }
}
function filtro_tipo_doc_pers(tipo) {   
    if(tipo=='02'){
        $("#pers_pat,#pers_mat,#pers_nombres").removeAttr('disabled');
//        $("#pers_pat,#pers_mat,#pers_nombres").val('');
        $("#pers_raz_soc").attr('disabled',true);
        $("#pers_nro_doc").removeAttr('maxlength');
        $("#pers_nro_doc").attr('maxlength',8);
        $("#pers_nro_doc").val('');
        $("#pers_raz_soc").val('');
    }else if(tipo=='00'){
        $("#pers_raz_soc").removeAttr('disabled');
        $("#pers_pat,#pers_mat,#pers_nombres").attr('disabled',true);
        
        $("#pers_nro_doc").removeAttr('maxlength');
        $("#pers_nro_doc").attr('maxlength',11);
        $("#pers_nro_doc").val('');
        $("#pers_pat,#pers_mat,#pers_nombres").val('');
    }
}

function limpiar_dlg_contrib(){
    $("#txt_nro_doc,#vw_contrib_contribuyente,#contrib_tlfno_fijo,#contrib_tlfono_celular,#contrib_email,#txt_av_jr_calle_psje,#contrib_nro_mun").val('');
    $("#contrib_dpto_depa,#contrib_manz,#contrib_lote,#contrib_dom_fiscal,#contrib_nro_doc_conv,#contrib_conviviente").val('');
    $("#contrib_est_civil").val('select');
}





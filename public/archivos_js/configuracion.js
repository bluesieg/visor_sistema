


function open_dialog_new_edit_Usuario(tipe, Id) {

    if ((tipe == 0 && Id == 0) || (tipe == '' && Id == '')) {
        return false;
    }

    if (tipe == 'NUEVO') {
        limpiar_ctrl('dialog_new_edit_Usuario');
    }

    $("#dialog_new_edit_Usuario").dialog({
        autoOpen: false, modal: true, height: 550, width: 550, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-user'></i>&nbsp&nbsp.: " + tipe + " USUARIO :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-primary bg-color-blue",
                click: function () {
                    btn_guardar_Usuario(tipe, Id);
                }
//                onclick: 'btn_guardar_Usuario("'+tipe+'")'
            }, {
                html: "<i class='fa fa-trash-o'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-blue",
                click: function () {
                    $(this).dialog("close");
                }
            }]
    }).dialog('open');

    MensajeDialogLoadAjax('dialog_new_edit_Usuario', '.:: CARGANDO ...');

    setTimeout(function () {
        MensajeDialogLoadAjaxFinish('dialog_new_edit_Usuario');
    }, 2000);

//    $.blockUI({message: $('#mensaje'),theme: true,baseZ: 2000});

//    $.blockUI({message: $('#mensaje'), css: {width: '275px'}});
//    $('#yes').click(function () {
//        $.blockUI({message: "<h1>Remote call in progress...</h1>"});
//        $.ajax({
//            url: 'wait.php',
//            cache: false,
//            complete: function () {
//                // unblock when remote call returns 
//                $.unblockUI();
//            }
//        });
//    });

}
function btn_guardar_Usuario(tipe, id) {
//    alert(tipe);

    if (tipe == 'NUEVO' && id === undefined) {
        dni = $.trim($("#txt_dni_usuario").val());
        usuario = $.trim($("#txt_usuario").val());
        ape_nom = $.trim($("#txt_ape_nom").val());
        nivel = $.trim($("#txt_nivel").val());
        fch_nac = $.trim($("#txt_fch_nac").val());

        $.ajax({//
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: 'usuario_save',
            data: {dni: dni, usuario: usuario, ape_nom: ape_nom, nivel: nivel, fch_nac: fch_nac},
            success: function (data) {
                if (data.msg) {
//                    dialog_close('dialog_new_edit_Usuario');
                    alert('El ' + data.msg + ' ' + data.valor);
                } else {
                    alert('el ' + data.valor + ' Ya existe...');
                }
            }, error: function (data) {
                alert('Contactese con el administrador..');
                dialog_close('dialog_new_edit_Usuario');
            }
        });
    } else if (tipe == 'EDITAR' && id != undefined) {

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: 'usuario_save',
            data: {dni: dni, usuario: usuario, ape_nom: ape_nom, nivel: nivel, fch_nac: fch_nac},
            success: function (data) {

            }, error: function (data) {

                dialog_close('dialog_new_edit_Usuario');
            }
        });
    }
}

function eliminar_usuario(id) {
    
    $.dialog({
        title: 'Cuidado!',
        content: 'dialog_new_edit_Usuario',
        type: 'green'
    });
//    mensaje_confirm(':.CUIDADO ...!!!','* Esta seguro que decea Modificar Contribuyente.<br>* Los cambios no se podran revertir.',id);
//    $.ajax({
//        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//        type: 'POST',
//        url: 'usuario_delete',
//        data: {id: id},
//        success: function (data) {
//            dialog_close('dialog_new_edit_Usuario');
//        }, error: function (data) {
//            dialog_close('dialog_new_edit_Usuario');
//        }
//    });
}
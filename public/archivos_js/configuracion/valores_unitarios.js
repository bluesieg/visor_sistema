

function open_dialog_new_edit_Val_Unitarios(tipo, id_val) {
    $("#dialog_new_edit_Val_Unitarios").dialog({
        autoOpen: false, modal: true, height: 220, width: 300, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: " + tipo + " VALOR UNITARIO :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green txt-color-white",
                click: function () {
                    valores_unitarios_save_edit(tipo, id_val);                   
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        close: function (event, ui) {

        }
    }).dialog('open');

    if (tipo == 'EDITAR') {
        $("#vw_val_unitarios_valor").val($.trim($("#table_Val_Unitarios").getCell(id_val, "valor")));
    }
}

function valores_unitarios_save_edit(tipo, id_val) {
    anio = $("#vw_val_unitarios_cb_anio").val();
    if ($("#vw_val_unitarios_valor").val() != '') {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'update_valor_unitario',
            type: 'POST',
            data: {id_val: id_val, valor: $("#vw_val_unitarios_valor").val()},
            success: function (data) {
                if (data.msg == 'si') {
                    fn_actualizar_grilla('table_Val_Unitarios', 'grid_val_unitarios?anio=' + anio);
                    dialog_close('dialog_new_edit_Val_Unitarios');
                }
            },
            error: function () {
                mostraralertas('* Error al Modificar... Comuniquese con el Administrador...');
            }
        });
    }else{
        mostraralertasconfoco('* Campo Valor Necesario...','#vw_val_unitarios_valor');
    }

}

function crear_grid_por_anio() {
    rows = $("#table_Val_Unitarios").getRowData().length;
    if (rows === 0) {
        anio = $("#vw_val_unitarios_cb_anio").val();

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'create_magic_grid_val_unit?anio=' + anio,
            type: 'GET',
            success: function (data) {
                if (data.msg == 'si') {
                    fn_actualizar_grilla('table_Val_Unitarios', 'grid_val_unitarios?anio=' + anio);
                }
            },
            error: function () {
                alert('Error al CREAR... Comuniquese con el Administrador...');
            }
        });
    }
}

function refresh_grilla_val_unit(anio) {
    fn_actualizar_grilla('table_Val_Unitarios', 'grid_val_unitarios?anio=' + anio);
}




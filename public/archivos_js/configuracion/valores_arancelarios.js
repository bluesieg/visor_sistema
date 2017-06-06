
function open_dialog_new_edit_Val_Arancel() {
    $.confirm({
//        theme: 'my-theme',

        content: 'HOLA',
        buttons: {
            Aceptar: {
                btnClass: 'btn-green',
                action: function () {}
            },
            Cerrar: {
                btnClass: 'btn-green'                
            }            
        }
    });
}

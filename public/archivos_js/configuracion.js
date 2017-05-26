


function open_dialog_new_edit_Usuario(tipe, Id) {

    $("#dialog_new_edit_Usuario").dialog({
        autoOpen: false, modal: true, height: 390, width: 450, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4><i class='fa fa-user'></i>&nbsp.: " + tipe + " USUARIO :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-trash-o'></i>&nbsp; Delete all items",
                "class": "btn btn-primary bg-color-green",
                click: function () {
                    $(this).dialog("close");
                }
            }]
    }).dialog('open');

//        if(tipe=='NUEVO'){
//            alert(tipe+ '---'+ Id);
//        }else{
//            alert(tipe+ '---'+ Id);
//        }

}
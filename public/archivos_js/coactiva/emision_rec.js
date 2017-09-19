

function dlg_gen_resol(){
    $("#dialog_gen_resol").dialog({
        autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
        position: ['auto',50], 
        title: "<div class='widget-header'><h4>.: RESOLUCION DE APERTURA :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-fax'></i>&nbsp; Generar Resolucion Apertura",
                "class": "btn btn-success",
                click: function () {
//                    window.open("rec_apertura");
//                    window.open("editor_text");
                    editor_resolucion();
                }
            },{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }],
        open: function(){},
        close: function(){}       
    }).dialog('open');
}
function editor_resolucion(){
    $("#dlg_editor").dialog({
        autoOpen: false, modal: true, width: 850,height:600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:RECIBO:.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Confirmar e Imprimir",
            "class": "btn btn-primary",
            click: function (){

            }
        }]        
    }).dialog('open');
    
    $('#rec_editor').attr('src','editor_text'); 
}
function buscar_doc(){
    
}
function limpiar_gen_resol(){
    
}


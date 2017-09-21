

function dlg_gen_resol(){
    $("#dialog_gen_resol").dialog({
        autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
        position: ['auto',50], 
        title: "<div class='widget-header'><h4>.: RESOLUCION DE APERTURA :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-file-text'></i>&nbsp; Generar Resolucion de Apertura",
                "class": "btn btn-primary",
                click: function () { window.open("rec_apertura");}
            },{
                html: "<i class='fa fa-pencil'></i>&nbsp; Modificar PLantilla",
                "class": "btn btn-success",
                click: function () { editor_resolucion(); }
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
        autoOpen: false, modal: true, width: 800,height:620, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.: PLANTILLA REC:.</h4></div>",
        buttons: [{
             html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {$(this).dialog("close");}
        }]        
    }).dialog('open');
    MensajeDialogLoadAjax('dlg_editor','Cargando...');
    $('#rec_editor').attr('src','editor_text'); 
    setTimeout(function(){ MensajeDialogLoadAjaxFinish('dlg_editor'); }, 1000);
    
}
function save_plantilla(){
//    alert($("#ckeditor_plantilla_1").val());
    var contenido = CKEDITOR.instances['ckeditor_plantilla_1'].getData();
}
function buscar_doc(){
    
}
function limpiar_gen_resol(){
    
}


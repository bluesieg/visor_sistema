

function dlg_gen_resol(){
    $("#dialog_gen_resol").dialog({
        autoOpen: false, modal: true, width: 850, show: {effect: "fade", duration: 300}, resizable: false,        
        title: "<div class='widget-header'><h4>.: DOCUMENTOS (OP/RD) RECIBIDOS :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-file-text'></i>&nbsp; Generar Resolucion de Apertura",
                "class": "btn btn-primary",
                click: function () { 
                    gen_resolucion();
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
function editor_resolucion(id_resol){
    $("#dlg_editor").dialog({
        autoOpen: false, modal: true, width: 800,height:620, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.: EDITAR RESOLUCION :.</h4></div>",
        buttons: [{
             html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {$(this).dialog("close");}
        }]        
    }).dialog('open');
    MensajeDialogLoadAjax('dlg_editor','Cargando...');    
    $('#rec_editor').attr('src','editor_text?id_resol='+id_resol); 
    setTimeout(function(){ MensajeDialogLoadAjaxFinish('dlg_editor'); }, 1000);
    
}
function ver_resol(id_resol){
    window.open("rec_apertura/"+id_resol); 
}
function gen_resolucion(){
    id_rd = $('#t_doc_recibidos').jqGrid ('getGridParam', 'selrow');
    id_contrib=$("#t_doc_recibidos").getCell(id_rd, 'id_contrib');
    monto=$("#t_doc_recibidos").getCell(id_rd, 'monto');
//    return false;
    $.ajax({
        type:'GET',
        url:'gen_resolucion',
        data:{id_rd:id_rd,id_contrib:id_contrib,monto:monto},
        success:function(data){
            if(data.msg=='si'){
                MensajeExito('COACTIVA','Resolucion Creada...');
                dialog_close('dialog_gen_resol');
                fn_actualizar_grilla('tabla_resoluciones','all_resoluciones');
            }
        },
        error: function(data){}
    });
}

function print_notif(id_resol){
//    id_resol = $('#tabla_resoluciones').jqGrid ('getGridParam', 'selrow');
    
    window.open("print_cons_notif/"+id_resol); 
}


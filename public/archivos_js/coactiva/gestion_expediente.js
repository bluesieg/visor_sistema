
function dlg_select_new_doc(){
    rows = jQuery("#tabla_doc_coactiva").jqGrid('getGridParam', 'records');
    
    if(rows==0){ return false; }
//    var rowObj = $("#tabla_doc_coactiva").getRowData(0);
    var ids = $("#tabla_doc_coactiva").jqGrid('getDataIDs');
    var fch_recep = $("#tabla_doc_coactiva").jqGrid ('getCell', ids[0], 'fch_recep');
    if(fch_recep==''){
        mostraralertas('* Falta Recepcionar OP/RD...<br>* Recepcione los Documentos Para Iniciar El procedimiento de Ejecución Coactiva');
        return false;
    }
    
    $("#dlg_select_doc").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,        
        title: "<div class='widget-header'><h4>.: DOCUMENTOS :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-fax'></i>&nbsp; Agregar Documento",
                "class": "btn btn-primary",
                click: function () { add_doc_al_exped(); }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }],
        open: function(){}       
    }).dialog('open');
}
function add_doc_al_exped(){
    id_coa_mtr = $('#tabla_expedientes').jqGrid ('getGridParam', 'selrow');
    id_tip_doc = $("input:radio[name ='add_doc_radio']:checked").val();
//    monto=$("#t_doc_recibidos").getCell(id_rd, 'monto');
//    return false;
    $.ajax({
        type:'GET',
        url:'add_documento_exped',
        data:{id_coa_mtr:id_coa_mtr,id_tip_doc:id_tip_doc},
        success:function(data){
            if(data.msg=='si'){
                MensajeExito('COACTIVA','Documento Agregado...');
                dialog_close('dlg_select_doc');
                fn_actualizar_grilla('tabla_doc_coactiva','get_doc_exped?id_coa_mtr='+id_coa_mtr);
            }
        },
        error: function(data){}
    });
}
function ver_doc(id_doc,id_coa_mtr){
    window.open("abrirdocumento/"+id_doc+"/"+id_coa_mtr); 
}

function fecha_resep_notif(id_doc){
    $.confirm({
        title:'COACTIVA',
        content: 'Agregar Fecha, Recepción de Notificación' +
        "<input type='date' id='dateinputnotif'>",
        buttons: {
            Guardar: function () {
                date =  $("#dateinputnotif").val();
                $.ajax({
                    url:'agreg_fch_recep_notif',
                    type:'GET',
                    data:{id_doc:id_doc,fch_recep:date},
                    success: function(data){
                        ver_docum_exped();
                    }                           
                });                
            },
            close: function () {}
        }
    });
}
function editar_doc(id_doc){
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
    $('#ck_editor_resol').attr('src','editar_resol?id_doc='+id_doc); 
    setTimeout(function(){ MensajeDialogLoadAjaxFinish('dlg_editor'); }, 1500);
}
//function ver_notif(id_doc){
//    window.open("abrirdocumento/"+id_doc); 
//}
function bus_contrib(){
    if($("#vw_ges_exped_contrib").val()==""){
        mostraralertasconfoco("Ingrese un Contribuyente para Buscar","#vw_ges_exped_contrib"); 
        return false;
    }
    if($("#vw_ges_exped_contrib").val().length<4){
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#vw_ges_exped_contrib"); 
        return false;
    }

    fn_actualizar_grilla('table_contrib','obtiene_cotriname?dat='+$("#vw_ges_exped_contrib").val());
    jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_bus_contrib_select(rowid);} } ); 
    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
}

function fn_bus_contrib_select(per){    
    $("#hidden_vw_ges_exped_codigo").val(per);
   
    $("#vw_ges_exped_codigo").val($('#table_contrib').jqGrid('getCell',per,'id_per'));    
    $("#vw_ges_exped_contrib").val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    tam=($('#table_contrib').jqGrid('getCell',per,'contribuyente')).length;

    
    $("#vw_ges_exped_contrib").attr('maxlength',tam);

    fn_actualizar_grilla('tabla_expedientes','get_exped?id_contrib='+$("#hidden_vw_ges_exped_codigo").val());
    $("#dlg_bus_contr").dialog("close");    
}
function ver_docum_exped(id_coa_mtr){
    id_coa_mtr = id_coa_mtr || $('#tabla_expedientes').jqGrid ('getGridParam', 'selrow');
    fn_actualizar_grilla('tabla_doc_coactiva','get_doc_exped?id_coa_mtr='+id_coa_mtr);
}


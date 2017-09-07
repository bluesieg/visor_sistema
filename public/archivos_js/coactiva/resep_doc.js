


function fn_bus_contrib_recep_doc(){  
    if($("#vw_recep_doc_contrib").val()==""){
        mostraralertasconfoco("Ingrese un Contribuyente para Buscar","#vw_recep_doc_contrib"); 
        return false;
    }
    if($("#vw_recep_doc_contrib").val().length<4){
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#vw_recep_doc_contrib"); 
        return false;
    }

    fn_actualizar_grilla('table_contrib','obtiene_cotriname?dat='+$("#vw_recep_doc_contrib").val());
    jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_bus_contrib_list_resep_doc(rowid);} } ); 
    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
       
}

function fn_bus_contrib_list_resep_doc(per){
    $("#hidden_vw_recep_doc_codigo").val(per);
    
    $("#vw_recep_doc_codigo").val($('#table_contrib').jqGrid('getCell',per,'id_per'));    
    $("#vw_recep_doc_contrib").val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    tam=($('#table_contrib').jqGrid('getCell',per,'contribuyente')).length;
    
    $("#vw_recep_doc_contrib").attr('maxlength',tam);

    fn_actualizar_grilla('tabla_Doc_OP','recaudacion_get_op?id_contrib='+$("#hidden_vw_recep_doc_codigo").val()+'&env_op=2');
    $("#dlg_bus_contr").dialog("close");    
}



function fn_bus_contrib_fracc(){
    if($("#vw_fracc_est_cta_contrib").val()=="")
    {
        mostraralertasconfoco("Ingrese un Contribuyente para Buscar","#vw_fracc_est_cta_contrib"); 
        return false;
    }
    if($("#vw_fracc_est_cta_contrib").val().length<4)
    {
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#vw_fracc_est_cta_contrib"); 
        return false;
    }
    jQuery("#table_contrib").jqGrid('setGridParam', {url: 'obtiene_cotriname?dat='+$("#vw_fracc_est_cta_contrib").val()}).trigger('reloadGrid');
    jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter": function (rowid) { fn_bus_contrib_list_fracc(rowid); }});

    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
       
}
function fn_bus_contrib_list_fracc(per){
    $("#hiddenvw_fracc_est_cta_cod").val(per);
    
    $("#vw_fracc_est_cta_cod").val($('#table_contrib').jqGrid('getCell',per,'id_per'));    
    $("#vw_fracc_est_cta_contrib").val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    
    tam=($('#table_contrib').jqGrid('getCell',per,'contribuyente')).length;
    anio=$("#vw_emi_rec_imp_pre_anio").val();
    
    $("#vw_fracc_est_cta_contrib").attr('maxlength',tam);
    fn_actualizar_grilla('table_Convenios_estcta','get_conv_fracc_estcta?id_contrib='+per);
    $("#dlg_bus_contr").dialog("close");
    
}

function print_estcta_fracc(){
    rows = $("#table_Convenios_estcta").getRowData().length;
    if(rows==0){
        mostraralertas('* No hay Convenios Para Mostrar...<br>* Ingrese Un Contribuyente...');
        return false;
    }
    id_contrib = $("#hiddenvw_fracc_est_cta_cod").val();
    id_conv=$('#table_Convenios_estcta').jqGrid ('getGridParam', 'selrow');
    window.open('imp_est_cta_fracc/'+id_contrib+'/'+id_conv);
}
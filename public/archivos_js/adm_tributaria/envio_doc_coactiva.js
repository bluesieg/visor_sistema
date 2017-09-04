
function enviar_a_coactiva(){
    cont_rows=jQuery("#tabla_Doc_Fisca").jqGrid('getGridParam', 'records');
    if(cont_rows==0){
        return false;
    }
    $.confirm({
        title: 'Coactiva',
        content: 'Enviando Documentos a Coactiva',
        buttons: {
            Confirmar: function () {
                
            },
            Cancelar: function () {} 
        }
    });
}


function fn_bus_contrib_env_doc(){  
    if($("#vw_env_doc_contrib").val()==""){
        mostraralertasconfoco("Ingrese un Contribuyente para Buscar","#vw_env_doc_contrib"); 
        return false;
    }
    if($("#vw_env_doc_contrib").val().length<4){
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#vw_env_doc_contrib"); 
        return false;
    }

    fn_actualizar_grilla('table_contrib','obtiene_cotriname?dat='+$("#vw_env_doc_contrib").val());
    jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_bus_contrib_list_env_doc(rowid);} } ); 
    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
       
}

function fn_bus_contrib_list_env_doc(per){
    $("#hidden_vw_env_doc_codigo").val(per);
    
    $("#vw_env_doc_codigo").val($('#table_contrib').jqGrid('getCell',per,'id_per'));    
    $("#vw_env_doc_contrib").val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    tam=($('#table_contrib').jqGrid('getCell',per,'contribuyente')).length;
    
    $("#vw_env_doc_contrib").attr('maxlength',tam);

    fn_actualizar_grilla('tabla_Doc_Fisca','fiscal_get_op?id_contrib='+$("#hidden_vw_env_doc_codigo").val()+'&tip_doc='+$("#vw_env_doc_tip_doc").val());
    $("#dlg_bus_contr").dialog("close");    
}

function verop(idop)
{
    Id=$('#tabla_Doc_Fisca').jqGrid ('getGridParam', 'selrow');
    if(Id==null){
        mostraralertas("No hay Contribuyente seleccionado para impresión");
        return false;
    }    
    sec=$("#selsec option:selected").text();
    man=$("#selmnza option:selected").text();
    window.open('fis_rep/1/'+idop+'/0/0');
}


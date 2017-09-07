
function enviar_a_coactiva(){
    cont_rows=jQuery("#tabla_Doc_Fisca").jqGrid('getGridParam', 'records');
    
//    var Seleccionados = new Array();
//    $('input[type=checkbox][name=chk_doc]:checked').each(function() {
//        Seleccionados.push($(this).val());
//    });
//    cant=Seleccionados.length;
//    id_doc_checks = Seleccionados.join('-');    
    
    if(cont_rows==0 || cant==0){
        return false;
    }        
}
function right(){
    cont_rows=jQuery("#tabla_Doc_OP").jqGrid('getGridParam', 'records');
    id_gen_fis=$('#tabla_Doc_OP').jqGrid ('getGridParam', 'selrow');
    if(cont_rows==0 || id_gen_fis==null){return false;}
    update_env_op(id_gen_fis,2);
}
function left(){
    cont_rows=jQuery("#tabla_Doc_OP_2").jqGrid('getGridParam', 'records');
    id_gen_fis=$('#tabla_Doc_OP_2').jqGrid ('getGridParam', 'selrow');
    if(cont_rows==0 || id_gen_fis==null){return false;}
    update_env_op(id_gen_fis,1);
}
function all_right(){    
    var rows = $("#tabla_Doc_OP").getDataIDs();
    if (rows.length > 0) {
        MensajeDialogLoadAjax('tabla_Doc_OP','Enviando...');
        MensajeDialogLoadAjax('tabla_Doc_OP_2','Recibiendo...');
        var i=0;
        for(i=0;i<=(rows.length)-1;i++){
            all_update_env_op(rows[i],2);
        }
        setTimeout(function () {
            fn_actualizar_grilla('tabla_Doc_OP','recaudacion_get_op?id_contrib='+$("#hidden_vw_env_doc_codigo").val()+'&env_op=1');
            fn_actualizar_grilla('tabla_Doc_OP_2','recaudacion_get_op?id_contrib='+$("#hidden_vw_env_doc_codigo").val()+'&env_op=2');
            MensajeDialogLoadAjaxFinish('tabla_Doc_OP');
            MensajeDialogLoadAjaxFinish('tabla_Doc_OP_2');
        }, 1100);
    }
}
function all_left(){    
    var rows = $("#tabla_Doc_OP_2").getDataIDs();
    if (rows.length > 0) {
        MensajeDialogLoadAjax('tabla_Doc_OP','Recibiendo...');
        MensajeDialogLoadAjax('tabla_Doc_OP_2','Enviando...');
        var i=0;
        for(i=0;i<=(rows.length)-1;i++){
            all_update_env_op(rows[i],1);
        }
        setTimeout(function () {
            fn_actualizar_grilla('tabla_Doc_OP','recaudacion_get_op?id_contrib='+$("#hidden_vw_env_doc_codigo").val()+'&env_op=1');
            fn_actualizar_grilla('tabla_Doc_OP_2','recaudacion_get_op?id_contrib='+$("#hidden_vw_env_doc_codigo").val()+'&env_op=2');
            MensajeDialogLoadAjaxFinish('tabla_Doc_OP');
            MensajeDialogLoadAjaxFinish('tabla_Doc_OP_2');
        }, 1100);
    }
}
function all_update_env_op(id_gen_fis,env_op){
    $.ajax({
        url:'updat_env_doc',
        type:'GET',
        data:{id_gen_fis:id_gen_fis,env_op:env_op},
        success:function(data){},
        error: function(){}
    });
}
function update_env_op(id_gen_fis,env_op){
    $.ajax({
        url:'updat_env_doc',
        type:'GET',
        data:{id_gen_fis:id_gen_fis,env_op:env_op},
        success:function(data){
            fn_actualizar_grilla('tabla_Doc_OP','recaudacion_get_op?id_contrib='+$("#hidden_vw_env_doc_codigo").val()+'&env_op=1');
            fn_actualizar_grilla('tabla_Doc_OP_2','recaudacion_get_op?id_contrib='+$("#hidden_vw_env_doc_codigo").val()+'&env_op=2');
        },
        error: function(){}
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

    fn_actualizar_grilla('tabla_Doc_OP','recaudacion_get_op?id_contrib='+$("#hidden_vw_env_doc_codigo").val()+'&env_op=1');
    fn_actualizar_grilla('tabla_Doc_OP_2','recaudacion_get_op?id_contrib='+$("#hidden_vw_env_doc_codigo").val()+'&env_op=2');
    $("#dlg_bus_contr").dialog("close");    
}

function verop(idop)
{
    Id=$('#tabla_Doc_Fisca').jqGrid ('getGridParam', 'selrow');
    if(Id==null){
        mostraralertas("No hay Contribuyente seleccionado para impresión");
        return false;
    }    

    $("#dlg_iframe_op").dialog({
        autoOpen: false, modal: true, width: 910,heigth: 580, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  OP :.</h4></div>",
        open: function(ev, ui){
            $('#myIframe_op').attr('src','fis_rep/1/'+idop+'/0/0');
        }
    }).dialog('open');
    MensajeDialogLoadAjax('dlg_iframe_op','Cargando...');
    
    setTimeout(function () {
        MensajeDialogLoadAjaxFinish('dlg_iframe_op');
    }, 1100);
    
//    window.open('fis_rep/1/'+idop+'/0/0');
}


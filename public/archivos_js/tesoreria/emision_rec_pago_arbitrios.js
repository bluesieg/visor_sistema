
function dialog_emi_rec_pag_arbitrios() {
    $("#vw_emision_rec_pag_arbitrios").dialog({
        autoOpen: false, modal: true, width: 1250, show: {effect: "fade", duration: 300}, resizable: false,
        position: [60,10],
        create: function (event) { $(event.target).parent().css('position', 'fixed');},
        title: "<div class='widget-header'><h4>.: RECIBO ARBITRIOS :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-fax'></i>&nbsp; Generar Recibo",
                "class": "btn btn-primary",
                click: function () {}
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }],
        open: function(){limpiar_form_rec_arbitrios();}       
    }).dialog('open');
    
    grid_predios_arbitrios();
}

function grid_predios_arbitrios(){
    jQuery("#table_Predios_Arbitrios").jqGrid({
        url: 'grid_pred_arbitrios?id_contrib=0',
        datatype: 'json', mtype: 'GET',
        height: 100, autowidth: true,
        colNames: ['id_pred', 'id_contrib','Sec','Mzna','Lote','Contribuyente / Razon Social', 'Tip.Predio', 'Est.Construccion', 'S/. Terreno', 'S/. Contruccion'],
        rowNum: 5, sortname: 'id_pred', sortorder: 'desc', viewrecords: true,caption:'Lista de Predios', align: "center",
        colModel: [
            {name: 'id_pred', index: 'id_pred', hidden: true},
            {name: 'id_contrib', index: 'id_contrib', hidden: true},
            {name: 'sec', index: 'sec', width: 60},
            {name: 'mzna', index: 'mzna', width: 60},
            {name: 'lote', index: 'lote', width: 60},
            {name: 'contribuyente', index: 'contribuyente', hidden: true},
            {name: 'tp', index: 'tp', width: 80},
            {name: 'descripcion', index: 'descripcion',  width: 120},
            {name: 'val_ter', index: 'val_ter',align:'right', width: 80},
            {name: 'val_const', index: 'val_const',align:'right', width: 80}            
        ],
        pager: '#pager_table_Predios_Arbitrios',
        rowList: [10, 20],
        gridComplete: function () {
            var rows = $("#table_Predios_Arbitrios").getDataIDs();
            if (rows.length > 0) {
                var firstid = jQuery('#table_Predios_Arbitrios').jqGrid('getDataIDs')[0];
                $("#table_Predios_Arbitrios").setSelection(firstid);
            }                
//            var sum = jQuery("#table_Resumen_Recibos").getGridParam('userData').sum_total;
//            if(sum==undefined){
//                $("#vw_emision_rec_pago_total_global").val('0000.00');
//            }else{
//                $("#vw_emision_rec_pago_total_global").val(formato_numero(sum,2,'.',','));
//            }                
        },            
        ondblClickRow: function (Id) {
            id_contrib =$("#table_Predios_Arbitrios").getCell(Id, 'id_contrib');
//            alert(Id+'-'+id_contrib);
            fn_actualizar_grilla('table_cta_Arbitrios', 'grid_cta_pago_arbitrios?id_contrib='+id_contrib+'&id_pred='+Id);
            deuda_total=0;
        }
    });
    jQuery("#table_cta_Arbitrios").jqGrid({
        url: 'grid_cta_pago_arbitrios?id_contrib=0&id_pred=0',
        datatype: 'json', mtype: 'GET',
        height: 'auto', autowidth: true,
        colNames: ['id_cta_arb', 'id_pgo_arb','id_contri', 'Descripcion', 'Ene', 'abo_ene','Feb', 'abo_feb','Mar', 'abo_mar','Abr', 'abo_abr','May', 'abo_may','Jun', 'abo_jun',
        'Jul', 'abo_jul','Ago', 'abo_ago','Sep', 'abo_sep','Oct', 'abo_oct','Nov', 'abo_nov','Dic', 'abo_dic','Total','deuda_arb'],
        rowNum: 5, sortname: 'id_cta_arb', sortorder: 'desc', viewrecords: true,caption:'Arbitrios del Predio', align: "center",
        colModel: [
            {name: 'id_cta_arb', index: 'id_cta_arb', hidden: true},
            {name: 'id_pgo_arb', index: 'id_pgo_arb', hidden: true},
            {name: 'id_contri', index: 'id_contri', hidden: true},            
            {name: 'descripcion', index: 'descripcion',  width: 90},
            {name: 'pgo1',index: 'pgo_ene', align:'right', width: 35},
            {name: 'abo1',index: 'abo_ene', hidden: true},
            {name: 'pgo2',index: 'pgo_feb', align:'right', width: 35},
            {name: 'abo2',index: 'abo_feb', hidden: true},
            {name: 'pgo3',index: 'pgo_mar', align:'right', width: 35},
            {name: 'abo3',index: 'abo_mar', hidden: true},
            {name: 'pgo4',index: 'pgo_abr', align:'right', width: 35},
            {name: 'abo4',index: 'abo_abr', hidden: true},
            {name: 'pgo5',index: 'pgo_may', align:'right', width: 35},
            {name: 'abo5',index: 'abo_may', hidden: true},
            {name: 'pgo6',index: 'pgo_jun', align:'right', width: 35},
            {name: 'abo6',index: 'abo_jun', hidden: true},
            {name: 'pgo7',index: 'pgo_jul', align:'right', width: 35},
            {name: 'abo7',index: 'abo_jul', hidden: true},
            {name: 'pgo8',index: 'pgo_ago', align:'right', width: 35},
            {name: 'abo8',index: 'abo_ago', hidden: true},
            {name: 'pgo9',index: 'pgo_sep', align:'right', width: 35},
            {name: 'abo9',index: 'abo_sep', hidden: true},
            {name: 'pgo10',index: 'pgo_oct', align:'right', width: 35},
            {name: 'abo10',index: 'abo_oct', hidden: true},
            {name: 'pgo11',index: 'pgo_nov', align:'right', width: 35},
            {name: 'abo11',index: 'abo_nov', hidden: true},
            {name: 'pgo12',index: 'pgo_dic', align:'right', width: 35},
            {name: 'abo12',index: 'abo_dic', hidden: true},
            {name: 'ani_total', index: 'ani_total',align:'right', width: 35},
            {name: 'deuda_arb',index: 'deuda_arb', hidden: true}
        ],
        pager: '#pager_table_cta_Arbitrios',
        rowList: [10, 20],
        gridComplete: function () {
            var rows = $("#table_cta_Arbitrios").getDataIDs();
            for (var i = 0; i < rows.length; i++){                        
                for (var a = 1; a <= 12; a++){
                    var abo = $("#table_cta_Arbitrios").getCell(rows[i], 'abo'+a);
                    
                    if(abo=='0'){
                        pgo = $("#table_cta_Arbitrios").getCell(rows[i], 'pgo'+a);
                        $("#table_cta_Arbitrios").jqGrid("setCell", rows[i], 'pgo'+a, 
                        "<input type='checkbox' name='"+rows[i]+"' value='"+pgo+"' id='chk_calc_pag_"+a+"' onchange='calc_tot_a_pagar("+a+")'>"+pgo,{'text-align':'center'});
                    }
                    
                }                
            }
            
            $("#vw_emision_rec_Arbitrios_tot").val('0.00');
            if (rows.length > 0) {
                var firstid = jQuery('#table_cta_Arbitrios').jqGrid('getDataIDs')[0];
                $("#table_cta_Arbitrios").setSelection(firstid);
            }  
        },            
        ondblClickRow: function (Id) {}
    });
}
deuda_total=0;
function check_anio(name,source){    
    checkboxes = document.getElementsByName(name);
    for(var i=0;i<=11;i++) {
        checkboxes[i].checked = source.checked;
    }
    deuda = parseFloat($("#table_cta_Arbitrios").getCell(name, 'deuda_arb'));
    
    if($(checkboxes).is(':checked')){
        deuda_total=deuda_total+deuda;
    } else {
        deuda_total=deuda_total-deuda;      
    }
    $("#vw_emision_rec_Arbitrios_tot").val(formato_numero(deuda_total,2,'.',','));
}
function fn_bus_contrib_arb(){
    if($("#vw_emi_rec_arbitrios_contrib").val()==""){
        mostraralertasconfoco("Ingrese un Contribuyente para Buscar","#vw_emi_rec_arbitrios_contrib"); 
        return false;
    }
    if($("#vw_emi_rec_arbitrios_contrib").val().length<4){
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#vw_emi_rec_arbitrios_contrib"); 
        return false;
    }
    jQuery("#table_contrib").jqGrid('setGridParam', {url: 'obtiene_cotriname?dat='+$("#vw_emi_rec_arbitrios_contrib").val()}).trigger('reloadGrid');
    jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_bus_contrib_list_arb(rowid);} } ); 
    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
       
}
function fn_bus_contrib_list_arb(per){
    $("#vw_emi_rec_arbitrios_id_pers").val(per);
    
    $("#vw_emi_rec_arbitrios_cod_contrib").val($('#table_contrib').jqGrid('getCell',per,'id_per'));    
    $("#vw_emi_rec_arbitrios_contrib").val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
//    tam=($('#table_contrib').jqGrid('getCell',per,'contribuyente')).length;
//    anio=$("#vw_emi_rec_imp_pre_anio").val();
    
//    $("#vw_emi_rec_imp_pre_contrib").attr('maxlength',tam);
//    id_pers=$('#table_contrib').jqGrid('getCell',per,'id_pers');
    fn_actualizar_grilla('table_Predios_Arbitrios','grid_pred_arbitrios?id_contrib='+$("#vw_emi_rec_arbitrios_id_pers").val());
//    $("#dlg_bus_contr").dialog("close");    
}


function limpiar_form_rec_arbitrios(){
    
}
function limpiar_vista_fraccionamiento(){
//    amor=0;saldo=0;interes=0;deuda=0;
//    t_deuda=0;t_amor=0;t_inter=0;t_cc=0;
    $("#t_dina_conve_fracc > tbody > tr").remove();
    $("#vw_em_rec_fracc_tot_amor,#vw_em_rec_fracc_tot_inter,#vw_em_rec_fracc_tot_cc").val('00.00');
}
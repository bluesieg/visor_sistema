
function dialog_emi_rec_pag_fracc() {    
    $("#vw_emision_rec_pag_fracc").dialog({
        autoOpen: false, modal: true, width: 1350, show: {effect: "fade", duration: 300}, resizable: false,
        position: ['auto',20],        
        title: "<div class='widget-header'><h4>.: RECIBO - CUOTA DE FRACCIONAMIENTO :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-fax'></i>&nbsp; Generar Recibo",
                "class": "btn btn-primary",
                click: function () {gen_rec_pago_fracc();}
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }],
        open: function(){limpiar_form_princ();},
        close: function(){limpiar_form_princ();}   
    }).dialog('open');
    
    grid_fracc_de_contrib();
}

function grid_fracc_de_contrib(){
    jQuery("#table_fracc_de_contrib").jqGrid({
        url: 'grid_fracc_de_contrib?id_contrib=0',
        datatype: 'json', mtype: 'GET',
        height: 262, autowidth: true,
        colNames: ['Nro.', 'Total S/.', 'Inicial S/.', 'Periodo', 'Consepto', 'Tipo Fracc', 'Estado', 'Fecha'],
        rowNum: 10, sortname: 'nro_convenio', sortorder: 'asc', viewrecords: true, caption: 'Fraccionamientos del Contribuyente', align: "center",
        colModel: [            
            {name: 'nro_convenio', index: 'nro_convenio',width: 60,align:'center'},
            {name: 'total_convenio', index: 'total_convenio',width: 70, align:'right'},
            {name: 'cuota_inicial', index: 'cuota_inicial', width: 70, align:'right'},
            {name: 'periodo', index: 'periodo', align: 'center', width: 70},
            {name: 'desc_tipo', index: 'desc_tipo', width: 110},
            {name: 'tip_fracc', index: 'tip_fracc', width: 60, align:'center'},
            {name: 'est_actual', index: 'est_actual', width: 50,align:'center'},
            {name: 'fec_reg', index: 'fec_reg', align: 'center', width: 70}            
        ],
        pager: '#pag_table_fracc_de_contrib',
        rowList: [10, 15],
        gridComplete: function () {
            var rows = $("#table_fracc_de_contrib").getDataIDs();
            if (rows.length > 0) {
                var firstid = jQuery('#table_fracc_de_contrib').jqGrid('getDataIDs')[0];
                $("#table_fracc_de_contrib").setSelection(firstid);
            }             
        },            
        ondblClickRow: function (Id) {
//            cod_convenio=$("#table_fracc_de_contrib").getCell(Id, "cod_convenio");            
            fn_actualizar_grilla('t_fracc_crono_contrib','grid_detalle_fracc?id_conv='+Id);
        }
    });
    jQuery("#t_fracc_crono_contrib").jqGrid({
        url: 'grid_detalle_fracc?id_conv=0',
        datatype: 'json', mtype: 'GET',
        height: 325, autowidth: true,
        colNames: ['N°', 'Cuota Mensual', 'Estado', 'Fecha Pago', 'Selec.'],
        rowNum: 12, sortname: 'nro_cuota', sortorder: 'asc', viewrecords: true,
        colModel: [
            {name: 'nro_cuota', index: 'nro_cuota',width: 20,align:'center'},
            {name: 'total', index: 'total',width: 70,align:'center'},
            {name: 'estado', index: 'estado',width: 60, align:'center'},
            {name: 'fec_pago', index: 'fec_pago', width: 60, align:'center'},
            {name: 'seleccione', index: 'seleccione', align: 'center', width: 30}
        ],        
        rowList: [12, 15],
        gridComplete: function () {
            var rows = $("#t_fracc_crono_contrib").getDataIDs();
            if (rows.length > 0) {
                var firstid = jQuery('#t_fracc_crono_contrib').jqGrid('getDataIDs')[0];
                $("#t_fracc_crono_contrib").setSelection(firstid);
            }
            $("#t_fracc_pago_mes_total").val('0.00');
        },            
        ondblClickRow: function (Id) {}
    });
}

function gen_rec_pago_fracc(){
    
    var Seleccionados = new Array();
    $('input[type=checkbox]:checked').each(function() {
        Seleccionados.push($(this).val());
    });
    cant=Seleccionados.length;
    cuota_checks = Seleccionados.join('-');
    
//    alert(cuota_checks);   
//    return false;
    $.confirm({
        title: '.:Recibo:.',
        content: 'Generar Recibo por '+cuota_checks+' Cuota(s).',
        buttons: {
            Confirmar: function () {
                MensajeDialogLoadAjax('vw_emision_rec_pag_fracc', 'Generando Recibo...');
                rowId=$('#table_fracc_de_contrib').jqGrid ('getGridParam', 'selrow');
//                cod_conv=$("#table_fracc_de_contrib").getCell(rowId, "cod_convenio");
                $.ajax({
                    url: 'emi_recibo_master/create',
                    type: 'GET',
                    data: {
                        id_est_rec: 1,
                        glosa: 'PAGO - CUOTA DE FRACCIONAMIENTO Nro: '+cuota_checks,
                        total: $("#t_fracc_pago_mes_total").val().replace(',', ''),
                        id_pers:$("#vw_emi_rec_fracc_contrib_hidden").val(),
                        clase_recibo:3,
                        fracc_check : cuota_checks,
                        cod_fracc:rowId
                    },
                    success: function (data) {
                        if (data) {
                            imp_fracc_insert_detalle(data);
                        } else {
                            mostraralertas('* Ha Ocurrido un Error al Generar Recibo.<br>* Actualice el Sistema e Intentelo Nuevamente.');
                        }
                    },
                    error: function (data) {
                        mostraralertas('* Error de Red.<br>* Contactese con el Administrador.');
                        MensajeDialogLoadAjaxFinish('vw_emision_rec_pag_fracc');
                    }
                });
            },
            Cancelar: function () {}
        }
    });
}
function imp_fracc_insert_detalle(id_recibo){
//    alert(cant);
//    return false;
    rowId=$('#t_fracc_crono_contrib').jqGrid ('getGridParam', 'selrow');    
    monto = parseFloat($("#t_fracc_crono_contrib").getCell(rowId, 'total'));
    $.ajax({
        url: 'emi_recibo_detalle/create',
        type: 'GET',
        data: {
            id_rec_master: id_recibo,            
            monto: monto,
            id_trib:0,
            cant: cant,
            p_unit: monto
        },
        success: function (data) {
            if (data) {                               
                MensajeDialogLoadAjaxFinish('vw_emision_rec_pag_fracc');
                dialog_close('vw_emision_rec_pag_fracc');
                fn_actualizar_grilla('table_Resumen_Recibos', 'grid_Resumen_recibos?fecha=' + $("#vw_emision_reg_pag_fil_fecha").val());
                MensajeExito('Nuevo Recibo', 'El Recibo Ha sido Generado.');                
            }
        },
        error: function (data) {
            return false;
        }
    });
}
tot_mes=0;
function check_tot_mes(val,source){
    if($(source).is(':checked')){
        tot_mes=tot_mes+val;
    } else {
        tot_mes=tot_mes-val;      
    }
    $("#t_fracc_pago_mes_total").val(formato_numero(tot_mes,2,'.',','));
}
function fn_bus_contrib_fracc(){  
    if($("#vw_emi_rec_fracc_contrib").val()==""){
        mostraralertasconfoco("Ingrese un Contribuyente para Buscar","#vw_emi_rec_fracc_contrib"); 
        return false;
    }
    if($("#vw_emi_rec_fracc_contrib").val().length<4){
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#vw_emi_rec_fracc_contrib"); 
        return false;
    }

    fn_actualizar_grilla('table_contrib','obtiene_cotriname?dat='+$("#vw_emi_rec_fracc_contrib").val());
    jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_bus_contrib_list_fracc(rowid);} } ); 
    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
       
}
function fn_bus_contrib_list_fracc(per){
    $("#vw_emi_rec_fracc_contrib_hidden").val(per);
    
    $("#vw_emi_rec_fracc_cod_contrib").val($('#table_contrib').jqGrid('getCell',per,'id_per'));    
    $("#vw_emi_rec_fracc_contrib").val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    tam=($('#table_contrib').jqGrid('getCell',per,'contribuyente')).length;
//    anio=$("#vw_emi_rec_imp_pre_anio").val();
    
    $("#vw_emi_rec_fracc_contrib").attr('maxlength',tam);
//    id_pers=$('#table_contrib').jqGrid('getCell',per,'id_pers');
    fn_actualizar_grilla('table_fracc_de_contrib','grid_fracc_de_contrib?id_contrib='+$("#vw_emi_rec_fracc_contrib_hidden").val());
    $("#dlg_bus_contr").dialog("close");    
}

function limpiar_form_princ(){
    tot_mes=0;
    $("#vw_emi_rec_fracc_contrib,#vw_emi_rec_fracc_cod_contrib,#vw_emi_rec_fracc_contrib_hidden").val('');
    fn_actualizar_grilla('table_fracc_de_contrib','grid_fracc_de_contrib?id_contrib=0');
    fn_actualizar_grilla('t_fracc_crono_contrib','grid_detalle_fracc?id_conv=0');    
}


function dialog_conve_fracc() {
    $("#vw_conve_fracc").dialog({
        autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,        
        title: "<div class='widget-header'><h4>.: CONVENIO DE FRACCIONAMIENTO :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-fax'></i>&nbsp; Realizar Fraccionamiento",
                "class": "btn btn-success",
                click: function () {fraccionamiento();}
            },{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }],
        open: function(){limpiar_form_conve();}       
    }).dialog('open');
    
    grid_deuda_arbitrios();
}
function fraccionamiento(){
    $("#vw_conve_fracc_fraccionar").dialog({
        autoOpen: false, modal: true, width: 700, show: {effect: "fade", duration: 300}, resizable: false,        
        title: "<div class='widget-header'><h4>.: CONVENIO DE FRACCIONAMIENTO :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-trash-o'></i>&nbsp; Limpiar Tabla",
                "class": "btn btn-warning",
                click: function () {limpiar_vista_fraccionamiento();}
            },{
                html: "<i class='fa fa-fax'></i>&nbsp; Guardar Convenio",
                "class": "btn btn-primary",
                click: function () {}
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }],
        open: function(){}       
    }).dialog('open');
    $("#vw_conve_fracc_fracc_tot").val($("#vw_conve_fracc_ttotal").val().replace(',',''));
}
function realizar_table_fracc(){
    
    tif=parseFloat($("#vw_conve_fracc_fracc_tim").val())/100;
    total=parseFloat($("#vw_conve_fracc_fracc_tot").val());
    inicial=parseFloat($("#vw_conve_fracc_fracc_inicial").val());
    n_cuotas=parseFloat($("#vw_conve_fracc_fracc_n_cuo").val());
    deuda_total=(total-inicial);

    cc=((tif*Math.pow(1+tif,n_cuotas))/(Math.pow(1+tif,n_cuotas)-1))*deuda_total;
    fecha=$("#vw_conve_fracc_fracc_fecha").val();
    
    amor=0;saldo=0;interes=0;deuda=0;
    t_deuda=0;t_amor=0;t_inter=0;t_cc=0;
    for(i=1;i<=n_cuotas;i++){
        
        if(i==1){saldo=total-inicial;}
        interes=tif*saldo;
        amor=cc-interes;
        deuda=saldo-amor;
        saldo=deuda;
        if(deuda==-0.00){deuda=-1*(0.00);}
        $('#t_dina_conve_fracc').append(
        "<tr>\n\
            <td>" + i + "</td>\n\
            <td><label class='input'><input id='td_din_prod_" + i + "' type='text' value='" + formato_numero(Math.abs(deuda),2) + "' disabled='' class='input-xs text-align-right'></label></td>\n\
            <td><label class='input'><input id='td_din_cant_" + i + "' type='text' value='" + formato_numero(amor,2) + "' disabled='' class='input-xs text-align-right' style='font-size:12px'></label></td>\n\
            <td><label class='input'><input id='td_din_porc_" + i + "' type='text' value='" + formato_numero(interes,2) + "' disabled='' class='input-xs text-align-right' style='font-size:12px'></label></td>\n\
            <td><label class='input'><input id='td_din_porc_" + i + "' type='text' value='" + formato_numero(cc,2) + "' disabled='' class='input-xs text-align-right' style='font-size:12px'></label></td>\n\
            <td><label class='input'><input id='td_din_porc_" + i + "' type='text' value='" + sumaFecha(i*30,fecha) + "' disabled='' class='input-xs text-align-right' style='font-size:12px'></label></td>\n\
        </tr>");
//        t_deuda=t_deuda+deuda;
        t_amor=t_amor+amor;
        t_inter=t_inter+interes;
        t_cc=t_cc+cc;
    }
    $("#vw_con_fracc_tot_amor").val(formato_numero(t_amor,2));
    $("#vw_con_fracc_tot_inter").val(formato_numero(t_inter,2));
    $("#vw_con_fracc_tot_cc").val(formato_numero(t_cc,2));
}
function fn_bus_contrib(){
    if($("#vw_conve_fracc_contrib").val()=="")
    {
        mostraralertasconfoco("Ingrese un Contribuyente para Buscar","#vw_conve_fracc_contrib"); 
        return false;
    }
    if($("#vw_conve_fracc_contrib").val().length<4)
    {
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#vw_conve_fracc_contrib"); 
        return false;
    }
    jQuery("#table_contrib").jqGrid('setGridParam', {url: 'obtiene_cotriname?dat='+$("#vw_conve_fracc_contrib").val()}).trigger('reloadGrid');

    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
       
}
function fn_bus_contrib_list(per){
    $("#vw_conve_fracc_id_pers").val(per);
    
    $("#vw_conve_fracc_cod_contrib").val($('#table_contrib').jqGrid('getCell',per,'id_per'));    
    $("#vw_conve_fracc_contrib").val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    $("#vw_conve_fracc_domicilio").val($('#table_contrib').jqGrid('getCell',per,'dom_fiscal'));
    tam=($('#table_contrib').jqGrid('getCell',per,'contribuyente')).length;
    anio=$("#vw_emi_rec_imp_pre_anio").val();
    
    $("#vw_conve_fracc_contrib").attr('maxlength',tam);
//    id_pers=$('#table_contrib').jqGrid('getCell',per,'id_pers');
//    fn_actualizar_grilla('table_cta_cte2','get_grid_cta_cte2?id_pers='+id_pers+'&ano_cta='+anio);
    $("#dlg_bus_contr").dialog("close");    
}

function grid_deuda_arbitrios(){
    jQuery("#table_Deuda_Contrib_Arbitrios").jqGrid({
        url: 'grid_deu_contrib_arbitrios',
        datatype: 'json', mtype: 'GET',
        height: 100, autowidth: true,
        colNames: ['tipo', 'Deuda','Año','Select'],
        rowNum: 5, sortname: 'anio', sortorder: 'desc', viewrecords: true,caption:'Deuda Contribuyente', align: "center",
        colModel: [            
            {name: 'tipo', index: 'tipo', width: 60},
            {name: 'deuda_arb', index: 'deuda_arb', width: 60},
            {name: 'anio', index: 'anio', width: 60},
            {name: 'check', index: 'check', width: 60}
        ],
        pager: '#pager_table_Deuda_Contrib_Arbitrios',
        rowList: [10, 20],
        gridComplete: function () {
            var rows = $("#table_Deuda_Contrib_Arbitrios").getDataIDs();
            if (rows.length > 0) {
                var firstid = jQuery('#table_Deuda_Contrib_Arbitrios').jqGrid('getDataIDs')[0];
                $("#table_Deuda_Contrib_Arbitrios").setSelection(firstid);
            }
            $("#vw_conve_fracc_ttotal").val('0.00');
        },            
        ondblClickRow: function (Id) {}
    });    
}
tot_deuda=0;
function check_tot_fracc(val,source){
    if($(source).is(':checked')){
        tot_deuda=tot_deuda+val;
    } else {
        tot_deuda=tot_deuda-val;      
    }
    $("#vw_conve_fracc_ttotal").val(formato_numero(tot_deuda,2,'.',','));
}
function limpiar_form_conve(){}

function limpiar_vista_fraccionamiento(){
    $("#t_dina_conve_fracc > tbody > tr").remove();
    $("#vw_con_fracc_tot_amor,#vw_con_fracc_tot_inter,#vw_con_fracc_tot_cc").val('000.00');
}





sumaFecha = function(d, fecha){
    var Fecha = new Date();
    var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
    var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
    var aFecha = sFecha.split(sep);
    var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
    fecha= new Date(fecha);
    fecha.setDate(fecha.getDate()+parseInt(d));
    var anno=fecha.getFullYear();
    var mes= fecha.getMonth()+1;
    var dia= fecha.getDate();
    mes = (mes < 10) ? ("0" + mes) : mes;
    dia = (dia < 10) ? ("0" + dia) : dia;
    var fechaFinal = dia+sep+mes+sep+anno;
    return (fechaFinal);
}
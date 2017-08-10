
function dialog_conve_fracc() {
    $("#vw_conve_fracc").dialog({
        autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
        position: [210,50],
        create: function (event) { $(event.target).parent().css('position', 'fixed');},
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
        autoOpen: false, modal: true, width: 750, show: {effect: "fade", duration: 300}, resizable: false,        
        title: "<div class='widget-header'><h4>.: CONVENIO DE FRACCIONAMIENTO :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-trash-o'></i>&nbsp; Limpiar Tabla",
                "class": "btn btn-warning",
                click: function () {limpiar_vista_fraccionamiento();}
            },{
                html: "<i class='fa fa-print'></i>&nbsp; Guardar e Imprimir Convenio",
                "class": "btn btn-primary",
                click: function () {insert_convenio();}
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }],
        open: function(){
            $("#vw_conve_fracc_fracc_porc_cuo_ini,#vw_conve_fracc_fracc_porc_cuo_ini_min").val('20');
        }       
    }).dialog('open');
    $("#vw_conve_fracc_fracc_tot").val($("#vw_conve_fracc_ttotal").val().replace(',',''));    
    
    
}

function insert_convenio(){    
    $.confirm({
        title: '.:Convenio:.',
        content: 'Realizar Convenio de Fraccionamiento',
        buttons: {
            Confirmar: function () {
                MensajeDialogLoadAjax('vw_conve_fracc_fraccionar', 'Guardando Convenio...');
                $.ajax({
                    url: 'conve_fraccionamiento/create',
                    type: 'GET',
                    data: {
                        nro_convenio     :1,            
                        cod_convenio     :$("#vw_conve_fracc_fracc_cod_conve").val(),
                        id_contribuyente :$("#vw_conve_fracc_id_pers").val(),            
                        interes          :$("#vw_conve_fracc_fracc_tim").val(),
                        nro_cuotas       :$("#vw_conve_fracc_fracc_n_cuo").val(),
                        total_convenio   :$("#vw_conve_fracc_fracc_tot").val().replace(',',''),
                        estado           :1,
                        detalle_fracci   :($("#vw_conve_fracc_fracc_glosa").val()).toUpperCase(),
                        period_desde     :($("#td_din_fecha_1").val()).substr(-4),
                        period_hast      :($("#td_din_fecha_"+$("#vw_conve_fracc_fracc_n_cuo").val()).val()).substr(-4),
                        porc_cuo_inic    :$("#vw_conve_fracc_fracc_porc_cuo_ini").val(),
                        cuota_inicial    :$("#vw_conve_fracc_fracc_inicial").val()
                    },
                    success: function (data) {
                        if (data) {
                            array_det_convenio(data);
                        } else {
                            mostraralertas('* Ha Ocurrido un Error al Guardar Convenio.<br>* Actualice el Sistema e Intentelo Nuevamente.');
                        }
                    },
                    error: function (data) {
                        mostraralertas('* Error de Red.<br>* Contactese con el Administrador.');
                        MensajeDialogLoadAjaxFinish('vw_conve_fracc_fraccionar');
                    }
                });
            },
            Cancelar: function () {}
        }
    });
    
}
function array_det_convenio(cod_conv_det) {
    n_cuotas = $("#vw_conve_fracc_fracc_n_cuo").val();
    for (i = 1; i <= n_cuotas; i++) {
        btn_insert_det_conv(i, cod_conv_det);        
    }
    fn_actualizar_grilla('table_Convenios','grid_Convenios?anio='+$("#vw_conve_fracc_cb_anio").val());
    MensajeDialogLoadAjaxFinish('vw_conve_fracc_fraccionar');
    dialog_close('vw_conve_fracc_fraccionar');
    dialog_close('vw_conve_fracc');
    setTimeout(function(){
         window.open('imp_cronograma_Pago_Fracc?cod_conv_det='+cod_conv_det+'&id_contrib='+$("#vw_conve_fracc_id_pers").val());
    }, 1000);
   
    MensajeExito('CONVENIO MDCC', 'El Convenio se Realizó Exitosamente.');
    
}
function btn_insert_det_conv(n_cuo, cod_conv_det) {
    $.ajax({
        url: 'convenio_detalle/create',
        type: 'GET',
        data: {
            cod_conv_det:cod_conv_det,
            nro_cuota   :n_cuo,
            monto       :$("#td_din_amor_"+n_cuo).val(),
            interes     :$("#td_din_inter_"+n_cuo).val(),
            fec_pago    :$("#td_din_fecha_"+n_cuo).val(),
            total       :$("#td_din_cc_"+n_cuo).val(),
            estado      :0,
            fecha_q_pago:'',
            saldo       :$("#td_din_saldo_"+n_cuo).val()
        },
        success: function (data) {
            if (data) {
                return true;
            }
        },
        error: function (data) {
            return false;
        }
    });
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
//        if(deuda==-0.00){deuda=-1*(0.00);}
        $('#t_dina_conve_fracc').append(
        "<tr>\n\
            <td>" + i + "</td>\n\
            <td><label class='input'><input id='td_din_saldo_" + i + "' type='text' value='" + formato_numero(Math.abs(saldo),2,'.') + "' disabled='' class='input-xs text-align-right'></label></td>\n\
            <td><label class='input'><input id='td_din_amor_" + i + "' type='text' value='" + formato_numero(amor,2,'.') + "' disabled='' class='input-xs text-align-right' style='font-size:12px'></label></td>\n\
            <td><label class='input'><input id='td_din_inter_" + i + "' type='text' value='" + formato_numero(interes,2,'.') + "' disabled='' class='input-xs text-align-right' style='font-size:12px'></label></td>\n\
            <td><label class='input'><input id='td_din_cc_" + i + "' type='text' value='" + formato_numero(cc,2,'.') + "' disabled='' class='input-xs text-align-right' style='font-size:12px'></label></td>\n\
            <td><label class='input'><input id='td_din_fecha_" + i + "' type='text' value='" + sumaFecha(i*30,fecha) + "' disabled='' class='input-xs text-align-right' style='font-size:12px'></label></td>\n\
        </tr>");
//        t_deuda=t_deuda+deuda;
        t_amor=t_amor+amor;
        t_inter=t_inter+interes;
        t_cc=t_cc+cc;
    }
    $("#vw_con_fracc_tot_amor").val(formato_numero(t_amor,2,'.',','));
    $("#vw_con_fracc_tot_inter").val(formato_numero(t_inter,2,'.',','));
    $("#vw_con_fracc_tot_cc").val(formato_numero(t_cc,2,'.',','));
}

function calc_inicial(value){    
    monto_min=$("#vw_conve_fracc_fracc_porc_cuo_ini_min").val();   
    if(parseFloat(value)<parseFloat(monto_min)){
        mostraralertas('Minimo: '+monto_min+'<br>Ingrese un valor mayor');
        $("#vw_conve_fracc_fracc_porc_cuo_ini").val(monto_min);
        return false;
    }
    total=parseFloat($("#vw_conve_fracc_fracc_tot").val());
    inicial=(value/100)*total;
    
    $("#vw_conve_fracc_fracc_inicial").val(formato_numero(inicial,2,'.'));
}
function calc_deuda(value){    
    total=parseFloat($("#vw_conve_fracc_fracc_tot").val());
    $("#vw_conve_fracc_fracc_deuda").val((total-value).toFixed(2));
}

function sel_tip_fracc(porcent){
    por = (porcent).substr(-3, 2);    
    $("#vw_conve_fracc_fracc_porc_cuo_ini_min,#vw_conve_fracc_fracc_porc_cuo_ini").val(por);
    calc_inicial(por);
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
    
    switch (mes) {
        case '01':
            mes='ene';
            break
        case '02':            
            mes='feb';
            break
        case '03':            
            mes='mar';
            break
        case '04':            
            mes='abr';
            break
        case '05':            
            mes='may';
            break
        case '06':            
            mes='jun';
            break
        case '07':            
            mes='jul';
            break
        case '08':            
            mes='ago';
            break
        case '09':            
            mes='sep';
            break
        case 10:            
            mes='oct';
            break
        case 11:            
            mes='nov';
            break
        case 12:            
            mes='dic';
            break;        
        default:
    }
    
    var fechaFinal = dia+sep+mes+sep+anno;
    return (fechaFinal);
};
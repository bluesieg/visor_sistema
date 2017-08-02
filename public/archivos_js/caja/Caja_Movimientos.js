
function dialog_caja_mov_realizar_pago(){
    id_recibo = $('#tabla_Caja_Movimientos').jqGrid ('getGridParam', 'selrow');
    if($("#vw_caja_mov_txt_tipo_recibo").val()!=1 || id_recibo==null){
        return false;
    }
    
    $("#vw_caja_mov_realizar_pago").dialog({
        autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:"+$("#vw_caja_mov_cajero").val()+":.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Confirmar Pago",
                "class": "btn btn-primary",
                click: function () {                    
                    confirmar_Pago(id_recibo);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        close: function (event, ui) {
            limpiar_form_caja_mov_pago();
        }
    }).dialog('open');   
    
    $("#vw_caja_mov_txt_nro_recibo").val($("#tabla_Caja_Movimientos").getCell(id_recibo, "nro_recibo_mtr"));
    $("#vw_caja_mov_txt_descripcion").val($("#tabla_Caja_Movimientos").getCell(id_recibo, "glosa"));
    $("#vw_caja_mov_txt_tot_pagar").val($("#tabla_Caja_Movimientos").getCell(id_recibo, "total"));
}
function select_id_caja(caja){
    id_caja = caja;
}
function confirmar_Pago(id_recibo){
    id_caja = $("#vw_caja_id_cajero").val();
    
    $.ajax({
        url: 'caja_movimient/'+id_recibo+'/edit',
        type: 'GET',
        data: {
            id_tip_pago:$("#vw_caja_mov_txt_tip_pago").val(),
            id_caja:id_caja,
            id_pers:$("#tabla_Caja_Movimientos").getCell(id_recibo, "id_contrib")
        },
        success: function (data) {
            if(data){
                imp_pago_rec(id_recibo);
                fn_actualizar_grilla('tabla_Caja_Movimientos', 'grid_Caja_Movimientos?est_recibo=' + $("#vw_caja_mov_txt_tipo_recibo").val());
//                printTrigger('imp_pago_rec?id_rec='+id_recibo);                
//                dialog_close('vw_caja_mov_realizar_pago');
//                MensajeExito('Conforme', 'EL Pago se ha realizado con Exito');
            }
        },
        error: function (data) {
            MensajeAlerta('Error de Red.', 'Contactese con el Administrador');
        }
    });
}

function imp_pago_rec(id_recibo){
//    window.open('imp_pago_rec');
    $("#vw_caja_mov_confirm_pago_reporte").dialog({
        autoOpen: false, modal: true, width: 850,height:600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:RECIBO:.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Confirmar e Imprimir",
                "class": "btn btn-primary",
                click: function () {
//                    printTrigger('imp_pago_rec?id_rec='+id_recibo);
                    dialog_close('vw_caja_mov_confirm_pago_reporte');
                    dialog_close('vw_caja_mov_realizar_pago');
                    MensajeExito('Conforme', 'EL Pago se ha realizado con Exito');
                }
            }]        
    }).dialog('open');
    
    $('#print_recibo_pagado').attr('src','imp_pago_rec?id_rec='+id_recibo);
    
}
function printTrigger(url) {    
        var iframe = this._printIframe;
        if (!this._printIframe) {
          iframe = this._printIframe = document.createElement('iframe');
          document.body.appendChild(iframe);

          iframe.style.display = 'none';
          iframe.onload = function() {
            setTimeout(function() {
              iframe.focus();
              iframe.contentWindow.print();
            }, 1);
          };
        }        
    iframe.src = url;
}

function select_tipo_recibo(id_tip_recibo){
    fn_actualizar_grilla('tabla_Caja_Movimientos', 'grid_Caja_Movimientos?est_recibo=' + id_tip_recibo);
}

function limpiar_form_caja_mov_pago(){
//    $("#vw_caja_mov_txt_nro_recibo").val('');
//    $("#vw_caja_mov_txt_usuario").val('');
    $("#vw_caja_mov_txt_descripcion").val('');
}



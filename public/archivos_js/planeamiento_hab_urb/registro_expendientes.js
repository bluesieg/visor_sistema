function limpiar_datos(){
    $('#inp_cod_exp').val("");
}


function crear_nuevo_exp()
{
    limpiar_datos();
    $("#dlg_nuevo_exp").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO EXPEDIENTE :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    obtener_exp();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_exp").dialog('open');
}

function obtener_exp()
{
    MensajeDialogLoadAjax('dlg_nuevo_exp', '.:: Cargando ...');
        $.ajax({url: 'registro_expedientes/create',
        type: 'GET',
        data:{cod:$("#inp_cod_exp").val()},
        success: function(data) 
        {
            if (data.msg === 'no'){
                    mostraralertas("Mensaje del Sistema, NO EXISTE EL NUMERO DE EXPEDIENTE");
                    limpiar_datos();
            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
                }else{
                    MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
                    fn_actualizar_grilla('table_expedientes');
                    dialog_close('dlg_nuevo_exp');
                    MensajeExito('Nuevo Expediente Creado', 'El Expediente se ha creado correctamente.');
                }
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
        }
        }); 
}

function selecciona_fecha(){

    fecha_desde = $("#dlg_fec_desde").val(); 
    fecha_hasta = $("#dlg_fec_hasta").val(); 

    jQuery("#table_expedientes").jqGrid('setGridParam', {
         url: 'getExpedientes?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta
    }).trigger('reloadGrid');

}

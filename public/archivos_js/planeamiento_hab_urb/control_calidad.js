

function pasar_inspeccion(){
    
    Id=$('#table_control_calidad').jqGrid ('getGridParam', 'selrow');
    estado = $('#table_control_calidad').jqGrid ('getCell', Id, 'fase');
    if(Id)
    {
        if(estado == 10){
           mostraralertasconfoco("El Expediente no puede pasar a Inspeccion Porque esta Notificado");
        }else{
    
                id_control_calidad = $('#table_control_calidad').jqGrid ('getGridParam', 'selrow');
                inspector = $('#select_inspector').val();

                $.ajax({url: 'asignar_expediente',
                    type: 'GET',
                    data:{id_control_calidad:id_control_calidad,inspector:inspector},
                    success: function(data) 
                    {
                        fn_actualizar_grilla('table_control_calidad');
                        fn_actualizar_grilla('table_inspeccion');
                        MensajeExito('Expediente', 'El Expediente Paso a Inspeccion.');
                    },
                    error: function(data) {
                        mostraralertas("hubo un error, Comunicar al Administrador");
                        console.log('error');
                        console.log(data);
                    }
                    }); 
              }
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_control_calidad");
    }
}


function crear_nueva_notificacion()
{
    Id=$('#table_control_calidad').jqGrid ('getGridParam', 'selrow');
    estado = $('#table_control_calidad').jqGrid ('getCell', Id, 'fase');
    if(Id)
    {
        if(estado == 10){
           mostraralertasconfoco("El Expediente ya fue Notificado");
        }else{
        $("#dlg_registrar_notificacion").dialog({
            autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVA NOTIFICACION :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        registrar_notificacion();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_registrar_notificacion").dialog('open');
        }
    }
    else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_control_calidad");
    }
}

function registrar_notificacion(){
    
    nro_expediente = $('#hidden_id').val();
    notificacion = $('#inp_reg_noti').val();
    MensajeDialogLoadAjax('dlg_registrar_notificacion', '.:: Cargando ...');
        $.ajax({url: 'registrar_notificacion',
            type: 'GET',
            data:{nro_expediente:nro_expediente,notificacion:notificacion},
            success: function(data) 
            {
                MensajeDialogLoadAjaxFinish('dlg_registrar_notificacion');
                fn_actualizar_grilla('table_control_calidad');
                dialog_close('dlg_registrar_notificacion');
                MensajeExito('Expediente', 'Se Registro la Notificacion.');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('dlg_registrar_notificacion');
                console.log('error');
                console.log(data);
            }
        });
    
}

function check_cambiar_estado(val){
    fecha_desde = $("#dlg_fecha_desde_cc").val(); 
    fecha_hasta = $("#dlg_fecha_hasta_cc").val();
    if($(val).is(':checked')){
        jQuery("#table_control_calidad").jqGrid('setGridParam', {url: 'getExpedientes_ControlCalidad?check='+1+'&fecha_desde='+fecha_desde+'&fecha_hasta='+fecha_hasta }).trigger('reloadGrid');
    } else {
        jQuery("#table_control_calidad").jqGrid('setGridParam', {url: 'getExpedientes_ControlCalidad?check='+2+'&fecha_desde='+fecha_desde+'&fecha_hasta='+fecha_hasta }).trigger('reloadGrid');
    }
}


function actualizar_expediente(){
    
    id_control_calidad = $('#table_control_calidad').jqGrid ('getGridParam', 'selrow');
    
    $.ajax({url: 'actualizar_expediente',
            type: 'GET',
            data:{id_control_calidad:id_control_calidad},
            success: function(data) 
            {
                fn_actualizar_grilla('table_control_calidad');
                MensajeExito('Expediente', 'Se Restablecio el Expediente.');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
        });
}

function actualizar_inspeccion(){
    
    id_reg_exp = $('#table_inspeccion').jqGrid ('getGridParam', 'selrow');
    
    $.ajax({url: 'recuperar_expediente',
            type: 'GET',
            data:{id_reg_exp:id_reg_exp},
            success: function(data) 
            {
                fn_actualizar_grilla('table_inspeccion');
                fn_actualizar_grilla('table_control_calidad');
                MensajeExito('Expediente', 'Se Restablecio el Expediente.');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
        });
    
}


function cambiar_tipo(){

    fecha_desde = $("#dlg_fecha_desde_cc").val(); 
    fecha_hasta = $("#dlg_fecha_hasta_cc").val(); 

    jQuery("#table_control_calidad").jqGrid('setGridParam', {
         url: 'getExpedientes_ControlCalidad?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta
    }).trigger('reloadGrid');

}

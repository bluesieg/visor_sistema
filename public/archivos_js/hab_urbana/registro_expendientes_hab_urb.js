 function limpiar_datos(){
    $('#inp_cod_exp').val("");
}

function crear_nuevo_exp_hab_urb()
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
    codigo_exp = $("#inp_cod_exp").val();

    if (codigo_exp == '') {
        mostraralertasconfoco('* El campo Codigo de Expediente es obligatorio...', '#inp_cod_exp');
        return false;
    }
    MensajeDialogLoadAjax('dlg_nuevo_exp', '.:: Cargando ...');
        $.ajax({url: 'hab_urbana/create',
        type: 'GET',
        data:{cod:$("#inp_cod_exp").val()},
        success: function(data) 
        {
                if (data.msg === 'no'){
                    mostraralertasconfoco("Mensaje del Sistema, NO EXISTE EL NUMERO DE EXPEDIENTE");
                    limpiar_datos();
            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
                }else if(data.msg === 'repetido'){
                    mostraralertasconfoco("Mensaje del Sistema, EL NUMERO DE EXPEDIENTE YA FUE REGISTRADO");
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
            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
        }
        }); 
}

function actualizar_exp_hab_urb()
{
    //limpiar_dl_ipm(1);
    $("#dlg_nuevo_exp_edit").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  EDITAR EXPEDIENTE :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                modificar_exp();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_exp_edit").dialog('open');


    MensajeDialogLoadAjax('dlg_nuevo_exp_edit', '.:: Cargando ...');

    id = $('#table_expedientes_hab_urb').jqGrid ('getGridParam', 'selrow');
    $.ajax({url: 'traer_datos/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#nro_expediente").val(r[0].nro_exp);
            $("#gestor_tramite").val(r[0].gestor);
            $("#fecha_inicio").val(r[0].fecha_inicio_tramite);
            $("#fecha_registro").val(r[0].fecha_registro);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_edit');

        },
        error: function(data) {
            mostraralertas("Hubo un Error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_edit');
        }
    });
    
}

function modificar_exp(){
    
    nro_exp = $("#nro_expediente").val();
    gestor = $("#gestor_tramite").val();
    f_inicio = $("#fecha_inicio").val();
    f_registro = $("#fecha_registro").val();

    if (nro_expediente == '') {
        mostraralertasconfoco('* El campo Numero de Expediente es obligatorio...', '#nro_expediente');
        return false;
    }
    if (gestor == '') {
        mostraralertasconfoco('* El campo Gestor del Tramite es obligatorio...', '#gestor_tramite');
        return false;
    }
    if (f_inicio == '') {
        mostraralertasconfoco('* El campo Fecha Inicio es obligatorio...', '#fecha_inicio');
        return false;
    }
    if (f_registro == '') {
        mostraralertasconfoco('* El campo Fecha Registro es obligatorio...', '#fecha_registro');
        return false;
    }
    
    id = $('#table_expedientes_hab_urb').jqGrid ('getGridParam', 'selrow');
    MensajeDialogLoadAjax('dlg_nuevo_exp_edit', '.:: CARGANDO ...');
    
    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'hab_urbana/'+id+'/edit',
                    type: 'GET',
                    data: {
                        id_reg_exp:id,
                        nro_exp: nro_exp,
                        gestor: gestor,
                        fecha_inicio_tramite: f_inicio,
                        fecha_registro: f_registro
                    },
                    success: function (data) {
                        if (data.msg === 'repetido'){
                            mostraralertasconfoco("Mensaje del Sistema, EL NUMERO DE EXPEDIENTE YA FUE REGISTRADO");
                            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
                            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
                        }else{
                             MensajeExito('Editar Registro Expediente', 'EXPEDIENTE: '+ id + '  -  Ha sido Modificado.');
                            fn_actualizar_grilla('table_expedientes_hab_urb');
                            dialog_close('dlg_nuevo_exp_edit');
                            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_edit', '.:: CARGANDO ...');
                        }
                    },
                    error: function (data) {
                        mostraralertas('* Contactese con el Administrador...');
                        MensajeAlerta('Editar Registro Expediente','Ocurrio un Error en la Operacion.');
                        dialog_close('dlg_nuevo_exp_edit');
                        MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_edit', '.:: CARGANDO ...');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Editar Registro Expediente','Operacion Cancelada.');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_edit', '.:: CARGANDO ...');

            }
        }
    });
}

function eliminar_exp_hab_urb(){
    id = $('#table_expedientes_hab_urb').jqGrid ('getGridParam', 'selrow');

    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'hab_urbana/destroy',
                    type: 'POST',
                    data: {_method: 'delete', id_reg_exp: id},
                    success: function (data) {
                        fn_actualizar_grilla('table_expedientes_hab_urb');
                        MensajeExito('Eliminar Registro Expediente', id + ' - Ha sido Eliminado');
                    },
                    error: function (data) {
                        MensajeAlerta('Eliminar Registro Expediente', id + ' - No se pudo Eliminar.');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Eliminar Registro Expediente','Operacion Cancelada.');
            }

        }
    });
    
}

function selecciona_fecha1(){

    fecha_desde = $("#dlg_fec_desde1").val(); 
    fecha_hasta = $("#dlg_fec_hasta1").val(); 

    jQuery("#table_expedientes_hab_urb").jqGrid('setGridParam', {
         url: 'getExpedientesHabUrb?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta
    }).trigger('reloadGrid');

}

/////////////enviar a verif administrativa

function enviar_a_verif_administrativa()
{
    Id=$('#table_expedientes_hab_urb').jqGrid ('getGridParam', 'selrow');
    if(Id)
    {
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'hab_urbana/'+Id+'/edit',
                    type: 'GET',
                    data:{estado:2},
                    success: function(data) 
                    {
                        MensajeExito('Expediente', 'Expediente Enviado a Verificación Administrativa');
                        fn_actualizar_grilla('table_expedientes_hab_urb');
                    },
                    error: function(data) {
                        mostraralertas("hubo un error, Comunicar al Administrador");
                        console.log('error');
                        console.log(data);
                    }
            });
    }
     else
    {
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_expedientes_hab_urb");
    }
}

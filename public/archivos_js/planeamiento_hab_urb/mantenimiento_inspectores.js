 function limpiar_datos(){
    $("#inp_dni_inspec").val("");
    $("#inp_nombre_inspec").val("");
}

 
function crear_nuevo_inspector()
{
    limpiar_datos();
    $("#dlg_nuevo_inspec").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO INSPECTOR :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_inspec();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_inspec").dialog('open');
}

function guardar_inspec(){
    dni = $("#inp_dni_inspec").val();
    apenom = $("#inp_nombre_inspec").val();


    MensajeDialogLoadAjax('dlg_nuevo_inspec', '.:: Cargando ...');
    
    $.ajax({url: 'mantenimiento_inspectores/create',
            type: 'GET',
            data:{dni:dni,apenom:apenom},
            success: function(data) 
            {
                fn_actualizar_grilla('table_inspectores');
                MensajeExito('INSPECTOR', 'Se Registraron los datos.');
                dialog_close('dlg_nuevo_inspec');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_inspec');
                
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
        });
        
}

function actualizar_insp()
{
    //limpiar_dl_ipm(1);
    $("#dlg_nuevo_inspec").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  EDITAR INSPECTOR :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                modificar_insp();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_inspec").dialog('open');


    MensajeDialogLoadAjax('dlg_nuevo_inspec', '.:: Cargando ...');

    id = $('#table_inspectores').jqGrid ('getGridParam', 'selrow');
    $.ajax({url: 'mantenimiento_inspectores/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#inp_dni_inspec").val(r[0].dni);
            $("#inp_nombre_inspec").val(r[0].apenom);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_inspec');

        },
        error: function(data) {
            mostraralertas("Hubo un Error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_inspec');
        }
    });
    
}

function modificar_insp(){
    
    dni = $("#inp_dni_inspec").val();
    apenom = $("#inp_nombre_inspec").val();

    if (dni == '') {
        mostraralertasconfoco('* El campo DNI es obligatorio...', '#inp_dni_inspec');
        return false;
    }
    if (apenom == '') {
        mostraralertasconfoco('* El campo Nombre es obligatorio...', '#inp_nombre_inspec');
        return false;
    }
    
    id = $('#table_inspectores').jqGrid ('getGridParam', 'selrow');
    MensajeDialogLoadAjax('dlg_nuevo_inspec', '.:: CARGANDO ...');
    
    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'mantenimiento_inspectores/'+id+'/edit',
                    type: 'GET',
                    data: {
                        id_inspector:id,
                        dni: dni,
                        apenom: apenom
                    },
                    success: function (data) {
                        if (data.msg === 'repetido'){
                            mostraralertasconfoco("Mensaje del Sistema, EL NUMERO DE DNI YA FUE REGISTRADO");
                            MensajeDialogLoadAjaxFinish('dlg_nuevo_inspec');
                        }else{
                             MensajeExito('Editar Registro Inspectores', 'INSPECTOR: '+ id + '  -  Ha sido Modificado.');
                            fn_actualizar_grilla('table_inspectores');
                            dialog_close('dlg_nuevo_inspec');
                            MensajeDialogLoadAjaxFinish('dlg_nuevo_inspec', '.:: CARGANDO ...');
                        }
                    },
                    error: function (data) {
                        mostraralertas('* Contactese con el Administrador...');
                        MensajeAlerta('Editar Registro Inpector','Ocurrio un Error en la Operacion.');
                        dialog_close('dlg_nuevo_inspec');
                        MensajeDialogLoadAjaxFinish('dlg_nuevo_inspec', '.:: CARGANDO ...');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Editar Inspector','Operacion Cancelada.');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_inspec', '.:: CARGANDO ...');

            }
        }
    });
}

function eliminar_insp(){
    id = $('#table_inspectores').jqGrid ('getGridParam', 'selrow');

    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'mantenimiento_inspectores/destroy',
                    type: 'POST',
                    data: {_method: 'delete', id_inspector: id},
                    success: function (data) {
                        fn_actualizar_grilla('table_inspectores');
                        MensajeExito('Eliminar Inspector', id + ' - Ha sido Eliminado');
                    },
                    error: function (data) {
                        MensajeAlerta('Eliminar Inspector', id + ' - No se pudo Eliminar.');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Eliminar Inspector','Operacion Cancelada.');
            }

        }
    });
    
}
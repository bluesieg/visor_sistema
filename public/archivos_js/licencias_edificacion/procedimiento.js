 function limpiar_datos(){
    $("#inp_descripcion").val("");
}

 
function crear_nuevo_procedimiento()
{
    limpiar_datos();
    $("#inp_anio").val($("#select_anio").val());
    $("#dlg_nuevo_procedimiento").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO PROCEDIMIENTO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_procedimiento();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_procedimiento").dialog('open');
}

function guardar_procedimiento(){
    anio = $("#inp_anio").val();
    descripcion = $("#inp_descripcion").val();
    
     if (anio == '') {
        mostraralertasconfoco('* El campo Año es obligatorio...', '#inp_anio');
        return false;
    }
    if (descripcion == '') {
        mostraralertasconfoco('* El campo Descripcion es obligatorio...', '#inp_descripcion');
        return false;
    }

    MensajeDialogLoadAjax('dlg_nuevo_procedimiento', '.:: Cargando ...');
    
    $.ajax({url: 'procedimientos/create',
            type: 'GET',
            data:{descripcion:descripcion,anio:anio},
            success: function(data) 
            {
                fn_actualizar_grilla('table_procedimientos');
                MensajeExito('Procedimiento', 'Se Registraron los datos.');
                dialog_close('dlg_nuevo_procedimiento');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_procedimiento');
                
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
        });
        
}

function modificar_procedimiento()
{
    $("#dlg_nuevo_procedimiento").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  EDITAR PROCEDIMIENTO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                actualizar_procedimiento();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_procedimiento").dialog('open');


    MensajeDialogLoadAjax('dlg_nuevo_procedimiento', '.:: Cargando ...');

    id = $('#table_procedimientos').jqGrid ('getGridParam', 'selrow');
    $.ajax({url: 'procedimientos/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#inp_anio").val(r[0].anio);
            $("#inp_descripcion").val(r[0].descr_procedimiento);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_procedimiento');

        },
        error: function(data) {
            mostraralertas("Hubo un Error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_procedimiento');
        }
    });
    
}

function actualizar_procedimiento(){
    
    anio = $("#inp_anio").val();
    descripcion = $("#inp_descripcion").val();

    if (anio == '') {
        mostraralertasconfoco('* El campo Año es obligatorio...', '#inp_anio');
        return false;
    }
    if (descripcion == '') {
        mostraralertasconfoco('* El campo Descripcion es obligatorio...', '#inp_descripcion');
        return false;
    }
    
    id = $('#table_procedimientos').jqGrid ('getGridParam', 'selrow');
    MensajeDialogLoadAjax('dlg_nuevo_procedimiento', '.:: CARGANDO ...');
    
    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'procedimientos/'+id+'/edit',
                    type: 'GET',
                    data: {
                        id_procedimiento:id,
                        anio: anio,
                        descripcion: descripcion
                    },
                    success: function (data) {
                     
                        MensajeExito('Editar Registro Procedimiento', 'PROCEDIMIENTO: '+ id + '  -  Ha sido Modificado.');
                        fn_actualizar_grilla('table_procedimientos');
                        dialog_close('dlg_nuevo_procedimiento');
                        MensajeDialogLoadAjaxFinish('dlg_nuevo_procedimiento', '.:: CARGANDO ...');
                       
                    },
                    error: function (data) {
                        mostraralertas('* Contactese con el Administrador...');
                        MensajeAlerta('Editar Registro Procedimiento','Ocurrio un Error en la Operacion.');
                        dialog_close('dlg_nuevo_procedimiento');
                        MensajeDialogLoadAjaxFinish('dlg_nuevo_procedimiento', '.:: CARGANDO ...');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Editar Procedimiento','Operacion Cancelada.');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_procedimiento', '.:: CARGANDO ...');

            }
        }
    });
}

function eliminar_procedimiento(){
    id = $('#table_procedimientos').jqGrid ('getGridParam', 'selrow');

    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'procedimientos/destroy',
                    type: 'POST',
                    data: {_method: 'delete', id_procedimiento: id},
                    success: function (data) {
                        fn_actualizar_grilla('table_procedimientos');
                        MensajeExito('Eliminar Procedimiento', id + ' - Ha sido Eliminado');
                    },
                    error: function (data) {
                        MensajeAlerta('Eliminar Procedimiento', id + ' - No se pudo Eliminar.');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Eliminar Procedimiento','Operacion Cancelada.');
            }

        }
    });
    
}
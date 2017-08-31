function clicknewsector()
{
    $("#dlg_nuevo_sector").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO SECTOR :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_sector(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_sector").dialog('open');
}

function clickmodsector()
{

    $("#dlg_nuevo_sector").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  EDITAR SECTOR :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_sector(2);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_sector").dialog('open');


    MensajeDialogLoadAjax('dlg_nuevo_sector', '.:: Cargando ...');

    id = $("#current_id").val();
    $.ajax({url: 'catastro_sectores/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#id_sector").val(r[0].id_sec);
            $("#sector").val(r[0].sector);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_sector');

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_sector');
        }
    });
}




function save_edit_sector(tipo) {

    sector = $("#sector").val();
    if(sector < '10' && sector >'0'){
        sector = '0'+sector;
    }
    //alert(sector);

    if (sector == "") {
        mostraralertasconfoco('* Ingrese un sector...', 'sector');
        return false;
    }

    if (tipo == 1) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'insert_new_sector',
            type: 'POST',
            data: {
                sector: sector,
            },
            success: function (data) {
                dialog_close('dlg_nuevo_sector');
                fn_actualizar_grilla('tabla_sectores', 'list_sectores');
                MensajeExito('Nuevo Contribuyente', 'El Sector Ha sido Insertado.');
            },
            error: function (data) {
                mostraralertas('* Contactese con el Administrador...');
            }
        });
    }
    else if (tipo == 2) {
        id = $("#current_id").val();
        MensajeDialogLoadAjax('dialog_new_edit_Contribuyentes', '.:: CARGANDO ...');
        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'update_sector',
                        type: 'POST',
                        data: {
                            id_sec: id,
                            sector: $('#sector').val()

                        },
                        success: function (data) {
                            MensajeExito('Editar Sector', 'Sector: '+ id + '  -  Ha sido Modificado.');
                            fn_actualizar_grilla('tabla_sectores', 'list_sectores');
                            dialog_close('dlg_nuevo_sector');
                            MensajeDialogLoadAjaxFinish('dlg_nuevo_sector', '.:: CARGANDO ...');
                        },
                        error: function (data) {
                            mostraralertas('* Contactese con el Administrador...');
                            MensajeAlerta('Editar Sector','Ocurrio un Error en la Operacion.');
                            dialog_close('dlg_nuevo_sector');
                            MensajeDialogLoadAjaxFinish('dlg_nuevo_sector', '.:: CARGANDO ...');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Editar Sector','Operacion Cancelada.');
                }
            }
        });

    }
}

function delete_sector() {
    id = $("#current_id").val();

    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'delete_Sector',
                    type: 'POST',
                    data: {id_sec: id},
                    success: function (data) {
//                        $.alert(raz_soc + '- Ha sido Eliminado');
                        fn_actualizar_grilla('tabla_sectores', 'list_sectores');
                        dialog_close('dlg_nuevo_sector');
                        MensajeExito('Eliminar Sector', id + ' - Ha sido Eliminado');
                    },
                    error: function (data) {
                        MensajeAlerta('Eliminar Sector', id + ' - No se pudo Eliminar.');
//                        mostraralertas('* Error al Eliminar Contribuyente...');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Eliminar Sector','Operacion Cancelada.');
            }

        }
    });
}


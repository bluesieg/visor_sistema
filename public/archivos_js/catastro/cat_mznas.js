function clicknewmznamasivo()
{
    $("#id_sector_masivo").val(0);
    $("#inicio").val('');
    $("#fin").val('');

    $("#dlg_manzana_masivo").dialog({
        autoOpen: false, modal: true, width: 400, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  CREAR MANZANAS MASIVO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                create_mznas_masivo();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_manzana_masivo").dialog('open');
}

function create_mznas_masivo() {

    id_sect = $("#id_sector_masivo").val();
    inicio = $("#inicio").val();
    fin = $("#fin").val();
    xsector = $("#id_sector_masivo option:selected").html();

    // alert(id_sect);
    if (id_sect == "" || codi_mzna == "" || mzna_dist == "") {
        mostraralertasconfoco('* Los campos son obligatorios...', 'id_sector_nuevo_editar');
        return false;
    }

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'create_mzna_masivo',
            type: 'POST',
            data: {
                xsector: xsector,
                id_sect: id_sect,
                inicio: inicio,
                fin:fin
            },
            success: function (data) {
                $("#id_sector_masivo").val(id_sect);
                dialog_close('dlg_manzana_masivo');
                fn_actualizar_grilla('tabla_manzanas', 'list_mzns_sector?id_sec=' + id_sect );
                MensajeExito('Nueva Manzana', 'La Manzana se a creado correctamente.');
            },
            error: function (data) {
                mostraralertas('* Contactese con el Administrador...');
            }
        });
}


function clicknewmzna()
{
    $("#dlg_manzana").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVA MANZANA :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_manzana(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_manzana").dialog('open');
}

function clickmodmzna()
{

    $("#dlg_manzana").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  EDITAR SECTOR :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                save_edit_manzana(2);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_manzana").dialog('open');


    MensajeDialogLoadAjax('dlg_manzana', '.:: Cargando ...');

    id = $("#current_id").val();
    $.ajax({url: 'catastro_mzns/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#id_mzna").val(r[0].id_mzna);
            $("#id_sector_nuevo_editar").val(r[0].id_sect);
            $("#codi_mzna").val(r[0].codi_mzna);
            $("#mzna_dist").val(r[0].mzna_dist);
            MensajeDialogLoadAjaxFinish('dlg_manzana');

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_manzana');
        }
    });
}




function save_edit_manzana(tipo) {

    id_sect = $("#id_sector_nuevo_editar").val();
    codi_mzna = $("#codi_mzna").val();
    mzna_dist = $("#mzna_dist").val();
    id_codigo = $("#id_sector_nuevo_editar option:selected").html() + String(codi_mzna);

   // alert(id_sect);
    if (id_sect == "" || codi_mzna == "" || mzna_dist == "") {
        mostraralertasconfoco('* Los campos son obligatorios...', 'id_sector_nuevo_editar');
        return false;
    }

    if (tipo == 1) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'insert_new_mzna',
            type: 'POST',
            data: {
                id_sect: id_sect,
                codi_mzna: codi_mzna,
                mzna_dist: mzna_dist,
                id_codigo:id_codigo
            },
            success: function (data) {
                dialog_close('dlg_manzana');
                fn_actualizar_grilla('tabla_manzanas', 'list_mzns_sector?id_sec=' + id_sect );
                MensajeExito('Nueva Manzana', 'La Manzana se a creado correctamente.');
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
                        url: 'update_mzna',
                        type: 'POST',
                        data: {
                            id_mzna:id,
                            id_sect: id_sect,
                            codi_mzna: codi_mzna,
                            mzna_dist: mzna_dist,
                            id_codigo:id_codigo

                        },
                        success: function (data) {
                            MensajeExito('Editar Sector', 'Sector: '+ id + '  -  Ha sido Modificado.');
                            fn_actualizar_grilla('tabla_manzanas', 'list_mzns_sector?id_sec=' + id_sect);
                            dialog_close('dlg_manzana');
                            MensajeDialogLoadAjaxFinish('dlg_manzana', '.:: CARGANDO ...');
                        },
                        error: function (data) {
                            mostraralertas('* Contactese con el Administrador...');
                            MensajeAlerta('Editar Sector','Ocurrio un Error en la Operacion.');
                            dialog_close('dlg_manzana');
                            MensajeDialogLoadAjaxFinish('dlg_manzana', '.:: CARGANDO ...');
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

function delete_mzna() {
    id = $("#current_id").val();
    id_sector = $("#select_sectores").val();

    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'delete_mzna',
                    type: 'POST',
                    data: {id_mzna: id},
                    success: function (data) {
//                        $.alert(raz_soc + '- Ha sido Eliminado');
                        fn_actualizar_grilla('tabla_manzanas', 'list_mzns_sector?id_sec=' + id_sector);
                        dialog_close('dlg_manzana');
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


function mzns_por_sector(id_sec){

    jQuery("#tabla_manzanas").jqGrid('setGridParam', {
        url: 'list_mzns_sector?id_sec=' + id_sec
    }).trigger('reloadGrid');

}


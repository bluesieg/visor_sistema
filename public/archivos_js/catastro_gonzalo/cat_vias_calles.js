function limpiar_dl_via_calle(tip)
{
    if(tip==1)
    {
        //$("#select_tipo_via").val(0);
        //$("#select_hab_urb").val(0);
        $('#cod_via').val("");
        $('#nom_calle').val("");
    }
}

function nuevo_via_calle()
{
    limpiar_dl_via_calle(1);
    $("#dlg_nuevo_cat_via_calle").dialog({
        autoOpen: false, modal: true, width: 350, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVA VIA - CALLE :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {

                guardar_editar_cat_via_calle(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_cat_via_calle").dialog('open');
}

function actualizar_via_calle()
{
    limpiar_dl_via_calle(1);
    $("#dlg_nuevo_cat_via_calle").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  EDITAR VIA - CALLE  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                guardar_editar_cat_via_calle(2);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_cat_via_calle").dialog('open');


    MensajeDialogLoadAjax('dlg_nuevo_cat_via_calle', '.:: Cargando ...');

    id = $("#current_id").val();
    $.ajax({url: 'conf_vias_calles/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#id_via_calle").val(r[0].id_via);
            $("#select_tipo_via").val(r[0].id_tip_via);
            $("#select_hab_urb").val(r[0].id_hab_urb);
            $("#cod_via").val(r[0].cod_via);
            $("#nom_calle").val(r[0].nom_via);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_cat_via_calle');

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_cat_via_calle');
        }
    });
}

function guardar_editar_cat_via_calle(tipo) {

    tipo_via = $("#select_tipo_via").val();
    hab_urb = $("#select_hab_urb").val();
    codigo_via = $("#cod_via").val();
    nombre_calle = $("#nom_calle").val();

   // alert(id_sect);
    if (codigo_via == '') {
        mostraralertasconfoco('* El campo Codigo de Via es obligatorio...', 'codigo_via');
        return false;
    }
    if (nombre_calle == '') {
        mostraralertasconfoco('* El campo Nombre de Calle es obligatorio...', 'nombre_calle');
        return false;
    }

    if (tipo == 1) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'insertar_nueva_via_calle',
            type: 'POST',
            data: {
                id_tip_via: tipo_via,
                id_hab_urb: hab_urb,
                cod_via: codigo_via,
                nom_via:nombre_calle
            },
            success: function (data) {
                if (data.msg === 'si'){
                    dialog_close('dlg_nuevo_cat_via_calle');
                    fn_actualizar_grilla('tabla_vias');
                    mostraralertasconfoco('* EL ITEM CON CODIGO DE VIA  '+ codigo_via + '  ESTA DUPLICADO...');
                }else{
                    dialog_close('dlg_nuevo_cat_via_calle');
                    fn_actualizar_grilla('tabla_vias');
                    MensajeExito('Calle - Via', 'El item se a creado correctamente.');
                }
            },
            error: function (data) {
                mostraralertas('* Contactese con el Administrador...');
            }
        });
    }
    else if (tipo == 2) {
        id = $("#current_id").val();
        MensajeDialogLoadAjax('dlg_nuevo_cat_via_calle', '.:: CARGANDO ...');
        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'modificar_via_calle',
                        type: 'POST',
                        data: {
                            id_via:id,
                            id_tip_via: tipo_via,
                            id_hab_urb: hab_urb,
                            cod_via: codigo_via,
                            nom_via:nombre_calle
                        },
                        success: function (data) {
                            
                            if (data.msg === 'si'){
                                dialog_close('dlg_nuevo_cat_via_calle');
                                fn_actualizar_grilla('tabla_vias');
                                mostraralertasconfoco('* EL ITEM CON CODIGO DE VIA  '+ codigo_via + '  ESTA DUPLICADO...');
                            }else{
                                MensajeExito('Editar Via Calle', 'Via Calle : '+ id + '  -  Ha sido Modificado.');
                                fn_actualizar_grilla('tabla_vias');
                                dialog_close('dlg_nuevo_cat_via_calle');
                                MensajeDialogLoadAjaxFinish('dlg_nuevo_cat_via_calle', '.:: CARGANDO ...');
                            }
                        },
                        error: function (data) {
                            mostraralertas('* Contactese con el Administrador...');
                            MensajeAlerta('Editar Via-Sector','Ocurrio un Error en la Operacion.');
                            dialog_close('dlg_nuevo_cat_via_calle');
                            MensajeDialogLoadAjaxFinish('dlg_nuevo_cat_via_calle', '.:: CARGANDO ...');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Editar Via-Calle','Operacion Cancelada.');
                    MensajeDialogLoadAjaxFinish('dlg_nuevo_cat_via_calle', '.:: CARGANDO ...');
                    
                }
            }
        });

    }
}

function ponerCeros(obj) {
  while (obj.value.length<6)
    obj.value = '0'+obj.value;
}

function eliminar_via_calle() {
    id = $("#current_id").val();

    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'eliminar_via_calle',
                    type: 'POST',
                    data: {id_via: id},
                    success: function (data) {
                        fn_actualizar_grilla('tabla_vias');
                        MensajeExito('Eliminar Via - Calle', id + ' - Ha sido Eliminado');
                    },
                    error: function (data) {
                        MensajeAlerta('Eliminar Via - Calle', id + ' - No se pudo Eliminar.');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Eliminar Via - Calle','Operacion Cancelada.');
            }

        }
    });
}
function limpiar_dl_tributo(tip)
{
    if(tip==1)
    {
        //$("#select_tipo_via").val(0);
        //$("#select_hab_urb").val(0);
        $('#dlg_codigo').val("");
        $('#dlg_descripcion').val("");
        $('#dlg_unidad_medida').val("");
        $('#dlg_valor').val("");

        
       
    }
}

function nueva_instalacion()
{
    $("#dlg_aniox").val($("#select_anio").val());
    limpiar_dl_tributo(1);
    $("#dlg_nueva_instalacion").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVA INSTALACION :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {

                guardar_editar_instalacion(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nueva_instalacion").dialog('open');
    
}

function modificar_instalacion()
{
    $("#dlg_aniox").val($("#select_anio").val());
    limpiar_dl_tributo(1);
    $("#dlg_nueva_instalacion").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  EDITAR INSTALACION  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                guardar_editar_instalacion(2);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nueva_instalacion").dialog('open');
    


    MensajeDialogLoadAjax('dlg_nuevo_tributo', '.:: Cargando ...');

    id = $("#current_id").val();
    $.ajax({url: 'obras_complementarias/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#dlg_instalacion_id").val(r[0].id_instal);
            $("#dlg_codigo").val(r[0].cod_instal);
            $("#dlg_descripcion").val(r[0].descrip_instal);
            $("#dlg_unidad_medida").val(r[0].unid_medida);
            $("#dlg_valor").val(r[0].precio);
            MensajeDialogLoadAjaxFinish('dlg_nueva_instalacion');

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nueva_instalacion');
        }
    });
}

function guardar_editar_instalacion(tipo) {

    id_instal = $("#dlg_instalacion_id").val();
    codigo = $("#dlg_codigo").val();
    decripcion_instal = $("#dlg_descripcion").val();
    unidad_medida = $("#dlg_unidad_medida").val();
    valor = $("#dlg_valor").val();
    aniox=$("#dlg_aniox").val();


   // alert(id_sect);
   if (codigo == '') {
        mostraralertasconfoco('* El campo Código es obligatorio...', 'codigo');
        return false;
    }
    if (decripcion_instal == '') {
        mostraralertasconfoco('* El campo Descripcion es obligatorio...', 'decripcion_instal');
        return false;
    }
    if (unidad_medida == '') {
        mostraralertasconfoco('* El campo Unidad de Medida es obligatorio...', 'unidad_medida');
        return false;
    }
    if (valor == '') {
        mostraralertasconfoco('* El campo Valor es obligatorio...', 'valor');
        return false;
    }
    

    if (tipo == 1) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'obras_complementarias/create',
            type: 'GET',
            data: {
                cod_instal: codigo,
                descrip_instal: decripcion_instal,
                unid_medida: unidad_medida,
                precio: valor,
                aniox : aniox
           
            },
            success: function (data) {
                dialog_close('dlg_nueva_instalacion');
                fn_actualizar_grilla('table_Instalaciones');
                MensajeExito('Nueva instalacion', 'El Item se a Creado Correctamente.');
            },
            error: function (data) {
                mostraralertas('* Contactese con el Administrador...');
            }
        });
    }
    else if (tipo == 2) {
        id = $("#current_id").val();
        MensajeDialogLoadAjax('dlg_nueva_instalacion', '.:: CARGANDO ...');
        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'obras_complementarias/'+id+'/edit',
                        type: 'GET',
                        data: {
                            id_instal: id,
                            cod_instal: codigo,
                            descrip_instal: decripcion_instal,
                            unid_medida: unidad_medida,
                            precio: valor                            
                        },
                        success: function (data) {
                            MensajeExito('Editar ', 'Instalación : '+ id + '  -  Ha sido Modificado.');
                            fn_actualizar_grilla('table_Instalaciones');
                            dialog_close('dlg_nueva_instalacion');
                            MensajeDialogLoadAjaxFinish('dlg_nueva_instalacion', '.:: CARGANDO ...');
                        },
                        error: function (data) {
                            mostraralertas('* Contactese con el Administrador...');
                            MensajeAlerta('Editar Instalación','Ocurrio un Error en la Operacion.');
                            dialog_close('dlg_nueva_instalacion');
                            MensajeDialogLoadAjaxFinish('dlg_nueva_instalacion', '.:: CARGANDO ...');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Editar Instalación','Operacion Cancelada.');
                    MensajeDialogLoadAjaxFinish('dlg_nueva_instalacion', '.:: CARGANDO ...');
                    
                }
            }
        });

    }
}

function eliminar_instalacion() {
    id = $("#current_id").val();

    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'obras_complementarias/destroy',
                    type: 'POST',
                    data: {_method: 'delete', id_instal: id},
                    success: function (data) {
                        fn_actualizar_grilla('table_Instalaciones');
                        MensajeExito('Eliminar Instalación', id + ' - Ha sido Eliminado');
                    },
                    error: function (data) {
                        MensajeAlerta('Eliminar Instalación', id + ' - No se pudo Eliminar.');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Eliminar Instalación','Operacion Cancelada.');
            }

        }
    });
}

     
function selecciona_anio_oficina(){
    
    aniox = $("#select_anio").val();
 

    jQuery("#table_Instalaciones").jqGrid('setGridParam', {
         url: 'get_instalaciones?anio=' + aniox 
    }).trigger('reloadGrid');

}

function autocompletar_procedimientos(textbox){
    
    $.ajax({
        type: 'GET',
        url: 'autocomplete_procedimientos?ofi=' + $("#hiddenproced_ofi").val(),
        success: function (data) {
            var $datos = data;
            $("#nombre_procedimiento").autocomplete({
                source: $datos,
                focus: function (event, ui) {
                    $("#" + textbox).val(ui.item.label);
                    $("#hidden" + textbox).val(ui.item.value);
                    $("#" + textbox).attr('maxlength', ui.item.label.length);
                    return false;
                },
                select: function (event, ui) {
                    $("#" + textbox).val(ui.item.label);
                    $("#hidden_" + textbox).val(ui.item.value);
                    return false;
                }
            });
        }
    });
}



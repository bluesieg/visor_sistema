 function limpiar_datos_asignacion(){
    $('#dlg_asignacion').val("");
    $('#id_asignacion').val("");
    $('#dlg_codigo_interno').val("");
}

function crear_nueva_asignacion()
{
    limpiar_datos_asignacion();
    $('#dlg_modalidad').attr("disabled",true); 
    $('#dlg_codigo_interno').attr("disabled",true);
    $("#dlg_nueva_asignacion").dialog({
        autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVA ASIGNACION :.</h4></div>",
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
    $("#dlg_nueva_asignacion").dialog('open');
}

function fn_obtener_exp()
{
    codigo_exp = $("#dlg_asignacion").val();

    if (codigo_exp == '') {
        mostraralertasconfoco('* El campo Codigo de Expediente es obligatorio...', '#dlg_asignacion');
        return false;
    }
    
    MensajeDialogLoadAjax('dlg_nueva_asignacion', '.:: Cargando ...');
        $.ajax({url: 'buscar_expdiente_asignacion',
        type: 'GET',
        data:{codigo:codigo_exp},
        success: function(data) 
        {
            if (data.msg === 'si'){
                MensajeDialogLoadAjaxFinish('dlg_nueva_asignacion');
                MensajeExito('Numero de Expediente Encontrado', 'El Expediente ejecuto la operacion correctamente.');
                $('#id_asignacion').val(data.id_reg_exp);
                $('#dlg_modalidad').removeAttr("disabled"); 
                $('#dlg_codigo_interno').removeAttr("disabled");
            }else if(data.msg === 'existe'){
                MensajeDialogLoadAjaxFinish('dlg_nueva_asignacion');
                mostraralertasconfoco("El Numero de Expediente ya tiene un Codigo Interno");
            }else{
                mostraralertasconfoco("Mensaje del Sistema, NO EXISTE EL NUMERO DE EXPEDIENTE");
                limpiar_datos_asignacion();
                MensajeDialogLoadAjaxFinish('dlg_nueva_asignacion');
            }
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nueva_asignacion');
        }
        }); 
}

function modificar_documento()
{
    //limpiar_dl_ipm(1);
    id=$('#table_recdocumentos').jqGrid ('getGridParam', 'selrow');
    if (id) {
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

        id = $('#table_recdocumentos').jqGrid ('getGridParam', 'selrow');
        $.ajax({url: 'recepcion_documentos/'+id,
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
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_recdocumentos");
    }
}

function modificar_exp(){
    
    id_reg_exp = $("#id_asignacion").val();
    modalidad = $("#dlg_modalidad").val();
    codigo_interno = $("#dlg_codigo_interno").val();

    if (id_reg_exp == '') {
        mostraralertasconfoco('* El campo Numero de Expediente es obligatorio...', '#dlg_asignacion');
        return false;
    }

    if (codigo_interno == '') {
        mostraralertasconfoco('* El campo Codigo Interno es obligatorio...', '#dlg_codigo_interno');
        return false;
    }
  
    MensajeDialogLoadAjax('dlg_nueva_asignacion', '.:: CARGANDO ...');
    
    $.ajax({url: 'asignacion/'+id_reg_exp+'/edit',
            type: 'GET',
            data:{id_reg_exp:id_reg_exp,modalidad:modalidad,codigo_interno:codigo_interno},
            success: function (data) {
                if (data.msg === 'repetido'){
                    mostraralertasconfoco("Mensaje del Sistema, EL CODIGO INTERNO YA FUE REGISTRADO");
                    MensajeDialogLoadAjaxFinish('dlg_nueva_asignacion');
                }else{
                    MensajeExito('El Expediente ha sido registrado');
                    dialog_close('dlg_nueva_asignacion');
                    MensajeDialogLoadAjaxFinish('dlg_nueva_asignacion', '.:: CARGANDO ...');
                    fn_actualizar_grilla('table_asignacion');
                }
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                dialog_close('dlg_nueva_asignacion');
            }
        });         
}

function eliminar_exp(){
    id = $('#table_recdocumentos').jqGrid ('getGridParam', 'selrow');
    if (id) {
       
        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'recepcion_documentos/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_reg_exp: id},
                        success: function (data) {
                            fn_actualizar_grilla('table_recdocumentos');
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
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_recdocumentos");
    }
    
}

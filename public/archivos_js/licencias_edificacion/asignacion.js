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
                    actualizar_exp_asignacion();
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

function actualizar_asignacion()
{
    id=$('#table_asignacion').jqGrid ('getGridParam', 'selrow');
    if (id) {
        $('#dlg_modalidad').attr("disabled",false); 
        $('#dlg_codigo_interno').attr("disabled",false);
        $("#dlg_nueva_asignacion").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR EXPEDIENTE :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    actualizar_asignacion_expediente();
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


        MensajeDialogLoadAjax('dlg_nueva_asignacion', '.:: Cargando ...');

        id = $('#table_asignacion').jqGrid ('getGridParam', 'selrow');
        $.ajax({url: 'asignacion/'+id,
            type: 'GET',
            success: function(r)
            {
                $("#id_asignacion").val(r[0].id_reg_exp);
                $("#dlg_asignacion").val(r[0].nro_exp);
                $("#dlg_modalidad").val(r[0].id_procedimiento);
                $("#dlg_codigo_interno").val(r[0].cod_interno);
                MensajeDialogLoadAjaxFinish('dlg_nueva_asignacion');

            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_asignacion');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_asignacion");
    }
}

function actualizar_exp_asignacion(){
    
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


function actualizar_asignacion_expediente(){
    
    id_reg_exp = $("#id_asignacion").val();
    modalidad = $("#dlg_modalidad").val();
    codigo_interno = $("#dlg_codigo_interno").val();
    asignacion = $("#dlg_asignacion").val();

    if (id_reg_exp == '') {
        mostraralertasconfoco('* El campo Numero de Expediente es obligatorio...', '#dlg_asignacion');
        return false;
    }

    if (codigo_interno == '') {
        mostraralertasconfoco('* El campo Codigo Interno es obligatorio...', '#dlg_codigo_interno');
        return false;
    }
    
    if (asignacion == '') {
        mostraralertasconfoco('* El campo Codigo Codigo Expediente es obligatorio...', '#dlg_asignacion');
        return false;
    }
  
    MensajeDialogLoadAjax('dlg_nueva_asignacion', '.:: CARGANDO ...');
    
    $.ajax({url: 'modificar_asignacion',
            type: 'GET',
            data:{id_reg_exp:id_reg_exp,modalidad:modalidad,codigo_interno:codigo_interno,asignacion:asignacion},
            success: function (data) {
                if (data.msg === 'repetido'){
                    mostraralertasconfoco("Mensaje del Sistema, EL CODIGO INTERNO YA FUE REGISTRADO");
                    MensajeDialogLoadAjaxFinish('dlg_nueva_asignacion');
                }else{
                    MensajeExito('El Expediente ha sido registrado');
                    dialog_close('dlg_nueva_asignacion');
                    MensajeDialogLoadAjaxFinish('dlg_nueva_asignacion');
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

function eliminar_exp_asignacion(){
    id = $('#table_asignacion').jqGrid ('getGridParam', 'selrow');
    if (id) {
       
        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'asignacion/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_reg_exp: id},
                        success: function (data) {
                            fn_actualizar_grilla('table_asignacion');
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
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_asignacion");
    }
    
}

function seleccionafecha_asignacion(){

    fecha_inicio_asignacion = $('#fec_ini_asignacion').val();
    fecha_fin_asignacion = $('#fec_fin_asignacion').val(); 

    jQuery("#table_asignacion").jqGrid('setGridParam', {
         url: 'get_asignacion?fecha_inicio='+fecha_inicio_asignacion+'&fecha_fin='+fecha_fin_asignacion
    }).trigger('reloadGrid');

}

function actualizar_grilla(){
    jQuery("#table_recdocumentos").jqGrid('setGridParam', {
         url: 'get_documentos'
    }).trigger('reloadGrid');
}
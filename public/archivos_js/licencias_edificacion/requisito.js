 function limpiar_datos(){
    $("#inp_descripcion_requisito").val("");
    $("#inp_estado").prop('checked', false);
}

 
function crear_nuevo_requisito()
{
    Id=$('#table_procedimientos').jqGrid ('getGridParam', 'selrow');
    if(Id)
    {
        limpiar_datos();
        id_procedimiento = $('#table_procedimientos').jqGrid ('getGridParam', 'selrow');
        $('#inp_procedimiento').val($('#table_procedimientos').jqGrid ('getCell', id_procedimiento, 'descr_procedimiento'));
        $("#inp_anio_requisito").val($("#select_anio_requisito").val());

        $("#dlg_nuevo_requisito").dialog({
            autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVO REQUISITO :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        guardar_requisito();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_requisito").dialog('open');
    }else{
        mostraralertasconfoco("No Hay Procedimientos Seleccionados","#table_requisitos");
    }
}

function guardar_requisito(){
    
    anio = $('#inp_anio_requisito').val();
    descrip_requisito = $('#inp_descripcion_requisito').val();
    id_procedimiento = $('#table_procedimientos').jqGrid ('getGridParam', 'selrow');
    procedimiento = $('#inp_procedimiento').val();
    
    if($("#inp_estado").is(':checked')){
       var estado = 1;
    }else{
        estado = 0;
    }
    
    if (anio == '') {
        mostraralertasconfoco('* El campo Año es obligatorio...', '#inp_anio_requisito');
        return false;
    }
    if (descrip_requisito == '') {
        mostraralertasconfoco('* El campo Descripcion es obligatorio...', '#inp_descripcion_requisito');
        return false;
    }
    if (procedimiento == '') {
        mostraralertasconfoco('* El campo Año es obligatorio...', '#inp_procedimiento');
        return false;
    }
    
    MensajeDialogLoadAjax('dlg_nuevo_requisito', '.:: Cargando ...');
    
    $.ajax({url: 'requisitos/create',
            type: 'GET',
            data:{
                descrip_requisito:descrip_requisito,
                anio:anio,
                estado:estado,
                id_procedimiento:id_procedimiento
            },
            success: function(data) 
            {
                fn_actualizar_grilla('table_requisitos');
                MensajeExito('Requisito', 'Se Registraron los datos.');
                dialog_close('dlg_nuevo_requisito');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_requisito');
                
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
        });
        
}

function modificar_requisito()
{
    id = $('#table_requisitos').jqGrid ('getGridParam', 'selrow');
    if(id){
        $("#dlg_nuevo_requisito").dialog({
            autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR REQUISITO :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    actualizar_requisito();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_requisito").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_requisito', '.:: Cargando ...');

        $.ajax({url: 'requisitos/'+id,
            type: 'GET',
            success: function(r)
            {
                $("#inp_anio_requisito").val(r[0].anio);
                $("#inp_descripcion_requisito").val(r[0].desc_requisito);
                if (r[0].estado == 1) {
                    $("#inp_estado").prop('checked', true);
                }else{
                    $("#inp_estado").prop('checked', false);
                }
                $("#inp_procedimiento").val(r[0].descr_procedimiento);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_requisito');

            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_requisito');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Procedimientos Seleccionados","#table_requisitos");
    }
    
}

function actualizar_requisito(){
    
    anio = $('#inp_anio_requisito').val();
    descrip_requisito = $('#inp_descripcion_requisito').val();
    procedimiento = $('#inp_procedimiento').val();
    
    if($("#inp_estado").is(':checked')){
       var estado = 1;
    }else{
        estado = 0;
    }
    
    if (anio == '') {
        mostraralertasconfoco('* El campo Año es obligatorio...', '#inp_anio_requisito');
        return false;
    }
    if (descrip_requisito == '') {
        mostraralertasconfoco('* El campo Descripcion es obligatorio...', '#inp_descripcion_requisito');
        return false;
    }
    if (procedimiento == '') {
        mostraralertasconfoco('* El campo Año es obligatorio...', '#inp_procedimiento');
        return false;
    }
    
    id = $('#table_requisitos').jqGrid ('getGridParam', 'selrow');
    MensajeDialogLoadAjax('dlg_nuevo_requisito', '.:: CARGANDO ...');
    
    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'requisitos/'+id+'/edit',
                    type: 'GET',
                    data: {
                        id_requisito:id,
                        descrip_requisito: descrip_requisito,
                        anio: anio,
                        estado:estado
                    },
                    success: function (data) {
                     
                        MensajeExito('Editar Registro Requisito', 'REQUISITO: '+ id + '  -  Ha sido Modificado.');
                        fn_actualizar_grilla('table_requisitos');
                        dialog_close('dlg_nuevo_requisito');
                        MensajeDialogLoadAjaxFinish('dlg_nuevo_requisito', '.:: CARGANDO ...');
                       
                    },
                    error: function (data) {
                        mostraralertas('* Contactese con el Administrador...');
                        MensajeAlerta('Editar Registro Requisito','Ocurrio un Error en la Operacion.');
                        dialog_close('dlg_nuevo_requisito');
                        MensajeDialogLoadAjaxFinish('dlg_nuevo_requisito', '.:: CARGANDO ...');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Editar Requisito','Operacion Cancelada.');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_requisito', '.:: CARGANDO ...');

            }
        }
    });
}

function eliminar_requisito(){
    id = $('#table_requisitos').jqGrid ('getGridParam', 'selrow');
    
    if(id)
    {
        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'requisitos/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_requisito: id},
                        success: function (data) {
                            fn_actualizar_grilla('table_requisitos');
                            MensajeExito('Eliminar Requisito', id + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Requisito', id + ' - No se pudo Eliminar.');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Eliminar Requisito','Operacion Cancelada.');
                }

            }
        });
    }else{
        mostraralertasconfoco("No Hay Procedimientos Seleccionados","#table_requisitos");
    }
    
}
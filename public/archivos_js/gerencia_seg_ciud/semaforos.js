function fn_buscar_ubicacion(){
    ubicacion = $("#dlg_buscar_ubicacion").val();
    fn_actualizar_grilla('table_semaforos','sub_geren_transito_seg_vial/0?grid=semaforos&ubicacion='+ubicacion);
}

function guardar_editar_datos(tipo) {
    observaciones = $("#dlg_observacion").val();
    id_semaforo = $("#dlg_id_semaforo").val();

    if(observaciones == "")
    {
        mostraralertasconfoco("* El Campo OBSERVACION es Obligatorio","#dlg_observacion");
        return false;
    }
    
    if (tipo == 1) {

        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_transito_seg_vial/create',
            type: 'GET',
            data: {
                observaciones:observaciones,
                id_semaforo:id_semaforo,
                tipo:1            
            },
            success: function(data) 
            {
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion');
                fn_actualizar_grilla('table_observaciones');
                $("#dlg_nueva_observacion").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_observaciones = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_transito_seg_vial/'+id_observaciones+'/edit',
            type: 'GET',
            data: {
        	observaciones:observaciones,
                tipo:1
            },
            success: function(data) 
            {
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion');
                fn_actualizar_grilla('table_observaciones');
                $("#dlg_nueva_observacion").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_observaciones');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function modificar_semaforos()
{
    id_semaforo = $('#table_semaforos').jqGrid ('getGridParam', 'selrow');
    
    if (id_semaforo) {
        
        $("#dlg_nuevo_semaforo").dialog({
            autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: INFORMACION DE SEMAFOROS :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    editar_semaforos();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_semaforo").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_semaforo', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_transito_seg_vial/'+id_semaforo+'?show=semaforos',
            type: 'GET',
            success: function(data)
            {
                $("#dlg_ubicacion").val(data[0].ubicacion);
                $("#dlg_codigo").val(data[0].cod_semaforo);
                $("#sel_tipo").val(data[0].id_tipo_semaforo);
                if (data[0].peatonal == 1) {
                    $("#chkbox_peatonal").prop('checked', true);
                }else{
                    $("#chkbox_peatonal").prop('checked', false);
                }
                $("#sel_controlador").val(data[0].id_controlador);
                $("#sel_estado").val(data[0].id_estado);
                $("#dlg_id_semaforo").val(data[0].id_semaforo);
                jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'sub_geren_transito_seg_vial/0?grid=observaciones&indice='+$("#dlg_id_semaforo").val() }).trigger('reloadGrid');

                MensajeDialogLoadAjaxFinish('dlg_nuevo_semaforo');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_semaforo');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_semaforos");
    }
}

function limpiar_observaciones()
{
    $("#dlg_observacion").val('');
}

function nueva_observacion()
{
    limpiar_observaciones();
    $("#dlg_nueva_observacion").dialog({
        autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE OBSERVACION  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_editar_datos(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nueva_observacion").dialog('open');
}

function modificar_observacion()
{
    id_observ_sem = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_observ_sem) {
        
        $("#dlg_nueva_observacion").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION OBSERVACION :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    guardar_editar_datos(2);
                }
            },{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_observacion").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_transito_seg_vial/'+id_observ_sem+'?show=observaciones',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_observacion").val(data[0].observaciones);
                
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_observacion');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones");
    }
}

function eliminar_observacion()
{
    id_observ_sem = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_observ_sem) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'sub_geren_transito_seg_vial/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_observ_sem: id_observ_sem, tipo: 1},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones');
                            MensajeExito('Eliminar Observacion', id_observ_sem + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Observacion', id_observ_sem + ' - No se pudo Eliminar.');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Eliminar Observacion','Operacion Cancelada.');
                }

            }
        });
        
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_observaciones");
    }   
}

function editar_semaforos()
{
    id_semaforo = $("#dlg_id_semaforo").val();
    ubicacion = $("#dlg_ubicacion").val();
    codigo = $("#dlg_codigo").val();
    id_tipo_semaforo = $("#sel_tipo").val();
    id_controlador = $("#sel_controlador").val();
    id_estado = $("#sel_estado").val();
    
    if(ubicacion == "")
    {
        mostraralertasconfoco("* El Campo Ubicacion es Obligatorio","#dlg_ubicacion");
        return false;
    }

    if($("#chkbox_peatonal").is(':checked')){
       var peatonal = 1;
    }else{
        peatonal = 0;
    }
    
    if(id_tipo_semaforo == '0')
    {
        mostraralertasconfoco("* Debes Seleccionar un Tipo de Semaforo","#sel_tipo");
        return false;
    }
    
    if(id_controlador == '0')
    {
        mostraralertasconfoco("* Debes Seleccionar un Tipo de Controlador","#sel_controlador");
        return false;
    }
    
    if(id_estado == '0')
    {
        mostraralertasconfoco("* Debes Seleccionar un Tipo de Estado","#sel_estado");
        return false;
    }

    MensajeDialogLoadAjax('dlg_nuevo_semaforo', '.:: Cargando ...');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'sub_geren_transito_seg_vial/'+id_semaforo+'/edit',
        type: 'GET',
        data: {
            ubicacion:ubicacion,
            codigo:codigo,
            id_tipo_semaforo:id_tipo_semaforo,
            peatonal:peatonal,
            id_controlador:id_controlador,
            id_estado:id_estado,
            tipo:2
        },
        success: function(data) 
        {
            MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
            MensajeDialogLoadAjaxFinish('dlg_nuevo_semaforo');
            fn_actualizar_grilla('table_semaforos');
            $("#dlg_nuevo_semaforo").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('table_semaforos');
            console.log('error');
            console.log(data);
        }
    });
}

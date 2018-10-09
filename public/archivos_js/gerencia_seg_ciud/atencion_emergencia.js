function fn_buscar_ubicacion(){
    ubicacion = $("#dlg_buscar_ubicacion").val();
    fn_actualizar_grilla('table_atencion_emergencia','sub_geren_riesgos_desastres/0?grid=atencion_emergencia&ubicacion='+ubicacion);
}

function guardar_editar_datos(tipo) {
    observaciones = $("#dlg_observacion").val();
    id_atencion_riesgo = $("#id_atencion_emergencia").val();
    
    if(observaciones == "")
    {
        mostraralertasconfoco("* El Campo OBSERVACION es Obligatorio","#dlg_observacion");
        return false;
    }
    
    if (tipo == 1) {

        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_riesgos_desastres/create',
            type: 'GET',
            data: {
                observaciones:observaciones,
                id_atencion_riesgo:id_atencion_riesgo,
                tipo:2            
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

        id_observ_emer = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_riesgos_desastres/'+id_observ_emer+'/edit',
            type: 'GET',
            data: {
        	observaciones:observaciones,
                tipo:3
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

function modificar_atencion_emergencia()
{
    id_observ_emer = $('#table_atencion_emergencia').jqGrid ('getGridParam', 'selrow');
    
    if (id_observ_emer) {
        
        $("#dlg_nueva_atencion_emergencia").dialog({
            autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: INFORMACION DE ZONAS DE ATENCION DE EMERGENCIA :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    editar_zona_atencion_emergencia();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_atencion_emergencia").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_atencion_emergencia', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_riesgos_desastres/'+id_observ_emer+'?show=atencion_emergencia',
            type: 'GET',
            success: function(data)
            {
                $("#hidden_dlg_persona").val(data[0].id_pers);
                $("#dlg_dni_persona").val(data[0].nro_doc_persona);
                $("#dlg_persona").val(data[0].persona);
                $("#dlg_ubicacion").val(data[0].ubicacion);
                $("#sel_tipo_desastre").val(data[0].id_tipo_desastre);
                $("#dlg_nro_fallecidos").val(data[0].nro_fallecidos);
                $("#dlg_nro_accidentados").val(data[0].nro_accidentados);
                id_atencion_emergencia = $("#id_atencion_emergencia").val(data[0].id_atencion_emer);
                if (id_atencion_emergencia == null) {
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'sub_geren_riesgos_desastres/0?grid=observaciones_aemergencia&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'sub_geren_riesgos_desastres/0?grid=observaciones_aemergencia&indice='+$("#id_atencion_emergencia").val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_nueva_atencion_emergencia');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_atencion_emergencia');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_atencion_emergencia");
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
    id_observ_emer = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_observ_emer) {
        
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

        $.ajax({url: 'sub_geren_riesgos_desastres/'+id_observ_emer+'?show=observaciones_aemer',
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
    id_observ_emer = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_observ_emer) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'sub_geren_riesgos_desastres/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_observ_emer: id_observ_emer, tipo: 2},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones');
                            MensajeExito('Eliminar Observacion', id_observ_emer + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Observacion', id_observ_emer + ' - No se pudo Eliminar.');
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

function editar_zona_atencion_emergencia()
{
    id_atencion_emergencia = $("#id_atencion_emergencia").val();
    id_pers = $("#hidden_dlg_persona").val();
    ubicacion = $("#dlg_ubicacion").val();
    nro_fallecidos = $("#dlg_nro_fallecidos").val();
    nro_accidentados = $("#dlg_nro_accidentados").val();
    tipo_desastre = $("#sel_tipo_desastre").val();

    if(id_atencion_emergencia == "")
    {
        mostraralertasconfoco("* El Campo Persona es Obligatorio","#dlg_dni_persona");
        return false;
    }
    if(ubicacion == "")
    {
        mostraralertasconfoco("* El Campo UBICACION es Obligatorio","#dlg_ubicacion");
        return false;
    }
    if(nro_fallecidos == "")
    {
        mostraralertasconfoco("* El Campo Nro Fallecidos es Obligatorio","#dlg_nro_fallecidos");
        return false;
    }
    if(nro_accidentados == "")
    {
        mostraralertasconfoco("* El Campo Nro Accidentados es Obligatorio","#dlg_nro_accidentados");
        return false;
    }
    
    if(tipo_desastre == '0')
    {
        mostraralertasconfoco("* Debes Seleccionar un Tipo Desastre","#sel_tipo_desastre");
        return false;
    }

    MensajeDialogLoadAjax('dlg_nueva_zona_riesgo', '.:: Cargando ...');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'sub_geren_riesgos_desastres/'+id_atencion_emergencia+'/edit',
        type: 'GET',
        data: {
            ubicacion:ubicacion,
            id_pers:id_pers,
            nro_fallecidos:nro_fallecidos,
            nro_accidentados:nro_accidentados,
            tipo_desastre:tipo_desastre,
            tipo:4
        },
        success: function(data) 
        {
            MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
            MensajeDialogLoadAjaxFinish('dlg_nueva_atencion_emergencia');
            fn_actualizar_grilla('table_atencion_emergencia');
            $("#dlg_nueva_atencion_emergencia").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('table_zona_riesgo');
            console.log('error');
            console.log(data);
        }
    });
}

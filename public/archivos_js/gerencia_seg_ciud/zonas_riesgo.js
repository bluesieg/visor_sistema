function fn_buscar_ubicacion(){
    ubicacion = $("#dlg_buscar_ubicacion").val();
    fn_actualizar_grilla('table_zona_riesgo','sub_geren_riesgos_desastres/0?grid=zona_riesgo&ubicacion='+ubicacion);
}

function guardar_editar_datos(tipo) {
    plan_contingencia = $("#dlg_plan_contingencia").val();
    observaciones = $("#dlg_observacion").val();
    id_zona_riesgo = $("#id_zona_riesgo").val();

    if(plan_contingencia == "")
    {
        mostraralertasconfoco("* El Campo PLAN CONTINGENCIA es Obligatorio","#dlg_plan_contingencia");
        return false;
    }
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
        	plan_contingencia:plan_contingencia,
                observaciones:observaciones,
                id_zona_riesgo:id_zona_riesgo,
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

        id_plan = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_riesgos_desastres/'+id_plan+'/edit',
            type: 'GET',
            data: {
        	observaciones:observaciones,
                plan_contingencia:plan_contingencia,
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

function modificar_zona_riesgo()
{
    id_zona_riesgo = $('#table_zona_riesgo').jqGrid ('getGridParam', 'selrow');
    
    if (id_zona_riesgo) {
        
        $("#dlg_nueva_zona_riesgo").dialog({
            autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: INFORMACION DE ZONAS DE RIESGO :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    editar_zona_riesgo();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_zona_riesgo").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_zona_riesgo', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_riesgos_desastres/'+id_zona_riesgo+'?show=mapa_delito',
            type: 'GET',
            success: function(data)
            {
                $("#hidden_dlg_propietario").val(data[0].id_pers);
                $("#dlg_dni_propietario").val(data[0].nro_doc_propietario);
                $("#dlg_propietario").val(data[0].propietario);
                $("#dlg_ubicacion").val(data[0].ubicacion);
                $("#sel_tipo_riesgo").val(data[0].id_tipo_riesgo);
                id_zona_riesgo = $("#id_zona_riesgo").val(data[0].id_zona_riesgo);
                if (id_zona_riesgo == null) {
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'sub_geren_riesgos_desastres/0?grid=observaciones&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'sub_geren_riesgos_desastres/0?grid=observaciones&indice='+$("#id_zona_riesgo").val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_nueva_zona_riesgo');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_zona_riesgo');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_zona_riesgo");
    }
}

function limpiar_observaciones()
{
    $("#dlg_plan_contingencia").val('');
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
    id_plan = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_plan) {
        
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

        $.ajax({url: 'sub_geren_riesgos_desastres/'+id_plan+'?show=observaciones',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_plan_contingencia").val(data[0].plan_contin);
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
    id_plan = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_plan) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'sub_geren_riesgos_desastres/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_plan: id_plan, tipo: 1},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones');
                            MensajeExito('Eliminar Observacion', id_plan + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Observacion', id_plan + ' - No se pudo Eliminar.');
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

function editar_zona_riesgo()
{
    id_zona_riesgo = $("#id_zona_riesgo").val();
    id_pers_responsable = $("#hidden_dlg_propietario").val();
    ubicacion = $("#dlg_ubicacion").val();
    tipo_riesgo = $("#sel_tipo_riesgo").val();

    if(id_zona_riesgo == "")
    {
        mostraralertasconfoco("* El Campo Propietario es Obligatorio","#dlg_dni_propietario");
        return false;
    }
    if(ubicacion == "")
    {
        mostraralertasconfoco("* El Campo UBICACION es Obligatorio","#dlg_ubicacion");
        return false;
    }
    
    if(tipo_riesgo == '0')
    {
        mostraralertasconfoco("* Debes Seleccionar un Tipo Riesgo","#sel_tipo_riesgo");
        return false;
    }

    MensajeDialogLoadAjax('dlg_nueva_zona_riesgo', '.:: Cargando ...');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'sub_geren_riesgos_desastres/'+id_zona_riesgo+'/edit',
        type: 'GET',
        data: {
            id_pers_responsable:id_pers_responsable,
            ubicacion:ubicacion,
            tipo_riesgo:tipo_riesgo,
            tipo:2
        },
        success: function(data) 
        {
            MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
            MensajeDialogLoadAjaxFinish('dlg_nueva_zona_riesgo');
            fn_actualizar_grilla('table_zona_riesgo');
            $("#dlg_nueva_zona_riesgo").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('table_zona_riesgo');
            console.log('error');
            console.log(data);
        }
    });
}

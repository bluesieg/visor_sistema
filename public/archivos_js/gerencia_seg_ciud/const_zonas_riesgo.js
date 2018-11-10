function fn_buscar_ubicacion(){
    ubicacion = $("#dlg_buscar_ubicacion").val();
    fn_actualizar_grilla('table_ctr_zona_riesgo','sub_geren_riesgos_desastres/0?grid=ctr_zona_riesgo&ubicacion='+ubicacion);
}

function guardar_editar_datos(tipo) {
    observaciones = $("#dlg_observacion").val();
    id_const_zona_riesgo = $("#id_const_zona_riesgo").val();

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
                id_const_zona_riesgo:id_const_zona_riesgo,
                tipo:3            
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

        id_observ_ctr_zon_rg = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_riesgos_desastres/'+id_observ_ctr_zon_rg+'/edit',
            type: 'GET',
            data: {
        	observaciones:observaciones, 
                tipo:5
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

function modificar_const_zona_riesgo()
{
    id_const_zona_riesgo = $('#table_ctr_zona_riesgo').jqGrid ('getGridParam', 'selrow');
    
    if (id_const_zona_riesgo) {
        
        $("#dlg_nueva_const_zona_riesgo").dialog({
            autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: INFORMACION DE CONSTRUCCIONES EN ZONAS DE RIESGO :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    guardar_informacion();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_const_zona_riesgo").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_const_zona_riesgo', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_riesgos_desastres/'+id_const_zona_riesgo+'?show=traer_datos_const_zona_riesgo',
            type: 'GET',
            success: function(data)
            {
                $("#hidden_dlg_propietario").val(data[0].id_pers);
                $("#dlg_dni_propietario").val(data[0].nro_doc_propietario);
                $("#dlg_propietario").val(data[0].propietario);
                $("#dlg_ubicacion").val(data[0].ubicacion);
                $("#sel_tipo_riesgo").val(data[0].id_ctr_tip_riesgo);
                $("#dlg_notificacion").val(data[0].notificacion);
                id_const_zona_riesgo = $("#id_const_zona_riesgo").val(data[0].id_ctr_zon_rg);
                if (id_const_zona_riesgo == null) {
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'sub_geren_riesgos_desastres/0?grid=observaciones_ctr_zona_riesgo&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'sub_geren_riesgos_desastres/0?grid=observaciones_ctr_zona_riesgo&indice='+$("#id_const_zona_riesgo").val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_nueva_const_zona_riesgo');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_const_zona_riesgo');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_ctr_zona_riesgo");
    }
}

function guardar_informacion()
{
    id_propietario = $("#hidden_dlg_propietario").val();
    ubicacion = $("#dlg_ubicacion").val();
    sel_tipo_riesgo = $("#sel_tipo_riesgo").val();
    notificacion = $("#dlg_notificacion").val();
    id_ctr_zona_riesgo = $('#id_const_zona_riesgo').val();
    
    if(id_propietario == "")
    {
        mostraralertasconfoco("* El Campo DNI es Obligatorio","#dlg_dni_propietario");
        return false;
    }
    if(ubicacion == "")
    {
        mostraralertasconfoco("* El Campo UBICACION es Obligatorio","#dlg_ubicacion");
        return false;
    }
    if(sel_tipo_riesgo == "0")
    {
        mostraralertasconfoco("* SELECCIONE UNA OPCION","#sel_tipo_riesgo");
        return false;
    }
    if(notificacion == "")
    {
        mostraralertasconfoco("* El Campo NOTIFICACION es Obligatorio","#dlg_notificacion");
        return false;
    }
    
    MensajeDialogLoadAjax('dlg_nueva_const_zona_riesgo', '.:: Cargando ...');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'sub_geren_riesgos_desastres/'+id_ctr_zona_riesgo+'/edit',
        type: 'GET',
        data: {
            id_propietario:id_propietario,
            ubicacion:ubicacion,
            sel_tipo_riesgo:sel_tipo_riesgo,
            notificacion:notificacion,
            tipo:6
        },
        success: function(data) 
        {
            MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
            MensajeDialogLoadAjaxFinish('dlg_nueva_const_zona_riesgo');
            fn_actualizar_grilla('table_ctr_zona_riesgo');
            $("#dlg_nueva_const_zona_riesgo").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('table_ctr_zona_riesgo');
            console.log('error');
            console.log(data);
        }
    });
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
    id_observ_ctr_zon_rg = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_observ_ctr_zon_rg) {
        
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

        $.ajax({url: 'sub_geren_riesgos_desastres/'+id_observ_ctr_zon_rg+'?show=observaciones_ctr_zona_riesgo',
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
    id_observ_ctr_zon_rg = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_observ_ctr_zon_rg) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'sub_geren_riesgos_desastres/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_observ_ctr_zon_rg: id_observ_ctr_zon_rg, tipo: 3},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones');
                            MensajeExito('Eliminar Observacion', id_observ_ctr_zon_rg + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Observacion', id_observ_ctr_zon_rg + ' - No se pudo Eliminar.');
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

function fn_buscar_ruta_serenazgo(){
    ubicacion = $("#dlg_buscar_ruta").val();
    fn_actualizar_grilla('table_rutas_serenazgo','sub_geren_op_vigilancia_interna/0?grid=rutas_serenazgo&ubicacion='+ubicacion);
}

function modificar_ruta_serenazgo()
{
    id_ruta_serenazgo = $('#table_rutas_serenazgo').jqGrid ('getGridParam', 'selrow');
    
    if (id_ruta_serenazgo) {
        
        $("#dlg_nueva_ruta_serenazgo").dialog({
            autoOpen: false, modal: true, width: 950, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: INFORMACION DE RUTAS SERENAZGO :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    editar_rutas_serenazgo();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_ruta_serenazgo").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_ruta_serenazgo', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_op_vigilancia_interna/'+id_ruta_serenazgo+'?show=rutas_serenazgo',
            type: 'GET',
            success: function(data)
            {
                $("#dlg_ubicacion").val(data[0].ubicacion);
                $("#dlg_unidad").val(data[0].unidad);
                $("#sel_tipo_transporte").val(data[0].id_tipo_transporte);
                $("#dlg_placa").val(data[0].placa);
                $("#sel_tipo_personal").val(data[0].personal);
                id_ruta_serenazgo = $("#id_ruta_serenazgo").val(data[0].id_ruta_serenazgo);
                if (id_ruta_serenazgo == null) {
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=observaciones_rutas_serenazgo&indice='+0 }).trigger('reloadGrid');
                    jQuery("#table_personal").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=personal_rutas_serenazgo&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=observaciones_rutas_serenazgo&indice='+$("#id_ruta_serenazgo").val() }).trigger('reloadGrid');
                    jQuery("#table_personal").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=personal_rutas_serenazgo&indice='+$("#id_ruta_serenazgo").val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_nueva_ruta_serenazgo');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_ruta_serenazgo');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_rutas_serenazgo");
    }
}

function editar_rutas_serenazgo()
{
    id_ruta_serenazgo = $("#id_ruta_serenazgo").val();
    ubicacion = $("#dlg_ubicacion").val();
    unidad = $("#dlg_unidad").val();
    tipo_transporte = $("#sel_tipo_transporte").val();
    placa = $("#dlg_placa").val();
    tipo_personal = $("#sel_tipo_personal").val();

    if(ubicacion == "")
    {
        mostraralertasconfoco("* El Campo UBICACION es Obligatorio","#dlg_ubicacion");
        return false;
    }
    if(unidad == "")
    {
        mostraralertasconfoco("* El Campo UNIDAD es Obligatorio","#dlg_unidad");
        return false;
    }
    if(tipo_transporte == "0")
    {
        mostraralertasconfoco("* Debes Seleccionar un Tipo de Transporte","#sel_tipo_transporte");
        return false;
    }
    if(placa == "")
    {
        mostraralertasconfoco("* El Campo PLACA es Obligatorio","#dlg_placa");
        return false;
    }
    if(tipo_personal == "0")
    {
        mostraralertasconfoco("* Debes Seleccionar un Tipo de Personal","#sel_tipo_personal");
        return false;
    }

    MensajeDialogLoadAjax('dlg_nueva_ruta_serenazgo', '.:: Cargando ...');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'sub_geren_op_vigilancia_interna/'+id_ruta_serenazgo+'/edit',
        type: 'GET',
        data: {
            ubicacion:ubicacion,
            unidad:unidad,
            tipo_transporte:tipo_transporte,
            placa:placa,
            tipo_personal:tipo_personal,
            tipo:1
        },
        success: function(data) 
        {
            MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
            MensajeDialogLoadAjaxFinish('dlg_nueva_ruta_serenazgo');
            fn_actualizar_grilla('table_rutas_serenazgo');
            $("#dlg_nueva_ruta_serenazgo").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('table_rutas_serenazgo');
            console.log('error');
            console.log(data);
        }
    });
}

function guardar_editar_datos(tipo) {
    observaciones = $("#dlg_observacion").val();
    id_ruta_serenazgo = $("#id_ruta_serenazgo").val();
    
    if(observaciones == "")
    {
        mostraralertasconfoco("* El Campo OBSERVACION es Obligatorio","#dlg_observacion");
        return false;
    }
    
    if (tipo == 1) {

        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_op_vigilancia_interna/create',
            type: 'GET',
            data: {
                observaciones:observaciones,
                id_ruta_serenazgo:id_ruta_serenazgo,
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

        id_observ_ruta_srzgo = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_op_vigilancia_interna/'+id_observ_ruta_srzgo+'/edit',
            type: 'GET',
            data: {
        	observaciones:observaciones,
                tipo:2
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

function guardar_editar_datos_persona(tipo) {
    dni = $("#dlg_dni").val();
    nombres = $("#dlg_nombres").val();
    apaterno = $("#dlg_apaterno").val();
    amaterno = $("#dlg_amaterno").val();
    telefono = $("#dlg_telefono").val();
    id_ruta_serenazgo = $("#id_ruta_serenazgo").val();
    
    if(dni == "")
    {
        mostraralertasconfoco("* El Campo DNI es Obligatorio","#dlg_dni");
        return false;
    }
    if(nombres == "")
    {
        mostraralertasconfoco("* El Campo NOMBRES es Obligatorio","#dlg_nombres");
        return false;
    }
    if(apaterno == "")
    {
        mostraralertasconfoco("* El Campo APELLIDO PATERNO es Obligatorio","#dlg_apaterno");
        return false;
    }
    if(amaterno == "")
    {
        mostraralertasconfoco("* El Campo APELLIDO MATERNO es Obligatorio","#dlg_amaterno");
        return false;
    }
    if(telefono == "")
    {
        mostraralertasconfoco("* El Campo TELEFONO es Obligatorio","#dlg_telefono");
        return false;
    }
    
    if (tipo == 1) {

        MensajeDialogLoadAjax('dlg_nueva_persona', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_op_vigilancia_interna/create',
            type: 'GET',
            data: {
                dni:dni,
                nombres:nombres,
                apaterno:apaterno,
                amaterno:amaterno,
                telefono:telefono,
                id_ruta_serenazgo:id_ruta_serenazgo,
                tipo:2            
            },
            success: function(data) 
            {
                if (data > 0) 
                {
                    MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                    MensajeDialogLoadAjaxFinish('dlg_nueva_persona');
                    fn_actualizar_grilla('table_personal');
                    $("#dlg_nueva_persona").dialog("close");
                }
                else
                {
                    MensajeDialogLoadAjaxFinish('dlg_nueva_persona');
                    mostraralertasconfoco("EL NUMERO DE DNI YA FUE REGISTRADO","#dlg_dni");  
                }
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_personal');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_per_ruta_serenazgo = $('#table_personal').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nueva_persona', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_op_vigilancia_interna/'+id_per_ruta_serenazgo+'/edit',
            type: 'GET',
            data: {
                dni:dni,
                nombres:nombres,
                apaterno:apaterno,
                amaterno:amaterno,
                telefono:telefono,
                id_ruta_serenazgo:id_ruta_serenazgo,
                tipo:3
            },
            success: function(data) 
            {
                if (data > 0) 
                {
                    MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                    MensajeDialogLoadAjaxFinish('dlg_nueva_persona');
                    fn_actualizar_grilla('table_personal');
                    $("#dlg_nueva_persona").dialog("close");
                }
                else
                {
                    MensajeDialogLoadAjaxFinish('dlg_nueva_persona');
                    mostraralertasconfoco("EL NUMERO DE DNI YA FUE REGISTRADO","#dlg_dni");  
                }
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_personal');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function limpiar_persona()
{
    $("#dlg_dni").val('');
    $("#dlg_nombres").val('');
    $("#dlg_apaterno").val('');
    $("#dlg_amaterno").val('');
    $("#dlg_telefono").val('');
}

function nueva_persona()
{
    limpiar_persona();
    $("#dlg_nueva_persona").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO PERSONA  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_editar_datos_persona(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nueva_persona").dialog('open');
}

function modificar_persona()
{
    id_per_ruta_serenazgo = $('#table_personal').jqGrid ('getGridParam', 'selrow');
    
    if (id_per_ruta_serenazgo) {
        
        $("#dlg_nueva_persona").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION PERSONA :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    guardar_editar_datos_persona(2);
                }
            },{
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nueva_persona").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_persona', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_op_vigilancia_interna/'+id_per_ruta_serenazgo+'?show=personal_rutas_serenazgo',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_dni").val(data[0].dni);
                $("#dlg_nombres").val(data[0].nombres);
                $("#dlg_apaterno").val(data[0].ape_pat);
                $("#dlg_amaterno").val(data[0].ape_mat);
                $("#dlg_telefono").val(data[0].telefono);
                MensajeDialogLoadAjaxFinish('dlg_nueva_persona');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_persona');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_personal");
    }
}

function eliminar_persona()
{
    id_per_ruta_serenazgo = $('#table_personal').jqGrid ('getGridParam', 'selrow');
    
    if (id_per_ruta_serenazgo) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'sub_geren_op_vigilancia_interna/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_per_ruta_serenazgo: id_per_ruta_serenazgo, tipo: 2},
                        success: function (data) {
                            fn_actualizar_grilla('table_personal');
                            MensajeExito('Eliminar Observacion', id_per_ruta_serenazgo + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Observacion', id_per_ruta_serenazgo + ' - No se pudo Eliminar.');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Eliminar Observacion','Operacion Cancelada.');
                }

            }
        });
        
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_personal");
    }   
}

//OBSERVACIONES
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
    id_observ_ruta_srzgo = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_observ_ruta_srzgo) {
        
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

        $.ajax({url: 'sub_geren_op_vigilancia_interna/'+id_observ_ruta_srzgo+'?show=observaciones_rutas_serenazgo',
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
    id_observ_ruta_srzgo = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_observ_ruta_srzgo) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'sub_geren_op_vigilancia_interna/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_observ_ruta_srzgo: id_observ_ruta_srzgo, tipo: 1},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones');
                            MensajeExito('Eliminar Observacion', id_observ_ruta_srzgo + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Observacion', id_observ_ruta_srzgo + ' - No se pudo Eliminar.');
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
function fn_buscar_comisaria(){
    nombre = $("#dlg_buscar_comisaria").val();
    fn_actualizar_grilla('table_comisarias','sub_geren_op_vigilancia_interna/0?grid=comisarias&nombre='+nombre);
}

function modificar_comisarias()
{   
    id_comisaria = $('#table_comisarias').jqGrid ('getGridParam', 'selrow');
   
    if (id_comisaria) {
        
        $("#dlg_nuevo_comisarias").dialog({
            autoOpen: false, modal: true, width: 1150, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: INFORMACION DE COMISARIAS :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    modificar_comisaria();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_comisarias").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_comisarias', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_op_vigilancia_interna/'+id_comisaria+'?show=comisarias',
            type: 'GET',
            success: function(data)
            {   
                $("#dlg_ubicacion").val(data[0].ubicacion);
                $("#dlg_nombre_comisaria").val(data[0].nombre);
                $("#dlg_telefono_comisaria").val(data[0].telefono);
                $("#dlg_nro_efectivos").val(data[0].nro_efectivos);
                $("#dlg_nro_vehiculos").val(data[0].nro_vehiculos);
                $("#dlg_foto_comisaria").val('');
                if (data[0].foto == null) 
                {
                    $("#dlg_mostrar_foto_comisaria").attr("src","img/recursos/Home-icon.png");
                }
                else
                {
                    $("#dlg_mostrar_foto_comisaria").attr("src","data:image/png;base64,"+data[0].foto);
                }
                
                id_comisaria = $("#id_comisaria").val(data[0].id);
                if (id_comisaria == null) {
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=observaciones_comisarias&indice='+0 }).trigger('reloadGrid');
                    jQuery("#table_personal_comisaria").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=personal_comisaria&indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_observaciones").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=observaciones_comisarias&indice='+$("#id_comisaria").val() }).trigger('reloadGrid');
                    jQuery("#table_personal_comisaria").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=personal_comisaria&indice='+$("#id_comisaria").val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_nuevo_comisarias');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_comisarias');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_comisarias");
    }
    
}

function modificar_comisaria() {
    
    id_comisaria = $("#id_comisaria").val();
    ubicacion = $("#dlg_ubicacion").val();
    nombre_comisaria = $("#dlg_nombre_comisaria").val();
    telefono_comisaria = $("#dlg_telefono_comisaria").val();
    nro_efectivos = $("#dlg_nro_efectivos").val();
    nro_vehiculos = $("#dlg_nro_vehiculos").val();
    
    if(ubicacion == "")
    {
        mostraralertasconfoco("* El Campo Ubicacion Comisaria es Obligatorio","#dlg_ubicacion");
        return false;
    }
    if(nombre_comisaria == "")
    {
        mostraralertasconfoco("* El Campo Nombre Comisaria es Obligatorio","#dlg_nombre_comisaria");
        return false;
    }
    if(telefono_comisaria == "")
    {
        mostraralertasconfoco("* El Campo Telefono es Obligatorio","#dlg_telefono_comisaria");
        return false;
    }
    if(nro_efectivos == "")
    {
        mostraralertasconfoco("* El Campo Nro Efectivos Inicio es Obligatorio","#dlg_nro_efectivos");
        return false;
    }
    if(nro_vehiculos == "")
    {
        mostraralertasconfoco("* El Campo Nro Vehiculos Inicio es Obligatorio","#dlg_nro_vehiculos");
        return false;
    }
    
    MensajeDialogLoadAjax('dlg_nuevo_comisarias', '.:: Cargando ...');

    var form= new FormData($("#FormularioComisarias")[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'sub_geren_op_vigilancia_interna?tipo=3&id_comisaria='+id_comisaria,
        type: 'POST',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function(data) 
        {   
            if (data > 0) {
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_comisarias');
                fn_actualizar_grilla('table_comisarias');
                $("#dlg_nuevo_comisarias").dialog("close");
            }   
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('table_comisarias');
            console.log('error');
            console.log(data);
        }
    });
 
}

//OBSERVACIONES

function guardar_editar_observaciones(tipo) 
{
    id_comisaria = $('#id_comisaria').val();
    observaciones = $("#dlg_observacion").val();
    fecha_registro = $("#dlg_fecha_observacion").val();
    
    if(observaciones == "")
    {
        mostraralertasconfoco("* El Campo OBSERVACION es Obligatorio","#dlg_observacion");
        return false;
    }
    
    if(fecha_registro == "")
    {
        mostraralertasconfoco("* El Campo FECHA REGISTRO es Obligatorio","#dlg_fecha_observacion");
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
                fecha_registro:fecha_registro,
                id_comisaria:id_comisaria,
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

        id_observacion = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nueva_observacion', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_op_vigilancia_interna/'+id_observacion+'/edit',
            type: 'GET',
            data: {
        	observaciones:observaciones,
                fecha_registro:fecha_registro,
                tipo:5
            },
            success: function(data) 
            {
                MensajeExito('SE MODIFICO CORRECTAMENTE', 'Su Registro Fue Modificado Correctamente...');
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

function limpiar_observaciones()
{
    $("#dlg_observacion").val('');
    $('#dlg_fecha_observacion').val('');
}

function nueva_observacion()
{
    id_comisaria = $('#id_comisaria').val();
    if (id_comisaria != '') 
    {
        limpiar_observaciones();
        $("#dlg_nueva_observacion").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE OBSERVACION  :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        guardar_editar_observaciones(1);
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
    else
    {
        mostraralertasconfoco("No hay un Registro de Comisarias Seleccionado","#table_observaciones");
    }
}

function modificar_observacion()
{
    id_observacion = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_observacion) {
        
        $("#dlg_nueva_observacion").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION OBSERVACION :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    guardar_editar_observaciones(2);
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

        $.ajax({url: 'sub_geren_op_vigilancia_interna/'+id_observacion+'?show=observaciones_comisarias',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_observacion").val(data[0].observacion);
                $("#dlg_fecha_observacion").val(data[0].fecha_registro);
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
    id_observacion = $('#table_observaciones').jqGrid ('getGridParam', 'selrow');
    
    if (id_observacion) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'sub_geren_op_vigilancia_interna/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_observacion: id_observacion, tipo: 3},
                        success: function (data) {
                            fn_actualizar_grilla('table_observaciones');
                            MensajeExito('Eliminar Observacion', id_observacion + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Observacion', id_observacion + ' - No se pudo Eliminar.');
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

// PERSONAL COMISARIA

function guardar_editar_datos_persona(tipo) {
    
    dni = $("#dlg_dni").val();
    nombres = $("#dlg_nombres").val();
    apaterno = $("#dlg_apaterno").val();
    amaterno = $("#dlg_amaterno").val();
    telefono = $("#dlg_telefono").val();
    tipo_persona = $("#dlg_tipo_persona").val();
    
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
    if(tipo_persona == "0")
    {
        mostraralertasconfoco("* Debes seleccionar una opcion","#dlg_tipo_persona");
        return false;
    }

    if (tipo == 1) {
        MensajeDialogLoadAjax('dlg_nueva_persona', '.:: Cargando ...');
        
        var form= new FormData($("#FormularioPersonas")[0]);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_op_vigilancia_interna?tipo=1&id_comisaria='+$("#id_comisaria").val(),
            type: 'POST',
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success: function(data) 
            {   
                if (data > 0) 
                {
                    MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                    MensajeDialogLoadAjaxFinish('dlg_nueva_persona');
                    fn_actualizar_grilla('table_personal_comisaria');
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
                MensajeDialogLoadAjaxFinish('dlg_nueva_persona');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_personal_comisaria = $('#table_personal_comisaria').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nueva_persona', '.:: Cargando ...');
        var form= new FormData($("#FormularioPersonas")[0]);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_op_vigilancia_interna?tipo=2&id_personal_comisaria='+id_personal_comisaria,
            type: 'POST',
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success: function(data) 
            {
                if (data > 0) 
                {
                    MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');   
                    MensajeDialogLoadAjaxFinish('dlg_nueva_persona');
                    fn_actualizar_grilla('table_personal_comisaria');
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
                MensajeDialogLoadAjaxFinish('dlg_nueva_persona');
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
    $("#dlg_tipo_persona").val('0');
    $('#dlg_foto_persona').val('');
}

function nueva_persona()
{
    id_comisaria = $('#id_comisaria').val();
    if (id_comisaria != '') 
    {
        limpiar_persona();
        $('#foto_persona').hide();
        $("#formulario_persona").attr("class","col-xs-12 col-md-12 col-lg-12");
        $("#dlg_nueva_persona").dialog({
            autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO PERSONAL COMISARIA  :.</h4></div>",
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
    else
    {
        mostraralertasconfoco("No hay un Registro de Comisarias Seleccionado","#table_personal_comisaria");
    }
}

function modificar_persona()
{
    id_personal_comisaria = $('#table_personal_comisaria').jqGrid ('getGridParam', 'selrow');
    
    if (id_personal_comisaria) {
        
        $('#foto_persona').show();
        $("#formulario_persona").attr("class","col-xs-8 col-md-8 col-lg-8");
        $("#dlg_nueva_persona").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION PERSONAL COMISARIA :.</h4></div>",
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

        $.ajax({url: 'sub_geren_op_vigilancia_interna/'+id_personal_comisaria+'?show=personal_comisaria',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_dni").val(data[0].dni);
                $("#dlg_nombres").val(data[0].nombre);
                $("#dlg_apaterno").val(data[0].apaterno);
                $("#dlg_amaterno").val(data[0].amaterno);
                $("#dlg_telefono").val(data[0].telefono);
                $("#dlg_tipo_persona").val(data[0].tipo_per);
                $("#dlg_foto_persona").val('');
                if (data[0].foto === '') 
                {
                    $("#dlg_mostrar_foto_persona").attr("src","img/recursos/avatar.png");
                }
                else
                {
                    $("#dlg_mostrar_foto_persona").attr("src","data:image/png;base64,"+data[0].foto);
                }
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
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_personal_comisaria");
    }
}

function eliminar_persona()
{
    id_personal_comisaria = $('#table_personal_comisaria').jqGrid ('getGridParam', 'selrow');
    
    if (id_personal_comisaria) {

        $.confirm({
            title: '.:Cuidado... !',
            content: 'Los Cambios no se podran revertir...',
            buttons: {
                Confirmar: function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: 'sub_geren_op_vigilancia_interna/destroy',
                        type: 'POST',
                        data: {_method: 'delete', id_personal_comisaria: id_personal_comisaria, tipo: 4},
                        success: function (data) {
                            fn_actualizar_grilla('table_personal_comisaria');
                            MensajeExito('Eliminar Observacion', id_personal_comisaria + ' - Ha sido Eliminado');
                        },
                        error: function (data) {
                            MensajeAlerta('Eliminar Observacion', id_personal_comisaria + ' - No se pudo Eliminar.');
                        }
                    });
                },
                Cancelar: function () {
                    MensajeAlerta('Eliminar Personal Comisaria','Operacion Cancelada.');
                }

            }
        });
        
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_personal_comisaria");
    }   
}

function validar_foto_persona()
{
    var fileInput = document.getElementById('dlg_foto_persona');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.png|\.jpg|\.jpeg)$/i;
    if(!allowedExtensions.exec(filePath)){
        mostraralertasconfoco("ARCHIVO INCORRECTO SOLO SE PUEDEN SUBIR ARCHIVOS DE TIPO .PNG / .JPG / .JPEG","#dlg_foto_persona");
        fileInput.value = '';
        return false;
    }else{
        MensajeExito('ARCHIVO CORRECTO','PRESIONE GUARDAR PARA FINALIZAR');
    }
}

function validar_foto_comisaria()
{
    var fileInput = document.getElementById('dlg_foto_comisaria');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.png|\.jpg|\.jpeg)$/i;
    if(!allowedExtensions.exec(filePath)){
        mostraralertasconfoco("ARCHIVO INCORRECTO SOLO SE PUEDEN SUBIR ARCHIVOS DE TIPO .PNG / .JPG / .JPEG","#dlg_foto_comisaria");
        fileInput.value = '';
        return false;
    }else{
        MensajeExito('ARCHIVO CORRECTO','PRESIONE GUARDAR PARA FINALIZAR');
    }
}

function Cambiar_estado(id_personal_comisaria,id_comisaria,estado)
{
    $.ajax({
        url: 'sub_geren_op_vigilancia_interna/'+id_personal_comisaria+'/edit',
        type:'GET',
        data: {
            id_comisaria:id_comisaria,
            estado:estado,
            tipo:6
        },
        success: function(data)
        {
            MensajeExito('PERSONAL COMISARIA', 'EL REGISTRO HA SIDO ACTUALIZADO');
            id_comisaria = $("#id_comisaria").val();
            if (id_comisaria == null) {
                jQuery("#table_personal_comisaria").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=personal_comisaria&indice='+0 }).trigger('reloadGrid');
            }else{
                jQuery("#table_personal_comisaria").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=personal_comisaria&indice='+$("#id_comisaria").val() }).trigger('reloadGrid');
            }
        }        
    });
}
 function limpiar_datos_abogado(){
    $("#dlg_dni").val("");
    $("#dlg_nombre").val("");
}

function fn_buscar_abogados(){
    nombre = $("#dlg_buscar_abogado").val();
    fn_actualizar_grilla('table_abogados','procuraduria_mant_abogados/0?grid=abogados&nombre='+nombre);
}

function crear_nuevo_abogado()
{
    limpiar_datos_abogado();
    $("#dlg_nuevo_abogado").dialog({
        autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE ABOGADOS:.</h4></div>",
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
    $("#dlg_nuevo_abogado").dialog('open');
}

function guardar_editar_datos(tipo) {
    
    dni = $("#dlg_dni").val();
    nombre = $("#dlg_nombre").val();
    
    if(dni == "")
    {
        mostraralertasconfoco("* El Campo DNI es Obligatorio","#dlg_dni");
        return false;
    }
    if(nombre == "")
    {
        mostraralertasconfoco("* El Campo Nombre es Obligatorio","#dlg_nombre");
        return false;
    }

    if (tipo == 1) {
        MensajeDialogLoadAjax('dlg_nuevo_abogado', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria_mant_abogados/create',
            type: 'GET',
            data: {
        	dni:dni,
                nombre:nombre
            },
            success: function(data) 
            {
                if(data.msg === 'repetido'){
                    mostraralertasconfoco("* El Campo DNI ya Fue Registrado en el Sistema");
                    MensajeDialogLoadAjaxFinish('dlg_nuevo_abogado');
                    return false;
                }else{
                    MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                    MensajeDialogLoadAjaxFinish('dlg_nuevo_abogado');
                    fn_actualizar_grilla('table_abogados');
                    $("#dlg_nuevo_abogado").dialog("close");
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
    else if (tipo == 2) {

        id_abogado = $('#table_abogados').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nuevo_abogado', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria_mant_abogados/'+id_abogado+'/edit',
            type: 'GET',
            data: {
        	dni:dni,
                nombre:nombre
            },
            success: function(data) 
            {
                if(data.msg === 'repetido'){
                    mostraralertasconfoco("* El Campo DNI ya Fue Registrado en el Sistema");
                    MensajeDialogLoadAjaxFinish('dlg_nuevo_abogado');
                    return false;
                }else{
                    MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                    MensajeDialogLoadAjaxFinish('dlg_nuevo_abogado');
                    fn_actualizar_grilla('table_abogados');
                    $("#dlg_nuevo_abogado").dialog("close");
	        }
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_abogados');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function modificar_abogado()
{
    id_abogado = $('#table_abogados').jqGrid ('getGridParam', 'selrow');
    
    if (id_abogado) {
        
        $("#dlg_nuevo_abogado").dialog({
            autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION ABOGADOS :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    guardar_editar_datos(2);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_abogado").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_abogado', '.:: Cargando ...');

        $.ajax({url: 'procuraduria_mant_abogados/'+id_abogado,
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_dni").val(data[0].dni);
                $("#dlg_nombre").val(data[0].nombre);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_abogado');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_abogado');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_abogados");
    }
}


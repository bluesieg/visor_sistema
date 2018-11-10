 function limpiar_datos_proceso(){
    $("#dlg_descripcion").val("");
}

function fn_buscar_proceso(){
    descripcion = $("#dlg_buscar_proceso").val();
    fn_actualizar_grilla('table_proceso','procuraduria/0?grid=proceso&descripcion='+descripcion);
}

function crear_nuevo_proceso()
{
    limpiar_datos_proceso();
    $("#dlg_nuevo_proceso").dialog({
        autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE PROCESO:.</h4></div>",
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
    $("#dlg_nuevo_proceso").dialog('open');
}

function guardar_editar_datos(tipo) {
    
    descripcion = $("#dlg_descripcion").val();
    
    if(descripcion == "")
    {
        mostraralertasconfoco("* El Campo DESCRIPCION es Obligatorio","#dlg_dni");
        return false;
    }
 
    if (tipo == 1) {
        MensajeDialogLoadAjax('dlg_nuevo_proceso', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria/create',
            type: 'GET',
            data: {
        	descripcion:descripcion,
                tipo:5
            },
            success: function(data) 
            {
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_proceso');
                fn_actualizar_grilla('table_proceso');
                $("#dlg_nuevo_proceso").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_proceso');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_proceso = $('#table_proceso').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nuevo_proceso', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria/'+id_proceso+'/edit',
            type: 'GET',
            data: {
        	descripcion:descripcion,
                tipo:5
            },
            success: function(data) 
            {
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_proceso');
                fn_actualizar_grilla('table_proceso');
                $("#dlg_nuevo_proceso").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_proceso');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function modificar_proceso()
{
    id_proceso = $('#table_proceso').jqGrid ('getGridParam', 'selrow');
    
    if (id_proceso) {
        
        $("#dlg_nuevo_proceso").dialog({
            autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION PROCESO :.</h4></div>",
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
        $("#dlg_nuevo_proceso").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_proceso', '.:: Cargando ...');

        $.ajax({url: 'procuraduria/'+id_proceso+'?show=proceso',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_descripcion").val(data[0].descripcion);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_proceso');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_proceso');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_proceso");
    }
}


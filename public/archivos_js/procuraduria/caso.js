 function limpiar_datos_caso(){
    $("#dlg_descripcion").val("");
}

function fn_buscar_caso(){
    descripcion = $("#dlg_buscar_caso").val();
    fn_actualizar_grilla('table_caso','procuraduria/0?grid=casos&descripcion='+descripcion);
}

function crear_nuevo_caso()
{
    limpiar_datos_caso();
    $("#dlg_nuevo_caso").dialog({
        autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE CASO:.</h4></div>",
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
    $("#dlg_nuevo_caso").dialog('open');
}

function guardar_editar_datos(tipo) {
    
    descripcion = $("#dlg_descripcion").val();
    
    if(descripcion == "")
    {
        mostraralertasconfoco("* El Campo DESCRIPCION es Obligatorio","#dlg_descripcion");
        return false;
    }
 
    if (tipo == 1) {
        MensajeDialogLoadAjax('dlg_nuevo_caso', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria/create',
            type: 'GET',
            data: {
        	descripcion:descripcion,
                tipo:3
            },
            success: function(data) 
            {
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_caso');
                fn_actualizar_grilla('table_caso');
                $("#dlg_nuevo_caso").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_caso');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_caso = $('#table_caso').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nuevo_caso', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria/'+id_caso+'/edit',
            type: 'GET',
            data: {
        	descripcion:descripcion,
                tipo:3
            },
            success: function(data) 
            {
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_caso');
                fn_actualizar_grilla('table_caso');
                $("#dlg_nuevo_caso").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_caso');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function modificar_caso()
{
    id_caso = $('#table_caso').jqGrid ('getGridParam', 'selrow');
    
    if (id_caso) {
        
        $("#dlg_nuevo_caso").dialog({
            autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION CASO :.</h4></div>",
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
        $("#dlg_nuevo_caso").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_caso', '.:: Cargando ...');

        $.ajax({url: 'procuraduria/'+id_caso+'?show=casos',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_descripcion").val(data[0].descripcion);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_caso');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_caso');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_caso");
    }
}


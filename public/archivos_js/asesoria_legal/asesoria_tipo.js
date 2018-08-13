 function limpiar_datos_tipo(){
    $("#dlg_descripcion").val("");
}

function buscar_tipos(){
    descripcion = $("#dlg_buscar_tipo").val();
    fn_actualizar_grilla('table_asesoria_tipos','asesoria_legal/0?grid=tipos&descripcion='+descripcion);
}

function new_tipo()
{
    limpiar_datos_tipo();
    $("#dlg_nuevo_tipo").dialog({
        autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE TIPOS:.</h4></div>",
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
    $("#dlg_nuevo_tipo").dialog('open');
}

function guardar_editar_datos(tipo) {
    
    descripcion = $("#dlg_descripcion").val();
    
    if(descripcion == "")
    {
        mostraralertasconfoco("* El Campo DESCRIPCION es Obligatorio","#dlg_dni");
        return false;
    }
 
    if (tipo == 1) {
        MensajeDialogLoadAjax('dlg_nuevo_tipo', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'asesoria_legal/create?tipo=tipos',
            type: 'GET',
            data: {
        	descripcion:descripcion
            },
            success: function(data) 
            {
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_tipo');
                fn_actualizar_grilla('table_asesoria_tipos');
                $("#dlg_nuevo_tipo").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_asesoria_tipos');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_tipo = $('#table_asesoria_tipos').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nuevo_tipo', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'asesoria_legal/'+id_tipo+'/edit?tipo=tipos',
            type: 'GET',
            data: {
        	descripcion:descripcion
            },
            success: function(data) 
            {
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_tipo');
                fn_actualizar_grilla('table_asesoria_tipos');
                $("#dlg_nuevo_tipo").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_asesoria_tipos');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function edit_tipo()
{
    id_tipo = $('#table_asesoria_tipos').jqGrid ('getGridParam', 'selrow');
    
    if (id_tipo) {
        
        $("#dlg_nuevo_tipo").dialog({
            autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION TIPOS :.</h4></div>",
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
        $("#dlg_nuevo_tipo").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_tipo', '.:: Cargando ...');

        $.ajax({url: 'asesoria_legal/'+id_tipo+'?show=tipos',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_descripcion").val(data[0].descripcion);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_tipo');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_tipo');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_asesoria_tipos");
    }
}


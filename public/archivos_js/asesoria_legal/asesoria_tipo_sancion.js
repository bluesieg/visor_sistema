 function limpiar_datos_tipo_sancion(){
    $("#dlg_descripcion").val("");
}
function buscar_tipo_sancion(){
    descripcion = $("#dlg_buscar_tipo_sancion").val();
    fn_actualizar_grilla('table_asesoria_tipo_sancion','asesoria_legal/0?grid=t_sancion&descripcion='+descripcion);
}
function new_tipo_sancion()
{
    limpiar_datos_tipo_sancion();
    $("#dlg_nuevo_tipo_sancion").dialog({
        autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE TIPO SANCION:.</h4></div>",
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
    $("#dlg_nuevo_tipo_sancion").dialog('open');
}

function guardar_editar_datos(tipo) {
    
    descripcion = $("#dlg_descripcion").val();
    
    if(descripcion == "")
    {
        mostraralertasconfoco("* El Campo DESCRIPCION es Obligatorio","#dlg_dni");
        return false;
    }
 
    if (tipo == 1) {
        MensajeDialogLoadAjax('dlg_nuevo_tipo_sancion', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'asesoria_legal/create?tipo=t_sancion',
            type: 'GET',
            data: {
        	descripcion:descripcion
            },
            success: function(data) 
            {
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_tipo_sancion');
                fn_actualizar_grilla('table_asesoria_tipo_sancion');
                $("#dlg_nuevo_tipo_sancion").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_asesoria_tipo_sancion');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_tipo_sancion = $('#table_asesoria_tipo_sancion').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nuevo_tipo_sancion', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'asesoria_legal/'+id_tipo_sancion+'/edit?tipo=t_sancion',
            type: 'GET',
            data: {
        	descripcion:descripcion
            },
            success: function(data) 
            {
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_tipo_sancion');
                fn_actualizar_grilla('table_asesoria_tipo_sancion');
                $("#dlg_nuevo_tipo_sancion").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_asesoria_tipo_sancion');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function edit_tipo_sancion()
{
    id_tipo_sancion = $('#table_asesoria_tipo_sancion').jqGrid ('getGridParam', 'selrow');
    
    if (id_tipo_sancion) {
        
        $("#dlg_nuevo_tipo_sancion").dialog({
            autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION TIPO SANCION :.</h4></div>",
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
        $("#dlg_nuevo_tipo_sancion").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_tipo_sancion', '.:: Cargando ...');

        $.ajax({url: 'asesoria_legal/'+id_tipo_sancion+'?show=t_sancion',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_descripcion").val(data[0].descripcion);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_tipo_sancion');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_tipo_sancion');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_asesoria_tipo_sancion");
    }
}

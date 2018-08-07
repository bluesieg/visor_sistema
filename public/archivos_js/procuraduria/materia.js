 function limpiar_datos_materia(){
    $("#dlg_descripcion").val("");
}

function fn_buscar_materia(){
    descripcion = $("#dlg_buscar_materia").val();
    fn_actualizar_grilla('table_materia','procuraduria_mant_materia/0?grid=materia&descripcion='+descripcion);
}

function crear_nueva_materia()
{
    limpiar_datos_materia();
    $("#dlg_nueva_materia").dialog({
        autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE MATERIA:.</h4></div>",
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
    $("#dlg_nueva_materia").dialog('open');
}

function guardar_editar_datos(tipo) {
    
    descripcion = $("#dlg_descripcion").val();
    
    if(descripcion == "")
    {
        mostraralertasconfoco("* El Campo DESCRIPCION es Obligatorio","#dlg_descripcion");
        return false;
    }
 
    if (tipo == 1) {
        MensajeDialogLoadAjax('dlg_nueva_materia', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria_mant_materia/create',
            type: 'GET',
            data: {
        	descripcion:descripcion
            },
            success: function(data) 
            {
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nueva_materia');
                fn_actualizar_grilla('table_materia');
                $("#dlg_nueva_materia").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_materia');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_materia = $('#table_materia').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nueva_materia', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'procuraduria_mant_materia/'+id_materia+'/edit',
            type: 'GET',
            data: {
        	descripcion:descripcion
            },
            success: function(data) 
            {
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nueva_materia');
                fn_actualizar_grilla('table_materia');
                $("#dlg_nueva_materia").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_materia');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function modificar_materia()
{
    id_materia = $('#table_materia').jqGrid ('getGridParam', 'selrow');
    
    if (id_materia) {
        
        $("#dlg_nueva_materia").dialog({
            autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION MATERIA :.</h4></div>",
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
        $("#dlg_nueva_materia").dialog('open');


        MensajeDialogLoadAjax('dlg_nueva_materia', '.:: Cargando ...');

        $.ajax({url: 'procuraduria_mant_materia/'+id_materia,
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_descripcion").val(data[0].descripcion);
                MensajeDialogLoadAjaxFinish('dlg_nueva_materia');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nueva_materia');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_materia");
    }
}


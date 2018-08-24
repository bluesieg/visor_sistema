 function limpiar_datos(){
    $("#inp_descripcion").val("");
}


function crear_nuevo_procedimiento()
{
    limpiar_datos();
    $("#inp_anio").val($("#select_anio").val());
    $("#dlg_nuevo_comisarias").dialog({
        autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE COMISARIAS:.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_procedimiento();
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
}


function crear_nuevo_delito()
{
    limpiar_datos();
    $("#inp_anio").val($("#select_anio").val());
    $("#dlg_nuevo_mapa_delito").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE MAPA DELITO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_procedimiento();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_mapa_delito").dialog('open');

}
function Ruta_Serenazgo()
{
    limpiar_datos();
    $("#inp_anio").val($("#select_anio").val());


    $("#dlg_rutas_serenazgo").dialog({
        autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE SERENAZGO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_procedimiento();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_rutas_serenazgo").dialog('open');
}


function Zona_Riesgo()
{
    limpiar_datos();
    $("#inp_anio").val($("#select_anio").val());


    $("#dlg_Zona_Riesgo").dialog({
        autoOpen: false, modal: true, width: 700, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE SERENAZGO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_procedimiento();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_Zona_Riesgo").dialog('open');
}
function Atencion_Riesgo()
{
    limpiar_datos();
    $("#inp_anio").val($("#select_anio").val());


    $("#dlg_Atencion_Riesgo").dialog({
        autoOpen: false, modal: true, width: 700, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE SERENAZGO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_procedimiento();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_Atencion_Riesgo").dialog('open');
}

function dlg_Seguridad_Vial()
{
    limpiar_datos();
    $("#inp_anio").val($("#select_anio").val());


    $("#dlg_Seguridad_Vial").dialog({
        autoOpen: false, modal: true, width: 700, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE SERENAZGO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_procedimiento();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_Seguridad_Vial").dialog('open');

}
function dlg_Controlde_Pantallas()
{
    limpiar_datos();
    $("#inp_anio").val($("#select_anio").val());


$("#dlg_Controlde_Pantallas").dialog({
    autoOpen: false, modal: true, width:500,height:350, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  Control de Pantallas:.</h4></div>"
});
$("#dlg_Controlde_Pantallas").dialog('open');
}


function dlg_abrir_alumnos()
{

$("#dlg_nuevo_alumnos").dialog({
    autoOpen: false, modal: true, width:500,height:350, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>Alumnos:</h4></div>",
    buttons: [{
        html: "<i class='fa fa-save'></i>&nbsp; Grabar",
        "class": "btn btn-success bg-color-green",
        click: function () {
                grabar_procedimiento();
        }
    }, {
        html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
        "class": "btn btn-danger",
        click: function () {
            $(this).dialog("close");
        }
    }],
});
$("#dlg_nuevo_alumnos").dialog('open');
}

function dlg_abrir_Profesor()
{

$("#dlg_nuevo_profesor").dialog({
    autoOpen: false, modal: true, width:500,height:350, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>Alumnos:</h4></div>",
    buttons: [{
        html: "<i class='fa fa-save'></i>&nbsp; Grabar",
        "class": "btn btn-success bg-color-green",
        click: function () {
                grabar_procedimiento();
        }
    }, {
        html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
        "class": "btn btn-danger",
        click: function () {
            $(this).dialog("close");
        }
    }],
});
$("#dlg_nuevo_profesor").dialog('open');
}




function dlg_abrir_Curso()
{

$("#dlg_nuevo_Curso").dialog({
    autoOpen: false, modal: true, width:500,height:350, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>Alumnos:</h4></div>",
    buttons: [{
        html: "<i class='fa fa-save'></i>&nbsp; Grabar",
        "class": "btn btn-success bg-color-green",
        click: function () {
                grabar_procedimiento();
        }
    }, {
        html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
        "class": "btn btn-danger",
        click: function () {
            $(this).dialog("close");
        }
    }],
});
$("#dlg_nuevo_Curso").dialog('open');

}

function dlg_Abogados()
{

$("#dlg_Abogados").dialog({
    autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE ABOGADOS :.</h4></div>",
    buttons: [{
        html: "<i class='fa fa-save'></i>&nbsp; Aceptar",
        "class": "btn btn-success bg-color-green",
        click: function () {
                Aceptar_procedimiento();
        }
    }, {
        html: "<i class='fa fa-sign-out'></i>&nbsp; Cancelar",
        "class": "btn btn-danger",
        click: function () {
            $(this).dialog("cancelar");
        }
    }],
});



$("#dlg_Abogados").dialog('open');

}

function dlg_Tipos()
{

$("#dlg_Tipos").dialog({
    autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE TIPOS :.</h4></div>",
    buttons: [{
        html: "<i class='fa fa-save'></i>&nbsp; Aceptar",
        "class": "btn btn-success bg-color-green",
        click: function () {
                Aceptar_procedimiento();
        }
    }, {
        html: "<i class='fa fa-sign-out'></i>&nbsp; Cancelar",
        "class": "btn btn-danger",
        click: function () {
            $(this).dialog("cancelar");
        }
    }],
});
$("#dlg_Tipos").dialog('open');

}
function dlg_Proceso()
{
$("#dlg_Proceso").dialog({
    autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE PROCESO :.</h4></div>",
    buttons: [{
        html: "<i class='fa fa-save'></i>&nbsp; Aceptar",
        "class": "btn btn-success bg-color-green",
        click: function () {
                Aceptar_procedimiento();
        }
    }, {
        html: "<i class='fa fa-sign-out'></i>&nbsp; Cancelar",
        "class": "btn btn-danger",
        click: function () {
            $(this).dialog("cancelar");
        }
    }],
});
$("#dlg_Proceso").dialog('open');

}
function dlg_Sancion()
{
$("#dlg_Sancion").dialog({
    autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE SANCION :.</h4></div>",
    buttons: [{
        html: "<i class='fa fa-save'></i>&nbsp; Aceptar",
        "class": "btn btn-success bg-color-green",
        click: function () {
                Aceptar_procedimiento();
        }
    }, {
        html: "<i class='fa fa-sign-out'></i>&nbsp; Cancelar",
        "class": "btn btn-danger",
        click: function () {
            $(this).dialog("cancelar");
        }
    }],
});
$("#dlg_Sancion").dialog('open');

}


function dlg_Materia()
{
$("#dlg_Materia").dialog({
    autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE MATERIA :.</h4></div>",
    buttons: [{
        html: "<i class='fa fa-save'></i>&nbsp; Aceptar",
        "class": "btn btn-success bg-color-green",
        click: function () {
                Aceptar_procedimiento();
        }
    }, {
        html: "<i class='fa fa-sign-out'></i>&nbsp; Cancelar",
        "class": "btn btn-danger",
        click: function () {
            $(this).dialog("cancelar");
        }
    }],
});
$("#dlg_Materia").dialog('open');

}


function dlg_Caso()
{
$("#dlg_Caso").dialog({
    autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.:  NUEVO REGISTRO DE CASO  :.</h4></div>",
    buttons: [{
        html: "<i class='fa fa-save'></i>&nbsp; Aceptar",
        "class": "btn btn-success bg-color-green",
        click: function () {
                Aceptar_procedimiento();
        }
    }, {
        html: "<i class='fa fa-sign-out'></i>&nbsp; Cancelar",
        "class": "btn btn-danger",
        click: function () {
            $(this).dialog("cancelar");
        }
    }],
});
$("#dlg_Caso").dialog('open');

}

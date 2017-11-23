

/********************************REPORTE_SUPERVISORES**************************************************/

function crear_dialogo()
{
    $("#dialog_supervisores").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: Predios Ingresados Por Usuario :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Ver Reporte"  ,
            "class": "btn btn-success bg-color-green",
            click: function () { abrir_reporte(); }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }]
    }).dialog('open');
}

function abrir_reporte()
{
    window.open('reporte_supervisores/'+$('#select_sup_anio').val()+'/'+$('#select_sup_sec').val()+'/'+$('#select_sup_mz').val()+'');
}

function dlg_supervisor_reportes(tipo)
{
    if (tipo===0) {
        crear_dialogo();
        cargar_manzana('select_sup_mz');
    } 
}

function cargar_manzana(input)
{
    $("#"+input).html('');
    MensajeDialogLoadAjax(input, '.:: CARGANDO ...');
    $.ajax({url: 'selmzna?sec='+$("#select_sup_sec").val(),
        type: 'GET',
        success: function(r)
        {
            $(r).each(function(i, v){ 
                $("#"+input).append('<option value="' + v.id_mzna + '">' + v.codi_mzna + '</option>');
            })
            MensajeDialogLoadAjaxFinish(input);
        },
        error: function(data) {
            console.log('error');
            console.log(data);
        }
    });
}

/********************************REPORTE_CONTRIBUYENTES**************************************************/

function crear_dialogo_contribuyentes(){

    $("#dialog_reporte_contribuyentes").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: Listado de Contribuyentes(Pricos,Mecos,Pecos) :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Ver Reporte"  ,
            "class": "btn btn-success bg-color-green",
            click: function () { abrir_reporte_contribuyente(); }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }]
    }).dialog('open');

}

function dlg_reporte_contribuyentes(tipo)
{
    if (tipo===0) {
        crear_dialogo_contribuyentes();
    } 
}

function abrir_reporte_contribuyente()
{
    window.open('reporte_contribuyentes/'+ $('#selantra_r0').val()+ '/'+ $('#min').val()+ '/' + $('#max').val() + '/'  +$('#num_reg').val());
}


/********************************REPORTE_LISTADO_DATOS_CONTRIBUYENTES**************************************************/

function crear_dialogo_listado_datos_contribuyentes()
{
    $("#dialog_listado_datos_contribuyente").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: Listado de Datos de los Contribuyentes :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Ver Reporte"  ,
            "class": "btn btn-success bg-color-green",
            click: function () { abrir_reporte_listado_contribuyente(); }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }]
    }).dialog('open');
}

function dlg_listado_datos_contribuyentes(tipo)
{
    if (tipo===0) {
        crear_dialogo_listado_datos_contribuyentes();
        cargar_manzana_contribuyente('select_manzana');
    } 
}

function cargar_manzana_contribuyente(input)
{
    $("#"+input).html('');
    MensajeDialogLoadAjax(input, '.:: CARGANDO ...');
    $.ajax({url: 'selmzna?sec='+$("#select_sector").val(),
        type: 'GET',
        success: function(r)
        {
            $(r).each(function(i, v){ 
                $("#"+input).append('<option value="' + v.id_mzna + '">' + v.codi_mzna + '</option>');
            })
            MensajeDialogLoadAjaxFinish(input);
        },
        error: function(data) {
            console.log('error');
            console.log(data);
        }
    });
}

function abrir_reporte_listado_contribuyente()
{
    window.open('listado_datos_contribuyentes/'+$('#select_sup_anio').val()+'/'+$('#select_sector').val());
}

/********************************REPORTE_LISTADO_DATOS_CONTRIBUYENTES_PREDIOS**************************************************/

function crear_dialogo_listado_datos_contribuyentes_predios()
{
    $("#dialog_listado_datos_contribuyente_predios").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: Listado de Datos de los Contribuyentes y Predios :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Ver Reporte"  ,
            "class": "btn btn-success bg-color-green",
            click: function () { abrir_reporte_listado_contribuyente_predio(); }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }]
    }).dialog('open');
}

function dlg_listado_datos_contribuyentes_predios(tipo)
{
    if (tipo===0) {
        crear_dialogo_listado_datos_contribuyentes_predios();
        cargar_manzana_contribuyente_predio('select_mzna');
    } 
}

function cargar_manzana_contribuyente_predio(input)
{
    $("#"+input).html('');
    MensajeDialogLoadAjax(input, '.:: CARGANDO ...');
    $.ajax({url: 'selmzna?sec='+$("#select_sect").val(),
        type: 'GET',
        success: function(r)
        {
            $(r).each(function(i, v){ 
                $("#"+input).append('<option value="' + v.id_mzna + '">' + v.codi_mzna + '</option>');
            })
            MensajeDialogLoadAjaxFinish(input);
        },
        error: function(data) {
            console.log('error');
            console.log(data);
        }
    });
}

function abrir_reporte_listado_contribuyente_predio()
{
    window.open('listado_contribuyentes_predios/'+$('#select_sup_anio').val()+'/'+$('#select_sect').val()+'');
}

/********************************REPORTE_CANTIDAD_CONTRIBUYENTES_EXONERADOS**************************************************/

function crear_dialogo_contribuyentes_exonerados()
{
    $("#dialog_reporte_contribuyentes_exonerados").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: Listado de Datos de los Contribuyentes y Predios :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Ver Reporte"  ,
            "class": "btn btn-success bg-color-green",
            click: function () { abrir_reporte_contribuyentes_exonerados(); }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }]
    }).dialog('open');
}

function dlg_reporte_contribuyentes_exonerados(tipo)
{
    if (tipo===0) {
        crear_dialogo_contribuyentes_exonerados();
    } 
}

function abrir_reporte_contribuyentes_exonerados()
{
    window.open('reporte_contribuyentes_exonerados/'+$('#selantra_5').val()+'/'+$('#selsec_5').val()+'/'+$('#selcond_5').val()+'');
}

/********************************REPORTE_CANTIDAD_CONTRIBUYENTES_DEDUCCION_50UIT**************************************************/


function crear_dialogo_reporte_cantidad_contribuyentes()
{
    $("#dialog_reporte_cantidad_contribuyentes").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: Listado de Datos de los Contribuyentes y Predios :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Ver Reporte"  ,
            "class": "btn btn-success bg-color-green",
            click: function () { abrir_reporte_cantidad_contribuyentes(); }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }]
    }).dialog('open');
}

function dlg_reporte_cantidad_contribuyentes(tipo)
{
    if (tipo===0) {
        crear_dialogo_reporte_cantidad_contribuyentes();
    } 
}

function abrir_reporte_cantidad_contribuyentes()
{
    window.open('reporte_cantidad_contribuyentes/'+$('#selantra_7').val()+'/'+$('#selsec_7').val()+'');
}


/********************************REPORTE_DE_USUARIOS************************************************************/

function crear_dialogo_usuario()
{
    $("#dialog_busqueda_usuarios").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: Listado de Datos de los Predios Ingresados por Usuario :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Ver Reporte"  ,
            "class": "btn btn-success bg-color-green",
            click: function () { abrir_reporte_usuarios(); }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }]
    }).dialog('open');
}

function dlg_busqueda_usuarios(tipo)
{
    if (tipo===0) {
        crear_dialogo_usuario(); 
        $('#dlg_id').val("");
        $('#dlg_usuario').val("");
    } 
}

function fn_bus_contrib_rus()
{
    if($("#dlg_usuario").val()=="")
    {
        mostraralertasconfoco("Ingresar Información de busqueda","#dlg_usuario"); 
        return false;
    }
    if($("#dlg_usuario").val().length<4)
    {
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#dlg_usuario"); 
        return false;
    }
    jQuery("#table_usuario").jqGrid('setGridParam', {url: 'obtener_usuarios?dat='+$("#dlg_usuario").val()}).trigger('reloadGrid');

    $("#dlg_bus_usuario").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Usuarios :.</h4></div>"       
        }).dialog('open');
       
}

function fn_bus_contrib_list_rus(per)
{
    $("#dlg_id").val($('#table_usuario').jqGrid('getCell',per,'id'));
    $("#dlg_usuario").val($('#table_usuario').jqGrid('getCell',per,'ape_nom'));
    $("#dlg_bus_usuario").dialog("close");  
}

function abrir_reporte_usuarios()
{
    window.open('reporte_usuarios/'+$('#dlg_id').val()+'');
}


/******* NUEVOS
/********************************REPORTE_DE_CONTRIBUYENTES Y PREDIOS************************************************************/

function crear_dialogo_reporte_contribuyentes_predios()
{
    $("#dialog_reporte_contribuyente_predio").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>&nbsp&nbsp.: Reporte de cantidad de contribuyentes y predios por zonas :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Ver Reporte"  ,
            "class": "btn btn-success bg-color-green",
            click: function () { abrir_reporte_contribuyente_predio(); }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }]
    }).dialog('open');
}

function dlg_reporte_contribuyentes_predios(tipo)
{
    if (tipo===0) {
        crear_dialogo_reporte_contribuyentes_predios();
    } 
}

function abrir_reporte_contribuyente_predio()
{
    window.open('reporte_contribuyentes_predios_zonas/'+$('#select_sup_anio_rcp').val()+'/'+$('#select_sector_rcp').val()+'');
}

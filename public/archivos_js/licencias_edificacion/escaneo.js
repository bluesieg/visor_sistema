function llamarsubmitscan()
{
    MensajeDialogLoadAjax('dlg_subir_escaneo', '.:: CARGANDO ...');
    $("#FormularioScans").submit();
    $('#ifrafile').load(function(){MensajeDialogLoadAjaxFinish('dlg_subir_escaneo');}).show();
}
function subir_scan(id)
{
    $("#id_scan").val(id);
    $("#dlg_subir_escaneo").dialog({
    autoOpen: false, modal: true, width: 700, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.: Subir Archivos :.</h4></div>",
    buttons: [
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Grabar",
                "class": "btn btn-primary bg-color-green",
                click: function () {grabarfinal();}
            },
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
    }).dialog('open');
}
function grabarfinal()
{
    MensajeDialogLoadAjax('dlg_subir_escaneo', '.:: CARGANDO ...');
    var form= new FormData($("#FormularioScans")[0]);
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'subir_escaneo',
        type: 'POST',  
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function(r) 
        {
            if(r==0)
            {
                mostraralertasconfoco("Subir Archivo de lo contrario no se podra Grabar","#dlg_documento_file");
            }
            else
            {
                MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
                $("#dlg_subir_escaneo").dialog("close");
            }
            MensajeDialogLoadAjaxFinish('dlg_subir_escaneo');
            jQuery("#table_doc").jqGrid('setGridParam', {url: 'get_expedientes_resolucion?id='+$("#id_scan").val()}).trigger('reloadGrid');
            
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_subir_escaneo');
            console.log('error');
            console.log(data);
        }
        });
}
function verfile(id)
{
    window.open('ver_documentos/'+id);
}

function delfile(id)
{
    id_escaneo=$('#table_escaneos').jqGrid ('getGridParam', 'selrow');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'emitir_resolucion/destroy',
        type: 'POST',
        data: {_method: 'delete', id_doc_adj: id},
        success: function (data) {
            MensajeExito("Operacion Correcta","Se eliminio Correctamente el Archivo...",4000);
            jQuery("#table_doc").jqGrid('setGridParam', {url: 'get_docs?id='+id_escaneo}).trigger('reloadGrid');
        },
        error: function (data) {
            return false;
        }
    });
}

function busqueda_escaneo()
{
    jQuery("#table_escaneos").jqGrid('setGridParam', {url: 'get_expedientes_resolucion?fecini='+$("#fec_ini_escaneo").val()+'&fecfin='+$("#fec_fin_escaneo").val()}).trigger('reloadGrid');
}

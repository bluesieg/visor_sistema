function limpiar_datos_asesoria()
{
    $('#dlg_documento_des_procuraduria').val('');
    $('#dlg_documento_file_procuraduria').val('');
    $('#ifrafile').attr('src','about:blank');
}

function llamarsubmitscan()
{
    MensajeDialogLoadAjax('dlg_subir_escaneo_procuraduria', '.:: CARGANDO ...');
    $("#FormularioScans_procuraduria").submit();
    $('#ifrafile').load(function(){MensajeDialogLoadAjaxFinish('dlg_subir_escaneo_procuraduria');}).show();
}
function subir_scan_procuraduria(id)
{
    limpiar_datos_asesoria();
    $("#id_scan_procuraduria").val(id);
    $("#dlg_subir_escaneo_procuraduria").dialog({
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
    id_escaneo = $('#table_escaneos').jqGrid ('getGridParam', 'selrow');
    MensajeDialogLoadAjax('dlg_subir_escaneo_procuraduria', '.:: CARGANDO ...');
    var form= new FormData($("#FormularioScans_procuraduria")[0]);
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'procuraduria?tipo=2',
        type: 'POST',  
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function(r) 
        {
            if(r==0)
            {
                mostraralertasconfoco("Subir Archivo de lo contrario no se podra Grabar","#dlg_documento_file_procuraduria");
            }
            else
            {
                MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
                $("#dlg_subir_escaneo_procuraduria").dialog("close");
            }
            MensajeDialogLoadAjaxFinish('dlg_subir_escaneo_procuraduria');
            jQuery("#table_doc").jqGrid('setGridParam', {url: 'procuraduria/0?grid=doc_adjuntos&id='+id_escaneo}).trigger('reloadGrid');
            
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_subir_escaneo_procuraduria');
            console.log('error');
            console.log(data);
        }
        });
}

function verfile(id)
{
    window.open('procuraduria/0?reporte=escaneos&id='+id);
}

function delfile(id)
{   
    id_escaneo = $('#table_escaneos').jqGrid ('getGridParam', 'selrow');
    
    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'procuraduria/destroy',
                    type: 'POST',
                    data: {_method: 'delete', id_doc_adj: id, tipo: 2},
                    success: function (data) {
                        MensajeExito("Operacion Correcta","Se eliminio Correctamente el Archivo...",4000);
                        jQuery("#table_doc").jqGrid('setGridParam', {url: 'procuraduria/0?grid=doc_adjuntos&id='+id_escaneo}).trigger('reloadGrid');

                    },
                    error: function (data) {
                        MensajeAlerta('Eliminar Documento', id + ' - No se pudo Eliminar.');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Eliminar Documento','Operacion Cancelada.');
            }

        }
    });
}

function busqueda_escaneo_asesoria()
{
    jQuery("#table_escaneos").jqGrid('setGridParam', {url: 'asesoria_legal/0?grid=escaneos&nro_expediente='+$('#dlg_buscar_nro_expediente').val()}).trigger('reloadGrid');
}

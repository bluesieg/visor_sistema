function limpiar_datos()
{
    $('#dlg_documento_descripcion').val('');
    $('#dlg_documento_file').val('');
    $('#ifrafile').attr('src','about:blank');
}

function llamarsubmitscan()
{
    var fileInput = document.getElementById('dlg_documento_file');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.pdf)$/i;
    if(!allowedExtensions.exec(filePath)){
        mostraralertasconfoco("ARCHIVO INCORRECTO SOLO SE PUEDEN SUBIR ARCHIVOS DE TIPO .PDF","#dlg_documento_file");
        fileInput.value = '';
        return false;
    }else{
        MensajeExito('ARCHIVO CORRECTO','PRESIONE GUARDAR PARA FINALIZAR');
        MensajeDialogLoadAjax('dlg_subir_escaneo_comisarias', '.:: CARGANDO ...');
        $("#FormularioScans").submit();
        $('#ifrafile').load(function(){MensajeDialogLoadAjaxFinish('dlg_subir_escaneo_comisarias');}).show();
    }
}
function subir_scan_comisaria(id)
{
    limpiar_datos();
    $("#id_comisaria_scan").val(id);
    $("#dlg_subir_escaneo_comisarias").dialog({
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
    MensajeDialogLoadAjax('dlg_subir_escaneo_comisarias', '.:: CARGANDO ...');
    var form= new FormData($("#FormularioScans")[0]);
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'sub_geren_op_vigilancia_interna?tipo=5',
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
                $("#dlg_subir_escaneo_comisarias").dialog("close");
            }
            MensajeDialogLoadAjaxFinish('dlg_subir_escaneo_comisarias');
            jQuery("#table_doc").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=doc_adjuntos_comisarias&id='+id_escaneo}).trigger('reloadGrid');
            
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_subir_escaneo_comisarias');
            console.log('error');
            console.log(data);
        }
        });
}

function verfile_comisaria(id)
{
    window.open('sub_geren_op_vigilancia_interna/0?reporte=escaneos_comisarias&id='+id);
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
                    url: 'sub_geren_op_vigilancia_interna/destroy',
                    type: 'POST',
                    data: {_method: 'delete', id_doc_adj_com: id, tipo: 5},
                    success: function (data) {
                        MensajeExito("Operacion Correcta","Se eliminio Correctamente el Archivo...",4000);
                        jQuery("#table_doc").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=doc_adjuntos_comisarias&id='+id_escaneo}).trigger('reloadGrid');

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

function busqueda_escaneo_comisaria()
{
    jQuery("#table_escaneos").jqGrid('setGridParam', {url: 'sub_geren_op_vigilancia_interna/0?grid=escaneos_comisarias&nombre='+$('#dlg_comisaria_scan').val()}).trigger('reloadGrid');
}

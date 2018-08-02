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
        url: 'create_scaneo_hab_urb',
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
            jQuery("#table_doc").jqGrid('setGridParam', {url: 'cargar_documetos?id='+$("#id_scan").val()}).trigger('reloadGrid');
             enviar_a_final_hab_urb();
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
    window.open('ver_file_hab_urb/'+id);
}
function busqueda_escaneo_hab_urb()

{
     fecha_desde = $("#dlg_fec_desde5").val(); 
     fecha_hasta = $("#dlg_fec_hasta5").val(); 
    jQuery("#table_escaneos").jqGrid('setGridParam', {url: 'get_expedientes_resolucion_hab_urb?fecini='+fecha_desde+'&fecfin='+fecha_hasta}).trigger('reloadGrid');
}
function enviar_a_final_hab_urb()
{
    Id=$('#table_verif_tecnica').jqGrid ('getGridParam', 'selrow');
    if(Id)
    {
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'hab_urbana/'+Id+'/edit',
                    type: 'GET',
                    data:{estado:9},
                    success: function(data) 
                    {
                        MensajeExito('Expediente', 'Expediente APROBADO');
                        fn_actualizar_grilla('table_verif_tecnica');
                    },
                    error: function(data) {
                        mostraralertas("hubo un error, Comunicar al Administrador");
                        console.log('error');
                        console.log(data);
                    }
            });
    }
     else
    {
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_verif_tecnica");
    }
}
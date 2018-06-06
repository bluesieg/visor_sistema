 function limpiar_datos(){
    $('#inp_cod_exp').val("");
}
function selecciona_fecha4(){

    fecha_desde = $("#dlg_fec_desde4").val(); 
    fecha_hasta = $("#dlg_fec_hasta4").val(); 

    jQuery("#table_verif_tecnica").jqGrid('setGridParam', {
         url: 'getVerifTecnica?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta
    }).trigger('reloadGrid');

}
function crear_verificacion_tecnica()
{
    Id=$('#table_verif_tecnica').jqGrid ('getGridParam', 'selrow');
    $("#dlg_nuevo_verificacion_tecnica").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REVISIÓN TÉNICA :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_verificacion_tecnica();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_verificacion_tecnica").dialog('open');
    
    MensajeDialogLoadAjax('dlg_nuevo_verificacion_tecnica', '.:: Cargando ...');
    $.ajax({url: 'traer_datos_verif_tecnica/'+Id,
        type: 'GET',
        success: function(r)
        {
            $("#hidden_id_expediente_tec").val(r[0].id_reg_exp);
            $("#inp_nro_exp_tec").val(r[0].nro_exp);
            
            MensajeDialogLoadAjaxFinish('dlg_nuevo_verificacion_tecnica');

        },
        error: function(data) {
            mostraralertas("Hubo un Error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_verificacion_tecnica');
        }
    });
}
function guardar_verificacion_tecnica()
{
     MensajeDialogLoadAjax('dlg_nuevo_verificacion_tecnica', '.:: CARGANDO ...');
        var form= new FormData($("#FormularioScans1")[0]);
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'create_verificacion_tecnica',
        type: 'POST',  
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function(r) 
        {
            if(r==0)
            {
                mostraralertasconfoco("Subir Archivo de lo contrario no se podra Grabar","#dlg_documento_file1");
            }
            else
            {
                MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
                $("#dlg_nuevo_verificacion_tecnica").dialog("close");
            }
            MensajeDialogLoadAjaxFinish('dlg_nuevo_verificacion_tecnica');
            
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_nuevo_verificacion_tecnica');
            console.log('error');
            console.log(data);
        }
        });   
}
/////////////enviar a crear poligono

function enviar_a_aprobados()
{
    Id=$('#table_escaneos').jqGrid ('getGridParam', 'selrow');
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
                        fn_actualizar_grilla('table_escaneos');
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
///////////NOTIFICAR
function notificar_verif_tecnica()
{
    Id=$('#table_verif_tecnica').jqGrid ('getGridParam', 'selrow');
    crear_editor()
    if(Id)
    {
    $("#dlg_notificacion_tecnica").dialog({
        autoOpen: false, modal: true, width: 850, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  CREAR NOTIFICACIÓN :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Imprimir",
            "class": "btn btn-success bg-color-purple",
            click: function () {

                guargar_notificacion(Id);
                MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_notificacion_tecnica").dialog('open');
    }
     else
    {
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_verif_tecnica");
    }
   
}

iniciar1=0;
function crear_editor()
{
   if(iniciar1==0)
    {
        iniciar1=1;
        CKEDITOR.replace('ckeditor1');
    }
    CKEDITOR.instances['ckeditor1'].setData('');
}
function guargar_notificacion(id_expediente)
{
    var contenido = CKEDITOR.instances['ckeditor1'].getData();
    MensajeDialogLoadAjax('dlg_notificacion_tecnica', '.:: CARGANDO ...');
        $.ajax({url: 'notificaciones_tecnica/create',
        type: 'GET',
        data:{id_expediente:id_expediente,txt_notificacion:contenido},
        success: function(r) 
        {
            MensajeDialogLoadAjaxFinish('dlg_notificacion_tecnica');
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            $("#dlg_notificacion_tecnica").dialog("close");
            imprimir_notificacion(id_expediente);
            
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_notificacion_tecnica');
            console.log('error');
            console.log(data);
        }
        });
}
function imprimir_notificacion(id)
{
    window.open('rep_notificacion_verif_tecnica_hab_urb/'+id+'');
}

function enviar_a_notificados_tecnica(id)
{
    guardar_fec_notificacion_tecnica(id);
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'hab_urbana/'+id+'/edit',
            type: 'GET',
            data:{estado:8},
            success: function(data) 
            {
                MensajeExito('Expediente', 'Expediente Enviado a CREAR RESOLUCIÓN.');
                fn_actualizar_grilla('table_verif_tecnica');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
    });
}
function guardar_fec_notificacion_tecnica(id)
{
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'notificaciones_tecnica/'+id+'/edit',
            type: 'GET',
            data:{},
            success: function(data) 
            {
                MensajeExito('Expediente', 'FECHA DE NOTIFICACION GUARDADA');
                
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
    });
}
//////////////
function enviar_a_improcedente()
{
    Id=$('#table_verif_tecnica').jqGrid ('getGridParam', 'selrow');
    if(Id)
    {
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'hab_urbana/'+Id+'/edit',
                    type: 'GET',
                    data:{estado:6},
                    success: function(data) 
                    {
                        MensajeExito('Expediente', 'Expediente Improcedente');
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

////////subir docs

                                         
                                           

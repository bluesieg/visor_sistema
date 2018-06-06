 function limpiar_datos(){
    $('#inp_cod_exp').val("");
}
function selecciona_fecha2(){

    fecha_desde = $("#dlg_fec_desde2").val(); 
    fecha_hasta = $("#dlg_fec_hasta2").val(); 

    jQuery("#table_verificacion_admin").jqGrid('setGridParam', {
         url: 'getExpedientesVerif?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta
    }).trigger('reloadGrid');

}

function crear_verificacion_admin(tipo)
{
    if(tipo==0)
    {
        $("#dlg_nuevo_verificacion_admin").dialog({
        autoOpen: false, modal: true, width: 850, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  VERIFICACIÓN ADMINISTRATIVA :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {

                guardar_verificacion_admin();
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
        $("#dlg_nuevo_verificacion_admin").dialog('open');
    }
     if(tipo==1)
    {
        $("#dlg_nuevo_verificacion_admin").dialog({
        autoOpen: false, modal: true, width: 850, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGULARIZACIÓN :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {

                guardar_verificacion_admin();
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
        $("#dlg_nuevo_verificacion_admin").dialog('open');
    }
    
    
    MensajeDialogLoadAjax('dlg_nuevo_verificacion_admin', '.:: Cargando ...');

    id = $('#table_verificacion_admin').jqGrid ('getGridParam', 'selrow');
    $.ajax({url: 'traer_datos_verif/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#hidden_id_expediente").val(r[0].id_reg_exp);
            $("#inp_nro_exp").val(r[0].nro_exp);
            $("#inp_gestor").val(r[0].gestor);
            $("#inp_fecha_inicio_tramite").val(r[0].fecha_inicio_tramite);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_verificacion_admin');

        },
        error: function(data) {
            mostraralertas("Hubo un Error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_verificacion_admin');
        }
    });
    
}
function seleccionar_requisito()
{
     jQuery("#table_requisitos").jqGrid('setGridParam', {
        url: 'getRequisitos?id='+$('#select_requisito').val(),
    }).trigger('reloadGrid');
}


function guardar_verificacion_admin()
{
    id_reg_exp = $('#hidden_id_expediente').val();
    MensajeDialogLoadAjax('dlg_nuevo_verificacion_admin', '.:: Cargando ...');
        $.ajax({url: 'verificacion_admin/create',
        type: 'GET',
        data:{  id_reg_exp:id_reg_exp,
                procedimiento:$("#select_requisito").val(),
                observacion:$("#inp_observacion").val()
        },
        
        success: function(r) 
        {
            
            MensajeDialogLoadAjaxFinish('dlg_nuevo_verificacion_admin');
            $("#dlg_nuevo_verificacion_admin").dialog('close');
            agregar_requisitos(id_reg_exp);
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_verificacion_admin');
        }
        }); 
}
function agregar_requisitos(id_reg_exp){
    
    $('input[type=checkbox][name=estado]').each(function() {
        guardar_requisitos($(this).attr('id_requisito'),$(this).is(':checked')?1:0,id_reg_exp);
    });  
}

function guardar_requisitos(id_requisito,estado,id_reg_exp)
{
    MensajeDialogLoadAjax('dlg_nuevo_verificacion_admin', '.:: Cargando ...');
        $.ajax({url: 'insertar_requisitos',
        type: 'GET',
        data:{  id_requisito:id_requisito,
                estado:estado,
                id_reg_exp:id_reg_exp
                
        },
        success: function(r) 
        {
            
            MensajeDialogLoadAjaxFinish('dlg_nuevo_verificacion_admin');
            $("#dlg_nuevo_verificacion_admin").dialog('close');
           
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_verificacion_admin');
        }
        }); 
}

/////////////enviar a crear poligono

function enviar_a_crear_poligono()
{
    Id=$('#table_verificacion_admin').jqGrid ('getGridParam', 'selrow');
    if(Id)
    {
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'hab_urbana/'+Id+'/edit',
                    type: 'GET',
                    data:{estado:3},
                    success: function(data) 
                    {
                        MensajeExito('Expediente', 'Expediente Enviado a Crear Poligono.');
                        fn_actualizar_grilla('table_verificacion_admin');
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
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_verificacion_admin");
    }
}
///////////NOTIFICAR
function notificar_verif_admin()
{
    Id=$('#table_verificacion_admin').jqGrid ('getGridParam', 'selrow');
    crear_editor_admin()
    $("#dlg_notificacion_admin").dialog({
        autoOpen: false, modal: true, width: 850, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  CREAR NOTIFICACIÓN :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Imprimir",
            "class": "btn btn-success bg-color-purple",
            click: function () {

                guargar_notificacio_admin(Id);
                MensajeExito("Insertó Correctamente","Se creó la notifocación con Éxito...",4000);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_notificacion_admin").dialog('open');
   
}

iniciar=0;
function crear_editor_admin()
{
   if(iniciar==0)
    {
        iniciar=1;
        CKEDITOR.replace('ckeditor');
    }
    CKEDITOR.instances['ckeditor'].setData('');
}
function guargar_notificacio_admin(id_expediente)
{
    var contenido = CKEDITOR.instances['ckeditor'].getData();
    MensajeDialogLoadAjax('dlg_notificacion_admin', '.:: CARGANDO ...');
        $.ajax({url: 'notificaciones_verif_admin/create',
        type: 'GET',
        data:{id_expediente:id_expediente,txt_notificacion:contenido},
        success: function(r) 
        {
            MensajeDialogLoadAjaxFinish('dlg_notificacion_admin');
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            $("#dlg_notificacion_admin").dialog("close");
            imprimir_notificacion_admin(id_expediente);
            
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_notificacion_admin');
            console.log('error');
            console.log(data);
        }
        });
}
function imprimir_notificacion_admin(id)
{
    window.open('rep_notificacion_verif_admin_hab_urb/'+id+'');
}
/////////////////// FECHA NOTIFICACION

function enviar_a_notificados_admin(id)
{
    guardar_fec_notificacion_admin(id);
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'hab_urbana/'+id+'/edit',
            type: 'GET',
            data:{estado:8},
            success: function(data) 
            {
                MensajeExito('Expediente', 'Expediente Enviado a NOTIFICADOS ADMINISTRATIVO.');
                fn_actualizar_grilla('table_verificacion_admin');
                
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
    });
}
function guardar_fec_notificacion_admin(id)
{
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'notificaciones_verif_admin/'+id+'/edit',
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
//////////////////
function enviar_a_improcedente_admin()
{
    Id=$('#table_verificacion_admin').jqGrid ('getGridParam', 'selrow');
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
                        fn_actualizar_grilla('table_verificacion_admin');
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
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_verificacion_admin");
    }
}                                       
                  
 function limpiar_datos_verif_administrativa(){
        $('#dlg_num_expediente').val("");
        $('#dlg_gestor').val("");
        $('#dlg_modalidad_administrativa').val("");
        $('#dlg_cod_interno').val("");
        $('#dlg_hidden_id_procedimiento').val("");
        $('#dlg_hidden_id_reg_exp').val("");
        $('#dlg_observaciones').val("");
        jQuery("#table_requisito_admin").jqGrid('setGridParam', {url: 'buscar_requisitos?indice='+0 }).trigger('reloadGrid');
}

function crear_nueva_verif_administrativa()
{
    limpiar_datos_verif_administrativa();
    $("#dlg_verif_administrativa").dialog({
        autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVA VERIFICACION ADMINISTRATIVA :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    agregar_verificacion();
                    MensajeExito('Verificacion del Expediente','La operacion fue Exitosa');
                    cambiar_estado_verif_admin($('#dlg_hidden_id_reg_exp').val());
                    agregar_observacion($('#dlg_hidden_id_reg_exp').val());
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_verif_administrativa").dialog('open');
}

function cambiar_estado_verif_admin(id_reg_exp){
    $.ajax({
        url: 'estado_verif_admin',
        type: 'GET',
        data: {
            id_reg_exp :id_reg_exp,
        },
        success: function (data) {
            return true;
        },
        error: function (data) {
            return false;
        }
    });
}

function agregar_observacion(id_reg_exp){
    observaciones = $('#dlg_observaciones').val();
    $.ajax({
        url: 'agregar_observacion',
        type: 'GET',
        data: {
            id_reg_exp :id_reg_exp,
            observaciones:observaciones
        },
        success: function (data) {
            return true;
        },
        error: function (data) {
            return false;
        }
    });
}

function improcedente_verif_admin(){
    Id=$('#table_verif_administrativa').jqGrid ('getGridParam', 'selrow');
    
    fecha_inicio_verif_admin = $('#fec_ini_verif_administrativa').val();
    fecha_fin_verif_admin = $('#fec_fin_verif_administrativa').val();

    if(Id)
    {
        $.ajax({
            url: 'improcedente_verif_admin',
            type: 'GET',
            data: {
                id_reg_exp :Id,
            },
            success: function (data) {
                jQuery("#table_verif_administrativa").jqGrid('setGridParam', {
                        url: 'get_verif_administrativa?fecha_inicio='+fecha_inicio_verif_admin+'&fecha_fin='+fecha_fin_verif_admin
                   }).trigger('reloadGrid');
                MensajeExito('Expediente', 'Se Declaro Improcedente.');
            },
            error: function (data) {
                return false;
            }
        });
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_control_calidad");
    }
}

function fn_obtener_exp_cod()
{
    codigo_interno = $("#dlg_cod_interno").val();

    if (codigo_interno == '') {
        mostraralertasconfoco('* El campo Codigo de Expediente es obligatorio...', '#dlg_cod_interno');
        return false;
    }
    
    MensajeDialogLoadAjax('dlg_verif_administrativa', '.:: Cargando ...');
        $.ajax({url: 'buscar_codigo_interno',
        type: 'GET',
        data:{codigo:codigo_interno},
        success: function(data) 
        {
            if (data.msg === 'si'){
                MensajeDialogLoadAjaxFinish('dlg_verif_administrativa');
                MensajeExito('Codigo Interno Encontrado', 'El Expediente ejecuto la operacion correctamente.');
                
                $('#dlg_num_expediente').val(data.nro_exp);
                $('#dlg_gestor').val(data.gestor);
                $('#dlg_modalidad_administrativa').val(data.procedimiento);
                $('#dlg_hidden_id_reg_exp').val(data.id_reg_exp);
                id_procedimiento = $('#dlg_hidden_id_procedimiento').val(data.id_procedimiento);
                if (id_procedimiento == null) {
                    jQuery("#table_requisito_admin").jqGrid('setGridParam', {url: 'buscar_requisitos?indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_requisito_admin").jqGrid('setGridParam', {url: 'buscar_requisitos?indice='+$('#dlg_hidden_id_procedimiento').val() }).trigger('reloadGrid');
                }
                
            }else{
                mostraralertasconfoco("Mensaje del Sistema, NO EXISTE EL NUMERO DE CODIGO INTERNO");
                limpiar_datos_verif_administrativa();
                MensajeDialogLoadAjaxFinish('dlg_verif_administrativa');
            }
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_verif_administrativa');
        }
    }); 
}

function agregar_verificacion(){
    id_reg_exp = $("#dlg_hidden_id_reg_exp").val();
    
    $('input[type=checkbox][name=id_requisito_check]').each(function() {
        insertar_datos_administrativa($(this).attr('id_requisito'),$(this).is(':checked')?1:0,id_reg_exp);
    });  
}

function insertar_datos_administrativa(id_requisito,estado,id_reg_exp) {
   
    fecha_inicio_verif_admin = $('#fec_ini_verif_administrativa').val();
    fecha_fin_verif_admin = $('#fec_fin_verif_administrativa').val();

    
    MensajeDialogLoadAjax('dlg_verif_administrativa', '.:: Cargando ...');
    
    $.ajax({
        url: 'verificacion_administrativa/create',
        type: 'GET',
        data: {
            id_requisito :id_requisito,
            id_reg_exp   :id_reg_exp,
            estado       :estado
        },
        success: function (data) {
            MensajeDialogLoadAjaxFinish('dlg_verif_administrativa');
            dialog_close('dlg_verif_administrativa');
            jQuery("#table_verif_administrativa").jqGrid('setGridParam', {
             url: 'get_verif_administrativa?fecha_inicio='+fecha_inicio_verif_admin+'&fecha_fin='+fecha_fin_verif_admin
            }).trigger('reloadGrid');
        },
        error: function (data) {
            return false;
        }
    });
}


function modificar_verif_administrativa()
{
    id=$('#table_verif_administrativa').jqGrid ('getGridParam', 'selrow');
    if (id) {
        $("#dlg_verif_administrativa").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR VERIFICACION ADMINISTRATIVA :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                     actualizar_exp();
                     MensajeExito('La Actualizacion de Verificacion del Expediente','La operacion fue Exitosa');
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_verif_administrativa").dialog('open');


        MensajeDialogLoadAjax('dlg_verif_administrativa', '.:: Cargando ...');

        id = $('#table_verif_administrativa').jqGrid ('getGridParam', 'selrow');
        $.ajax({url: 'verificacion_administrativa/'+id,
            type: 'GET',
            success: function(r)
            {
                $("#dlg_num_expediente").val(r[0].nro_exp);
                $("#dlg_gestor").val(r[0].gestor);
                $("#dlg_modalidad_administrativa").val(r[0].descr_procedimiento);
                $("#dlg_cod_interno").val(r[0].cod_interno);
                id_reg_exp = $('#dlg_hidden_id_reg_exp').val(r[0].id_expediente);
                if (id_reg_exp == null) {
                    jQuery("#table_requisito_admin").jqGrid('setGridParam', {url: 'recuperar_requisitos?indice='+0 }).trigger('reloadGrid');
                }else{
                    jQuery("#table_requisito_admin").jqGrid('setGridParam', {url: 'recuperar_requisitos?indice='+$('#dlg_hidden_id_reg_exp').val() }).trigger('reloadGrid');
                }
                MensajeDialogLoadAjaxFinish('dlg_verif_administrativa');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_verif_administrativa');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_recdocumentos");
    }
}

function actualizar_exp(){
    id_reg_exp = $("#dlg_hidden_id_reg_exp").val();
    
    $('input[type=checkbox][name=estado]').each(function() {
        actualizar_datos($(this).attr('id_requisito'),$(this).is(':checked')?1:0,id_reg_exp);
    });  
}

function actualizar_datos(id_requisito,estado,id_reg_exp) {
    
    MensajeDialogLoadAjax('dlg_verif_administrativa', '.:: Cargando ...');
    
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'verificacion_administrativa/'+id_requisito+'/edit',
        type: 'GET',
        data: {
            id_requisito :id_requisito,
            id_reg_exp   :id_reg_exp,
            estado       :estado
        },
        success: function (data) {
            MensajeDialogLoadAjaxFinish('dlg_verif_administrativa');
            dialog_close('dlg_verif_administrativa');
            fn_actualizar_grilla('table_verif_administrativa');
        },
        error: function (data) {
            return false;
        }
    });
}

function revision_tecnica() {
    id=$('#table_verif_administrativa').jqGrid ('getGridParam', 'selrow');
    id_reg_exp = $('#table_verif_administrativa').jqGrid ('getCell', id, 'id_reg_exp');
    if (id) {
        MensajeDialogLoadAjax('table_verif_administrativa', '.:: Cargando ...');

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'cambiar_estado',
            type: 'GET',
            data: {
                id_reg_exp :id_reg_exp
            },
            success: function (data) {
                MensajeDialogLoadAjaxFinish('table_verif_administrativa');
                fn_actualizar_grilla('table_verif_administrativa');
                MensajeExito('Actualizacion de Verificacion del Expediente','Expediente fue enviado a Revision Tecnica');
            },
            error: function (data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('table_verif_administrativa');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_verif_administrativa");
    }
}


function seleccionafecha_verif_adm(){

    fecha_inicio_verif_admin = $('#fec_ini_verif_administrativa').val();
    fecha_fin_verif_admin = $('#fec_fin_verif_administrativa').val();

    jQuery("#table_verif_administrativa").jqGrid('setGridParam', {
         url: 'get_verif_administrativa?fecha_inicio='+fecha_inicio_verif_admin+'&fecha_fin='+fecha_fin_verif_admin
    }).trigger('reloadGrid');

}

iniciar=0;
function limpiar_notificacion()
{
    if(iniciar==0)
    {
        iniciar=1;
        CKEDITOR.replace('ckeditor', {height: '320px'});
    }
    CKEDITOR.instances['ckeditor'].setData('');
}

function notificar(){
    
    Id=$('#table_verif_administrativa').jqGrid ('getGridParam', 'selrow');
    id_reg_exp = $('#table_verif_administrativa').jqGrid ('getCell', Id, 'id_reg_exp');
    if(Id)
    {
        limpiar_notificacion();
        $("#dlg_editor").dialog({
            autoOpen: false, modal: true, width: 800,height:620, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: EDITAR RESOLUCION :.</h4></div>",
            buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_notificacion();
            }
            },{
            html: "<i class='fa fa-print'></i>&nbsp; Imprimir",
            "class": "btn btn-success bg-color-purple",
            click: function () {
                    imprimir_notificacion(id_reg_exp);
            }
            },{
                 html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }]        
        }).dialog('open');
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_control_calidad");
    }
}

function guardar_notificacion(){
    
    id=$('#table_verif_administrativa').jqGrid ('getGridParam', 'selrow');
    id_reg_exp = $('#table_verif_administrativa').jqGrid ('getCell', id, 'id_reg_exp');
    var contenido = CKEDITOR.instances['ckeditor'].getData();
    MensajeDialogLoadAjax('dlg_editor', '.:: Cargando ...');

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'notificacion_verif_admin',
        type: 'GET',
        data: {
            id_reg_exp :id_reg_exp,
            notificacion:contenido
        },
        success: function (data) {
            MensajeDialogLoadAjaxFinish('dlg_editor');
            MensajeExito('Actualizacion de Verificacion del Expediente','La Notificacion fue Guardada con exito');
        },
        error: function (data) {
            mostraralertas("Hubo un Error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('table_verif_administrativa');
        }
    });
    
}

function imprimir_notificacion(id_reg_exp){
    window.open('rep_notificacion_verif_admin/'+id_reg_exp);
   
    fecha_inicio_verif_admin = $('#fec_ini_verif_administrativa').val();
    fecha_fin_verif_admin = $('#fec_fin_verif_administrativa').val();
    
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'notificacion_estado',
        type: 'GET',
        data: {
            id_reg_exp :id_reg_exp,
        },
        success: function (data) {
            dialog_close('dlg_editor');
            jQuery("#table_verif_administrativa").jqGrid('setGridParam', {
                 url: 'get_verif_administrativa?fecha_inicio='+fecha_inicio_verif_admin+'&fecha_fin='+fecha_fin_verif_admin
            }).trigger('reloadGrid');
        },
        error: function (data) {
            mostraralertas("Hubo un Error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('table_verif_administrativa');
        }
    });
}

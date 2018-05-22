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
                    cambiar_estado_verif_admin($('#dlg_hidden_id_reg_exp').val());
                    //MensajeExito('Verificacion del Expediente','La operacion fue Exitosa');
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
    codigo_interno = $("#dlg_cod_interno").val();
    if (codigo_interno == '') {
        mostraralertasconfoco('* El campo Codigo Interno es obligatorio...', '#dlg_cod_interno');
        return false;
    }
    if (id_reg_exp == '') {
        mostraralertasconfoco('* El campo Codigo Expediente es obligatorio...', '#dlg_hidden_id_reg_exp');
        return false;
    }
    
    agregar_observacion($('#dlg_hidden_id_reg_exp').val());
    
    $('input[type=checkbox][name=id_requisito_check]').each(function() {
        insertar_datos_administrativa($(this).attr('id_requisito'),$(this).is(':checked')?1:0,id_reg_exp,0);
    });  
}

function insertar_datos_administrativa(id_requisito,estado,id_reg_exp,dialogo) {
   
    fecha_inicio_verif_admin = $('#fec_ini_verif_administrativa').val();
    fecha_fin_verif_admin = $('#fec_fin_verif_administrativa').val();

    if (dialogo == 0) {
        MensajeDialogLoadAjax('dlg_verif_administrativa', '.:: Cargando ...');
    }else{
        MensajeDialogLoadAjax('dlg_verif_admin_regularizacion', '.:: Cargando ...');
    }
    
    
    $.ajax({
        url: 'verificacion_administrativa/create',
        type: 'GET',
        data: {
            id_requisito :id_requisito,
            id_reg_exp   :id_reg_exp,
            estado       :estado
        },
        success: function (data) {
            if (dialogo == 0) {
                MensajeDialogLoadAjaxFinish('dlg_verif_administrativa');
                dialog_close('dlg_verif_administrativa');
            }else{
                MensajeDialogLoadAjaxFinish('dlg_verif_admin_regularizacion');
                dialog_close('dlg_verif_admin_regularizacion');
            }
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
                $("#dlg_observaciones").val(r[0].observacion);
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
    
    actualizar_observacion(id_reg_exp);
    
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

function actualizar_observacion(id_reg_exp){
    observaciones = $('#dlg_observaciones').val();
    $.ajax({
        url: 'actualizar_observaciones',
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


function regularizacion()
{
    id=$('#table_verif_administrativa').jqGrid ('getGridParam', 'selrow');
    if (id) {
        $("#dlg_verif_admin_regularizacion").dialog({
            autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  REGULARIZACION :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                     agregar_multas();
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
        $("#dlg_verif_admin_regularizacion").dialog('open');


        MensajeDialogLoadAjax('dlg_verif_admin_regularizacion', '.:: Cargando ...');

        id = $('#table_verif_administrativa').jqGrid ('getGridParam', 'selrow');
        $.ajax({url: 'verificacion_administrativa/'+id,
            type: 'GET',
            success: function(r)
            {
                $("#dlg_num_expediente_reg").val(r[0].nro_exp);
                $("#dlg_gestor_reg").val(r[0].gestor);
                $("#dlg_cod_interno_reg").val(r[0].cod_interno);
                $('#dlg_hidden_id_reg_exp_reg').val(r[0].id_expediente);
                jQuery("#table_verif_admin_multas").jqGrid('setGridParam', {url: 'recuperar_multas?id_modalidad='+$('#dlg_modalidad_administrativa_reg').val() }).trigger('reloadGrid');
                MensajeDialogLoadAjaxFinish('dlg_verif_admin_regularizacion');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_verif_admin_regularizacion');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_recdocumentos");
    }
}

function agregar_multas(){
    id_reg_exp = $("#dlg_hidden_id_reg_exp_reg").val();
    
    $('input[type=checkbox][name=multa_check]').each(function() {
        insertar_datos_administrativa($(this).attr('id_requisito'),$(this).is(':checked')?1:0,id_reg_exp,1);
    });  
}

function check_cambiar_estado(val){
    fecha_inicio_verif_admin = $('#fec_ini_verif_administrativa').val();
    fecha_fin_verif_admin = $('#fec_fin_verif_administrativa').val();
    
    if($(val).is(':checked')){
        jQuery("#table_verif_administrativa").jqGrid('setGridParam', {url: 'get_verif_administrativa?check='+1+'&fecha_inicio='+fecha_inicio_verif_admin+'&fecha_fin='+fecha_fin_verif_admin }).trigger('reloadGrid');
        $('#botones_admin').hide();
        $('#botones_notificacion').show();
    } else {
        jQuery("#table_verif_administrativa").jqGrid('setGridParam', {url: 'get_verif_administrativa?check='+2+'&fecha_inicio='+fecha_inicio_verif_admin+'&fecha_fin='+fecha_fin_verif_admin }).trigger('reloadGrid');
        $('#botones_admin').show();
        $('#botones_notificacion').hide();
    }
}


function ver_notificaciones_verif_admin(){
    id=$('#table_verif_administrativa').jqGrid ('getGridParam', 'selrow');
    if (id) {
        id_reg_exp = $('#table_verif_administrativa').jqGrid ('getCell', id, 'id_reg_exp');
        window.open('rep_notificacion_verif_admin/'+id_reg_exp);
    }
    else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_verif_administrativa");
    }
}

function elminar_notificacion(id_reg_exp){
    
    fecha_inicio_verif_admin = $('#fec_ini_verif_administrativa').val();
    fecha_fin_verif_admin = $('#fec_fin_verif_administrativa').val();
    
    $.ajax({url: 'actualizar_expediente_verif_admin',
        type: 'GET',
        data:{id_reg_exp:id_reg_exp},
        success: function(data) 
        {
            jQuery("#table_verif_administrativa").jqGrid('setGridParam', {url: 'get_verif_administrativa?check='+1+'&fecha_inicio='+fecha_inicio_verif_admin+'&fecha_fin='+fecha_fin_verif_admin }).trigger('reloadGrid');
            MensajeExito('Expediente', 'Se Restablecio el Expediente.');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
        }
    });
}

function cargar_lote()
{
    $('#id_expediente_lote').val('');
    $('#lote_verif_admin').val('');
    id=$('#table_verif_administrativa').jqGrid ('getGridParam', 'selrow');
    if (id) {
        $("#dlg_cargar_lote").dialog({
            autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  CARGAR LOTE :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                     actualizar_exp_lote();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_cargar_lote").dialog('open');


        MensajeDialogLoadAjax('dlg_cargar_lote', '.:: Cargando ...');

        id = $('#table_verif_administrativa').jqGrid ('getGridParam', 'selrow');
        $.ajax({url: 'verificacion_administrativa/'+id,
            type: 'GET',
            success: function(r)
            {
                $("#id_reg_exp_lote").val(r[0].id_expediente);
                $("#codigo_expediente_lote").val(r[0].nro_exp);
                
                MensajeDialogLoadAjaxFinish('dlg_cargar_lote');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_cargar_lote');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_recdocumentos");
    }
}

//CODIGO DEL MAPA

mapa_lote_verif_admin=0;
function cargar_mapa()
{
    if(mapa_lote_verif_admin==0)
    {
        mapa_lote_verif_admin=1;
        cargar_mapa_lotes_verif_admin();
    }
    crear_dlg_mapa_verif_admin("dlg_mapa_verif_admin",1000,"SELECCIONE LOTE");
}

function crear_dlg_mapa_verif_admin(dlg,ancho,titulo)
{
    $("#"+dlg).dialog({
    autoOpen: false, modal: true, width: ancho, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.: "+titulo+" :.</h4></div>",
    buttons: [
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
    }).dialog('open');
}

function cargar_mapa_lotes_verif_admin()
{
        autocompletar_haburb('inp_habilitacion');
        window.app = {};
        var app = window.app;
        var layersList = [];
        var vectorSource = new ol.source.Vector({});
        var lyr_sectores;
        var lyr_manzanas;
        var lyr_limites_distritales0;
        var lyr_lotes3;
        var lyr_predios4;
        var LayersList2= [lyr_sectores,lyr_manzanas,lyr_limites_distritales0,lyr_lotes3,lyr_predios4];
        
        app.CustomToolbarControl = function(opt_options) {

            var options = opt_options || {};

            var button = document.createElement('button');
            button.innerHTML = 'N';

            var button1 = document.createElement('button');
            button1.innerHTML = 'some button';

            var selectList = document.createElement("input");
            selectList.id = "inp_habilitacion";
            selectList.className = "input-sm col-xs-12";
            selectList.type = "text";
            selectList.style = "height:18px";
            selectList.placeholder = "Seleccione Habilitación";

            var this_ = this;
            var handleRotateNorth = function(e) {
                this_.getMap().getView().setRotation(0);
            };

            button.addEventListener('click', handleRotateNorth, false);
            button.addEventListener('touchstart', handleRotateNorth, false);

            var element = document.createElement('div');
            element.className = 'ol-unselectable ol-mycontrol';
            element.style='width:700px !important'

            element.appendChild(selectList);

            ol.control.Control.call(this, {
                element: element,
                target: options.target
            });
        };
        ol.inherits(app.CustomToolbarControl, ol.control.Control);
        var map = new ol.Map({
            controls: ol.control.defaults({
                attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
                    collapsible: false
                })
            }).extend([
                new app.CustomToolbarControl()
            ]),
            layers: [
                new ol.layer.Group({
                    'title': 'Base maps',
                    layers: [
                        
                        new ol.layer.Tile({
                            title: 'OSM',
                            type: 'base',
                            visible: true,
                            source: new ol.source.OSM()
                        }),
                        new ol.layer.Tile({
                            title: 'Water color',
                            type: 'base',
                            visible: false,
                            source: new ol.source.Stamen({
                                layer: 'watercolor'
                            })
                        }),
                        new ol.layer.Tile({
                            title: 'Blanco',
                            type: 'base',
                            visible: false
                        }),
                        new ol.layer.Tile({
                            title: 'Satelite',
                            visible: false,
                            source: new ol.source.BingMaps({
                              key: 'EqfF5l6dY2LLMQa8JHlI~voA5TXsAVOQgFOP74piAbg~Aqg-emVFCImabFdRRDvdjqh1rB6Bl9l8ZkcmL7nGveSeeNkV7iSRC7XTHi1XeUVu',
                              imagerySet: 'Aerial'
                            })
                        })
                    ]
                })
            ],
            target: 'id_map_reg_lote',
            
        });
        $.ajax({url: 'mapa_cris_getlimites',
                    type: 'GET',
                    async: false,
                    success: function(r)
                    {
                        mapa_bd = JSON.parse(r[0].json_build_object);
                        var format_limites_distritales0 = new ol.format.GeoJSON();
                        var features_limites_distritales0 = format_limites_distritales0.readFeatures(mapa_bd,
                                {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                        var jsonSource_limites_distritales0 = new ol.source.Vector({
                            attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                        });
                        jsonSource_limites_distritales0.addFeatures(features_limites_distritales0);

                        lyr_limites_distritales0 = new ol.layer.Vector({
                            source:jsonSource_limites_distritales0,
                            style: polygonStyleFunction,
                            title: "Limites",

                        });

                        map.addLayer(lyr_limites_distritales0);
                        var scale = new ol.control.ScaleLine();
                        map.addControl(scale);
                        var extent = lyr_limites_distritales0.getSource().getExtent();
                        map.getView().fit(extent, map.getSize());
                        var fullscreen = new ol.control.FullScreen();
                        map.addControl(fullscreen);

                    $.ajax({url: 'gethab_urb_by_id/0',
                    type: 'GET',
                    async: false,
                    success: function(r)
                    {
                        geojson_sectores_cat1 = JSON.parse(r[0].json_build_object);
                        var format_sectores_cat1 = new ol.format.GeoJSON();
                        var features_sectores_cat1 = format_sectores_cat1.readFeatures(geojson_sectores_cat1,
                                {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                        var jsonSource_sectores_cat1 = new ol.source.Vector({
                            attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                        });
                        jsonSource_sectores_cat1.addFeatures(features_sectores_cat1);
                        lyr_sectores_cat1 = new ol.layer.Vector({
                            source:jsonSource_sectores_cat1,
                            style: polygonStyleFunction,
                            title: "Habilitaciones Urbanas"
                        });
                        map.addLayer(lyr_sectores_cat1);

                    }
                });
            }
        });
        
  
        function polygonStyleFunction(feature, resolution) {
            return new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'blue',
                    width: 2
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(0, 0, 255, 0.1)'
                }),
                text: new ol.style.Text({
                    font: '12px Calibri,sans-serif',
                    fill: new ol.style.Fill({ color: '#fff' }),
                    stroke: new ol.style.Stroke({
                        color: '#000', width: 2
                    }),
                    text:map.getView().getZoom() > 14 ? feature.get('nomb_hab_urba') : ""
                })
            });
        }
        function autocompletar_haburb(textbox){
            $.ajax({
                type: 'GET',
                url: 'autocomplete_hab_urba',
                success: function (data) {

                    var $datos = data;
                    $("#"+ textbox).autocomplete({
                        source: $datos,
                        focus: function (event, ui) {
                            $("#" + textbox).val(ui.item.label);
                            return false;
                        },
                        select: function (event, ui) {
                            $("#" + textbox).val(ui.item.label);
                            $("#hidden_"+ textbox).val(ui.item.value);
                            traer_hab_by_id(ui.item.value);
                            return false;
                        }
                    });
                }
            });
        }

        function traer_hab_by_id(id)
        {
        map.removeLayer(lyr_sectores_cat1);
        map.removeLayer(lyr_lotes3);
        MensajeDialogLoadAjax('dlg_map', '.:: Cargando ...');
        $.ajax({url: 'gethab_urb_by_id/'+id,
                    type: 'GET',
                    async: false,
                    success: function(r)
                    {
                        geojson_sectores_cat1 = JSON.parse(r[0].json_build_object);
                        var format_sectores_cat1 = new ol.format.GeoJSON();
                        var features_sectores_cat1 = format_sectores_cat1.readFeatures(geojson_sectores_cat1,
                                {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                        var jsonSource_sectores_cat1 = new ol.source.Vector({
                            attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                        });
                        jsonSource_sectores_cat1.addFeatures(features_sectores_cat1);
                        lyr_sectores_cat1 = new ol.layer.Vector({
                            source:jsonSource_sectores_cat1,
                            style: polygonStyleFunction,
                            title: "Habilitaciones Urbanas"
                        });
                        map.addLayer(lyr_sectores_cat1);
                        var extent = lyr_sectores_cat1.getSource().getExtent();
                        map.getView().fit(extent, map.getSize());
                        traer_lote_by_hab(id);

                    }
                });
    }
        function traer_lote_by_hab(id)
        {
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'get_lotes_x_hab_urb',
                    type: 'GET',
                    data: {codigo: id},
                    success: function (data) {
                        //alert(data[0].json_build_object);
                        //alert(geojson_manzanas2);
                        map.removeLayer(lyr_lotes3);
                        var format_lotes3 = new ol.format.GeoJSON();
                        var features_lotes3 = format_lotes3.readFeatures(JSON.parse(data[0].json_build_object),
                            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
                        var jsonSource_lotes3 = new ol.source.Vector({
                            attributions: [new ol.Attribution({html: '<a href=""></a>'})],
                        });
                        //vectorSource.addFeatures(features_manzanas2);
                        jsonSource_lotes3.addFeatures(features_lotes3);
                        lyr_lotes3 = new ol.layer.Vector({
                            source:jsonSource_lotes3,
                            style: label_lotes,
                            title: "lotes"
                        });
                        map.addLayer(lyr_lotes3);
                        MensajeDialogLoadAjaxFinish('dlg_map');

                    },
                    error: function (data) {
                        MensajeAlerta('Predios','No se encontró ningún predio.');
                    }
                });
        }
        function label_lotes(feature) {
    return new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'green',
            width: 1
        }),
        fill: new ol.style.Fill({
            color: 'rgba(0, 255, 0, 0.1)'
        }),
        text: new ol.style.Text({
            font: '12px Calibri,sans-serif',
            fill: new ol.style.Fill({ color: '#000' }),
            stroke: new ol.style.Stroke({
                color: '#fff', width: 2
            }),
            // get the text from the feature - `this` is ol.Feature
            // and show only under certain resolution
            text: map.getView().getZoom() > 17 ? feature.get('codi_lote') : ''
        })
         /*
        text: new ol.style.Text({
            text: feature.get('nom_lote')
        })
       text: map.getView().getZoom() > 12 ? feature.get('nom_lote') : ''*/
    });
}

        map.on('singleclick', function(evt) {

            
            mostrar=0;
            var fl = map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
               
                if(layer.get('title')=='lotes'&&mostrar==0)
                {
                    mostrar=1;
                    //viewlong_lote(feature.get('id_lote'));
                    $("#id_expediente_lote").val(feature.get('id_lote'));
                    $("#lote_verif_admin").val(feature.get('codi_lote'));
                    
                    if($("#id_expediente_lote").val() == '')
                    {
                        MensajeAlerta('Mensaje del Sistema' ,'No se Selecciono ningun poligono');
                        return false;
                    }else
                    { 
                        MensajeExito('Lote Seleccionado Correctamente', 'Operacion Ejecutada Correctamente.');
                        $("#dlg_mapa_verif_admin").dialog('close');
                        return false;
                    } 
                }
            });
            
        });
}

function actualizar_exp_lote(){
    
    id_reg_exp = $('#id_reg_exp_lote').val();
    id_lote = $('#id_expediente_lote').val();
    
    if (id_reg_exp == '') {
        mostraralertasconfoco('* El Codigo de Expediente es Obligatorio...', '#id_reg_exp_lote');
        return false;
    }
    if (id_lote == '') {
        mostraralertasconfoco('* Debe seleccionar un Lote...', '#id_expediente_lote');
        return false;
    }
    
    $.ajax({
        url: 'agregar_lote_verif_admin',
        type: 'GET',
        data: {
            id_reg_exp :id_reg_exp,
            id_lote:id_lote
        },
        success: function (data) {
            MensajeExito('El Lote Fue Agregado Correctamente al Expediente', 'Operacion Ejecutada Correctamente.');
            $("#dlg_cargar_lote").dialog('close');
        },
        error: function (data) {
            return false;
        }
    });
}
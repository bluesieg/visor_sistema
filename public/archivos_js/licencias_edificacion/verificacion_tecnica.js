function limpiar_datos_grilla(){
    jQuery("#table_revision_expediente").jqGrid('setGridParam', {url: 'get_revision_expediente' }).trigger('reloadGrid');
    $('#tabla2').hide();
    $('#tabla1').show();
    $('#notificacion_1').val('');
    $('#notificacion_2').val('');
    $('#notificacion_3').val('');
    $('#notificacion_4').val('');
    $('#notificacion_5').val('');
    $('#notificacion_6').val('');
}


function crear_nueva_verif_tecnica()
{
    fecha_inicio_verif_tec = $('#fec_ini_verif_tecnica').val();
    fecha_fin_verif_tec = $('#fec_fin_verif_tecnica').val();
    limpiar_datos_grilla();
    id=$('#table_verif_tecnica').jqGrid ('getGridParam', 'selrow');
    if (id) {
        $("#dlg_verif_tecnica").dialog({
            autoOpen: false, modal: true, width: 1100, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: VERIFICACION TECNICA :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    agregar_revision();
                    
                    jQuery("#table_verif_tecnica").jqGrid('setGridParam', {
                        url: 'get_verif_tecnica?fecha_inicio='+fecha_inicio_verif_tec+'&fecha_fin='+fecha_fin_verif_tec
                   }).trigger('reloadGrid');
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_verif_tecnica").dialog('open');


        MensajeDialogLoadAjax('dlg_verif_tecnica', '.:: Cargando ...');

        id = $('#table_verif_tecnica').jqGrid ('getGridParam', 'selrow');
        $.ajax({url: 'licencias_verificacion_tecnica/'+id,
            type: 'GET',
            success: function(r)
            {
                $("#dlg_hidden_verif_tecnica_id_reg_exp").val(r[0].id_reg_exp);
                $("#dlg_cod_interno_verif_tecnica").val(r[0].cod_interno);
                $("#dlg_num_expediente_verif_tecnica").val(r[0].nro_exp);
                $("#dlg_gestor_verif_tecnica").val(r[0].gestor);
                $("#dlg_modalidad_administrativa_verif_tecnica").val(r[0].descr_procedimiento);
                
                MensajeDialogLoadAjaxFinish('dlg_verif_tecnica');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_verif_tecnica');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_recdocumentos");
    }
}

function agregar_revision(){

    var form= new FormData($("#FormularioEscaneo")[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'guardar_f',
        type: 'POST',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.msg === 'existe_revisiones'){
                
               mostraralertasconfoco("Mensaje del Sistema, EL EXPEDIENTE YA TIENE ASOCIADO REVISIONES PARA ESTE ENCARGADO");
                
            }else{
                MensajeExito('La Actualizacion de Verificacion del Expediente','La operacion fue Exitosa');
                dialog_close('dlg_verif_tecnica');
            }
        },
        error: function (data) {
            return false;
        }
    }); 
}


function seleccionafecha_verif_tec(){

    fecha_inicio_verif_tec = $('#fec_ini_verif_tecnica').val();
    fecha_fin_verif_tec = $('#fec_fin_verif_tecnica').val();

    jQuery("#table_verif_tecnica").jqGrid('setGridParam', {
         url: 'get_verif_tecnica?fecha_inicio='+fecha_inicio_verif_tec+'&fecha_fin='+fecha_fin_verif_tec
    }).trigger('reloadGrid');

}

function improcedente_verif_tecnica(){
    Id=$('#table_verif_tecnica').jqGrid ('getGridParam', 'selrow');
    
    fecha_inicio_verif_tec = $('#fec_ini_verif_tecnica').val();
    fecha_fin_verif_tec = $('#fec_fin_verif_tecnica').val();

    if(Id)
    {
        $.ajax({
            url: 'improcedente_verif_tecnica',
            type: 'GET',
            data: {
                id_reg_exp :Id,
            },
            success: function (data) {
                jQuery("#table_verif_tecnica").jqGrid('setGridParam', {
                        url: 'get_verif_tecnica?fecha_inicio='+fecha_inicio_verif_tec+'&fecha_fin='+fecha_fin_verif_tec,
                   }).trigger('reloadGrid');
                MensajeExito('Expediente', 'Se Declaro Improcedente.');
            },
            error: function (data) {
                return false;
            }
        });
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_verif_tecnica");
    }
}

function cambiar_estado(value){
    if( $('.check1').is(':checked') ){
       $('.estado1').val("1");
    }else{
       $('.estado1').val("0");
    }
    if($('.check2').is(':checked')){
       $('.estado2').val("1");
    }else{
       $('.estado2').val("0");
    }
    if($('.check3').is(':checked')){
       $('.estado3').val("1");
    }else{
       $('.estado3').val("0");
    }
    if($('.check4').is(':checked')){
       $('.estado4').val("1");
    }else{
       $('.estado4').val("0");
    }
    if($('.check5').is(':checked')){
       $('.estado5').val("1");
    }else{
       $('.estado5').val("0");
    }
    if($('.check6').is(':checked')){
       $('.estado6').val("1");
    }else{
       $('.estado6').val("0");
    }
}


function modificar_verif_tecnica()
{
    id=$('#table_verif_tecnica').jqGrid ('getGridParam', 'selrow');
    if (id) {
        $('#tabla1').hide();
        $('#tabla2').show();
        $('#notificacion_1').val('');
        $('#notificacion_2').val('');
        $('#notificacion_3').val('');
        $('#notificacion_4').val('');
        $('#notificacion_5').val('');
        $('#notificacion_6').val('');
        $("#dlg_verif_tecnica").dialog({
            autoOpen: false, modal: true, width: 1300, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: VERIFICACION ADMINISTRATIVA :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                     actualizar_revision();
                     MensajeExito('La Actualizacion de Verificacion del Expediente','La operacion fue Exitosa');
                     dialog_close('dlg_verif_tecnica');
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_verif_tecnica").dialog('open');


        MensajeDialogLoadAjax('dlg_verif_tecnica', '.:: Cargando ...');

        id = $('#table_verif_tecnica').jqGrid ('getGridParam', 'selrow');
        $.ajax({url: 'licencias_verificacion_tecnica/'+id,
            type: 'GET',
            success: function(r)
            {
                $("#dlg_cod_interno_verif_tecnica").val(r[0].cod_interno);
                $("#dlg_num_expediente_verif_tecnica").val(r[0].nro_exp);
                $("#dlg_gestor_verif_tecnica").val(r[0].gestor);
                $("#dlg_modalidad_administrativa_verif_tecnica").val(r[0].descr_procedimiento);
                $("#dlg_hidden_verif_tecnica_id_reg_exp").val(r[0].id_reg_exp);
                
                jQuery("#table_rec_revision_expediente").jqGrid('setGridParam', {
                    url: 'recuperar_revisiones?indice='+$("#dlg_hidden_verif_tecnica_id_reg_exp").val()+'&encargado='+$('#dlg_encargado').val() 
                }).trigger('reloadGrid');
                
                MensajeDialogLoadAjaxFinish('dlg_verif_tecnica');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_verif_tecnica');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_verif_tecnica");
    }
}


function ver_documentos(id_rev,id_expediente,id_encargado)
{
    window.open('ver_documentos_adjuntos/'+id_rev+'/'+id_expediente+'/'+id_encargado);
}

function ver_notificaciones(id_rev,id_expediente,id_encargado)
{
    window.open('ver_notificaciones_adjuntos/'+id_rev+'/'+id_expediente+'/'+id_encargado);
}

function cambiar_encargado()
{
    jQuery("#table_rec_revision_expediente").jqGrid('setGridParam', {
        url: 'recuperar_revisiones?indice='+$("#dlg_hidden_verif_tecnica_id_reg_exp").val()+'&encargado='+$('#dlg_encargado').val() 
    }).trigger('reloadGrid');
}

function actualizar_revision()
{
    var form= new FormData($("#FormularioEscaneo")[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'actualizar_f',
        type: 'POST',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function (data) {
            
        },
        error: function (data) {
            return false;
        }
    }); 
}

function cambiar_estado_1(value){
    if( $('.check_1').is(':checked') ){
       $('.estado_1').val("1");
    }else{
       $('.estado_1').val("0");
    }
    if($('.check_2').is(':checked')){
       $('.estado_2').val("1");
    }else{
       $('.estado_2').val("0");
    }
    if($('.check_3').is(':checked')){
       $('.estado_3').val("1");
    }else{
       $('.estado_3').val("0");
    }
    if($('.check_4').is(':checked')){
       $('.estado_4').val("1");
    }else{
       $('.estado_4').val("0");
    }
    if($('.check_5').is(':checked')){
       $('.estado_5').val("1");
    }else{
       $('.estado_5').val("0");
    }
    if($('.check_6').is(':checked')){
       $('.estado_6').val("1");
    }else{
       $('.estado_6').val("0");
    }
}



function notificaciones_tecnicas(indice){
    if (indice == 1) {
        llamar_editor(indice);
    }
    if (indice == 2) {
        llamar_editor(indice);
    }
    if (indice == 3) {
        llamar_editor(indice);
    }
    if (indice == 4) {
        llamar_editor(indice);
    }
    if (indice == 5) {
        llamar_editor(indice);
    }
    if (indice == 6) {
        llamar_editor(indice);
    }
}

function llamar_editor(indice){
    
    if (indice == 1) {
        limpiar_notificacion(indice);
        $("#dlg_editor_1").dialog({
            autoOpen: false, modal: true, width: 800,height:620, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: NOTIFICACION TECNICA 1:.</h4></div>",
            buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    extraer_datos(indice);
            }
            },{
                 html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }]        
        }).dialog('open');
    }
    if (indice == 2) {
        limpiar_notificacion(indice);
        $("#dlg_editor_2").dialog({
            autoOpen: false, modal: true, width: 800,height:620, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: NOTIFICACION TECNICA 2:.</h4></div>",
            buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    extraer_datos(indice);
            }
            },{
                 html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }]        
        }).dialog('open');
    }
    if (indice == 3) {
        limpiar_notificacion(indice);
        $("#dlg_editor_3").dialog({
            autoOpen: false, modal: true, width: 800,height:620, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: NOTIFICACION TECNICA 3:.</h4></div>",
            buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    extraer_datos(indice);
            }
            },{
                 html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }]        
        }).dialog('open');
    }
    if (indice == 4) {
        limpiar_notificacion(indice);
        $("#dlg_editor_4").dialog({
            autoOpen: false, modal: true, width: 800,height:620, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: NOTIFICACION TECNICA 4:.</h4></div>",
            buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    extraer_datos(indice);
            }
            },{
                 html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }]        
        }).dialog('open');
    }
    if (indice == 5) {
        limpiar_notificacion(indice);
        $("#dlg_editor_5").dialog({
            autoOpen: false, modal: true, width: 800,height:620, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: NOTIFICACION TECNICA 5:.</h4></div>",
            buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    extraer_datos(indice);
            }
            },{
                 html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }]        
        }).dialog('open');
    }
    if (indice == 6) {
        limpiar_notificacion(indice);
        $("#dlg_editor_6").dialog({
            autoOpen: false, modal: true, width: 800,height:620, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: NOTIFICACION TECNICA 6:.</h4></div>",
            buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    extraer_datos(indice);
            }
            },{
                 html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }]        
        }).dialog('open');
    }
    
}

editor_1=0;
editor_2=0;
editor_3=0;
editor_4=0;
editor_5=0;
editor_6=0;
function limpiar_notificacion(indice)
{
    if (indice == 1) {
        if(editor_1==0)
        {
            editor_1=1;
            CKEDITOR.replace('ckeditor_1', {height: '320px'});
        }
        CKEDITOR.instances['ckeditor_1'].setData('');
    }
    if (indice == 2) {
        if(editor_2==0)
        {
            editor_2=1;
            CKEDITOR.replace('ckeditor_2', {height: '320px'});
        }
        CKEDITOR.instances['ckeditor_2'].setData('');
    }
    if (indice == 3) {
        if(editor_3==0)
        {
            editor_3=1;
            CKEDITOR.replace('ckeditor_3', {height: '320px'});
        }
        CKEDITOR.instances['ckeditor_3'].setData('');
    }
    if (indice == 4) {
        if(editor_4==0)
        {
            editor_4=1;
            CKEDITOR.replace('ckeditor_4', {height: '320px'});
        }
        CKEDITOR.instances['ckeditor_4'].setData('');
    }
    if (indice == 5) {
        if(editor_5==0)
        {
            editor_5=1;
            CKEDITOR.replace('ckeditor_5', {height: '320px'});
        }
        CKEDITOR.instances['ckeditor_5'].setData('');
    }
    if (indice == 6) {
        if(editor_6==0)
        {
            editor_6=1;
            CKEDITOR.replace('ckeditor_6', {height: '320px'});
        }
        CKEDITOR.instances['ckeditor_6'].setData('');
    }
    
}

function extraer_datos(indice){
    if (indice == 1) {
        $('#notificacion_1').val(CKEDITOR.instances['ckeditor_1'].getData());
        MensajeExito('Notificacion de Seguridad fue Creada','La operacion fue Exitosa');
    }
    if (indice == 2) {
        $('#notificacion_2').val(CKEDITOR.instances['ckeditor_2'].getData());
        MensajeExito('Notificacion de Arquitectura fue Creada','La operacion fue Exitosa');
    }
    if (indice == 3) {
        $('#notificacion_3').val(CKEDITOR.instances['ckeditor_3'].getData());
        MensajeExito('Notificacion de Estructuras fue Creada','La operacion fue Exitosa');
    }
    if (indice == 4) {
        $('#notificacion_4').val(CKEDITOR.instances['ckeditor_4'].getData());
        MensajeExito('Notificacion de Sanitarias fue Creada','La operacion fue Exitosa');
    }
    if (indice == 5) {
        $('#notificacion_5').val(CKEDITOR.instances['ckeditor_5'].getData());
        MensajeExito('Notificacion de Electricas fue Creada','La operacion fue Exitosa');
    }
    if (indice == 6) {
        $('#notificacion_6').val(CKEDITOR.instances['ckeditor_6'].getData());
        MensajeExito('Notificacion de Otros fue Creada','La operacion fue Exitosa');
    }
    
}


//RESOLUCION

resolucion_tecnica=0;
function limpiar_resolucion_verificacion_tecnica()
{
    if(resolucion_tecnica==0)
    {
        resolucion_tecnica=1;
        CKEDITOR.replace('ckeditor_resolucion_vtecnica', {height: '220px'});
    }
    CKEDITOR.instances['ckeditor_resolucion_vtecnica'].setData('');
}


function emitir_resolucion(){
    
    Id=$('#table_verif_tecnica').jqGrid ('getGridParam', 'selrow');
    if(Id)
    {
        $("#hidden_dlg_id_expediente").val($('#table_verif_tecnica').jqGrid ('getCell', Id, 'id_reg_exp'));
        
        jQuery("#table_especificaciones").jqGrid('setGridParam', {
                        url: 'getEspecificaciones?id_reg_exp='+$("#hidden_dlg_id_expediente").val()
                   }).trigger('reloadGrid');
        
        limpiar_resolucion_verificacion_tecnica();
        $("#dlg_resolucion_verificacion_tecnica").dialog({
            autoOpen: false, modal: true, width: 800,height:700, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: CREAR RESOLUCION TECNICA :.</h4></div>",
            buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    grabar_resolucion();
            }
            },{
                 html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }]        
        }).dialog('open');
    }else{
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_verif_tecnica");
    }
}

function grabar_resolucion() {
    id_reg_exp = $("#hidden_dlg_id_expediente").val();
    var contenido_resolucion = CKEDITOR.instances['ckeditor_resolucion_vtecnica'].getData();
    
    if (contenido_resolucion == '') {
        mostraralertasconfoco("Debes Completar el Cuerpo de La Resolucion","#ckeditor_resolucion_vtecnica");
        return false;
    }
    
    MensajeDialogLoadAjax('table_verif_tecnica', '.:: Cargando ...');

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'guardar_resolucion_verificacion_tecnica',
        type: 'GET',
        data: {
            id_reg_exp :id_reg_exp,
            contenido:contenido_resolucion
        },
        success: function (data) {
            MensajeDialogLoadAjaxFinish('table_verif_tecnica');
            fn_actualizar_grilla('table_verif_tecnica');
            MensajeExito('Actualizacion de Verificacion del Expediente','Expediente fue enviado a Emitir Resolucion');
            dialog_close('dlg_resolucion_verificacion_tecnica');
            imprimir_resolucion(id_reg_exp);
        },
        error: function (data) {
            mostraralertas("Hubo un Error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('table_verif_tecnica');
        }
    });
}


function agregar_especificaciones()
{
    limpiar_datos_especificaciones();
    $("#dlg_nuevas_especificaciones").dialog({
        autoOpen: false, modal: true, width: 400, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVAS ESPECIFICACIONES :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_especificaciones();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevas_especificaciones").dialog('open');
}

function limpiar_datos_especificaciones(){
    $('#dlg_nro_piso').val('');
    $('#dlg_existente').val('');
    $('#dlg_demolicion').val('');
    $('#dlg_remodelacion').val('');
    $('#dlg_ampliacion').val('');
}


function guardar_especificaciones(){
    
    id_reg_exp = $('#hidden_dlg_id_expediente').val();
    nro_piso = $('#dlg_nro_piso').val();
    existente = $('#dlg_existente').val();
    demolicion = $('#dlg_demolicion').val();
    remodelacion = $('#dlg_remodelacion').val();
    ampliacion = $('#dlg_ampliacion').val();
    
    if (nro_piso == '') {
        mostraralertasconfoco('* El Nombre del Piso es Obligatorio...', '#dlg_nro_piso');
        return false;
    }
    if (existente == '') {
        mostraralertasconfoco('* El Campo Existente no debe ir vacio...', '#dlg_existente');
        return false;
    }
    if (demolicion == '') {
        mostraralertasconfoco('* El Campo Existente no debe ir vacio...', '#dlg_demolicion');
        return false;
    }
    if (remodelacion == '') {
        mostraralertasconfoco('* El Campo Existente no debe ir vacio...', '#dlg_remodelacion');
        return false;
    }
    if (ampliacion == '') {
        mostraralertasconfoco('* El Campo Existente no debe ir vacio...', '#dlg_ampliacion');
        return false;
    }
 
    $.ajax({
        url: 'agregar_especificaciones_vt',
        type: 'GET',
        data: {
            id_reg_exp:id_reg_exp,
            nro_piso :nro_piso,
            existente:existente,
            demolicion:demolicion,
            remodelacion:remodelacion,
            ampliacion:ampliacion
        },
        success: function (data) {
            MensajeExito('La Especificacion fue Agregada Correctamente al Expediente', 'Operacion Ejecutada Correctamente.');
             jQuery("#table_especificaciones").jqGrid('setGridParam', {
                        url: 'getEspecificaciones?id_reg_exp='+$("#hidden_dlg_id_expediente").val()
                   }).trigger('reloadGrid');
            limpiar_datos_especificaciones();
        },
        error: function (data) {
            return false;
        }
    });
}

function editar_especificaciones()
{
    id_especificaciones=$('#table_especificaciones').jqGrid ('getGridParam', 'selrow');
    if (id_especificaciones) {
        
        id_especificacion = $('#table_especificaciones').jqGrid ('getCell', id_especificaciones, 'id_especificacion');
        $('#dlg_nro_piso').val($('#table_especificaciones').jqGrid ('getCell', id_especificaciones, 'nro_piso'));
        $('#dlg_existente').val($('#table_especificaciones').jqGrid ('getCell', id_especificaciones, 'existente'));
        $('#dlg_demolicion').val($('#table_especificaciones').jqGrid ('getCell', id_especificaciones, 'demolicion'));
        $('#dlg_remodelacion').val($('#table_especificaciones').jqGrid ('getCell', id_especificaciones, 'remodelacion'));
        $('#dlg_ampliacion').val($('#table_especificaciones').jqGrid ('getCell', id_especificaciones, 'ampliacion'));
        
        $("#dlg_nuevas_especificaciones").dialog({
            autoOpen: false, modal: true, width: 400, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR ESPECIFICACIONES :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                     actualizar_especificaciones(id_especificacion);    
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevas_especificaciones").dialog('open');
    }else{
        mostraralertasconfoco("No Hay Especificaciones Seleccionadas","#table_especificaciones");
    }
}

function actualizar_especificaciones(id_especificacion){
    
    nro_piso = $('#dlg_nro_piso').val();
    existente = $('#dlg_existente').val();
    demolicion = $('#dlg_demolicion').val();
    remodelacion = $('#dlg_remodelacion').val();
    ampliacion = $('#dlg_ampliacion').val();
    
    if (nro_piso == '') {
        mostraralertasconfoco('* El Nombre del Piso es Obligatorio...', '#dlg_nro_piso');
        return false;
    }
    if (existente == '') {
        mostraralertasconfoco('* El Campo Existente no debe ir vacio...', '#dlg_existente');
        return false;
    }
    if (demolicion == '') {
        mostraralertasconfoco('* El Campo Existente no debe ir vacio...', '#dlg_demolicion');
        return false;
    }
    if (remodelacion == '') {
        mostraralertasconfoco('* El Campo Existente no debe ir vacio...', '#dlg_remodelacion');
        return false;
    }
    if (ampliacion == '') {
        mostraralertasconfoco('* El Campo Existente no debe ir vacio...', '#dlg_ampliacion');
        return false;
    }
 
    $.ajax({
        url: 'actualizar_especificaciones_vt',
        type: 'GET',
        data: {
            id_especificacion:id_especificacion,
            nro_piso :nro_piso,
            existente:existente,
            demolicion:demolicion,
            remodelacion:remodelacion,
            ampliacion:ampliacion
        },
        success: function (data) {
            MensajeExito('La Especificacion fue Actualizada Correctamente', 'Operacion Ejecutada Correctamente.');
             jQuery("#table_especificaciones").jqGrid('setGridParam', {
                        url: 'getEspecificaciones?id_reg_exp='+$("#hidden_dlg_id_expediente").val()
                   }).trigger('reloadGrid');
            dialog_close('dlg_nuevas_especificaciones');
        },
        error: function (data) {
            return false;
        }
    });
}

function eliminar_especificaciones(){
    id_especificaciones = $('#table_especificaciones').jqGrid ('getGridParam', 'selrow');
    if (id_especificaciones) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'licencias_verificacion_tecnica/destroy',
            type: 'POST',
            data: {
                _method: 'delete',id_especificaciones:id_especificaciones,
            },
            success: function (data) {
                MensajeExito('La Especificacion fue Eliminada', 'Operacion Ejecutada Correctamente.');
                 jQuery("#table_especificaciones").jqGrid('setGridParam', {
                            url: 'getEspecificaciones?id_reg_exp='+$("#hidden_dlg_id_expediente").val()
                       }).trigger('reloadGrid');
            },
            error: function (data) {
                return false;
            }
        });
    }else{
        mostraralertasconfoco("No Hay Especificaciones Seleccionadas","#table_especificaciones");
    }
}

function imprimir_resolucion(id_reg_exp)
{
    window.open('imprimir_resolucion_vt/'+id_reg_exp);
}
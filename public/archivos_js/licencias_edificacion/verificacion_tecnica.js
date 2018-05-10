function limpiar_datos_grilla(){
    jQuery("#table_revision_expediente").jqGrid('setGridParam', {url: 'get_revision_expediente' }).trigger('reloadGrid');
    $('#tabla2').hide();
    $('#tabla1').show();
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
                    MensajeExito('La Actualizacion de Verificacion del Expediente','La operacion fue Exitosa');
                    dialog_close('dlg_verif_tecnica');
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
        $.ajax({url: 'verificacion_tecnica/'+id,
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

function emitir_resolucion() {
    id=$('#table_verif_tecnica').jqGrid ('getGridParam', 'selrow');
    id_reg_exp = $('#table_verif_tecnica').jqGrid ('getCell', id, 'id_reg_exp');
    if (id) {
        MensajeDialogLoadAjax('table_verif_tecnica', '.:: Cargando ...');

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'cambiar_estado_verif_tecnica',
            type: 'GET',
            data: {
                id_reg_exp :id_reg_exp
            },
            success: function (data) {
                MensajeDialogLoadAjaxFinish('table_verif_tecnica');
                fn_actualizar_grilla('table_verif_tecnica');
                MensajeExito('Actualizacion de Verificacion del Expediente','Expediente fue enviado a Emitir Resolucion');
            },
            error: function (data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('table_verif_tecnica');
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
        $.ajax({url: 'verificacion_tecnica/'+id,
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
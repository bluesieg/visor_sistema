
function limpiar_campos()
{
    $('#dlg_dni_encargado').val('');
    $('#hidden_dlg_encargado').val('0');
    $('#dlg_encargado').val('');
    $('#dlg_solicitud').val('');
    $('#dlg_nomb_asoc').val('');
    $('#dlg_descripcion').val('');
    $('#dlg_monto').val('');
    $("#chkbox_convenio").prop('checked', false);
    $('#dlg_inversion').val('');
    $('#dlg_fecha_ejecucion').val('');
    $('#dlg_tiempo_ejecucion').val('');
    $('#dlg_dispon_presupuestal').val('');
}

function nuevo_apoyo()
{
    limpiar_campos();
    $("#dlg_nuevo_apoyo").dialog({
        autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO APOYO  :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_editar_datos(1);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_apoyo").dialog('open');
}

function fn_buscar_solicitud(){
    solicitud = $("#dlg_buscar_solicitud").val();
    fn_actualizar_grilla('table_apoyo','sub_geren_apoyo_matenimiento/0?grid=apoyo&solicitud='+solicitud);
}

function guardar_editar_datos(tipo) {
    id_encargado = $('#hidden_dlg_encargado').val();
    solicitud = $('#dlg_solicitud').val();
    nombre_asoc = $('#dlg_nomb_asoc').val();
    descripcion = $('#dlg_descripcion').val();
    monto = $('#dlg_monto').val();
    inversion = $('#dlg_inversion').val();
    fecha_ejecucion = $('#dlg_fecha_ejecucion').val();
    tiempo_ejecucion = $('#dlg_tiempo_ejecucion').val();
    dispon_presupuestal = $('#dlg_dispon_presupuestal').val();

    if(id_encargado == "0")
    {
        mostraralertasconfoco("* El Campo ENCARGADO es Obligatorio","#dlg_dni_encargado");
        return false;
    }
    if(solicitud == "")
    {
        mostraralertasconfoco("* El Campo SOLICITUD es Obligatorio","#dlg_solicitud");
        return false;
    }
    if(nombre_asoc == "")
    {
        mostraralertasconfoco("* El Campo NOMBRE ASOCIACION es Obligatorio","#dlg_nomb_asoc");
        return false;
    }
    if(descripcion == "")
    {
        mostraralertasconfoco("* El Campo DESCRIPCION es Obligatorio","#dlg_descripcion");
        return false;
    }
    if(monto == "")
    {
        mostraralertasconfoco("* El Campo MONTO es Obligatorio","#dlg_monto");
        return false;
    }
    if(inversion == "")
    {
        mostraralertasconfoco("* El Campo INVERSION es Obligatorio","#dlg_inversion");
        return false;
    }
    if(fecha_ejecucion == "")
    {
        mostraralertasconfoco("* El Campo FECHA EJECUCION es Obligatorio","#dlg_fecha_ejecucion");
        return false;
    }
    if(tiempo_ejecucion == "")
    {
        mostraralertasconfoco("* El Campo TIEMPO DE EJECUCION es Obligatorio","#dlg_tiempo_ejecucion");
        return false;
    }
    if(dispon_presupuestal == "")
    {
        mostraralertasconfoco("* El Campo DISPONIBILIDAD PRESUPUESTAL es Obligatorio","#dlg_dispon_presupuestal");
        return false;
    }
    
    if($("#chkbox_convenio").is(':checked')){
       var convenio = 1;
    }else{
        convenio = 0;
    }
    
    if (tipo == 1) {

        MensajeDialogLoadAjax('dlg_nuevo_apoyo', '.:: Cargando ...');
      
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_apoyo_matenimiento/create',
            type: 'GET',
            data: {
        	id_encargado :id_encargado,
                solicitud :solicitud,
                nombre_asoc :nombre_asoc,
                descripcion :descripcion,
                monto :monto,
                convenio: convenio,
                inversion :inversion,
                fecha_ejecucion :fecha_ejecucion,
                tiempo_ejecucion :tiempo_ejecucion,
                dispon_presupuestal :dispon_presupuestal,
                tipo:1         
            },
            success: function(data) 
            {
                MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_apoyo');
                fn_actualizar_grilla('table_apoyo');
                $("#dlg_nuevo_apoyo").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_apoyo');
                console.log('error');
                console.log(data);
            }
        });
    }
    else if (tipo == 2) {

        id_apoyo = $('#table_apoyo').jqGrid ('getGridParam', 'selrow');

        MensajeDialogLoadAjax('dlg_nuevo_apoyo', '.:: Cargando ...');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'sub_geren_apoyo_matenimiento/'+id_apoyo+'/edit',
            type: 'GET',
            data: {
        	id_encargado :id_encargado,
                solicitud :solicitud,
                nombre_asoc :nombre_asoc,
                descripcion :descripcion,
                monto :monto,
                convenio: convenio,
                inversion :inversion,
                fecha_ejecucion :fecha_ejecucion,
                tiempo_ejecucion :tiempo_ejecucion,
                dispon_presupuestal :dispon_presupuestal,
                tipo:1
            },
            success: function(data) 
            {
                MensajeExito('Se Modifico Correctamente', 'Su Registro Fue Modificado Correctamente...');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_apoyo');
                fn_actualizar_grilla('table_apoyo');
                $("#dlg_nuevo_apoyo").dialog("close");
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('table_apoyo');
                console.log('error');
                console.log(data);
            }
        });
    }
 
}

function modificar_apoyo()
{
    id_apoyo = $('#table_apoyo').jqGrid ('getGridParam', 'selrow');
    
    if (id_apoyo) {
        
        $("#dlg_nuevo_apoyo").dialog({
            autoOpen: false, modal: true, width: 1250, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.: INFORMACION DE APOYO :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    guardar_editar_datos(2);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_apoyo").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_apoyo', '.:: Cargando ...');

        $.ajax({url: 'sub_geren_apoyo_matenimiento/'+id_apoyo+'?show=apoyo',
            type: 'GET',
            success: function(data)
            {
                $("#dlg_dni_encargado").val(data[0].nro_doc_persona);
                $("#hidden_dlg_encargado").val(data[0].id_encargado);
                $("#dlg_encargado").val(data[0].persona);
                $("#dlg_solicitud").val(data[0].solicitud);
                $("#dlg_nomb_asoc").val(data[0].nombre_asoc);
                $("#dlg_descripcion").val(data[0].descripcion);
                $("#dlg_monto").val(data[0].monto);
                if (data[0].convenio == '1') {
                    $("#chkbox_convenio").prop('checked', true);
                }else{
                    $("#chkbox_convenio").prop('checked', false);
                }
                $("#dlg_inversion").val(data[0].inversion);
                $("#dlg_fecha_ejecucion").val(data[0].fecha_ejecucion);
                $("#dlg_dispon_presupuestal").val(data[0].disponibilidad);
               
                MensajeDialogLoadAjaxFinish('dlg_nuevo_apoyo');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_apoyo');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_apoyo");
    }
}


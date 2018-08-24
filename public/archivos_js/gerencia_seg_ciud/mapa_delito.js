function modificar_mapa_delito()
{
    id_mapa_delito = $('#table_mapa_delito').jqGrid ('getGridParam', 'selrow');
    
    if (id_mapa_delito) {
        
        $("#dlg_nuevo_mapa_delito").dialog({
            autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  EDITAR INFORMACION DE MAPA DEL DELITO :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                    guardar_datos();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_mapa_delito").dialog('open');


        MensajeDialogLoadAjax('dlg_nuevo_mapa_delito', '.:: Cargando ...');

        $.ajax({url: 'comisarias/'+id_mapa_delito+'?show=mapa_delito',
            type: 'GET',
            success: function(data)
            {          
                $("#dlg_ubicacion").val(data[0].ubicacion);
                $("#sel_tipo_delito").val(data[0].id_tipo_delito);
                $("#dlg_observacion").val(data[0].observacion);
                $("#dlg_vehiculo").val(data[0].vehiculo);
                $("#dlg_dni_infractor").val(data[0].nro_doc_infractor);
                $("#hidden_dlg_infractor").val(data[0].id_pers_infractor);
                $("#dlg_infractor").val(data[0].infractor);
                $("#dlg_dni_encargado").val(data[0].nro_doc_encargado);
                $("#hidden_dlg_encargado").val(data[0].id_pers_encargado);
                $("#dlg_encargado").val(data[0].encargado);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_mapa_delito');
            },
            error: function(data) {
                mostraralertas("Hubo un Error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
                MensajeDialogLoadAjaxFinish('dlg_nuevo_mapa_delito');
            }
        });
    }else{
        mostraralertasconfoco("No Hay Registros Seleccionados","#table_mapa_delito");
    }
}

function guardar_datos() {
    
    ubicacion = $("#dlg_ubicacion").val();
    tipo_delito = $("#sel_tipo_delito").val();
    vehiculo = $("#dlg_vehiculo").val();
    observacion = $("#dlg_observacion").val();
    infractor = $("#hidden_dlg_infractor").val();
    encargado = $("#hidden_dlg_encargado").val();
    
    if(ubicacion == "")
    {
        mostraralertasconfoco("* El Campo Ubicacion es Obligatorio","#dlg_ubicacion");
        return false;
    }
    if(tipo_delito == '0')
    {
        mostraralertasconfoco("* Debes Seleccionar un Delito","#sel_tipo_delito");
        return false;
    }
    if(vehiculo == "")
    {
        mostraralertasconfoco("* El Campo Vehiculo es Obligatorio","#dlg_vehiculo");
        return false;
    }
    if(observacion == "")
    {
        mostraralertasconfoco("* El Campo Observacion es Obligatorio","#dlg_observacion");
        return false;
    }
    if(infractor == '0')
    {
        mostraralertasconfoco("* El Campo Infractor es Obligatorio","#dlg_dni_infractor");
        return false;
    }
    if(encargado == '0')
    {
        mostraralertasconfoco("* El Campo Encargado es Obligatorio","#dlg_dni_encargado");
        return false;
    }

    id_mapa_delito = $('#table_mapa_delito').jqGrid ('getGridParam', 'selrow');
    
    MensajeDialogLoadAjax('dlg_nuevo_mapa_delito', '.:: Cargando ...');
    
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'comisarias/'+id_mapa_delito+'/edit',
        type: 'GET',
        data: {
            ubicacion:ubicacion,
            tipo_delito:tipo_delito,
            vehiculo:vehiculo,
            observacion:observacion,
            infractor:infractor,
            encargado:encargado
        },
        success: function(data) 
        { 
            MensajeExito('OPERACION EXITOSA', 'El registro fue guardado Correctamente');
            MensajeDialogLoadAjaxFinish('dlg_nuevo_mapa_delito');
            fn_actualizar_grilla('table_mapa_delito');
            $("#dlg_nuevo_mapa_delito").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('table_mapa_delito');
            console.log('error');
            console.log(data);
        }
    });
}

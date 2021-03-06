function limpiar_datos(){
   $("#inp_dni_entregar").val("");
   $("#inp_nombre_entregar").val("");
}


function entregar_a()
{
    limpiar_datos();
    Id=$('#table_entr_const_pos').jqGrid ('getGridParam', 'selrow');
    if(Id)
    {
        
        $("#dlg_entregar_a_usuario").dialog({
            autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  Entregar a:.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                      guardar_datos_usuario();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });

         $("#dlg_entregar_a_usuario").dialog('open');
     }
     else
    {
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_entr_const_pos");
    }
}
function guardar_datos_usuario(){
    
    id_reg_exp=$('#table_entr_const_pos').jqGrid ('getGridParam', 'selrow');
    nro_dni = $("#inp_dni_entregar").val();
    apenom = $("#inp_nombre_entregar").val();


    MensajeDialogLoadAjax('dlg_entregar_a_usuario', '.:: Cargando ...');
    
    $.ajax({url: 'insertar_datos',
            type: 'GET',
            data:{id_reg_exp:id_reg_exp,nro_dni:nro_dni,apenom:apenom},
            success: function(data) 
            {
                fn_actualizar_grilla('table_entr_const_pos');
                MensajeExito('Expediente', 'Se Registraron los datos.');
                dialog_close('dlg_entregar_a_usuario');
                cambiar_estado(Id);
                MensajeDialogLoadAjaxFinish('dlg_entregar_a_usuario');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
        });
        
}

function cambiar_estado(Id)
{
    
    if(Id)
    {
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'registro_expedientes/'+Id+'/edit',
                    type: 'GET',
                    data:{estado:11},
                    success: function(data) 
                    {
                        MensajeExito('Expediente', 'ENTREGADO.');
                        fn_actualizar_grilla('table_entr_const_pos');
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
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_entr_const_pos");
    }
}


function selecciona_entregar_constancia(){

    fecha_inicio_entr_const = $('#fec_ini_entr_const_pos').val();
    fecha_fin_entr_const = $('#fec_fin_entr_const_pos').val();

    jQuery("#table_entr_const_pos").jqGrid('setGridParam', {
         url: 'datos_predio?grid=5&fecha_inicio='+fecha_inicio_entr_const+'&fecha_fin='+fecha_fin_entr_const,
    }).trigger('reloadGrid');

}


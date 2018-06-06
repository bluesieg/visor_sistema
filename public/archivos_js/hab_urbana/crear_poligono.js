 function limpiar_datos(){
    $('#inp_cod_exp').val("");
}
function selecciona_fecha3(){

    fecha_desde = $("#dlg_fec_desde3").val(); 
    fecha_hasta = $("#dlg_fec_hasta3").val(); 

    jQuery("#table_crear_poligono").jqGrid('setGridParam', {
         url: 'getCrearPoligono?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta
    }).trigger('reloadGrid');

}

/////////////crear poligono
auxpoli=0;
function aprobar_poligono()
{

    $("#dlg_aprobar_poligono").dialog({
        autoOpen: false, modal: true, width: 650, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  APROBAR POLIGONO :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {

                guardar_hab_urb_poligono();
                MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    }).dialog('open');
    
    MensajeDialogLoadAjax('dlg_aprobar_poligono', '.:: Cargando ...');

    id = $('#table_crear_poligono').jqGrid ('getGridParam', 'selrow');
    $.ajax({url: 'crear_poligono/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#inp_cod_exp_poli").val(r[0].nro_exp);
            MensajeDialogLoadAjaxFinish('dlg_aprobar_poligono');

        },
        error: function(data) {
            mostraralertas("Hubo un Error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_aprobar_poligono');
        }
    });
   
        if(auxpoli==0)
    {
        autocompletar_haburb('inp_hab_urb_poligono');
        auxpoli=1;
    }
   
    
    //$('#inp_cod_exp_poli').val();
    
}
function guardar_hab_urb_poligono()
{
    id_hab_urb= $('#hidden_inp_hab_urb_poligono').val();
    id = $('#table_crear_poligono').jqGrid ('getGridParam', 'selrow');
    if (id_hab_urb == '') {
        mostraralertasconfoco('* El campo Numero de Expediente es obligatorio...', '#nro_expediente');
        return false;
    }
    
    MensajeDialogLoadAjax('dlg_aprobar_poligono', '.:: CARGANDO ...');
    $.confirm({
        title: '.:Cuidado... !',
        content: 'Esta a punto de enviar a revision tecnica...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'crear_poligono/'+id+'/edit',
                    type: 'GET',
                    data: {
                        id_reg_exp:id,
                        id_hab_urb: id_hab_urb,
                    },
                    success: function (data) {
                        if (data.msg === 'repetido'){
                            mostraralertasconfoco("Mensaje del Sistema, LA HABILITACION YA FUE REGISTRADO");
                            MensajeDialogLoadAjaxFinish('dlg_aprobar_poligono');
                        }else{
                             MensajeExito('Se inserto la habilitacion para el Registro Expediente', 'EXPEDIENTE: '+ id + '  -  Ha sido Modificado.');
                           enviar_a_verif_tecnica();
                            dialog_close('dlg_aprobar_poligono');
                            MensajeDialogLoadAjaxFinish('dlg_aprobar_poligono', '.:: CARGANDO ...');
                        }
                    },
                    error: function (data) {
                        mostraralertas('* Contactese con el Administrador...');
                        MensajeAlerta('Editar Registro Expediente','Ocurrio un Error en la Operacion.');
                        dialog_close('dlg_aprobar_poligono');
                        MensajeDialogLoadAjaxFinish('dlg_aprobar_poligono', '.:: CARGANDO ...');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Editar Registro Expediente','Operacion Cancelada.');
                MensajeDialogLoadAjaxFinish('dlg_aprobar_poligono', '.:: CARGANDO ...');

            }
        }
    });
}

function enviar_a_verif_tecnica()
{
    Id=$('#table_crear_poligono').jqGrid ('getGridParam', 'selrow');
    if(Id)
    {
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'hab_urbana/'+Id+'/edit',
                    type: 'GET',
                    data:{estado:4},
                    success: function(data) 
                    {
                        MensajeExito('Expediente', 'Expediente Enviado a Verificación Tecnica');
                        fn_actualizar_grilla('table_crear_poligono');
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
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_crear_poligono");
    }
}



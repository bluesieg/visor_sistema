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

/////////////enviar a crear poligono

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



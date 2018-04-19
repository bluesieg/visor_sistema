function aprobar_para_visto_y_firma()
{
    Id=$('#table_expediente_visto_firma').jqGrid ('getGridParam', 'selrow');
    if(Id)
    {
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'registro_expedientes/'+Id+'/edit',
                    type: 'GET',
                    data:{estado:10},
                    success: function(data) 
                    {
                        MensajeExito('Expediente', 'Expediente Enviado a Visto y firma.');
                        fn_actualizar_grilla('table_expediente_visto_firma');
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
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_expediente_visto_firma");
    }
}


function selecciona_visto_firma(){

    fecha_inicio = $('#fec_ini_exp_visto_firma').val();
    fecha_fin = $('#fec_fin_exp_visto_firma').val();

    jQuery("#table_expediente_visto_firma").jqGrid('setGridParam', {
         url: 'datos_predio?grid=4&fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin
    }).trigger('reloadGrid');

}


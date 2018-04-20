function aprobar_para_firmas()
{
    Id=$('#table_expediente_visto_legal').jqGrid ('getGridParam', 'selrow');
    if(Id)
    {
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'registro_expedientes/'+Id+'/edit',
                    type: 'GET',
                    data:{estado:8},
                    success: function(data) 
                    {
                        MensajeExito('Expediente', 'Expediente Enviado a Visto y firma.');
                        fn_actualizar_grilla('table_expediente_visto_legal');
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
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_expediente_visto_legal");
    }
}

function selecciona_visto_legal(){

    fecha_inicio_visto_firma = $('#fec_ini_exp_visto_firma').val();
    fecha_fin_visto_firma = $('#fec_fin_exp_visto_firma').val();

    jQuery("#table_expediente_visto_legal").jqGrid('setGridParam', {
         url: 'datos_predio?grid=3&fecha_inicio='+fecha_inicio_visto_firma+'&fecha_fin='+fecha_fin_visto_firma
    }).trigger('reloadGrid');

}

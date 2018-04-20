
function selecciona_fecha_eva_t(){

    fecha_ini_eva_tecnica = $("#fec_ini_eva_tecnica").val();
    fecha_fin_eva_tecnica = $("#fec_fin_eva_tecnica").val();

    jQuery("#table_evaluacion_tecnica").jqGrid('setGridParam', {
         url: 'get_evaluacion_tecnica?fecha_ini_eva_tecnica='+fecha_ini_eva_tecnica+'&fecha_fin_eva_tecnica='+fecha_fin_eva_tecnica
    }).trigger('reloadGrid');

}

function aprobar_expediente()
{
    Id=$('#table_evaluacion_tecnica').jqGrid ('getGridParam', 'selrow');
    estado = $('#table_evaluacion_tecnica').jqGrid ('getCell', Id, 'fase');
    if(Id)
    {
       if(estado == 6){
           mostraralertasconfoco("El Expediente ya fue Aprobado");
       }else if(estado == 13){
           mostraralertasconfoco("El Expediente es Improcedente y debe ser Aprobado");  
       }else{
           $("#dlg_aprobar_expediente").dialog({
            autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  APROBAR EXPEDIENTE :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {
                        fn_aprobar_expediente();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });

         $("#dlg_aprobar_expediente").dialog('open');
       } 
        
     }
     else
    {
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_evaluacion_tecnica");
    }
}

function fn_aprobar_expediente(){
    
    id_reg_exp = $('#table_evaluacion_tecnica').jqGrid ('getGridParam', 'selrow');
    inp_aprob_expe = $("#inp_aprob_exp").val();

    MensajeDialogLoadAjax('dlg_aprobar_expediente', '.:: Cargando ...');
    
    $.ajax({url: 'actualizar_informe',
            type: 'GET',
            data:{id_reg_exp:id_reg_exp,inp_aprob_expe:inp_aprob_expe},
            success: function(data) 
            {
                fn_actualizar_grilla('table_evaluacion_tecnica');
                MensajeExito('Expediente', 'Se Registro el Informe.');
                dialog_close('dlg_aprobar_expediente');
                MensajeDialogLoadAjaxFinish('dlg_aprobar_expediente');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
        });
}


function emitir_ofic_impro(){
    Id=$('#table_evaluacion_tecnica').jqGrid ('getGridParam', 'selrow');
    estado = $('#table_evaluacion_tecnica').jqGrid ('getCell', Id, 'fase');
    if(Id)
    {
        if(estado == 13){
           mostraralertasconfoco("El Expediente ya fue declarado como Improcedente"); 
            }else{
             $("#dlg_notificaciones_eva_tec").dialog({
                 autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
                 title: "<div class='widget-header'><h4>.: INFORME DE EVALUACION TECNICA :.</h4></div>",
                 buttons: [{
                     html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                     "class": "btn btn-success bg-color-green",
                     click: function () {
                             fn_emitir_ofic_impro();
                     }
                 }, {
                     html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                     "class": "btn btn-danger",
                     click: function () {
                         $(this).dialog("close");
                     }
                 }],
             });

              $("#dlg_notificaciones_eva_tec").dialog('open');
          }
      }
     else
    {
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_evaluacion_tecnica");
    }
}


function fn_emitir_ofic_impro(){
    
    id_reg_exp = $('#table_evaluacion_tecnica').jqGrid ('getGridParam', 'selrow');
    cod_expediente = $('#table_evaluacion_tecnica').jqGrid ('getCell', id_reg_exp, 'nro_expediente');
    notificacion = $("#inp_notificacion_eva_tec").val();
    
    MensajeDialogLoadAjax('dlg_notificaciones_eva_tec', '.:: Cargando ...');
    $.ajax({url: 'registrar_notificacion_eva_tec',
            type: 'GET',
            data:{cod_expediente:cod_expediente,notificacion:notificacion},
            success: function(data) 
            {
                MensajeExito('Expediente', 'Se Registro la Notificacion.');
                dialog_close('dlg_notificaciones_eva_tec');
                fn_actualizar_grilla('table_evaluacion_tecnica');
                MensajeDialogLoadAjaxFinish('dlg_notificaciones_eva_tec');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
        });
}


function check_ver_improcedentes(val){
    fecha_ini_eva_tecnica = $("#fec_ini_eva_tecnica").val();
    fecha_fin_eva_tecnica = $("#fec_fin_eva_tecnica").val();
    if($(val).is(':checked')){
        jQuery("#table_evaluacion_tecnica").jqGrid('setGridParam', {url: 'get_evaluacion_tecnica?check='+1+'&fecha_ini_eva_tecnica='+fecha_ini_eva_tecnica+'&fecha_fin_eva_tecnica='+fecha_fin_eva_tecnica }).trigger('reloadGrid');
    } else {
        jQuery("#table_evaluacion_tecnica").jqGrid('setGridParam', {url: 'get_evaluacion_tecnica?check='+2+'&fecha_ini_eva_tecnica='+fecha_ini_eva_tecnica+'&fecha_fin_eva_tecnica='+fecha_fin_eva_tecnica }).trigger('reloadGrid');
    }
}

function actualizar_evaluacion_tecnica(Id){
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'registro_expedientes/'+Id+'/edit',
            type: 'GET',
            data:{estado:5},
            success: function(data) 
            {
                MensajeExito('Expediente', 'Expediente Recuperado.');
                fn_actualizar_grilla('table_evaluacion_tecnica');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
        });
}

function imprimir_evaluacion_tecnica(){
    Id=$('#table_evaluacion_tecnica').jqGrid ('getGridParam', 'selrow');
    estado = $('#table_evaluacion_tecnica').jqGrid ('getCell', Id, 'fase');
    if(Id)
    {
        if($('#dlg_ver_improcedentes').is(':checked') || estado == 5){

        }else{
             Id=$('#table_evaluacion_tecnica').jqGrid ('getGridParam', 'selrow');
             window.open('rep_constancia/'+Id);
        }
    }
     else
    {
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_evaluacion_tecnica");
    }
}


function enviar_legar(){
    Id=$('#table_evaluacion_tecnica').jqGrid ('getGridParam', 'selrow');
    estado = $('#table_evaluacion_tecnica').jqGrid ('getCell', Id, 'fase');
    if(Id)
    {
        if(estado == 5 || estado == 13){
            mostraralertasconfoco("El Expediente debe ser aprobado");
        }else{
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'registro_expedientes/'+Id+'/edit',
                    type: 'GET',
                    data:{estado:7},
                    success: function(data) 
                    {
                        MensajeExito('Expediente', 'Expediente Enviado a Legal.');
                        fn_actualizar_grilla('table_evaluacion_tecnica');
                    },
                    error: function(data) {
                        mostraralertas("hubo un error, Comunicar al Administrador");
                        console.log('error');
                        console.log(data);
                    }
            });
        }
    }
     else
    {
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_evaluacion_tecnica");
    }
}

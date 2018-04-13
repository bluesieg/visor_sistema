 function autocompletar_haburb(textbox){
    $.ajax({
        type: 'GET',
        url: 'autocomplete_hab_urba',
        success: function (data) {
            
            var $datos = data;
            $("#"+ textbox).autocomplete({
                source: $datos,
                focus: function (event, ui) {
                    $("#" + textbox).val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $("#" + textbox).val(ui.item.label);
                    $("#hidden_"+ textbox).val(ui.item.value);
                    return false;
                }
            });
        }
    });
}
function crear_nuevo_exp()
{
    $("#dlg_nuevo_exp").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO EXPEDIENTE :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    obtener_exp();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_exp").dialog('open');
}

function obtener_exp()
{
    MensajeDialogLoadAjax('dlg_nuevo_exp', '.:: Cargando ...');
        $.ajax({url: 'registro_expedientes/create',
        type: 'GET',
        data:{cod:$("#inp_cod_exp").val()},
        success: function(r) 
        {
            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
            jQuery("#table_instal").jqGrid('setGridParam', {url: 'gridinsta/'+Id}).trigger('reloadGrid');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
        }
        }); 
}
aux=0;
function crear_reg_datos_lote()
{
    $("#dlg_nuevo_reg_datos_lote").dialog({
        autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Registrar Datos del Lote :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {

                guardar_editar_datos_lote();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    if(aux==0)
    {
        alert(1);
        autocompletar_haburb('inp_zona_exp_lote');
        aux=1;
    }
    $("#dlg_nuevo_reg_datos_lote").dialog('open');
}
function traer_cod_expediente()
{
    MensajeDialogLoadAjax('dlg_nuevo_reg_datos_lote', '.:: Cargando ...');
        $.ajax({url: 'registro_expedientes/0',
        type: 'GET',
        data:{cod:$("#inp_cod_exp_lote").val()},
        success: function(r) 
        {
            if(r==0)
            {
                 mostraralertas("El Código de Expedienteno existe");
                 $('#hidden_inp_cod_exp_lote').val(0);
            }
            else
            {$('#hidden_inp_cod_exp_lote').val(r);}
            MensajeDialogLoadAjaxFinish('dlg_nuevo_reg_datos_lote');
            //jQuery("#table_instal").jqGrid('setGridParam', {url: 'gridinsta/'+Id}).trigger('reloadGrid');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
        }
        }); 
}
function guardar_editar_datos_lote()
{
    
}
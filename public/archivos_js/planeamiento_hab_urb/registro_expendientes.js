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
                 $('#inp_posesionario_exp_lote').val("");
            }
            else
            {
                $('#hidden_inp_cod_exp_lote').val(r.id_reg_exp);
                $('#inp_posesionario_exp_lote').val(r.gestor);
            }
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
    if($("#hidden_inp_cod_exp_lote").val()==0||$("#inp_cod_exp_lote").val()=="")
    {
        mostraralertasconfoco("Seleccione Codigo de Expediente","#inp_cod_exp_lote");
        return false;
    }
    if($("#hidden_inp_zona_exp_lote").val()==0||$("#inp_zona_exp_lote").val()=="")
    {
        mostraralertasconfoco("Seleccione Zona","#inp_zona_exp_lote");
        return false;
    }
    MensajeDialogLoadAjax('dlg_nuevo_reg_datos_lote', '.:: Cargando ...');
        $.ajax({url: 'datos_predio/create',
        type: 'GET',
        data:{  cod:$("#hidden_inp_cod_exp_lote").val(),
                sector:$("#inp_sector_exp_lote").val(),
                zona:$("#hidden_inp_zona_exp_lote").val(),
                sup_mzna:$("#inp_super_mzna_exp_lote").val(),
                mzna:$("#inp_mzna_exp_lote").val(),
                lote:$("#inp_lote_exp_lote").val(),
                sub_lote:$("#inp_sub_lote_exp_lote").val(),
                anio:$("#inp_anio_ini_exp_lote").val(),
                area:$("#inp_area_exp_lote").val(),
                frente:$("#inp_frente_exp_lote").val(),
                frente_con:$("#inp_con_frente_exp_lote").val(),
                derecho:$("#inp_derecho_exp_lote").val(),
                derecho_con:$("#inp_con_derecho_exp_lote").val(),
                izquierda:$("#inp_izquierdo_exp_lote").val(),
                izquierda_con:$("#inp_con_izquierdo_exp_lote").val(),
                fondo:$("#inp_fondo_exp_lote").val(),
                fondo_con:$("#inp_con_fondo_exp_lote").val(),
                tip_sol:$("#select_tip_sol_exp_lote").val()
        },
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_reg_datos_lote');
            $("#dlg_nuevo_reg_datos_lote").dialog('close');
            jQuery("#table_datos_predio").jqGrid('setGridParam', {url: 'datos_predio?grid=1'}).trigger('reloadGrid');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
        }
        }); 
}
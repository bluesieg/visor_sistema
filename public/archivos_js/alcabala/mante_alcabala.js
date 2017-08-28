function crea_dlg(tip,dlg,title)
{
    $("#"+dlg).dialog({
        autoOpen: false, modal: true, width: 800, 
        show:{ effect: "explode", duration: 500},
        hide:{ effect: "explode", duration: 800}, resizable: false,
        title: "<div class='widget-header'><h4>.:  "+title+" :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                click: function () {if(tip==1){save_deduc();}if(tip==2){save_tasa()}}
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }]     
        }).dialog('open');
}
function fn_new(tip)
{
    var f = new Date();
    $("#dlg_dedu_fec,#dlg_tas_fec").val(f.getDate() + "/" +("0"+(f.getMonth() +1)).slice(-2) + "/" + f.getFullYear());
    if(tip==1)
    {
        crea_dlg(tip,"dlg_new_deduc","Nueva Deducción");
    }
    if(tip==2)
    {
        crea_dlg(tip,"dlg_new_tasas","Nueva Tasa");
    }
}
function save_deduc()
{
    if($('#dlg_nro_uit').val()==0||$('#dlg_nro_uit').val()==""){mostraralertasconfoco('Ingresar UITs deducibles...',"#dlg_nro_uit");return false}
    if($('#dlg_dedu_fec').val()==""){mostraralertasconfoco('Ingresar fecha de inicio...',"#dlg_dedu_fec");return false}
    if($('#dlg_dedu_ley').val()==""){mostraralertasconfoco('Ingresar Ley u ordenanza que valida...',"#dlg_dedu_ley");return false}

    MensajeDialogLoadAjax('dlg_new_deduc', '.:: Guardando ...');
        $.ajax({url: 'deduccion_save',
        type: 'GET',
        data:{uit:$("#dlg_nro_uit").val(),ini:$("#dlg_dedu_fec").val(),ley:$("#dlg_dedu_ley").val()},
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_deduccion").jqGrid('setGridParam', {url: 'grid_deduc'}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_new_deduc');
            $("#dlg_new_deduc").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_new_deduc');
            console.log('error');
            console.log(data);
        }
        });
}
function save_tasa()
{
    if($('#dlg_tas_por').val()==0||$('#dlg_tas_por').val()==""){mostraralertasconfoco('Ingresar Porcentaje...',"#dlg_tas_por");return false}
    if($('#dlg_tas_fec').val()==""){mostraralertasconfoco('Ingresar fecha de inicio...',"#dlg_tas_fec");return false}
    if($('#dlg_tas_ley').val()==""){mostraralertasconfoco('Ingresar Ley u ordenanza que valida...',"#dlg_tas_ley");return false}

    MensajeDialogLoadAjax('dlg_new_tasas', '.:: Guardando ...');
        $.ajax({url: 'tasa_save',
        type: 'GET',
        data:{por:$("#dlg_tas_por").val(),ini:$("#dlg_tas_fec").val(),ley:$("#dlg_tas_ley").val()},
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_tasas").jqGrid('setGridParam', {url: 'grid_tasas'}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_new_tasas');
            $("#dlg_new_tasas").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_new_tasas');
            console.log('error');
            console.log(data);
        }
        });
}
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
                click: function () {if(tip==1){save_contra();}if(tip==2){save_transfer()};if(tip==3){save_transina()}}
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }]     
        }).dialog('open');
}
function fn_new(tip)
{
    $('#dlg_des_contra,#dlg_des_doctrans,#dlg_des_transina').val("");
    if(tip==1)
    {
        crea_dlg(tip,"dlg_new_natcontra","Nuevo Tipo Contrato");
    }
    if(tip==2)
    {
        crea_dlg(tip,"dlg_new_doctrans","Nuevo Documento de Transferencia");
    }
    if(tip==3)
    {
        crea_dlg(tip,"dlg_new_transina","Nueva Transferencia Inafecta");
    }
}
function save_contra()
{
    if($('#dlg_des_contra').val()==""){mostraralertasconfoco('Ingresar Descripción...',"#dlg_des_contra");return false}

    MensajeDialogLoadAjax('dlg_new_natcontra', '.:: Guardando ...');
        $.ajax({url: 'natcontra_save',
        type: 'GET',
        data:{des:$('#dlg_des_contra').val()},
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_nat_cotra").jqGrid('setGridParam', {url: 'grid_nat_contra'}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_des_contra');
            $("#dlg_des_contra").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_des_contra');
            console.log('error');
            console.log(data);
        }
        });
}
function save_transfer()
{
    if($('#dlg_des_doctrans').val()==""){mostraralertasconfoco('Ingresar Descripción...',"#dlg_des_doctrans");return false}

    MensajeDialogLoadAjax('dlg_new_doctrans', '.:: Guardando ...');
        $.ajax({url: 'doctrans_save',
        type: 'GET',
        data:{des:$('#dlg_des_doctrans').val()},
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_doc_trans").jqGrid('setGridParam', {url: 'grid_doc_trans'}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_new_doctrans');
            $("#dlg_new_doctrans").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_new_doctrans');
            console.log('error');
            console.log(data);
        }
        });
}
function save_transina()
{
    if($('#dlg_des_transina').val()==""){mostraralertasconfoco('Ingresar Descripción...',"#dlg_des_transina");return false}

    MensajeDialogLoadAjax('dlg_new_transina', '.:: Guardando ...');
        $.ajax({url: 'transina_save',
        type: 'GET',
        data:{des:$('#dlg_des_transina').val()},
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_trans_ina").jqGrid('setGridParam', {url: 'grid_trans_ina'}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_new_transina');
            $("#dlg_new_transina").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicardlg_new_transina al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_new_transina');
            console.log('error');
            console.log(data);
        }
        });
}

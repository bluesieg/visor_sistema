
function fn_new_archi_contrib()
{
   limpiar_arch_contrib();
    $("#dlg_new_contri").dialog({
        autoOpen: false, modal: true, width: 800, 
        show:{ effect: "explode", duration: 500},
        hide:{ effect: "explode", duration: 800}, resizable: false,
        title: "<div class='widget-header'><h4><span class='widget-icon'> <i class='fa fa-align-justify'></i> </span> Nuevo Contribuyente</h4></div>",
        buttons: [
            {
                id:"btnsave",
                html: '<span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>Grabar Contribuyente',
                "class": "btn btn-labeled bg-color-green txt-color-white",
                click: function () {savecontrib();}
            },

            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
        }).dialog('open');
 
}
function limpiar_arch_contrib()
{
    $("#seltipdoc").val(0);
    $("#dlg_nro_doc,#dlg_contrib,#dlg_domicilio,#dlg_obs,#dlg_num_exp").val("");
    
}


function savecontrib()
{

    if($("#dlg_contrib").val()==0||$("#dlg_contrib").val()=="")
    {
        mostraralertasconfoco("Ingresar Nombre Contribuyente","#dlg_contrib");
        return false;
    }
    
    if($("#dlg_domicilio").val()==0||$("#dlg_domicilio").val()=="")
    {
        mostraralertasconfoco("Ingresar Domicilio","#dlg_domicilio");
        return false;
    }
    
    MensajeDialogLoadAjax('dlg_new_contri', '.:: CARGANDO ...');
        $.ajax({url: 'archi_contribuyentes/create',
        type: 'GET',
        data:{tip:$("#seltipdoc").val(),num:$("#dlg_nro_doc").val(),contri:$("#dlg_contrib").val(),
        dom:$("#dlg_domicilio").val(),obs:$("#dlg_obs").val(),exp:$("#dlg_num_exp").val(),fec:$("#dlg_fec_nac").val()},
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            busqueda(1);
            MensajeDialogLoadAjaxFinish('dlg_new_contri');
            $("#dlg_new_contri").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_new_contri');
            console.log('error');
            console.log(data);
        }
        });
}

function busqueda(tip)
{
    
    $("#table_Contribuyentes").jqGrid("clearGridData", true);
    if(tip==1)
    {
        jQuery("#table_Contribuyentes").jqGrid('setGridParam', {url: 'list_arch_contrib?name=0'}).trigger('reloadGrid');
    }
    if(tip==2)
    {
        if($("#vw_contrib_buscar").val()=="")
        {
            mostraralertasconfoco("Ingresar Información del Contribuyente para busqueda","#vw_contrib_buscar"); 
            return false;
        }
        if($("#vw_contrib_buscar").val().length<4)
        {
            mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#vw_contrib_buscar"); 
            return false;
        }
        jQuery("#table_Contribuyentes").jqGrid('setGridParam', {url: 'list_arch_contrib?name='+$("#vw_contrib_buscar").val()}).trigger('reloadGrid');
    }
}



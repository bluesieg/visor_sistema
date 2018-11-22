function buscar_man_vias(tip)
{
    if(tip==1)
    {
        codigo=$("#dlg_bus_cod").val();
        if(codigo=='')
        {
            mostraralertasconfoco('Ingresar Codigo a Buscar','#dlg_bus_cod');
            return false;
        }
    }
    if(tip==2)
    {
        codigo=$("#dlg_bus_nom").val();
        if(codigo=='')
        {
            mostraralertasconfoco('Ingresar Codigo a Buscar','#dlg_bus_cod');
            return false;
        }
    }
    jQuery("#table_vias").jqGrid('setGridParam', {
         url: 'vias/0?grid=vias&cod='+codigo+'&tip='+tip
    }).trigger('reloadGrid');
}
function crear_dlg(dlg,ancho,titulo)
{
    $("#"+dlg).dialog({
    autoOpen: false, modal: true, width: ancho, show: {effect: "fade", duration: 300}, resizable: false,
    title: "<div class='widget-header'><h4>.: "+titulo+" :.</h4></div>",
    buttons: [
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
    }).dialog('open');
}

function actualizar_via()
{
    limpiar_vias('dlg_edit_via');
    id=$('#table_vias').jqGrid ('getGridParam', 'selrow');
    if(id==null)
    {
        MensajeAlerta("No hay Ruta Seleccionada","Seleccione una Ruta",4000);
        return false;
    }
    
    $("#hidden_via").val(id);
    $.ajax({url: 'vias/'+id+'?grid=normal',
    type: 'GET',
    success: function(r) 
    {
        $("#dlg_edit_cod_via").val(r[0].cod_via);
        $("#dlg_edit_nom_via").val(r[0].nombre_via);
        $("#dlg_edit_tip_via").val(r[0].tipo_via);
                    
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);  
        MensajeDialogLoadAjaxFinish('dlg_edit_via');
    }
    });
    
    crear_dlg('dlg_edit_via','1000','Editar Via');
    
}
function save_via()
{
    MensajeDialogLoadAjax('dlg_edit_via', '.:: Cargando ...');
    $.ajax({url: 'vias/'+$("#hidden_via").val()+'/edit',
    type: 'GET',
    data:{cod:$("#dlg_edit_cod_via").val(),
        nom:$("#dlg_edit_nom_via").val(),
        tip:$("#dlg_edit_tip_via").val()
        },
    success: function(r) 
    {
        MensajeDialogLoadAjaxFinish('dlg_edit_via');
        MensajeExito('Se Modificó con Exito','Su Contenedor fue modificado',5000);
        
        jQuery("#table_vias").jqGrid('setGridParam', {
         url: 'vias/0?grid=vias&cod=0'
        }).trigger('reloadGrid');
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        console.log('error');
        console.log(data);
        MensajeDialogLoadAjaxFinish('dlg_edit_via');
    }
    }); 
}

function limpiar_vias(dialogo)
{
    $("#"+dialogo+" input[type='text']").val("");
    $("#"+dialogo+" input[type='hidden']").val(0);
    $("#"+dialogo+" textarea").val("");
    
}


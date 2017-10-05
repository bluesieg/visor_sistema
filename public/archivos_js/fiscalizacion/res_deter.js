var inputglobal="";
function fn_bus_contrib_hl(input)
{
    inputglobal=input;
    if($("#"+input).val()=="")
    {
        mostraralertasconfoco("Ingresar Información del Contribuyente para busqueda","#"+inputglobal); 
        return false;
    }
    if($("#"+input).val().length<4)
    {
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#"+inputglobal); 
        return false;
    }
    jQuery("#table_contrib").jqGrid('setGridParam', {url: 'obtiene_cotriname?dat='+$("#"+input).val()}).trigger('reloadGrid');

    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width:770, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
}
function fn_bus_lis_hl(per)
{
    $("#"+inputglobal+"_hidden").val(per);
    $("#"+inputglobal).val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    if(inputglobal=="dlg_contri")
    {
        buscar_carta(1);
    }
    if(inputglobal=="dlg_contri_carta")
    {
        buscar_carta(2);
    }
    $("#dlg_bus_contr").dialog("close");
}

function buscar_carta(tip)
{
    if(tip==1)
    {
        $("#table_hojas").jqGrid("clearGridData", true);
        jQuery("#table_hojas").jqGrid('setGridParam', {url: 'trae_hojas_liq/'+$("#selantra").val()+'/'+$("#dlg_contri_hidden").val()+'/0/0/0'}).trigger('reloadGrid');
    }
    if(tip==2)
    {
        $("#table_sel_cartas").jqGrid("clearGridData", true);
        jQuery("#table_sel_cartas").jqGrid('setGridParam', {url: 'trae_cartas/'+$("#selantra").val()+'/'+$("#dlg_contri_carta_hidden").val()+'/0/0/0'}).trigger('reloadGrid');
    }
    if(tip==3)
    {
        if($("#dlg_bus_num_carta").val()=="")
        {
            mostraralertasconfoco("Ingresar Numero","#dlg_bus_num_carta"); 
            return false;
        }
        ajustar(6,'dlg_bus_num_carta')
        num=$("#dlg_bus_num_carta").val();
        jQuery("#table_sel_cartas").jqGrid('setGridParam', {url: 'trae_cartas/'+$("#selantra").val()+'/0/0/0/'+num}).trigger('reloadGrid');
    }
    if(tip==4)
    {
        if($("#dlg_bus_num").val()=="")
        {
            mostraralertasconfoco("Ingresar Numero","#dlg_bus_num"); 
            return false;
        }
        ajustar(6,'dlg_bus_num')
        num=$("#dlg_bus_num").val();
        jQuery("#table_hojas").jqGrid('setGridParam', {url: 'trae_hojas_liq/'+$("#selantra").val()+'/0/0/0/'+num}).trigger('reloadGrid');
    }
    if(tip==5)
    {
        if($("#dlg_bus_fini").val()==""||$("#dlg_bus_ffin").val()=="")
        {
            mostraralertasconfoco("Ingresar Fechas de busqueda","dlg_bus_fini");
            return false;
        }
        ini=$("#dlg_bus_fini").val().replace(/\//g,"-");
        fin=$("#dlg_bus_ffin").val().replace(/\//g,"-");
        jQuery("#table_hojas").jqGrid('setGridParam', {url: 'trae_hojas_liq/0/0/'+ini+'/'+fin+'/0'}).trigger('reloadGrid');
    }
}
function fn_sel_hoja()
{
    $("#dlg_sel_hoja").dialog({
        autoOpen: false, modal: true, width: 1100, 
        show:{ effect: "explode", duration: 500},
        hide:{ effect: "explode", duration: 800}, resizable: false,
        title: "<div class='widget-header'><h4><span class='widget-icon'> <i class='fa fa-align-justify'></i> </span> Crear Hoja de Liquidación</h4></div>"
        }).dialog('open');
        jQuery("#table_sel_hojas").jqGrid('setGridParam', {url: 'trae_hojas_liq/'+$("#selantra").val()+'/0/0/0/0'}).trigger('reloadGrid');
}


function valida_rd(id)
{
   

    $.SmartMessageBox({
            title : "Confirmación Final!",
            content : "Está por generar la Resolución de Determinación para este Contribuyente, Seguro que deseea Grabar la información?, esta no podra ser modificada...",
            buttons : '[Cancelar][Aceptar]'
    }, function(ButtonPressed) {
            if (ButtonPressed === "Aceptar") {

                    fn_save_rd(id);
            }
            if (ButtonPressed === "Cancelar") {
                    $.smallBox({
                            title : "No se Guardo",
                            content : "<i class='fa fa-clock-o'></i> <i>Puede Corregir...</i>",
                            color : "#C46A69",
                            iconSmall : "fa fa-times fa-2x fadeInRight animated",
                            timeout : 3000
                    });
            }
    });
}
function fn_save_rd(id)
{
    MensajeDialogLoadAjax('dlg_sel_hoja', '.:: CARGANDO ...');
        $.ajax({url: 'reso_deter/create',
        type: 'GET',
        data:{hoja:id},
        success: function(r) 
        {
            MensajeDialogLoadAjaxFinish('dlg_sel_hoja');
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            $("#dlg_sel_hoja").dialog("close");
            verhoja(r);
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_sel_hoja');
            console.log('error');
            console.log(data);
        }
        });
}
function verhoja(id)
{
    window.open('hoja_liq_rep/'+id);
}
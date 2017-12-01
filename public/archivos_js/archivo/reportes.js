function busqueda(tip)
{
    if(tip==2)
    {
        if($('#dlg_num_exp').val()=="")
        {
            mostraralertas("Ingresar Numero de expediente...");
            return false;
        }
        num=0;
        exp=$('#dlg_num_exp').val();
    }
    
        MensajeDialogLoadAjax('dialog_doc_contri', '.:: Cargando ...');
        $.ajax({url: 'archi_contribuyentes/0',
        type: 'GET',
        data:{num:num,exp:exp},
        success: function(r) 
        {
            $('#dlg_num_exp,#dlg_contrib').val("");
            if(r!=0)
            {
                $("#id_contrib_hidden").val(r[0].id_contrib);
                $("#dlg_num_exp").val(r[0].nro_expediente);
                $("#dlg_contrib").val(r[0].nombres);
            }
            else
            {
                $('#dlg_num_exp,#dlg_contrib').val("");
                $("#id_contrib_hidden").val(0);
                mostraralertasconfoco("No existe Documento","#dlg_nro_doc");
            }
            MensajeDialogLoadAjaxFinish('dialog_doc_contri');
            

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('widget-grid');
        }
        });
}
function fn_bus_contrib_arch(input)
{
    inputglobal=input;
    if($("#"+input).val()=="")
    {
        mostraralertasconfoco("Ingresar Información del Contribuyente para busqueda","#"+input); 
        return false;
    }
    if($("#"+input).val().length<4)
    {
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#"+input); 
        return false;
    }
    jQuery("#table_contrib").jqGrid('setGridParam', {url: 'grid_contrib_arch?dat='+$("#"+input).val()}).trigger('reloadGrid');

    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width:770, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
}
function fn_bus_contrib_list_arch(per)
{
    $("#id_contrib_hidden").val(per);
    $("#dlg_contrib").val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    $("#dlg_num_exp").val($('#table_contrib').jqGrid('getCell',per,'nro_expediente'));
    $("#dlg_bus_contr").dialog("close");
}
function crear_dialogo()
{
    $("#dialog_doc_contri").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4 id='h4_dlg'></h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Ver Reporte"  ,
            "class": "btn btn-success bg-color-green",
            id:"ver_rep1",
            click: function () { abrir_reporte(1); }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }]
    }).dialog('open');
}


function abrir_reporte(tipo)
{
    envio="-";
    if(tipo==1)
    {
        if($("#id_contrib_hidden").val()==0)
        {
            mostraralertasconfoco("Seleccione Contribuyente","#dlg_contrib");
            return false;
        }
        envio=$('#id_contrib_hidden').val();
    }
    if(tipo==4)
    {
        if($("#dlg_bus_dir").val()==0||$("#dlg_bus_dir").val().length<4)
        {
            mostraralertasconfoco("Ingresar Direccion a Buscar, mas de 4 caracteres","#dlg_bus_dir");
            return false;
        }
        envio=$('#dlg_bus_dir').val();
    }
    window.open('ver_rep_arch/'+envio+'/'+tipo);
    
}

function dlg_ar_reportes(tipo)
{
    if (tipo==1){
        crear_dialogo();
        $("#id_contrib_hidden").val(0);
        $("#ver_rep1").show();
        $("#h4_dlg").text(".: Documentos por Contribuyente :.");
    } 
    if(tipo==2||tipo==3||tipo>=5)
    {
        abrir_reporte(tipo);
    }
    if(tipo==4)
    {
        alert("llego");
        crear_dialogo_dir();
    }
}

function crear_dialogo_dir()
{
    $("#dialog_por_dir").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:Busqueda por Direcciones:./h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Ver Reporte"  ,
            "class": "btn btn-success bg-color-green",
            click: function () { abrir_reporte(4); }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () { $(this).dialog("close"); }
        }]
    }).dialog('open');
}

function fn_bus_contrib_arch(input,tip)
{
    $("#id_contrib_hidden").val(0);
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
    jQuery("#table_contrib").jqGrid('setGridParam', {url: 'busque_contrib_arch?dat='+$("#"+input).val()+'&tip='+tip}).trigger('reloadGrid');

    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width:770, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
}
function fn_bus_principal(per)
{
    $("#content_bus").html("");
    $("#id_contrib_hidden").val(per);
    $("#dlg_contrib").val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    $("#dlg_nro_doc").val($('#table_contrib').jqGrid('getCell',per,'nro_doc'));
    $("#dlg_domicilio").val($('#table_contrib').jqGrid('getCell',per,'dom_fiscal'));
    $("#dlg_num_exp").val($('#table_contrib').jqGrid('getCell',per,'nro_expediente'));
    $("#dlg_obs").val("");
    $("#dlg_bus_contr").dialog("close");
    fn_busqueda_doc(3);
}
function fn_busqueda_doc(tip)
{
    if($("#id_contrib_hidden").val()==0)
    {
        mostraralertasconfoco("Seleccione Expediente Primero","#id_contrib_hidden"); 
        return false;
    }
    $("#content_bus").html("");
    if(tip==3)
    {
        $("#content_bus").hide();
        $("#content_list").show();
        jQuery("#table_doc_pri").jqGrid('setGridParam', {url: 'list_arch_expe?contrib='+$("#id_contrib_hidden").val()}).trigger('reloadGrid');
    }
    if(tip==4)
    {
         if($("#dlg_an_ini").val()==""||$("#dlg_an_ini").val()<1950||$("#dlg_an_fin").val()==""||$("#dlg_an_fin").val()<1950)
        {
            mostraralertasconfoco("Ingresar Años Correctamente","#dlg_an_ini"); 
            return false;
        }
        $("#content_bus").hide();
        $("#content_list").show();
        jQuery("#table_doc_pri").jqGrid('setGridParam', {url: 'busque_arch_expe?contrib='+$("#id_contrib_hidden").val()+'&tip_doc=0&an='+$("#dlg_an_ini").val()+'&fin='+$("#dlg_an_fin").val()}).trigger('reloadGrid');
    }
   if(tip<3)
    {
        MensajeDialogLoadAjax('widget-grid', '.:: Cargando ...');
        $("#content_bus").show();
        $("#content_list").hide();
        $.ajax({url: 'busque_archivo',
        type: 'GET',
        data:{dat:$("#id_contrib_hidden").val(),tip:tip},
        success: function(r) 
        {
            if(r.length>0)
            {
                if(tip==1)
                {
                    r.forEach(function(element) {
                     $("#content_bus").append('<div class="col-xs-2 carpeta" onclick="lista_doc('+element.id_tip_doc+')"><center><img src="img/recursos/carpeta.png" height="100%" width="100%"/><br>\n\
                                                 '+element.documento+' ('+element.count+')</center></div>');

                     });
                 }
                if(tip==2)
                {
                    r.forEach(function(element) {
                     $("#content_bus").append('<div class="col-xs-2 carpeta" onclick="lista_anio('+element.anio+')"><center><img src="img/recursos/carpeta.png" height="100%" width="100%"/><br>\n\
                                                 '+element.anio+' ('+element.count+')</center></div>');

                     });
                 }
            }
            else
            {
                mostraralertasconfoco("No existe","#dlg_nro_doc");
            }
            MensajeDialogLoadAjaxFinish('widget-grid');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('widget-grid');
        }
        });
    }
}

function verfile(id)
{
    if($("#per_imp").val()==0)
    {
        sin_permiso();
        return false;
    }
    window.open('ver_file/'+id);
}
function crear_dialogo_docs()
{
    $("#dlg_lis_doc").dialog({
        autoOpen: false, modal: true, width: 1000, 
        show:{ effect: "explode", duration: 500},
        hide:{ effect: "explode", duration: 800}, resizable: false,
        title: "<div class='widget-header'><h4><span class='widget-icon'> <i class='fa fa-align-justify'></i> </span> Lista de Documentos</h4></div>",
        buttons: [
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
        }).dialog('open');
}
function lista_doc(tip)
{
    crear_dialogo_docs();
    jQuery("#table_doc").jqGrid('setGridParam', {url: 'busque_arch_expe?contrib='+$("#id_contrib_hidden").val()+'&tip_doc='+tip+'&an=0&fin=0'}).trigger('reloadGrid');
}
function lista_anio(an)
{
    crear_dialogo_docs();
    jQuery("#table_doc").jqGrid('setGridParam', {url: 'busque_arch_expe?contrib='+$("#id_contrib_hidden").val()+'&tip_doc=0&an='+an+'&fin=0'}).trigger('reloadGrid');
}




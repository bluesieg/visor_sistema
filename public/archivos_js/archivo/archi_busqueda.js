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

function limpiar_new()
{
    $('#ifrafile').attr('src', '');
    $("#seltipdoc").val(0);
    $("#dlg_anio,#dlg_fec,#dlg_documento_file").val("");
}
function fn_new_archi_expe()
{
    if($("#id_contrib_hidden").val()==0)
    {
        mostraralertasconfoco("Seleccione Contribuyente","#dlg_nro_doc");
        return false;
    }
   limpiar_new();
    $("#dlg_new_expe").dialog({
        autoOpen: false, modal: true, width: 1300, 
        show:{ effect: "explode", duration: 500},
        hide:{ effect: "explode", duration: 800}, resizable: false,
        title: "<div class='widget-header'><h4><span class='widget-icon'> <i class='fa fa-align-justify'></i> </span> Nuevo Documento</h4></div>",
        buttons: [
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
        }).dialog('open');
}
function fn_mod_archi_expe()
{
    fn_new_archi_expe();
    MensajeDialogLoadAjax('dlg_new_expe', '.:: CARGANDO ...');
    Id=$('#table_doc_pri').jqGrid ('getGridParam', 'selrow');
    $.ajax({url: 'archi_expe/'+Id,
        type: 'GET',
        success: function(r) 
        {
            $("#id_arch").val(r[0].id);
            $("#seltipdoc").val(r[0].id_tip_doc);
            $("#dlg_anio").val(r[0].anio);
            $("#dlg_fec").val(r[0].fecha);
            $("#dlg_obs_exp").val(r[0].observacion);
            var lista = r[0].direccion.split(';');
            $("#dlg_direcc").val(lista[0]);
            $("#div_direcc").html("");
            for(i=1;i<lista.length-1;i++) {
                $("#div_direcc").append('<div><div class="col-xs-12" style="margin-top: 10px;"></div>\n\
                    <div class="col-xs-12" style="padding: 0px; ">\n\
                        <div class="input-group input-group-md" style="width: 100%">\n\
                            <span class="input-group-addon" style="width: 165px">Dirección &nbsp;<i class="fa fa-map"></i></span>\n\
                            <div>\n\
                                <input type="text"  class="form-control" style="height: 32px; width: 94%" value="'+lista[i]+'">\n\
                            </div>\n\
                             <span style="display: inline-block">\n\
                                <button class="btn btn-danger" type="button" onclick="del_dir(this)" style="height: 32px;width: 32px">\n\
                                    X\n\
                                </button>\n\
                            </span>\n\
                        </div>\n\
                    </div></div>');
                
            };
            MensajeDialogLoadAjaxFinish('dlg_new_expe');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_new_expe');
        }
        });
}

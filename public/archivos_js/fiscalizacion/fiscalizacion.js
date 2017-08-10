function callpredtab()
{
    $("#selmnza").html('');
    MensajeDialogLoadAjax('dvselmnza', '.:: CARGANDO ...');
    $.ajax({url: 'selmzna?sec='+$("#selsec").val(),
    type: 'GET',
    success: function(r) 
    {
        $(r).each(function(i, v){ // indice, valor
            $("#selmnza").append('<option value="' + v.id_mzna + '">' + v.codi_mzna + '</option>');
        })
        MensajeDialogLoadAjaxFinish('dvselmnza');
    },
    error: function(data) {
        console.log('error');
        console.log(data);
    }
    });
}
function fn_bus_contrib()
{
    if($("#dlg_contri").val()=="")
    {
        mostraralertasconfoco("Ingresar Información de busqueda","#dlg_contri"); 
        return false;
    }
    if($("#dlg_contri").val().length<4)
    {
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#dlg_contri"); 
        return false;
    }
    jQuery("#table_contrib").jqGrid('setGridParam', {url: 'obtiene_cotriname?dat='+$("#dlg_contri").val()}).trigger('reloadGrid');

    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
}
function fn_bus_contrib_list(per)
{
    $("#dlg_contri_hidden").val(per);
    $("#dlg_dni").val($('#table_contrib').jqGrid('getCell',per,'id_per'));
    $("#dlg_contri").val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    call_list_contrib(1);
    $("#dlg_bus_contr").dialog("close");
}


function traer_contri_cod(input, doc) {
    MensajeDialogLoadAjax(input, '.:: Cargando ...');
    $.ajax({
        url: 'autocomplete_contrib?doc=0&cod=' + doc,
        type: 'GET',
        success: function (data) {
            if (data.msg == 'si') {
                $("#" + input + "_hidden").val(data.id_pers);
                $("#" + input).val(data.contribuyente);
                call_list_contrib(1);
                
            } else {
                $("#" + input + "_hidden").val(0);
                $("#" + input).val("");
                $("#table_personas").jqGrid("clearGridData", true);
                mostraralertas('* El Documento Ingresado no Existe, registre al contribuyente o intente con otro número ... !');
            }
            MensajeDialogLoadAjaxFinish(input);

        },
        error: function (data) {
            mostraralertas('* Error Interno !  Comuniquese con el Administrador...');
            MensajeDialogLoadAjaxFinish(input);
        }
    });
}
function call_list_contrib(tip)
{
    if(tip==1)
    {
        jQuery("#table_personas").jqGrid('setGridParam', {url: 'obtiene_cotriop?dat='+$("#dlg_contri_hidden").val()+'&sec=0&manz=0'}).trigger('reloadGrid');
    }
    else
    {
        jQuery("#table_personas").jqGrid('setGridParam', {url: 'obtiene_cotriop?dat=0&sec='+$("#selsec option:selected").text()+'&manz='+$("#selmnza option:selected").text()}).trigger('reloadGrid');
    }
}
function generar_op(tip)
{
    Id=$('#table_personas').jqGrid ('getGridParam', 'selrow');
    if(Id==null&&tip==1)
    {
        mostraralertas("No hay Contribuyente seleccionado para impresión");
        return false;
    }
    MensajeDialogLoadAjax('widget-grid', '.:: Generando ...');
    Id_contrib=$('#dlg_contri_hidden').val();
    sec=$("#selsec option:selected").text();
    man=$("#selmnza option:selected").text();
    $.ajax({url: 'fiscalizacion/create',
    type: 'GET',
    data:{per:Id_contrib,sec:sec,man:man,tip:tip},
    success: function(r) 
    {
        MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
        MensajeDialogLoadAjaxFinish('widget-grid');
        window.open('fis_rep/'+tip+'/'+r+'/'+sec+'/'+man);
    },
    error: function(data) {
        MensajeAlerta("hubo un error, Comunicar al Administrador","",4000);
        MensajeDialogLoadAjaxFinish('widget-grid');
        console.log('error');
        console.log(data);
    }
    });
}
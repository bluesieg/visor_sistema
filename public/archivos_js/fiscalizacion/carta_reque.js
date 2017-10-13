var inputglobal="";
function fn_bus_contrib_carta(input)
{
    inputglobal=input;
    if($("#"+input).val()=="")
    {
        mostraralertasconfoco("Ingresar Información del Contribuyente para busqueda","#dlg_contri"); 
        return false;
    }
    if($("#"+input).val().length<4)
    {
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#dlg_contri"); 
        return false;
    }
    jQuery("#table_contrib").jqGrid('setGridParam', {url: 'obtiene_cotriname?dat='+$("#"+input).val()}).trigger('reloadGrid');

    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width:770, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
}
function fn_bus_contrib_list_carta(per)
{
    $("#"+inputglobal+"_hidden").val(per);
    $("#"+inputglobal).val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    $("#"+inputglobal+"_doc").val($('#table_contrib').jqGrid('getCell',per,'nro_doc'));
    $("#"+inputglobal+"_dom").val($('#table_contrib').jqGrid('getCell',per,'dom_fiscal'));
    if(inputglobal=="dlg_contri")
    {
        call_list_contrib_carta(1);
    }
    $("#dlg_bus_contr").dialog("close");
}

function call_list_contrib_carta(tip)
{
    
    $("#table_cartas").jqGrid("clearGridData", true);
    if(tip==0)
    {
        jQuery("#table_cartas").jqGrid('setGridParam', {url: 'trae_cartas/'+$("#selantra").val()+'/0/0/0/0'}).trigger('reloadGrid');
    }
    if(tip==1)
    {
        jQuery("#table_cartas").jqGrid('setGridParam', {url: 'trae_cartas/'+$("#selantra").val()+'/'+$("#dlg_contri_hidden").val()+'/0/0/0'}).trigger('reloadGrid');
    }
    if(tip==2)
    {
        if($("#dlg_bus_fini").val()==""||$("#dlg_bus_ffin").val()=="")
        {
            mostraralertasconfoco("Ingresar Fechas de busqueda","dlg_bus_fini");
            return false;
        }
        ini=$("#dlg_bus_fini").val().replace(/\//g,"-");
        fin=$("#dlg_bus_ffin").val().replace(/\//g,"-");
        jQuery("#table_cartas").jqGrid('setGridParam', {url: 'trae_cartas/0/0/'+ini+'/'+fin+'/0'}).trigger('reloadGrid');
    }
    if(tip==3)
    {
        if($("#dlg_bus_num").val()=="")
        {
            mostraralertasconfoco("Ingresar Numero","#dlg_bus_num"); 
            return false;
        }
        ajustar(6,'dlg_bus_num')
        num=$("#dlg_bus_num").val();
        jQuery("#table_cartas").jqGrid('setGridParam', {url: 'trae_cartas/'+$("#selantra").val()+'/0/0/0/'+num}).trigger('reloadGrid');
    }
    
}
function fn_new_carta()
{
    limpiar_carta_req()
    $("#dlg_new_carta").dialog({
        autoOpen: false, modal: true, width: 1100, 
        show:{ effect: "explode", duration: 500},
        hide:{ effect: "explode", duration: 800}, resizable: false,
        title: "<div class='widget-header'><h4><span class='widget-icon'> <i class='fa fa-align-justify'></i> </span> Generar Nueva Carta de Requerimiento</h4></div>"
        }).dialog('open');
}
function limpiar_carta_req()
{
    $("#dlg_contri_carta_doc,#dlg_contri_carta,#dlg_contri_carta_dom,#dlg_hor_fis,#dlg_otros").val("");
    $("#dlg_contri_carta_hidden").val(0);
    $('#table_fiscalizadores tbody tr').each(function() {$(this).remove();});
    $('#cbx_con,#cbx_lic,#cbx_der').prop('checked', true);
    $('#cbx_otr').prop('checked', false);
    $('#dlg_otros').prop('disabled', true);
}
function validarotros()
{
    if($('#cbx_otr').is(':checked'))
    {
        $('#dlg_otros').prop('disabled', false);
        $("#dlg_otros").focus();
    }
    else
    {
        $('#dlg_otros').prop('disabled', true);
    }
}
function poner_fisca()
{
    if($("#selfisca").val()==0)
    {
        mostraralertasconfoco("Seleccione Fiscalizador","selfisca");
        return false;
    }

    if ( $("#table_fiscalizadores tr#"+$("#selfisca").val()).length==0 ) {
        $('#table_fiscalizadores > tbody').append('<tr id="'+$("#selfisca").val()+'"><td style="border: 1px solid #bbb">'+$("#selfisca").val()+'</td>\n\
                                                   <td style="border: 1px solid #bbb">'+$("#selfisca option:selected").attr("documento")+'</td>\n\
                                                   <td style="border: 1px solid #bbb">'+$("#selfisca option:selected").text()+'</td>\n\
                                                   <td class="text-center" style="border: 1px solid #bbb"><i class="fa fa-close" style="color:red; cursor:pointer" onclick="del_fis('+$("#selfisca").val()+')"></i></td></tr>');
    }
    
}
function del_fis(fis)
{
    $("#table_fiscalizadores tr#"+fis+"").remove();
}
function fn_confirmar_carta()
{

    if($("#dlg_contri_carta_hidden").val()==0||$("#dlg_contri_carta_hidden").val()=="")
    {
        mostraralertasconfoco("Seleccione Contribuyente a fiscalizar","dlg_contri_carta");
        return false;
    }
    if($("#dlg_fec_fis").val()==0||$("#dlg_fec_fis").val()=="")
    {
        mostraralertasconfoco("Seleccione Fecha de Fizcalización","dlg_fec_fis");
        return false;
    }
    if($("#dlg_hor_fis").val()==0||$("#dlg_hor_fis").val()=="")
    {
        mostraralertasconfoco("Seleccione Hora de Fizcalización","dlg_hor_fis");
        return false;
    }
    if($('#table_fiscalizadores > tbody tr').length==0)
    {
        mostraralertasconfoco("Agregar Fizcalizadores","selfisca");
        return false;
    }
    if($('#dlg_otros').prop('checked')&&$('#dlg_otros').val()==""){otro=1;}
    $.SmartMessageBox({
            title : "Confirmación Final!",
            content : "Está por generar Carta de Requerimiento para este Contribuyente, desea Grabar la información?",
            buttons : '[Cancelar][Aceptar]'
    }, function(ButtonPressed) {
            if (ButtonPressed === "Aceptar") {

                    fn_save_carta();
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
function fn_save_carta()
{
    con=0;lic=0;der=0;otro=0;otrotext="-"
    if($('#cbx_con').prop('checked')){con=1;}
    if($('#cbx_lic').prop('checked')){lic=1;}
    if($('#cbx_der').prop('checked')){der=1;}
    if($('#cbx_otr').prop('checked')){otro=1;otrotext=$("#dlg_otros").val()}
    
    MensajeDialogLoadAjax('dlg_new_carta', '.:: CARGANDO ...');
        $.ajax({url: 'carta_reque/create',
        type: 'GET',
        data:{contri:$("#dlg_contri_carta_hidden").val(),fec:$("#dlg_fec_fis").val(),hor:$("#dlg_hor_fis").val(),con:con,lic:lic,der:der,otro:otro,otrotext:otrotext,anfis:$("#selanafis").val()},
        success: function(r) 
        {
            if(r>0)
            {
                $('#table_fiscalizadores tbody tr').each(function() {
                    fisca=$(this).attr("id");
                    $.ajax({url: 'carta_set_fisca',
                    type: 'GET',
                    data:{car:r,fis: fisca},
                    success: function(data) 
                    {
                        MensajeExito("Fiscalizador Insertado","Su Registro Fue Insertado con Éxito...",4000);
                    },
                    error: function(data) {
                        mostraralertas("no inserto Fiscalizador, Comunicar al Administrador");
                        console.log('error');
                        console.log(data);
                    }
                    });
                });
            }
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            call_list_contrib_carta(1);
            MensajeDialogLoadAjaxFinish('dlg_new_carta');
            $("#dlg_new_carta").dialog("close");
            vercarta(r);
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_new_carta');
            console.log('error');
            console.log(data);
        }
        });
}
function vercarta(id)
{
    window.open('car_req_rep/'+id);
}

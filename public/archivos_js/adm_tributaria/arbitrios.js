function limpiararb()
{
    $("#sel_bar_frecu,#sel_ressol_frecu,#sel_seren_cat,#sel_parq_cat,#sel_ressol_tp").val(0);
    $("#inp_bar_frent,#sel_bar_frecu_cos,#inp_bar_costot,#inp_bar_costri,#inp_bar_cosmes").val("");
    $("#inp_ressol_area,#sel_ressol_frecu_cos,#inp_ressol_costot,#inp_ressol_costri,#inp_ressol_cosmes").val("");
    $("#inp_seren_costot,#inp_seren_costri,#inp_seren_cosmes").val("");
    $("#inp_parq_costot,#inp_parq_costri,#inp_parq_mes").val("");
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
                
            } else {
                $("#" + input + "_hidden").val(0);
                $("#" + input).val("");
                
                mostraralertas('* El Documento Ingresado no Existe, registre al contribuyente o intente con otro número ... !');
            }
            MensajeDialogLoadAjaxFinish(input);
            callfilltab();

        },
        error: function (data) {
            mostraralertas('* Error Interno !  Comuniquese con el Administrador...');
            MensajeDialogLoadAjaxFinish(input);
        }
    });
}
function callfilltab()
{
    if($("#dlg_contri_hidden").val()>0)
    {
        jQuery("#table_predios").jqGrid('setGridParam', {url: 'gridpredio?tpre=1&mnza=0&ctr='+$("#dlg_contri_hidden").val()+'&an='+$("#selantra").val()}).trigger('reloadGrid');
    }
    else
    {
        $("#table_predios").jqGrid("clearGridData", true);
    }
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
    jQuery("#table_predios").jqGrid('setGridParam', {url: 'gridpredio?tpre=1&mnza=0&ctr='+per+'&an='+$("#selantra").val()}).trigger('reloadGrid');
    $("#dlg_bus_contr").dialog("close");
    
}
function create_arb()
{
    limpiararb();
    $("#dlg_new_arbi").dialog({
        autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.: Arbítrios :.</h4></div>"       
    }).dialog('open');
}

function new_arb()
{
    limpiararb();
    Id=$('#table_predios').jqGrid ('getGridParam', 'selrow');
    if(Id==null)
    {
        mostraralertas("No hay Predio seleccionado");
        return false;
    }
    create_arb();
    MensajeDialogLoadAjax('dlg_new_arbi', '.:: Cargando ...');
        $.ajax({url: 'arbitrios_municipales/'+Id,
        type: 'GET',
        data:{an:$("#selantra").val()},
        success: function(r) 
        {
            if(r[0].id_predio==0)
            {
                $("#btnupdatearb").show();
                $("#btnsavearb").hide();
                $("#inp_hidd_arb").val(r[0].id_arb);
                $("#sel_bar_frecu").val(r[0].frecu_bar);
                $("#inp_bar_frent").val(r[0].frentera);
                change_select('sel_bar_frecu',1);
                $("#inp_ressol_area").val(r[0].area_const);
                call_frec_rrs(r[0].id_rrs);
                $("#sel_seren_cat").val(r[0].id_seren);
                $("#sel_parq_cat").val(r[0].id_par_jar);
            }
            else
            {
                $("#inp_hidd_arb").val(0);
                $("#btnupdatearb").hide();
                $("#btnsavearb").show();
                $("#inp_ressol_area").val(r[0].area_const);
            }
            MensajeDialogLoadAjaxFinish('dlg_new_arbi');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_new_arbi');
            $("#dlg_new_arbi").dialog('close');
        }
        });
}

function savearb()
{
    pred=$('#table_predios').jqGrid ('getGridParam', 'selrow');
    cod=$('#table_predios').jqGrid ('getCell', pred, 'cod_cat');
    MensajeDialogLoadAjax('dlg_new_arbi', '.:: Guardando ...');
    $.ajax({url: 'arbitrios_municipales/create',
    type: 'GET',
    data:{barfrec:$("#sel_bar_frecu").val(),barfrent:$("#inp_bar_frent").val(),pred:pred,cod:cod,
            an:$("#selantra").val(),rrsfrec:$("#sel_ressol_frecu").val(),seren:$("#sel_seren_cat").val(),
            parjar:$("#sel_parq_cat").val()},
    success: function(r) 
    {
        $('#dlg_idpre').val(r);
        MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
        //jQuery("#table_predios").jqGrid('setGridParam', {url: 'gridpredio?tpre=1&mnza='+$("#selmnza").val()+'&ctr=0&an='+$("#selantra").val()}).trigger('reloadGrid');
        MensajeDialogLoadAjaxFinish('dlg_new_arbi');
        
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        MensajeDialogLoadAjaxFinish('dlg_new_arbi');
        console.log('error');
        console.log(data);
    }
    });
}
function updatearb()
{
    id=$("#inp_hidd_arb").val();
    MensajeDialogLoadAjax('dlg_new_arbi', '.:: Guardando ...');
    $.ajax({url: 'arbitrios_municipales/'+id+'/edit',
    type: 'GET',
    data:{barfrec:$("#sel_bar_frecu").val(),barfrent:$("#inp_bar_frent").val(),rrsuso:$("#sel_ressol_tp").val(),
        rrsfrec:$("#sel_ressol_frecu").val(),seren:$("#sel_seren_cat").val(),parjar:$("#sel_parq_cat").val()},
    success: function(r) 
    {
        $('#dlg_idpre').val(r);
        MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
        //jQuery("#table_predios").jqGrid('setGridParam', {url: 'gridpredio?tpre=1&mnza='+$("#selmnza").val()+'&ctr=0&an='+$("#selantra").val()}).trigger('reloadGrid');
        MensajeDialogLoadAjaxFinish('dlg_new_arbi');
        
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        MensajeDialogLoadAjaxFinish('dlg_new_arbi');
        console.log('error');
        console.log(data);
    }
    });
}
function llenararbitrios()
{
    pred=$('#table_predios').jqGrid ('getGridParam', 'selrow');
    jQuery("#table_arbitrios").jqGrid('setGridParam', {url: 'gridarbitrios?pre='+pred+'&an='+$("#selantra").val()}).trigger('reloadGrid');

}
function change_select(input,tip)
{
    if(tip<3)
    {
        $("#"+input+"_cos").val($("#"+input+" option:selected").attr("costo"));
    }
    calculos(tip);
}
function calculos(tip)
{
    switch(tip)
    {
        case 1:
            if($("#inp_bar_frent").val()==""||$("#sel_bar_frecu").val()=="")
            {
                $("#inp_bar_costot,#inp_bar_cosmes,#inp_bar_costri").val(0);
            }
            else
            {
                $("#inp_bar_costot").val(($("#inp_bar_frent").val()*$("#sel_bar_frecu_cos").val()).toFixed(4));
                $("#inp_bar_cosmes").val(($("#inp_bar_costot").val()/12).toFixed(4));
                $("#inp_bar_costri").val(($("#inp_bar_costot").val()/4).toFixed(4));
            }
        case 2:
            if($("#inp_ressol_area").val()==""||$("#sel_ressol_frecu").val()=="")
            {
                $("#inp_ressol_costot,#inp_ressol_costri,#inp_ressol_cosmes").val(0);
            }
            else
            {
                $("#inp_ressol_costot").val(($("#inp_ressol_area").val()*$("#sel_ressol_frecu_cos").val()).toFixed(4));
                $("#inp_ressol_costri").val(($("#inp_ressol_costot").val()/4).toFixed(4));
                $("#inp_ressol_cosmes").val(($("#inp_ressol_costot").val()/12).toFixed(4));
            }
        case 3:
            $("#inp_seren_costot").val($("#sel_seren_cat option:selected").attr("costo"));
            $("#inp_seren_costri").val(($("#inp_seren_costot").val()/4).toFixed(4));
            $("#inp_seren_cosmes").val(($("#inp_seren_costot").val()/12).toFixed(4));
        case 4:
            $("#inp_parq_costot").val($("#sel_parq_cat option:selected").attr("costo"));
            $("#inp_parq_costri").val(($("#inp_parq_costot").val()/4).toFixed(4));
            $("#inp_parq_mes").val(($("#inp_parq_costot").val()/12).toFixed(4));
    }
}
function call_frec_rrs(valu)
{
    MensajeDialogLoadAjax("sel_ressol_frecu", '.:: Cargando ...');
    id=$("#sel_ressol_tp").val();
    $.ajax({url: 'getfrecrrs',
        type: 'GET',
        data:{id:id,an:$("#selantra").val()},
        success: function(data) 
        {
            $("#sel_ressol_frecu").html("");
            $("#sel_ressol_frecu").append($('<option>',{value:0,text: "--Seleccione--", costo:0}));
            for (var i=0; i < data.length; i++)
            {
                $("#sel_ressol_frecu").append($('<option>',{value:data[i].id_rrs,text: data[i].frecuencia, costo:data[i].costo}));
            } 
            $("#sel_ressol_frecu").val(valu);
            change_select('sel_ressol_frecu',2);
            MensajeDialogLoadAjaxFinish('sel_ressol_frecu');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            
        }
        });
}
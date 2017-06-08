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
            callfilltab();        
            MensajeDialogLoadAjaxFinish('dvselmnza');
            

        },
        error: function(data) {
            console.log('error');
            console.log(data);
        }
        });
//
    }
    function callfilltab()
    {
          jQuery("#table_predios").jqGrid('setGridParam', {url: 'gridpredio?mnza='+$("#selmnza").val()}).trigger('reloadGrid');
    }
    function limpiarpred()
    {
        $('#dlg_sel_condpre').val("");
        $('#dlg_inp_condos').val("");
        $("#dlg_inp_n").val("");
        $("#dlg_inp_mz").val("");
        $('#dlg_inp_lt').val("");
        $('#dlg_inp_zn').val("");
        $('#dlg_inp_secc').val("");
        $('#dlg_inp_piso').val("");
        $("#dlg_inp_dpto").val("");
        $("#dlg_inp_tdastand").val("");
        $('#dlg_inp_refe').val("");
    }
    function opendlgRegdj(id,contrib)
    {
        
        $("#dlg_reg_dj").dialog({
        autoOpen: false, modal: true, width: 1300, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGISTRO DE DECLARACIONES JURADAS :.</h4></div>",
        buttons: [{
                html: '<span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>&nbsp; Modificar',
                "class": "btn btn-labeled bg-color-blue txt-color-white",
                click: function () {
                    dlgUpdate();
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-blue",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        }).dialog('open');
        

       
    }
    function dlgUpdate()
    {
        if($('#dlg_inp_piso').val()=="")
        {
            mostraralertasconfoco('Ingresar el piso para grabar','#dlg_inp_piso');
            return false;
        }
        
        MensajeDialogLoadAjax('dlg_reg_dj', '.:: CARGANDO ...');
        $.ajax({url: 'predios_urbanos/'+$('#dlg_idpre').val()+'/edit',
        type: 'GET',
        data:{condpre:$('#dlg_sel_condpre').val(),condos:$('#dlg_inp_condos').val(),cvia:global_id_via,
        n:$("#dlg_inp_n").val(),mz:$("#dlg_inp_mz").val(),lt:$('#dlg_inp_lt').val(),zn:$('#dlg_inp_zn').val(),
        secc:$('#dlg_inp_secc').val(),piso:$('#dlg_inp_piso').val(),dpto:$("#dlg_inp_dpto").val(),int:$("#dlg_inp_tdastand").val(),
        ref:$('#dlg_inp_refe').val()},
        success: function(r) 
        {
            jQuery("#table_predios").jqGrid('setGridParam', {url: 'gridpredio?mnza='+$("#selmnza").val()}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
            console.log('error');
            console.log(data);
        }
        });
       
    }
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
    function opendlgRegdj(id,contrib)
    {
        $("#dlg_reg_dj").dialog({
        autoOpen: false, modal: true, width: 1300, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGISTRO DE DECLARACIONES JURADAS :.</h4></div>",
        }).dialog('open');
        
//        $.ajax({url: 'getcontri?contri='+contrib,
//        type: 'GET',
//        success: function(r) 
//        {
//            $("#dlg_dni").val(r[0].nro_doc);
//
//        },
//        error: function(data) {
//            console.log('error');
//            console.log(data);
//        }
//        });
       
    }
    function dlgUpdate()
    {
        $.ajax({url: 'predios_urbanos/'+$('#dlg_idpre').val()+'/edit',
        type: 'GET',
        data:{condpre:$('#dlg_sel_condpre').val(),condos:$('#dlg_inp_condos').val(),cvia:$('#dlg_inp_cvia').val(),
        n:$("#dlg_inp_n").val(),mz:$("#dlg_inp_mz").val(),lt:$('#dlg_inp_lt').val(),zn:$('#dlg_inp_zn').val(),
        secc:$('#dlg_inp_secc').val(),piso:$('#dlg_inp_piso').val(),dpto:$("#dlg_inp_dpto").val(),int:$("#dlg_inp_tdastand").val()},
        success: function(r) 
        {
            alert(r);

        },
        error: function(data) {
            console.log('error');
            console.log(data);
        }
        });
       
    }
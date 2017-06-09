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
    function limpiarpred(tip)
    {
        $("#dlg_reg_dj").dialog({
        autoOpen: false, modal: true, width: 1300, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGISTRO DE DECLARACIONES JURADAS :.</h4></div>",
        buttons: [{
                html: '<span class="btn-label"><i class="glyphicon glyphicon-save"></i></span>&nbsp; Guardar',
                "class": "btn btn-labeled bg-color-blue txt-color-white",
                id:"btnsavepre",
                click: function () {dlgSave();}
            },
            {
                html: '<span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>&nbsp; Modificar',
                "class": "btn btn-labeled bg-color-blue txt-color-white",
                id:"btnmodpre",
                click: function () {dlgUpdate();}
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-blue",
                click: function () {$(this).dialog("close");}
            }],
        })
        if(tip==1)
        {
            $( "#dlg_dni, #dlg_lot" ).prop( "disabled", false );
            $('#dlg_lot').val("");
            $("#btnsavepre").show();
            $("#btnmodpre").hide();
        }
        if(tip==2)
        {
            $( "#dlg_dni, #dlg_lot" ).prop( "disabled", true );
            $("#btnsavepre").hide();
            $("#btnmodpre").show();
        }
        $("#dlg_sec").val($("#selsec option:selected").text());
        $("#dlg_mzna").val($("#selmnza option:selected").text());
        $('#dlg_dni').val("");
        $('#dlg_contri').val("");
        $('#dlg_sel_condpre').val("");
        $('#dlg_inp_condos').val("");
        global_id_via=0;
        $('#dlg_inp_cvia').val("");
        $('#dlg_inp_nvia').val("");
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
    
    function validarcampos()
    {
        if($('#dlg_inp_condos').val()==""){$('#dlg_inp_condos').val('0');}
        if($('#dlg_inp_piso').val()==""){$('#dlg_inp_piso').val('0');}
        if($('#dlg_inp_zn').val()==""){$('#dlg_inp_zn').val('-');}
        if($('#dlg_inp_secc').val()==""){$('#dlg_inp_secc').val('-');}
        if($('#dlg_inp_refe').val()==""){$('#dlg_inp_refe').val('-');}
        if($('#dlg_inp_n').val()==""){$('#dlg_inp_n').val('-');}
        if($('#dlg_inp_tdastand').val()==""){$('#dlg_inp_tdastand').val('-');}
        if($('#dlg_inp_dpto').val()==""){$('#dlg_inp_dpto').val('-');}
    }
    
    function clicknewgrid()
    {
        limpiarpred(1);
        $("#dlg_reg_dj").dialog('open');
    }
    function clickmodgrid()
    {
       Id=$('#table_predios').jqGrid ('getGridParam', 'selrow');
       limpiarpred(2);
        $("#dlg_idpre").val(Id);
        
        $("#dlg_lot").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'lote'));
        $("#dlg_contri").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'contribuyente'));
        $("#dlg_sel_condpre").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'id_cond_prop'));
        $("#dlg_dni").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'nro_doc'));
        $("#dlg_inp_cvia").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'cod_via'));
        $("#id_via").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'id_via'));
        $("#dlg_inp_dpto").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'dpto'));
        $("#dlg_inp_mz").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'mzna_dist'));
        $("#dlg_inp_lt").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'lote_dist'));
        $("#dlg_inp_n").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'nro_mun'));
        $("#dlg_inp_zn").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'zona'));
        $("#dlg_inp_secc").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'secc'));
        $("#dlg_inp_piso").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'piso'));
        $("#dlg_inp_tdastand").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'nro_int'));
        $("#dlg_inp_condos").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'nro_condominios'));
        $("#dlg_inp_refe").val(jQuery("#table_predios").jqGrid ('getCell', Id, 'referencia'));
        get_global_cod_via("dlg_inp_nvia",jQuery("#table_predios").jqGrid ('getCell', Id, 'cod_via'));
        $("#dlg_reg_dj").dialog('open');
    }
    function dlgSave()
    {
        if(parseInt($('#dlg_lot').val())<1||$('#dlg_lot').val()=="")
        {
            mostraralertasconfoco('Ingresar un número de lote...',"#dlg_lot");return false
        }
        ajuslote = ajustar(2,$('#dlg_lot').val());
        $('#dlg_lot').val(ajuslote);
        if($('#dlg_contri_hidden').val()==0){mostraralertasconfoco('Ingresar contribuyente...',"#dlg_dni");return false}
        if(global_id_via==0){mostraralertasconfoco('La Vía es incorrecta, vuelva a ingresar una vía válida...',"#dlg_inp_cvia");return false}
        if($('#dlg_sel_condpre').val()==null){mostraralertasconfoco('Ingresar condicion predio...',"#dlg_sel_condpre");return false}
        validarcampos();
        MensajeDialogLoadAjax('dlg_reg_dj', '.:: Guardando ...');
        $.ajax({url: 'predios_urbanos/create',
        type: 'GET',
        data:{condpre:$('#dlg_sel_condpre').val(),condos:$('#dlg_inp_condos').val(),cvia:global_id_via,
        n:$("#dlg_inp_n").val(),mz:$("#dlg_inp_mz").val(),lt:$('#dlg_inp_lt').val(),zn:$('#dlg_inp_zn').val(),
        secc:$('#dlg_inp_secc').val(),piso:$('#dlg_inp_piso').val(),dpto:$("#dlg_inp_dpto").val(),int:$("#dlg_inp_tdastand").val(),
        ref:$('#dlg_inp_refe').val(),contrib:$('#dlg_contri_hidden').val(),sec:$("#dlg_sec").val(),mzna:$("#dlg_mzna").val(),lote:$('#dlg_lot').val()},
        success: function(r) 
        {
            
            mostraralertas('inserto correctamente');
            jQuery("#table_predios").jqGrid('setGridParam', {url: 'gridpredio?mnza='+$("#selmnza").val()}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
            $("#dlg_reg_dj").dialog('close');

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
            console.log('error');
            console.log(data);
        }
        });
    }
    function dlgUpdate()
    {
        if(global_id_via==0){mostraralertasconfoco('La Vía es incorrecta, vuelva a ingresar una vía válida...',"#dlg_inp_cvia");return false}
        validarcampos();
        
        
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
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
        auto_input("dlg_inp_usopre");
        
        autocompletar=1;
        $("#dlg_reg_dj").dialog({
        autoOpen: false, modal: true, width: 1300, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGISTRO DE DECLARACIONES JURADAS :.</h4></div>",
        });
        if(tip==1)
        {
            $("#dlg_idpre").val(0);
            $( "#dlg_dni, #dlg_lot" ).prop( "disabled", false );
            $('#dlg_lot,#dlg_inp_luz,#dlg_inp_agua').val("");
            $("#btnsavepre").show();
            $("#btnmodpre").hide();
            $("#dlg_sel_condpre,#hidden_dlg_inp_usopre,#dlg_sel_estcon,#dlg_sel_tippre,#dlg_sel_uspprearb,#dlg_sel_foradq").val(1);
            $("#dlg_inp_usopre_cod").val("010101");
            $("#dlg_inp_usopre").val("CASA HABITACIÓN");
            $("input[name=dlg_rd_lcons][value='0']").prop("checked",true);
            $("input[name=dlg_rd_confobr][value='0']").prop("checked",true);
            $("input[name=dlg_rd_defra][value='0']").prop("checked",true);
            
        }
        if(tip==2)
        {
            $("#hidden_dlg_inp_usopre").val(0);
            $("#dlg_inp_usopre_cod").val("");
            $("#dlg_inp_usopre").val("");
            $( "#dlg_dni, #dlg_lot" ).prop( "disabled", true );
            $("#btnsavepre").hide();
            $("#btnmodpre").show();
            $('#dlg_sel_condpre').val("");
        }
        $("#dlg_sec").val($("#selsec option:selected").text());
        $("#dlg_mzna").val($("#selmnza option:selected").text());
        $('#dlg_dni').val("");
        $('#dlg_contri').val("");
        
        $('#dlg_inp_condos').val("");
        global_id_via=0;
        $('#dlg_inp_cvia').val("");
        $('#dlg_inp_nvia').val("");
        $("#dlg_inp_n").val("");
        $("#dlg_inp_mz").val("");
        $('#dlg_inp_lt').val("");
        $('#dlg_inp_zn').val("");
        $('#dlg_inp_secc,#dlg_inp_piso,#dlg_inp_dpto,#dlg_inp_tdastand,#dlg_inp_refe, #dlg_inp_fech').val("");
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
        if($('#dlg_inp_luz').val()==""){$('#dlg_inp_luz').val('-');}
        if($('#dlg_inp_agua').val()==""){$('#dlg_inp_agua').val('-');}
    }
    
    function clicknewgrid()
    {
        jQuery("#table_pisos").jqGrid('setGridParam', {url: 'pisos_predios/0'}).trigger('reloadGrid');
        limpiarpred(1);
        $("#dlg_reg_dj").dialog('open');
    }
    function clickmodgrid()
    {
        limpiarpred(2);
       $("#dlg_reg_dj").dialog('open');
       MensajeDialogLoadAjax('dlg_reg_dj', '.:: Cargando ...');
       Id=$('#table_predios').jqGrid ('getGridParam', 'selrow');
       
       $("#dlg_idpre").val(Id);
       $.ajax({url: 'predios_urbanos/'+Id,
        type: 'GET',
        success: function(r) 
        {
                $("#dlg_lot").val(r[0].lote);
                $("#dlg_dni").val(r[0].nro_doc);
                $("#dlg_contri").val(r[0].contribuyente);
                $("#dlg_sel_condpre").val(r[0].id_cond_prop);
                $("#dlg_inp_cvia").val(r[0].cod_via);
                $("#id_via").val(r[0].id_via);
                get_global_cod_via("dlg_inp_nvia",r[0].cod_via);
                $("#dlg_inp_dpto").val(r[0].dpto);
                $("#dlg_inp_mz").val(r[0].mzna_dist);
                $("#dlg_inp_lt").val(r[0].lote_dist);
                $("#dlg_inp_n").val(r[0].nro_mun);
                $("#dlg_inp_zn").val(r[0].zona);
                $("#dlg_inp_secc").val(r[0].secc);
                $("#dlg_inp_piso").val(r[0].piso);
                $("#dlg_inp_tdastand").val(r[0].nro_int);
                $("#dlg_inp_condos").val(r[0].nro_condominios);
                $("#dlg_inp_refe").val(r[0].referencia);
                $("#dlg_sel_estcon").val(r[0].id_est_const);
                $("#dlg_sel_tippre").val(r[0].id_tip_pred);
                $("#hidden_dlg_inp_usopre").val(r[0].id_uso_predio);
                $("#dlg_inp_usopre_cod").val(r[0].codi_uso);
                $("#dlg_inp_usopre").val(r[0].desc_uso);
                $("#dlg_sel_uspprearb").val(r[0].id_uso_pred_arbitrio);
                $("#dlg_sel_foradq").val(r[0].id_form_adq);
                $("#dlg_inp_fech").val(r[0].fech_adquis);
                $("#dlg_inp_luz").val(r[0].luz_nro_sum);
                $("#dlg_inp_agua").val(r[0].agua_nro_sum);
                $("input[name=dlg_rd_lcons][value='"+r[0].licen_const+"']").prop("checked",true);
                $("input[name=dlg_rd_confobr][value='"+r[0].conform_obra+"']").prop("checked",true);
                $("input[name=dlg_rd_defra][value='"+r[0].declar_fabrica+"']").prop("checked",true);
                MensajeDialogLoadAjaxFinish('dlg_reg_dj');

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
        }
        }); 
        jQuery("#table_pisos").jqGrid('setGridParam', {url: 'pisos_predios/'+Id}).trigger('reloadGrid');
        
    }
    function dlgSave()
    {
        if(parseInt($('#dlg_lot').val())<1||$('#dlg_lot').val()=="")
        {
            mostraralertasconfoco('Ingresar un número de lote...',"#dlg_lot");return false
        }
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
        ref:$('#dlg_inp_refe').val(),contrib:$('#dlg_contri_hidden').val(),sec:$("#dlg_sec").val(),mzna:$("#dlg_mzna").val(),lote:$('#dlg_lot').val(),
        ecc:$("#dlg_sel_estcon").val(),tpre:$("#dlg_sel_tippre").val(),tipuso:$("#hidden_dlg_inp_usopre").val(),
        uprearb:$("#dlg_sel_uspprearb").val(),ifor:$("#dlg_sel_foradq").val(),ffor:$("#dlg_inp_fech").val(),
        luz:$("#dlg_inp_luz").val(),agua:$("#dlg_inp_agua").val(),liccon:$('input:radio[name=dlg_rd_lcons]:checked').val(),
        confobr:$('input:radio[name=dlg_rd_confobr]:checked').val(),defra:$('input:radio[name=dlg_rd_defra]:checked').val()},
        success: function(r) 
        {
            $('#dlg_idpre').val(r);
            mostraralertas('Insertó Correctamente');
            jQuery("#table_predios").jqGrid('setGridParam', {url: 'gridpredio?mnza='+$("#selmnza").val()}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
            $( "#dlg_dni, #dlg_lot" ).prop( "disabled", true );
            $("#btnsavepre").hide();
            $("#btnmodpre").show();
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
        ref:$('#dlg_inp_refe').val(),
        ecc:$("#dlg_sel_estcon").val(),tpre:$("#dlg_sel_tippre").val(),tipuso:$("#hidden_dlg_inp_usopre").val(),
        uprearb:$("#dlg_sel_uspprearb").val(),ifor:$("#dlg_sel_foradq").val(),ffor:$("#dlg_inp_fech").val(),
        luz:$("#dlg_inp_luz").val(),agua:$("#dlg_inp_agua").val(),liccon:$('input:radio[name=dlg_rd_lcons]:checked').val(),
        confobr:$('input:radio[name=dlg_rd_confobr]:checked').val(),defra:$('input:radio[name=dlg_rd_defra]:checked').val()},
        success: function(r) 
        {
            mostraralertas('Se Modificó Correctamente...');
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
    function clicknewpiso()
    {
        if($('#dlg_idpre').val()==0)
        {
            mostraralertas("Primero Guardar Predio...");
            return false;
        }
        $("#dlg_reg_piso").dialog({
        autoOpen: false, modal: true, width: 700, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGISTRO DE CONSTRUCCIONES :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-primary bg-color-green",
                click: function () {}
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }],
        }).dialog('open');
    }
    autocompletar=0;
    function auto_input(textbox,extra){
        if(autocompletar==0)
        {
            $.ajax({
                   type: 'GET',
                   url: 'autocompletar_tipo_uso',
                   success: function(data){               
                        var $local_todo=data;          
                         $("#"+textbox).autocomplete({
                              source: $local_todo,
                              focus: function(event, ui) {
                                     $("#"+textbox).val(ui.item.label);                             
                                     return false;
                              },
                              select: function(event, ui) {
                                     $("#"+textbox).val(ui.item.label);
                                     $("#hidden_"+textbox).val(ui.item.value);
                                     if(extra!=0)
                                     {
                                        $("#"+textbox+"_cod").val(ui.item.codi);
                                     }
                                      return false;
                              }   
                          });             
                    }
            });
        }
}
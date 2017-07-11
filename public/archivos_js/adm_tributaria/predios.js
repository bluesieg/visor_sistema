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
          jQuery("#table_predios").jqGrid('setGridParam', {url: 'gridpredio?mnza='+$("#selmnza").val()+'&ctr=0&an='+$("#selantra").val()}).trigger('reloadGrid');
    }
    function limpiarpred(tip)
    {
        auto_input("dlg_inp_usopre","autocompletar_tipo_uso",1);
        
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
            $("#dlg_inp_usopre_cod,#dlg_inp_usopre,#dlg_sel_condpre").val("");
            $( "#dlg_dni, #dlg_lot" ).prop( "disabled", true );
            $("#btnsavepre").hide();
            $("#btnmodpre").show();
        }
        $("#dlg_sec").val($("#selsec option:selected").text());
        $("#dlg_mzna").val($("#selmnza option:selected").text());
        $('#dlg_dni,#dlg_contri').val("");
        $('#dlg_inp_condos').val("");
        $("#dlg_inp_areter,#dlg_inp_arecomter").val(0);
        $('#dlg_inp_nvia_des,#dlg_inp_nvia,#dlg_inp_n,#dlg_inp_mz,#dlg_inp_lt,#dlg_inp_zn').val("");
        $('#dlg_inp_secc,#dlg_inp_piso,#dlg_inp_dpto,#dlg_inp_tdastand,#dlg_inp_refe, #dlg_inp_fech').val("");
        $("#s5_sel_condi,#s5_inp_basleg,#s5_inp_exp,#s5_inp_reso,#s5_inp_fechres,#s5_inp_anini,#s5_inp_anfin").val("");
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
        if($('#dlg_inp_areter').val()==""){$('#dlg_inp_areter').val(0);}
        if($('#dlg_inp_arecomter').val()==""){$('#dlg_inp_arecomter').val(0);}
        if($('#dlg_inp_aranc').val()==""){$('#dlg_inp_aranc').val(0);}
    }
    
    function clicknewgrid()
    {
        jQuery("#table_pisos").jqGrid('setGridParam', {url: 'gridpisos/0'}).trigger('reloadGrid');
        jQuery("#table_condos").jqGrid('setGridParam', {url: 'gridcondos/0'}).trigger('reloadGrid');
        jQuery("#table_instal").jqGrid('setGridParam', {url: 'gridinsta/0'}).trigger('reloadGrid');
        limpiarpred(1);
        auto_select("dlg_inp_nvia","sel_viaby_sec",0);
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
                auto_select("dlg_inp_nvia","sel_viaby_sec",r[0].id_via);
                $("#dlg_inp_aranc").val(r[0].arancel);
                $("#dlg_inp_valterr").val(r[0].val_ter);
                $("#dlg_inp_areter").val(r[0].are_terr);
                $("#dlg_inp_arecomter").val(r[0].are_com_terr);
                MensajeDialogLoadAjaxFinish('dlg_reg_dj');
                jQuery("#table_pisos").jqGrid('setGridParam', {url: 'gridpisos/'+Id}).trigger('reloadGrid');
                jQuery("#table_condos").jqGrid('setGridParam', {url: 'gridcondos/'+Id}).trigger('reloadGrid');
                jQuery("#table_instal").jqGrid('setGridParam', {url: 'gridinsta/'+Id}).trigger('reloadGrid');
                $.ajax({url: 'pensionista_predios/'+Id,
                type: 'GET',
                success: function(r) 
                {
                    if(r!=0)
                    {
                        $("#s5_sel_condi").val(r[0].id_con);
                        $("#s5_inp_basleg").val(r[0].bas_leg);
                        $("#s5_inp_exp").val(r[0].nro_exp);
                        $("#s5_inp_reso").val(r[0].nro_res);
                        $("#s5_inp_fechres").val(r[0].fec_res);
                        $("#s5_inp_anini").val(r[0].ani_ini);
                        $("#s5_inp_anfin").val(r[0].ani_fin);
                        $("#btn_s5_delpen").show();
                    }
                    else
                    {
                        $("#btn_s5_delpen").hide();
                    }
                },
                error: function(data) {
                    mostraralertas("hubo un error, Comunicar al Administrador");
                    console.log('error');
                    console.log(data);
                }
                });

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
        }
        }); 
        
        

    }
    function dlgSave()
    {
        if(parseInt($('#dlg_lot').val())<1||$('#dlg_lot').val()=="")
        {
            mostraralertasconfoco('Ingresar un número de lote...',"#dlg_lot");return false
        }
        if($('#dlg_contri_hidden').val()==0){mostraralertasconfoco('Ingresar contribuyente...',"#dlg_dni");return false}
        if($("#dlg_inp_nvia").val()==null){mostraralertasconfoco('La Vía es incorrecta, vuelva a ingresar una vía válida...',"#dlg_inp_nvia");return false}
        if($('#dlg_sel_condpre').val()==null){mostraralertasconfoco('Ingresar condicion predio...',"#dlg_sel_condpre");return false}
        validarcampos();
        MensajeDialogLoadAjax('dlg_reg_dj', '.:: Guardando ...');
        $.ajax({url: 'predios_urbanos/create',
        type: 'GET',
        data:{condpre:$('#dlg_sel_condpre').val(),condos:$('#dlg_inp_condos').val(),cvia:$("#dlg_inp_nvia").val(),
        n:$("#dlg_inp_n").val(),mz:$("#dlg_inp_mz").val(),lt:$('#dlg_inp_lt').val(),zn:$('#dlg_inp_zn').val(),
        secc:$('#dlg_inp_secc').val(),piso:$('#dlg_inp_piso').val(),dpto:$("#dlg_inp_dpto").val(),int:$("#dlg_inp_tdastand").val(),
        ref:$('#dlg_inp_refe').val(),contrib:$('#dlg_contri_hidden').val(),sec:$("#dlg_sec").val(),mzna:$("#dlg_mzna").val(),lote:$('#dlg_lot').val(),
        ecc:$("#dlg_sel_estcon").val(),tpre:$("#dlg_sel_tippre").val(),tipuso:$("#hidden_dlg_inp_usopre").val(),
        uprearb:$("#dlg_sel_uspprearb").val(),ifor:$("#dlg_sel_foradq").val(),ffor:$("#dlg_inp_fech").val(),
        luz:$("#dlg_inp_luz").val(),agua:$("#dlg_inp_agua").val(),liccon:$('input:radio[name=dlg_rd_lcons]:checked').val(),
        confobr:$('input:radio[name=dlg_rd_confobr]:checked').val(),defra:$('input:radio[name=dlg_rd_defra]:checked').val(),
        areterr:$("#dlg_inp_areter").val(),arecomter:$("#dlg_inp_arecomter").val(),aranc:$("#dlg_inp_aranc").val()},
        success: function(r) 
        {
            $('#dlg_idpre').val(r);
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_predios").jqGrid('setGridParam', {url: 'gridpredio?mnza='+$("#selmnza").val()+'&ctr=0&an='+$("#selantra").val()}).trigger('reloadGrid');
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
        if($("#dlg_inp_nvia").val()==null){mostraralertasconfoco('La Vía es incorrecta, vuelva a ingresar una vía válida...',"#dlg_inp_nvia_des");return false}
        validarcampos();
        
        MensajeDialogLoadAjax('dlg_reg_dj', '.:: CARGANDO ...');
        $.ajax({url: 'predios_urbanos/'+$('#dlg_idpre').val()+'/edit',
        type: 'GET',
        data:{condpre:$('#dlg_sel_condpre').val(),condos:$('#dlg_inp_condos').val(),cvia:$("#dlg_inp_nvia").val(),
        n:$("#dlg_inp_n").val(),mz:$("#dlg_inp_mz").val(),lt:$('#dlg_inp_lt').val(),zn:$('#dlg_inp_zn').val(),
        secc:$('#dlg_inp_secc').val(),piso:$('#dlg_inp_piso').val(),dpto:$("#dlg_inp_dpto").val(),int:$("#dlg_inp_tdastand").val(),
        ref:$('#dlg_inp_refe').val(),
        ecc:$("#dlg_sel_estcon").val(),tpre:$("#dlg_sel_tippre").val(),tipuso:$("#hidden_dlg_inp_usopre").val(),
        uprearb:$("#dlg_sel_uspprearb").val(),ifor:$("#dlg_sel_foradq").val(),ffor:$("#dlg_inp_fech").val(),
        luz:$("#dlg_inp_luz").val(),agua:$("#dlg_inp_agua").val(),liccon:$('input:radio[name=dlg_rd_lcons]:checked').val(),
        confobr:$('input:radio[name=dlg_rd_confobr]:checked').val(),defra:$('input:radio[name=dlg_rd_defra]:checked').val(),
        areterr:$("#dlg_inp_areter").val(),arecomter:$("#dlg_inp_arecomter").val(),aranc:$("#dlg_inp_aranc").val()},
        success: function(r) 
        {
            MensajeExito("Modificó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_predios").jqGrid('setGridParam', {url: 'gridpredio?mnza='+$("#selmnza").val()+'&ctr=0&an='+$("#selantra").val()}).trigger('reloadGrid');
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
    function creardlgpiso()
    {
     $("#dlg_reg_piso").dialog({
        autoOpen: false, modal: true, width: 700, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGISTRO DE CONSTRUCCIONES :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                id:"btnpissave",
                "class": "btn btn-primary bg-color-green",
                click: function () {pisoSave();}
            },
            {
                html: "<i class='fa fa-save'></i>&nbsp; Modificar",
                "class": "btn btn-primary bg-color-blue",
                id:"btnpismod",
                click: function () {pisoUpdate();}
            },
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }],
        }).dialog('open');
    }
    function clicknewpiso()
    {
        $('#dlg_idpiso').val(0);
        if($('#dlg_idpre').val()==0)
        {
            mostraralertas("Primero Guardar Predio...");
            return false;
        }
       
        $("#rpiso_inp_nro,#rpiso_inp_fech,#rpiso_inp_econstr,#rpiso_inp_estruc,#rpiso_inp_aconst,#rpiso_inp_acomun").val("")
        $("#rpiso_inp_clasi").val($("#rpiso_inp_clasi option:first").val());
        $("#rpiso_inp_mat").val($("#rpiso_inp_mat option:first").val());
        $("#rpiso_inp_econserv").val($("#rpiso_inp_econserv option:first").val());
        $("#rpiso_inp_econstr").val($("#rpiso_inp_econstr option:first").val());
        callchangeoption("rpiso_inp_clasi",0);
        callchangeoption("rpiso_inp_mat",0);
        callchangeoption("rpiso_inp_econserv",0);
        callchangeoption("rpiso_inp_econstr",0);
        creardlgpiso();
        $("#btnpissave").show();
        $("#btnpismod").hide();
    }
    function clickmodpiso()
    {
        if($('#dlg_idpre').val()==0)
        {
            mostraralertas("Primero Guardar Predio...");
            return false;
        }
        Id=$('#table_pisos').jqGrid ('getGridParam', 'selrow');
        $('#dlg_idpiso').val(Id);
        creardlgpiso();
        $("#btnpissave").hide();
        $("#btnpismod").show();
        MensajeDialogLoadAjax('dlg_reg_piso', '.:: Cargando ...');
        $.ajax({url: 'pisos_predios/'+Id,
        type: 'GET',
        success: function(r) 
        {
            $("#rpiso_inp_nro").val(r[0].cod_piso);
            $("#rpiso_inp_fech").val(r[0].fch_const);
            $("#rpiso_inp_clasi").val(parseInt(r[0].clas));
            $("#rpiso_inp_mat").val(r[0].mep);
            $("#rpiso_inp_econserv").val(r[0].esc);
            $("#rpiso_inp_econstr").val(parseInt(r[0].ecc));
            $("#rpiso_inp_estruc").val(r[0].est_mur+r[0].est_tch+r[0].aca_pis+r[0].aca_pta+r[0].aca_rev+r[0].aca_ban+r[0].ins_ele);
            $("#rpiso_inp_aconst").val(r[0].area_const);
            $("#rpiso_inp_acomun").val(r[0].val_areas_com);
            MensajeDialogLoadAjaxFinish('dlg_reg_piso');
            callchangeoption("rpiso_inp_clasi",0);
            callchangeoption("rpiso_inp_mat",0);
            callchangeoption("rpiso_inp_econserv",0);
            callchangeoption("rpiso_inp_econstr",0);

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_piso');
            $("#dlg_reg_piso").dialog('close');
        }
        });
    }
    function pisoSave()
    {
        if($("#rpiso_inp_nro").val()==""){mostraralertasconfoco("Ingresar Nro Piso","#rpiso_inp_nro"); return false}
        if($("#rpiso_inp_fech").val()==""){mostraralertasconfoco("Ingresar Fecha del Piso","#rpiso_inp_fech"); return false}
        if($("#rpiso_inp_clasi").val()==""){mostraralertasconfoco("Ingresar Estado de Conservación","#rpiso_inp_econserv"); return false}
        if($("#rpiso_inp_mat").val()==""){mostraralertasconfoco("Ingresar Estado de Conservación","#rpiso_inp_econserv"); return false}
        if($("#rpiso_inp_econserv").val()==""){mostraralertasconfoco("Ingresar Estado de Conservación","#rpiso_inp_econserv"); return false}
        if($("#rpiso_inp_econstr").val()==""){mostraralertasconfoco("Ingresar Estado de Construcción","#rpiso_inp_econstr"); return false}
        if($("#rpiso_inp_estruc").val()==""){mostraralertasconfoco("Ingresar Estructuras","#rpiso_inp_estruc"); return false}
        if($("#rpiso_inp_estruc").val().length<7){mostraralertasconfoco("Cadena de Estructura incompleta, Ingrese 7 caracteres","#rpiso_inp_estruc"); return false}
        if($("#rpiso_inp_aconst").val()==""){mostraralertasconfoco("Ingresar Area Construida","#rpiso_inp_aconst"); return false}
        if($("#rpiso_inp_acomun").val()==""){mostraralertasconfoco("Ingresar Area Común","#rpiso_inp_acomun"); return false}
        MensajeDialogLoadAjax('dlg_reg_piso', '.:: Guardando ...');
        Id_pre=$('#dlg_idpre').val();
        $("#rpiso_inp_estruc").val().toUpperCase();
        $.ajax({url: 'pisos_predios/create',
        type: 'GET',
        data:{nro:$("#rpiso_inp_nro").val(),fech:$("#rpiso_inp_fech").val(),clasi:$("#rpiso_inp_clasi").val(),
        mep:$("#rpiso_inp_mat").val(),estconserv:$("#rpiso_inp_econserv").val(),estconst:$("#rpiso_inp_econstr").val(),
        estru:$("#rpiso_inp_estruc").val().toUpperCase(),aconst:$("#rpiso_inp_aconst").val(),acomun:$("#rpiso_inp_acomun").val(),id_pre:Id_pre},
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_pisos").jqGrid('setGridParam', {url: 'gridpisos/'+Id_pre}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_reg_piso');
            $("#dlg_reg_piso").dialog('close');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_reg_piso');
            console.log('error');
            console.log(data);
        }
        });
    }
    function pisoUpdate()
    {
        if($("#rpiso_inp_nro").val()==""){mostraralertasconfoco("Ingresar Nro Piso","#rpiso_inp_nro"); return false}
        if($("#rpiso_inp_fech").val()==""){mostraralertasconfoco("Ingresar Fecha del Piso","#rpiso_inp_fech"); return false}
        if($("#rpiso_inp_estruc").val()==""){mostraralertasconfoco("Ingresar Estructuras","#rpiso_inp_estruc"); return false}
        if($("#rpiso_inp_estruc").val().length<7){mostraralertasconfoco("Cadena de Estructura incompleta, Ingrese 7 caracteres","#rpiso_inp_estruc"); return false}
        if($("#rpiso_inp_aconst").val()==""){mostraralertasconfoco("Ingresar Area Construida","#rpiso_inp_aconst"); return false}
        if($("#rpiso_inp_acomun").val()==""){mostraralertasconfoco("Ingresar Area Común","#rpiso_inp_acomun"); return false}
        MensajeDialogLoadAjax('dlg_reg_piso', '.:: Modificando ...');
        
        $.ajax({url: 'pisos_predios/'+$('#dlg_idpiso').val()+'/edit',
        type: 'GET',
        data:{nro:$("#rpiso_inp_nro").val(),fech:$("#rpiso_inp_fech").val(),clasi:$("#rpiso_inp_clasi").val(),
        mep:$("#rpiso_inp_mat").val(),estconserv:$("#rpiso_inp_econserv").val(),estconst:$("#rpiso_inp_econstr").val(),
        estru:$("#rpiso_inp_estruc").val().toUpperCase(),aconst:$("#rpiso_inp_aconst").val(),acomun:$("#rpiso_inp_acomun").val()},
        success: function(r) 
        {
            MensajeExito("Modificó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_pisos").jqGrid('setGridParam', {url: 'gridpisos/'+$('#dlg_idpre').val()}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_reg_piso');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_reg_piso');
            console.log('error');
            console.log(data);
        }
        });
    }
    
    function creardlgcondo()
    {
     $("#dlg_reg_condo").dialog({
        autoOpen: false, modal: true, width: 700, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGISTRO DE CONDOMINIOS :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                id:"btncondsave",
                "class": "btn btn-primary bg-color-green",
                click: function () {condoSave();}
            },
            {
                html: "<i class='fa fa-save'></i>&nbsp; Modificar",
                "class": "btn btn-primary bg-color-blue",
                id:"btncondmod",
                click: function () {condoUpdate();}
            },
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }],
        }).dialog('open');
    }
    function clicknewcondo()
    {
        $('#dlg_idcondo').val(0);
        if($('#dlg_idpre').val()==0)
        {
            mostraralertas("Primero Guardar Predio...");
            return false;
        }
        $('#rcondo_inp_dni,#rcondo_inp_rsoc,#rcondo_inp_dir,#rcondo_inp_porcent').val("");
        $('#rcondo_inp_dni_hidden').val(0);
        creardlgcondo();
        $("#btncondsave").show();
        $("#btncondmod").hide();
    }
    function clickmodcondo()
    {
        if($('#dlg_idpre').val()==0)
        {
            mostraralertas("Primero Guardar Predio...");
            return false;
        }
        Id=$('#table_condos').jqGrid ('getGridParam', 'selrow');
        $('#dlg_idcondo').val(Id);
        creardlgcondo();
        $("#btncondsave").hide();
        $("#btncondmod").show();
        MensajeDialogLoadAjax('dlg_reg_condo', '.:: Cargando ...');
        $.ajax({url: 'condominios_predios/'+Id,
        type: 'GET',
        success: function(r) 
        {
            $("#rcondo_inp_dni").val(r[0].nro_doc);
            $("#rcondo_inp_rsoc_hidden").val(r[0].id_contrib);
            $("#rcondo_inp_rsoc").val(r[0].ape_pat+" "+r[0].ape_pat+" "+r[0].nombres);
            $("#rcondo_inp_dir").val(r[0].direccion);
            $("#rcondo_inp_porcent").val(r[0].porcent);
            MensajeDialogLoadAjaxFinish('dlg_reg_condo');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_condo');
            $("#dlg_reg_condo").dialog('close');
        }
        });
        
        
    }
    function condoSave()
    {
        if($("#rcondo_inp_dni").val()==""){mostraralertasconfoco("Ingresar Nro DNI o RUC","#rcondo_inp_dni"); return false}
        if($("#rcondo_inp_rsoc_hidden").val()=="0"){mostraralertasconfoco("Ingresar Nro DNI o RUC y confirmar con tecla enter","#rcondo_inp_dni"); return false}
        if($("#rcondo_inp_dir").val()==""){mostraralertasconfoco("Ingresar Dirección","#rcondo_inp_dir"); return false}
        if($("#rcondo_inp_porcent").val()==""){mostraralertasconfoco("Ingresar porcentaje","#rcondo_inp_porcent"); return false}
        MensajeDialogLoadAjax('dlg_reg_condo', '.:: Guardando ...');
        Id_pre=$('#dlg_idpre').val();
        $.ajax({url: 'condominios_predios/create',
        type: 'GET',
        data:{contrib:$("#rcondo_inp_rsoc_hidden").val(),dir:$("#rcondo_inp_dir").val().toUpperCase(),porc:$("#rcondo_inp_porcent").val(),id_pre:Id_pre},
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_condos").jqGrid('setGridParam', {url: 'gridcondos/'+Id_pre}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_reg_condo');
            $("#dlg_reg_condo").dialog('close');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_reg_condo');
            console.log('error');
            console.log(data);
        }
        });
    }
    function condoUpdate()
    {
        if($("#rcondo_inp_dni").val()==""){mostraralertasconfoco("Ingresar Nro DNI o RUC","#rcondo_inp_dni"); return false}
        if($("#rcondo_inp_rsoc_hidden").val()=="0"){mostraralertasconfoco("Ingresar Nro DNI o RUC y confirmar con tecla enter","#rcondo_inp_dni"); return false}
        if($("#rcondo_inp_dir").val()==""){mostraralertasconfoco("Ingresar Dirección","#rcondo_inp_dir"); return false}
        if($("#rcondo_inp_porcent").val()==""){mostraralertasconfoco("Ingresar porcentaje","#rcondo_inp_porcent"); return false}
        MensajeDialogLoadAjax('dlg_reg_condo', '.:: Modificando ...');
        $.ajax({url: 'condominios_predios/'+$('#dlg_idcondo').val()+'/edit',
        type: 'GET',
        data:{contrib:$("#rcondo_inp_rsoc_hidden").val(),dir:$("#rcondo_inp_dir").val().toUpperCase(),porc:$("#rcondo_inp_porcent").val()},
        success: function(r) 
        {
            MensajeExito("Modificó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_condos").jqGrid('setGridParam', {url: 'gridcondos/'+$('#dlg_idpre').val()}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_reg_condo');
            $("#dlg_reg_condo").dialog('close');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_reg_condo');
            console.log('error');
            console.log(data);
        }
        });
    }
    
    function creardlginst()
    {
     $("#dlg_reg_inst").dialog({
        autoOpen: false, modal: true, width: 700, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  REGISTRO DE INSTALACIONES :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                id:"btninstsave",
                "class": "btn btn-primary bg-color-green",
                click: function () {instSave();}
            },
            {
                html: "<i class='fa fa-save'></i>&nbsp; Modificar",
                "class": "btn btn-primary bg-color-blue",
                id:"btninstmod",
                click: function () {instUpdate();}
            },
            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }],
        }).dialog('open');
    }
    function clicknewinst()
    {
        $("#dlg_idinst").val(0);
       if($('#dlg_idpre').val()==0)
        {
            mostraralertas("Primero Guardar Predio...");
            return false;
        }
        $("#hidden_rinst_inp_des").val(0)
        autocompletar=0;
        auto_input("rinst_inp_des","autocompletar_insta",2);
        autocompletar=1;
        $("#rinst_inp_des,#rinst_inp_des_cod,#rinst_inp_undmed,#rinst_inp_anio,#rinst_inp_largo,#rinst_inp_ancho,#rinst_inp_alto").val("")
        $("#rinst_inp_mat").val($("#rinst_inp_mat option:first").val());
        $("#rinst_inp_econserv").val($("#rinst_inp_econserv option:first").val());
        $("#rinst_inp_econstr").val($("#rinst_inp_econstr option:first").val());
        $("#rinst_inp_clasi").val($("#rinst_inp_clasi option:first").val());
        creardlginst();
        $("#btninstsave").show();
        $("#btninstmod").hide();
        callchangeoption("rinst_inp_mat",0);
        callchangeoption("rinst_inp_econserv",0);
        callchangeoption("rinst_inp_econstr",0);
        callchangeoption("rinst_inp_clasi",0);
        
    }
    function clickmodinst()
    {
        if($('#dlg_idpre').val()==0)
        {
            mostraralertas("Primero Guardar Predio...");
            return false;
        }
        Id=$('#table_instal').jqGrid ('getGridParam', 'selrow');
        $('#dlg_idinst').val(Id);
        creardlginst();
        $("#btninstsave").hide();
        $("#btninstmod").show();
        MensajeDialogLoadAjax('dlg_reg_inst', '.:: Cargando ...');
        $.ajax({url: 'instalaciones_predios/'+Id,
        type: 'GET',
        success: function(r) 
        {
            $("#rinst_inp_des_cod").val(r[0].cod_instal);
            $("#rinst_inp_des").val(r[0].descrip_instal);
            $("#hidden_rinst_inp_des").val(r[0].id_instal);
            $("#rinst_inp_undmed").val(r[0].unid_medida);
            $("#rinst_inp_anio").val(r[0].anio);
            $("#rinst_inp_mat").val(r[0].mep);
            $("#rinst_inp_econserv").val(r[0].ecs);
            $("#rinst_inp_econstr").val(parseInt(r[0].ecc));
            $("#rinst_inp_largo").val(r[0].dim_lar);
            $("#rinst_inp_ancho").val(r[0].dim_anch);
            $("#rinst_inp_alto").val(r[0].dim_alt);
            $("#rinst_inp_clasi").val(r[0].id_cla)
            callchangeoption("rinst_inp_mat",0);
            callchangeoption("rinst_inp_econserv",0);
            callchangeoption("rinst_inp_econstr",0);
            callchangeoption("rinst_inp_clasi",0);
            MensajeDialogLoadAjaxFinish('dlg_reg_inst');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_inst');
            $("#dlg_reg_inst").dialog('close');
        }
        });
        
        
    }
    function instSave()
    {
        if($("#hidden_rinst_inp_des").val()==0){mostraralertasconfoco("seleccionar Instalación","#rinst_inp_des"); return false}
        if($("#rinst_inp_anio").val()==""){mostraralertasconfoco("Ingresar Año de Construcción","#rinst_inp_anio"); return false}
        if($("#rinst_inp_largo").val()==""){mostraralertasconfoco("Ingresar largo","#rinst_inp_largo"); return false}
        if($("#rinst_inp_ancho").val()==""){mostraralertasconfoco("Ingresar Ancho","#rinst_inp_ancho"); return false}
        if($("#rinst_inp_alto").val()==""){mostraralertasconfoco("Ingresar Alto","#rinst_inp_alto"); return false}
        MensajeDialogLoadAjax('dlg_reg_inst', '.:: Guardando ...');
        Id_pre=$('#dlg_idpre').val();
        $.ajax({url: 'instalaciones_predios/create',
        type: 'GET',
        data:{inst:$("#hidden_rinst_inp_des").val(),anio:$("#rinst_inp_anio").val(),largo:$("#rinst_inp_largo").val(),
            ancho:$("#rinst_inp_ancho").val(),alto:$("#rinst_inp_alto").val(),mep:$("#rinst_inp_mat").val(),
            ecs:$("#rinst_inp_econserv").val(),ecc:$("#rinst_inp_econstr").val(),id_pre:Id_pre,cla:$("#rinst_inp_clasi").val()},
        success: function(r) 
        {
            
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_instal").jqGrid('setGridParam', {url: 'gridinsta/'+Id_pre}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_reg_inst');
            $("#dlg_reg_inst").dialog('close');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_reg_inst');
            console.log('error');
            console.log(data);
        }
        });
    }
    function instUpdate()
    {
        if($("#hidden_rinst_inp_des").val()==0){mostraralertasconfoco("seleccionar Instalación","#rinst_inp_des"); return false}
        if($("#rinst_inp_anio").val()==""){mostraralertasconfoco("Ingresar Año de Construcción","#rinst_inp_anio"); return false}
        if($("#rinst_inp_largo").val()==""){mostraralertasconfoco("Ingresar largo","#rinst_inp_largo"); return false}
        if($("#rinst_inp_ancho").val()==""){mostraralertasconfoco("Ingresar Ancho","#rinst_inp_ancho"); return false}
        if($("#rinst_inp_alto").val()==""){mostraralertasconfoco("Ingresar Alto","#rinst_inp_alto"); return false}
        MensajeDialogLoadAjax('dlg_reg_inst', '.:: Modificando ...');
        $.ajax({url: 'instalaciones_predios/'+$('#dlg_idinst').val()+'/edit',
        type: 'GET',
        data:{inst:$("#hidden_rinst_inp_des").val(),anio:$("#rinst_inp_anio").val(),largo:$("#rinst_inp_largo").val(),
            ancho:$("#rinst_inp_ancho").val(),alto:$("#rinst_inp_alto").val(),mep:$("#rinst_inp_mat").val(),
            ecs:$("#rinst_inp_econserv").val(),ecc:$("#rinst_inp_econstr").val(),cla:$("#rinst_inp_clasi").val()},
        success: function(r) 
        {
            MensajeExito("Se Modificó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            jQuery("#table_instal").jqGrid('setGridParam', {url: 'gridinsta/'+$('#dlg_idpre').val()}).trigger('reloadGrid');
            MensajeDialogLoadAjaxFinish('dlg_reg_inst');
            $("#dlg_reg_condo").dialog('close');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_reg_inst');
            console.log('error');
            console.log(data);
        }
        });
    }
    function  clicksavePensi()
    {
        
        Id_pre=$('#dlg_idpre').val();
        if(Id_pre==0)
        {
            mostraralertas("Primero Guardar Predio...");
            return false;
        }
        if($("#s5_sel_condi").val()==null){mostraralertasconfoco("seleccionar Condición","#s5_sel_condi");return false;}
        if($("#s5_inp_basleg").val()==""){mostraralertasconfoco("Ingresar Base Legal","#s5_inp_basleg");return false;}
        if($("#s5_inp_exp").val()==""){mostraralertasconfoco("Ingresar Nro Expediente","#s5_inp_exp");return false;}
        if($("#s5_inp_reso").val()==""){mostraralertasconfoco("Ingresar Nro Resolución","#s5_inp_reso");return false;}
        if($("#s5_inp_fechres").val()==""){mostraralertasconfoco("Ingresar Fecha Resolución","#s5_inp_fechres");return false;}
        if($("#s5_inp_anini").val()==""){mostraralertasconfoco("Ingresar Año de inicio","#s5_inp_anini");return false;}
        if($("#s5_inp_anfin").val()==""){mostraralertasconfoco("Ingresar Año de Fin","#s5_inp_anfin");return false;}
        
        
        MensajeDialogLoadAjax('s5', '.:: Guardando ...');
        $.ajax({url: 'pensionista_predios/create',
        type: 'GET',
        data:{condi:$("#s5_sel_condi").val(),basleg:$("#s5_inp_basleg").val(),exp:$("#s5_inp_exp").val(),
            reso:$("#s5_inp_reso").val(),fechreso:$("#s5_inp_fechres").val(),anini:$("#s5_inp_anini").val(),
            anfin:$("#s5_inp_anfin").val(),id_pre:Id_pre},
        success: function(r) 
        {
            
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            MensajeDialogLoadAjaxFinish('s5');
            $("#btn_s5_delpen").show();
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('s5');
            console.log('error');
            console.log(data);
        }
        });
    }
    function  clickdelPensi()
    {
        Id_pre=$('#dlg_idpre').val();
        MensajeDialogLoadAjax('s5', '.:: Eliminando ...');
        $.ajax({
            url: 'pensionista_predios/destroy',
            type: 'post',
            data: {_method: 'delete', _token:$("#btn_s5_delpen").data('token'),id:Id_pre},
            success: function(r) 
            {
                $("#s5_sel_condi,#s5_inp_basleg,#s5_inp_exp,#s5_inp_reso,#s5_inp_fechres,#s5_inp_anini,#s5_inp_anfin").val("");
                $("#btn_s5_delpen").hide();
                MensajeAlerta("Se Eliminó Correctamente","Su Registro Fue eliminado Correctamente...",4000)
                MensajeDialogLoadAjaxFinish('s5');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('s5');
                console.log('error');
                console.log(data);
            }
        });
    }
    function callchangeoption(input,tip)
    {
        $("#"+input+"_des").val($("#"+input+" option:selected").attr("descri"));
        if(tip==1)
        {
            $("#dlg_inp_aranc").val($("#"+input+" option:selected").attr("aran"))
            validarvalter();
            
        }
    }
    
    function validarvalter()
    {
        if($("#dlg_inp_aranc").val()==""||$("#dlg_inp_areter").val()==""){$("#dlg_inp_valterr").val(0);return false;}
        $("#dlg_inp_valterr").val($("#dlg_inp_aranc").val()*(parseFloat($("#dlg_inp_areter").val())+parseFloat($("#dlg_inp_arecomter").val())));
    }
    autocompletar=0;
    function auto_input(textbox,url,extra){
        if(autocompletar==0)
        {
            $.ajax({
                   type: 'GET',
                   url: url,
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
                                     if(extra==2)
                                     {
                                        $("#rinst_inp_undmed").val(ui.item.und);
                                     }
                                      return false;
                              }   
                          });             
                    }
            });
        }
}
    function auto_select(sel_input,url,valor)
    {
        MensajeDialogLoadAjax(sel_input, '.:: Cargando ...');
        $("#"+sel_input).html("");
        $.ajax({
            type: 'GET',
            url: url,
            data:{sec:$("#dlg_sec").val(),mzna:$("#dlg_mzna").val()},
            success: function(data){               
                for (var i=0; i < data.length; i++)
                {
                    $("#"+sel_input).append($('<option>',{value:data[i].id_via,text: data[i].nom_via,descri:data[i].cod_via, aran:data[i].val_ara}));
                } 
                MensajeDialogLoadAjaxFinish(sel_input);
                $("#"+sel_input).val(valor);
                if(valor==0)
                {
                    callchangeoption(sel_input,1);
                }
                else
                {
                    $("#"+sel_input+"_des").val($("#"+sel_input+" option:selected").attr("descri"));
                }
             }
     });
}
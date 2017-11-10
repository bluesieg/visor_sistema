function verificatipodoc()
{
    if($("#seltipdoc").val()==2)
    {
        $("#show_razon").show();
        $("#show_nombres").hide();
        $("#dlg_contrib_apes, #dlg_contrib_nom").val("");
    }
    else
    {
        $("#show_razon").hide();
        $("#show_nombres").show();
        $("#dlg_contrib_razon").val("");
    }
}
function fn_crear_dlg()
{
    
    $("#dlg_new_contri").dialog({
        autoOpen: false, modal: true, width: 900, 
        show:{ effect: "explode", duration: 500},
        hide:{ effect: "explode", duration: 800}, resizable: false,
        title: "<div class='widget-header'><h4><span class='widget-icon'> <i class='fa fa-align-justify'></i> </span> Nuevo Contribuyente</h4></div>",
        buttons: [
            {
                id:"btnsave",
                html: '<span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>Grabar Contribuyente',
                "class": "btn btn-labeled bg-color-green txt-color-white",
                click: function () {savecontrib(1);}
            },
            {
                id:"btnmod",
                html: '<span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>Modificar Contribuyente',
                "class": "btn btn-labeled bg-color-blue txt-color-white",
                click: function () {savecontrib(2);}
            },

            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
        }).dialog('open');
        $("#btnsave").show();
        $("#btnmod").hide();
}
function fn_new_archi_contrib()
{
    verificatipodoc();
   fn_crear_dlg();
   limpiar_arch_contrib(0,0,0);
    
}
function fn_mod_archi_contrib()
{
    fn_crear_dlg();
    $("#btnsave").hide();
    $("#btnmod").show();
    Id=$('#table_Contribuyentes').jqGrid ('getGridParam', 'selrow');
    MensajeDialogLoadAjax('dlg_new_contri', '.:: CARGANDO ...');
        $.ajax({url: 'archi_contribuyentes/'+Id,
        type: 'GET',
        success: function(r) 
        {
            limpiar_arch_contrib(r[0].dpto,r[0].id_prov,r[0].id_dist);
            $("#dlg_contrib_id").val(r[0].id_contrib);
            $("#seltipdoc").val(r[0].tip_documento);
            $("#dlg_nro_doc").val(r[0].nro_documento);
            $("#dlg_contrib_apes,#dlg_contrib_razon").val(r[0].nombres);
            $("#dlg_fec_nac").val(r[0].fch_nac);
            $("#dlg_domicilio").val(r[0].domicilio);
            $("#dlg_obs").val(r[0].observaciones);
            $("#dlg_num_exp").val(r[0].nro_expediente);
            verificatipodoc();
            MensajeDialogLoadAjaxFinish('dlg_new_contri');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_new_contri');
            console.log('error');
            console.log(data);
        }
        });
    
}
function limpiar_arch_contrib(dep,prov,dis)
{
    if(dep==0)
    {
        $("#contrib_dpto").val("04");
        llenar_combo_prov('contrib_prov', "04");
        llenar_combo_dist('contrib_dist', $("#contrib_prov").val());
    }
    else
    {
        $("#contrib_dpto").val(dep);
        llenar_combo_prov('contrib_prov', dep);
        $("#contrib_prov").val(prov);
        setTimeout(function(){
        $("#contrib_dist").val(dis);       
        }, 1500);
        
    }
    
    $("#seltipdoc,#dlg_contrib_id").val(0);
    $("#dlg_nro_doc,#dlg_contrib_apes,#dlg_contrib_nom,#dlg_domicilio,#dlg_obs,#dlg_num_exp,#dlg_contrib_razon").val("");
    
}

function savecontrib(tip)
{
    if(tip==2&&$("#per_edit").val()==0)
    {
        sin_permiso();
        return false;
    }
    if($("#seltipdoc").val()==2)
    {
        if($("#dlg_contrib_razon").val()==0||$("#dlg_contrib_razon").val()=="")
        {
            mostraralertasconfoco("Ingresar Razón Social","#dlg_contrib_razon");
            return false;
        }
    }
    else
    {
        if($("#dlg_contrib_apes").val()==0||$("#dlg_contrib_apes").val()==""||$("#dlg_contrib_nom").val()==0||$("#dlg_contrib_nom").val()=="")
        {
            mostraralertasconfoco("Ingresar Nombre Contribuyente","#dlg_contrib_apes");
            return false;
        }
    }
    
    if($("#dlg_domicilio").val()==0||$("#dlg_domicilio").val()=="")
    {
        mostraralertasconfoco("Ingresar Domicilio","#dlg_domicilio");
        return false;
    }
    
    if($("#dlg_num_exp").val()==0||$("#dlg_num_exp").val()=="")
    {
        mostraralertasconfoco("Ingresar Expediente","#dlg_num_exp");
        return false;
    }
    if($("#contrib_dist").val()==null||$("#contrib_dist").val()=="select")
    {
        mostraralertasconfoco("Seleccione Distrito","#dis");
        return false;
    }
    MensajeDialogLoadAjax('dlg_new_contri', '.:: Guardando ...');
    $.ajax({url: 'validar_expe_arch',
    type: 'GET',
    data:{exp:$('#dlg_num_exp').val()},
    success: function(r) 
    {
        MensajeDialogLoadAjaxFinish('dlg_new_contri');
        if(r==0)
        {
            texto="Está por Generar Este Contribuyente, Esta seguro que desea continuar?"
        }
        else
        {
            texto="El Expediente, ya fue registrado por el/los Contribuyente/s "+r+"<br>Desea Continuar?"
        }
        $.SmartMessageBox({
            title : "<i class='glyphicon glyphicon-alert' style='color: yellow; margin-right: 20px; font-size: 1.5em;'></i> Confirmación Final!",
            content : texto,
            buttons : '[Cancelar][Aceptar]'
    }, function(ButtonPressed) {
            if (ButtonPressed === "Aceptar") {
                    if(tip==1)
                    {
                        savecontribafter();
                    }
                    else
                    {
                        modcontribafter();
                    }
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
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        MensajeDialogLoadAjaxFinish('dlg_new_contri');
        console.log('error');
        console.log(data);
    }
    });    
    
}
function savecontribafter()
{
    MensajeDialogLoadAjax('dlg_new_contri', '.:: CARGANDO ...');
        $.ajax({url: 'archi_contribuyentes/create',
        type: 'GET',
        data:{tip:$("#seltipdoc").val(),num:$("#dlg_nro_doc").val(),ape:$("#dlg_contrib_apes").val()+$("#dlg_contrib_razon").val(),nom:$("#dlg_contrib_nom").val(),
        dom:$("#dlg_domicilio").val(),obs:$("#dlg_obs").val(),exp:$("#dlg_num_exp").val(),fec:$("#dlg_fec_nac").val(),
        dep:$("#contrib_dpto").val(),prov:$("#contrib_prov").val(),dis:$("#contrib_dist").val()},
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            busqueda(1);
            MensajeDialogLoadAjaxFinish('dlg_new_contri');
            $("#dlg_new_contri").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_new_contri');
            console.log('error');
            console.log(data);
        }
        });
}
function modcontribafter()
{
    MensajeDialogLoadAjax('dlg_new_contri', '.:: CARGANDO ...');
        $.ajax({url: 'archi_contribuyentes/'+$("#dlg_contrib_id").val()+'/edit',
        type: 'GET',
        data:{tip:$("#seltipdoc").val(),num:$("#dlg_nro_doc").val(),ape:$("#dlg_contrib_apes").val()+$("#dlg_contrib_razon").val(),nom:$("#dlg_contrib_nom").val(),
        dom:$("#dlg_domicilio").val(),obs:$("#dlg_obs").val(),exp:$("#dlg_num_exp").val(),fec:$("#dlg_fec_nac").val(),
        dep:$("#contrib_dpto").val(),prov:$("#contrib_prov").val(),dis:$("#contrib_dist").val()},
        success: function(r) 
        {
            MensajeExito("Modificó Correctamente","Su Registro Fue Cambiado con Éxito...",4000);
            busqueda(1);
            MensajeDialogLoadAjaxFinish('dlg_new_contri');
            $("#dlg_new_contri").dialog("close");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_new_contri');
            console.log('error');
            console.log(data);
        }
        });
}

function busqueda(tip)
{
    $("#table_Contribuyentes").jqGrid("clearGridData", true);
    if(tip==1)
    {
        jQuery("#table_Contribuyentes").jqGrid('setGridParam', {url: 'list_arch_contrib?name=0'}).trigger('reloadGrid');
    }
    if(tip==2)
    {
        if($("#vw_contrib_buscar").val()=="")
        {
            mostraralertasconfoco("Ingresar Información del Contribuyente para busqueda","#vw_contrib_buscar"); 
            return false;
        }
        if($("#vw_contrib_buscar").val().length<4)
        {
            mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#vw_contrib_buscar"); 
            return false;
        }
        jQuery("#table_Contribuyentes").jqGrid('setGridParam', {url: 'list_arch_contrib?name='+$("#vw_contrib_buscar").val()}).trigger('reloadGrid');
    }
}
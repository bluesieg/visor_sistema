function buscar_persona(){
    fn_actualizar_grilla('table_Personas','modificar_persona/0?name='+($("#vw_persona_buscar").val()).toUpperCase());
}
function fn_mod_persona()
{
    fn_crear_dlg();
   Id=$('#table_Personas').jqGrid ('getGridParam', 'selrow');
   if(Id==null)
   {
        mostraralertasconfoco('Seleccione Persona','#table_Personas');
        return false;
   }
    MensajeDialogLoadAjax('dlg_mod_persona', '.:: CARGANDO ...');
        $.ajax({url: 'modificar_persona/'+Id,
        type: 'GET',
        success: function(r) 
        {
            $("#dlg_persona_id").val(r[0].id_pers);
            $("#seltipdoc").val(r[0].pers_tip_doc);
            verificatipodoc();
            $("#dlg_nro_doc").val(r[0].pers_nro_doc);
            $("#dlg_pers_apep").val(r[0].pers_ape_pat);
            $("#dlg_pers_apem").val(r[0].pers_ape_mat);
            $("#dlg_pers_nom").val(r[0].pers_nombres);
            $("#dlg_pers_razon").val(r[0].pers_raz_soc);
            MensajeDialogLoadAjaxFinish('dlg_mod_persona');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_mod_persona');
            console.log('error');
            console.log(data);
        }
        });
    
}

function fn_crear_dlg()
{
    
    $("#dlg_mod_persona").dialog({
        autoOpen: false, modal: true, width: 900, 
        show:{ effect: "explode", duration: 500},
        hide:{ effect: "explode", duration: 800}, resizable: false,
        title: "<div class='widget-header'><h4><span class='widget-icon'> <i class='fa fa-align-justify'></i> </span> Modificar Persona</h4></div>",
        buttons: [
            
            {
                id:"btnmod",
                html: '<span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>Modificar Contribuyente',
                "class": "btn btn-labeled bg-color-blue txt-color-white",
                click: function () {savepersona(2);}
            },

            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
        }).dialog('open');
       
}
function savepersona(tip)
{
    if(tip==2&&$("#per_edit").val()==0)
    {
        sin_permiso();
        return false;
    }
    if($("#seltipdoc").val()=='00')
    {
        if($("#dlg_pers_razon").val()==0||$("#dlg_pers_razon").val()=="")
        {
            mostraralertasconfoco("Ingresar Razón Social","#dlg_pers_razon");
            return false;
        }
    }
    else
    {
        if($("#dlg_pers_apep").val()==0||$("#dlg_pers_apep").val()==""||$("#dlg_pers_apem").val()==0||$("#dlg_pers_apem").val()==""||$("#dlg_pers_nom").val()==0||$("#dlg_pers_nom").val()=="")
        {
            mostraralertasconfoco("Ingresar Nombre Completo de Persona","#dlg_pers_apep");
            return false;
        }
    }
    MensajeDialogLoadAjax('dlg_mod_persona', '.:: Guardando ...');
    $.ajax({url: 'modificar_persona/'+$('#dlg_persona_id').val()+'/edit',
    type: 'GET',
    data:{tipdoc:$('#seltipdoc').val(),
        nrodoc:$('#dlg_nro_doc').val(),
        apep:$('#dlg_pers_apep').val(),
        apem:$('#dlg_pers_apem').val(),
        nom:$('#dlg_pers_nom').val(),
        razsoc:$('#dlg_pers_razon').val()},
        
    success: function(r) 
    {
        MensajeExito("Se modifico Correctamente","Su Registro Fue Modificado con Éxito...",4000);
               fn_actualizar_grilla('table_Personas','modificar_persona/0?name=0');

            MensajeDialogLoadAjaxFinish('dlg_mod_persona');
            $("#dlg_mod_persona").dialog("close");

  
    },
    error: function(data) {
        mostraralertas("hubo un error, Comunicar al Administrador");
        MensajeDialogLoadAjaxFinish('dlg_new_contri');
        console.log('error');
        console.log(data);
    }
    });    
    
}
function verificatipodoc()
{
    if($("#seltipdoc").val()=='00')
    {
        $("#show_razon").show();
        $("#show_nombres").hide();
        $("#dlg_pers_apep, #dlg_pers_apem,#dlg_pers_nom").val("");
    }
    else
    {
        $("#show_razon").hide();
        $("#show_nombres").show();
        $("#dlg_pers_razon").val("");
    }
}
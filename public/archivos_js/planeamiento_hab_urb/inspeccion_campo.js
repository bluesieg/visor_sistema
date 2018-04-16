
function actualizar_ins_campo()
{
   Id=$('#table_inspeccion_campo').jqGrid ('getGridParam', 'selrow');
    if($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'ide')==null)
    {
        MensajeAlerta("Crear Nueva Inspeccion","Antes de modificar.",4000);
        return false;
    } 
    else
    {
        create_dialog_ins();
        $("#btn_save_acta_ins_campo").hide();
        $("#btn_mod_acta_ins_campo").show();
        
        MensajeDialogLoadAjax('dlg_nuevo_acta_ins', '.:: Cargando ...');
        $.ajax({url: 'inspeccion_efectiva/'+$('#table_inspeccion_campo').jqGrid ('getCell', Id, 'ide'),
        type: 'GET',
        success: function(r) 
        {
            $("#inp_cod_expe_ins").val($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'nro_expediente'));
            $("#inp_solicitante_ins").val($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'gestor'));
            $("#inp_hab_urb_ins").val($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'nomb_hab_urba'));
            $("#inp_super_mzna_ins").val(r[0].sup_mzna);
            $("#inp_mzna_ins").val(r[0].mzna);
            $("#inp_lote_ins").val(r[0].lote);
            $("#inp_sector_ins").val(r[0].sector);
            $("#inp_zona_ins").val(r[0].zona);
            
            $("#hidden_inp_cod_expe_ins").val(r[0].id_reg_exp);
            $("#inp_fecha_inspec").val(r[0].fch_inspeccion);
            $("#inp_tipo_suelo").val(r[0].tipo_suelo);
            if(r[0].zonificacion==1)
                $('#inp_zonificacion_ins').prop('checked', true);
            else
                 $('#inp_zonificacion_ins').prop('checked', false);
            if(r[0].planos_mpa==1)
                $('#inp_planos_ins').prop('checked', true);
            else
                 $('#inp_planos_ins').prop('checked', false);
            if(r[0].res_habil_urbana==1)
                $('#inp_res_hab_ins').prop('checked', true);
            else
                 $('#inp_res_hab_ins').prop('checked', false);
                
            $('#inp_nro_pers').val(r[0].nro_de_personas);
            $('#inp_nro_habita').val(r[0].nro_de_habitaciones);
            
            if(r[0].f_a_tarima==1)
                $('#inp_tarima').prop('checked', true);
            else
                 $('#inp_tarima').prop('checked', false);
            if(r[0].f_a_colchon==1)
                $('#inp_colchon').prop('checked', true);
            else
                 $('#inp_colchon').prop('checked', false);
            if(r[0].f_a_comoda==1)
                $('#inp_comoda').prop('checked', true);
            else
                 $('#inp_comoda').prop('checked', false);
            if(r[0].f_a_ropero==1)
                $('#inp_ropero').prop('checked', true);
            else
                 $('#inp_ropero').prop('checked', false);
            if(r[0].f_a_ropa_canasto==1)
                $('#inp_ropa').prop('checked', true);
            else
                 $('#inp_ropa').prop('checked', false);
            if(r[0].f_a_aparador==1)
                $('#inp_aparador').prop('checked', true);
            else
                 $('#inp_aparador').prop('checked', false);
            if(r[0].f_a_televisor==1)
                $('#inp_tv').prop('checked', true);
            else
                 $('#inp_tv').prop('checked', false);
            if(r[0].f_a_radio_e_sonido==1)
                $('#inp_radio').prop('checked', true);
            else
                 $('#inp_radio').prop('checked', false);
            if(r[0].f_c_cocina==1)
                $('#inp_cocina').prop('checked', true);
            else
                 $('#inp_cocina').prop('checked', false);
            if(r[0].f_c_balon_gas==1)
                $('#inp_gas').prop('checked', true);
            else
                 $('#inp_gas').prop('checked', false);
            if(r[0].f_c_mesas==1)
                $('#inp_mesas').prop('checked', true);
            else
                 $('#inp_mesas').prop('checked', false);
            if(r[0].f_c_sillas==1)
                $('#inp_sillas').prop('checked', true);
            else
                 $('#inp_sillas').prop('checked', false);
            if(r[0].f_c_viveres==1)
                $('#inp_viveres').prop('checked', true);
            else
                 $('#inp_viveres').prop('checked', false);
            if(r[0].f_c_ollas==1)
                $('#inp_ollas').prop('checked', true);
            else
                 $('#inp_ollas').prop('checked', false);
            if(r[0].f_c_repostero==1)
                $('#inp_repostero').prop('checked', true);
            else
                 $('#inp_repostero').prop('checked', false);
            if(r[0].f_c_servicios==1)
                $('#inp_servicios').prop('checked', true);
            else
                 $('#inp_servicios').prop('checked', false);
            if(r[0].f_p_cordeles==1)
                $('#inp_cordeles').prop('checked', true);
            else
                $('#inp_cordeles').prop('checked', false);
            if(r[0].f_p_baldes_lavadores==1)
                $('#inp_baldes').prop('checked', true);
            else
                $('#inp_baldes').prop('checked', false);
            if(r[0].fp_bidones_agua==1)
                $('#inp_bidones').prop('checked', true);
            else
                $('#inp_bidones').prop('checked', false);
            if(r[0].f_p_lavatorio==1)
                $('#inp_lavatorio').prop('checked', true);
            else
                $('#inp_lavatorio').prop('checked', false);
            if(r[0].f_p_corral_mascotas==1)
                $('#inp_corral').prop('checked', true);
            else
                $('#inp_corral').prop('checked', false);
            if(r[0].f_p_plantas==1)
                $('#inp_plantas').prop('checked', true);
            else
                $('#inp_plantas').prop('checked', false);
            if(r[0].f_p_silo==1)
                $('#inp_silo').prop('checked', true);
            else
                $('#inp_silo').prop('checked', false);
            if(r[0].f_p_bano==1)
                $('#inp_baño').prop('checked', true);
            else
                $('#inp_baño').prop('checked', false);

            $('#inp_area_pred_ins').val(r[0].g_area_aprox);
            $('#inp_linea_frente_ins').val(r[0].g_lin_rec_frent);
            $('#inp_linea_der_ins').val(r[0].g_lin_rec_derecha);
            $('#inp_linea_izq_ins').val(r[0].g_lin_rec_izq);
            $('#inp_linea_fondo_ins').val(r[0].g_lin_rec_fondo);
            $('#inp_por_frente_ins').val(r[0].por_el_frente);
            $('#inp_por_der_ins').val(r[0].por_la_derecha);
            $('#inp_por_izq_ins').val(r[0].por_la_izquierda);
            $('#inp_por_fondo_ins').val(r[0].por_el_fondo);
            $('#inp_obs_ins').text(r[0].observaciones);
            $('#inp_nom_vec1').text(r[0].vecin_01_apenom);
            
            $('#inp_dni_vec1').text(r[0].vecin_01_dni);
            $('#inp_dir_vec1').text(r[0].vecin_01_direcc);
            $('#inp_nom_vec2').text(r[0].vecin_02_apenom);
            $('#vecin_02_dni').text(r[0].inp_dni_vec2);
            $('#inp_dir_vec2').text(r[0].vecin_02_direcc);
            $('#inp_nom_vec3').text(r[0].vecin_03_apenom);
            $('#inp_dni_vec3').text(r[0].vecin_03_dni);
            $('#inp_dir_vec3').val(r[0].vecin_03_direcc);
            
            if(r[0].tipo_cerco1==1)
                $('#inp_piedra_cerco').prop('checked', true);
            else
                $('#inp_piedra_cerco').prop('checked', false);
            if(r[0].tipo_cerco2==1)
                $('#inp_sillar_cerco').prop('checked', true);
            else
                $('#inp_sillar_cerco').prop('checked', false);
            if(r[0].tipo_cerco3==1)
                $('#inp_bloqueta_cerco').prop('checked', true);
            else
                $('#inp_bloqueta_cerco').prop('checked', false);
            if(r[0].tipo_cerco4==1)
                $('#inp_ladrillo_cerco').prop('checked', true);
            else
                $('#inp_ladrillo_cerco').prop('checked', false);
            if(r[0].tipo_cerco5==1)
                $('#inp_concreto_cerco').prop('checked', true);
            else
                $('#inp_concreto_cerco').prop('checked', false);
            if(r[0].tipo_cerco6==1)
                $('#inp_estera_cerco').prop('checked', true);
            else
                $('#inp_estera_cerco').prop('checked', false);
            if(r[0].habitacion1==1)
                $('#inp_sillar_hab').prop('checked', true);
            else
                $('#inp_sillar_hab').prop('checked', false);
            if(r[0].habitacion2==1)
                $('#inp_bloqueta_hab').prop('checked', true);
            else
                $('#inp_bloqueta_hab').prop('checked', false);
            if(r[0].habitacion3==1)
                $('#in_ladrillo_hab').prop('checked', true);
            else
                $('#in_ladrillo_hab').prop('checked', false);
            if(r[0].habitacion4==1)
                $('#inp_concreto_hab').prop('checked', true);
            else
                $('#inp_concreto_hab').prop('checked', false);
            if(r[0].habitacion5==1)
                $('#inp_fabricado_hab').prop('checked', true);
            else
                $('#inp_fabricado_hab').prop('checked', false);
            if(r[0].habitacion6==1)
                $('#inp_dry_hab').prop('checked', true);
            else
                $('#inp_dry_hab').prop('checked', false);
            if(r[0].tipo_de_techo1==1)
                $('#inp_calamina').prop('checked', true);
            else
                $('#inp_calamina').prop('checked', false);
            if(r[0].tipo_de_techo2==1)
                $('#inp_madera').prop('checked', true);
            else
                $('#inp_madera').prop('checked', false);
            if(r[0].tipo_de_techo3==1)
                $('#inp_mdf').prop('checked', true);
            else
                $('#inp_mdf').prop('checked', false);
            if(r[0].tipo_de_techo4==1)
                $('#inp_concreto').prop('checked', true);
            else
                $('#inp_concreto').prop('checked', false);
            if(r[0].tipo_de_techo5==1)
                $('#inp_plasticos').prop('checked', true);
            else
                $('#inp_plasticos').prop('checked', false);
            if(r[0].servicios1==1)
                $('#inp_pileta').prop('checked', true);
            else
                $('#inp_pileta').prop('checked', false);
            if(r[0].servicios2==1)
                $('#inp_agua_med').prop('checked', true);
            else
                $('#inp_agua_med').prop('checked', false);
            if(r[0].servicios3==1)
                $('#inp_luz_colec').prop('checked', true);
            else
                $('#inp_luz_colec').prop('checked', false);
            if(r[0].servicios4==1)
                $('#inp_luz_med').prop('checked', true);
            else
                $('#inp_luz_med').prop('checked', false);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_acta_ins');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_acta_ins');
        }
        }); 
    }
}
aux_foto=0;
function create_dialog_ins()
{
    $("#dlg_nuevo_acta_ins").dialog({
            autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  ACTA DE INSPECCIÓN EFECTIVA :.</h4></div>",
            buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-success bg-color-green",
                "id":"btn_save_acta_ins_campo",
                click: function () {
                        guardar_acta_ins_campo(1);
                }
            }, {
                html: "<i class='fa fa-save'></i>&nbsp; Modificar",
                "class": "btn btn-success bg-color-blue",
                "id":"btn_mod_acta_ins_campo",
                click: function () {
                        guardar_acta_ins_campo(2);
                }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {
                    $(this).dialog("close");
                }
            }],
        });
        $("#dlg_nuevo_acta_ins").dialog('open');
}
function crear_ins_campo()
{
    Id=$('#table_inspeccion_campo').jqGrid ('getGridParam', 'selrow');
    if($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'ide')>0)
    {
        MensajeAlerta("Ya Existe Inspenccion","Ya fue creado un registro...",4000);
        return false;
    }
    if(Id)
    {
        $("#hidden_inp_cod_expe_ins").val($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'id_reg_exp'));
        $("#inp_cod_expe_ins").val($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'nro_expediente'));
        $("#inp_solicitante_ins").val($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'gestor'));
        $("#inp_hab_urb_ins").val($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'nomb_hab_urba'));
        
        
        create_dialog_ins();
        $("#btn_save_acta_ins_campo").show();
        $("#btn_mod_acta_ins_campo").hide();
        
     }
     else
    {
        mostraralertasconfoco("No Hay Expediente Seleccionado","#table_inspeccion_campo");
    }
    if(aux_foto==0)
    {
        aux_foto=1;
        $('#file1').change(function(e) {
        readFile(e,this,1);
        });
        $('#file2').change(function(e) {
        readFile(e,this,2);
        });
        $('#file3').change(function(e) {
        readFile(e,this,3);
        });
        $('#file4').change(function(e) {
        readFile(e,this,4);
        });
    }
}

function guardar_acta_ins_campo(modo)
{
 
    if(modo==1)
        url='inspeccion_efectiva/create'; 
    MensajeDialogLoadAjax('dlg_nuevo_acta_ins', '.:: Cargando ...');
        $.ajax({url: url,
        type: 'GET',
        data:{  
            id_reg_exp:$("#hidden_inp_cod_expe_ins").val(),
            fch_inspeccion:$("#inp_fecha_inspec").val(),
            tipo_suelo:$("#inp_tipo_suelo").val(),
            zonificacion:$('#inp_zonificacion_ins').prop('checked') ? 1 : 0,
            planos_mpa:$('#inp_planos_ins').prop('checked') ? 1 : 0,
            res_habil_urbana:$('#inp_res_hab_ins').prop('checked') ? 1 : 0,
            nro_de_personas:$('#inp_nro_pers').val(),
            nro_de_habitaciones:$('#inp_nro_habita').val(),
            f_a_tarima:$('#inp_tarima').prop('checked') ? 1 : 0,
            f_a_colchon:$('#inp_colchon').prop('checked') ? 1 : 0,
            f_a_comoda:$('#inp_comoda').prop('checked') ? 1 : 0,
            f_a_ropero:$('#inp_ropero').prop('checked') ? 1 : 0,
            f_a_ropa_canasto:$('#inp_ropa').prop('checked') ? 1 : 0,
            f_a_aparador:$('#inp_aparador').prop('checked') ? 1 : 0,
            f_a_televisor:$('#inp_tv').prop('checked') ? 1 : 0,
            f_a_radio_e_sonido:$('#inp_radio').prop('checked') ? 1 : 0,
            f_c_cocina:$('#inp_cocina').prop('checked') ? 1 : 0,
            f_c_balon_gas:$('#inp_gas').prop('checked') ? 1 : 0,
            f_c_mesas:$('#inp_mesas').prop('checked') ? 1 : 0,
            f_c_sillas:$('#inp_sillas').prop('checked') ? 1 : 0,
            f_c_viveres:$('#inp_viveres').prop('checked') ? 1 : 0,
            f_c_ollas:$('#inp_ollas').prop('checked') ? 1 : 0,
            f_c_repostero:$('#inp_repostero').prop('checked') ? 1 : 0,
            f_c_servicios:$('#inp_servicios').prop('checked') ? 1 : 0,
            f_p_cordeles:$('#inp_cordeles').prop('checked') ? 1 : 0,
            f_p_baldes_lavadores:$('#inp_baldes').prop('checked') ? 1 : 0,
            fp_bidones_agua:$('#inp_bidones').prop('checked') ? 1 : 0,
            f_p_lavatorio:$('#inp_lavatorio').prop('checked') ? 1 : 0,
            f_p_corral_mascotas:$('#inp_corral').prop('checked') ? 1 : 0,
            f_p_plantas:$('#inp_plantas').prop('checked') ? 1 : 0,
            f_p_silo:$('#inp_silo').prop('checked') ? 1 : 0,
            f_p_bano:$('#inp_baño').prop('checked') ? 1 : 0,
            g_area_aprox:$('#inp_area_pred_ins').val(),
            g_lin_rec_frent:$('#inp_linea_frente_ins').val(),
            g_lin_rec_derecha:$('#inp_linea_der_ins').val(),
            g_lin_rec_izq:$('#inp_linea_izq_ins').val(),
            g_lin_rec_fondo:$('#inp_linea_fondo_ins').val(),
            por_el_frente:$('#inp_por_frente_ins').val(),
            por_la_derecha:$('#inp_por_der_ins').val(),
            por_la_izquierda:$('#inp_por_izq_ins').val(),
            por_el_fondo:$('#inp_por_fondo_ins').val(),
            observaciones:$('#inp_obs_ins').text(),
            vecin_01_apenom:$('#inp_nom_vec1').val(),
            vecin_01_dni:$('#inp_dni_vec1').val(),
            vecin_01_direcc:$('#inp_dir_vec1').val(),
            vecin_02_apenom:$('#inp_nom_vec2').val(),
            vecin_02_dni:$('#inp_dni_vec2').val(),
            vecin_02_direcc:$('#inp_dir_vec2').val(),
            vecin_03_apenom:$('#inp_nom_vec3').val(),
            vecin_03_dni:$('#inp_dni_vec3').val(),
            vecin_03_direcc:$('#inp_dir_vec3').val(),
            tipo_cerco1:$('#inp_piedra_cerco').prop('checked') ? 1 : 0,
            tipo_cerco2:$('#inp_sillar_cerco').prop('checked') ? 1 : 0,
            tipo_cerco3:$('#inp_bloqueta_cerco').prop('checked') ? 1 : 0,
            tipo_cerco4:$('#inp_ladrillo_cerco').prop('checked') ? 1 : 0,
            tipo_cerco5:$('#inp_concreto_cerco').prop('checked') ? 1 : 0,
            tipo_cerco6:$('#inp_estera_cerco').prop('checked') ? 1 : 0,
            habitacion1:$('#inp_sillar_hab').prop('checked') ? 1 : 0,
            habitacion2:$('#inp_bloqueta_hab').prop('checked') ? 1 : 0,
            habitacion3:$('#in_ladrillo_hab').prop('checked') ? 1 : 0,
            habitacion4:$('#inp_concreto_hab').prop('checked') ? 1 : 0,
            habitacion5:$('#inp_fabricado_hab').prop('checked') ? 1 : 0,
            habitacion6:$('#inp_dry_hab').prop('checked') ? 1 : 0,
            tipo_de_techo1:$('#inp_calamina').prop('checked') ? 1 : 0,
            tipo_de_techo2:$('#inp_madera').prop('checked') ? 1 : 0,
            tipo_de_techo3:$('#inp_mdf').prop('checked') ? 1 : 0,
            tipo_de_techo4:$('#inp_concreto').prop('checked') ? 1 : 0,
            tipo_de_techo5:$('#inp_plasticos').prop('checked') ? 1 : 0,
            servicios1:$('#inp_pileta').prop('checked') ? 1 : 0,
            servicios2:$('#inp_agua_med').prop('checked') ? 1 : 0,
            servicios3:$('#inp_luz_colec').prop('checked') ? 1 : 0,
            servicios4:$('#inp_luz_med').prop('checked') ? 1 : 0
        },
        success: function(r) 
        {
            grabarfotos(r);
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
        }
        }); 
}
function grabarfotos(id)
{
    var form= new FormData($("#FormularioFiles")[0]);
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'create_fotos/'+id,
        type: 'POST',  
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_acta_ins');
            $("#dlg_nuevo_acta_ins").dialog('close');
            jQuery("#table_inspeccion_campo").jqGrid('setGridParam', {url: 'datos_predio?grid=2'}).trigger('reloadGrid');
       
            
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_nuevo_acta_ins');
            console.log('error');
            console.log(data);
        }
        });
}

function envia_verificacion(registro)
{
    Id=$('#table_inspeccion_campo').jqGrid ('getGridParam', 'selrow');
    if($('#table_inspeccion_campo').jqGrid ('getCell', Id, 'ide')==0)
    {
        MensajeAlerta("NO Hay Inspección","Cree inspeccion Primero...",4000);
        return false;
    }
    MensajeDialogLoadAjax('table_inspeccion_campo', '.:: Cargando ...');
        $.ajax({url: 'registro_expedientes/'+registro+'/edit',
        type: 'GET',
        data:{  
            estado:5
        },
        success: function(r) 
        {
            MensajeExito("Envió Correctamente","Su Registro Fue Enviado con Éxito...",4000);
            MensajeDialogLoadAjaxFinish('table_inspeccion_campo');
            jQuery("#table_inspeccion_campo").jqGrid('setGridParam', {url: 'datos_predio?grid=2'}).trigger('reloadGrid');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('table_inspeccion_campo');
        }
        }); 
}

function borrar_foto(num)
{
    $("#file"+num).val("");
    $("#textfile"+num).val("");
    $("#inp_foto_pred"+num).html("");
}
numerodivfoto=0;
function readFile(e,esto,num)
{
    numerodivfoto=num;
    esto.parentNode.nextSibling.value = esto.value;
    var file = e.target.files[0],
            imageType = /image.*/;
    if (!file.type.match(imageType))
       return;
   var reader = new FileReader();
    reader.onload = fileOnload;
    reader.readAsDataURL(file);
}
function fileOnload(e) {
    var result=e.target.result;
    $("#inp_foto_pred"+numerodivfoto).html("<img src='"+result+"' style='width: 100%'/>");

        
}
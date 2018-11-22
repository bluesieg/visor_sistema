<?php

Route::get('/', function () {
    return view("auth/login");
});

Route::get('home', 'mapa\MapaController@index');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');



Route::get('autocomplete_hab_urba', 'General@autocomplete_hab_urb'); //autocomplentar habilitaciones urbanas
Route::group(['middleware' => 'auth'], function() {
 
    Route::get('$',function(){ echo 0;});//url auxiliar
    /*************************************** - PERMISOS - *************************************** */
    Route::group(['namespace' => 'permisos'], function() {
        Route::resource('modulos', 'ModulosController');
        Route::resource('sub_modulos', 'Sub_ModulosController');
        Route::resource('permisos', 'Permisos_Modulo_UsuarioController');
    });
    /******************** ********    MAP CONTROLLER   ******************  **********/
    Route::group(['namespace'=>'map'],function(){
        Route::get('cartografia', 'MapController@index')->name('home');
        Route::get('getlimites', 'MapController@get_limites')->name('get.limites');
        Route::get('getsectores', 'MapController@get_sectores')->name('get.sectores');
        Route::get('getmznas', 'MapController@get_manzanas')->name('get.manzanas');
        Route::get('gethab_urb', 'MapController@get_hab_urb');
        Route::post('geogetmznas_x_sector', 'MapController@geogetmznas_x_sector');
        Route::post('get_centro_sector', 'MapController@get_centro_sector');
        Route::post('mznas_x_sector', 'MapController@mznas_x_sector');
        Route::post('get_lotes_x_sector', 'MapController@get_lotes_x_sector');
        Route::post('get_predios_rentas','MapController@get_predios_rentas');
        Route::get('getagencias', 'MapController@get_agencias');
        Route::get('getagencias_polygono', 'MapController@get_agencias_polygono');
        Route::get('getcamaras', 'MapController@get_camaras');
        Route::get('getvias_lineas', 'MapController@get_vias');
        Route::get('get_z_urbana', 'MapController@get_z_urbana');
        Route::get('get_z_agricola', 'MapController@get_z_agricola');
        Route::get('get_z_eriaza', 'MapController@get_z_eriaza');
        Route::get('get_aportes', 'MapController@get_aportes');
    });
    Route::group(['namespace' => 'mapa'], function() {
        Route::resource('mapa_cris', 'MapaController');
        Route::get('mapa_cris_getlimites', 'MapaController@get_limites');
        Route::get('mapa_cris_getpdmzonificacion', 'MapaController@get_pdm_zonificacion');
        Route::get('getpdm_plan_vial', 'MapaController@get_pdm_plan_vial');
        Route::get('getcolegios', 'MapaController@get_colegios');
        Route::get('gethospitales', 'MapaController@get_hospitales');
        Route::get('getcomisarias', 'MapaController@get_comisarias');
        Route::get('mapa_cris_getquebradas', 'MapaController@get_quebradas');
        Route::get('mapa_cris_gettopografia', 'MapaController@get_topografia');
        Route::get('get_cotas', 'MapaController@get_carta_cotas');
        Route::get('get_cua', 'MapaController@get_carta_cua');
        Route::get('get_curvas', 'MapaController@get_carta_curvas');
        Route::get('get_lagos', 'MapaController@get_carta_lagos');
        Route::get('get_rios', 'MapaController@get_carta_rios');
        Route::get('get_espe_urba', 'MapaController@get_espeurba');
        Route::get('get_extrac_pg', 'MapaController@get_extrac_pg');
        Route::get('get_extrac_pl', 'MapaController@get_extrac_pl');
        Route::get('get_extrac_pt', 'MapaController@get_extrac_pt');
        Route::get('get_limit_txt', 'MapaController@get_limit_txt');
        Route::get('get_limit_veci', 'MapaController@get_limit_veci');
        Route::get('get_puntosgeo', 'MapaController@get_puntosgeo');
        Route::get('get_puntosgeo_control', 'MapaController@get_puntosgeo_control');
        Route::get('get_lotes_rurales', 'MapaController@get_lotes_rurales');
        Route::get('get_leyenda_aportes', 'MapaController@leyenda_aportes');
        Route::get('get_leyenda_hab_urb', 'MapaController@leyenda_hab_urb');
        Route::get('gethab_urb_by_id/{id}', 'MapaController@get_hab_urb');
        Route::get('get_lotes_x_hab_urb', 'MapaController@get_lotes_x_hab_urb');
        Route::get('get_map_constancias/{anio}/{hab_urb}', 'MapaController@get_constancias');
         Route::get('get_map_mod_hab_urb/{color}', 'MapaController@get_map_mod_hab_urb');

    });
    Route::group(['namespace' => 'adm_tributaria'], function() {
        Route::get('traefoto_lote/{sec}/{mzna}/{lote}','PredioController@getfoto');
        Route::get('traefoto_lote_id/{lote}','PredioController@getfotoid');
        Route::get('traerlote/{lote}/{anio}','PredioController@getloteid');
        
    });
     Route::group(['namespace' => 'planeamiento_hab_urb'], function() {
         //////expedientes
        Route::resource('registro_expedientes','RegistroExpedientesController');
        Route::get('getExpedientes','RegistroExpedientesController@getExpedientes');
        Route::get('traer_datos/{id}','RegistroExpedientesController@traer_datos');
        Route::resource('registro_datos_lote','RegistroDatosLoteController');
        ///// datos predios
        Route::resource('datos_predio','Datos_PredioController');
        Route::resource('registro_datos_lote','RegistroDatosLoteController');
        /////inspeccion
        Route::resource('inspeccion_efectiva','Insp_CampoController');
        Route::post('create_fotos/{id}', 'Insp_CampoController@create_fotos');
       
        
        Route::resource('registro_control_calidad','ControlCalidadController');
        Route::get('getExpedientes_ControlCalidad','ControlCalidadController@getExpedientes_ControlCalidad');
        Route::get('asignar_expediente','ControlCalidadController@asignar_expediente');
        Route::get('registrar_notificacion','ControlCalidadController@registrar_notificacion');
        Route::get('actualizar_expediente','ControlCalidadController@actualizar_expediente');
        Route::get('traer_inspecciones','ControlCalidadController@traer_inspecciones');
        Route::get('recuperar_expediente','ControlCalidadController@recuperar_expediente');
      
        Route::get('get_evaluacion_tecnica','EvaluacionTecnicaController@get_evaluacion_tecnica');
        Route::get('actualizar_informe','EvaluacionTecnicaController@actualizar_informe');
        Route::get('registrar_notificacion_eva_tec','EvaluacionTecnicaController@registrar_notificacion_eva_tec');
        Route::get('rep_constancia/{id}','EvaluacionTecnicaController@rep_constancia');
        Route::get('genera_qr','EvaluacionTecnicaController@genera_qr');
        
      
        Route::resource('entrega_constancia','EntregaConstanciaController');
        Route::get('insertar_datos','EntregaConstanciaController@insertar_datos');

        Route::get('reporte_constancia','EntregaConstanciaController@reporte_constancia'); //reporte constancia de posesion

        Route::resource('consultar_expedientes','ConsultaExpedientesController');
        Route::get('buscar_expediente','ConsultaExpedientesController@buscar_expediente');
        
         //////inspectoress
        Route::resource('mantenimiento_inspectores','MantenimientoInspectoresController');
        Route::get('getInspectores','MantenimientoInspectoresController@getInspectores');
         
        //escaneo
        
        Route::post('callpdf', 'Documentos_AjuntosController@get_pdf');
        Route::post('create_scaneo', 'Documentos_AjuntosController@create');

    });
    
    
    Route::group(['namespace' => 'licencias_edificacion'], function() {
        Route::resource('procedimientos','ProcedimientoController');
        Route::get('get_procedimientos','ProcedimientoController@get_procedimientos');
        
        Route::resource('requisitos','RequisitoController');
        Route::get('get_requisitos','RequisitoController@get_requisitos');
        
        Route::resource('recepcion_documentos','RecDocumentosController');
        Route::get('get_documentos','RecDocumentosController@get_documentos');
        
        Route::resource('asignacion','AsignacionController');
        Route::get('get_asignacion','AsignacionController@get_asignacion');
        Route::get('modificar_asignacion','AsignacionController@modificar_asignacion');
        Route::get('buscar_expdiente_asignacion','AsignacionController@buscar_expdiente_asignacion');
        
        
        Route::resource('verificacion_administrativa','VerAdministrativaController');
        Route::get('get_verif_administrativa','VerAdministrativaController@get_verif_administrativa');
        Route::get('buscar_codigo_interno','VerAdministrativaController@buscar_codigo_interno');
        Route::get('buscar_requisitos','VerAdministrativaController@buscar_requisitos');
        Route::get('recuperar_requisitos','VerAdministrativaController@recuperar_requisitos');
        Route::get('cambiar_estado','VerAdministrativaController@cambiar_estado');
        Route::get('estado_verif_admin','VerAdministrativaController@estado_verif_admin');
        Route::get('improcedente_verif_admin','VerAdministrativaController@improcedente_verif_admin');
        Route::get('notificacion_verif_admin','VerAdministrativaController@notificacion_verif_admin');
        Route::get('rep_notificacion_verif_admin/{id_reg_exp}','VerAdministrativaController@rep_notificacion_verif_admin');
        Route::get('notificacion_estado','VerAdministrativaController@notificacion_estado');
        Route::get('agregar_observacion','VerAdministrativaController@agregar_observacion');
        Route::get('actualizar_observaciones','VerAdministrativaController@actualizar_observaciones');
        Route::get('recuperar_multas','VerAdministrativaController@recuperar_multas');
        Route::get('actualizar_expediente_verif_admin','VerAdministrativaController@actualizar_expediente_verif_admin');
        Route::get('agregar_lote_verif_admin','VerAdministrativaController@agregar_lote_verif_admin');
        
        Route::resource('licencias_verificacion_tecnica','VerTecnicaController');
        Route::get('get_verif_tecnica','VerTecnicaController@get_verif_tecnica');
        Route::get('get_revision_expediente','VerTecnicaController@get_revision_expediente');
        Route::get('improcedente_verif_tecnica','VerTecnicaController@improcedente_verif_tecnica');
        Route::get('guardar_resolucion_verificacion_tecnica','VerTecnicaController@guardar_resolucion_verificacion_tecnica');
        Route::post('guardar_f', 'VerTecnicaController@guardar_f');
        Route::post('actualizar_f', 'VerTecnicaController@actualizar_f');
        Route::get('recuperar_revisiones','VerTecnicaController@recuperar_revisiones');
        Route::get('ver_documentos_adjuntos/{id_rev}/{id_expediente}/{id_encargado}','VerTecnicaController@ver_documentos_adjuntos');
        Route::get('ver_notificaciones_adjuntos/{id_rev}/{id_expediente}/{id_encargado}','VerTecnicaController@ver_notificaciones_adjuntos');
        Route::get('agregar_especificaciones_vt','VerTecnicaController@agregar_especificaciones_vt');
        Route::get('actualizar_especificaciones_vt','VerTecnicaController@actualizar_especificaciones_vt');
        Route::get('getEspecificaciones','VerTecnicaController@getEspecificaciones');
        Route::get('imprimir_resolucion_vt/{id_reg_exp}','VerTecnicaController@imprimir_resolucion_vt');
        
        
        Route::resource('emitir_resolucion','EmitirResolucionController');
        Route::get('get_expedientes_resolucion','EmitirResolucionController@get_expedientes_resolucion');
        Route::get('get_docs','EmitirResolucionController@get_docs');
        Route::post('subir_escaneo', 'EmitirResolucionController@create');
        Route::post('callpdf_resolucion_licencias', 'EmitirResolucionController@get_pdf');
        Route::get('ver_documentos_licencias/{id}','EmitirResolucionController@ver_documentos');
        
        
        Route::resource('mapa_licencias','MapaLicenciasController');
        Route::get('get_mapa_licencias_eficiacion/{color}/{hab_urb}', 'MapaLicenciasController@get_mapa_licencias_eficiacion');
        
        Route::resource('joselin', 'JoselinController');
        
    });

        /******************************     HAB URBANA ********************************************************/

     Route::group(['namespace' => 'hab_urbana'], function() {
        //////expedientes
        Route::resource('hab_urbana','RegistroExpedientesHabUrbController');
        Route::get('getExpedientesHabUrb','RegistroExpedientesHabUrbController@getExpedientes');
       ///// verif administrativa
        Route::resource('verificacion_admin','VerificacionAdminController');
        Route::get('getExpedientesVerif','VerificacionAdminController@getExpedientes');
        Route::get('traer_datos_verif/{id}','VerificacionAdminController@traer_datos');
        Route::get('getRequisitos','VerificacionAdminController@getRequisitos');
        Route::get('insertar_requisitos','VerificacionAdminController@insertar_requisitos');
        
        Route::resource('notificaciones_verif_admin','NotificacionesAdminController');
        Route::get('rep_notificacion_verif_admin_hab_urb/{id}','NotificacionesAdminController@rep_notificacion_verif_admin'); //reporte notificacion verificacion admin

        //////expedientes
        Route::resource('crear_poligono','CrearPoligonoController');
        Route::get('getCrearPoligono','CrearPoligonoController@getExpedientes');
        
         /////verif tecnica
        Route::resource('verificacion_tecnica','VerificacionTecnicaController');
        Route::get('getVerifTecnica','VerificacionTecnicaController@getExpedientes');
        Route::resource('notificaciones_tecnica','NotificacionesTecnicaController');
        Route::get('rep_notificacion_verif_tecnica_hab_urb/{id}','NotificacionesTecnicaController@rep_notificacion_verif_tecnica'); //reporte notificacion verificacion admin
        Route::get('traer_datos_verif_tecnica/{id}','VerificacionTecnicaController@traer_datos');
         Route::post('create_verificacion_tecnica', 'VerificacionTecnicaController@create');
         
          /////resolucion
        Route::resource('crear_resolucion','CrearResolucionController');
        Route::get('get_crear_resolucion','CrearResolucionController@getExpedientes');
        Route::get('cargar_documetos','CrearResolucionController@cargar_documetos');
        Route::post('create_scaneo_hab_urb', 'CrearResolucionController@create');
        Route::get('ver_file_hab_urb/{id}','CrearResolucionController@ver_file_hab_urb'); 

        ///// mapa mod hab urbbbbbbb
        Route::resource('mapa_lice','MapaLicenciasController');
        Route::get('get_mapa_licencias_eficiacion/{color}', 'MapaLicenciasController@get_mapa_licencias_eficiacion');
        
        
    });
    
    /******************************      MANTENIMIENTO   USUARIOS ********************************************************/
    Route::resource('usuarios', 'Usuarios');
    Route::get('list_usuarios', 'Usuarios@index'); // tabla grilla Usuarios
    Route::get('/usuarios', 'Usuarios@vw_usuarios_show')->name('usuarios'); //vw_usuarios
    Route::post('usuario_save', 'Usuarios@insert_Usuario');
    Route::post('usuario_update', 'Usuarios@update_Usuario');
    Route::post('usuario_delete', 'Usuarios@eliminar_usuario'); //eliminar usuario
    Route::get('usuarios_validar_user','Usuarios@validar_user');
    Route::get('usuarios_validar_dni','Usuarios@validar_dni');
    Route::get('get_datos_usuario','Usuarios@get_datos_usuario');
    Route::post('cambiar_foto_user','Usuarios@cambiar_foto_usuario');
    Route::post('cambiar_pass_user','Usuarios@cambiar_pass_user');
    
    ///////////////////////proceso administrativo sancionador
    Route::group(['namespace' => 'pas'], function() {
        Route::resource('pas','Proceso_sancionadorController');
    });
    ///////////////////////limpieza´publica
    Route::group(['namespace' => 'limpieza_publica'], function() {
        Route::resource('rutas_barrido_calles','Barrido_Calles_Controller');
        Route::resource('rutas_recojo_residuos','Recojo_Residuos_Controller');
        Route::resource('contenedores','Contenedores_Controller');
        Route::resource('botaderos','Botaderos_Controller');
    });
    ///////////////////////areas_verdes
    Route::group(['namespace' => 'areas_verdes'], function() {
        Route::resource('areas_verdes','Areas_Verdes_Controller');
    });
    ///////////////////////Mantenimiento de vias
    Route::group(['namespace' => 'vias'], function() {
        Route::resource('vias','Vias_Controller');
    });
    ///////////////////////desarrollo economico
    Route::group(['namespace' => 'desarrollo_economico'], function() {
        Route::resource('mypes','Mypes_Controller');
    });
    ///////////////////////infrestructura deportiva
    Route::group(['namespace' => 'infra_deportiva'], function() {
        Route::resource('infra_deportiva','Infra_Deportiva_Controller');
    });
    
    /****************************** PERSONAS RENIEC ********************************************************/
    Route::group(['namespace' => 'personas'], function() {
        Route::resource('personas','PersonasController');
    });
    
    /******************************      GERENCIA DE SEGURIDAD CIUDADANA ********************************************************/
    Route::group(['namespace' => 'gerencia_seg_ciud'], function() {
        Route::resource('sub_geren_op_vigilancia_interna','Operaciones_Vigilancia_Interna_Controller');
        Route::resource('sub_geren_riesgos_desastres','Riesgos_Desastres_Controller');
        Route::resource('sub_geren_transito_seg_vial','Transito_Seg_Vial_Controller');
    });
    
    /*******************************  PROCURADURIA **********************************************************/
    
     Route::group(['namespace' => 'procuraduria'], function() {
        Route::resource('procuraduria','ProcuraduriaController');
    });
     /*******************************  ASESORIA LEGAL **********************************************************/
    
     Route::group(['namespace' => 'asesoria_legal'], function() {
        Route::resource('asesoria_legal','AsesorialegalController');
    });
        
    Route::group(['namespace' => 'gerencia_obras_pub_infra'], function() {
        Route::resource('sub_geren_estudios_proyectos','Estudios_Proyectos_Controller');
        Route::resource('sub_geren_apoyo_matenimiento','Apoyo_Mantenimiento_Controller');
        Route::resource('sub_geren_obras_publicas','Obras_Publicas_Controller');
});
        
});

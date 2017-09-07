<?php

Route::get('/', function () {
    return view("auth/login");
});


// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');
//Route::post('registro','Usuarios@postRegistro')->name('registro_user');
Route::group(['middleware' => 'auth'], function() {//YOHAN MODULOS
    Route::get('uit', 'configuracion\Oficinas_Uit@get_alluit')->name('uit'); // tabla..
    Route::get('list_uit', 'configuracion\Oficinas_Uit@index'); // tabla grilla uit
    Route::post('uit_save', 'configuracion\Oficinas_Uit@insert'); // ruta para guardar
    Route::post('uit_mod', 'configuracion\Oficinas_Uit@modif');
    Route::post('uit_quitar', 'configuracion\Oficinas_Uit@eliminar');

    Route::get('oficinas', 'configuracion\Oficinas_Uit@get_alloficinas')->name('oficinas'); // tabla grilla Clientes
    Route::get('list_oficinas', 'configuracion\Oficinas_Uit@index1'); // tabla grilla uit
    Route::post('oficinas_mod', 'configuracion\Oficinas_Uit@modif_ofi');
    Route::post('oficinas_insert_new', 'configuracion\Oficinas_Uit@oficinas_insert_new');
    Route::post('oficinas_delete', 'configuracion\Oficinas_Uit@oficinas_delete');
});

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/vw_general', 'General@index')->name('vw_general');
//
//Route::get('msg', function() {
//    return view('fnewUsuario');
//});

Route::get('fracc', 'General@fraccionamiento');

//Route::get('/usuarios', function () {
//    return view("administracion/vw_usuarios");
//})->name('usuarios');



Route::group(['middleware' => 'auth'], function() {
    /******************** ********    CONFIGURACION CATASTRAL   ****************************/
    Route::group(['namespace'=>'catastro'],function(){

        /******************** *****  SECTORES   ***************************/
        Route::resource('catastro_sectores','SectoresController');
        Route::get('list_sectores','SectoresController@getSectores');
        Route::post('insert_new_sector', 'SectoresController@insert_new_sector');
        Route::post('update_sector', 'SectoresController@update_sector');
        Route::post('delete_Sector', 'SectoresController@delete_sector');

        /******************** *****  MANZANAS   ***************************/
        Route::resource('catastro_mzns','ManzanaController');
        Route::get('list_mzns_sector','ManzanaController@getManzanaPorSector');
        Route::post('insert_new_mzna', 'ManzanaController@insert_new_mzna');
        Route::post('create_mzna_masivo', 'ManzanaController@create_mzna_masivo');
        Route::post('update_mzna', 'ManzanaController@update_mzna');
        Route::post('delete_mzna', 'ManzanaController@delete_mzna');

        /******************** *****  ARANCELES RUSTICOS   ***************************/
        Route::resource('catastro_aran_rust','ArancelesRusticosController');
        Route::get('list_aran_pred_rust','ArancelesRusticosController@getArancelRustPorAnio');
        Route::post('insert_new_pred_rust', 'ArancelesRusticosController@insert_new_pred_rust');
        Route::post('update_pred_rust', 'ArancelesRusticosController@update_pred_rust');
        Route::post('delete_pred_rust', 'ArancelesRusticosController@delete_aran_pred_rust');
    });
/******************** ********    MAP CONTROLLER   ******************  **********/
    Route::group(['namespace'=>'map'],function(){
        Route::get('/cartografia', 'MapController@index')->name('home');
        Route::get('/getlimites', 'MapController@get_limites')->name('get.limites');
        Route::get('/getsectores', 'MapController@get_sectores')->name('get.sectores');
        Route::get('/getmznas', 'MapController@get_manzanas')->name('get.manzanas');
        Route::post('/geogetmznas_x_sector', 'MapController@geogetmznas_x_sector');
        Route::post('/get_centro_sector', 'MapController@get_centro_sector');
        Route::post('/mznas_x_sector', 'MapController@mznas_x_sector');
    });
    /******************************      MANTENIMIENTO   USUARIOS ********************************************************/
    Route::get('list_usuarios', 'Usuarios@index'); // tabla grilla Usuarios
    Route::get('/usuarios', 'Usuarios@vw_usuarios_show')->name('usuarios'); //vw_usuarios
    Route::post('usuario_save', 'Usuarios@insert_Usuario');
    Route::post('usuario_update', 'Usuarios@update_Usuario');
    Route::post('usuario_delete', 'Usuarios@eliminar_usuario'); //eliminar usuario
    Route::get('usuarios_validar_user','Usuarios@validar_user');
    Route::get('usuarios_validar_dni','Usuarios@validar_dni');
    Route::get('get_datos_usuario','Usuarios@get_datos_usuario');
    Route::post('cambiar_foto_user','Usuarios@cambiar_foto_usuario');

    /*     * **************************AUTOLLENADO DE COMBOS********************************************************************* */
    Route::get('get_all_tipo_documento', 'General@get_tipo_doc'); //llena combo tipo documento
    Route::get('get_all_cond_exonerac', 'General@get_cond_exonerac'); //llena combo condicion exonerac
    Route::get('autocompletar_direccion', 'General@autocompletar_direccion'); //autocompleta el input text avenida,jiro, calle de contribuyentes
    Route::get('autocompletar_tipo_uso', 'General@autocompletar_tipo_uso'); //autocompleta tipos de uso
    Route::get('autocompletar_insta', 'General@autocompletar_instalaciones'); //autocompleta tipos de uso
    Route::get('sel_viaby_sec', 'General@sel_viaby_sec'); //seleccionas vias por mazana y sector
    Route::get('sel_cat_gruterr', 'General@sel_cat_gruterr'); //seleccionas vias por mazana y sector
    Route::get('autocomplete_nom_via', 'configuracion\Valores_Arancelarios@get_autocomplete_nom_via'); //autocompletar arancel cod_via->nom_completo de via
    /*     * *******************DEPARTAMENTO  PROVINCIA DISTRITO  **************************************************************** */
    Route::get('get_all_dpto', 'General@get_dpto'); //llena combo departamentos
    Route::get('get_all_prov', 'General@get_prov'); //llena combo provincias
    Route::get('get_all_dist', 'General@get_dist'); //llena combo Distritos
    /*     * ********************************************************************************************************************* */
    /*     * **************************************CONTRIBUYENTES******************************************************************** */
//    Route::get('contribuyentes', 'adm_tributaria\Contribuyentes@vw_contribuyentes'); // VW_CONTRIUYENTES
    
    
    Route::group(['namespace' => 'adm_tributaria'], function() {
        Route::resource('contribuyentes','ContribuyentesController');
        Route::get('consultar_persona','ContribuyentesController@consultar_persona');
        Route::post('insert_personas','ContribuyentesController@insert_persona');
        Route::get('grid_contribuyentes', 'ContribuyentesController@grid_contrib'); // tabla grilla Contribuyentes 
        Route::get('obtiene_cotriname', 'ContribuyentesController@get_cotrib_byname'); //
        Route::get('pre_rep_contr/{sect}/{mzna}/{anio}','ContribuyentesController@reporte_contribuyentes');
        Route::get('pre_rep_contr_hab_urb/{cod_hab_urb}/{anio}','ContribuyentesController@reporte_contribuyentes_hab_urb');
//        Route::post('insert_new_contribuyente', 'adm_tributaria\Contribuyentes@insert_new_contribuyente');
        /*ENVIO DE DOCUEMNTOS EJECUCION COACTIVA*/
        Route::resource('envio_doc_coactiva','EnvDocCoactivaController');
        Route::get('recaudacion_get_op', 'EnvDocCoactivaController@fis_getOP');        
        Route::get('updat_env_doc','EnvDocCoactivaController@up_env_doc');
    });
    
      
    Route::get('llenar_form_contribuyentes', 'adm_tributaria\Contribuyentes@llenar_form_contribuyentes'); //llena form contribuyentes
    
    Route::post('contribuyente_update', 'adm_tributaria\Contribuyentes@modificar_contribuyente'); //update contribuyente
    Route::post('contribuyente_delete', 'adm_tributaria\Contribuyentes@eliminar_contribuyente'); //eliminar contribuyente
    Route::get('autocomplete_contrib', 'adm_tributaria\Contribuyentes@get_autocomplete_contrib'); //eliminar contribuyente
    
    Route::get('obtiene_cotriop', 'adm_tributaria\Contribuyentes@get_cotrib_op'); //
    Route::get('obtener_pred_ctb/{id}', 'adm_tributaria\Contribuyentes@get_predios_contrib'); //
    /*     * ******************************************VALORES ARANCELARIOS******************************************************************** */
    Route::group(['namespace' => 'configuracion'], function() {
        Route::get('val_arancel', 'Valores_Arancelarios@vw_val_arancel')->name('val_aran'); // VW_ARANCELES
        Route::get('grid_val_arancel', 'Valores_Arancelarios@grid_valores_arancelarios'); // tabla grilla Valores Arancelarios
        Route::get('get_anio_val_arancel', 'Valores_Arancelarios@get_anio'); //llena combo AÑO vw_val_arancel
        Route::get('get_sector_val_arancel', 'Valores_Arancelarios@get_sector'); //llena combo SECTOR vw_val_arancel
        Route::get('get_mzna_val_arancel', 'Valores_Arancelarios@get_mzna'); //llena combo MANZANAvw_val_arancel        
        Route::post('insert_valor_arancel', 'Valores_Arancelarios@insert_valor_arancel');
        Route::post('update_valor_arancel', 'Valores_Arancelarios@update_valor_arancel');
        Route::post('delete_valor_arancel', 'Valores_Arancelarios@delete_valor_arancel');
    });

    /*     * ****************************************   VALORES UNITARIOS    ************************************************************** */
    Route::group(['namespace' => 'configuracion'], function() {
        Route::get('val_unit', 'Valores_Unitarios@show_vw_val_unit')->name('valores_unitarios'); // VW_VALORES_UNITARIOS
        Route::get('grid_val_unitarios', 'Valores_Unitarios@grid_val_unitarios'); // tabla grilla VALORES UNITARIOS
        Route::get('create_magic_grid_val_unit', 'Valores_Unitarios@magic_grid_valores_unit'); // EXECUTE FUNCTION POSTGRES... VALORES UNITARIOS
        Route::post('update_valor_unitario', 'Valores_Unitarios@update_valor_unitario');
    });
    /******************** ********    TESORERIA     ****   EMISION DE RECIBOS DE PAGO            ************************************/
    Route::group(['namespace' => 'tesoreria'], function() {
        Route::resource('emi_recibo_master', 'Recibos_MasterController');
        Route::resource('emi_recibo_detalle', 'Recibos_DetalleController');
        Route::get('grid_Resumen_recibos','Recibos_MasterController@tabla_Resumen_recibos');
        Route::get('autocompletar_tributo','Recibos_MasterController@completar_tributo');// recibos varios
        Route::get('emi_recib_buscar_persona','Recibos_MasterController@buscar_persona');
        Route::post('insert_new_persona','Recibos_MasterController@insert_new_persona');
        Route::get('get_grid_cta_cte2','Recibos_MasterController@tabla_cta_cte_2');
        Route::get('grid_pred_arbitrios','Recibos_MasterController@tabla_cta_arbitrios');
        Route::get('grid_cta_pago_arbitrios','Recibos_MasterController@cta_pago_arbitrios');
    });
    Route::group(['namespace' => 'caja'], function() {
//        Route::get('mod_caj_generica', 'Caja_ClaIn_Generica@vw_show_generica')->name('mod_caj_gen'); // VW_EMISION_CALSIFICADOR DE INGRESOS GENERICA        
        Route::resource('caja_movimient','Caja_MovimientosController');
        Route::get('imp_pago_rec','Caja_MovimientosController@reportes_caja_mov');
        Route::get('grid_Caja_Movimientos','Caja_MovimientosController@get_grid_Caja_Mov');
    });
    Route::group(['namespace'=>'caja'],function(){///ESTADO DE CUENTAS
        Route::resource('estado_de_cta','Caja_Est_CuentasController');
        Route::get('caja_est_cta_contrib','Caja_Est_CuentasController@caja_est_cuentas');
        Route::get('caja_imp_est_cta/{id_contrib}/{desde}/{hasta}','Caja_Est_CuentasController@print_est_cta_contrib');
    });
    Route::group(['namespace' => 'fraccionamiento'], function() {//FRACCIONAMIENTO DE PAGOS PREDIAL
        Route::resource('config_fraccionamiento','configuracion\Fraccionamiento');        
        Route::resource('conve_fraccionamiento','ConvenioController');
        Route::resource('convenio_detalle','Convenio_DetalleController');
        Route::get('grid_deu_contrib_arbitrios','ConvenioController@list_deuda_contrib');
        Route::get('grid_Convenios','ConvenioController@grid_all_convenios');
        Route::get('imp_cronograma_Pago_Fracc','ConvenioController@crono_pago_fracc');
        Route::get('grid_fracc_de_contrib','ConvenioController@fracc_de_contrib');
        Route::get('grid_detalle_fracc','ConvenioController@detalle_fracc');
    });    
    Route::group(['namespace'=>'coactiva'],function(){///COACTIVA
        Route::resource('coactiva','CoactivaController');
        Route::get('recepcion_doc','CoactivaController@recep_doc');
//        Route::get('caja_est_cta_contrib','Caja_Est_CuentasController@caja_est_cuentas');
    });
    
    Route::group(['namespace' => 'adm_tributaria'], function() {
        Route::resource('predios_urbanos', 'PredioController');
        Route::resource('predios_rural', 'PredioRuralController');
        Route::resource('pisos_predios', 'PisosController');
        Route::resource('condominios_predios', 'CondominiosController');
        Route::resource('instalaciones_predios', 'InstalacionesController');
        Route::resource('pensionista_predios', 'PensionistaController');
        Route::resource('arbitrios_municipales', 'ArbitriosController');
        Route::get('getfrecbarrido/{an}','ArbitriosController@barrido_by_an');
        Route::get('getfrecserenazgo/{an}','ArbitriosController@serenazgo_by_an');
        Route::get('getfrecparques/{an}','ArbitriosController@paques_by_an');
        Route::get('getfrecrrs','ArbitriosController@frec_rrs');
        Route::get('gridpredio','PredioController@listpredio');
        Route::get('gridpisos/{id}','PisosController@listpisos');
        Route::get('gridcondos/{id}','CondominiosController@listcondos');
        Route::get('gridinsta/{id}','InstalacionesController@listinsta');
        Route::get('gridarbitrios','ArbitriosController@listarbitrios');
        Route::get('selmzna','PredioController@ListManz');
        Route::get('adm_impform/','PredioController@imprimir_formatos');
        Route::get('pre_rep/{tip}/{id}/{an}/{per}','PredioController@reporte');
    });
    Route::group(['namespace' => 'recaudacion'], function() {//modulo de fiscalizacion
        Route::resource('ordenpago', 'OrdenPagoController');
        Route::get('fis_rep/{tip}/{id}/{sec}/{man}','OrdenPagoController@reporte');
        Route::get('obtiene_op/{dat}/{sec}/{manz}/{an}/{ini}/{fin}', 'OrdenPagoController@getOP'); //
        Route::get('obtiene_con_sec', 'OrdenPagoController@getcontrbsec'); //
    });  
    Route::group(['namespace' => 'alcabala'], function() {//modulo de alcabala
        Route::resource('alcabala', 'AlcabalaController');
        Route::get('trae_acabala/{an}/{id}/{tip}/{num}/{ini}/{fin}', 'AlcabalaController@get_alcabala'); //
        Route::get('alca_manten_doc', 'AlcabalaController@manten_docs'); //
        Route::get('alcabala_conf', 'AlcabalaController@mantenimiento'); //
        Route::get('deduccion_save', 'AlcabalaController@ded_create'); //
        Route::get('tasa_save', 'AlcabalaController@tas_create'); //
        Route::get('natcontra_save', 'AlcabalaController@contra_create'); //
        Route::get('doctrans_save', 'AlcabalaController@transfer_create'); //
        Route::get('transina_save', 'AlcabalaController@inafecto_create'); //
        Route::get('grid_deduc', 'AlcabalaController@get_deduc'); //
        Route::get('grid_tasas', 'AlcabalaController@get_tasas'); //
        Route::get('grid_nat_contra', 'AlcabalaController@get_contra'); //
        Route::get('grid_doc_trans', 'AlcabalaController@get_transfe'); //
        Route::get('grid_trans_ina', 'AlcabalaController@get_inafecto'); //
        Route::get('alcab_rep/{id}','AlcabalaController@reporte');
        
    });  
    Route::get('$',function(){ echo 0;});//url auxiliar
    
});





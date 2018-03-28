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
    });
    Route::group(['namespace' => 'adm_tributaria'], function() {
        Route::get('traefoto_lote/{sec}/{mzna}/{lote}','PredioController@getfoto');
        Route::get('traefoto_lote_id/{lote}','PredioController@getfotoid');
        Route::get('traerlote/{lote}/{anio}','PredioController@getloteid');
        
    });

});

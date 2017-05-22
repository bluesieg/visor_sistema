<?php
Route::get('/', function () {
    return view("welcome");
});



// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

//Route::get('/', auth());

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/vw_general', 'General@index')->name('vw_general');

Route::get('/reportes', function () {
    return view("reportes");
})->name('reportes1');

Route::get('/dialog',function(){
    return view('vw_dialog');
});

//Route::get('/nuevousuario', 'HomeController@nuevoUsuario');

//Route::get('vw_general', function (){
//    return view('vw_general');
//    
//});
//Route::get('home', [
//    'uses'  => 'HomeController@index',
//    'as'    => 'home'
//]);

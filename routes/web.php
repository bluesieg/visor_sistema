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


//Route::get('/usuarios', function () {
//    return view("administracion/vw_usuarios");
//})->name('usuarios');



Route::group(['middleware' => 'auth'], function(){
    Route::get('list_usuarios', 'Usuarios@index'); // tabla grilla Usuarios
    Route::get('/usuarios','Usuarios@getAllUsuarios')->name('usuarios');//vw_usuarios
});

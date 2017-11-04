<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/auth/register', function(){
    return View::make('errors.404');
    return View::make('errors.503');
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function(){
        return View::make('home');
    });

    Route::get('/home', function(){
        return View::make('home');
    });

    Route::resource('grupo', 'GrupoController');

    Route::resource('usuario', 'UsuarioController');

    Route::resource('activedirectory', 'AdController');

    Route::resource('regras', 'RegrasController');

    Route::resource('ip', 'IpController');

    Route::resource('ta', 'AuthController');


    Route::get('/usuario', function(){
        return View::make('usuario');
    });

    Route::get('/perfil', function(){
        return View::make('perfil');
    });

    Route::get('/geral', function(){
        return View::make('regrasgeral');
    });

    Route::get('/logs', function(){
        return View::make('logs');
    });

    Route::get('/script', function(){
        return View::make('webService');
    });

    Route::get('/relatorio', function(){
        return View::make('relatorio');
    });

    Route::get('/ajustes', function(){
        return View::make('ajustes');
    });

});

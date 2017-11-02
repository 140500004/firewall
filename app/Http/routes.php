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


Route::get('/auth/register', function()
{
    return View::make('errors.404');
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function()
    {
        return View::make('home');
        //return View::make('login');
    });

    Route::get('/home', function()
    {
        //return View::make('login');
        return View::make('home');
    });

    Route::resource('grupo', 'GrupoController');

    Route::resource('usuario', 'UsuarioController');

    Route::resource('activedirectory', 'AdController');

    Route::resource('regras', 'RegrasController');

    Route::resource('ip', 'IpController');


    Route::get('/usuario', function(){
        return View::make('usuario');
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



/*
Route::get('/charts', function()
{
	return View::make('mcharts');
});

Route::get('/tables', function()
{
	return View::make('table');
});

Route::get('/forms', function()
{
	return View::make('form');
});

Route::get('/grid', function()
{
	return View::make('grid');
});

Route::get('/buttons', function()
{
	return View::make('buttons');
});

Route::get('/icons', function()
{
	return View::make('icons');
});

Route::get('/panels', function()
{
	return View::make('panel');
});

Route::get('/typography', function()
{
	return View::make('typography');
});

Route::get('/notifications', function()
{
	return View::make('notifications');
});

Route::get('/blank', function()
{
	return View::make('blank');
});
*/
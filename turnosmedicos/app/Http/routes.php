<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();

Route::get('/', function () {
    return view('welcome');
});

Route::resource('paises', 'PaisesController');
Route::resource('provincias', 'ProvinciaController');
Route::resource('localidades', 'LocalidadesController');

//ajax
Route::get('getProvincia', 'ProvinciaController@getProvincia');
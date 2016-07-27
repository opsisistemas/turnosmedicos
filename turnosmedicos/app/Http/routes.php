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
Route::resource('especialidades', 'EspecialidadesController');
Route::resource('obras_sociales', 'ObrasSocialesController');
Route::resource('planes', 'PlanesController');

//ajax edit/create
Route::get('getPais', 'PaisesController@getPais');
Route::get('getProvincia', 'ProvinciaController@getProvincia');
Route::get('getLocalidad', 'LocalidadesController@getLocalidad');
Route::get('getEspecialidad', 'EspecialidadesController@getEspecialidad');
Route::get('getObraSocial', 'ObrasSocialesController@getObraSocial');
Route::get('getPlan', 'PlanesController@getPlan');

//ajax resto
Route::get('provinciasPais', 'ProvinciaController@provinciasPais');
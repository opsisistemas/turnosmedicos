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
Route::resource('pacientes', 'PacientesController');
Route::resource('medicos', 'MedicosController');
Route::resource('turnos', 'TurnosController');
Route::get('turnos.create', 'TurnosController@create');
Route::get('turnos.listado', 'TurnosController@listado');

//ajax edit/create
Route::get('getPais', 'PaisesController@getPais');
Route::get('getProvincia', 'ProvinciaController@getProvincia');
Route::get('getLocalidad', 'LocalidadesController@getLocalidad');
Route::get('getEspecialidad', 'EspecialidadesController@getEspecialidad');
Route::get('getObraSocial', 'ObrasSocialesController@getObraSocial');
Route::get('getPlan', 'PlanesController@getPlan');
Route::get('getPaciente', 'PacientesController@getPaciente');
Route::get('getMedico', 'MedicosController@getMedico');

//ajax resto
Route::get('provinciasPais', 'ProvinciaController@provinciasPais');
Route::get('localidadesProvincia', 'LocalidadesController@localidadesProvincia');
Route::get('planesObraSocial', 'PlanesController@planesObraSocial');
Route::get('medicosEspecialidad', 'EspecialidadesController@medicosEspecialidad');
Route::get('diasAtencion', 'MedicosController@diasAtencion');
Route::get('getPaises', 'PaisesController@getPaises');
Route::get('getObrasSociales', 'ObrasSocialesController@getObrasSociales');
Route::get('getEspecialidades', 'EspecialidadesController@getEspecialidades');
Route::get('getCategorias', 'CategoriasController@getCategorias');
Route::get('diaDisponible', 'TurnosController@diaDisponible');
Route::get('turnosMedicoDia', 'TurnosController@turnosMedicoDia');

//ajax pdf
Route::get('pdfListado', 'PdfController@listadoabm');
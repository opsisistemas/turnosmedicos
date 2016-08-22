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

//antes de devolver el recurso, pasa por el middleware, que evalúa el rol del usuario
//ésto evita que se acceda por url a alguna parte del sistema, sin estar autorizado
Route::group(['middleware' => 'role:paciente'], function () {
	//rutas tipo recurso
	Route::resource('paises', 'PaisesController');
	Route::resource('provincias', 'ProvinciaController');
	Route::resource('localidades', 'LocalidadesController');
	Route::resource('especialidades', 'EspecialidadesController');
	Route::resource('obras_sociales', 'ObrasSocialesController');
	Route::resource('planes', 'PlanesController');
	Route::resource('pacientes', 'PacientesController');
	Route::resource('medicos', 'MedicosController');
	Route::resource('turnos', 'TurnosController');

	//rutas tipo get (agregados a recursos)
	Route::get('turnos.listado', 'TurnosController@listado');
	Route::get('pacientes.persist', 'PacientesController@persist');

	//ajax edit/create --sirven para llenar select's en los abm's
	Route::get('getPais', 'PaisesController@getPais');
	Route::get('getProvincia', 'ProvinciaController@getProvincia');
	Route::get('getLocalidad', 'LocalidadesController@getLocalidad');
	Route::get('getEspecialidad', 'EspecialidadesController@getEspecialidad');
	Route::get('getObraSocial', 'ObrasSocialesController@getObraSocial');
	Route::get('getPlan', 'PlanesController@getPlan');
	Route::get('getPaciente', 'PacientesController@getPaciente');
	Route::get('getMedico', 'MedicosController@getMedico');
});

//rutas tipo get (agregados a recursos -para sacar turno-)
Route::get('turnos.create', 'TurnosController@create');
Route::get('turnos.create_por_especialidad', 'TurnosController@create_por_especialidad');
Route::get('turnos.misturnos', 'TurnosController@misTurnos');
Route::post('turnos.cancel/{id}', 'TurnosController@cancel');

//ajax para sacar turno
Route::get('diasAtencion', 'MedicosController@diasAtencion');
Route::get('especialidadesMedico', 'MedicosController@especialidadesMedico');
Route::get('diaDisponible', 'TurnosController@diaDisponible');
Route::get('diasAtencion_esp', 'EspecialidadesController@diasAtencion');
Route::get('medicosDia', 'DiasController@medicosDia');

//ajax resto
Route::get('provinciasPais', 'ProvinciaController@provinciasPais');
Route::get('localidadesProvincia', 'LocalidadesController@localidadesProvincia');
Route::get('planesObraSocial', 'PlanesController@planesObraSocial');
Route::get('medicosEspecialidad', 'EspecialidadesController@medicosEspecialidad');
Route::get('getPaises', 'PaisesController@getPaises');
Route::get('getObrasSociales', 'ObrasSocialesController@getObrasSociales');
Route::get('getEspecialidades', 'EspecialidadesController@getEspecialidades');
Route::get('getCategorias', 'CategoriasController@getCategorias');
Route::get('turnosMedicoDia', 'TurnosController@turnosMedicoDia');
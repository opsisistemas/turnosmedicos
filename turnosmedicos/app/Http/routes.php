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

Route::get('/', 'EmpresaController@index');

//antes de devolver el recurso, pasa por el middleware, que evalúa el rol del usuario
//ésto evita que se acceda por url a alguna parte del sistema, sin estar autorizado
Route::group(['middleware' => 'rolesExcept:paciente'], function () {
	//rutas tipo recurso
	Route::resource('paises', 'PaisesController');
	Route::resource('provincias', 'ProvinciaController');
	Route::resource('localidades', 'LocalidadesController');
	Route::resource('especialidades', 'EspecialidadesController');
	Route::resource('obras_sociales', 'ObrasSocialesController');
	Route::resource('planes', 'PlanesController');
	Route::resource('medicos', 'MedicosController');
	Route::resource('asuntos', 'AsuntosController');
	Route::resource('feriados', 'FeriadosController');
	Route::get('empresa.perfil', 'EmpresaController@perfil');
	Route::resource('empresa', 'EmpresaController');

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
	Route::get('getFeriado', 'FeriadosController@getFeriado');
});

//rutas que deberían estar protegidas, pero se desportegieron para que el usuario pueda
//sacar turno y ver sus datos
Route::resource('turnos', 'TurnosController');
Route::get('pacientes.perfil', 'PacientesController@perfil');
Route::resource('pacientes', 'PacientesController');
Route::resource('mensajes', 'MensajesController');
Route::get('mensajes.create', 'MensajesController@create');
Route::get('medicos.perfil', 'MedicosController@perfil');

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
Route::get('getEmpresa', 'EmpresaController@getDatos');
Route::get('cantMensajes', 'MensajesController@cantMensajes');
Route::get('getMensaje', 'MensajesController@getMensaje');
Route::get('getAsunto', 'AsuntosController@getAsunto');
Route::get('getCaptcha', 'Controller@getCaptcha');
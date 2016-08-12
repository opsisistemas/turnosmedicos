<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Medico;
use DB;

class DiasController extends Controller
{
	public function getDias()
	{
		$dias=Dia::all();

		return response()->json(
				$dias->toArray()
		);
	}

	public function medicosDia(Request $request)
	{
		$dia_id = $request->get('dia_id');
		$especialidad_id = $request->get('especialidad_id');

		$medicos = Medico::select('medicos.id', DB::raw('concat(medicos.apellido, ", ", medicos.nombre) as apellido'))->join('dia_medico', 'medicos.id', '=', 'dia_medico.medico_id')->join('especialidad_medico', 'medicos.id', '=', 'especialidad_medico.medico_id')->where('dia_medico.dia_id', '=', $dia_id)->where('especialidad_medico.especialidad_id', '=', $especialidad_id)->orderBy('apellido')->get();

		return response()->json(
				$medicos->toArray()
		);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Categoria_medico;

class CategoriasController extends Controller
{
	public function getCategorias()
	{
		$categorias = Categoria_medico::all();

		return response()->json(
			$categorias->toArray()
		);
	}
}

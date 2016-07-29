<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DiasController extends Controller
{
	public function getDias()
	{
		$dias=Dia::all();

		return response()->json(
				$dias->toArray();
		);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PdfController extends Controller
{
    public function listadoabm() 
    {
//    	$title = 'Turnos del D&iacute;a: 05/08/2016';
//    	$encabezados = ['Nombre', 'Apellido', 'Hora Turno'];

        $view =  \View::make('pdf.listadoabm')->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->download('listado.pdf');
    }
}

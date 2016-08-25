<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Empresa;
use App\Medico;
use App\Dia;
use App\Turno;
use App\Especialidad;

use Session;
use Auth;
use Carbon\Carbon;
use DB;
use Mail;


class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::findOrFail(1);

        return view('welcome', ['empresa' => $empresa]);
    }

    public function getDatos()
    {
        $empresa = Empresa::findOrFail(1);

        return response()->json($empresa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function perfil()
     {
         $empresa = Empresa::findOrFail(1);

         return view('empresa.perfil', ['empresa' => $empresa]);
     } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail(1);

        $input = $request->all();
        $input['inicio_actividades'] = Carbon::createFromFormat('d-m-Y', $input['inicio_actividades'])->startOfDay();

        $empresa->fill($input)->save();

        Session::flash('flash_message', 'Perfil de empresa editado con &eacute;xito!');

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

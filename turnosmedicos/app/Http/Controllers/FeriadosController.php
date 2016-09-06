<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use \Carbon\Carbon;
use App\Feriado;

use Input, Redirect, Validator, Session;

class FeriadosController extends Controller
{
    public function getFeriado(Request $request)
    {
        $feriado = Feriado::where('id', $request->get('id'))->get();
        return response()->json(
            $feriado->toArray()
        );
    }

    public function getFeriados(Request $request)
    {
        $feriados = Feriado::all();

        return response()->json(
            $feriados->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year = (null !== $request->get('year'))? $request->get('year') : Carbon::now()->year;

        if(Null !== $request->get('description')){
            $feriados = Feriado::whereYear('fecha', '=', $year)->where('descripcion', 'like', '%' . $request->get('description') . '%')->orderBy('fecha')->get();
        }else{
            $feriados = Feriado::whereYear('fecha', '=', $year)->orderBy('fecha')->get();
        }

        return view('feriados.index', ['feriados' => $feriados, 'year' => $year]);
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
        $rules = array(
            'descripcion' => 'required',
            'fecha' => 'required|date'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the errors
        if ($validator->fails()) {
            return Redirect::to('/feriados')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $input = $request->all();

            $input['fecha'] = Carbon::createFromFormat('d-m-Y', $input['fecha'])->startOfDay();

            $feriado=Feriado::create($input); 

            Session::flash('flash_message', 'Nuevo feriado agregado de manera exitosa!');

            return redirect('/feriados');
        }
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

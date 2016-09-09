<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\DiaTachado;

use Input, Redirect, Validator, Session;
use Carbon\Carbon;

class DiasTachadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
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
            'medico_id' => 'required',
            'fecha' => 'required|date'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the errors
        if ($validator->fails()) {
            return Redirect::to($request->get('origen'))
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $input = $request->all();

            $input['fecha'] = Carbon::createFromFormat('d-m-Y', $input['fecha'])->startOfDay();

            $dia_tachado=DiaTachado::create($input);

            Session::flash('flash_message', 'Nueva inasistencia agregada de manera exitosa!');

            return redirect($request->get('origen'));
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
        $rules = array(
            'medico_id' => 'required',
            'fecha' => 'required|date'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the errors
        if ($validator->fails()) {
            return Redirect::to('/diastachados')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $input = $request->all();

            $input['fecha'] = Carbon::createFromFormat('d-m-Y', $input['fecha'])->startOfDay();

            $dia_tachado=DiaTachado::findOrFail($id);

            $dia_tachado->fill($input)->save();

            Session::flash('flash_message', 'Nueva inasistencia agregada de manera exitosa!');

            return redirect('/diastachados');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dia_tachado = DiaTachado::findOrFail($id);
        $dia_tachado->delete();

        return redirect('/diastachados');
    }
}

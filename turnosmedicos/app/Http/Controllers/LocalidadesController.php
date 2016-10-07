<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pais;
use App\Provincia;
use App\Localidad;
use App\Funciones;

use Validator, Session, Redirect;

class LocalidadesController extends Controller
{
    public function getLocalidad(Request $request)
    {
        $localidad = Localidad::where('id', $request->get('id'))->get();
        return response()->json(
            $localidad->toArray()
        );
    }

    public function localidadesProvincia(Request $request)
    {
        $localidades = Localidad::where('provincia_id', '=', $request->get('id'))->get();
        return response()->json(
            $localidades->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localidades = Localidad::orderBy('nombre')->paginate(30);
        $paises = Funciones::getPaisesSel();
        return view('localidades.index', ['localidades' => $localidades, 'paises' => $paises]);
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
        $rules = [
            'provincia_id' => 'required',
            'nombre' => 'required'
        ];
        $errors = [
            'provincia_id' => 'Debe completar la provincia asociada',
            'nombre' => 'debe completar el nombre de la localidad'
        ];
        $validator = Validator::make($request->all(), $rules, $errors);

        if ($validator->fails()) {
            return Redirect::to('/localidades')
                ->withErrors($errors)
                ->withInput($request->all());
        } else {
                // store
            $input = $request->all();

            Localidad::create($input);

            Session::flash('flash_message', 'Alta de Localidad exitosa!');

            return redirect('/localidades');
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
        $rules = [
            'provincia_id' => 'required',
            'nombre' => 'required'
        ];
        $errors = [
            'provincia_id' => 'Debe completar la provincia asociada',
            'nombre' => 'debe completar el nombre de la localidad'
        ];
        $validator = Validator::make($request->all(), $rules, $errors);

        if ($validator->fails()) {
            return Redirect::to('/localidades')
                ->withErrors($errors)
                ->withInput($request->all());
        } else {
            $localidad = Localidad::findOrFail($id);

            $input = $request->all();

            $localidad->fill($input)->save();

            Session::flash('flash_message', 'Localidad editada con éxito!');

            return redirect('/localidades');
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
        $localidad = Localidad::findOrFail($id);
        $localidad->delete();
        return redirect('/localidades');
    }
}

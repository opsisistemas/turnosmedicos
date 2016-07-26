<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pais;
use App\Provincia;
use App\Localidad;
use App\Funciones;

use Session;

class LocalidadesController extends Controller
{
    private function validarLocalidad(Request $request){
        $this->validate($request, [
             'nombre' => 'required',
             'provincia_id' => 'required'
        ]);
    }

    public function getLocalidad(Request $request)
    {
        $localidad = Localidad::where('id', $request->get('id'))->get();
        return response()->json(
            $localidad->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localidades = Localidad::paginate(30);
        return view('localidades.index', array('localidades' => $localidades, 'paises' => Funciones::getPaisesSel(), 'provincias' => Funciones::getProvinciasSel(1)));
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
        $this->validarLocalidad($request);

        $input = $request->all();

        Localidad::create($input);

        Session::flash('flash_message', 'Alta de Localidad exitosa!');

        return redirect('/localidades');
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
        $localidad = Localidad::findOrFail($id);

        $this->validarLocalidad($request);

        $input = $request->all();

        $localidad->fill($input)->save();

        Session::flash('flash_message', 'Localidad editada con éxito!');

        return redirect('/localidades');
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

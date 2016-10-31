<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pais;
use App\Provincia;
use App\Funciones;

use Session;


class ProvinciaController extends Controller
{
    private function validarProvincia(Request $request){
        $this->validate($request, [
             'nombre' => 'required',
             'pais_id' => 'required'
        ]);
    }

    public function getProvincia(Request $request)
    {
        $provincia = Provincia::where('id', $request->get('id'))->get();
        return response()->json(
            $provincia->toArray()
        );
    }

    public function provinciasPais(Request $request)
    {
        
        $provincias = Provincia::where('pais_id', '=', $request->get('id'))->get();
        dd($provincias);
        return response()->json(
            $provincias->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provincias = Provincia::paginate(30);
        return view('provincias.index', array('provincias' => $provincias, 'paises' => Funciones::getPaisesSel()));
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
        $this->validarProvincia($request);

        $input = $request->all();

        Provincia::create($input);

        Session::flash('flash_message', 'Alta de Provincia exitosa!');

        return redirect('/provincias');
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
        $provincia = Provincia::findOrFail($id);

        $this->validarProvincia($request);

        $input = $request->all();

        $provincia->fill($input)->save();

        Session::flash('flash_message', 'Provincia editada con éxito!');

        return redirect('/provincias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provincia = Provincia::findOrFail($id);
        $provincia->delete();
        return redirect('/provincias');
    }
}

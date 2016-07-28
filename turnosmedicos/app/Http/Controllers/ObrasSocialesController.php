<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ObraSocial;

use Session;

class ObrasSocialesController extends Controller
{
    private function validarObraSocial(Request $request){
        $this->validate($request, [
             'nombre' => 'required'
        ]);
    }

    public function getObraSocial(Request $request)
    {
        $obra_social = ObraSocial::where('id', $request->get('id'))->get();
        return response()->json(
            $obra_social->toArray()
        );
    }

    public function getObrasSociales(Request $request)
    {
        $obras_sociales = ObraSocial::all();
        return response()->json(
            $obras_sociales->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obras_sociales = ObraSocial::paginate(30);
        return view('obras_sociales.index', array('obras_sociales' => $obras_sociales));
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
        $this->validarObraSocial($request);

        $input = $request->all();
        
        ObraSocial::create($input);

        Session::flash('flash_message', 'Alta de Obra Social exitosa!');

        return redirect('/obras_sociales');
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
        $obra_social = ObraSocial::findOrFail($id);

        $this->validarObraSocial($request);

        $input = $request->all();

        $obra_social->fill($input)->save();

        Session::flash('flash_message', 'Obra Social editado con éxito!');

        return redirect('/obras_sociales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obra_social = ObraSocial::findOrFail($id);
        $obra_social->delete();
        return redirect('/obras_sociales');
    }
}

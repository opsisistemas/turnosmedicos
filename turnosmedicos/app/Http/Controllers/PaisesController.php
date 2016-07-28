<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pais;

use Session;

class PaisesController extends Controller
{
    private function validarPais(Request $request){
        $this->validate($request, [
             'nombre' => 'required'
        ]);
    }

    public function getPais(Request $request)
    {
        $pais = Pais::where('id', $request->get('id'))->get();
        return response()->json(
            $pais->toArray()
        );
    }

    public function getPaises(Request $request)
    {
        $paises = Pais::all();
        return response()->json(
            $paises->toArray()
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Pais::paginate(30);
        return view('paises.index', array('paises' => $paises));
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
        $this->validarPais($request);

        $input = $request->all();
        
        Pais::create($input);

        Session::flash('flash_message', 'Alta de Pa&iacute;s exitosa!');

        return redirect('/paises');
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
        $pais = Pais::findOrFail($id);

        $this->validarPais($request);

        $input = $request->all();

        $pais->fill($input)->save();

        Session::flash('flash_message', 'Pa&iacute;s editado con éxito!');

        return redirect('/paises');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pais = Pais::findOrFail($id);
        $pais->delete();
        return redirect('/paises');
    }
}

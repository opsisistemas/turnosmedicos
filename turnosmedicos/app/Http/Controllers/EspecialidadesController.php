<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Especialidad;
use App\Medico;

use Session;

class EspecialidadesController extends Controller
{
    private function validarEspecialidad(Request $request){
        $this->validate($request, [
             'descripcion' => 'required'
        ]);
    }

    public function getEspecialidad(Request $request)
    {
        $especialidad = Especialidad::where('id', '=',  $request->get('id'))->get();
        return response()->json(
            $especialidad->toArray()
        );
    }

    public function getEspecialidades(Request $request)
    {
        $especialidades = Especialidad::all();
        return response()->json(
            $especialidades->toArray()
        );
    }

    public function medicosEspecialidad(Request $request)
    {
        $medicos = Medico::where('especialidad_id', '=',  $request->get('id'))->get();
        return response()->json(
            $medicos->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidades = Especialidad::paginate(30);
        return view('especialidades.index', array('especialidades' => $especialidades));
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
        $this->validarEspecialidad($request);

        $input = $request->all();
        
        Especialidad::create($input);

        Session::flash('flash_message', 'Alta de Especialidad exitosa!');

        return redirect('/especialidades');
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
        $especialidad = Especialidad::findOrFail($id);

        $this->validarEspecialidad($request);

        $input = $request->all();

        $especialidad->fill($input)->save();

        Session::flash('flash_message', 'Especialidad editada con éxito!');

        return redirect('/especialidades');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->delete();
        return redirect('/especialidades');
    }
}

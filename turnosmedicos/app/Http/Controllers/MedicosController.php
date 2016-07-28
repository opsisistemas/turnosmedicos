<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Medico;

use Session;
use Carbon\Carbon;

class MedicosController extends Controller
{
    private function validarMedico(Request $request){
        $this->validate($request, [
            'apellido' => 'required',
            'nombre' => 'required'
        ]);
    }

    public function getMedico(Request $request)
    {
        $medico = Medico::where('id', $request->get('id'))->get();
        return response()->json(
            $medico->toArray()
        );
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos = Medico::paginate(30);

        return view('medicos.index', array('medicos' => $medicos));
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
        $this->validarMedico($request);

        $input = $request->all();

        $input['fechaNacimiento'] = Carbon::createFromFormat('d-m-Y', $input['fechaNacimiento']);
        $input['duracionTurno'] = Carbon::createFromFormat('H:i', $input['duracionTurno']);

        Medico::create($input);

        Session::flash('flash_message', 'Alta de Medico exitosa!');

        return redirect('/medicos');
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
        $medico = Medico::findOrFail($id);

        $this->validarMedico($request);

        $input = $request->all();

        $medico->fill($input)->save();

        Session::flash('flash_message', 'Medico editado con éxito!');

        return redirect('/medicos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();
        return redirect('/medicos');
    }
}

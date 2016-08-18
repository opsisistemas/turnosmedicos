<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Paciente;
use App\Funciones;
use App\Pais;
use App\ObraSocial;
use App\User;

use Session;
use Carbon\Carbon;
use DB;
use Auth;

class PacientesController extends Controller
{
    private function validarPaciente(Request $request){
        $this->validate($request, [
            'apellido' => 'required',
            'nombre' => 'required'
        ]);
    }

    public function getPaciente(Request $request)
    {
        $paciente = Paciente::where('id', $request->get('id'))->get();
        return response()->json(
            $paciente->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::paginate(30);

        return view('pacientes.index', array('pacientes' => $pacientes));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::orderBy('nombre')->lists('nombre', 'id')->prepend('--Seleccionar--', '0');
        $obras_sociales = ObraSocial::orderBy('nombre')->lists('nombre', 'id')->prepend('--Seleccionar--', '0');

        return view('pacientes.create', ['paises' => $paises, 'obras_sociales' => $obras_sociales]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $this->validarPaciente($request);
            $input = $request->all();

            $input['fechaNacimiento'] = Carbon::createFromFormat('d-m-Y', $input['fechaNacimiento']);
            $input['user_id'] = $usuario->id;

            Paciente::create($input);

            Session::flash('flash_message', 'Alta de Paciente exitosa!');
        });
        return redirect('/');
    }

    public function persist(Request $request)
    {
        $user = Auth::user();
        $input = [];
        $input['user_id'] = $user->id;
        $input['nombre'] = $user->name;
        $input['apellido'] = '';

        Paciente::create($input);

        Session::flash('flash_message', 'Bienvenido '.$user->name.'!');

        return redirect('/');
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
        $paciente = Paciente::findOrFail($id);

        $this->validarPaciente($request);

        $input = $request->all();

        $input['fechaNacimiento'] = Carbon::createFromFormat('d-m-Y', $input['fechaNacimiento']);

        $paciente->fill($input)->save();

        Session::flash('flash_message', 'Paciente editado con éxito!');

        return redirect('/pacientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();
        return redirect('/pacientes');
    }
}

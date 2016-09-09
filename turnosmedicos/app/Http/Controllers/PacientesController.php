<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Paciente;
use App\Funciones;
use App\Pais;
use App\ObraSocial;
use App\User;
use App\Role;
use App\Empresa;

use Session;
use Carbon\Carbon;
use DB;
use Auth;
use Validator;
use Input;
use Mail;

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
        if(! Auth::user()->hasRole('admin')){
            return redirect('/');
        }else{
            $pacientes = Paciente::with('localidad')->with('obra_social')->orderBy('nombre')->paginate(30);
            $obras_sociales = ObraSocial::orderBy('nombre')->lists('nombre', 'id');
            $paises = Pais::orderBy('nombre')->lists('nombre', 'id');

            return view('pacientes.index', ['pacientes' => $pacientes, 'obras_sociales' => $obras_sociales, 'paises' => $paises]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('paciente')){
            return redirect('/');
        }else{
            $paises = Pais::orderBy('nombre')->lists('nombre', 'id')->prepend('--Seleccionar--', '0');
            $obras_sociales = ObraSocial::orderBy('nombre')->lists('nombre', 'id')->prepend('--Seleccionar--', '0');

            return view('pacientes.create', ['paises' => $paises, 'obras_sociales' => $obras_sociales]);
        }
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
        if(($user->pacienteAsociado()->isEmpty())&&(! $user->hasRole('medico'))){
            DB::transaction(function () use ($request, $user) {
                $input = [];
                $input['user_id'] = $user->id;
                $input['nombre'] = $user->name;
                $input['apellido'] = $user->surname;
                $input['email'] = $user->email;
                $input['nroDocumento'] = $user->dni;
                $input['obra_social_id'] = 1;
                $input['plan_id'] = 1;

                Paciente::create($input);

                $role = Role::where('name', '=', 'paciente')->first();
                $user->attachRole($role);

                if($user->email){
                    $this->mailBienvenida($user);
                }

                Session::flash('flash_message', 'Bienvenido/a '.$user->name.'!');
            });
        }

        return redirect('/');
    }

    private function mailBienvenida($user)
    {
        $data['empresa'] = Empresa::findOrFail(1);

        Mail::send('emails.bienvenida', $data, function ($message) use($user){
            $message->subject(Empresa::findOrFail(1)->nombre . ' - ' . 'Recepci&oacute;n de registro de usuario');
            $message->to($user->email);
        });
    }

    private function emailCancelaTurno($turno){
        $data['turno'] = $turno;
        $data['especialidad'] = Especialidad::findOrFail($turno->especialidad_id);
        $data['medico'] = Medico::findOrFail($turno->medico_id);
        $data['paciente'] = Paciente::findOrFail($turno->paciente_id);

        Mail::send('emails.cancelaturno', $data, function ($message) {
            $message->subject('Mensaje automático de Consultorio');
            $message->to(Empresa::findOrFail(1)->email);
        });
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

    public function perfil()
    {
        $id=Auth::user()->pacienteAsociado()->first()->id;
        $paciente = Paciente::findOrFail($id);
        $paises = Pais::orderBy('nombre')->lists('nombre', 'id');
        $obras_sociales = ObraSocial::orderBy('nombre')->lists('nombre', 'id');
        $email = Auth::user()->email;

        return view('pacientes.edit_completo', ['paciente' => $paciente, 'obras_sociales' => $obras_sociales, 'paises' => $paises, 'email' => $email]);
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

        if($request->get('aceptar') == 'confirmar'){
            $input['confirmado'] = true;

            $paciente->fill($input)->save();

            $this->emailConfirmado($paciente);

            Session::flash('flash_message', 'Paciente confirmado con éxito!');
        }else{
            $this->validarPaciente($request);

            $input = $request->all();

            $input['fechaNacimiento'] = Carbon::createFromFormat('d-m-Y', $input['fechaNacimiento']);

            $paciente->fill($input)->save();

            $this->actualizarDatosUsuario($input);

            Session::flash('flash_message', 'Perfil de Paciente editado con éxito!');
        }

        return redirect('/pacientes');

    }

    public function emailConfirmado($paciente)
    {
        $data['empresa'] = Empresa::findOrFail(1);

        Mail::send('emails.confirmado', $data, function ($message) use($paciente){
            $message->subject(Empresa::findOrFail(1)->nombre . ' - ' . 'Usted ha sido confirmado como paciente!');
            $message->to($paciente->user->email);
        });
    }


    public function actualizarDatosUsuario($input)
    {
        $user = User::findOrFail(Auth::user()->id);

        $datos=[];
        $datos['email'] = $input['email'];
        $datos['dni'] = $input['nroDocumento'];
        $datos['name'] = $input['nombre'];
        $datos['surname'] = $input['apellido'];

        $user->fill($datos)->save();
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

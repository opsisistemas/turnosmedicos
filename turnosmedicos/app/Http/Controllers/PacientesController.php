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
use App\TipoPago;

use Carbon\Carbon;
use Session, DB, Auth, Validator, Input, Mail, Redirect;

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
        if((Auth::user() !== null)&&((Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('owner')))){
            $pacientes = Paciente::with('localidad')->with('obra_social')->orderBy('nombre')->paginate(30);
            $obras_sociales = ObraSocial::orderBy('nombre')->lists('nombre', 'id');
            $paises = Pais::orderBy('nombre')->lists('nombre', 'id');

            return view('pacientes.index', ['pacientes' => $pacientes, 'obras_sociales' => $obras_sociales, 'paises' => $paises]);
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if((Auth::user() !== null)&&((Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('owner')))){
            $paises = Pais::orderBy('nombre')->lists('nombre', 'id')->prepend('--Seleccionar--', '0');
            $obras_sociales = ObraSocial::orderBy('nombre')->lists('nombre', 'id')->prepend('--Seleccionar--', '0');
            $tipospago = TipoPago::orderBy('codigo')->lists('codigo', 'id');

            return view('pacientes.create', ['paises' => $paises, 'obras_sociales' => $obras_sociales, 'tipospago' => $tipospago]);
        }else{
            return redirect('/');
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
        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'nroDocumento' => 'required',
            'telefono' => 'required',
            'password' => 'required'
        ];
        $errors = [
            'nombre' => 'Debe completar el nombre del paciente',
            'apellido' => 'Debe completar el apellido del paciente',
            'nroDocumento' => 'Debe completar el dni del paciente',
            'telefono' => 'Debe completar el telefono del paciente',
            'password' => 'Debe completar la clave de usuario para el paciente'
        ];
        $validator = Validator::make($request->all(), $rules, $errors);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('/pacientes/create')
                ->withErrors($errors)
                ->withInput($request->all());
        } else {
            //store
            DB::transaction(function () use ($request) {
                $input = $request->all();

                //alta de usuario asociado
                $datosUser = [];
                $datosUser['name'] = $input['nombre'];
                $datosUser['surname'] = $input['apellido'];
                $datosUser['dni'] = $input['nroDocumento'];
                $datosUser['email'] = $input['email'];
                $datosUser['password'] = bcrypt($input['password']);

                $usuario = User::create($datosUser);

                //alta de paciente con usuario asociado
                if($input['fechaNacimiento']){
                    $input['fechaNacimiento'] = Carbon::createFromFormat('d-m-Y', $input['fechaNacimiento']);
                }
                $input['user_id'] = $usuario->id;

                $paciente = Paciente::create($input);

                Session::flash('flash_message', 'Alta de Paciente exitosa!');
            });
            return redirect('/pacientes');
        }
    }

    /*Aquí viene desde AutController, sirve para cuando el usuario se da de alta por su cuenta*/
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
        $paises = Pais::orderBy('nombre')->lists('nombre', 'id')->prepend('--Seleccionar--', 0);
        $obras_sociales = ObraSocial::orderBy('nombre')->lists('nombre', 'id')->prepend('--Seleccionar--', 0);
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

            if($paciente->email){
                $this->emailConfirmado($paciente);
            }

            Session::flash('flash_message', 'Paciente confirmado con éxito!');
        }else{
            $this->validarPaciente($request);

            $input = $request->all();
            $input['user_id'] = $paciente->user()->get()->first()->id;

            try {
                $nueva_fechaNac = Carbon::createFromFormat('d-m-Y', $input['fechaNacimiento']);
            } catch (\Exception $e) {
                $nueva_fechaNac = $paciente->fechaNacimiento;
            }

            $input['fechaNacimiento'] = $nueva_fechaNac;

            if(isset($input['factura'])){
                $input['factura'] = ($input['factura'] == 'on') ? true : false;
            }else{
                $input['factura']= false;
            }

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
        $user = User::findOrFail($input['user_id']);

        $datos=[];
        if(isset($datos['email'])){
            $datos['email'] = $input['email'];
        }
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
        $user = $paciente->user()->first();

        $paciente->delete();
        $user->delete();

        return redirect('/pacientes');
    }
}

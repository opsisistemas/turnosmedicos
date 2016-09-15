<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Mensaje;
use App\Medico;
use App\Paciente;
use App\Asunto;

use \Carbon\Carbon;
use Session;
use DB;
use Auth;
use Validator;
use Redirect;

class MensajesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cantMensajes()
    {
        $mensajes = Mensaje::where('visto','0')->latest()->get();

        return $mensajes->count();
    }

    public function getMensaje(Request $request)
    {
        $mensaje = Mensaje::where('id', '=',  $request->get('id'))->get();

        return response()->json(
            $mensaje->toArray()
        );
    }

    public function setVisto($id, $checked){
        $mensaje = Mensaje::findOrFail($id);
        ($checked)? $mensaje['visto'] = 1 : $mensaje['visto'] = 0;
        $mensaje->save();

        return redirect('/mensajes');
    }

    public function index(Request $request)
    {
        //nos aseguramos de que los parámetros estén seteados (sino lo haacemos con valores por defecto), para poder buscar en BD de manera correcta
        $request->get('vistos')? $vistos = $request->get('vistos') : $vistos = 0;
        $request->get('desde')? $desde = Carbon::createFromFormat('d-m-Y', $request->get('desde')) : $desde = Carbon::now()->startOfDay()->subMonth();
        $request->get('hasta')? $hasta = Carbon::createFromFormat('d-m-Y', $request->get('hasta')) : $hasta = Carbon::now()->addDays(1)->startOfDay();

        $asuntos = Asunto::orderBy('nombre')->lists('nombre', 'id')->prepend('--Seleccionar--', '0');
        $medicos_list = Medico::select('id', DB::raw('concat(apellido, ", ", nombre) as apellido'))->orderBy('apellido')->lists('apellido', 'id')->prepend('--Seleccionar--', '0');
        $pacientes_list = Paciente::select('id', DB::raw('concat(apellido, ", ", nombre) as apellido'))->orderBy('apellido')->lists('apellido', 'id')->prepend('--Seleccionar--', '0');
        $medicos = Medico::select('id', DB::raw('concat(apellido, ", ", nombre) as apellido'))->orderBy('apellido')->lists('apellido', 'id');
        $request->get('medico_id')? $medico_id = $request->get('medico_id') : $medico_id = 0;
        $request->get('paciente_id')? $paciente_id = $request->get('paciente_id') : $paciente_id = 0;

        if(($medico_id != 0)&&($paciente_id == 0)){
            $mensajes = Mensaje::with('asunto')->with('paciente')->where('visto', '=', $vistos)->where('medico_id', '=', $medico_id)->whereBetween('created_at', [$desde, $hasta])->latest()->paginate(30);
        }elseif(($paciente_id != 0)&&($medico_id == 0)){
            $mensajes = Mensaje::with('asunto')->with('paciente')->where('visto', '=', $vistos)->where('paciente_id', '=', $paciente_id)->whereBetween('created_at', [$desde, $hasta])->latest()->paginate(30);
        }elseif(($paciente_id != 0)&&($medico_id != 0)){
            $mensajes = Mensaje::with('asunto')->with('paciente')->where('visto', '=', $vistos)->where('medico_id', '=', $medico_id)->where('paciente_id', '=', $paciente_id)->whereBetween('created_at', [$desde, $hasta])->latest()->paginate(30);
        }else{
            $mensajes = Mensaje::with('asunto')->with('paciente')->where('visto', '=', $vistos)->whereBetween('created_at', [$desde, $hasta])->latest()->paginate(30);
        }

        return view('mensajes.index', ['mensajes' => $mensajes, 'vistos' => $vistos, 'asuntos' => $asuntos, 'medicos' => $medicos, 'medicos_list' => $medicos_list, 'pacientes_list' => $pacientes_list, 'medico_id' => $medico_id, 'paciente_id' => $paciente_id, 'desde' => $desde, 'hasta' => $hasta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asuntos = Asunto::orderBy('nombre')->lists('nombre', 'id')->prepend('--Seleccionar--', '0');
        $medicos = Medico::select('id', DB::raw('concat(apellido, ", ", nombre) as apellido'))->orderBy('apellido')->lists('apellido', 'id');
        return view('mensajes.create', ['asuntos' => $asuntos, 'medicos' => $medicos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['cuerpo' => 'required'];
        $errors = ['cuerpo' => 'Debe completar el cuerpo del mensaje'];
        $validator = Validator::make($request->all(), $rules, $errors);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('mensajes.create')
                ->withErrors($errors)
                ->withInput($request->all());
        } else {
            // store
            $input = $request->all();
            $input['paciente_id'] = Auth::user()->pacienteAsociado()->first()->id;
            
            Mensaje::create($input);

            Session::flash('flash_message', 'Su mensaje ha sido enviado con &eacute;xito!');

            //redirect
            return redirect('/');
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
        $mensaje = Mensaje::findOrFail($id);

        $input = $request->all();

        isset($input['visto'])? $input['visto'] = 1 : $input['visto'] = 0;

        $mensaje->fill($input)->save();

        return redirect('/mensajes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

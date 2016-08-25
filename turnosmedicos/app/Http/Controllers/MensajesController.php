<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Mensaje;

use Session;
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

    public function index(Request $request)
    {
        $mensajes = Mensaje::where('visto', '=', $request->get('visto'))->with('paciente')->latest()->paginate('30');
        $request->get('visto')? $vistos = $request->get('visto') : $vistos = 0;

        return view('mensajes.index', ['mensajes' => $mensajes, 'vistos' => $vistos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mensajes.create');
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

        $input['visto'] == 'on'? $input['visto'] = 1 : $input['visto'] = 0;

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

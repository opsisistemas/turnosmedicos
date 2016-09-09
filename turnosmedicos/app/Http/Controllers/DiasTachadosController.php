<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\DiaTachado;

use Input, Redirect, Validator, Session;
use Carbon\Carbon;

use Mail;
use App\Empresa;

class DiasTachadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
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
        $rules = array(
            'medico_id' => 'required',
            'fecha' => 'required|date'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the errors
        if ($validator->fails()) {
            return Redirect::to($request->get('origen'))
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $input = $request->all();

            $input['fecha'] = Carbon::createFromFormat('d-m-Y', $input['fecha'])->startOfDay();

            $dia_tachado=DiaTachado::create($input);

            $this->maildiatachado($dia_tachado);

            Session::flash('flash_message', 'Nueva inasistencia informada de manera exitosa!');

            return redirect($request->get('origen'));
        }
    }

    private function maildiatachado($dia_tachado)
    {
        $data['dia_tachado'] = $dia_tachado;

        Carbon::setLocale('es');
        setlocale(LC_TIME, config('app.locale'));

        Mail::send('emails.diatachado', $data, function ($message) use($dia_tachado){
            $message->subject(Empresa::findOrFail(1)->nombre . ' - ' . 'Inasistencia informada por m&eacute;dico ' . $dia_tachado->medico->nombre . ' ' . $dia_tachado->medico->apellido . ' - ' . (new Carbon($dia_tachado->fecha))->formatLocalized('%A %d %B') );
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'medico_id' => 'required',
            'fecha' => 'required|date'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the errors
        if ($validator->fails()) {
            return Redirect::to($request->get('origen'))
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $input = $request->all();

            $input['fecha'] = Carbon::createFromFormat('d-m-Y', $input['fecha'])->startOfDay();

            $dia_tachado=DiaTachado::findOrFail($id);

            $dia_tachado->fill($input)->save();

            Session::flash('flash_message', 'Nueva inasistencia agregada de manera exitosa!');

            return redirect($request->get('origen'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dia_tachado = DiaTachado::findOrFail($id);
        $dia_tachado->delete();

        $this->mailcanceldiatachado($dia_tachado);

        return redirect('medicos.misdiastachados');
    }

    private function mailcanceldiatachado($dia_tachado)
    {
        $data['dia_tachado'] = $dia_tachado;

        Carbon::setLocale('es');
        setlocale(LC_TIME, config('app.locale'));

        Mail::send('emails.canceldiatachado', $data, function ($message) use($dia_tachado){
            $message->subject(Empresa::findOrFail(1)->nombre . ' - ' . 'Inasistencia dada de baja por m&eacute;dico ' . $dia_tachado->medico->nombre . ' ' . $dia_tachado->medico->apellido . ' - ' . (new Carbon($dia_tachado->fecha))->formatLocalized('%A %d %B') );
            $message->to(Empresa::findOrFail(1)->email);
        });
    }
}

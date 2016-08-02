<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Medico;
use App\Dia;
use App\Horario;
use App\Turno;

use Session;
use Carbon\Carbon;

class TurnosController extends Controller
{

    private function validarTurno(Request $request){
        $this->validate($request, [
            'paciente_id' => 'required',
            'especialidad_id' => 'required',
            'medico_id' => 'required',
            'dia' => 'required',
            'hora' => 'required'
        ]);
    }

    public function diaDisponible(Request $request)
    {
        $fecha=Carbon::createFromFormat('d-m-Y', $request->get('fecha'));
        $medico_id=$request->get('medico_id');

        //seteamos los datos necesarios para los cálculos: el médico, su horario en el día solicitado,
        //la cantidad en minutos que reporesenta ese horario, la duracion del turno, y la cantidad de 
        //turnos por día
        $medico = Medico::findOrFail($medico_id);
        $horario = Horario::where('medico_id', '=', $medico_id)->where('dia', '=', $fecha->dayOfWeek)->get();
        $minutosAtencion = (new Carbon($horario[0]->hasta))->diffInMinutes(new Carbon($horario[0]->desde));
        $duracionTurno = (new Carbon($medico->duracionTurno))->minute;
        $turnos_x_dia = $minutosAtencion / $duracionTurno;


        $horarios = [];
        $hora = Carbon::createFromFormat('Y-m-d H:i:s', $horario[0]->desde);
        for($i = 0; $i < $turnos_x_dia; $i++){
            $horarios[$hora->toTimeString()] = $this->verificarDisponibilidad($fecha, $hora);

            $hora = $hora->addMinutes($duracionTurno);
        }

        return $horarios;
    }

    private function verificarDisponibilidad(Carbon $fecha, Carbon $hora)
    {
        $turno = Turno::whereDate('fecha', '=', $fecha->startOfDay())->whereraw('hour(hora) = '.(string)$hora->hour)->whereraw('minute(hora) = '.(string)$hora->minute)->get();

        return $turno->isEmpty();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        return view('turnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarTurno($request);

        $input = $request->all();
        
        Turno::create($input);

        Session::flash('flash_message', 'Se ha solicitado un turno de manera exitosa');

        return redirect('/turnos');
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
        //
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

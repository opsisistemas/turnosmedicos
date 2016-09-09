<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Turno;
use App\Empresa;

use Mail;
use App\Medico;
use App\Especialidad;

use \Carbon\Carbon;

class RecordatorioTurno extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:turno';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un mail al paciente 24 horas antes de su turno';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $turnos = Turno::with('paciente')->whereDate('fecha', '>', Carbon::now())->get();
        foreach ($turnos as $turno) {
            $fechaHoraTurno = ($turno->fecha->addHours($turno->hora->hour)->addMinutes($turno->hora->minute));

            if($fechaHoraTurno->diffInHours(Carbon::now()) < 24){
                $this->mailTurno($turno);
            }
        }
    }

    private function mailTurno($turno)
    {
        $paciente = $turno->paciente;
        $medico = Medico::findOrFail($turno->medico_id);

        $data['turno'] = $turno;
        $data['especialidad'] = Especialidad::findOrFail($turno->especialidad_id);
        $data['medico'] = $medico;
        $data['empresa'] = Empresa::findOrFail(1);

        Mail::send('emails.recordatorio', $data, function ($message) use($medico, $turno, $paciente){
            $message->subject(Empresa::findOrFail(1)->nombre . ' - ' . 'Recordatorio de Turno: ' . $medico->apellido .
                ', ' . $medico->nombre . ' - ' . $turno->fecha->format('d-m-Y') .
                ' a las ' . $turno->hora->format('H:i'));
            $message->to(/*$paciente->email*/'r.richard0000@gmail.com');
        });
    }
}

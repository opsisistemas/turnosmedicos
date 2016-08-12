<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'paciente_id',
        'especialidad_id',
        'medico_id',
        'horario',
        'fecha',
        'hora'
    ];
    protected $dates = ['fecha', 'hora'];

    public function paciente()
    {
    	return $this->belongsTo('App\Paciente', 'paciente_id', 'id');
    }

    public function especialidad()
    {
    	return $this->hasOne('App\Especialidad', 'id', 'especialidad_id');
    }

    public function medico()
    {
    	return $this->hasOne('App\Medico', 'id', 'medico_id');
    }
}

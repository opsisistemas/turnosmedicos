<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = [
        'paciente_id',
        'asunto_id',
        'medico_id',
        'cuerpo',
        'visto'
    ];


    public function paciente()
    {
    	return $this->hasOne('App\Paciente', 'id', 'paciente_id');
    }

    public function asunto()
    {
        return $this->hasOne('App\Asunto', 'id', 'asunto_id');
    }

    public function medico()
    {
        return $this->belongsTo('App\Medico');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = [
        'paciente_id',
        'asunto',
        'destinatario',
        'cuerpo',
        'visto'
    ];


    public function paciente()
    {
    	return $this->hasOne('App\Paciente', 'id', 'paciente_id');
    }
}

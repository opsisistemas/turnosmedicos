<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'apellido',
        'nombre',
        'sexo',
        'telefono'
    ]; 
}

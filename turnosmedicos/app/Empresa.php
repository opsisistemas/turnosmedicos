<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	protected $table = 'empresa';
    protected $fillable = [
		'nombre',
		'location',
		'direccion',
		'email',
		'telefono1',
		'telefono2',
		'fax',
		'cuit',
		'inicio_actividades',
		'administrador',
		'email_administrador',
		'telefono_administrador'
	];
}

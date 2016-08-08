<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
	protected $table = 'pacientes';
    protected $fillable = [
        'apellido',
        'nombre',
        'tipoDocumento',
        'nroDocumento',
        'sexo',
        'fechaNacimiento',
        'telefono',
        'pais_id',
        'provincia_id',
        'localidad_id',
        'obra_social_id',
        'plan_id',
        'nro_afiliado'
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'fechaNacimiento'];

    public function plan()
    {
    	return $this->hasOne('App\Plan', 'id', 'plan_id');
    }

    public function obra_social()
    {
    	return $this->hasOne('App\ObraSocial', 'id', 'obra_social_id');
    }

    public function localidad()
    {
        return $this->hasOne('App\Localidad', 'id', 'localidad_id');
    }

    public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at', 'fechaNacimiento');
    }
}

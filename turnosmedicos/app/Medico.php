<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'apellido',
        'nombre',
        'tipoDocumento',
        'nroDocumento',
        'sexo',
        'fechaNacimiento',
        'telefono',
        'email',
        'duracionTurno',
        'especialidad_id'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'fechaNacimiento'];

    public function especialidad()
    {
    	return $this->hasOne('App\Especialidad', 'id', 'especialidad_id');
    }

    public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at', 'fechaNacimiento');
    }    
}

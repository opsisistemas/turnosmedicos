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
        'especialidad_id',
        'categoria_id',
        'tipo_matricula',
        'nro_matricula'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'fechaNacimiento'];

    public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at', 'fechaNacimiento');
    }  

    public function especialidades()
    {
    	return $this->belongsToMany('App\Especialidad');
    }

    public function dias()
    {
        return $this->belongsToMany('App\Dia')->withPivot('desde', 'hasta');
    }

    public function obras_sociales()
    {
        return $this->belongsToMany('App\ObraSocial');
    }

    public function categoria()
    {
        return $this->hasOne('App\Categoria_medico', 'id', 'categoria_id');
    }
}

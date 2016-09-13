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
        'nro_matricula',
        'user_id'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'fechaNacimiento'];

    public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at', 'fechaNacimiento');
    }  

    public function especialidades()
    {
    	return $this->hasMany('App\Especialidad');
    }

    public function dias()
    {
        return $this->hasMany('App\Dia')->withPivot('desde', 'hasta');
    }

    public function obras_sociales()
    {
        return $this->belongsToMany('App\ObraSocial');
    }

    public function categoria()
    {
        return $this->hasOne('App\Categoria_medico', 'id', 'categoria_id');
    }

    public function mensajes()
    {
        return $this->hasMany('App\Mensaje');
    }

    public function diasTachados()
    {
        return $this->hasMany('App\DiaTachado');
    }

    public function delete()
    {
        foreach($this->especialidades as $especialidad)
        {
            $especialidad->delete(); // call the File delete()
        }
        
        parent::delete();
    }
}

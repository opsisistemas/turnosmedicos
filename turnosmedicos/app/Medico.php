<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Horario;

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

    public function especialidad()
    {
    	return $this->hasOne('App\Especialidad', 'id', 'especialidad_id');
    }

    public function horarios(){
        return $this->hasMany('App\Horario', 'medico_id', 'id');
    }

    public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at', 'fechaNacimiento');
    }    

    public function turnos(Carbon $dia){
        return Turno::where('medico_id', '=', $this->id);
    }

    public function categoria($value='')
    {
        return $this->hasOne('App\Categoria', 'id', 'categoria_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'especialidades';
    protected $fillable = [
        'descripcion'
    ];

    public function medicos()
    {
    	return $this->belongsToMany('App/Medico');
    }
}

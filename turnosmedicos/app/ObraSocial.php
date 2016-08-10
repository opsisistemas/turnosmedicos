<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObraSocial extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'obras_sociales';
    protected $fillable = [
        'nombre',
        'pagina_web',
        'email',
        'telefono'
    ];

    public function medicos()
    {
        return $this->belongsToMany('App\Medico');
    }
}

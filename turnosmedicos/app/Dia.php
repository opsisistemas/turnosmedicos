<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre'
    ];

    public function medicos()
    {
        return $this->belongsToMany('App\Medico')->withPivot('desde', 'hasta');
    }
}

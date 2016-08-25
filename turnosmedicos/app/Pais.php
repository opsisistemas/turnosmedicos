<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'pais';
    protected $fillable = [
        'nombre'
    ];

    public function provincias()
    {
    	return $this->hasMany('App\Provincias', 'pais_id');
    }
}

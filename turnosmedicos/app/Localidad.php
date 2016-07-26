<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'localidades';
    protected $fillable = [
        'nombre',
        'provincia_id'
    ];

    public function provincia()
    {
    	return $this->belongsTo('App\Provincia', 'provincia_id', 'id');
    }
}

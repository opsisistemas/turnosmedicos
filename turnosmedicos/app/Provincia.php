<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'provincia';
    protected $fillable = [
        'nombre',
        'pais_id'
    ];

    public function pais()
    {
    	return $this->belongsTo('App\Pais', 'pais_id', 'id');
    }
}

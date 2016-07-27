<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'planes';
    protected $fillable = [
        'nombre',
        'obra_social_id'
    ];

    public function obra_social()
    {
    	return $this->belongsTo('App\ObraSocial', 'obra_social_id', 'id');
    }
}

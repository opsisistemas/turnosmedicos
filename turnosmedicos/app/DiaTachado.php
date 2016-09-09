<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaTachado extends Model
{
    protected $table = 'dias_tachados';
    protected $fillable = [
    	'medico_id',
    	'fecha',
    	'motivo'
    ];

    public function medico()
    {
    	return $this->belongsTo('App\Medico');
    }
}

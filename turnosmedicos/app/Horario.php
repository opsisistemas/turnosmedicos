<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'medico_id',
        'dia',
        'desde',
        'hasta'
    ];

    public function day()
    {
    	return $this->hasOne('App\Dia', 'id', 'dia');
    }
}

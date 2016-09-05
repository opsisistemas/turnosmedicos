<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feriado extends Model
{
    protected $fillable = [
    	'fecha',
    	'descripcion'
    ];
}

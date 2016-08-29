<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asunto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
}

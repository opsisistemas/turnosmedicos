<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    protected $fillable = [
        'codigo',
        'descripcion'
    ];
    protected $table = 'tipo_pago';
    public $timestamps = false;
}

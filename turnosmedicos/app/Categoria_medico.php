<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria_medico extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'categoria_medico';
    protected $fillable = [
        'descripcion'
    ];
}

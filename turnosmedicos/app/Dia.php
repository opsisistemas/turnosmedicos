<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre'
    ];
}

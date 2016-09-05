<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Paciente;
use App\Medico;

class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'dni', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopePacienteAsociado()
    {
        return Paciente::where('user_id', '=', $this->id)->get();
    }

    public function scopeMedicoAsociado()
    {
        return Medico::where('user_id', '=', $this->id)->get();
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Role;
use App\Permission;
use App\User;

class AddRolePacienteWithPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::transaction(function () {
                $paciente = new Role();
                $paciente->name         = 'paciente';
                $paciente->display_name = 'Paciente'; // optional
                $paciente->description  = '&Eacute;ste usuario es un paciente registrado'; // optional
                $paciente->save();

                //Now just need to add permissions to those Roles:

                $sacarTurno = new Permission();
                $sacarTurno->name         = 'sacar_turno';
                $sacarTurno->display_name = 'Sacar Turno'; // optional
                // Allow a user to...
                $sacarTurno->description  = 'Permitido sacar turnos a un paciente'; // optional
                $sacarTurno->save();

                $paciente->attachPermission($sacarTurno);
                // equivalent to $paciente->perms()->sync(array($sacarTurno->id));
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::transaction(function () {
                $role = Role::where('name', '=', 'paciente')->delete();

                // Force Delete
                $role->users()->sync([]); // Delete relationship data
                $role->perms()->sync([]); // Delete relationship data

                $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete

                Permission::where('name', '=', 'sacar_turnos')->delete();
            });
        });
    }
}

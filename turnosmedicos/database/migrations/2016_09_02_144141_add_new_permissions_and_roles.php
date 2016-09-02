<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Role;
use App\Permission;
use App\User;

class AddNewPermissionsAndRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            DB::transaction(function () {
                $medico = new Role();
                $medico->name         = 'medico';
                $medico->display_name = 'M&eacute;dico'; // optional
                $medico->description  = '&Eacute;ste usuario es un m&eacute;dico registrado'; // optional
                $medico->save();

                //Now just need to add permissions to those Roles:

                $crear_usuarios = new Permission();
                $crear_usuarios->name         = 'crear_usuarios';
                $crear_usuarios->display_name = 'Crear usuarios'; // optional
                // Allow a user to...
                $crear_usuarios->description  = 'Permitido crear usuarios'; // optional
                $crear_usuarios->save();

                $sacar_entre_turnos = new Permission();
                $sacar_entre_turnos->name         = 'sacar_entre_turnos';
                $sacar_entre_turnos->display_name = 'Sacar entre-turnos'; // optional
                // Allow a user to...
                $sacar_entre_turnos->description  = 'Permitido sacar entre-turnos'; // optional
                $sacar_entre_turnos->save();

                $mover_turnos = new Permission();
                $mover_turnos->name         = 'mover_turnos';
                $mover_turnos->display_name = 'Mover turnos'; // optional
                // Allow a user to...
                $mover_turnos->description  = 'Permitido mover turnos'; // optional
                $mover_turnos->save();

                $owner = Role::where('name', '=', 'owner')->first();

                $owner->attachPermission($crear_usuarios);
                $owner->attachPermission($sacar_entre_turnos);
                $owner->attachPermission($mover_turnos);
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
        Schema::table('roles', function (Blueprint $table) {
            DB::transaction(function () {
                $role = Role::where('name', '=', 'medico')->delete();

                // Force Delete
                $role->users()->sync([]); // Delete relationship data
                $role->perms()->sync([]); // Delete relationship data

                $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete

                Permission::where('name', '=', 'crear_usuarios')->delete();
                Permission::where('name', '=', 'sacar_entre_turnos')->delete();
                Permission::where('name', '=', 'mover_turnos')->delete();
            });
        });
    }
}

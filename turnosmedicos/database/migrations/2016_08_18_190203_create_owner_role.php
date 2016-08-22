<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Role;
use App\Permission;
use App\User;

class CreateOwnerRole extends Migration
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
                $owner = new Role();
                $owner->name         = 'owner';
                $owner->display_name = 'Project Owner'; // optional
                $owner->description  = '&Eacute;ste usuario es el due&ntilde;o del proyecto'; // optional
                $owner->save();

                $admin = new Role();
                $admin->name         = 'admin';
                $admin->display_name = 'Usuario Administrador'; // optional
                $admin->description  = '&Eacute;ste usuario puede editar y crear otros usuarios'; // optional
                $admin->save();

                //Next, with both roles created let's assign them to the users. Thanks to the HasRole trait this is as easy as:

                $user = User::where('name', '=', 'sistemas')->first();

                // role attach alias
                $user->attachRole($admin); // parameter can be an Role object, array, or id

                //Now just need to add permissions to those Roles:

                $darTurnos = new Permission();
                $darTurnos->name         = 'dar_turnos';
                $darTurnos->display_name = 'Dar Turnos'; // optional
                // Allow a user to...
                $darTurnos->description  = 'Permitido dar turnos a un paciente'; // optional
                $darTurnos->save();

                $editUser = new Permission();
                $editUser->name         = 'editar_usuarios';
                $editUser->display_name = 'Editar Usuarios'; // optional
                // Allow a user to...
                $editUser->description  = 'Permitido Editar Usuario Existentes'; // optional
                $editUser->save();

                $admin->attachPermission($darTurnos);
                // equivalent to $admin->perms()->sync(array($darTurnos->id));

                $owner->attachPermissions(array($darTurnos, $editUser));
                // equivalent to $owner->perms()->sync(array($darTurnos->id, $editUser->id));
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
                $role = Role::where('name', '=', 'owner')->delete();

                // Force Delete
                $role->users()->sync([]); // Delete relationship data
                $role->perms()->sync([]); // Delete relationship data

                $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete

                $role = Role::where('name', '=', 'admin')->delete();

                // Force Delete
                $role->users()->sync([]); // Delete relationship data
                $role->perms()->sync([]); // Delete relationship data

                $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete

                Permission::where('name', '=', 'dar_turnos')->delete();
                Permission::where('name', '=', 'editar_usuarios')->delete();
            });
        });
    }
}

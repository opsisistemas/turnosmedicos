<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Role;
use App\Permission;
use App\User;

class AddSecretarias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(
            array(
                'name' => 'secretaria',
                'surname' => 'nro1',
                'dni' => '100',
                'password' => bcrypt('consultorio')
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'secretaria',
                'surname' => 'nro2',
                'dni' => '200',
                'password' => bcrypt('consultorio')
            )
        );

        $user1 = User::where('surname', '=', 'nro1')->first();
        $user2 = User::where('surname', '=', 'nro2')->first();
        $role = Role::where('name', '=', 'admin')->first();

        $user1->attachRole($role);
        $user2->attachRole($role);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user1 = User::where('surname', '=', 'nro1')->first();
        $user2 = User::where('surname', '=', 'nro2')->first();

        $user1->delete();
        $user2->delete();
    }

}

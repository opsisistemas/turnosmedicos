<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\User;
use App\Role;

class UpdateSuperuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::where('name', '=', 'sistemas')->delete();

        DB::table('users')->insert(
            array(
                'email' => 'openfg.soft@gmail.com',
                'name' => 'sistemas',
                'surname' => 'OPSI',
                'dni' => '32392735',
                'password' => bcrypt('open6736')
            )
        );

        $user = User::where('name', '=', 'sistemas')->first();

        $role = Role::where('name', '=', 'owner')->first();
        $user->attachRole($role);

        $role = Role::where('name', '=', 'admin')->first();
        $user->attachRole($role);

        DB::table('obras_sociales')->insert(
            array(
                'nombre' => 'IOMA'
            )
        );

        DB::table('planes')->insert(
            array(
                'nombre' => 'Ambulatorio',
                'obra_social_id' => 1
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

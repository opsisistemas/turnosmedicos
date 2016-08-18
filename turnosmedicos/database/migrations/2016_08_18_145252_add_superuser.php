<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class AddSuperuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // Insert super user
        DB::table('users')->insert(
            array(
                'email' => 'openfg.soft@gmail.com',
                'name' => 'sistemas',
                'password' => bcrypt('open6736'),
                'role_id' => 1
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
        User::where('name', '=', 'sistemas')->delete();
    }
}

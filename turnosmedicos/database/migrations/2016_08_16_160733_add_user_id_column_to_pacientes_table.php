<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdColumnToPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            //cada paciente debería tener un usuario asociado, con role_id=3
            //para correr ésta migración, la tabla 'pacientes' debe estar vacía, 
            //al vaciarla, se eliminarán los turnos asociados en cascada
            $table->integer('user_id')->unsigned();
            $table->boolean('confirmado')->default(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropForeign('pacientes_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('confirmado');
        });
    }
}

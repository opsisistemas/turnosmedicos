<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicos', function (Blueprint $table) {
            //cada medico debería tener un usuario asociado, con role = 'medico'
            //para correr ésta migración, la tabla 'medicos' debe estar vacía, 
            //al vaciarla, se eliminarán los turnos asociados en cascada
            $table->integer('user_id')->unsigned();
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
        Schema::table('medicos', function (Blueprint $table) {
            $table->dropForeign('medicos_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}

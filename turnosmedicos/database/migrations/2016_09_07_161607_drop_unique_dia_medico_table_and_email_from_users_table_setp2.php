<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUniqueDiaMedicoTableAndEmailFromUsersTableSetp2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dia_medico', function (Blueprint $table) {
            $table->dropForeign('dia_medico_medico_id_foreign');

            $table->dropUnique('dia_medico_dia_id_medico_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dia_medico', function (Blueprint $table) {
            $table->foreign('medico_id')->references('id')->on('dias');
            $table->unique(array('dia_id', 'medico_id'));
        });
    }
}

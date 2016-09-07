<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUniqueDiaMedicoTableAndEmailFromUsersTableSetp1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dia_medico', function (Blueprint $table) {
            $table->dropForeign('dia_medico_dia_id_foreign');
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
            $table->foreign('dia_id')->references('id')->on('dias');
        });
    }
}

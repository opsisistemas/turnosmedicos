<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicos', function (Blueprint $table) {
            $table->integer('categoria_id')->unsigned()->default(1);
            $table->foreign('categoria_id')->references('id')->on('categoria_medico')->onDelete('cascade');

            $table->char('tipo_matricula')->default('P');
            $table->integer('nro_matricula')->unsigned();
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
            $table->dropColumn('categoria_id');
            $table->dropForeign('categoria_id');

            $table->dropColumn('tipo_matricula');
            $table->dropColumn('nro_matricula');
        });
    }
}

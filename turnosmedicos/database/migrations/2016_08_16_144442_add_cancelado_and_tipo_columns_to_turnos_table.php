<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCanceladoAndTipoColumnsToTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('turnos', function (Blueprint $table) {
            //el tipo de turno puede ser 'R' (Regular), o 'E' (EntreTurno)
            $table->char('tipo')->default('R');
            $table->boolean('cancelado')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->dropColumn('tipo');
            $table->dropColumn('cancelado');
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('paciente_id')->unsigned();
            $table->integer('especialidad_id')->unsigned();
            $table->integer('medico_id')->unsigned();
            $table->timestamp('fecha');
            $table->timestamp('hora');

            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('cascade');
            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('turnos');
    }
}

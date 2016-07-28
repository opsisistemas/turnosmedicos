<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('apellido', 100);
            $table->string('nombre', 100);
            $table->integer('tipoDocumento');
            $table->string('nroDocumento', 15);
            $table->char('sexo', 1);
            $table->timestamp('fechaNacimiento');
            $table->string('telefono', 25);
            $table->string('email', 100);
            $table->timeStamp('duracionTurno');
            $table->integer('especialidad_id')->unsigned();

            $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicos');
    }
}

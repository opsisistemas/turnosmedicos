<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('apellido', 100);
            $table->string('nombre', 100);
            $table->integer('tipoDocumento');
            $table->string('nroDocumento', 15);
            $table->char('sexo', 1);
            $table->date('fechaNacimiento');
            $table->integer('idPais');
            $table->integer('idProvincia');
            $table->integer('idLocalidad');
            $table->string('telefono', 25);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pacientes');
    }
}

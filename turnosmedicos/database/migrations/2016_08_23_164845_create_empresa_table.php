<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre', 100);

            //para gmaps
            $table->string('location', 50)->nullable();

            //datos empresa
            $table->string('direccion', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('telefono1', 50)->nullable();
            $table->string('telefono2', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('cuit', 13)->nullable();
            $table->timestamp('inicio_actividades')->nullable();

            //datos administrador empresa
            $table->string('administrador')->nullable();
            $table->string('email_administrador', 250)->nullable();
            $table->string('telefono_administrador')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('empresa');
    }
}

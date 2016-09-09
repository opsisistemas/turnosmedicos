<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiasTachadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dias_tachados', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('medico_id')->unsigned();
            $table->timestamp('fecha');

            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->string('motivo', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dias_tachados');
    }
}

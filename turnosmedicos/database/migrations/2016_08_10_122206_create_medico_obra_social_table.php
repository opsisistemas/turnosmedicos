<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicoObraSocialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medico_obra_social', function (Blueprint $table) {
            $table->integer('obra_social_id')->unsigned();
            $table->foreign('obra_social_id')->references('id')->on('obras_sociales');

            $table->integer('medico_id')->unsigned();
            $table->foreign('medico_id')->references('id')->on('medicos');

            $table->unique(array('medico_id', 'obra_social_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medico_obra_social');
    }
}

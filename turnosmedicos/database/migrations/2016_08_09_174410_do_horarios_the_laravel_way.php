<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DoHorariosTheLaravelWay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('horarios');

        Schema::create('dia_medico', function (Blueprint $table) {
            $table->integer('dia_id')->unsigned();
            $table->foreign('dia_id')->references('id')->on('dias');

            $table->integer('medico_id')->unsigned();
            $table->foreign('medico_id')->references('id')->on('medicos');

            $table->timestamp('desde');
            $table->timestamp('hasta');

            $table->unique(array('dia_id', 'medico_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dia_medico');

        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medico_id')->unsigned();
            $table->integer('dia');
            $table->timestamp('desde');
            $table->timestamp('hasta');

            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');
            $table->unique(array('medico_id', 'dia'));
        });
    }
}

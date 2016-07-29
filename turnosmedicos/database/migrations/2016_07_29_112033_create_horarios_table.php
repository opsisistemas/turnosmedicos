<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('horarios');
    }
}

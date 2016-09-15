<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeSomeColumnsNullableToPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->integer('obra_social_id')->unsigned()->nullable()->change();
            $table->integer('plan_id')->unsigned()->nullable()->change();

            $table->integer('pais_id')->unsigned()->nullable()->change();
            $table->integer('provincia_id')->unsigned()->nullable()->change();
            $table->integer('localidad_id')->unsigned()->nullable()->change();

            $table->date('fechaNacimiento')->nullable()->change();
            $table->string('telefono', 25)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->integer('obra_social_id')->unsigned()->change();
            $table->integer('plan_id')->unsigned()->change();
        });
    }
}

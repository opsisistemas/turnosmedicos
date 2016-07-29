<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiasToDiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('dias')->insert([
            'nombre' => 'lunes',
        ]);
        DB::table('dias')->insert([
            'nombre' => 'martes',
        ]);
        DB::table('dias')->insert([
            'nombre' => 'miercoles',
        ]);
        DB::table('dias')->insert([
            'nombre' => 'jueves',
        ]);
        DB::table('dias')->insert([
            'nombre' => 'viernes',
        ]);
        DB::table('dias')->insert([
            'nombre' => 'sabado',
        ]);
        DB::table('dias')->insert([
            'nombre' => 'domingo',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dias', function (Blueprint $table) {
            DB::table('dias')->truncate();
        });
    }
}

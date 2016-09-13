<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertsCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('categoria_medico')->insert(
            array(
                'descripcion' => 'A'
            )
        );

        DB::table('categoria_medico')->insert(
            array(
                'descripcion' => 'B'
            )
        );

        DB::table('categoria_medico')->insert(
            array(
                'descripcion' => 'C'
            )
        );

        DB::table('categoria_medico')->insert(
            array(
                'descripcion' => 'Arancel Libre'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categoria_medico')->truncate();
    }
}

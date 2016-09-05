<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use \Carbon\Carbon;

class AddSomeFeriadosToFeriadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('feriados')->insert(
            array(
                'descripcion' => 'A&ntilde;o Nuevo',
                'fecha' => Carbon::createFromDate(2016, 1, 1)
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Carnaval',
                'fecha' => Carbon::createFromDate(2016, 2, 8)
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Carnaval',
                'fecha' => Carbon::createFromDate(2016, 2, 9)
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
        DB::table('feriados')->truncate();
    }
}

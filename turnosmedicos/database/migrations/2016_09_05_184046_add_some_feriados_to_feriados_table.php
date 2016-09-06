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
                'fecha' => Carbon::createFromDate(2016, 1, 1)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Carnaval',
                'fecha' => Carbon::createFromDate(2016, 2, 8)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Carnaval',
                'fecha' => Carbon::createFromDate(2016, 2, 9)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'D&iacute;a Nacional de la Memoria por la Verdad y la Justicia',
                'fecha' => Carbon::createFromDate(2016, 3, 24)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Viernes Santo - Festividad Cristiana',
                'fecha' => Carbon::createFromDate(2016, 3, 25)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'D&iacute;a del Veterano y de los Ca&iacute;dos en la Guerra de Malvinas',
                'fecha' => Carbon::createFromDate(2016, 4, 2)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Pascua Jud&iacute;a',
                'fecha' => Carbon::createFromDate(2016, 4, 22)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Pascua Jud&iacute;a',
                'fecha' => Carbon::createFromDate(2016, 4, 23)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Pascua Jud&iacute;a',
                'fecha' => Carbon::createFromDate(2016, 4, 24)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Pascua Jud&iacute;a',
                'fecha' => Carbon::createFromDate(2016, 4, 28)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Pascua Jud&iacute;a',
                'fecha' => Carbon::createFromDate(2016, 4, 29)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Pascua Jud&iacute;a',
                'fecha' => Carbon::createFromDate(2016, 4, 30)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'D&iacute;a del trabajador',
                'fecha' => Carbon::createFromDate(2016, 5, 1)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'D&iacute;a de la Revoluci&oacute;n de Mayo',
                'fecha' => Carbon::createFromDate(2016, 5, 25)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'D&iacute;a Paso a la Inmortalidad del Gral. Manuel Belgrano',
                'fecha' => Carbon::createFromDate(2016, 6, 20)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Puente Tur&iacute;stico',
                'fecha' => Carbon::createFromDate(2016, 7, 8)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'D&iacute;a de la Independencia',
                'fecha' => Carbon::createFromDate(2016, 7, 9)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Paso a la Inmortalidad del Gral. Jos&eacute; de San Mart&iacute;n (17/8)',
                'fecha' => Carbon::createFromDate(2016, 8, 15)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'A&ntilde;o Nuevo Jud&iacute;o',
                'fecha' => Carbon::createFromDate(2016, 10, 4)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'D&iacute;a del Respeto a la Diversidad Cultural (12/10)',
                'fecha' => Carbon::createFromDate(2016, 10, 10)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'D&iacute;a del Perd&oacute;n',
                'fecha' => Carbon::createFromDate(2016, 10, 12)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'D&iacute;a de la Soberan&iacute;a Nacional',
                'fecha' => Carbon::createFromDate(2016, 11, 28)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Inmaculada Concepci&oacute;n de Mar&iacute;a',
                'fecha' => Carbon::createFromDate(2016, 12, 8)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Puente Tur&iacute;stico',
                'fecha' => Carbon::createFromDate(2016, 12, 9)->startOfDay()
            )
        );

        DB::table('feriados')->insert(
            array(
                'descripcion' => 'Navidad',
                'fecha' => Carbon::createFromDate(2016, 12, 25)->startOfDay()
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

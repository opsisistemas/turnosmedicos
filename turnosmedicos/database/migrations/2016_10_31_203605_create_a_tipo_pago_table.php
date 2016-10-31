<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateATipoPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_pago', function (Blueprint $table) {
            $table->increments('id');
            $table->char('codigo');
            $table->string('descripcion');
        });

        DB::table('tipo_pago')->insert(
            array(
                'codigo' => 'M',
                'descripcion' => 'Medico',
            )
        );

        DB::table('tipo_pago')->insert(
            array(
                'codigo' => 'F',
                'descripcion' => 'Familiar',
            )
        );

        DB::table('tipo_pago')->insert(
            array(
                'codigo' => 'A',
                'descripcion' => 'Amigo',
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
        Schema::drop('tipo_pago');
    }
}

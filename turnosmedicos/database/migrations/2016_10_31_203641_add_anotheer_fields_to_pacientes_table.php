<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnotheerFieldsToPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->integer('tipo_pago_id')->unsigned()->default(1);
            $table->boolean('factura')->default(true);
            $table->text('observaciones');

            $table->foreign('tipo_pago_id')->references('id')->on('tipo_pago');
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
            $table->dropForeign('pacientes_tipo_pago_id_foreign');

            $table->dropColumn('tipo_pago_id');
            $table->dropColumn('factura');
            $table->dropColumn('observaciones');
        });
    }
}

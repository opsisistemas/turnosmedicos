<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAsuntoFieldToAsuntoIdInMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mensajes', function (Blueprint $table) {
            $table->dropColumn('asunto');
            $table->integer('asunto_id')->unsigned()->default(1);

            $table->foreign('asunto_id')->references('id')->on('asuntos');

            $table->dropColumn('destinatario');
            $table->integer('medico_id')->unsigned()->default(1);

            $table->foreign('medico_id')->references('id')->on('medicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mensajes', function (Blueprint $table) {
            $table->dropForeign('mensajes_asunto_id_foreign');
            $table->dropColumn('asunto_id');

            $table->dropForeign('mensajes_medico_id_foreign');
            $table->dropColumn('medico_id');

            $table->string('asunto', 100)->nullable();
            $table->string('destinatario', 100)->nullable();
        });
    }
}

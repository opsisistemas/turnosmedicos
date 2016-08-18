<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForeignsToNullableInPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropColumn('plan_id');
            $table->dropColumn('obra_social_id');
            
            $table->dropForeign('pacientes_plan_id_foreign');
            $table->dropForeign('pacientes_obra_social_id_foreign');
        });

        Schema::table('pacientes', function (Blueprint $table) {
            $table->integer('plan_id')->nullable()->unsigned();
            $table->integer('obra_social_id')->nullable()->unsigned();
            
            $table->foreign('plan_id')->references('id')->on('planes');
            $table->foreign('obra_social_id')->references('id')->on('obras_sociales');
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
            $table->dropForeign('pacientes_obra_social_id_foreign');
            $table->dropForeign('pacientes_plan_id_foreign');

            $table->dropColumn('plan_id');
            $table->dropColumn('obra_social_id');
        });

        Schema::table('pacientes', function (Blueprint $table) {
            $table->integer('pacientes_obra_social_id_foreign')->unsigned();
            $table->integer('pacientes_plan_id_foreign')->unsigned();

            $table->foreign('plan_id')->references('id')->on('planes');
            $table->foreign('obra_social_id')->references('id')->on('obras_sociales');
        });
    }
}

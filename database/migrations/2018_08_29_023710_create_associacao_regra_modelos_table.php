<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociacaoRegraModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associacao_regra_modelos', function (Blueprint $table) {
            $table->bigincrements('cod_associacao_regra_modelo')->unsigned();

            $table->bigInteger('cod_modelo')->unsigned();
            $table->bigInteger('cod_regra')->unsigned();

            $table->string('nome');
            $table->string('tipo')->default('grupo');

            $table->timestamps();
        });

//        Schema::table('associacao_regra_modelos', function($table) {
//            $table->foreign('cod_regra')->references('cod_regra')->on('regras');
//        });
//
//        Schema::table('associacao_regra_modelos', function($table) {
//            $table->foreign('cod_modelo')->references('cod_modelo')->on('modelos');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associacao_regra_modelos');
    }
}

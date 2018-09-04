<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociacaoModeloProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associacao_modelo_projetos', function (Blueprint $table) {
            $table->bigincrements('cod_associacao_modelo_projeto')->unsigned();

            $table->bigInteger('cod_modelo')->unsigned();
            $table->bigInteger('cod_projeto')->unsigned();

            $table->string('nome');
            $table->string('tipo')->default('grupo');

            $table->timestamps();
        });

//        Schema::table('associacao_modelo_projetos', function($table) {
//            $table->foreign('cod_modelo')->references('cod_modelo')->on('modelos');
//        });
//
//        Schema::table('associacao_modelo_projetos', function($table) {
//            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associacao_modelo_projetos');
    }
}

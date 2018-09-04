<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociacaoProjetoRepositoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associacao_projeto_repositorios', function (Blueprint $table) {
            $table->bigincrements('cod_associacao_projeto_repositorio')->unsigned();

            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_projeto')->unsigned();

            $table->string('nome');
            $table->string('tipo')->default('grupo');

            $table->timestamps();
        });

//        Schema::table('associacao_projeto_repositorios', function($table) {
//            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
//        });
//
//        Schema::table('associacao_projeto_repositorios', function($table) {
//            $table->foreign('cod_repositorio')->references('cod_repositorio')->on('repositorios');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associacao_projeto_repositorios');
    }
}

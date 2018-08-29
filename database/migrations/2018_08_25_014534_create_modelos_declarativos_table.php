<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelosDeclarativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('modelos_declarativos', function (Blueprint $table) {
            $table->increments('cod_modelo_declarativo');

            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_projeto')->unsigned();
            $table->bigInteger('cod_usuario')->unsigned();

            $table->string('nome');
            $table->string('tipo')->default('declarativo');
            $table->string('descricao');
            $table->boolean('visibilidade')->default(true);
            $table->boolean('publico')->default(true);

            $table->timestamps();
        });

        Schema::connection('banco')->table('modelos_declarativos', function($table) {
            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
        });

        Schema::connection('banco')->table('modelos_declarativos', function($table) {
            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
        });

        Schema::connection('banco')->table('modelos_declarativos', function($table) {
            $table->foreign('cod_repositorio')->references('cod_repositorio')->on('repositorios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modelo_declarativos');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjetoFluxosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('objetos_fluxos', function (Blueprint $table) {

            $table->increments('cod_objeto_fluxo');

            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_regra')->nullable();
            $table->bigInteger('cod_usuario')->unsigned();
            $table->bigInteger('cod_projeto')->unsigned();
            $table->bigInteger('cod_modelo_declarativo')->unsigned();

            $table->string('nome');
            $table->string('descricao');
            $table->string('tipo')->default('objeto fluxo');
            $table->boolean('visivel_projeto')->default('false');
            $table->boolean('visivel_repositorio')->default('false');
            $table->boolean('visivel_modelo_declarativo')->default('false');
            
            $table->timestamps();
        });

        Schema::connection('banco')->table('objetos_fluxos', function($table) {
            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
        });

        Schema::connection('banco')->table('objetos_fluxos', function($table) {
            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
        });

        Schema::connection('banco')->table('objetos_fluxos', function($table) {
            $table->foreign('cod_repositorio')->references('cod_repositorio')->on('repositorios');
        });

        Schema::connection('banco')->table('objetos_fluxos', function($table) {
            $table->foreign('cod_modelo_declarativo')->references('cod_modelo_declarativo')->on('modelos_declarativos');
        });

        Schema::connection('banco')->table('objetos_fluxos', function($table) {
            $table->foreign('cod_regra')->references('cod_regra')->on('regras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objeto_fluxos');
    }
}

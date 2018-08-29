<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('regras', function (Blueprint $table) {
            $table->increments('cod_regra');

            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_usuario')->unsigned();
            $table->bigInteger('cod_projeto')->unsigned();
            $table->bigInteger('cod_modelo_declarativo')->unsigned();

            $table->bigInteger('codoutraregra')->nullable();


            $table->string('nome');
            $table->string('tipo')->default('regra');
            $table->integer('relacionamento')->default(0);

            $table->boolean('visivel_projeto')->default(true);
            $table->boolean('visivel_repositorio')->default(true);
            $table->boolean('visivel_modelo_declarativo')->default(true);

            $table->timestamps();
        });

        Schema::connection('banco')->table('regras', function($table) {
            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
        });

        Schema::connection('banco')->table('regras', function($table) {
            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
        });

        Schema::connection('banco')->table('regras', function($table) {
            $table->foreign('cod_repositorio')->references('cod_repositorio')->on('repositorios');
        });

        Schema::connection('banco')->table('regras', function($table) {
            $table->foreign('cod_modelo_declarativo')->references('cod_modelo_declarativo')->on('modelos_declarativos');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regras');
    }
}

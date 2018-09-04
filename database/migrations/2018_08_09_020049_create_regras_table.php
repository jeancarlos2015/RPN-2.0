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
        Schema::create('regras', function (Blueprint $table) {
            $table->bigincrements('cod_regra');

            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_usuario')->unsigned();
            $table->bigInteger('cod_projeto')->unsigned();
            $table->bigInteger('cod_modelo_declarativo')->unsigned();

            $table->bigInteger('cod_outra_regra')->nullable();
            $table->boolean('publico')->default(true);

            $table->string('nome');
            $table->string('tipo')->default('regra');
            $table->integer('relacionamento')->default(0);

            $table->timestamps();
        });

//        Schema::table('regras', function($table) {
//            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
//        });
//
//        Schema::table('regras', function($table) {
//            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
//        });
//
//        Schema::table('regras', function($table) {
//            $table->foreign('cod_repositorio')->references('cod_repositorio')->on('repositorios');
//        });
//
//        Schema::table('regras', function($table) {
//            $table->foreign('cod_modelo_declarativo')->references('cod_modelo_declarativo')->on('modelos_declarativos');
//        });

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

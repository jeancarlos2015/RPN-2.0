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
        Schema::create('objetos_fluxos', function (Blueprint $table) {

            $table->bigincrements('cod_objeto_fluxo');

            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_regra')->nullable();
            $table->bigInteger('cod_usuario')->unsigned();
            $table->bigInteger('cod_projeto')->unsigned();

            $table->bigInteger('cod_modelo')->unsigned();

            $table->string('nome');
            $table->string('descricao');
            $table->string('tipo')->default('objeto fluxo');
            $table->boolean('publico')->default(true);

            $table->timestamps();
        });

//        Schema::table('objetos_fluxos', function($table) {
//            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
//        });
//
//        Schema::table('objetos_fluxos', function($table) {
//            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
//        });
//
//        Schema::table('objetos_fluxos', function($table) {
//            $table->foreign('cod_repositorio')->references('cod_repositorio')->on('repositorios');
//        });
//
//        Schema::table('objetos_fluxos', function($table) {
//            $table->foreign('cod_modelo_declarativo')->references('cod_modelo_declarativo')->on('modelos_declarativos');
//        });
//
//        Schema::table('objetos_fluxos', function($table) {
//            $table->foreign('cod_regra')->references('cod_regra')->on('regras');
//        });
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

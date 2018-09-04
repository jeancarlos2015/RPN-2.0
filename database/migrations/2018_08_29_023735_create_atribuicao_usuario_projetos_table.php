<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtribuicaoUsuarioProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atribuicao_usuario_projetos', function (Blueprint $table) {
            $table->bigincrements('cod_atribuicao_usuario_projeto')->unsigned();

            $table->bigInteger('cod_usuario')->unsigned();
            $table->bigInteger('cod_projeto')->unsigned();

            $table->string('nome');
            $table->string('tipo')->default('grupo');

            $table->timestamps();
        });
//
//        Schema::table('atribuicao_usuario_projetos', function($table) {
//            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
//        });
//
//        Schema::table('atribuicao_usuario_projetos', function($table) {
//            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atribuicao_usuario_projetos');
    }
}

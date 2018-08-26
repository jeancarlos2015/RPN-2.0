<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtribuicaoProjetoUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atribuicao_projeto_usuarios', function (Blueprint $table) {
            $table->bigincrements('codatribuicaoprojetousuario');

            $table->bigInteger('codprojeto')
                ->unsigned();

            $table->bigInteger('codusuario')
                ->unsigned();

            $table->bigInteger('codrepositorio')
                ->nullable()
                ->unsigned();

            $table->string('nome')->default('grupo');

            $table->timestamps();
        });

        Schema::connection('banco')->table('atribuicao_projeto_usuarios', function($table) {
            $table->foreign('codprojeto')->references('codprojeto')->on('projetos');
        });

        Schema::table('atribuicao_projeto_usuarios', function($table) {
            $table->foreign('codusuario')->references('codusuario')->on('users');
        });

        Schema::table('atribuicao_projeto_usuarios', function($table) {
            $table->foreign('codrepositorio')->references('codrepositorio')->on('repositorios');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atribuicao_projeto_usuarios');
    }
}

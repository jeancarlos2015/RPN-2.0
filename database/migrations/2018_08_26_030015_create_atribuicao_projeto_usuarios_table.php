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

            $table->bigInteger('codprojeto');
            $table->bigInteger('codusuario');
            $table->bigInteger('codrepositorio')->nullable();

            $table->string('nome')->default('grupo');

//            $table->foreign('codprojeto')->references('codprojeto')->on('projetos');
//            $table->foreign('codusuario')->references('codusuario')->on('users');
//            $table->foreign('codrepositorio')->references('codrepositorio')->on('repositorios');
            $table->timestamps();
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

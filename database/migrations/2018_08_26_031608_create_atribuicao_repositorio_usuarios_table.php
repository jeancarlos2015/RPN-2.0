<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtribuicaoRepositorioUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atribuicao_repositorio_usuarios', function (Blueprint $table) {
            $table->bigincrements('codatribuicaorepositoriousuarios');

            $table->bigInteger('codrepositorio')->unsigned();
            $table->bigInteger('codusuario')->unsigned();

            $table->string('nome')->default('grupo');

            $table->timestamps();
        });

        Schema::table('atribuicao_repositorio_usuarios', function($table) {
            $table->foreign('codusuario')->references('codusuario')->on('users');
        });

        Schema::table('atribuicao_repositorio_usuarios', function($table) {
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
        Schema::dropIfExists('atribuicao_repositorio_usuarios');
    }
}

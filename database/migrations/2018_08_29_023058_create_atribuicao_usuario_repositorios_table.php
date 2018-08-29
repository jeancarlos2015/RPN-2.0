<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtribuicaoUsuarioRepositoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atribuicao_usuario_repositorios', function (Blueprint $table) {
            $table->bigincrements('cod_atribuicao_usuario_repositorio');

            $table->bigInteger('cod_usuario')
                ->unsigned();
            $table->bigInteger('cod_repositorio')
                ->unsigned();

            $table->string('tipo')->default('grupo');
            $table->string('nome');

            $table->timestamps();
        });

        Schema::table('atribuicao_usuario_repositorios', function($table) {
            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
        });

        Schema::table('atribuicao_usuario_repositorios', function($table) {
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
        Schema::dropIfExists('atribuicao_usuario_repositorios');
    }
}

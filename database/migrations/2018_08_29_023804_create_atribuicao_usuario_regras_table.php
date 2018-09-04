<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtribuicaoUsuarioRegrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atribuicao_usuario_regras', function (Blueprint $table) {
            $table->bigincrements('cod_atribuicao_usuario_regra')->unsigned();

            $table->bigInteger('cod_usuario')->unsigned();
            $table->bigInteger('cod_regra')->unsigned();

            $table->string('nome');
            $table->string('tipo')->default('grupo');

            $table->timestamps();
        });

//        Schema::table('atribuicao_usuario_regras', function($table) {
//            $table->foreign('cod_regra')->references('cod_regra')->on('regras');
//        });
//
//        Schema::table('atribuicao_usuario_regras', function($table) {
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
        Schema::dropIfExists('atribuicao_usuario_regras');
    }
}

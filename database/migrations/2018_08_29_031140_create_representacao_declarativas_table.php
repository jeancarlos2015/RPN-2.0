<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentacaoDeclarativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representacao_declarativas', function (Blueprint $table) {
            $table->bigincrements('cod_representacao_declarativa')->unsigned();

            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_projeto')->unsigned();
            $table->bigInteger('cod_usuario')->unsigned();
            $table->bigInteger('cod_modelo')->unsigned();
            $table->string('tipo')->default('declarativo');
            $table->boolean('publico')->default(true);

            $table->timestamps();
        });

        Schema::connection('banco')->table('representacao_declarativas', function($table) {
            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
        });

        Schema::connection('banco')->table('representacao_declarativas', function($table) {
            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
        });

        Schema::connection('banco')->table('representacao_declarativas', function($table) {
            $table->foreign('cod_repositorio')->references('cod_repositorio')->on('repositorios');
        });

        Schema::connection('banco')->table('representacao_declarativas', function($table) {
            $table->foreign('cod_modelo')->references('cod_modelo')->on('modelos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representacao_declarativas');
    }
}

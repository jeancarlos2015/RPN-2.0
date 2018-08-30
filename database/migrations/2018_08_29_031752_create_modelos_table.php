<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->bigincrements('cod_modelo')->unsigned();

            $table->bigInteger('cod_projeto')->unsigned();
            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_usuario')->unsigned();

            $table->string('nome');
            $table->string('descricao');
            $table->timestamps();
        });

        Schema::connection('banco')->table('modelos', function($table) {
            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
        });

        Schema::connection('banco')->table('modelos', function($table) {
            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
        });

        Schema::connection('banco')->table('modelos', function($table) {
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
        Schema::dropIfExists('modelos');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelosDeclarativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('modelos_declarativos', function (Blueprint $table) {
            $table->increments('codmodelodeclarativo');

            $table->bigInteger('codrepositorio')->unsigned();
            $table->bigInteger('codprojeto')->unsigned();
            $table->bigInteger('codusuario')->unsigned();

            $table->string('nome');
            $table->string('tipo')->default('declarativo');
            $table->string('descricao');
            $table->boolean('visibilidade')->default(true);
            $table->boolean('publico')->default(true);

            $table->timestamps();
        });

        Schema::connection('banco')->table('modelos_declarativos', function($table) {
            $table->foreign('codprojeto')->references('codprojeto')->on('projetos');
        });

        Schema::connection('banco')->table('modelos_declarativos', function($table) {
            $table->foreign('codusuario')->references('codusuario')->on('users');
        });

        Schema::connection('banco')->table('modelos_declarativos', function($table) {
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
        Schema::dropIfExists('modelo_declarativos');
    }
}

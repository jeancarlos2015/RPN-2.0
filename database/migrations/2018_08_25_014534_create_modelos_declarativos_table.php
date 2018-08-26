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


//            $table->foreign('codprojeto')->references('codprojeto')->on('projetos');
//            $table->foreign('codrepositorio')->references('codrepositorio')->on('repositorios');
//            $table->foreign('codusuario')->references('codusuario')->on('users');

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
        Schema::dropIfExists('modelo_declarativos');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('regras', function (Blueprint $table) {
            $table->increments('codregra');

            $table->bigInteger('codrepositorio');
            $table->bigInteger('codusuario');
            $table->bigInteger('codprojeto');
            $table->bigInteger('codmodelodeclarativo');

            $table->bigInteger('codoutraregra')->nullable();


            $table->string('nome');
            $table->string('tipo')->default('regra');
            $table->integer('relacionamento')->default(0);

            $table->boolean('visivel_projeto')->default(true);
            $table->boolean('visivel_repositorio')->default(true);
            $table->boolean('visivel_modelo_declarativo')->default(true);

            $table->foreign('codprojeto')->references('codprojeto')->on('projetos');
            $table->foreign('codrepositorio')->references('codrepositorio')->on('repositorios');
            $table->foreign('codusuario')->references('codusuario')->on('users');
            $table->foreign('codmodelodeclarativo')->references('codmodelodeclarativo')->on('modelo_declarativos');

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
        Schema::dropIfExists('regras');
    }
}

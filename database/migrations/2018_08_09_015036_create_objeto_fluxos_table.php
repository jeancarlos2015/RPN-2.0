<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjetoFluxosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('objetos_fluxos', function (Blueprint $table) {

            $table->increments('codobjetofluxo');

            $table->bigInteger('codrepositorio')->unsigned();
            $table->bigInteger('codregra')->nullable();
            $table->bigInteger('codusuario')->unsigned();
            $table->bigInteger('codprojeto')->unsigned();
            $table->bigInteger('codmodelodeclarativo')->unsigned();

            $table->string('nome');
            $table->string('descricao');
            $table->string('tipo')->default('objeto fluxo');
            $table->boolean('visivel_projeto')->default('false');
            $table->boolean('visivel_repositorio')->default('false');
            $table->boolean('visivel_modelo_declarativo')->default('false');


//            $table->foreign('codprojeto')->references('codprojeto')->on('projetos');
//            $table->foreign('codrepositorio')->references('codrepositorio')->on('repositorios');
//            $table->foreign('codusuario')->references('codusuario')->on('users');
//            $table->foreign('codmodelodeclarativo')->references('codmodelodeclarativo')->on('modelo_declarativos');

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
        Schema::dropIfExists('objeto_fluxos');
    }
}

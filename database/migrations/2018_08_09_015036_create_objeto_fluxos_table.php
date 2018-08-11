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

            $table->bigInteger('codrepositorio');
            $table->bigInteger('codusuario');
            $table->bigInteger('codprojeto');
            $table->bigInteger('codmodelodeclarativo');

            $table->string('nome');
            $table->string('descricao');

            $table->boolean('visivel_projeto')->default('false');
            $table->boolean('visivel_repositorio')->default('false');
            $table->boolean('visivel_modelo_declarativo')->default('false');
            $table->string('tipo');
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

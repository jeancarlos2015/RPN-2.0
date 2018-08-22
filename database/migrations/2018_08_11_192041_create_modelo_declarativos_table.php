<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModeloDeclarativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('modelo_declarativos', function (Blueprint $table) {
            $table->increments('codmodelodeclarativo');
            $table->bigInteger('codrepositorio');
            $table->bigInteger('codprojeto');
            $table->bigInteger('codusuario');
            $table->string('nome');
            $table->string('tipo')->default('declarativo');
            $table->string('descricao');
            $table->boolean('visibilidade');
            $table->boolean('publico');
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

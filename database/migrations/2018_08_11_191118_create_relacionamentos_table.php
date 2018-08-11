<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('relacionamentos', function (Blueprint $table) {
            $table->increments('codrelacionamento');
            $table->bigInteger('codorganizacao');
            $table->bigInteger('codprojeto');
            $table->bigInteger('codmodelodeclarativo');
            $table->bigInteger('codusuario');
            $table->string('nome');
            $table->string('descricao');
            $table->string('tipo');
            $table->boolean('visivel_projeto')->default('false');
            $table->boolean('visivel_repositorio')->default('false');
            $table->boolean('visivel_modelo_declarativo')->default('false');
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
        Schema::dropIfExists('relacionamentos');
    }
}

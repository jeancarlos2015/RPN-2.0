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
        Schema::connection('banco')->create('modelos', function (Blueprint $table) {
            $table->bigIncrements('codmodelo')->unsigned();
            $table->bigInteger('codregra')->nullable();
            $table->string('nome');
            $table->string('descricao');
            $table->string('tipo');
            $table->longText('xml_modelo');
            $table->boolean('visibilidade');
            $table->bigInteger('codprojeto');
            $table->bigInteger('codorganizacao');
            $table->bigInteger('codusuario');

//            $table->foreign('codprojeto')->references('codprojeto')->on('projetos');
//            $table->foreign('codorganizacao')->references('codorganizacao')->on('organizacoes');
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
        Schema::dropIfExists('modelos');
    }
}

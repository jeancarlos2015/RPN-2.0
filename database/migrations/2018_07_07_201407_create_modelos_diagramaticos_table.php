<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelosDiagramaticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('modelos_diagramaticos', function (Blueprint $table) {
            $table->bigIncrements('codmodelodiagramatico')->unsigned();
            $table->string('nome');
            $table->string('descricao');
            $table->string('tipo')->default('bpmn');
            $table->longText('xml_modelo');
            $table->boolean('visibilidade');
            $table->boolean('publico');
            $table->bigInteger('codprojeto');
            $table->bigInteger('codrepositorio');
            $table->bigInteger('codusuario');

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
        Schema::dropIfExists('modelos');
    }
}

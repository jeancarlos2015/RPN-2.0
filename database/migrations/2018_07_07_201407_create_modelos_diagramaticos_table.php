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

            $table->bigInteger('codprojeto')->unsigned();
            $table->bigInteger('codrepositorio')->unsigned();
            $table->bigInteger('codusuario')->unsigned();

            $table->string('nome');
            $table->string('descricao');
            $table->string('tipo')->default('bpmn');
            $table->longText('xml_modelo');
            $table->boolean('visibilidade')->default(true);
            $table->boolean('publico')->default(true);

            $table->timestamps();
        });

        Schema::connection('banco')->table('modelos_diagramaticos', function($table) {
            $table->foreign('codprojeto')->references('codprojeto')->on('projetos');
        });


        Schema::connection('banco')->table('modelos_diagramaticos', function($table) {
            $table->foreign('codrepositorio')->references('codrepositorio')->on('repositorios');
        });


        Schema::connection('banco')->table('modelos_diagramaticos', function($table) {
            $table->foreign('codusuario')->references('codusuario')->on('users');
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

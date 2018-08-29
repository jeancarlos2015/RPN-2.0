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
            $table->bigIncrements('cod_modelo_diagramatico')->unsigned();

            $table->bigInteger('cod_projeto')->unsigned();
            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_usuario')->unsigned();

            $table->string('nome');
            $table->string('descricao');
            $table->string('tipo')->default('bpmn');
            $table->longText('xml_modelo');
            $table->boolean('visibilidade')->default(true);
            $table->boolean('publico')->default(true);

            $table->timestamps();
        });

        Schema::connection('banco')->table('modelos_diagramaticos', function($table) {
            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
        });


        Schema::connection('banco')->table('modelos_diagramaticos', function($table) {
            $table->foreign('cod_repositorio')->references('cod_repositorio')->on('repositorios');
        });


        Schema::connection('banco')->table('modelos_diagramaticos', function($table) {
            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
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

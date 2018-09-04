<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentacaoDiagramaticaVersionaveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('representacao_diagramatica_versionaveis', function (Blueprint $table) {
            $table->bigincrements('cod_representacao_diagramatica')->unsigned();

            $table->bigInteger('cod_projeto')->unsigned();
            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_usuario')->unsigned();
            $table->bigInteger('cod_modelo')->unsigned();

            $table->string('tipo')->default('bpmn');
            $table->longText('xml_modelo');

            $table->timestamps();
        });

//        Schema::connection('banco')->table('representacao_diagramatica_versionaveis', function($table) {
//            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
//        });
//
//
//        Schema::connection('banco')->table('representacao_diagramatica_versionaveis', function($table) {
//            $table->foreign('cod_repositorio')->references('cod_repositorio')->on('repositorios');
//        });
//
//
//        Schema::connection('banco')->table('representacao_diagramatica_versionaveis', function($table) {
//            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
//        });
//
//        Schema::connection('banco')->table('representacao_diagramatica_versionaveis', function($table) {
//            $table->foreign('cod_modelo')->references('cod_modelo')->on('modelos');
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representacao_diagramatica_versionavels');
    }
}

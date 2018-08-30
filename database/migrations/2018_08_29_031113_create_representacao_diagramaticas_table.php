<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentacaoDiagramaticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representacao_diagramaticas', function (Blueprint $table) {


            $table->bigincrements('cod_representacao_diagramatica')->unsigned();

            $table->bigInteger('cod_projeto')->unsigned();
            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_usuario')->unsigned();
            $table->bigInteger('cod_modelo')->unsigned();

            $table->string('tipo')->default('bpmn');
            $table->longText('xml_modelo');

            $table->boolean('publico')->default(true);

            $table->timestamps();
        });

        Schema::connection('banco')->table('representacao_diagramaticas', function($table) {
            $table->foreign('cod_projeto')->references('cod_projeto')->on('projetos');
        });


        Schema::connection('banco')->table('representacao_diagramaticas', function($table) {
            $table->foreign('cod_repositorio')->references('cod_repositorio')->on('repositorios');
        });


        Schema::connection('banco')->table('representacao_diagramaticas', function($table) {
            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
        });

        Schema::connection('banco')->table('representacao_diagramaticas', function($table) {
            $table->foreign('cod_modelo')->references('cod_modelo')->on('modelos');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representacao_diagramaticas');
    }
}

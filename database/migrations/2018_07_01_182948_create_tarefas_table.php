<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarefasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('tarefas', function (Blueprint $table) {
            $table->bigIncrements('codtarefa');
            $table->string('nome');
            $table->string('descricao');

            $table->bigInteger('codmodelo');
            $table->bigInteger('codprojeto');
            $table->bigInteger('codorganizacao');
            $table->bigInteger('codusuario');
            $table->bigInteger('codregra');

//            $table->foreign('codmodelo')->references('codmodelo')->on('modelos');
//            $table->foreign('codprojeto')->references('codprojeto')->on('projetos');
//            $table->foreign('codorganizacao')->references('codorganizacao')->on('organizacoes');
//            $table->foreign('codusuario')->references('codusuario')->on('users');
//            $table->foreign('codregra')->references('codregra')->on('regras');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('tarefas');
    }
}

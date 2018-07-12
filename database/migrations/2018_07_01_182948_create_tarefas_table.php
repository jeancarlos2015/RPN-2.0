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
        Schema::create('tarefas', function (Blueprint $table) {
            $table->bigIncrements('codtarefa');
            $table->string('nome');
            $table->string('descricao');
            $table->bigInteger('codmodelo');
            $table->bigInteger('codprojeto');
            $table->bigInteger('codorganizacao');
            $table->bigInteger('codusuario');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('tarefas');
    }
}

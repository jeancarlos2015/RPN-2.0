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
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('descricao');
            $table->bigInteger('modelo_id');
            $table->bigInteger('projeto_id');
            $table->bigInteger('organizacao_id');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('tarefas');
    }
}

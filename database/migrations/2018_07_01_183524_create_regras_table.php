<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tarefa1_id');
            $table->bigInteger('tarefa2_id');
            $table->string('operador');
            $table->bigInteger('projeto_id');
            $table->bigInteger('organizacao_id');
            $table->bigInteger('modelo_id');
            $table->bigInteger('regra_id');
            $table->string('nome');
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
        Schema::dropIfExists('regras');
    }
}

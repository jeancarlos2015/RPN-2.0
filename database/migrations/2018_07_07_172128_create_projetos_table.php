<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('projetos', function (Blueprint $table) {
            $table->increments('codprojeto');
            $table->string('nome');
            $table->string('descricao');
            $table->boolean('visibilidade')->default(true);
            $table->boolean('publico')->default(true);
            $table->bigInteger('codrepositorio')->unsigned();
            $table->bigInteger('codusuario')->unsigned();

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
        Schema::dropIfExists('projetos');
    }
}

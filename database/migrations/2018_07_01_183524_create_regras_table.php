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
        Schema::connection('banco')->create('regras', function (Blueprint $table) {
            $table->bigIncrements('codregra')->unsigned();
            $table->string('operador');
            $table->string('nome');
            $table->bigInteger('codprojeto');
            $table->bigInteger('codorganizacao');
            $table->bigInteger('codmodelo');
            $table->bigInteger('codusuario');
            $table->bigInteger('codregra1');

//            $table->foreign('codprojeto')->references('codprojeto')->on('projetos');
//            $table->foreign('codorganizacao')->references('codorganizacao')->on('organizacoes');
//            $table->foreign('codmodelo')->references('codmodelo')->on('modelos');
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
        Schema::dropIfExists('regras');
    }
}

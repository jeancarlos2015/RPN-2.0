<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('banco')->create('organizacoes', function (Blueprint $table) {
            $table->bigIncrements('codorganizacao');
            $table->string('nome');
            $table->string('descricao');
            $table->bigInteger('codusuario');
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
        Schema::dropIfExists('organizacoes');
    }
}

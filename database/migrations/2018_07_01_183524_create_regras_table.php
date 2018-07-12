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
            $table->bigIncrements('codregra');
            $table->string('operador');
            $table->string('nome');

            $table->bigInteger('codtarefa');
            $table->bigInteger('codprojeto');
            $table->bigInteger('codorganizacao');
            $table->bigInteger('codmodelo');
            $table->bigInteger('codregra1');
            $table->bigInteger('codusuario');
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

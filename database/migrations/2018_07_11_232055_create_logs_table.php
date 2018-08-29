<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('cod_log');
            $table->string('nome');
            $table->text('descricao');
            $table->bigInteger('cod_usuario')->unsigned();
            $table->string('acao');
            $table->string('pagina');

            $table->timestamps();
        });

        Schema::table('logs', function($table) {
            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}

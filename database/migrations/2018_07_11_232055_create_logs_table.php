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
            $table->increments('codlog');
            $table->string('nome');
            $table->text('descricao');
            $table->bigInteger('codusuario')->unsigned();
            $table->string('acao');
            $table->string('pagina');

            $table->timestamps();
        });

        Schema::table('logs', function($table) {
            $table->foreign('codusuario')->references('codusuario')->on('users');
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

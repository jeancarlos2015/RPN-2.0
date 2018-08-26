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
            $table->bigincrements('codprojeto');

            $table->bigInteger('codrepositorio')->unsigned();
            $table->bigInteger('codusuario')->unsigned();


            $table->string('nome');
            $table->string('descricao');
            $table->boolean('visibilidade')->default(true);
            $table->boolean('publico')->default(true);



            $table->timestamps();
        });


        Schema::connection('banco')->table('projetos', function($table) {
            $table->foreign('codrepositorio')->references('codrepositorio')->on('repositorios');
        });


        Schema::connection('banco')->table('projetos', function($table) {
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
        Schema::dropIfExists('projetos');
    }
}

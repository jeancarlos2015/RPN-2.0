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
            $table->bigincrements('cod_projeto')->unsigned();

            $table->bigInteger('cod_repositorio')->unsigned();
            $table->bigInteger('cod_usuario')->unsigned();


            $table->string('nome');
            $table->string('descricao');
            $table->boolean('visibilidade')->default(true);
            $table->boolean('publico')->default(true);



            $table->timestamps();
        });


        Schema::connection('banco')->table('projetos', function($table) {
            $table->foreign('cod_repositorio')->references('cod_repositorio')->on('repositorios');
        });


        Schema::connection('banco')->table('projetos', function($table) {
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
        Schema::dropIfExists('projetos');
    }
}

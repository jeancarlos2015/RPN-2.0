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
            $table->increments('codregra');

            $table->bigInteger('codrepositorio')->unsigned();
            $table->bigInteger('codusuario')->unsigned();
            $table->bigInteger('codprojeto')->unsigned();
            $table->bigInteger('codmodelodeclarativo')->unsigned();

            $table->bigInteger('codoutraregra')->nullable();


            $table->string('nome');
            $table->string('tipo')->default('regra');
            $table->integer('relacionamento')->default(0);

            $table->boolean('visivel_projeto')->default(true);
            $table->boolean('visivel_repositorio')->default(true);
            $table->boolean('visivel_modelo_declarativo')->default(true);

            $table->timestamps();
        });

        Schema::connection('banco')->table('regras', function($table) {
            $table->foreign('codprojeto')->references('codprojeto')->on('projetos');
        });

        Schema::connection('banco')->table('regras', function($table) {
            $table->foreign('codusuario')->references('codusuario')->on('users');
        });

        Schema::connection('banco')->table('regras', function($table) {
            $table->foreign('codrepositorio')->references('codrepositorio')->on('repositorios');
        });

        Schema::connection('banco')->table('regras', function($table) {
            $table->foreign('codmodelodeclarativo')->references('codmodelodeclarativo')->on('modelos_declarativos');
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

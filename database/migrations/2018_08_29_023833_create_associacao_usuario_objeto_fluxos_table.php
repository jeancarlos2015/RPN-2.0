<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociacaoUsuarioObjetoFluxosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associacao_usuario_objeto_fluxos', function (Blueprint $table) {
            $table->bigincrements('cod_associacao_usuario_objeto_fluxo')->unsigned();

            $table->bigInteger('cod_usuario')->unsigned();
            $table->bigInteger('cod_objeto_fluxo')->unsigned();

            $table->string('nome');
            $table->string('tipo')->default('grupo');

            $table->timestamps();
        });

        Schema::connection('banco')->table('associacao_usuario_objeto_fluxos', function($table) {
            $table->foreign('cod_objeto_fluxo')->references('cod_objeto_fluxo')->on('objetos_fluxos');
        });

        Schema::table('associacao_usuario_objeto_fluxos', function($table) {
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
        Schema::dropIfExists('associacao_usuario_objeto_fluxos');
    }
}

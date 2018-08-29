<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociacaoUsuarioModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associacao_usuario_modelos', function (Blueprint $table) {
            $table->bigincrements('cod_associacao_usuario_modelo')->unsigned();

            $table->bigInteger('cod_usuario')->unsigned();
            $table->bigInteger('cod_modelo')->unsigned();

            $table->string('nome');
            $table->string('tipo')->default('grupo');

            $table->timestamps();
        });

        Schema::connection('banco')->table('associacao_usuario_modelos', function($table) {
            $table->foreign('cod_modelo')->references('cod_modelo')->on('modelos');
        });

        Schema::table('associacao_usuario_modelos', function($table) {
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
        Schema::dropIfExists('associacao_usuario_modelos');
    }
}

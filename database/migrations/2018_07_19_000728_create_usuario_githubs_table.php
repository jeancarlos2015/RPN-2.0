<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioGithubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_github', function (Blueprint $table) {
            $table->bigIncrements('cod_usuario_github');
            $table->string('usuario_github',4000);
            $table->string('email_github');
            $table->string('repositorio_atual')->nullable();
            $table->string('branch_atual')->nullable();
            $table->string('senha_github',4000);
            $table->bigInteger('cod_usuario')->unsigned();

            $table->timestamps();
        });

//        Schema::table('usuarios_github', function($table) {
//            $table->foreign('cod_usuario')->references('cod_usuario')->on('users');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_githubs');
    }
}

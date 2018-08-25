<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepositoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositorios', function (Blueprint $table) {
            $table->bigIncrements('codrepositorio');
            $table->string('nome');
            $table->string('descricao');
            $table->boolean('visibilidade')->default(true);
            $table->boolean('publico')->default(true);
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
        Schema::dropIfExists('repositorios');
    }
}

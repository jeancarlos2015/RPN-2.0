<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchs', function (Blueprint $table) {
            $table->increments('cod_branch');
            $table->string('branch');
            $table->string('descricao')->nullable();
            $table->bigInteger('cod_usuario')->unsigned();

            $table->timestamps();
        });

        Schema::table('branchs', function($table) {
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
        Schema::dropIfExists('branchs');
    }
}

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
            $table->increments('codbranch');
            $table->string('branch');
            $table->string('descricao')->nullable();
            $table->bigInteger('codusuario')->unsigned();

            $table->timestamps();
        });

        Schema::table('branchs', function($table) {
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
        Schema::dropIfExists('branchs');
    }
}

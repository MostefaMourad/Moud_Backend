<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReponseWHSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponse_w_h_s', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('questions');
            $table->integer('reponse_tache_id')->unsigned();
            $table->foreign('reponse_tache_id')->references('id')->on('reponse_taches');
            $table->string('reponse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reponse_w_h_s');
    }
}

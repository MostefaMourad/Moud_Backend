<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nom');
            $table->string('description');
            $table->string('mot_de_passe');
            $table->string('pd');
            $table->string('email');
            $table->string('domaine');
            $table->string('telephone');
            $table->string('fax');
            $table->string('adresse');
            $table->string('logo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entreprises');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReponseTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponse_taches', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('tache_id')->unsigned();
            $table->foreign('tache_id')->references('id')->on('taches');
            $table->integer('utilisateur_id')->unsigned();
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurs');
            $table->enum('etat',['en attente','accepte','refuse']);
            $table->string('nom');
            $table->string('prenom');
            $table->string('lieu_residence');
            $table->integer('age');
            $table->string('situation_familiale')->nullable();
            $table->float('latitude');
            $table->float('longitude');
            $table->string('lien_preuve')->nullable();
            $table->integer('nombre_validations')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reponse_taches');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->enum('type',['mission','sondage','enquete']);
            $table->string('titre');
            $table->string('description');
            $table->integer('nombre_personnes');
            $table->float('prix_personne');
            $table->integer('entreprise_id')->unsigned();
            $table->foreign('entreprise_id')->references('id')->on('entreprises');
            $table->enum('preuve_validite',['video','image','memo','rien']);
            $table->string('tranche_age_cible');
            $table->enum('sexe_cible',['homme','femme','les deux']);
            $table->string('region_cible');
            $table->string('domaine');
            $table->float('latitude');
            $table->float('longitude');
            $table->float('rayon');
            $table->integer('nbr_reponses_valides')->default(0);
            $table->string('image_tache');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taches');
    }
}

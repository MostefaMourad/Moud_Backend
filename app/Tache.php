<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'type','titre','description','nombre_personnes','prix_personne','entreprise_id','preuve_validite','tranche_age_cible',
        'sexe_cible','region_cible','domaine','latitude','longitude','rayon','nbr_reponses_valides','image_tache',
    ];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}

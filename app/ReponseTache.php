<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReponseTache extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tache_id','utilisateur_id','nom','prenom','lieu_residence','age','situation_familiale','latitude','longitude','lien_preuve','domaine',
    ];
    public function tache()
    {
        return $this->belongsTo('App\Tache');
    }
    public function reponseson()
    {
        return $this->hasMany('App\ReponseON');
    }
    public function reponseswh()
    {
        return $this->hasMany('App\ReponseWH');
    }
}

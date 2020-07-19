<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nom','prenom', 'email', 'mot_de_passe','region','domaine','image_profil',
    ];
    protected $hidden = [
        'mot_de_passe',
    ];
    public function reponses()
    {
        return $this->hasMany('App\ReponseTache');
    }
    public function verifications()
    {
        return $this->hasMany('App\Verification');
    }
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}

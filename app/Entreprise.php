<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nom', 'email', 'description','domaine','telephone','fax','adresse','logo','mot_de_passe','pd',
    ];
    protected $hidden = [
        'mot_de_passe',
    ];
    public function taches()
    {
        return $this->hasMany('App\Tache');
    }
}

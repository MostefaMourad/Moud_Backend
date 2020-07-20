<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Entreprise extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public $timestamps = false;
    protected $fillable = [
        'nom', 'email', 'description','domaine','telephone','fax','adresse','logo','password','pd',
    ];
    protected $hidden = [
        'password','remember_token'
    ];
    public function taches()
    {
        return $this->hasMany('App\Tache');
    }
}

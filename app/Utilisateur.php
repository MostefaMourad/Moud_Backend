<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Utilisateur extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public $timestamps = false;
    protected $fillable = [
        'nom','prenom', 'email', 'password','region','domaine','image_profil',
    ];
    protected $hidden = [
        'password','remember_token'
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

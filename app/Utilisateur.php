<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public $timestamps = false;
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

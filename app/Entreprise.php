<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    public $timestamps = false;
    public function taches()
    {
        return $this->hasMany('App\Tache');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReponseTache extends Model
{
    public $timestamps = false;
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

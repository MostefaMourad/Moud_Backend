<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    public $timestamps = false;
    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}

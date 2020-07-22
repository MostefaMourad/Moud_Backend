<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'utilisateur_id','reponse_tache_id','valide','commentaire',
    ];
}

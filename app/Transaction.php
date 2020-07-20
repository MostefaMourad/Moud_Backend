<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'utilisateur_id','type','montant_courant','montant_restant',
    ];

}

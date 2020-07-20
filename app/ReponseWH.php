<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReponseWH extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'reponse', 'question_id', 'reponse_tache_id',
    ];
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}

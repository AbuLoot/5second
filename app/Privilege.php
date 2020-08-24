<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $table = 'privileges';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function card()
    {
        return $this->belongsTo('App\Card', 'card_id');
    }
}

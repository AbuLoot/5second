<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';

    public function privileges()
    {
        return $this->hasMany('App\Privilege');
    }
}
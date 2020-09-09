<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $guarded = [];

    public function path()
    {
        return '/book/'.$this->id ;
    }
}

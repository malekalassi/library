<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public $guarded=[];

    public $dates=['dob'];

    public function setDobAttribute($value)
    {
         $this->attributes['dob'] = Carbon::parse($value);
    }
}

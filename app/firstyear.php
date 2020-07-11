<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class firstyear extends Model
{
    protected $fillable = [
        'major', 'from', 'to','extra_courses'
    ];
}

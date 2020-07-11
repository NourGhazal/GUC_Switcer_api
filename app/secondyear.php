<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class secondyear extends Model
{
    protected $fillable = [
        'major', 'from', 'to','extra_courses'
    ];
}

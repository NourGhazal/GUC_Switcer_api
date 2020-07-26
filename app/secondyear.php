<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class secondyear extends Model
{
    protected $table = 'secondyear';
    protected $fillable = [
        'major', 'from', 'to','extra_courses'
    ];
}

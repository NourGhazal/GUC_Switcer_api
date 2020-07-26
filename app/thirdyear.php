<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thirdyear extends Model
{
    protected $table = 'thirdyear';
    protected $fillable = [
        'major', 'from', 'to','extra_courses'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fourthyear extends Model
{
    protected $table = 'fourthyear';
    protected $fillable = [
        'major', 'from', 'to','extra_courses'
    ];
}

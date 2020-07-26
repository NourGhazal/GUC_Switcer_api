<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fifthyear extends Model
{ 
    protected $table = 'fifthyear';
    protected $fillable = [
        'major', 'from', 'to','extra_courses'
    ];
}

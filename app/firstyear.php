<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class firstyear extends Model
{ 
    protected $table = 'firstyear';
    protected $fillable = [
        'major', 'from', 'to','extra_courses','user_id'
    ];


}

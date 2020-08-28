<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'link', 'chapter', 'subject', 'start_time', 'end_time', 'classe', 'teacher'
    ];
}

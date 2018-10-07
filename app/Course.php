<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Moloquent;

class Course extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'courses';
    protected $primaryKey = '_id';

    protected $fillable = [
        'title','money','contents','imgjson','point','onffonline','Timeslot','modelarray'
    ];
}

<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
class fblive extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'fblives';
    protected $primaryKey = '_id';

    protected $fillable = [
        'sid','title','contents','saw','path','picjson','startdate','starttime','open'
    ];
}



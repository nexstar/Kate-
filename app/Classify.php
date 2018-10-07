<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
class Classify extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'classifies';
    protected $primaryKey = '_id';

    protected $fillable = [
        'name','addcheckboxgroup'
    ];
}

<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;

class Friend extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'friends';
    protected $primaryKey = '_id';

    protected $fillable = [
        'queue','picloadjson'
    ];

}

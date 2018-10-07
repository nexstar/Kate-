<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
class petbigitem extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'petbigitems';
    protected $primaryKey = '_id';

    protected $fillable = [
        'pethub'
    ];
}


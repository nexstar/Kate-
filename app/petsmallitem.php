<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
class petsmallitem extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'petsmallitems';
    protected $primaryKey = '_id';

    protected $fillable = [
        'pethubid','pethub','petname','kettles','RoomTemps','Temps'
    ];
}


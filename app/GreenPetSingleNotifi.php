<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
class GreenPetSingleNotifi extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'green_pet_single_notifis';
    protected $primaryKey = '_id';

    protected $fillable = [
        'title','link','picjson','picjson','reservemdh','fouritem','contents','notifi'
    ];

}

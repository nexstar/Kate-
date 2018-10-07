<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
class GreenPetGroupNotifi extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'green_pet_group_notifis';
    protected $primaryKey = '_id';

    protected $fillable = [
        'title','link','picjson','reservemdh','fouritem','contents','notifi'
    ];
}

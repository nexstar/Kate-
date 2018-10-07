<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
class GreenPetSlide extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'green_pet_slides';
    protected $primaryKey = '_id';

    protected $fillable = [
        'queue','src','fe'
    ];
}

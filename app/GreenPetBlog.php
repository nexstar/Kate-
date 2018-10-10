<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
class GreenPetBlog extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'green_pet_blogs';
    protected $primaryKey = '_id';

    protected $fillable = [
        'sid','title','src','fe','link','contents','notifi'
    ];
}

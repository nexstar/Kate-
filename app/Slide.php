<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Moloquent;
class Slide extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'slides';
    protected $primaryKey = '_id';

    protected $fillable = [
        'queue','src','fe'
    ];
}

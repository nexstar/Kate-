<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Moloquent;

class HotProduct extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'hot_products';
    protected $primaryKey = '_id';

    protected $fillable = [
        'queue','productid'
    ];
}

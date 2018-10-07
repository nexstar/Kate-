<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Moloquent;

class pdsmallitem extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'pdsmallitems';
    protected $primaryKey = '_id';

    protected $fillable = [
        'bigname','name'
    ];
}

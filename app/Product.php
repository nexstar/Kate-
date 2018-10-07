<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Moloquent;

class Product extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'products';
    protected $primaryKey = '_id';

    protected $fillable = [
        'title','money','pdbigitem','pdsmallitem','bouns','inventory',
        'date','contents','src','fe','discountstatus','onoff','buycount',
        'point','prompt','addpd','modelgc'
    ];
}

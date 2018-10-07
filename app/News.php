<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;

class News extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'news';
    protected $primaryKey = '_id';

    protected $fillable = [
        'title','date','ref','point','left','right'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Moloquent;

class HotArticle extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'hot_articles';
    protected $primaryKey = '_id';

    protected $fillable = [
        'queue','articleid'
    ];
}

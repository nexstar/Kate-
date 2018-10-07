<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Moloquent;
//class Article extends Model
class Article extends Moloquent
{

    protected $connection = 'mongodb';
    protected $collection = 'articles';
    protected $primaryKey = '_id';

    protected $fillable = [
        'title','type','point','hotarticle','onffonline','picloadjson','contents','introductionjson'
    ];



}

<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
class appwebuser extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'appwebusers';
    protected $primaryKey = '_id';

    protected $fillable = [
        'userid','webuserid','email','phone','sex','info','web','greenpetapp'
    ];
}

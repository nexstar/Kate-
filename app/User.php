<?php

namespace App;


use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

	protected $connection = 'mongodb';
    protected $collection = 'users';
    protected $primaryKey = '_id';

    protected $fillable = [
		'name','smsname','smspwd','ecpayname','ecpaypwd'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

	public function isPass($auth){
		if( ($this->password == $auth->password) && ($this->name == $auth->name) ){
			return true;
		}
		return false;
	}

}


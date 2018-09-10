<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineFriendController extends Controller
{
    public function index(){
        return view('Online.Friend.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineDataCenterController extends Controller
{
    public function index(){
        return view('Online.DataCenter.index');
    }
}

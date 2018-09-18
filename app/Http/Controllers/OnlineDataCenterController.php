<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineDataCenterController extends Controller
{
    public function index(){
        return view('Online.DataCenter.index');
    }

    public function clientinfosheet($id){

        return view('Online.DataCenter.clientinfosheet',compact('id'));
    }

    public function clientinfobought($id){

        return view('Online.DataCenter.clientinfobought',compact('id'));
    }
}

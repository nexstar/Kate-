<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineDataCenterNetworkTrafficController extends Controller
{
    public function y(){
        return view('Online.DataCenter.NetworkTraffic.y');
    }

    public function m($m,$y){
        return view('Online.DataCenter.NetworkTraffic.m',compact('m','y'));
    }

    public function d($d,$m,$y){
        return view('Online.DataCenter.NetworkTraffic.d',compact('m','y','d'));
    }
}

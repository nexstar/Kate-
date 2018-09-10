<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineProductItemsController extends Controller
{
    public function index(){
        return view('Online.Product.Items.index');
    }
}

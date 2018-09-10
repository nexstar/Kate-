<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineTransactionRecordController extends Controller
{
    public function index(){
        return view('Online.TransactionRecord.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;

class OnlineFriendController extends Controller
{
    public function index(){
        return view('Online.Friend.index');
    }

    public function update(Request $request, $id){

        $_friendsrc = $request->friendsrc;
        $_friendfe = $request->friendfe;
        $editkeyid = $id;

        $imageload  = new imageload( $_friendsrc, $_friendfe, 'friend', $id );

        $imageload->webimg();

        return redirect()->back();
    }
}

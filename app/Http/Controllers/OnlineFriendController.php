<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;
use App\Friend;

class OnlineFriendController extends Controller
{
    public function index(){
        $friends = Friend::all();

        $goblade = [];
        foreach($friends as $friendlist){
            $getbase64 = imageload::upimgpath('images/friend/'. $friendlist->picloadjson['img']);
            array_push($goblade, array(
                '_id' => $friendlist->_id,
                'src' => $getbase64,
                'fe' => $friendlist->picloadjson['fe']
            ));
        };

        return view('Online.Friend.index',compact('goblade'));
    }

    public function update(Request $request, $queue){

        $_friendid = $request->friendid;
        $_friendsrc = $request->friendsrc;
        $_friendfe = $request->friendfe;
        $editkeyqueue = $queue;

        $imageload  = new imageload( $_friendsrc, $_friendfe, 'friend', $editkeyqueue );
        $imageload->webimg();

        $friends = Friend::findOrFail($_friendid);
        $rmimg = $friends->picloadjson['img'];

        imageload::rmpic('friend', $rmimg);

        $friends->picloadjson = [
            'img' => $imageload->geturl(),
            'fe' => $_friendfe,
        ];
        $friends->update();

        return redirect()->back();
    }
}

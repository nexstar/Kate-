<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineProductItemsController extends Controller
{
    public function smallshow($id){
        $smallitem = [];
        for ($i=0; $i<5; $i++){
            $rmid = (rand(10,32767) * 100);
            array_push($smallitem, $rmid);
        };
        return json_encode($smallitem);
    }

    public function smallitemstore(Request $request){
        $_smallitemtitle = $request->smallitemtitle;
        $_smallid = $request->smallid;
//        dd($request->all());
//        return redirect()->back();
        return $_smallitemtitle;
    }

    public function smallitemupdate(Request $request, $id){
        $_editsmallitem = $request->editsmallitem;
        $tmp = [
            'id' => $id,
            'newname' => $_editsmallitem,
        ];
//        dd($tmp);
//        return redirect()->back();
        return $tmp;
    }

    public function smallitemdestroy($id){
        return $id;
    }

    public function index(){
        $bigitem = [];
        for ($i=0; $i<5; $i++){
            $rmid = (rand(10,32767) * 100);
            array_push($bigitem,
                array(
                    'id' => $rmid,
                    'name' => $rmid
                )
            );
        };
        $smallitem = [
            '請選擇大項' => '請選擇大項',
            '11111' => 'AAAAAA',
            '22222' => 'BBBBBB',
            '33333' => 'CCCCCC',
            '44444' => 'DDDDDD',
            '55555' => 'EEEEEE',
        ];
        return view('Online.Product.Items.index',compact('bigitem','smallitem'));
    }

    public function bigitemstore(Request $request){
        $_bigitemtitle = $request->bigitemtitle;
        return redirect()->back();
    }

    public function bigitemupdate(Request $request, $id){
        $_editbigitem = $request->editbigitem;
        $tmp = [
            'id' => $id,
            'newname' => $_editbigitem,
        ];
        return redirect()->back();
    }

    public function bigitemdestroy($id){
        dd($id);
    }

}

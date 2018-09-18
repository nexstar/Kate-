<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;

class OnlineNewController extends Controller
{
    public function show($id){}
    public function destroy($id){}

    public function index()
    {
        return view('Online.New.index');
    }

    public function create()
    {
        return view('Online.New.create');
    }

    public function store(Request $request)
    {
        $this->create_update($request, "");
        return redirect('onlinenew');
    }

    public function edit($id)
    {
        $TestData = [
            "title" => "文章測試A",
            "data" => "2018/9/13, 11:51:00 PM",
            "left" => array(
                "url" => "new_1536923234_left.jpg",
                "fe" => "jpg"
            ),
            "right" => array(
                "url" => "new_1536923234_right.png",
                "fe" => "png"
            )
        ];

        $getbase64 = imageload::upimgpath('images/new/'. $TestData['left']['url']);
        $TestData['left']['url'] = $getbase64;

        $getbase64 = imageload::upimgpath('images/new/'. $TestData['right']['url']);
        $TestData['right']['url'] = $getbase64;

        return view('Online.New.edit', compact('TestData'));
    }

    public function update(Request $request, $id)
    {
        //  需寫刪除資料庫
        $this->create_update($request, 'edit_');
        return redirect('onlinenew');
    }

    private function create_update($request, $type){
        $_title = $request->title;
        $_date  = $request->date;

        $_newssrcleft = $request->newssrcleft;
        $_newsfeleft  = $request->newsfeleft;
        $imageload_left = new imageload($_newssrcleft, $_newsfeleft,'new',$type.'left');

        $imageload_left->webimg();
        $lefturl = $imageload_left->geturl();

        $_newssrcright  = $request->newssrcright;
        $_newsferight = $request->newsferight;
        $imageload_right = new imageload($_newssrcright, $_newsferight, 'new', $type.'right');
        $imageload_right->webimg();
        $righturl = $imageload_right->geturl();

        $savejson = [
            'title' => $_title,
            'data' => $_date,
            'left' => [
                'url' => $lefturl,
                'fe' => $_newsfeleft
            ],
            'right' => [
                'url' => $righturl,
                'fe' => $_newsferight
            ],
        ];

        if( "" === $type){

        }else{

        }

    }
}
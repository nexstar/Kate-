<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;
use App\News;

class OnlineNewController extends Controller
{
    public function show($id){}

    public function destroy($id){
        $news = News::findOrFail($id);

        $_rmimg_left  = $news->left['url'];
        $_rmimg_right = $news->right['url'];

        imageload::rmpic('new', $_rmimg_left);
        imageload::rmpic('new', $_rmimg_right);

        $news->delete();
        return redirect()->back();
    }

    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return view('Online.New.index',compact('news'));
    }

    public function create()
    {
        return view('Online.New.create');
    }

    public function store(Request $request)
    {
        $this->create_update($request, "", "");
        return redirect('onlinenew');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);

        $TestData = [
            "_id" => $news->_id,
            "title" => $news->title,
            "date" => $news->date,
            "ref" => $news->ref,
            "left" => array(
                "url" => $news->left['url'],
                "fe"  => $news->left['fe']
            ),
            "right" => array(
                "url" => $news->right['url'],
                "fe"  => $news->right['fe']
            )
        ];

        session(['rmimg_left' => $news->left['url'] ]);
        session(['rmimg_right' => $news->right['url'] ]);

        $getbase64 = imageload::upimgpath('images/new/'. $TestData['left']['url']);
        $TestData['left']['url'] = $getbase64;

        $getbase64 = imageload::upimgpath('images/new/'. $TestData['right']['url']);
        $TestData['right']['url'] = $getbase64;

        return view('Online.New.edit', compact('TestData'));
    }

    public function update(Request $request, $id)
    {
        //  需寫刪除資料庫
        imageload::rmpic('new', session('rmimg_left'));
        imageload::rmpic('new', session('rmimg_right'));
        $this->create_update($request, 'edit_', $id);
        return redirect('onlinenew');
    }

    private function create_update($request, $type ,$id){
        $_title = $request->title;
        $_date  = $request->date;
        $_ref  = $request->ref;


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

        if( "" === $type){
            $news = new News();
            $news->title = $_title;
            $news->date = $_date;
            $news->ref = $_ref;
            $news->point = [];
            $news->left = [
                'url' => $lefturl,
                'fe' => $_newsfeleft
            ];
            $news->right = [
                'url' => $righturl,
                'fe' => $_newsferight
            ];
            $news->save();
        }else{
            $updatenews = News::findOrFail($id);
            $updatenews->title = $_title;
            $updatenews->date = $_date;
            $updatenews->ref = $_ref;
            $updatenews->left = [
                'url' => $lefturl,
                'fe' => $_newsfeleft
            ];
            $updatenews->right = [
                'url' => $righturl,
                'fe' => $_newsferight
            ];
            $updatenews->update();
        }

    }
}
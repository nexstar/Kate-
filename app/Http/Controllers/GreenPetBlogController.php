<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;
use App\GreenPetBlog;
use App\appwebuserelempush;
use App\appwebuser;
use MongoDB\BSON\ObjectID as ObjectID;

class GreenPetBlogController extends Controller
{
    public function show($id){}

    public function sendNotifi($id){
        $Singles = GreenPetBlog::findOrFail($id);

        $getalluser = appwebuser::all();

        $AllUserarray = [];
        foreach ($getalluser as $list){
            array_push($AllUserarray,$list->_id);
        };

        //Insert To appwebuser and Send Notifi
        $elempush = new appwebuserelempush('', $AllUserarray, $Singles->title);
        $elempush->greenpet_blog();

        // finish Single Notifi Send
        $Singles->notifi = 1;
        $Singles->update();
        return redirect()->back();
    }

    public function index()
    {
        $greenpetblogs = GreenPetBlog::orderBy('created_at','desc')->get();
        return view('GreenPet.Blog.index',compact('greenpetblogs'));
    }

    public function create()
    {
        return view('GreenPet.Blog.create');
    }

    public function store(Request $request)
    {
        $this->create_update($request, '');
        return redirect('greenpetblog');
    }

    public function edit($id)
    {
        $greenpetblog = GreenPetBlog::findOrFail($id);

        $base64 = imageload::upimgpath('images/GreenPetBlog/'.$greenpetblog->src);

        session(['rmimg' => $greenpetblog->src ]);

        $DataToView = [
            'id' => $greenpetblog->_id,
            'title' => $greenpetblog->title,
            'link' => $greenpetblog->link,
            'src' => $base64,
            'fe' => $greenpetblog->fe,
            'contents' => $greenpetblog->contents
        ];

        return view('GreenPet.Blog.edit',compact('DataToView'));
    }

    public function update(Request $request, $id)
    {
        imageload::rmpic('GreenPetBlog', session('rmimg'));
        $this->create_update($request, $id);
        return redirect('greenpetblog');
    }

    public function destroy($id)
    {
        $greenpetblog = GreenPetBlog::findOrFail($id);

        imageload::rmpic('GreenPetBlog', $greenpetblog->src);
        $greenpetblog->delete();

        return redirect()->back();
    }

    public function create_update(Request $request, $id){
        $src = $request->imagesrcupload;
        $fe  = $request->imagesrcuploadFe;
        $newid = (String) new ObjectID;
        $imageload = new imageload($src, $fe,'GreenPetBlog','');
        $imageload->webimg();

        if($id == ""){
            $SaveToDB = [
                'sid' => $newid,
                'title' => $request->title,
                'link' => ($request->link == "")? "沒有連結" : "$request->link",
                'src' => $imageload->geturl(),
                'fe' => $fe,
                'contents' => $request->contents,
                'notifi' => 0
            ];
            GreenPetBlog::create($SaveToDB);
        }else{
            $greenpetblog = GreenPetBlog::findOrFail($id);
            $greenpetblog->title = $request->title;
            $greenpetblog->link = ($request->link == "")? "沒有連結" : "$request->link";
            $greenpetblog->src = $imageload->geturl();
            $greenpetblog->fe = $fe;
            $greenpetblog->contents = $request->contents;
            $greenpetblog->update();
        };

    }
}

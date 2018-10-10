<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\fblive;
use App\imageload;
use MongoDB\BSON\ObjectID as ObjectID;

class fblivecontroller extends Controller
{

    public function show($id){}
    public function fbclose($id,$number){
        $fblive = fblive::findOrFail($id);
        $fblive->open = (int) $number;
        $fblive->update();
        return redirect()->back();
    }

    public function index()
    {
        $fblive = fblive::orderBy('created_at','desc')->get();
        return view('GreenPet.Fblive.index',compact('fblive'));
    }

    public function create()
    {
        return view('GreenPet.Fblive.create');
    }

    public function store(Request $request)
    {
        $this->create_update($request,'');
        return redirect('fblive');
    }


    public function edit($id)
    {
        $fblive = fblive::findOrFail($id);

        $base64 = imageload::upimgpath('images/Fblive/'.$fblive->picjson['src']);

        session(['rmimg' => $fblive->picjson['src'] ]);

        $DataToView = [
            'id' => $fblive->_id,
            'title' => $fblive->title,
            'date' => $fblive->startdate.', '.$fblive->starttime,
            'src' => $base64,
            'fe' => $fblive->fe,
            'contents' => $fblive->contents
        ];
        return view('GreenPet.Fblive.edit',compact('DataToView'));
    }

    public function update(Request $request, $id)
    {
        imageload::rmpic('Fblive', session('rmimg'));
        $this->create_update($request, $id);
        return redirect('fblive');
    }

    public function destroy($id)
    {
        $kill = fblive::findOrFail($id);
        imageload::rmpic('Fblive', $kill->picjson['src']);
        $kill->delete();
        return redirect()->back();
    }

    public function create_update(Request $request, $id){
        $_title = $request->title;
        $_explode = explode(', ',$request->date);
        $_ymd  = $_explode[0];
        $_pmam = $_explode[1];
        $_src = $request->imagesrcupload;
        $_fe = $request->imagesrcuploadFe;
        $_contents = $request->contents;
        $newid = (String) new ObjectID;
        $imageload = new imageload($_src,$_fe,'Fblive','');
        $imageload->webimg();

        if($id == ""){
            $SaveToDB = [
                'sid' => $newid,
                'title' => $_title,
                'contents' => $_contents,
                'saw' => [],
                'path' => time(),
                'picjson' => [
                    'src' => $imageload->geturl(),
                    'fe'  => $_fe
                ],
                'startdate' => $_ymd,
                'starttime' => $_pmam,
                'open' => "0"
            ];
            fblive::create($SaveToDB);
        }else{
            $fblive = fblive::findOrFail($id);
            $fblive->title = $_title;
            $fblive->contents = $_contents;
            $fblive->picjson = [
                'src' => $imageload->geturl(),
                'fe'  => $_fe
            ];
            $fblive->startdate = $_ymd;
            $fblive->starttime = $_pmam;
            $fblive->update();
        };
    }

}

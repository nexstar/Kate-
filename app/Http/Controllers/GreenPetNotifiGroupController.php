<?php

namespace App\Http\Controllers;

use App\appwebuser;
use App\appwebuserelempush;
use App\petbigitem;
use App\petsmallitem;
use Illuminate\Http\Request;
use App\GreenPetGroupNotifi;
use App\imageload;
use Illuminate\Support\Facades\Session;
use MongoDB\BSON\ObjectID as ObjectID;
use App\getnotifiread;

class GreenPetNotifiGroupController extends Controller
{
    public function show($id){}

    public function info($id){

        $greenpetgroupnotifis = GreenPetGroupNotifi::findOrFail($id);

        $TmpViewarray = [
            'title' => $greenpetgroupnotifis->title,
            'link' => $greenpetgroupnotifis->link,
            'src' => $greenpetgroupnotifis->picjson['src'],
            'four' => $greenpetgroupnotifis->fouritem,
            'contents' => $greenpetgroupnotifis->contents
        ];

        $appwebusers   = appwebuser::all();
        $petbigitems   = petbigitem::all();
        $petsmallitems = petsmallitem::all();

        return view('GreenPet.Notifi.Group.info',compact('TmpViewarray','appwebusers','petbigitems','petsmallitems'));
    }

    public function notifi($id){
        $Singles = GreenPetGroupNotifi::findOrFail($id);
        $_fouritem = $Singles->fouritem;
        $AllUserarray = [];

        foreach ($_fouritem as $allCheck){

            switch ($allCheck['type']){
                case "pettype":
                    $Users = appwebuser::where('greenpetapp.petlist.planttype','=',$allCheck['id'])->get();
                    break;
                case "petname":
                    $Users = appwebuser::where('greenpetapp.petlist.plantname','=',$allCheck['id'])->get();
                    break;
                case "gender":
                    $Users = appwebuser::where('sex','=',$allCheck['id'])->get();
                    break;
                case "phone":
                    $Users = appwebuser::where('phone','=',$allCheck['id'])->get();
                    break;
            };

            foreach($Users as $list){
                array_push($AllUserarray,$list->_id);
            };
        };

        //Insert To appwebuser and Send Notifi
        $elempush = new appwebuserelempush($Singles->sid, array_unique($AllUserarray), $Singles->title);
        $elempush->greenpet_notifi();

        // finish Single Notifi Send
        $Singles->notifi = 1;
        $Singles->update();
        return redirect()->back();

    }

    public function index()
    {
        $fiterGroup = GreenPetGroupNotifi::where('reservemdh','=','null')->orderBy('created_at','desc')->get();

        $greenpetgroupnotifis = [];
        foreach ($fiterGroup as $result){
            if( $result->path == "GreenPetGroup"){
                $notifireadinfo = new getnotifiread($result->sid);
                array_push($greenpetgroupnotifis,array(
                    'id' => $result->_id,
                    'link' => $result->link,
                    'src' => $result->picjson['src'],
                    'title' => $result->title,
                    'contents' => $result->contents,
                    'notifi' => $result->notifi,
                    'read' => $notifireadinfo->read(),
                    'total' => $notifireadinfo->total()
                ));
            };
        };

        return view('GreenPet.Notifi.Group.index',compact('greenpetgroupnotifis'));
    }

    public function create()
    {
        $appwebusers   = appwebuser::all();
        $petbigitems   = petbigitem::all();
        $petsmallitems = petsmallitem::all();
        return view('GreenPet.Notifi.Group.create',compact('appwebusers','petbigitems','petsmallitems'));
    }

    public function store(Request $request)
    {
        $this->create_update($request, "",'');
        return redirect('greenpetnotifigroup');
    }

    public function edit($id)
    {
        $greenpetgroupnotifis = GreenPetGroupNotifi::findOrFail($id);

        $base64 = imageload::upimgpath('images/GreenPetGroup/'.$greenpetgroupnotifis->picjson['src']);

        $TmpViewarray = [
            'id' => $greenpetgroupnotifis->_id,
            'title' => $greenpetgroupnotifis->title,
            'link' => $greenpetgroupnotifis->link,
            'src' => $base64,
            'fe' => $greenpetgroupnotifis->picjson['fe'],
            'four' => $greenpetgroupnotifis->fouritem,
            'contents' => $greenpetgroupnotifis->contents
        ];

        session(['rmimg' => $greenpetgroupnotifis->picjson['src'] ]);
        $appwebusers   = appwebuser::all();
        $petbigitems   = petbigitem::all();
        $petsmallitems = petsmallitem::all();

        return view('GreenPet.Notifi.Group.edit',compact('TmpViewarray','appwebusers','petbigitems','petsmallitems'));
    }

    public function update(Request $request, $id)
    {
        imageload::rmpic('GreenPetGroup', session('rmimg'));
        $this->create_update($request, "edit_",$id);
        return redirect('greenpetnotifigroup');
    }

    public function destroy($id)
    {
        $killGroup = GreenPetGroupNotifi::findOrFail($id);
        imageload::rmpic('GreenPetGroup',$killGroup->picjson['src']);
        $killGroup->delete();
        return redirect()->back();
    }

    public function create_update(Request $request , $type, $id){
        $_title    = $request->title;
        $_link     = $request->link;
        $_base64   = $request->imagesrcupload;
        $_fe       = $request->imagesrcuploadFe;
        $_contents = $request->contents;
        $newid = (String) new ObjectID;
        $imageload = new imageload($_base64,$_fe,'GreenPetGroup','');
        $imageload->webimg();

        $CheckGroupHub = [];
        foreach ($request->CheckGroup as $list){
            array_push($CheckGroupHub,array(
                'type' => explode('_',$list)[0],
                'id' => explode('_',$list)[1]
            ));
        };

        if($type == ""){
            $SaveToDB = [
                'sid' => $newid,
                'title' => $_title,
                'link' => (is_null($_link) == true)? "null" : $_link,
                'picjson' => [
                    'src' => $imageload->geturl(),
                    'fe' => $_fe
                ],
                'reservemdh' => "null",
                'fouritem' => $CheckGroupHub,
                'contents' => $_contents,
                'notifi' => 0,
                'path' => 'GreenPetGroup'
            ];
            GreenPetGroupNotifi::create($SaveToDB);
        }else{
            $greenpetgroupnotifis = GreenPetGroupNotifi::findOrFail($id);

            $greenpetgroupnotifis->title = $_title;
            $greenpetgroupnotifis->link = (is_null($_link) == true)? "null" : $_link;
            $greenpetgroupnotifis->picjson = [
                'src' => $imageload->geturl(),
                'fe' => $_fe
            ];

            $greenpetgroupnotifis->reservemdh = "null";
            $greenpetgroupnotifis->fouritem = $CheckGroupHub;

            $greenpetgroupnotifis->contents = $_contents;
            $greenpetgroupnotifis->update();
        };

    }
}

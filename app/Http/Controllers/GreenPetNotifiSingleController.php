<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GreenPetSingleNotifi;
use App\imageload;
use App\appwebuserelempush;
use App\appwebuser;
use App\petbigitem;
use App\petsmallitem;

class GreenPetNotifiSingleController extends Controller
{
    public function show($id){}

    public function info($id){
        $single = GreenPetSingleNotifi::findOrFail($id);

        $TmpViewarray = [
            'title' => $single->title,
            'link' => $single->link,
            'src' => $single->picjson['src'],
            'four' => $single->fouritem,
            'contents' => $single->contents
        ];
        $appwebusers   = appwebuser::all();
        $petbigitems   = petbigitem::all();
        $petsmallitems = petsmallitem::all();
        return view('GreenPet.Notifi.Single.info',compact('TmpViewarray','appwebusers','petbigitems','petsmallitems'));
    }

    public function notifi($id){
        $Singles = GreenPetSingleNotifi::findOrFail($id);
        $_fouritem = $Singles->fouritem;
        $AllUserarray = [];

        //Gender
            switch ($_fouritem['type']){
                case "pettype":
                    $Users = appwebuser::where('greenpetapp.petlist.planttype','=',$_fouritem['id'])->get();
                    break;
                case "petname":
                    $Users = appwebuser::where('greenpetapp.petlist.plantname','=',$_fouritem['id'])->get();
                break;
                case "gender":
                    $Users = appwebuser::where('sex','=',$_fouritem['id'])->get();
                break;
                case "phone":
                    $Users = appwebuser::where('phone','=',$_fouritem['id'])->get();
                break;
            };

            foreach($Users as $list){
                array_push($AllUserarray,$list->_id);
            };

        //Insert To appwebuser and Send Notifi
        $elempush = new appwebuserelempush($id, $AllUserarray, $Singles->title);
        $elempush->greenpet_notifi();

        // finish Single Notifi Send
        $Singles->notifi = 1;
        $Singles->update();
        return redirect()->back();
    }

    public function index()
    {
        $single = GreenPetSingleNotifi::where('reservemdh','=','null')->orderBy('created_at','desc')->get();
        return view('GreenPet.Notifi.Single.index',compact('single'));
    }

    public function create()
    {
        $appwebusers   = appwebuser::all();
        $petbigitems   = petbigitem::all();
        $petsmallitems = petsmallitem::all();
        return view('GreenPet.Notifi.Single.create',compact('appwebusers','petbigitems','petsmallitems'));
    }

    public function store(Request $request)
    {
        $this->create_update($request, "",'');
        return redirect('greenpetnotifisingle');
    }

    public function edit($id)
    {
        $single = GreenPetSingleNotifi::findOrFail($id);

        $base64 = imageload::upimgpath('images/GreenPetSingle/'.$single->picjson['src']);

        $TmpViewarray = [
            'id' => $single->_id,
            'title' => $single->title,
            'link' => $single->link,
            'src' => $base64,
            'fe' => $single->picjson['fe'],
            'four' => $single->fouritem,
            'contents' => $single->contents
        ];

        session(['rmimg' => $single->picjson['src'] ]);

        $appwebusers   = appwebuser::all();
        $petbigitems   = petbigitem::all();
        $petsmallitems = petsmallitem::all();
        return view('GreenPet.Notifi.Single.edit',compact('TmpViewarray','appwebusers','petbigitems','petsmallitems'));
    }

    public function update(Request $request, $id)
    {
        imageload::rmpic('GreenPetSingle', session('rmimg'));
        $this->create_update($request, "edit_",$id);
        return redirect('greenpetnotifisingle');
    }

    public function destroy($id)
    {
        $killGroup = GreenPetSingleNotifi::findOrFail($id);
        imageload::rmpic('GreenPetSingle',$killGroup->picjson['src']);
        $killGroup->delete();
        return redirect()->back();
    }

    private function create_update(Request $request, $type,  $id)
    {
        $_title    = $request->title;
        $_link     = $request->link;
        $_base64   = $request->imagesrcupload;
        $_fe       = $request->imagesrcuploadFe;
        $_gender   = explode('_', $request->radiosingle);
        $_contents = $request->contents;
        $imageload = new imageload($_base64,$_fe,'GreenPetSingle','');
        $imageload->webimg();

        if($type == ""){
            $SaveToDB = [
                'title' => $_title,
                'link' => (is_null($_link) == true)? "null" : $_link,
                'picjson' => [
                    'src' => $imageload->geturl(),
                    'fe' => $_fe
                ],
                'reservemdh' => "null",
                'fouritem' => [
                    'type' => $_gender[0],
                    'id' => $_gender[1]
                ],
                'contents' => $_contents,
                'notifi' => 0
            ];

            GreenPetSingleNotifi::create($SaveToDB);
        }else{
            $greenpetgroupnotifis = GreenPetSingleNotifi::findOrFail($id);

            $greenpetgroupnotifis->title = $_title;
            $greenpetgroupnotifis->link = (is_null($_link) == true)? "null" : $_link;
            $greenpetgroupnotifis->picjson = [
                'src' => $imageload->geturl(),
                'fe' => $_fe
            ];

            $greenpetgroupnotifis->reservemdh = "null";
            $greenpetgroupnotifis->fouritem = [
                'id' => $_gender[1],
                'type' => $_gender[0]
            ];

            $greenpetgroupnotifis->contents = $_contents;
            $greenpetgroupnotifis->update();
        };
    }
}

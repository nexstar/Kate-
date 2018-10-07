<?php

namespace App\Http\Controllers;

use App\appwebuser;
use App\petbigitem;
use App\petsmallitem;
use Illuminate\Http\Request;
use App\imageload;
use App\GreenPetGroupNotifi;

class GreenPetNotifiReserveGroupController extends Controller
{
    public function show($id){}
    public function info($id){
        $greenpetgroupnotifis = GreenPetGroupNotifi::findOrFail($id);

        $TmpViewarray = [
            'title' => $greenpetgroupnotifis->title,
            'link' => $greenpetgroupnotifis->link,
            'src' => $greenpetgroupnotifis->picjson['src'],
            'four' => $greenpetgroupnotifis->fouritem,
            'reservemdh' => $greenpetgroupnotifis->reservemdh,
            'contents' => $greenpetgroupnotifis->contents
        ];

        $appwebusers   = appwebuser::all();
        $petbigitems   = petbigitem::all();
        $petsmallitems = petsmallitem::all();
        return view('GreenPet.Notifi.ReserveGroup.info',compact('TmpViewarray','appwebusers','petbigitems','petsmallitems'));
    }

    public function notifi(){

    }

    public function index()
    {
        $greenpetgroupnotifis = GreenPetGroupNotifi::where('reservemdh','<>','null')->orderBy('created_at','desc')->get();
        return view('GreenPet.Notifi.ReserveGroup.index',compact('greenpetgroupnotifis'));
    }

    public function create()
    {
        $appwebusers   = appwebuser::all();
        $petbigitems   = petbigitem::all();
        $petsmallitems = petsmallitem::all();
        return view('GreenPet.Notifi.ReserveGroup.create',compact('appwebusers','petbigitems','petsmallitems'));
    }

    public function store(Request $request)
    {
        $this->create_update($request, "",'');
        return redirect('greenpetnotifireservegroup');
    }

    public function edit($id)
    {
        $EditGroup = GreenPetGroupNotifi::findOrFail($id);

        $base64 = imageload::upimgpath('images/GreenPetReserveGroup/'.$EditGroup->picjson['src']);

        $TmpViewarray = [
            'id' => $EditGroup->_id,
            'title' => $EditGroup->title,
            'link' => $EditGroup->link,
            'src' => $base64,
            'fe' => $EditGroup->picjson['fe'],
            'reserve' => $EditGroup->reservemdh,
            'four' => $EditGroup->fouritem,
            'contents' => $EditGroup->contents
        ];

        session(['rmimg' => $EditGroup->picjson['src'] ]);
        $appwebusers   = appwebuser::all();
        $petbigitems   = petbigitem::all();
        $petsmallitems = petsmallitem::all();
        return view('GreenPet.Notifi.ReserveGroup.edit',compact('TmpViewarray','appwebusers','petbigitems','petsmallitems'));
    }

    public function update(Request $request, $id)
    {
        imageload::rmpic('GreenPetReserveGroup', session('rmimg'));
        $this->create_update($request, "edit_", $id);
        return redirect('greenpetnotifireservegroup');
    }

    public function destroy($id)
    {
        $killGroup = GreenPetGroupNotifi::findOrFail($id);
        imageload::rmpic('GreenPetReserveGroup',$killGroup->picjson['src']);
        $killGroup->delete();
        return redirect()->back();
    }

    public function create_update(Request $request , $type, $id){
        $_title    = $request->title;
        $_link     = $request->link;
        $_base64   = $request->imagesrcupload;
        $_fe       = $request->imagesrcuploadFe;
        $_month    = $request->modelmonth;
        $_day      = $request->modelday;
        $_hour     = $request->modelhour;
        $_contents = $request->contents;

        $imageload = new imageload($_base64,$_fe,'GreenPetReserveGroup','');
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
                'title' => $_title,
                'link' => (is_null($_link) == true)? "null" : $_link,
                'picjson' => [
                    'src' => $imageload->geturl(),
                    'fe' => $_fe
                ],
                'reservemdh' => [
                    'm' => $_month,
                    'd' => $_day,
                    'h' => $_hour
                ],
                'fouritem' => $CheckGroupHub,
                'contents' => $_contents,
                'notifi' => []
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
            $greenpetgroupnotifis->reservemdh = [
                'm' => $_month,
                'd' => $_day,
                'h' => $_hour
            ];
            $greenpetgroupnotifis->fouritem = $CheckGroupHub;
            $greenpetgroupnotifis->contents = $_contents;
            $greenpetgroupnotifis->update();
        };

    }
}

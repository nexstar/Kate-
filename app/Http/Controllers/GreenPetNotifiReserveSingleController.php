<?php

namespace App\Http\Controllers;

use App\appwebuser;
use App\petbigitem;
use App\petsmallitem;
use Illuminate\Http\Request;
use App\GreenPetSingleNotifi;
use App\imageload;

class GreenPetNotifiReserveSingleController extends Controller
{

    public function show($id){}

    public function info($id){
        $Reservesingle = GreenPetSingleNotifi::findOrFail($id);

        $TmpViewarray = [
            'title' => $Reservesingle->title,
            'link' => $Reservesingle->link,
            'src' => $Reservesingle->picjson['src'],
            'four' => $Reservesingle->fouritem,
            'reservemdh' => $Reservesingle->reservemdh,
            'contents' => $Reservesingle->contents
        ];
        $appwebusers   = appwebuser::all();
        $petbigitems   = petbigitem::all();
        $petsmallitems = petsmallitem::all();
        return view('GreenPet.Notifi.ReserveSingle.info',compact('TmpViewarray','appwebusers','petbigitems','petsmallitems'));
    }

    public function index()
    {
        $ReserveSingle = GreenPetSingleNotifi::where('reservemdh','<>','null')->orderBy('created_at','desc')->get();
        return view('GreenPet.Notifi.ReserveSingle.index',compact('ReserveSingle'));
    }

    public function create()
    {
        $appwebusers   = appwebuser::all();
        $petbigitems   = petbigitem::all();
        $petsmallitems = petsmallitem::all();
        return view('GreenPet.Notifi.ReserveSingle.create',compact('appwebusers','petbigitems','petsmallitems'));
    }

    public function store(Request $request)
    {
        $this->create_update($request, "",'');
        return redirect('greenpetnotifireservesingle');
    }

    public function edit($id)
    {
        $EditGroup = GreenPetSingleNotifi::findOrFail($id);

        $base64 = imageload::upimgpath('images/GreenPetReserveSingle/'.$EditGroup->picjson['src']);

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
        return view('GreenPet.Notifi.ReserveSingle.edit',compact('TmpViewarray','appwebusers','petbigitems','petsmallitems'));
    }

    public function update(Request $request, $id)
    {
        imageload::rmpic('GreenPetReserveSingle', session('rmimg'));
        $this->create_update($request, "edit_", $id);
        return redirect('greenpetnotifireservesingle');
    }

    public function destroy($id)
    {
        $killGroup = GreenPetSingleNotifi::findOrFail($id);
        imageload::rmpic('GreenPetReserveSingle',$killGroup->picjson['src']);
        $killGroup->delete();
        return redirect()->back();
    }

    private function create_update(Request $request, $type, $id)
    {
        $_title    = $request->title;
        $_link     = $request->link;
        $_base64   = $request->imagesrcupload;
        $_fe       = $request->imagesrcuploadFe;
        $_month    = $request->modelmonth;
        $_day      = $request->modelday;
        $_hour     = $request->modelhour;
        $_gender   = explode('_', $request->radiosingle);
        $_contents = $request->contents;

        $imageload = new imageload($_base64,$_fe,'GreenPetReserveSingle','');
        $imageload->webimg();

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
                'fouritem' => [
                    'type' => $_gender[0],
                    'id' => $_gender[1]
                ],
                'contents' => $_contents,
                'notifi' => []
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
            $greenpetgroupnotifis->reservemdh = [
                'm' => $_month,
                'd' => $_day,
                'h' => $_hour
            ];
            $greenpetgroupnotifis->fouritem = [
                'id' => $_gender[1],
                'type' => $_gender[0]
            ];

            $greenpetgroupnotifis->contents = $_contents;
            $greenpetgroupnotifis->update();
        };
    }
}

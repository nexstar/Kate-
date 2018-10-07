<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pdbigitem;
use App\pdsmallitem;

class OnlineProductItemsController extends Controller
{
    public function smallshow($name){
        $pdsmallitems = pdsmallitem::where('bigname', $name)->get();
        return json_encode($pdsmallitems);
    }

    public function smallitemstore(Request $request){
        $_smallitemtitle = $request->smallitemtitle;
        $_smallid = $request->smallid;
        pdsmallitem::create(['bigname' => $_smallid, 'name' => $_smallitemtitle]);
        return redirect()->back();
    }

    public function smallitemupdate(Request $request, $id){
        $_editsmallitem = $request->editsmallitem;

        $pdsmallitems = pdsmallitem::findOrFail($id);
        $pdsmallitems->name = $_editsmallitem;
        $pdsmallitems->update();
        return "1|ok";
    }

    public function smallitemdestroy($id){
        pdsmallitem::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function index(){
        $pdbigitems = pdbigitem::orderBy('created_at','desc')->get();

        $smallitem = [
            "請選擇大項" => "請選擇大項"
        ];

        foreach ($pdbigitems as $pdbigitemslist){
            $smallitem[$pdbigitemslist->name] = $pdbigitemslist->name;
        };

        return view('Online.Product.Items.index',compact('pdbigitems','smallitem'));
    }

    public function bigitemstore(Request $request){
        $_bigitemtitle = $request->bigitemtitle;
        pdbigitem::create(['name' => $_bigitemtitle]);
        return redirect()->back();
    }

    public function bigitemupdate(Request $request, $id){
        $_editbigitem = $request->editbigitem;

        $pdbigitems = pdbigitem::findOrFail($id);
        $pdbigitems->name = $_editbigitem;
        $pdbigitems->update();

        return redirect()->back();
    }

    public function bigitemdestroy($id){
        pdbigitem::findorFail($id)->delete();
        return redirect()->back();
    }

}

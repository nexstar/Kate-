<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Classify;

class OnlineProductTpyeController extends Controller
{
    public function show($id){}

    public function index()
    {
        $classifys = Classify::orderBy('created_at','desc')->get();
        $showdata = [];

        foreach ($classifys as $classifyslist){
            $pdname = [];
            for ($i=0;$i<count($classifyslist->addcheckboxgroup);$i++){
                array_push($pdname,
                    array(
                        "id" => $classifyslist->addcheckboxgroup[$i]['id'],
                        "name" => $classifyslist->addcheckboxgroup[$i]['name']
                    )
                );
            };

            array_push($showdata,
                array(
                    "id" => $classifyslist->_id,
                    "name" => $classifyslist->name,
                    "group" => $pdname
                )
            );
        };
        return view('Online.Product.Type.index',compact('showdata'));
    }

    public function create()
    {
        $product = Product::all(['_id','title']);
        return view('Online.Product.Type.create',compact('product'));
    }

    public function store(Request $request)
    {
        $_checkboxgroup = $request->addcheckboxgroup;
        $_namegroup     = $request->addnamegroup;

        $SaveDB = [];
        for ($i=0;$i<count($_checkboxgroup);$i++){
            array_push($SaveDB,
                array(
                    "id" => $_checkboxgroup[$i],
                    "name" => $_namegroup[$i]
                )
            );
        };

        Classify::create([
            'name' => $request->name,
            'addcheckboxgroup' => $SaveDB
        ]);

        return redirect('onlineproducttpye');
    }

    public function edit($id)
    {
        $classifys = Classify::findOrFail($id);
        $products  = Product::all(['_id','title']);

        $maxgroup = [
            'id' => $classifys->_id,
            'name' => $classifys->name,
            'group' => []
        ];
        foreach($products as $productslist){
            for($i=0; $i<count($classifys->addcheckboxgroup); $i++){
                $_status = 0;
                if( ( $productslist->_id == $classifys->addcheckboxgroup[$i]['id'] ) &&
                    ( $productslist->title == $classifys->addcheckboxgroup[$i]['name'] ) ){
                    $_status = 1;
                    break;
                };
            };
            array_push($maxgroup['group'],
                array(
                    "id" => $productslist->_id,
                    "name" => $productslist->title,
                    "status" => $_status
                )
            );
        };

        return view('Online.Product.Type.edit',compact('maxgroup'));
    }

    public function update(Request $request, $id)
    {

        $_name = $request->name;
        $_groupid   = $request->editcheckboxgroup;
        $_groupname = $request->addnamegroup;

        $SaveDB = [];
        for ($i=0;$i<count($_groupid);$i++){
            array_push($SaveDB,
                array(
                    "id" => $_groupid[$i],
                    "name" => $_groupname[$i]
                )
            );
        };

        $classifys = Classify::findOrFail($id);
        $classifys->name = $_name;
        $classifys->addcheckboxgroup = $SaveDB;
        $classifys->update();

        return redirect('onlineproducttpye');
    }

    public function destroy($id)
    {
        Classify::findOrFail($id)->delete();
        return redirect()->back();
    }
}
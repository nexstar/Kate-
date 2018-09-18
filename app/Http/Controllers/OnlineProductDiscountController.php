<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineProductDiscountController extends Controller
{
    public function allwebupdate(Request $request, $id){
        dd($request->all());
    }

    public function fullamountupdate(Request $request, $id){
        dd($request->all());
    }

    public function bonusupdate(Request $request, $id){
        dd($request->all());
    }

    public function index()
    {
        $tmp = [
            0 => array(
                "id" => "5927abc",
                "name" => "情人節",
                "discount" => "22",
                "checkgroup" => [
                    0 => "AAA",
                    1 => "BBB",
                    2 => "CCC",
                    3 => "DDD",
                    4 => "EEE",
                ]
            ),
            1 => array(
                "id" => "5927cccc",
                "name" => "情人節1",
                "discount" => "50",
                "checkgroup" => [
                    0 => "AAA",
                    1 => "BBB"
                ]
            )
        ];

        return view('Online.Product.Discount.index',compact('tmp'));
    }

    public function create()
    {
        return view('Online.Product.Discount.create');
    }

    public function store(Request $request)
    {
        $_name        = $request->pddiscountname;
        $_discount    = $request->pddiscountcount;
        $_checkboxgrp = $request->addcheckboxgroup;

        $tmp = [
            'name' => $_name,
            'discount' => $_discount,
            'checkboxgrp' => $_checkboxgrp
        ];

        foreach ($_checkboxgrp as $checkid){
            // $checkid to update sql query where 1
        };

        dd($tmp);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tmpdb = [
            "name" => "AAAAA",
            "discount" => "12",
            "checkboxgrp" => array(
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "11",
                4 => "15"
            )
        ];

        $tmp = [
            "checkboxgrp" => array(
                0 => "1",
                1 => "15",
                2 => "11"
            )
        ];

        $tmpmix = [
            'name' => $tmpdb['name'],
            'discount' => $tmpdb['discount'],
            'checkgrouped' => []
        ];

        foreach ($tmpdb['checkboxgrp'] as $dbresult){
            $tmpstr = 0;
            foreach($tmp['checkboxgrp'] as $tmpresult){
                if(  ($tmpresult == $dbresult) ){
                    $tmpstr = 1;
                    break;
                };
            };

            array_push($tmpmix['checkgrouped'], array(
                'id' => $dbresult,
                'status' => $tmpstr,
            ));
        };

        return view('Online.Product.Discount.edit',compact('tmp','tmpmix'));
    }

    public function update(Request $request, $id)
    {
        $_name       = $request->pddiscountname;
        $_discount   = $request->pddiscountcount;
        $_checkgroup = $request->editcheckboxgroup;
        $_oldcheckgroup = $request->oldcheckgroup;

        foreach ($_oldcheckgroup as $initdata){
            // $initdata to update sql query where 0
            // init $initdata all 0
        };

        foreach($_checkgroup as $updatedb){
            // $updatedb to update sql query where 1
        };

        $savedb = [
            'name' => $_name,
            'discount' => $_discount,
            'checkgroup' => $_checkgroup
        ];

        dd($savedb);
        return redirect('onlineproductdiscount');
    }

    public function destroy($id)
    {
        dd($id);
    }
}

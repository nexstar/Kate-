<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineProductTpyeController extends Controller
{

    public function index()
    {
        $tmpdb = [
            0 => [
                "id" => "CCCCCC",
                "name" => "1111111",
                "addcheckboxgroup" => [
                    0 => [
                        'id' => '1',
                        'name' => 'AAA',
                    ],
                    1 => [
                        'id' => '2',
                        'name' => 'BBB',
                    ],
                    2 => [
                        'id' => '3',
                        'name' => 'CCC',
                    ],
                    3 => [
                        'id' => '4',
                        'name' => 'DDD',
                    ]
                ]
            ]
        ];

        return view('Online.Product.Type.index',compact('tmpdb'));
    }

    public function create()
    {
        return view('Online.Product.Type.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tmpdb = [
            "name" => "1111111",
            "addcheckboxgroup" => [
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
            ]
        ];

        $tmp = [
            "addcheckboxgroup" => array(
                0 => "1",
                1 => "13",
                2 => "11"
            )
        ];

        $tmpmix = [
            'name' => $tmpdb['name'],
            'checkgrouped' => []
        ];

        foreach ($tmpdb['addcheckboxgroup'] as $dbresult){
            $tmpstr = 0;
            foreach($tmp['addcheckboxgroup'] as $tmpresult){
                if(  ($tmpresult == $dbresult) ){
                    $tmpstr = 1;
                    break;
                };
            };

            array_push($tmpmix['checkgrouped'], array(
                'id' => $dbresult,
                'name' => 'AAAAA',
                'status' => $tmpstr,
            ));
        };

        return view('Online.Product.Type.edit',compact('tmpmix'));
    }

    public function update(Request $request, $id)
    {
        $_name       = $request->name;
        $_checkgroup = $request->editcheckboxgroup;
        $_oldcheckgroup = $request->oldcheck;

        foreach ($_oldcheckgroup as $initdata){
            // $initdata to update sql query where 0
            // init $initdata all 0
        };

        foreach($_checkgroup as $updatedb){
            // $updatedb to update sql query where 1
        };

        $savedb = [
            'name' => $_name,
            'checkgroup' => $_checkgroup
        ];

        dd($savedb);
    }

    public function destroy($id)
    {
        dd($id);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;

class OnlineProductController extends Controller
{
    public function offline($id){
        dd($id);
    }

    public function online($id){
        dd($id);
    }

    public function index()
    {
        $TmpDB = [
            0 => [
                "id" => "我是_id",
                "title" => "商品AAA",
                "pdbigitem" => "1",
                "pdsmallitem" => "10",
                "src" => "product_1537192232_titlepage.jpg",
                "fe" => "jpg",
                "inventory" => "1000",
                "onoff" => "0"
            ]
        ];

        for($i=0;$i<count($TmpDB);$i++){
            //封面
            $getbase64  = imageload::upimgpath( ('images/product/'.$TmpDB[$i]['src']) );
            $TmpDB[$i]['src'] = $getbase64;
        }

        return view('Online.Product.index',compact('TmpDB'));
    }

    public function smallitem($id){

        $tmpsmallitem = [
            '請選擇小項' => '請選擇小項'
        ];

        for ($i=1; $i<10; $i++){
            $tmpsmallitem[$i] = $i*10;
        };

        return json_encode($tmpsmallitem);
    }

    public function info($info){

        $TmpDB = [
            "money" => "990",
            "bouns" => "100",
            "inventory" => "1000",
            "buycount" => 999,
            "seecount" => 999,
            "date" => "2018/9/17, 12:00:00 AM",
            "addpd" => [
                0 => [
                    "smallid" => "20",
                    "money" => "200",
                    "name" => "ABC",
                    "src" => "product_1537205130_edit_titlepage.jpg",
                    "fe" => ""
                ],
                1 => [
                    "smallid" => "30",
                    "money" => "300",
                    "name" => "ABC123",
                    "src" => "product_1537192232_titlepage.jpg",
                    "fe" => ""
                ],
            ]
        ];

        for($i=0;$i < count($TmpDB['addpd']); $i++){
            $getmodelbase64  = imageload::upimgpath( ('images/product/'.$TmpDB['addpd'][$i]['src']) );
            $TmpDB['addpd'][$i]['src'] = $getmodelbase64;
        };

        $TmpType = [
            0 => [
                "name" => "1111111",
                "addcheckboxgroup" => [
                    0 => "1",
                    1 => "5",
                    2 => "9",
                    3 => "13",
                ]
            ],
            1 => [
                "name" => "222222",
                "addcheckboxgroup" => [
                    0 => "1",
                    1 => "5",
                    2 => "9",
                    3 => "13",
                ]
            ]
        ];

        return view('Online.Product.indexinfo',compact('TmpDB','TmpType'));
    }

    public function create()
    {
        $tmpbigitem = [
            '請選擇大項' => '請選擇大項'
        ];

        for ($i=1; $i<10; $i++){
            $tmpbigitem[$i] = $i;
        };

        return view('Online.Product.create', compact('tmpbigitem'));
    }

    public function store(Request $request)
    {
        $this->create_update($request, "");

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tmpbigitem = [
            '請選擇大項' => '請選擇大項'
        ];

        for ($i=1; $i<10; $i++){
            $tmpbigitem[$i] = $i;
        };

        $TmpDB = [
            "id" => "我是_id",
            "title" => "商品AAA",
            "money" => "990",
            "pdbigitem" => "1",
            "pdsmallitem" => "10",
            "bouns" => "100",
            "inventory" => "1000",
            "date" => "2018/9/17, 12:00:00 AM",
            "contents" => "商品內容",
            "src" => "product_1537192232_titlepage.jpg",
            "fe" => "jpg",
            "onoff" => 0,
            "discount" => 0,
            "buycount" => 999,
            "seecount" => 999,
            "prompt" => [
                0 => "A001",
                1 => "A002",
                2 => "A003",
            ],
            "addpd" => [
                0 => [
                    "smallid" => "20",
                    "money" => "200",
                ],
                1 => [
                    "smallid" => "30",
                    "money" => "300",
                ],
            ],
            "modelgc" => [
                0 => [
                    "title" => "模組標題A",
                    "src" => "product_1537192232_0.jpg",
                    "fe" => "jpg",
                    "contents" => "模組內容A",
                ],
                1 => [
                    "title" => "模組標題B",
                    "src" => "product_1537192232_1.jpg",
                    "fe" => "jpg",
                    "contents" => "模組內容B",
                ],
            ],
        ];

        //封面
        $getbase64  = imageload::upimgpath( ('images/product/'.$TmpDB['src']) );
        $TmpDB['src'] = $getbase64;

        //模組介紹
        for($i=0;$i < count($TmpDB['modelgc']); $i++){
            $getmodelbase64  = imageload::upimgpath( ('images/product/'.$TmpDB['modelgc'][$i]['src']) );
            $TmpDB['modelgc'][$i]['src'] = $getmodelbase64;
        };

        return view('Online.Product.edit', compact('TmpDB','tmpbigitem'));
    }

    public function update(Request $request, $id)
    {
        $this->create_update($request, "edit_");
    }

    public function destroy($id)
    {
        dd($id);
    }

    public function create_update(Request $request, $type){
        $_title       = $request->title;
        $_money       = $request->money;
        $_pdbigitem   = $request->pdbigitem;
        $_pdsmallitem = $request->pdsmallitem;
        $_bouns       = $request->bouns;
        $_inventory   = $request->inventory;
        $_date        = $request->date;
        $_contents    = $request->contents;

        //商品封面照
        $_imagesrcupload   = $request->imagesrcupload;
        $_imagesrcuploadFe = $request->imagesrcuploadFe;
        $imageload = new imageload($_imagesrcupload,$_imagesrcuploadFe,'product',($type.'titlepage'));
        $imageload->webimg();


        //商品小提示
        $_prompt = $request->prompt;

        //商品加購
        $Tmpaddpd = [];
        $_pdmodeltitle = $request->pdmodeltitle;
        $_pdmodelmoney = $request->pdmodelmoney;
        for($i=0;$i<count($_pdmodeltitle);$i++){
            array_push($Tmpaddpd, array(
                'smallid' => $_pdmodeltitle[$i],
                'money' => $_pdmodelmoney[$i]
            ));
        };

        //模組介紹
        $Tmpmodelgc     = [];
        $_gcdivtitle    = $request->gcdivtitle;
        $_gcsrc         = $request->gcsrc;
        $_gcsrcfe       = $request->gcsrcfe;
        $_gcdivcontents = $request->gcdivcontents;

        for($i=0;$i<count($_gcsrcfe);$i++){
            $imageloadmodel = new imageload($_gcsrc[$i],$_gcsrcfe[$i],'product',($type.$i));
            $imageloadmodel->webimg();
            array_push($Tmpmodelgc,array(
                'title' => $_gcdivtitle[$i],
                'src' => $imageloadmodel->geturl(),
                'fe' => $_gcsrcfe[$i],
                'contents' => $_gcdivcontents[$i],
            ));
        };

        $TmpSaveToDB = [
            "id" => "我是_id",
            'title' => $_title,
            'money' => $_money,
            'pdbigitem' => $_pdbigitem,
            'pdsmallitem' => $_pdsmallitem,
            'bouns' => $_bouns,
            'inventory' => $_inventory,
            'date' => $_date,
            'contents' => $_contents,
            'src' => $imageload->geturl(),
            'fe' => $_imagesrcuploadFe,
            "onoff" => 0,
            "discount" => 0,
            "buycount" => 999,
            "seecount" => 999,
            'prompt' => $_prompt,
            'addpd' => $Tmpaddpd,
            'modelgc' => $Tmpmodelgc
        ];

        dd($TmpSaveToDB);

        if($type == ""){

        }else{

        };

    }
}
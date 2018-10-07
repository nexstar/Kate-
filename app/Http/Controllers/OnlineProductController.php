<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;
use App\pdbigitem;
use App\Product;
use App\Classify;

class OnlineProductController extends Controller
{

    public function onoffline($id,$uplow){
        $products = Product::findOrFail($id);
        $products->onoff = ((int) $uplow);
        $products->update();
        return redirect()->back();
    }

    public function index()
    {
        $products = Product::orderBy('created_at','desc')->get();

        $TmpDB = [];

        foreach ($products as $productslist){
            array_push($TmpDB,
                array(
                    "id" => $productslist->_id,
                    "title" => $productslist->title,
                    "pdbigitem" => $productslist->pdbigitem,
                    "pdsmallitem" => $productslist->pdsmallitem,
                    "src" => $productslist->src,
                    "fe" => $productslist->fe,
                    "inventory" => ((int) $productslist->inventory),
                    "onoff" => $productslist->onoff,
                )
            );
        };

        for($i=0;$i<count($TmpDB);$i++){
            //封面
            $getbase64  = imageload::upimgpath( ('images/product/'.$TmpDB[$i]['src']) );
            $TmpDB[$i]['src'] = $getbase64;
        }

        return view('Online.Product.index',compact('TmpDB'));
    }

    public function info($info){

        $products = Product::findOrFail($info);

        $TmpDB = [
            "title" => $products->title,
            "money" => $products->money,
            "bouns" => $products->bouns,
            "inventory" => $products->inventory,
            "buycount" => count($products->buycount),
            "point" => count($products->point),
            "date" => $products->date,
            "addpd" => []
        ];

        for ($i=0;$i<count($products->addpd);$i++){
            $getpdsrc = Product::findOrFail($products->addpd[$i]['pdid']);

            array_push($TmpDB['addpd'],
                array(
                    'pdid' => $products->addpd[$i]['pdid'],
                    'pdname' => $products->addpd[$i]['pdname'],
                    'money' => $products->addpd[$i]['money'],
                    "src" => $getpdsrc->src
                )
            );
        };

        for($i=0;$i < count($TmpDB['addpd']); $i++){
            $getmodelbase64  = imageload::upimgpath( ('images/product/'.$TmpDB['addpd'][$i]['src']) );
            $TmpDB['addpd'][$i]['src'] = $getmodelbase64;
        };

        $classifys = Classify::where('addcheckboxgroup','elemMatch',[ 'name' => ['$eq' => $products->title] ])->get();

        $TmpType = [];

        foreach ($classifys as $classifyslist){
            array_push($TmpType,
                array(
                    "name" => $classifyslist->name
                )
            );
        };

        return view('Online.Product.indexinfo',compact('TmpDB','TmpType'));
    }

    public function create()
    {
        $tmpbigitem = [
            '請選擇大項' => '請選擇大項'
        ];
        $pdbigitem = pdbigitem::orderBy('created_at','desc')->get();
        foreach ($pdbigitem as $pdbigitemlist){
            $tmpbigitem[$pdbigitemlist->name] = $pdbigitemlist->name;
        };

        return view('Online.Product.create', compact('tmpbigitem'));
    }

    public function store(Request $request)
    {
        $this->create_update($request, "","");
        return redirect('onlineproduct');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $pdbigitem = pdbigitem::all();
        $tmpbigitem = [
            '請選擇大項' => '請選擇大項'
        ];

        foreach ($pdbigitem as $pdbigitemlist){
            $tmpbigitem[$pdbigitemlist->name] = $pdbigitemlist->name;
        };

        $product = Product::findOrFail($id);

        $TmpDB = [
            "id" => $product->_id,
            "title" => $product->title,
            "money" => ((int) $product->money),
            "pdbigitem" => $product->pdbigitem,
            "pdsmallitem" => $product->pdsmallitem,
            "bouns" => $product->bouns,
            "inventory" => $product->inventory,
            "date" => $product->date,
            "contents" => $product->contents,
            "src" => $product->src,
            "fe" => $product->fe,
            "prompt" => [],
            "addpd" => [],
            "modelgc" => []
        ];

        session(['rmimg' => $product->src ]);

        for ($i=0;$i<count($product->prompt);$i++){
            $TmpDB['prompt'][$i] = $product->prompt[$i];
        };

        for ($i=0;$i<count($product->addpd);$i++){
            array_push($TmpDB['addpd'],
                array(
                    "pdid" => $product->addpd[$i]['pdid'],
                    "pdname" => $product->addpd[$i]['pdname'],
                    "money" => $product->addpd[$i]['money'],
                )
            );
        };

        for ($i=0;$i<count($product->modelgc);$i++){
            array_push($TmpDB['modelgc'],
                array(
                    "title" => $product->modelgc[$i]['title'],
                    "src" => $product->modelgc[$i]['src'],
                    "fe" => $product->modelgc[$i]['fe'],
                    "contents" => $product->modelgc[$i]['contents'],
                )
            );
        };

        session(['rmmodelimg' => $product->modelgc ]);

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

    public function pdname($name){
        $products = Product::where('pdsmallitem',$name)->get();
        return json_encode($products);
    }

    public function update(Request $request, $id)
    {
        imageload::rmpic('product', session('rmimg'));
        imageload::modelrmpic('product', session('rmmodelimg'),'src');
        $this->create_update($request, "edit_",$id);
        return redirect('onlineproduct');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $_rmimg = $product->src;
        $_rmmodelimg = $product->modelgc;

        imageload::rmpic('product', $_rmimg);
        imageload::modelrmpic('product', $_rmmodelimg,'src');

        $product->delete();
        return redirect()->back();
    }

    public function create_update(Request $request, $type,$id){
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
        $_pdmodelpdid  = $request->pdmodelpdid;
        $_pdmodeltitle = $request->pdmodeltitle;
        $_pdmodelmoney = $request->pdmodelmoney;
        for($i=0;$i<count($_pdmodeltitle);$i++){
            array_push($Tmpaddpd, array(
                'pdid' => $_pdmodelpdid[$i],
                'pdname' => $_pdmodeltitle[$i],
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

        if($type == ""){
            $product = new Product;
            $product->title = $_title;
            $product->money = $_money;
            $product->pdbigitem = $_pdbigitem;
            $product->pdsmallitem = explode('_', $_pdsmallitem)[1];
            $product->bouns = $_bouns;
            $product->inventory = $_inventory;
            $product->date = $_date;
            $product->contents = $_contents;
            $product->src = $imageload->geturl();
            $product->fe = $_imagesrcuploadFe;
            $product->discountstatus = 0;
            $product->onoff = 0;
            $product->buycount = [];
            $product->point = [];
            $product->prompt = $_prompt;
            $product->addpd = $Tmpaddpd;
            $product->modelgc = $Tmpmodelgc;
            $product->save();
        }else{
            $product = Product::findOrFail($id);
            $product->title = $_title;
            $product->money = $_money;
            $product->pdbigitem = $_pdbigitem;
            $product->pdsmallitem = $_pdsmallitem;
            $product->bouns = $_bouns;
            $product->inventory = $_inventory;
            $product->date = $_date;
            $product->contents = $_contents;
            $product->src = $imageload->geturl();
            $product->fe = $_imagesrcuploadFe;
            $product->onoff = 0;
            $product->prompt = $_prompt;
            $product->addpd = $Tmpaddpd;
            $product->modelgc = $Tmpmodelgc;
            $product->update();
        };

    }
}
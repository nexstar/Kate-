<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\imageload;
use App\Article;

class OnlineArticleController extends Controller
{
    public function show($id){}

    private $articleType = [
        0 => "",
        1 => "春", 2 => "夏",
        3 => "秋", 4 => "冬",
        5 => "照顧小幫手"
    ];

    public function onoffonline($id,$uplow){
        $article = Article::findOrFail($id);
        $article->onffonline = $uplow;
        $article->update();
        return redirect()->back();
    }

    public function index()
    {
        $article = Article::orderBy('created_at', 'desc')->get();
        $_articleType =  $this->articleType;
        return view('Online.Article.index',compact('article','_articleType'));
    }

    public function create()
    {
        return view('Online.Article.create');
    }

    public function store(Request $request)
    {
        $this->create_update($request, "","");
        return redirect()->route('onlinearticle.index');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        $TestData = [
            "_id" => $id,
            "title" => $article->title,
            "type" => $article->type,
            "img" => $article->picloadjson['img'],
            "fe" => $article->picloadjson['fe'],
            "contents" => $article->contents,
            "model" => $article->introductionjson
        ];

        session(['rmimg' => $article->picloadjson['img'] ]);
        session(['rmmodelimg' => $article->introductionjson ]);

        $getbase64 = imageload::upimgpath('images/article/'. $TestData['img']);
        $TestData['img'] = $getbase64;

        for ($i=0; $i<count($TestData['model']); $i++){
            $getbase64 = imageload::upimgpath('images/article/'. $TestData['model'][$i]['picaddress']);
            $TestData['model'][$i]['picaddress'] = $getbase64;
        };

        return view('Online.Article.edit', compact('TestData'));
    }

    public function update(Request $request, $id)
    {
        imageload::rmpic('article', session('rmimg'));
        imageload::modelrmpic('article', session('rmmodelimg'),'picaddress');
        $this->create_update($request, "edit_",$id);
        return redirect()->route('onlinearticle.index');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $_rmimg = $article->picloadjson['img'];
        $_rmmodelimg = $article->introductionjson;

        imageload::rmpic('article', $_rmimg);
        imageload::modelrmpic('article', $_rmmodelimg,'picaddress');

        $article->delete();
        return redirect()->back();
    }

    private function create_update($request, $type,$id){
        $title            = $request->title;
        $articletype      = $request->articletype;
        $imagesrcupload   = $request->imagesrcupload;
        $imagesrcuploadFe = $request->imagesrcuploadFe;
        $contents         = $request->contents;

        $imageload = new imageload(
            $imagesrcupload, $imagesrcuploadFe,
            'article', ($type.'titlepage')
        );
        $imageload->webimg();
        $titlepage_img = $imageload->geturl();

        //模組介紹
        $gcdivtitle    = $request->gcdivtitle;
        $gcsrc         = $request->gcsrc;
        $gcsrcfe       = $request->gcsrcfe;
        $gcdivcontents = $request->gcdivcontents;
        $modelpicaddress = [];

        for($i=0; $i<count($gcsrcfe); $i++){
            $modelimageload = new imageload(
                $gcsrc[$i], $gcsrcfe[$i],'article', ($type.$i)
            );
            $modelimageload->webimg();
            array_push($modelpicaddress,
                array(
                    'title' => $gcdivtitle[$i], 'picaddress' => $modelimageload->geturl(),
                    'fe' => $gcsrcfe[$i], 'contents' => $gcdivcontents[$i]
                )
            );
        };

        if($type == ""){
            $article = new Article();
            $article->title = $title;
            $article->type = $articletype;
            $article->picloadjson  = [
                'img' => $titlepage_img,
                'fe' => $imagesrcuploadFe,
            ];
            $article->point  = [];
            $article->hotarticle = 0;
            $article->onffonline = 0;
            $article->contents = $contents;
            $article->introductionjson = $modelpicaddress;
            $article->save();
        }else{
            $updatearticle = Article::findOrFail($id);
            $updatearticle->title = $title;
            $updatearticle->type = $articletype;
            $updatearticle->picloadjson  = [
                'img' => $titlepage_img,
                'fe' => $imagesrcuploadFe,
            ];
            $updatearticle->onffonline = 0;
            $updatearticle->contents = $contents;
            $updatearticle->introductionjson = $modelpicaddress;
            $updatearticle->update();
        }
    }
}

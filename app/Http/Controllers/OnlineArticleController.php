<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;

class OnlineArticleController extends Controller
{
    public function show($id){}
    private $articleType = [
        0 => "",
        1 => "春", 2 => "夏",
        3 => "秋", 4 => "冬",
        5 => "照顧小幫手"
    ];

    public function index()
    {
        return view('Online.Article.index');
    }

    public function create()
    {
        return view('Online.Article.create');
    }

    public function store(Request $request)
    {
        $this->create_update($request, "");
    }

    public function edit($id)
    {
        $TestData = [
            "title" => "文章標題測試A",
            "type" => "1",
            "img" => "article_1536802451_titlepage.jpg",
            "fe" => "jpg",
            "point" => "9999",
            "contents" => "文章內容測試A",
            "model" => array(
                0 => array(
                  "title" => "模組標題A",
                  "picaddress" => "article_1536802451_0.jpg",
                  "fe" => "jpg",
                  "contents" => "模組內容A",
                ),
                1 => array(
                  "title" => "模組標題B",
                  "picaddress" => "article_1536802451_1.jpg",
                  "fe" => "jpg",
                  "contents" => "模組內容B",
                ),
                2 => array(
                  "title" => "模組標題C",
                  "picaddress" => "article_1536802451_2.jpg",
                  "fe" => "jpg",
                  "contents" => "模組內容C",
                ),
                3 => array(
                  "title" => "模組標題D",
                  "picaddress" => "article_1536802451_3.jpg",
                  "fe" => "jpg",
                  "contents" => "模組內容D",
                )
            )
        ];

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
        $this->create_update($request, "edit_");
    }

    public function destroy($id)
    {
        //
    }

    private function create_update($request, $type){
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
            $imageload = new imageload(
                $gcsrc[$i], $gcsrcfe[$i],'article', ($type.$i)
            );
            $imageload->webimg();
            array_push($modelpicaddress,
                array(
                    'title' => $gcdivtitle[$i], 'picaddress' => $imageload->geturl(),
                    'fe' => $gcsrcfe[$i], 'contents' => $gcdivcontents[$i]
                )
            );
        };

        $article = [
            'title' => $title,
            'type' => $articletype,
            'img' => $titlepage_img,
            'fe' => $imagesrcuploadFe,
            "point" => [],
            "hotarticle" => 0,
            'contents' => $contents,
            'model' => $modelpicaddress
        ];

        dd( $article );
        if($type === ""){

        }else{

        };
    }
}

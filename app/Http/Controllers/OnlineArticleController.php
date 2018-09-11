<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;

class OnlineArticleController extends Controller
{

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
        $title            = $request->title;
        $articletype      = $request->articletype;
        $imagesrcupload   = $request->imagesrcupload;
        $imagesrcuploadFe = $request->imagesrcuploadFe;
        $contents         = $request->contents;

        $imageload = new imageload(
                            $imagesrcupload, $imagesrcuploadFe,
                            'article','titlepage'
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
                                $gcsrc[$i], $gcsrcfe[$i],'article', $i
                            );
            $imageload->webimg();
            array_push($modelpicaddress,
                array(
                    'title' => $gcdivtitle[$i], 'picaddress' => $imageload->geturl(), 'contents' => $gcdivcontents[$i]
                )
            );
        };

        $article = [
            'title' => $title,
            'type' => $articletype,
            'img' => $titlepage_img,
            'contents' => $contents,
            'model' => $modelpicaddress
        ];
        dd( $article );
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('Online.Article.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

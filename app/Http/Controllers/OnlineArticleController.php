<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class OnlineArticleController extends Controller
{
    private function setimg($pic, $path, $fe, $count){
        $Cutnumber = strpos($pic,',');
        $pic = (mb_substr($pic,( $Cutnumber + 1 ),strlen($pic),"utf-8"));
        $imgData = base64_decode($pic);
        $png_url = $count."_".time().'.'.$fe;
        file_put_contents($path.$png_url, $imgData);
        return $png_url;
    }

    protected $public_path = "";

    public function __construct()
    {
        $this->public_path = public_path('/images/article/');
    }

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
        $articlepicaddress =  $this->setimg($imagesrcupload, $this->public_path, $imagesrcuploadFe,'A');

        //模組介紹
        $gcdivtitle    = $request->gcdivtitle;
        $gcsrc         = $request->gcsrc;
        $gcsrcfe       = $request->gcsrcfe;
        $gcdivcontents = $request->gcdivcontents;
        $modelpicaddress = [];

        for($i=0; $i<count($gcsrcfe); $i++){
            $tmp = $this->setimg($gcsrc[$i], $this->public_path, $gcsrcfe[$i], $i);
            array_push($modelpicaddress,
                array(
                    'title' => $gcdivtitle[$i], 'picaddress' => $tmp, 'contents' => $gcdivcontents[$i]
                )
            );
        };

        dd( $modelpicaddress );
        dd( $request->all() );
        //storage_path(). '/' . $imageName, base64_decode($image)
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

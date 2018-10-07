<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;

use App\Slide;

use App\HotProduct;
use App\Product;

use App\HotArticle;
use App\Article;

class OnlineController extends Controller
{
    public function index(){

        //slides
        $slides = Slide::orderBy('queue','asc')->get();
        $slidesArray = [];
        foreach ($slides as $slideslist){
            $getbase64 = imageload::upimgpath('images/slide/'. $slideslist->src);
            array_push($slidesArray,
                array(
                    'id' => $slideslist->_id,
                    'queue' => $slideslist->queue,
                    'src' => $getbase64,
                    'fe' => $slideslist->fe,
                )
            );
        };

        //hotproduct
        $Product = Product::get(['_id','title']);
        $ToRadioProducts = [];
        foreach ($Product as $Productlist){
            $hotarticle = HotProduct::where('productid', $Productlist->_id)->get();
            $hotarticlelen = count($hotarticle);

            if(!$hotarticlelen){
                array_push($ToRadioProducts,
                    array(
                        '_id' => $Productlist->_id,
                        'title' => $Productlist->title
                    )
                );
            };
        };

        $hotproduct = HotProduct::all();
        $ToShowProDucts = [];
        foreach ($hotproduct as $hotproductlist){
            $products = Product::findOrFail($hotproductlist->productid);
            array_push($ToShowProDucts,
                array(
                    'hotpd_id' => $hotproductlist->_id,
                    'title' => $products->title,
                    'src' => $products->src
                )
            );
        };

        //hotarticle
        $Article = Article::get(['_id','title']);
        $ToRadioArticles = [];
        foreach ($Article as $Articlelist){
            $hotarticle = HotArticle::where('articleid', $Articlelist->_id)->get();
            $hotarticlelen = count($hotarticle);

            if(!$hotarticlelen){
                array_push($ToRadioArticles,
                    array(
                        '_id' => $Articlelist->_id,
                        'title' => $Articlelist->title
                    )
                );
            };
        };

        $hotarticle = HotArticle::all();
        $ToShowarticles = [];
        foreach ($hotarticle as $hotproductlist){
            $articles = Article::findOrFail($hotproductlist->articleid);
            array_push($ToShowarticles,
                array(
                    'hotart_id' => $hotproductlist->_id,
                    'title' => $articles->title,
                    'src' => $articles->picloadjson['img']
                )
            );
        };

        return view('Online.index',
            compact(
                'slidesArray',
                'ToRadioProducts','ToShowProDucts',
                'ToRadioArticles','ToShowarticles'
            )
        );

    }

    public function slide(Request $request, $id){
        $_slidesrc = $request->slidesrc;
        $_slidefe  = $request->slidefe;

        $updateslide = Slide::findOrFail($id);

        imageload::rmpic('slide', $updateslide->src);

        $imageload = new imageload($_slidesrc, $_slidefe, 'slide', '');
        $imageload->webimg();

        $updateslide->src = $imageload->geturl();
        $updateslide->fe = $_slidefe;
        $updateslide->update();

        return redirect()->back();
    }

    public function hotproduct(Request $request, $id){
        $_pdradioid = $request->pdradioid;

        $hotproduct = HotProduct::findOrFail($id);
        $hotproduct->productid = $_pdradioid;
        $hotproduct->update();

        return redirect()->back();
    }

    public function hotarticle(Request $request, $id){
        $_articleradioid = $request->articleradioid;

        $hotarticle = HotArticle::findOrFail($id);
        $hotarticle->articleid = $_articleradioid;
        $hotarticle->update();

        return redirect()->back();
    }

}

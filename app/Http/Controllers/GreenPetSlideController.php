<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GreenPetSlide;
use App\imageload;

class GreenPetSlideController extends Controller
{

    public function index(){
        $slides = GreenPetSlide::orderBy('queue','asc')->get();
        $slidesArray = [];
        foreach ($slides as $slideslist){
            $getbase64 = imageload::upimgpath('images/GreenPetSlide/'. $slideslist->src);
            array_push($slidesArray,
                array(
                    'id' => $slideslist->_id,
                    'queue' => $slideslist->queue,
                    'src' => $getbase64,
                    'fe' => $slideslist->fe,
                    'link' => $slideslist->link
                )
            );
        };
        return view('GreenPet.Slide.index',compact('slidesArray'));
    }

    public function store(Request $request,$id){


        $_slidesrc = $request->slidesrc;
        $_slidefe  = $request->slidefe;
        $_slidelink = $request->slidelink;

        $updateslide = GreenPetSlide::findOrFail($id);
        imageload::rmpic('GreenPetSlide', $updateslide->src);

        $imageload = new imageload($_slidesrc, $_slidefe, 'GreenPetSlide', '');
        $imageload->webimg();

        $updateslide->src = $imageload->geturl();
        $updateslide->fe = $_slidefe;
        $updateslide->link = $_slidelink;
        $updateslide->update();

        return redirect()->back();
    }

}

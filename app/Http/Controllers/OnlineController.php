<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;

class OnlineController extends Controller
{
    public function index(){
        return view('Online.index');
    }

    public function slide(Request $request, $id){
        $_slidesrc = $request->slidesrc;
        $_slidefe  = $request->slidefe;

        $imageload = new imageload($_slidesrc, $_slidefe, 'slide', '');
        $imageload->webimg();

        $tmp = [
            'src' => $imageload->geturl(),
            'fe' => $_slidefe
        ];
        dd($tmp);
    }

    public function hotproduct(Request $request, $id){
        $_pdradioid = $request->pdradioid;
        $tmp = [
            0 => $id,
            1 => $_pdradioid
        ];
        dd($tmp);
    }

    public function hotarticle(Request $request, $id){
        $_articleradioid = $request->articleradioid;
        $tmp = [
            0 => $id,
            1 => $_articleradioid
        ];
        dd($tmp);
    }

}

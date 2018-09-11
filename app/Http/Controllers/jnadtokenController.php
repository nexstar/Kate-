<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;

class jnadtokenController extends Controller
{

    private $success = [
        'status' => '1|ok',
        'url' => '',
    ];

    private $fail = [
        'status' => '0',
    ];

    public function upload(Request $request){
        $_userid = $request->userid;
        $_type   = $request->type;
        $_base64 = $request->base64;

        $resp_status = $this->fail;
        if(strlen($_base64) > 10){
            $imageload = new imageload($_base64,'png',$_type,'');
            $imageload->Community();
            $this->success['url'] = $imageload->geturl();
            $resp_status = $this->success;
        };

        return response()->json(
            [
                'jnad' => $resp_status
            ]
        );
    }

}

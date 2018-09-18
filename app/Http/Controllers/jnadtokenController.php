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

        $_ajaxuser = $request->_ajaxuser;
        $_ajaxjustbase64 = $request->_ajaxjustbase64;

        $resp_status = $this->fail;
        if(strlen($_ajaxjustbase64) > 10){
            $imageload = new imageload($_ajaxjustbase64,'png', $_ajaxuser,'');
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class imageload extends Model
{
    private $public_path;
    private $url;
    private $base64decode;
    private $fe;
    private $count;
    private $type;

    public function __construct($base64, $fe, $type, $count)
    {
        $this->public_path = public_path('/images/');
        $Cutnumber = strpos($base64,',');
        $pic = (mb_substr($base64,( $Cutnumber + 1 ), strlen($base64),"utf-8"));
        $this->base64decode = base64_decode($pic);

        $this->type = $type;
        $this->fe = '.'.$fe;
        $this->count = $count;
    }

    public function geturl(){
        return $this->url;
    }

    private function savepublicimage($path, $base64decode){
        file_put_contents($path, $base64decode);
    }

    public function webimg(){
        $this->url = $this->type.'_'.time().'_'.$this->count.$this->fe;
        $this->savepublicimage(
            $this->public_path.$this->type.'/'.$this->geturl(),
            $this->base64decode
        );
    }

    public function Community(){
        $this->url = $this->type.'_'.time().'_'.$this->fe;
        $this->savepublicimage(
            $this->public_path.'/greenpet/'.$this->geturl(),
            $this->base64decode
        );
    }

    public static function upimgpath($path){
        $data = file_get_contents($path);
        $base64 = 'data:image/png;base64,'.base64_encode($data);
        return $base64;
    }

    //刪除封面
    public static function rmpic($dirname,$rmpic){
        $rmdatapath = public_path('/images/'.$dirname.'/');
        unlink($rmdatapath.$rmpic);
    }

    //刪除模組照片
    public static function modelrmpic($dirname,$rmarray,$arraypicname){
        $rmdatapath = public_path('/images/'.$dirname.'/');

        for($i=0;$i<count($rmarray);$i++){
            unlink($rmdatapath.$rmarray[$i][$arraypicname]);
        };
    }

}

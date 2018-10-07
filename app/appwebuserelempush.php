<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\appwebuser;


class appwebuserelempush extends Model
{
    private $title;
    private $bbsid;
    private $userids;
    private $url = "http://203.73.132.169:9484/notifi?";

    public function __construct($bbsid, array $userids, $title){
        $this->title = $title;
        $this->bbsid = $bbsid;
        $this->userids = $userids;
    }

    public function greenpet_notifi(){
        $foreach_resource = $this->userids;
        $Tokens = [];
        foreach ($foreach_resource as $reslut){
            appwebuser::where('_id', $reslut)->push('greenpetapp.notifi', [
                'id' => $this->bbsid,
                'status' => 0
            ]);

            $getphonetoken = appwebuser::findOrFail($reslut);
            array_push($Tokens, $getphonetoken->info['phone']['token']);
        };
        $this->greenpet_notifi_send($Tokens);
    }

    private function greenpet_notifi_send($getAlltokens){
        if(!(count($getAlltokens)<=0)){
            foreach ($getAlltokens as $tokenlist){
                if($tokenlist != ""){
                    $greenpet_notifi  = $this->url;
                    $greenpet_notifi .= "title=".urlencode("凱特新通知").'&';
                    $greenpet_notifi .= "body=".urlencode($this->title).'&';
                    $greenpet_notifi .= "token=".$tokenlist.'&';
                    $greenpet_notifi .= "path=/notification";
                    $this->shoot($greenpet_notifi);
                };
            };
        };
    }

    private function shoot($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }

}

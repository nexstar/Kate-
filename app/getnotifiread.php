<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\appwebuser;

class getnotifiread extends Model
{

    private $read;
    private $total;
    private $depthuser;

    public function __construct($sid)
    {
        $usersreadsum = appwebuser::where('greenpetapp.notifi.id','=',$sid)->get();

        $TmpRead = 0;
        $tmpdepthuser = [];

        foreach ($usersreadsum as $resultOne){
            $tmpNotifi = $resultOne->greenpetapp['notifi'];
            for ($i=0;$i<count($tmpNotifi);$i++){
                if( ($tmpNotifi[$i]['id'] == $sid) &&
                    ($tmpNotifi[$i]['status']) ){
                    $TmpRead++;
                    array_push($tmpdepthuser,
                        array(
                            'id' => $resultOne->_id,
                            'phonetoken' => $resultOne->info['phone']['token'],
                            'name' => $resultOne->info['name'],
                        ));
                    break;
                };
            };
        };

        $this->depthuser = [
            'fatersid' => $sid,
            'name' => 'depthSingle',
            'depth' => $tmpdepthuser
        ];

        $this->read = $TmpRead;
        $this->total = count($usersreadsum);
    }

    public function depthuser(){
        return $this->depthuser;
    }

    public function read(){
        return $this->read;
    }

    public function total(){
        return $this->total;
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerInfo;
use App\CustomerGroup;
use App\User;
use App\Jobs\Sms;
use App\Jobs\ToMyselfEmail;

class SmsController extends Controller
{
	protected $SmsCount = 0;
	protected $users = '';

	public function __construct(){
		$this->users = User::findOrFail("5b7153ec7c82e85d1036e8a1");
		$url = "https://oms.every8d.com/API21/HTTP/getCredit.ashx?UID=".$this->users->smsname."&PWD=".$this->users->smspwd;
		$this->SmsCount = file_get_contents($url);
	}

	public function Send(Request $request){

		$contents = urlencode($request->contents);
		$phones = $request->Hubcheck;
		$names  = $request->Hubname;

		$url1  = "https://oms.every8d.com/API21/HTTP/sendSMS.ashx?";
		$url1 .= "UID=".$this->users->smsname.'&';
		$url1 .= "PWD=".$this->users->smspwd.'&';
		$url1 .= "MSG=".$contents.'&';

		foreach ($phones as $phone) {
			$url2 = $url1."DEST=".$phone;
			Sms::dispatch($url2)->onQueue('high');
		};

		ToMyselfEmail::dispatch($phones, $names, $request->contents)->onQueue('high');

		return redirect('/customerinfo');

	}

	public function Single(Request $request){
		$data = $request->ch_data;

		$checkArray = [];
		foreach ($data as $key) {
			$customerinfo = CustomerInfo::findOrFail($key);
			array_push( $checkArray,
				array(
					'name' => ( $customerinfo->firstname.$customerinfo->lastname ),
					'phone' => $customerinfo->privatemobile
				)
			);
		};

		$smscount = $this->SmsCount;
		return view('Customer.send',compact('checkArray','smscount'));
	}

	public function Group($id){
		$checkArray = [];

		$customergroup = CustomerGroup::findOrFail($id)->addcheckboxgroup;

		foreach($customergroup as $list){
			$customerinfo = CustomerInfo::findOrFail($list);
			array_push( $checkArray,
				array(
					'name' => ( $customerinfo->firstname.$customerinfo->lastname ),
					'phone' => $customerinfo->privatemobile
				)
			);
		}

		$smscount = $this->SmsCount;
		return view('Customer.send',compact('checkArray','smscount'));
	}

}

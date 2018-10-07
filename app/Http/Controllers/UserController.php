<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;

class UserController extends Controller
{

	protected $validator;

    public function edit()
    {
		$users = User::find(env('MONGO_DB_ROOT'));
		return view('Customer.headinfo', compact('users'));
    }

    public function update(Request $request)
    {
		$users = User::find(env('MONGO_DB_ROOT'));
        switch ($request->type) {
			case '1':
				$msg = [
					'name.required' => '不能為空',
					'password.required' => '不能為空',
				];

				$this->validator = Validator::make($request->all(), [
					'name' => 'required|',
					'password' => 'required|',
				],$msg);

				if ($this->validator->fails()) {
					return redirect('/headinfo')->withErrors($this->validator)->withInput();
				}

				$users->name = $request->name;
				$users->password = bcrypt($request->password);
				$users->save();

				Auth::logout();
				return redirect('/');
			break;
			case '2':
				$msg = [
					'smsid.required' => '不能為空',
					'smspwd.required' => '不能為空',
				];

				$this->validator = Validator::make($request->all(), [
					'smsid' => 'required|',
					'smspwd' => 'required|',
				],$msg);

				if ($this->validator->fails()) {
					return redirect('/headinfo')->withErrors($this->validator)->withInput();
				}

				$users->smsname = $request->smsid;
				$users->smspwd = $request->smspwd;
				$users->save();

				return redirect('/headinfo');
			break;
		}
    }

	public function login(Request $request){
		$this->validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'required',
        ]);

		if ($this->validator->fails()) {
            return redirect('/')->withErrors($this->validator)->withInput();
        }

        if ( Auth::attempt( $request->only('name','password') )) {
            return redirect()->route('customerinfo.index');
        }else{
			return redirect('/');
		}

	}

    public function TestInsertUser(){
        $users = new User;
        $users->name = "kate";
        $users->password = bcrypt('123');
        $users->smsname  = "0972153032";
        $users->smspwd   = "5a33";
        $users->ecpayname = "";
        $users->ecpaypwd  = "";
        $users->save();
		return "insert ok";
    }

}

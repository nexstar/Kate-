<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\CustomerGroup;
use App\CustomerInfo;

class CustomerGroupController extends Controller
{
    protected $validator;

    public function index()
    {
        $customergroup = CustomerGroup::orderBy('created_at', 'desc')->get();
        return view('Customer.GroupSms.index', compact('customergroup'));
    }

    public function create()
    {
		$customerinfo = CustomerInfo::all();
        return view('Customer.GroupSms.create', compact('customerinfo'));
    }

    public function store(Request $request)
    {
		CustomerGroup::create( $request->all() );
		return redirect('/customergroup');

    }

    public function edit($id)
    {
		$customerinfo  = CustomerInfo::all();
		$customergroup = CustomerGroup::findOrFail($id);

		$reinfo = [];

		foreach($customerinfo as $customerinfolist){
			array_push( $reinfo, array(
					'id' => $customerinfolist->id,
					'name'=> ($customerinfolist->firstname.$customerinfolist->lastname),
					'phone' => $customerinfolist->privatemobile,
					'check' => 0
				)
			);
		}

		for($i=0; $i<count($reinfo); $i++){
			for($j=0; $j<count($customergroup['addcheckboxgroup']); $j++){
				if( $reinfo[$i]['id'] == $customergroup['addcheckboxgroup'][$j] ){
					$reinfo[$i]['check'] = 1;
				}
			}
		}

		return view('Customer.GroupSms.edit', compact('reinfo', 'customergroup'));

    }

    public function update(Request $request, $id)
    {

		$customergroup = CustomerGroup::findOrFail($id);
		$customergroup->update( $request->all() );
		return redirect('/customergroup');

    }

    public function destroy($id)
    {

		CustomerGroup::findOrFail($id)->delete();
		return redirect()->back();

    }

}

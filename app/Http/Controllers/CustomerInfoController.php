<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\CustomerInfo;
use Excel;

class CustomerInfoController extends Controller
{

	protected $validator;

	public function ExcelExport(){
		$ExcelArray = [
			'會員代號','私人-行動電話','姓氏','名字','英文名稱','暱稱','生日','性別','年齡',
			'住家-國家/地區','住家-室內電話','住家-地址','私人-電子郵件','公司名',
			'部門','職稱','公司-統一編號','公司-室內電話','公司-地址','公司-電子郵件','公司-網址','公司-傳真號碼','公司-電話','公司-行動電話','備註','註冊日'];

		$TmpReSult = [];
		$customerinfos = CustomerInfo::all();

		array_push($TmpReSult, $ExcelArray);
		foreach ($customerinfos as $customerinfo) {
			array_push(
				$TmpReSult, array(
					$customerinfo->id,
					$customerinfo->privatemobile,
					$customerinfo->firstname,
					$customerinfo->lastname,
					$customerinfo->engname,
					$customerinfo->nickname,
					$customerinfo->birthday,
					(($customerinfo->sex == '0')?"女性":"男性"),
					$customerinfo->age,
					$customerinfo->countryregion,
					$customerinfo->homeindoorphone,
					$customerinfo->homeaddress,
					$customerinfo->privatemail,
					$customerinfo->companyname,
					$customerinfo->companybranch,
					$customerinfo->companytitle,
					$customerinfo->companyvat,
					$customerinfo->companyindoorphone,
					$customerinfo->companyaddress,
					$customerinfo->companymail,
					$customerinfo->companyweb,
					$customerinfo->companyfax,
					$customerinfo->companytelephone,
					$customerinfo->companymobile,
					$customerinfo->remark,
					$customerinfo->created_at
				)
			);
		};

		date_default_timezone_set("Asia/Taipei");
		$ExportDate = "客戶個資資料".Date('Y-m-d H:i:s');

        Excel::create($ExportDate, function($excel) use ($TmpReSult){
            $excel->sheet('個資', function($sheet) use ($TmpReSult){
                $sheet->rows($TmpReSult);
            });
        })->export('xls');

    }

    public function index()
    {
		$customerinfo = CustomerInfo::orderBy('created_at', 'desc')->get();
		return view('Customer.index', compact('customerinfo'));
    }

    public function create()
    {
		return view('Customer.create');
    }

    public function store(Request $request)
    {
		$msg = [
			'privatemobile.required' => '手機必填',
			'privatemobile.max' => '手機最多10位',
			'privatemobile.min' => '手機最少10位',
		];

		$this->validator = Validator::make($request->all(), [
			'privatemobile' => 'required|max:10|min:10'
		],$msg);

		if ($this->validator->fails()) {
			return redirect('/customerinfo/create')->withErrors($this->validator)->withInput();
		}

		CustomerInfo::create( $request->all() );
		return redirect('/customerinfo');
    }

    public function edit($id)
    {
		$customerinfo = CustomerInfo::findOrFail($id);
        return view('Customer.edit', compact('customerinfo'));
    }

    public function update(Request $request, $id)
    {
       $msg = [
			'privatemobile.required' => '手機必填',
			'privatemobile.max' => '手機最多10位',
			'privatemobile.min' => '手機最少10位',
		];

		$this->validator = Validator::make($request->all(), [
			'privatemobile' => 'required|max:10|min:10'
		],$msg);

		if ($this->validator->fails()) {
			return redirect()->route('customerinfo.edit', $id)->withErrors($this->validator)->withInput();
		}
		$customerinfo = CustomerInfo::findOrFail($id);
		$customerinfo->update($request->all());
		return redirect('/customerinfo');

    }

    public function destroy($id)
    {
		CustomerInfo::findOrFail($id)->delete();
		return redirect()->back();
    }
}

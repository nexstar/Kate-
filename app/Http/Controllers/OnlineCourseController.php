<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;
use App\Course;

class OnlineCourseController extends Controller
{
    public function show($id){}

    public function destroy($id)
    {
        $courses = Course::findOrFail($id);

        $_rmimg = $courses->imgjson['img'];
        $_rmmodelimg = $courses->modelarray;

        imageload::rmpic('course', $_rmimg);
        imageload::modelrmpic('course', $_rmmodelimg,'src');

        $courses->delete();
        return redirect()->back();
    }

    public function onoff($id,$uplow){
        $courses = Course::findOrFail($id);
        $courses->onffonline = $uplow;
        $courses->update();
        return redirect()->back();
    }

    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->get();
        return view('Online.Course.index',compact('courses'));
    }

    public function create()
    {
        return view('Online.Course.create');
    }

    public function store(Request $request)
    {
        $this->create_update($request, "","");
        return redirect('onlinecourse');
    }

    public function edit($id)
    {
        $courses = Course::findOrFail($id);

        $TestData = [
            "_id" => $courses->_id,
            "title" => $courses->title,
            "money" => $courses->money,
            "contents" => $courses->contents,
            "src" => $courses->imgjson['img'],
            "fe" => $courses->imgjson['fe'],
            "Timeslot" => [],
            "modelarray" => []
        ];

        $getbase64 = imageload::upimgpath('images/course/'. $TestData['src']);
        $TestData['src'] = $getbase64;
        session(['rmimg' => $courses->imgjson['img'] ]);

        //時段
        $TmpTimeslot = [];
        $Tmp_for_Timeslot = $courses->Timeslot;
        for ($i=0;$i<count($Tmp_for_Timeslot);$i++){
            array_push($TmpTimeslot, array(
                "year" => ( (int) $Tmp_for_Timeslot[$i]['year'] ),
                "month" => ( (int) $Tmp_for_Timeslot[$i]['month'] ),
                "day" => ( (int) $Tmp_for_Timeslot[$i]['day'] ),
                "hour" => ( (int) $Tmp_for_Timeslot[$i]['hour'] )
            ));
        };

        $TestData['Timeslot'] = $TmpTimeslot;

        //模組
        $Tmpmodelarray = [];
        $Tmp_for_modelarray = $courses->modelarray;
        session(['rmmodelimg' => $courses->modelarray ]);

        for ($i=0;$i<count($Tmp_for_modelarray);$i++){
            $getbase64 = imageload::upimgpath('images/course/'. $Tmp_for_modelarray[$i]['src']);
            array_push($Tmpmodelarray,array(
                "title" => $Tmp_for_modelarray[$i]['title'],
                "src" => $getbase64,
                "fe" => $Tmp_for_modelarray[$i]['fe'],
                "contents" => $Tmp_for_modelarray[$i]['contents']
            ));
        };

        $TestData['modelarray'] = $Tmpmodelarray;
        return view('Online.Course.edit', compact('TestData'));
    }

    public function update(Request $request, $id)
    {
        imageload::rmpic('course', session('rmimg'));
        imageload::modelrmpic('course', session('rmmodelimg'),'src');
        $this->create_update($request, "edit_",$id);
        return redirect('onlinecourse');
    }

    private function create_update(Request $request, $type, $id){
        $_title = $request->title;
        $_money = $request->money;
        $_imagesrcupload   = $request->imagesrcupload;
        $_imagesrcuploadFe = $request->imagesrcuploadFe;
        $_contents = $request->contents;

        $imageload_tp = new imageload( $_imagesrcupload, $_imagesrcuploadFe,'course',($type.'titlepage'));
        $imageload_tp->webimg();

        // Time slot
        $Timeslot = [];
        $_year  = date('Y');
        $_month = $request->month;
        $_day   = $request->day;
        $_hour  = $request->hour;
        for ($i=0; $i<count($_month); $i++){
            array_push($Timeslot,
                array(
                    'year' => ( (int) $_year ),
                    'month' => ( (int) $_month[$i] ),
                    'day' => ( (int) $_day[$i] ),
                    'hour' => ( (int) $_hour[$i] )
                )
            );
        };

        // model
        $_gcdivtitle = $request->gcdivtitle;
        $_gcsrc   = $request->gcsrc;
        $_gcsrcfe = $request->gcsrcfe;
        $_gcdivcontents = $request->gcdivcontents;
        $modelarray = [];
        for ($i=0; $i<count($_gcsrcfe); $i++){
            $imageload_model = new imageload( $_gcsrc[$i], $_gcsrcfe[$i],'course', ($type.$i));
            $imageload_model->webimg();
            array_push($modelarray,
                array(
                    'title' => $_gcdivtitle[$i],
                    'src' => $imageload_model->geturl(),
                    'fe' => $_gcsrcfe[$i],
                    'contents' => $_gcdivcontents[$i],
                )
            );
        };

        if($type === ""){
            $courses = new Course();
            $courses->title = $_title;
            $courses->money = $_money;
            $courses->contents = $_contents;
            $courses->imgjson = [
                'img' => $imageload_tp->geturl(),
                'fe' => $_imagesrcuploadFe
            ];
            $courses->point = [];
            $courses->onffonline = 0;
            $courses->Timeslot = $Timeslot;
            $courses->modelarray = $modelarray;
            $courses->save();
        }else{
            $update_courses = Course::findOrFail($id);
            $update_courses->title = $_title;
            $update_courses->money = $_money;
            $update_courses->contents = $_contents;
            $update_courses->imgjson = [
                'img' => $imageload_tp->geturl(),
                'fe' => $_imagesrcuploadFe
            ];
            $update_courses->onffonline = 0;
            $update_courses->Timeslot = $Timeslot;
            $update_courses->modelarray = $modelarray;
            $update_courses->update();
        };
    }
}

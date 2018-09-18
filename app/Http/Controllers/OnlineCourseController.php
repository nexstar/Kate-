<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\imageload;

class OnlineCourseController extends Controller
{
    public function show($id)
    {

    }

    public function destroy($id)
    {

    }

    public function index()
    {
        return view('Online.Course.index');
    }

    public function create()
    {
        return view('Online.Course.create');
    }

    public function store(Request $request)
    {
        $this->create_update($request, "");
        return redirect()->back();
    }

    public function edit($id)
    {
        $TestData = [
            "title" => "課程標題",
            "money" => "444",
            "contents" => "GHJJGKHGHJKGFGHJKGFGHJKFGHJK",
            "src" => "course_1537007975_titlepage.jpg",
            "fe" => "jpg",
            "point" => 0,
            "Timeslot" => array(
                0 => array(
                "month" => "1月",
                "day" => "13號",
                "hour" => "18:00",
                )
            ),
            "modelarray" => array(
                0 => array(
                    "title" => "AAAAAA",
                    "src" => "course_1537007975_0.jpg",
                    "fe" => "jpg",
                    "contents" => "VVVVVVV",
                )
            )
        ];

        $getbase64 = imageload::upimgpath('images/course/'. $TestData['src']);
        $TestData['src'] = $getbase64;

        for ($i=0; $i<count($TestData['modelarray']); $i++){
            $getbase64 = imageload::upimgpath('images/course/'. $TestData['modelarray'][$i]['src']);
            $TestData['modelarray'][$i]['src'] = $getbase64;
        };

        return view('Online.Course.edit', compact('TestData'));
    }

    public function update(Request $request, $id)
    {
        $this->create_update($request, "edit_");
        return redirect()->back();
    }



    private function create_update(Request $request, $type){
        $_title = $request->title;
        $_money = $request->money;
        $_imagesrcupload   = $request->imagesrcupload;
        $_imagesrcuploadFe = $request->imagesrcuploadFe;
        $_contents = $request->contents;

        $imageload_tp = new imageload( $_imagesrcupload, $_imagesrcuploadFe,'course',($type.'titlepage'));
        $imageload_tp->webimg();

        // Time slot
        $Timeslot = [];
        $_month = $request->month;
        $_day   = $request->day;
        $_hour  = $request->hour;
        for ($i=0; $i<count($_month); $i++){
            array_push($Timeslot,
                array(
                    'month' => $_month[$i],
                    'day' => $_day[$i],
                    'hour' => $_hour[$i]
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

        $datasavetodb = [
            'title' => $_title,
            'money' => $_money,
            'contents' => $_contents,
            'src' => $imageload_tp->geturl(),
            'fe' => $_imagesrcuploadFe,
            "point" => 0,
            'Timeslot' => $Timeslot,
            'modelarray' => $modelarray
        ];

        dd( $datasavetodb );
    }
}

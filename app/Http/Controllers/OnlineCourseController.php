<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineCourseController extends Controller
{

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
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('Online.Course.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

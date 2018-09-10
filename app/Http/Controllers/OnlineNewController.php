<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineNewController extends Controller
{

    public function index()
    {
        return view('Online.New.index');
    }

    public function create()
    {
        return view('Online.New.create');
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
        return view('Online.New.edit');
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
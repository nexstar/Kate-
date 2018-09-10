<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineProductController extends Controller
{

    public function index()
    {
        return view('Online.Product.index');
    }

    public function info($info){
        return view('Online.Product.indexinfo');
    }

    public function create()
    {
        return view('Online.Product.create');
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
        return view('Online.Product.edit');
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
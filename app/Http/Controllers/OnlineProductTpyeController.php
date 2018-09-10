<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineProductTpyeController extends Controller
{

    public function index()
    {
        return view('Online.Product.Type.index');
    }

    public function create()
    {
        return view('Online.Product.Type.create');
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
        return view('Online.Product.Type.edit');
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
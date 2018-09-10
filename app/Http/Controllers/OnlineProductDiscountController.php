<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineProductDiscountController extends Controller
{

    public function index()
    {
        return view('Online.Product.Discount.index');
    }

    public function create()
    {
        return view('Online.Product.Discount.create');
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
        return view('Online.Product.Discount.edit');
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

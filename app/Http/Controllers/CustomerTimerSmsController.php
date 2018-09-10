<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerTimerSmsController extends Controller
{
    public function index()
    {
        return view('Customer.TimerSms.index');
    }

    public function create()
    {
        return view('Customer.TimerSms.create');
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
        return view('Customer.TimerSms.edit');
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

@extends('Layouts.background')
@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 10%;">
        <div class="row">

            {{--@include('Repeat.Customer.backgroundmenu')--}}
            <div style="text-align: center;margin-bottom: 40px;">
                <h4 style="font-size: 3rem;color: #006737;">Error 404 Page</h4>
            </div>

            <div style="text-align: center;margin-bottom: 40px;">
                <h1 style="color:rgba(30,30,30,0.6);font-size: 150px;line-height: 150px;">404<i class="fas fa-file"></i></h1>
            </div>

            <div style="text-align: center;margin-bottom: 40px;">
                <h1 style="color:rgba(30,30,30,0.6);">Oops, This page could not be found!</h1>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
    @include('Layouts.errors')
@endsection

@extends('Layouts.background')

@section('contents')

    <div id="main" class="container-fluid">
        <div class="row" style="margin-top: 12%">
            <div class="col-md-12" style="text-align: center;">
                <h3 style="opacity:0.9;color: white;letter-spacing:15.0px;line-height:50.0px;">凱特夫人 Flower Shop <br/> 管理端</h3>
            </div>
            <div class="col-md-4 col-md-offset-4">
                {!! Form::open(['method' => 'POST','action' => ['UserController@login'], 'files' => true]) !!}
                    <div class="form-group">
                        {!! Form::text('name', null, ['class'=>'form-control', 'style' => 'height: 40px', 'placeholder'=>'帳號']) !!}
                    </div>
                    <br />
                    <div class="form-group">
                        {!! Form::password('password', ['class'=>'form-control', 'style' => 'height: 40px', 'placeholder'=>'密碼']) !!}
                    </div>
                    <br />
                    {!! Form::submit('登入', ['class' => 'btn btn-primary', 'style' => 'float: right;height: 40px']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <style type="text/css">
        #main {
            background-image: url( {{ url('images/indexbkpic.jpg') }} );
            background-repeat: no-repeat;
            background-size: 100% 100%;
            height: 100vh;
        }
    </style>
@endsection


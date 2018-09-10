@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">
            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">

                <div class="row" style="padding-top: 20px;">
                    <div class="col-md-4 col-md-offset-4" style="text-align: center;">
                        <p style="font-size: 30px;">電商-新聞設定</p>
                    </div>
                </div>

                <div class="row" style="margin:20px 0px;">
                    <p>工具說明</p>
                    <p>店面曝光的新聞</p>
                </div>

                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12" style="text-align: right;">
                        <a href="{{ url('onlinenew/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">新增新聞</a>
                    </div>
                </div>

                <div class="row">
                    @for($i=0; $i<6; $i++)
                        <div class="col-md-4" style="text-align: center;">
                            <div class="thumbnail">
                                <p style="font-size: 20px;">2018/12/32</p>
                                <span>{{ $i+1 }}.新聞</span>
                                <img style="margin: 5px 0px;width: 100%;" src="http://placehold.it/1170x613" alt="#">
                                <a href="{{ route('onlinenew.edit', $i) }}" class="btn btn-block btn-warning">修改</a>
                            </div>
                        </div>
                    @endfor
                </div>

            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $("#main_left").css({ "height" : ($( document ).height()) });
    </script>

    <style type="text/css">

    </style>
@endsection


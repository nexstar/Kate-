@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">
            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">

                <div class="row" style="padding-top: 20px;">
                    <div class="col-md-4 col-md-offset-4" style="text-align: center;">
                        <p style="font-size: 30px;">電商-朋友們的肯定設定</p>
                    </div>
                </div>

                <div class="row" style="margin:20px 0px;">
                    <p>工具說明</p>
                    <p>來自朋友對於本店的支持與喜愛</p>
                </div>

                <div class="row">
                    @for($i=0; $i<9; $i++)
                        <div class="col-md-4" style="text-align: center;">
                            <div class="thumbnail">
                                <span>{{ $i+1 }}.朋友們的肯定</span>
                                <img style="margin: 5px 0px;width: 100%;" src="http://placehold.it/1170x613" alt="#">
                                <button class="btn btn-block btn-warning">修改</button>
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


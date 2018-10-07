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

                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12" style="text-align: right;">
                        <a href="{{ url('onlinenew/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">新增新聞</a>
                    </div>
                </div>

                <div class="row">
                    @foreach($news as $newskey => $newsval)
                        <div class="col-md-4" style="text-align: center;">
                            <div class="thumbnail">
                                <p style="font-size: 20px;">{{ $newsval->title}}</p>
                                <span>{{ $newsval->date }}</span>
                                <img style="margin: 5px 0px;width: 100%;" src="{{ 'http://docker.bmskflorist:4848/images/new/'.$newsval->left['url'] }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('onlinenew.edit', $newsval->_id) }}" class="btn btn-block btn-warning">修改</a>
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::open([
                                            'id' => ('rmnews'.$newsval->_id), 'method' => 'DELETE',
                                            'action' => ['OnlineNewController@destroy',$newsval->_id]
                                            ])
                                        !!}
                                        {!! Form::close() !!}
                                        <button onclick="btnrmnews('{{ $newsval->_id }}')" type="button" class="btn btn-block btn-danger">刪除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $("#main_left").css({ "height" : ($( document ).height()) });
        function btnrmnews($id) {
            if(confirm("確定刪除???")){
                $("#rmnews"+$id).submit();
            };
        };
    </script>

    <style type="text/css">

    </style>
@endsection


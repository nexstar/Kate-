@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">
            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">
                <div class="col-md-12">

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-4 col-md-offset-4" style="text-align: center;">
                            <p style="font-size: 30px;">綠寵物-Blog</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <a href="{{ url('greenpetblog/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">新增Blog</a>
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>照片</th>
                                    <th>標題</th>
                                    <th>內容</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @foreach($greenpetblogs as $greenpetbloglist)
                                    <tr style="cursor: default;">
                                        <td style="width:20%;">
                                            <img src="{{ url('images/GreenPetBlog/'.$greenpetbloglist->src) }}" style="width:100%;">
                                        </td>
                                        <td style="font-size: 20px;">{{ $greenpetbloglist->title }}</td>
                                        <td style="width: 40%;font-size: 20px;">
                                            <p class="text-justify">{{ $greenpetbloglist->contents  }}</p>
                                        </td>
                                        <td style="width:15%;">
                                            @if($greenpetbloglist->link !== "沒有連結")
                                                <a href="{{ $greenpetbloglist->link }}" target="_blank" style="margin-top: 5px;border-color: #50E3C2;background-color: #50E3C2;" class="btn btn-block btn-primary">連結</a>
                                            @endif
                                            @if($greenpetbloglist->notifi)
                                                <button disabled type="button" style="margin-top: 5px;" class="btn btn-block btn-primary">已發送</button>
                                            @else
                                                {!! Form::open([
                                                    'id' => ('sendgreenpetblog'.$greenpetbloglist->_id), 'method' => 'GET',
                                                    'action' => ['GreenPetBlogController@sendNotifi',$greenpetbloglist->_id]])
                                                !!}
                                                {!! Form::close() !!}
                                                <button onclick="btngreenpetblogsendnotifi('{{ $greenpetbloglist->_id }}')" type="button" style="margin-top: 5px;" class="btn btn-block btn-primary">發送</button>
                                            @endif
                                            {!! Form::open([
                                                'id' => ('rmgreenpetblog'.$greenpetbloglist->_id), 'method' => 'DELETE',
                                                'action' => ['GreenPetBlogController@destroy',$greenpetbloglist->_id]])
                                            !!}
                                            {!! Form::close() !!}
                                            <button onclick="btnrmgreenpetblog('{{$greenpetbloglist->_id}}')" style="margin-top: 5px;" class="btn btn-block btn-danger">刪除</button>
                                            <a href="{{ route('greenpetblog.edit', $greenpetbloglist->_id) }}" class="btn btn-block btn-warning">修改</a>
                                        </td>
                                    </tr
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        var _main_table = $( window ).height() - 180;
        $("#main_table").css({"height":_main_table, "overflow-y": "scroll"});

        function btngreenpetblogsendnotifi($id) {
            if(confirm("確定進行綠寵物Blog訊息推送？？")){
                $("#sendgreenpetblog"+$id).submit();
            };
        };

        function btnrmgreenpetblog($id) {
            if(confirm("確定刪除此綠寵物Blog")){
                $("#rmgreenpetblog"+$id).submit();
            };
        };

    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection


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
                            <p style="font-size: 30px;">綠寵物-(群)訊息推送</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <a href="{{ url('greenpetnotifigroup/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">增群訊</a>
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>照片</th>
                                    <th>名稱</th>
                                    <th>內容</th>
                                    <th>已讀/總量</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @for($i=0;$i<count($greenpetgroupnotifis);$i++)
                                    <tr style="cursor: default;">
                                        <td style="width:25%;">
                                            <img src="{{ url('images/GreenPetGroup/'.$greenpetgroupnotifis[$i]['src']) }}" style="width: 100%;">
                                        </td>
                                        <td style="width:25%;">{{ $greenpetgroupnotifis[$i]['title'] }}</td>
                                        <td style="width:25%;">{{ $greenpetgroupnotifis[$i]['contents'] }}</td>
                                        @if($greenpetgroupnotifis[$i]['notifi'])
                                            <td style="width:25%;">{{ $greenpetgroupnotifis[$i]['read'].'/'.$greenpetgroupnotifis[$i]['total'] }}</td>
                                        @else
                                            <td style="width:25%;">尚未發送</td>
                                        @endif
                                        <td style="width:10%;">
                                            @if($greenpetgroupnotifis[$i]['notifi'])
                                                <button disabled type="button" class="btn btn-block btn-primary">已發送</button>
                                            @else
                                                {!! Form::open([
                                                    'id' => ('sendnotifigroup'.$greenpetgroupnotifis[$i]['id']), 'method' => 'GET',
                                                    'action' => ['GreenPetNotifiGroupController@notifi',$greenpetgroupnotifis[$i]['id']]])
                                                !!}
                                                {!! Form::close() !!}
                                                <button onclick="btnsendnotifigroup('{{ $greenpetgroupnotifis[$i]['id'] }}')" type="button" class="btn btn-block btn-primary">發送</button>
                                            @endif

                                            @if($greenpetgroupnotifis[$i]['link'] != "null")
                                                <a href="{{ $greenpetgroupnotifis[$i]['link'] }}" style="border-color: #84bcd8;background-color: #84bcd8;" target="_blank" type="button" class="btn btn-block btn-primary">連結</a>
                                            @else
                                                <a href="#" disabled type="button" style="border-color: #84bcd8;background-color: #84bcd8;" class="btn btn-block btn-primary">沒連結</a>
                                            @endif

                                            <a href="{{ route('greenpetnotifigroup.info', $greenpetgroupnotifis[$i]['id']) }}" style="border-color: #9db782;background-color: #9db782;" type="button" class="btn btn-block btn-primary">資訊</a>
                                            {!! Form::open([
                                                'id' => ('rmnotifigroup'.$greenpetgroupnotifis[$i]['id']), 'method' => 'DELETE',
                                                'action' => ['GreenPetNotifiGroupController@destroy', $greenpetgroupnotifis[$i]['id']]])
                                            !!}
                                            {!! Form::close() !!}
                                            <button onclick="btnrmnotifigroup('{{ $greenpetgroupnotifis[$i]['id'] }}')" type="button" style="margin-top: 5px;" class="btn btn-block btn-danger">刪除</button>
                                            <a href="{{ route('greenpetnotifigroup.edit', $greenpetgroupnotifis[$i]['id']) }}" class="btn btn-block btn-warning">修改</a>
                                        </td>
                                    </tr>
                                @endfor
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
        var _main_table = $( window ).height() - 200;
        $("#main_table").css({"height":_main_table, "overflow-y": "scroll"});

        function btnsendnotifigroup($id){
            if(confirm("確定進行發送推送訊息")){
                $("#sendnotifigroup"+$id).submit();
            };
        };

        function btnrmnotifigroup($id){
            if(confirm("確定要刪除此群體通知")){
                $("#rmnotifigroup"+$id).submit();
            };
        };

    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection


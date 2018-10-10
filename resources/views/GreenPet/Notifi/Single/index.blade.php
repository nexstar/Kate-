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
                            <p style="font-size: 30px;">綠寵物-(單)訊息推送</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <a href="{{ url('greenpetnotifisingle/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">增單訊</a>
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
                                    <th>已讀/總量</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                    @for($i=0;$i<count($greenpetsinglenotifis);$i++)
                                    <tr style="cursor: default;">
                                        <td style="width:20%;">
                                            <img src="{{ url('images/GreenPetSingle/'.$greenpetsinglenotifis[$i]['src']) }}" style="width:100%;">
                                        </td>
                                        <td style="width:20%;">
                                            <p>{{ (( $greenpetsinglenotifis[$i]['depth'] == "")?"":"(進階)") }}</p>
                                            <p>{{ $greenpetsinglenotifis[$i]['title'] }}</p>
                                        </td>
                                        <td style="width:20%;">{{ $greenpetsinglenotifis[$i]['contents'] }}</td>
                                        @if($greenpetsinglenotifis[$i]['notifi'])
                                            <td style="width:25%;">{{ $greenpetsinglenotifis[$i]['read'].'/'.$greenpetsinglenotifis[$i]['total'] }}</td>
                                        @else
                                            <td style="width:25%;">尚未發送</td>
                                        @endif
                                        <td style="width:20%;">
                                            @if($greenpetsinglenotifis[$i]['notifi'])
                                                @if( $greenpetsinglenotifis[$i]['read'] >= 1 )
                                                    <a href="{{ route('greenpetnotifisingle.show',$greenpetsinglenotifis[$i]['id']) }}" class="btn btn-block btn-info">進階發送</a>
                                                @endif
                                                <button disabled type="button" class="btn btn-block btn-primary">已發送</button>
                                            @else
                                                {!! Form::open([
                                                    'id' => ('sendnotifisingle'.$greenpetsinglenotifis[$i]['id']), 'method' => 'GET',
                                                    'action' => ['GreenPetNotifiSingleController@notifi',$greenpetsinglenotifis[$i]['id'] ]])
                                                !!}
                                                {!! Form::close() !!}
                                                <button onclick="btnsendnotifisingle('{{ $greenpetsinglenotifis[$i]['id'] }}')" type="button" class="btn btn-block btn-primary">發送</button>
                                            @endif

                                            @if($greenpetsinglenotifis[$i]['link'] != "null")
                                                <a href="{{ $greenpetsinglenotifis[$i]['link'] }}" style="border-color: #84bcd8;background-color: #84bcd8;" target="_blank" type="button" class="btn btn-block btn-primary">連結</a>
                                            @else
                                                <a disabled type="button" style="border-color: #84bcd8;background-color: #84bcd8;" class="btn btn-block btn-primary">沒連結</a>
                                            @endif

                                            <a href="{{ route('greenpetnotifisingle.info',  $greenpetsinglenotifis[$i]['id'] ) }}" style="border-color: #9db782;background-color: #9db782;" type="button" class="btn btn-block btn-primary">資訊</a>
                                            {!! Form::open([
                                                'id' => ('rmnotifisingle'.$greenpetsinglenotifis[$i]['id'] ), 'method' => 'DELETE',
                                                'action' => ['GreenPetNotifiSingleController@destroy',$greenpetsinglenotifis[$i]['id'] ]])
                                            !!}
                                            {!! Form::close() !!}
                                            <button onclick="btnrmnotifisingle('{{ $greenpetsinglenotifis[$i]['id'] }}')" type="button" style="margin-top: 5px;" class="btn btn-block btn-danger">刪除</button>
                                            <a href="{{ route('greenpetnotifisingle.edit', $greenpetsinglenotifis[$i]['id'] ) }}" class="btn btn-block btn-warning">修改</a>
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

        function btnsendnotifisingle($id){
            if(confirm("確定進行發送推送訊息")){
                $("#sendnotifisingle"+$id).submit();
            };
        };

        function btnrmnotifisingle($id){
            if(confirm("確定要刪除此單人通知")){
                $("#rmnotifisingle"+$id).submit();
            };
        };

    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection


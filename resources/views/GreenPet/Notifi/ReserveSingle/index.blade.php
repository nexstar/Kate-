@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">
            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">
                <div class="col-md-12">

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-6 col-md-offset-3" style="text-align: center;">
                            <p style="font-size: 30px;">綠寵物-(單/預約)訊息推送</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <a href="{{ url('greenpetnotifireservesingle/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">增單訊 ( 預約 )</a>
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
                                    <th>預約時段</th>
                                    <th>已讀/總量</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @for($i=0;$i<count($ReserveSingle);$i++)
                                    <tr style="cursor: default;">
                                        <td style="width:25%;">
                                            <img src="{{ url('images/GreenPetReserveSingle/'.$ReserveSingle[$i]['src']) }}" style="width: 100%;">
                                        </td>
                                        <td style="width:20%;">{{ $ReserveSingle[$i]['title'] }}</td>
                                        <td style="width:25%;">{{ $ReserveSingle[$i]['contents'] }}</td>
                                        <td style="width:20%;">
                                            <p>{{ $ReserveSingle[$i]['reservemdh']['m'].'月'.$ReserveSingle[$i]['reservemdh']['d'].'日'.$ReserveSingle[$i]['reservemdh']['h'].'時' }}</p>
                                        </td>
                                        @if(count($ReserveSingle[$i]['notifi']) >= 1)
                                            <td style="width:25%;">{{ $ReserveSingle[$i]['read'].'/'.$ReserveSingle[$i]['total'] }}</td>
                                        @else
                                            <td style="width:25%;">預約期未到</td>
                                        @endif
                                        <td style="width:30%;">
                                            @if( $ReserveSingle[$i]['link'] != "null")
                                                <a href="{{ $ReserveSingle[$i]['link'] }}" target="_blank" type="button" class="btn btn-block btn-primary">連結</a>
                                            @else
                                                <a disabled type="button" class="btn btn-block btn-primary">沒連結</a>
                                            @endif
                                            <a href="{{ route('greenpetnotifireservesingle.info',$ReserveSingle[$i]['id'] ) }}" style="border-color: #9db782;background-color: #9db782;" type="button" class="btn btn-block btn-primary">資訊</a>
                                            {!!
                                                Form::open([
                                                'id' => ('rmnotifisingle'.$ReserveSingle[$i]['id']), 'method' => 'DELETE',
                                                'action' => ['GreenPetNotifiReserveSingleController@destroy',$ReserveSingle[$i]['id']]])
                                            !!}
                                            {!! Form::close() !!}
                                            <button onclick="btnrmnotifisingle('{{ $ReserveSingle[$i]['id'] }}')" type="button" style="margin-top: 5px;" class="btn btn-block btn-danger">刪除</button>
                                            <a href="{{ route('greenpetnotifireservesingle.edit', $ReserveSingle[$i]['id']) }}" class="btn btn-block btn-warning">修改</a>
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

        function btnrmnotifisingle($id){
            if(confirm("確定要刪除此預約群體通知")){
                $("#rmnotifisingle" + $id).submit();
            };
        };

    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection


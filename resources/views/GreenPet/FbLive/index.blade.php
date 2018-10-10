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
                            <p style="font-size: 30px;">綠寵物-直播</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <a href="{{ url('fblive/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">增直播</a>
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
                                    <th>訂閱人數</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                    @foreach($fblive as $fblivelist)
                                    <tr style="cursor: default;">
                                        <td style="width:20%;">
                                            <img src="{{ url('images/Fblive/'.$fblivelist->picjson['src']) }}" style="width:100%;">
                                        </td>
                                        <td style="width:20%;">{{ $fblivelist->title }}</td>
                                        <td style="width:20%;">{{ $fblivelist->contents }}</td>
                                        <td style="width:20%;">{{ count($fblivelist->saw) }}</td>
                                        <td style="width:20%;">
                                            @if($fblivelist->open == "1")
                                                <a href="{{ url('fblive/fbclose',[$fblivelist->_id, "2"]) }}" class="btn btn-block btn-info">關閉直播</a>
                                            @endif
                                            {!! Form::open([
                                                'id' => ('rmfblive'.$fblivelist->_id), 'method' => 'DELETE',
                                                'action' => ['fblivecontroller@destroy',$fblivelist->_id]])
                                            !!}
                                            {!! Form::close() !!}
                                            <button onclick="btnrmfblive('{{ $fblivelist->_id }}')" type="button" style="margin-top: 5px;" class="btn btn-block btn-danger">刪除</button>
                                            <a href="{{ route('fblive.edit', $fblivelist->_id) }}" class="btn btn-block btn-warning">修改</a>
                                        </td>
                                    </tr>
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
        var _main_table = $( window ).height() - 200;
        $("#main_table").css({"height":_main_table, "overflow-y": "scroll"});

        function btnrmfblive($id){
            if(confirm("確定要刪除此單人通知")){
                $("#rmfblive"+$id).submit();
            };
        };

    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection


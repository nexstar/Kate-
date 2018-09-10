@extends('Layouts.background')
@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row">

            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">
                <div class="col-md-12">

                    <div class="row" style="margin:20px 0px;">
                        <p>工具說明</p>
                        <p>發送：利用勾選，選出發送的對象。</p>
                        <p>新增：點選新增客戶資料。</p>
                        <p>修改與刪除：每一位客戶都擁有。</p>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::open(['id' => 'ch_data_id','method' => 'POST', 'action'=> ['SmsController@Single'],'files' => true]) !!}
                           	<button onclick="btn_check_submit()" type="button" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">發訊息</button>
                           {!! Form::close() !!}
                        </div>
                        <div class="col-md-4 col-md-offset-4" style="text-align: right;">
                            <a href="{{ route('customerinfo.ExcelExport') }}" class="btn btn-primary" style="border: 0;background-color: #8AAC68;">匯出會員資料</a>
                            <a href="{{ route('customerinfo.create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;margin-right: 20px;">新增客戶資料</a>
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 15px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="ch_all">
                                    </th>
                                    <th>姓名</th>
                                    <th>性別</th>
                                    <th>電話</th>
                                    <th>註解</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
<tbody id="main_table_tbody">

@foreach($customerinfo as $customerinfokey => $customerinfovalue)
    <tr>
        <td>
            <input type="checkbox" name="ch_user[]" value="{{ $customerinfovalue->id }}">
        </td>
         
        <td>{{ $customerinfovalue->firstname.$customerinfovalue->lastname }}</td>
        <td>{{ ($customerinfovalue->sex == "1") ? '男性' : '女性' }}</td>
        <td>{{ $customerinfovalue->privatemobile }}</td>
        <td style="width: 50%">
            <p class="text-justify">
                {!! preg_replace("/\r\n|\r|\n/",'<br/>', $customerinfovalue->remark) !!}
            </p>
        </td>
        <td>
			<div class="col-md-6">
                {!! Form::open(['id'=> ('removeform'.$customerinfokey), 'method'=>'DELETE', 'action'=>['CustomerInfoController@destroy', $customerinfovalue->id] ]) !!}   
                    <div class="form-group">
                        <button onclick="btn_remove_submit({{$customerinfokey}})" type="button" class="btn btn-block btn-danger">刪除</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-md-6">
                {!! Form::open(['id'=> ('modifyform'.$customerinfokey), 'method'=>'GET', 'action'=>['CustomerInfoController@edit', $customerinfovalue->id] ]) !!}   
                    <div class="form-group">
                        <button onclick="btn_modify_submit({{$customerinfokey}})" type="button" class="btn btn-block btn-warning">修改</button>
                    </div>
                {!! Form::close() !!}
            </div>
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
        $("#main_left").css({ "min-height" : ($( window ).height() - 50) });

        var _main_table = $( window ).height() - 255;
        $("#main_table").css({"height":_main_table, "overflow-y": "scroll"});

        $('input[name="ch_all"]').on('click',function(){
            $('input[name="ch_user[]"]').prop( "checked", false );
            if($('input[name="ch_all"]:checked').length > 0){
                $('input[name="ch_user[]"]').prop( "checked", true );
            };
        });

        function btn_check_submit(){
            let Check_Tmp = '';
            if($('input[name="ch_user[]"]:checked').length >= 1){
                $('input[name="ch_user[]"]:checked').each(function(i){
                    Check_Tmp += '<input type="hidden" name="ch_data[]" value="'+$(this).val()+'">';
                });
                $("#ch_data_id").append(Check_Tmp).submit();
            }else{
                alert("請選擇需要發送的客戶...");
            };
        };

        function btn_modify_submit($data){
            if(confirm("確定修改？？")){
                $("#modifyform"+$data).submit();
            };
        };

        function btn_remove_submit($data){
            if(confirm("確定刪除？？")){
                $("#removeform"+$data).submit();
            };
        };

    </script>

    <style type="text/css">
        table, th{
            text-align: center;
        }
        input[type="checkbox"] {
            width: 20px;height: 20px;
        }
    </style>
@endsection


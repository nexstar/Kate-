@extends('Layouts.background')
@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row">

            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-4" style="margin-top: 20px;">
                            {{--<a href="{{ url('success') }}" class="btn btn-warning">返回</a>--}}
                        </div>

                        <div class="col-md-4" style="text-align: center;">
                            <h2>簡訊發送預備中</h2>
                        </div>
                        <div class="col-md-4" style="text-align: right;padding-top: 5px;">
							<input type="hidden" name="smscount" value="{{ (strpos($smscount,'密碼') >= 1)?0:$smscount }}">
							 <h3>簡訊剩餘量: {{ (strpos($smscount,'密碼') >= 1)?'帳密錯誤':$smscount }}</h3>
                        </div>

                    </div>

                    <div class="row" style="margin:20px 0px;">
                        <p>工具說明</p>
                        <p>名單：顯示需發送的客戶名單。</p>
                        <p>內容：準備要發送客戶的內容。</p>
                    </div>

                    <div class="row" style="margin:20px 0px;">
                        <p>發送名單</p>
                        <div class="col-md-12" style="border-radius: 5px;overflow-y: scroll;height: 200px;border: 1px solid #dddddd;">
							@foreach($checkArray as $checkArraykey => $checkArrayvalue)
                            	<div class="col-md-2" style="padding-right: 0px;padding-left: 0px;margin: 10px 0px 10px 0px;text-align: center;">
    		                        <p>{{$checkArraykey +1}}. {{$checkArrayvalue['name']}} ( {{$checkArrayvalue['phone']}} )</p>
	                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row" style="margin:20px 0px;">
                        {!! Form::open(['id'=>'sendsms','method' => 'POST', 'action' => 'SmsController@Send','files' => true]) !!}
						@foreach($checkArray as $checkArraykey => $checkArrayvalue)
							<input type="hidden" name="Hubcheck[]" value="{{$checkArrayvalue['phone']}}">
							<input type="hidden" name="Hubname[]" value="{{$checkArrayvalue['name']}}">
						@endforeach
                        <p>內容撰寫 ( 字數：<span id="countword">0</span> )</p>
                        <textarea name="contents" style="border-radius: 5px;width: 100%;height: 100px;resize: none;overflow: auto;background-color: rgba(155,155,155,0);border: 1px solid #dddddd;"></textarea>
                        <p style="color: red;letter-spacing: 5px;">注意：1則70字/1元，超過字數2則計算。</p>
                        <div class="col-md-12" style="text-align: right;">
                        	<button {{ ($smscount < 50)? 'disabled="disabled"':'' }}  type="button" onclick="sendsms()" class="btn btn-primary"> {{ ($smscount < 50)? '需儲值' : '立刻發送'}}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $('textarea').change(function(i){
            $("#countword").html($(this).val().length);
        });

        function sendsms(){
            if($('[name="smscount"]').val() > 50){
                if($('textarea').val().length > 0){
                    if(confirm("確定發送？？")){
                        $("#sendsms").submit();
                    };
                }else{
                    alert("簡訊發送內容不能為空...");
                };
            }else{
                alert("簡訊經費不足，不宜進行發送機制...");
            };
        };
    </script>

@endsection

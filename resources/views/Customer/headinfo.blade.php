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
                            <h2>管理者設定</h2>
                        </div>
                    </div>

                    <div class="row" style="margin:20px 0px;">
                        <p>工具說明</p>
                        <p>管理者：目前擁有此系統的設定。</p>
                        <p>ＳＭＳ：設定主要發送擁有者( 主要:管理者 )。</p>
                    </div>

                    <div class="row" style="margin:20px 0px;">

                        <div class="col-md-6" style="padding-left: 0;">

                            {!! Form::open(['id'=>'hrform','method'=>'POST', 'action' => 'UserController@update', 'files'=>true]) !!}
                            <input type="hidden" name="type" value="1">

                            <div class="form-group">
                                <p>管理者設定</p>
                            </div>

                            <div style="height: 97px;margin-bottom: 0px;" class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">帳號</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('', $users->name) }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div style="height: 97px;margin-bottom: 0px;" class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">密碼</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="密碼不顯示，直接填寫進行修正">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div style="height: 97px;margin-bottom: 0px;" class="form-group">
                                <label for="repassword">密碼再次輸入</label>
                                <input type="text" class="form-control" id="repassword" name="repassword" placeholder="密碼再次輸入">
                            </div>
                            <div class="form-group">
                                <button type="button" onclick="btnhr()"  class="btn btn-block btn-warning">修改</button>
                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div class="col-md-6" style="padding-left: 0;">
                            {!! Form::open(['id'=>'smsform', 'method'=>'POST', 'action' => 'UserController@update','files'=>true]) !!}
                            <input type="hidden" name="type" value="2">
                            <div class="form-group">
                                <p>SMS簡訊設定</p>
                            </div>
                            <div style="height: 97px;margin-bottom: 0px;" class="form-group {{ $errors->has('smsid') ? ' has-error' : '' }}">
                                <label for="smsid">帳號 (手機號)</label>
                                <input type="text" class="form-control" name="smsid" id="smsid" value="{{ old('', $users->smsname) }}">
                                @if ($errors->has('smsid'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('smsid') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div style="height: 97px;margin-bottom: 0px;" class="form-group {{ $errors->has('smspwd') ? ' has-error' : '' }}">
                                <label for="smspwd">密碼</label>
                                <input type="text" class="form-control" id="smspwd" name="smspwd" value="{{ old('', $users->smspwd) }}">
                                @if ($errors->has('smspwd'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('smspwd') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="button" onclick="btnsms()" class="btn btn-block btn-warning">修改</button>
                            </div>
                            {!! Form::close() !!}
                        </div>

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

        function btnhr(){
			

            if(confirm("確定修改？？")){
				if( $("#password").val() == $("#repassword").val() ){
	                $("#hrform").submit();
				}else{
					$("#password").val('');
					$("#repassword").val('');
					alert("密碼兩者不同");
				}
            };


        };

        function btnsms(){
            if(confirm("確定修改？？")){
                $("#smsform").submit();
            };
        };

    </script>
@endsection

@extends('Layouts.background')
@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row">

            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="overflow-y: scroll;width:88.33333333%;">

                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-4 col-md-offset-4" style="text-align: center;">
                            <h2>新增客戶資料</h2>
                        </div>
                    </div>

                    <div class="row" style="margin:20px 0px;">
                        <p>工具說明</p>
                        <p>針對新的客戶做紀錄新增。</p>
                    </div>

                    <div class="row" style="margin:20px 0px;">
                        {!! Form::open([ 'method' => 'POST', 'action' => 'CustomerInfoController@store', 'files' => true ]) !!}
                        {{--個人--}}
                        <div class="col-md-12" style="margin-bottom: 20px;border-bottom: 1px solid #dddddd;">
                            
							<div class="col-md-2 {{ $errors->has('privatemobile') ? ' has-error' : '' }}" style="height: 97px;">
                                <div class="form-group {{ $errors->has('privatemobile')?'has-error':'' }}">
                                    <label for="privatemobile">私人-行動電話</label>
                                    <input value="{{ old('privatemobile') }}" id="privatemobile" name="privatemobile" type="text" class="form-control">
                                </div>
                                @if ($errors->has('privatemobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('privatemobile') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="firstname">姓氏</label>
                                    <input value="{{ old('firstname') }}" id="firstname" name="firstname" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="lastname">名字</label>
                                    <input value="{{ old('lastname') }}" id="lastname" name="lastname" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="engname">英文名</label>
                                    <input value="{{ old('engname') }}" id="engname" name="engname" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="nickname">暱稱</label>
                                    <input value="{{ old('nickname') }}" id="nickname" name="nickname" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="birthday">生日</label>
                                    <input value="{{ old('birthday') }}" id="birthday" name="birthday" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="sex">性別</label>
                                    {!! Form::select('sex', [ 0 => '女性', 1 => '男性' ], 1, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="age">年齡</label>
                                    <input value="{{ old('age') }}" id="age" name="age" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4" style="height: 97px;">
                                <div class="form-group">
                                    <label for="countryregion">住家-國家/地區</label>
                                    <input value="{{ old('countryregion') }}" id="countryregion" name="countryregion" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="homeindoorphone">住家-室內電話</label>
                                    <input value="{{ old('homeindoorphone') }}" id="homeindoorphone" name="homeindoorphone" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;"></div>

                            <div class="col-md-6" style="height: 97px;">
                                <div class="form-group">
                                    <label for="homeaddress">住家-地址</label>
                                    <input value="{{ old('homeaddress') }}" id="homeaddress" name="homeaddress" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6" style="height: 97px;">
                                <div class="form-group">
                                    <label for="privatemail">私人-電子郵件</label>
                                    <input value="{{ old('privatemail') }}" id="privatemail" name="privatemail" type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        {{--公司--}}
                        <div class="col-md-12" style="margin-bottom: 20px;border-bottom: 1px solid #dddddd;">
                            <div class="col-md-4" style="height: 97px;">
                                <div class="form-group">
                                    <label for="companyname">公司名</label>
                                    <input value="{{ old('companyname') }}" id="companyname" name="companyname" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="companybranch">部門</label>
                                    <input value="{{ old('companybranch') }}" id="companybranch" name="companybranch" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="companytitle">職稱</label>
                                    <input value="{{ old('companytitle') }}" id="companytitle" name="companytitle" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="companyvat">公司-統一編號</label>
                                    <input value="{{ old('companyvat') }}" id="companyvat" name="companyvat" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="height: 97px;">
                                <div class="form-group">
                                    <label for="companyindoorphone">公司-室內電話</label>
                                    <input value="{{ old('companyindoorphone') }}" id="companyindoorphone" name="companyindoorphone" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4" style="height: 97px;">
                                <div class="form-group">
                                    <label for="companyaddress">公司-地址</label>
                                    <input value="{{ old('companyaddress') }}" id="companyaddress" name="companyaddress" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4" style="height: 97px;">
                                <div class="form-group">
                                    <label for="companymail">公司-電子郵件</label>
                                    <input value="{{ old('companymail') }}" id="companymail" name="companymail" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4" style="height: 97px;">
                                <div class="form-group">
                                    <label for="companyweb">公司-網址</label>
                                    <input value="{{ old('companyweb') }}" id="companyweb" name="companyweb" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3" style="height: 97px;">
                                <div class="form-group">
                                    <label for="companyfax">公司-傳真號碼</label>
                                    <input value="{{ old('companyfax') }}" id="companyfax" name="companyfax" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3" style="height: 97px;">
                                <div class="form-group">
                                    <label for="companytelephone">公司-電話</label>
                                    <input value="{{ old('companytelephone') }}" id="companytelephone" name="companytelephone" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3" style="height: 97px;">
                                <div class="form-group">
                                    <label for="companymobile">公司-行動電話</label>
                                    <input value="{{ old('companymobile') }}" id="companymobile" name="companymobile" type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remark">備註</label>
                                    <textarea id="remark" name="remark" style="font-size: 15px;border-radius: 5px;width: 100%;height: 150px;resize: none;background-color: rgba(155,155,155,0);border: 1px solid #dddddd;"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12" style="text-align: right;">
                                <button type="submit" class="btn btn-primary">儲存</button>
                            </div>
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
        $("#main_right").css({ "max-height" : ($( window ).height() - 50) });
    </script>

@endsection

@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div id="main_right" class="col-md-12" style="margin-top: 55px;">
        <div class="container">

            <div class="row" style="padding-top: 20px;">
                <div class="col-md-4">
                    <a href="{{ url('greenpetnotifisingle') }}" class="btn btn-warning">返回</a>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p style="font-size: 30px;">綠寵物-(單/資訊)訊息推送</p>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label>標題</label>
                        <input disabled value="{{$TmpViewarray['title']}}" id="title" name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>內容</label>
                        <textarea disabled id="contents" name="contents" rows="5" style="width:100%;resize:none;border-color: #dddddd;">{{ $TmpViewarray['contents'] }}</textarea>
                    </div>
                </div>

                {{-- 綠寵物種類 --}}
                    <div class="col-md-12">
                    <div class="form-group">
                        <p>綠寵物種類</p>
                        <div style="border:1px solid #dddddd;height: 120px;overflow-y: scroll;">
                            @foreach($petbigitems as $result)
                                <div class="col-md-3" style="margin: 15px 0px 10px 0px;text-align: center;">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <input disabled {{ ( ($TmpViewarray['four']['type'].'_'.$TmpViewarray['four']['id']) == 'pettype_'.$result->_id ) ? "checked" : "" }} type="radio" name="radiosingle" value="{{ 'pettype_'.$result->_id }}">
                                        </div>
                                        <input value="{{ '( '.$result->pethub.' )'}}" style="text-align: center;" type="text" class="form-control" disabled="true">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- 綠寵物名稱 --}}
                    <div class="col-md-12">
                    <div class="form-group">
                        <p>綠寵物名稱</p>
                        <div style="border:1px solid #dddddd;height: 250px;overflow-y: scroll;">
                            @foreach($petsmallitems as $result)
                                <div class="col-md-4" style="margin: 15px 0px 10px 0px;text-align: center;">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <input disabled {{ ( ($TmpViewarray['four']['type'].'_'.$TmpViewarray['four']['id']) == 'petname_'.$result->_id ) ? "checked" : "" }} type="radio" name="radiosingle" value="{{ 'petname_'.$result->_id }}">
                                        </div>
                                        <input value="{{ '( '.$result->petname.' )'}}" style="text-align: center;" type="text" class="form-control" disabled="true">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- 性別 --}}
                    <div class="col-md-12">
                    <div class="form-group">
                        <p>性別</p>
                        <div style="border:1px solid #dddddd;height: 80px;overflow-y: scroll;">
                            <div class="col-md-3" style="margin: 15px 0px 10px 0px;text-align: center;">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <input {{ ( ($TmpViewarray['four']['type'].'_'.$TmpViewarray['four']['id']) == "gender_0" ) ? "checked" : "" }} type="radio" name="radiosingle" value="gender_0">
                                    </div>
                                    <input id="gender1" value="女性" style="text-align: center;" type="text" class="form-control" disabled="true">
                                </div>
                            </div>
                            <div class="col-md-3" style="margin: 15px 0px 10px 0px;text-align: center;">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <input disabled {{ ( ($TmpViewarray['four']['type'].'_'.$TmpViewarray['four']['id']) == "gender_1" ) ? "checked" : "" }} type="radio" name="radiosingle" value="gender_1">
                                    </div>
                                    <input id="gender1" value="男性" style="text-align: center;" type="text" class="form-control" disabled="true">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--手機(用戶名) --}}
                    <div class="col-md-12">
                    <div class="form-group">
                        <p>手機(用戶名)</p>
                        <div style="border:1px solid #dddddd;height: 250px;overflow-y: scroll;">
                            @foreach($appwebusers as $appwebuserslist)
                                <div class="col-md-3" style="margin: 15px 0px 10px 0px;text-align: center;">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <input disabled {{ (($TmpViewarray['four']['type'].'_'.$TmpViewarray['four']['id'])==('phone_'.$appwebuserslist->phone))?"checked":"" }} type="radio" name="radiosingle" value="{{ 'phone_'.$appwebuserslist->phone }}">
                                        </div>
                                        <input value="{{ '( '.$appwebuserslist->info['name'].' )-'.$appwebuserslist->phone }}" style="text-align: center;" type="text" class="form-control" disabled="true">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript">

    </script>

    <style type="text/css">

    </style>
@endsection
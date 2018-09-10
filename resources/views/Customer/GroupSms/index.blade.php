@extends('Layouts.background')
@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row">

            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-4 col-md-offset-4" style="text-align: center;">
                            <h2>客戶-簡訊群組</h2>
                        </div>

                    </div>

                    <div class="row" style="margin:20px 0px;">
                        <p>工具說明</p>
                        <p>利用群組把同性質的客戶結合，同時發送訊息。</p>
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 col-md-offset-4" style="text-align: right;">
                            <a href="{{ url('customergroup/create') }}" class="btn btn-primary">增加新群組</a>
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 15px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>發送</th>
                                    <th>名稱</th>
                                    <th>人數</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @foreach($customergroup as $customergroupKey => $customergroupValue)
                                    <tr>
                                        <td style="width:5%;">
                                            <a href="{{ route('smscontroller.group', $customergroupValue->id) }}" class="btn btn-block btn-primary">進入發送區</a>
                                        </td>
                                        <td>{{ $customergroupValue->name }}</td>
                                        <td>{{ Count($customergroupValue->addcheckboxgroup) }}</td>
                                        <td style="width:20%">
											<div class="col-md-6">
												{!! Form::open([ 'id'=> ('removeform'.$customergroupKey), 'method'=>'DELETE', 'action'=>['CustomerGroupController@destroy', $customergroupValue->id ] ]) !!}
													<div class="form-group">
														<button onclick="btn_remove_submit({{$customergroupKey  }})" type="button" class="btn btn-block btn-danger">刪除</button>
													</div>
												{!! Form::close() !!}
											</div>
											<div class="col-md-6">
												{!! Form::open([ 'id'=> ('modifyform'.$customergroupKey), 'method'=>'GET', 'action'=>['CustomerGroupController@edit', $customergroupValue->id ] ]) !!}   
													<div class="form-group">
														<button onclick="btn_modify_submit({{ $customergroupKey }})" type="button" class="btn btn-block btn-warning">修改</button>
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
		function btn_modify_submit($data){
            if(confirm("確定修改？？")){
                $("#modifyform"+$data).submit();
            };
        };

        function btn_remove_submit($data){
            if(confirm("確定刪除？？")){
                $("#removeform"+$data).submit();
            };
        }
    </script>
    <style type="text/css">
        table, th{
            text-align: center;
        }
    </style>
@endsection

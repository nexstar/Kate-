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
                            <h2>客戶-(新增)簡訊群組</h2>
                        </div>

                    </div>

                    <div class="row" style="margin:20px 0px;">
                        <p>工具說明</p>
                        <p>建立新的客戶群組。</p>
                    </div>

                    <div class="row" style="margin:20px 0px;">
                        <div class="col-md-12">
                            {!! Form::open(['id' => 'smsgroupinsert','action' => 'CustomerGroupController@store', 'method' => 'POST', 'files' => true ]) !!}

                            <div class="row">

                                <div class="col-md-12" style="height: 97px;">
                                    <div class="form-group">
                                        <label for="name">名稱</label>
                                        <input value="" id="name" name="name" type="text" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row" style="margin:0px 0px 10px 0px">
                                <p>請點選需要加入群組的客戶</p>
								<div class="col-md-12" style="border-radius: 5px;overflow-y: scroll;height: 300px;border: 1px solid #dddddd;">
								    @foreach($customerinfo as $customerinfokey => $customerinfovalue )
								    <div class="col-md-3" style="margin: 15px 0px 10px 0px;text-align: center;">
								        <div class="input-group">
								            <div class="input-group-addon">
								                <input type="checkbox" name="addcheckboxgroup[]" value="{{ $customerinfovalue->id }}">
								            </div>
								            <input value="{{ $customerinfovalue->firstname.$customerinfovalue->lastname }} ( {{ $customerinfovalue->privatemobile }} )" style="text-align: center;" type="text" class="form-control" disabled="true">
								        </div>
								    </div>
								    @endforeach
								</div>
                            </div>

                            <div class="row">

                                <div class="col-md-12" style="text-align: right;">
                                    <button onclick="btn_check_submit()" type="button" class="btn btn-primary">送出</button>
                                </div>

                            </div>

                            {!! Form::close() !!}
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
		function btn_check_submit(){
		    let Check_Tmp = '';

		    if( $("#name").val() == ""){
		    	alert("名稱不能為空");
		    }else{
		     	if($('input[name="addcheckboxgroup[]"]:checked').length <=0){
		     		alert("請選擇需要發送的客戶...");
		        }else{
					$("#smsgroupinsert").append(Check_Tmp).submit();
		        };   	
		    }
		};
	</script>
@endsection










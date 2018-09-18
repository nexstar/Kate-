@extends('Layouts.background')
@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">

            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">

                <div class="col-md-12">

                    <div class="row" style="margin:20px 0px;">

                        <div class="col-md-4">
                            <a href="{{ url('onlineproducttpye') }}" class="btn btn-warning">返回</a>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <p style="font-size: 30px;">電商-分類-新增</p>
                        </div>

                        <div class="col-md-12">
                            {!! Form::open([
                                'id' => 'producttypeform','method' => 'POST',
                                'action' => 'OnlineProductTpyeController@store', 'files' => true
                                ])
                            !!}
                            <div class="row">
                                <div class="col-md-12" style="height: 97px;">
                                    <div class="form-group">
                                        <label>名稱</label>
                                        <input value="" id="name" name="name" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin:0px 0px 10px 0px">
                                <label>勾選商品</label>
                                <div class="col-md-12" style="border-radius: 5px;overflow-y: scroll;height: 300px;border: 1px solid #dddddd;">
                                    @for($i=0; $i<50; $i++)
                                    <div class="col-md-3" style="margin: 15px 0px 10px 0px;text-align: center;">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <input type="checkbox" name="addcheckboxgroup[]" value="{{$i}}">
                                            </div>
                                            <input value="商品名稱{{$i}}" style="text-align: center;" type="text" class="form-control" disabled="true">
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="text-align: right;">
                                    <button onclick="btnproducttype()" type="button" class="btn btn-primary">送出</button>
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
        function btnproducttype() {
            let checkcount = 0;
            $("input:checkbox:checked[name='addcheckboxgroup[]']").each(function(index) {
                checkcount++;
            });

            let _name = $('[name="name"]').val();

            if(_name == ""){
                alert("名稱不能為空");
            }else{
                if(checkcount <=0 ){
                    alert("商品尚未勾選");
                }else{
                    if(confirm("確定新增")){
                        $("#producttypeform").submit();
                    };
                };
            };
        };
    </script>
@endsection










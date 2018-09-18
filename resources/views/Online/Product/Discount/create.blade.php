@extends('Layouts.background')
@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">

            <div class="col-md-12">

                    <div class="row" style="margin:20px 0px;">

                        <div class="col-md-4">
                            <a href="{{ url('onlineproductdiscount') }}" class="btn btn-warning">返回</a>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <p style="font-size: 30px;">電商—商品折扣新增</p>
                        </div>

                        <div class="col-md-12">
                            {!! Form::open(['id' => 'pddiscountform','method' => 'POST', 'action' => 'OnlineProductDiscountController@store','files' => true ]) !!}

                            <div class="row">

                                <div class="col-md-12" style="height: 97px;">
                                    <div class="form-group">
                                        <label>名稱</label>
                                        <input id="pddiscountname" name="pddiscountname" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12" style="height: 97px;">
                                    <div class="form-group">
                                        <label>折扣數</label>
                                        <input id="pddiscountcount" name="pddiscountcount" max="100" min="1"  type="number" class="form-control">
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
                                                    <input type="checkbox" name="addcheckboxgroup[]" value="{{ $i }}">
                                                </div>
                                                <input value="商品名稱{{$i}}" style="text-align: center;" type="text" class="form-control" disabled="true">
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="text-align: right;">
                                    <button onclick="btnpddiscount()" type="button" class="btn btn-primary">送出</button>
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

        function btnpddiscount(){
            if(confirm("確定新增折扣??")){
                $("#pddiscountform").submit();
            };
        };

        $("#pddiscountcount").change(function () {
            if($(this).val() > 100){
                alert("超過");
                $(this).val('').focus();
            };
        });
    </script>
@endsection










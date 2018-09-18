@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">
            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">
                <div class="col-md-12">

                    <div class="row" style="padding-top: 20px;">
                        <div class="col-md-4">
                            <a href="{{ url('onlineproduct') }}" class="btn btn-warning">返回</a>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <p style="font-size: 30px;">電商-商品折扣</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">全館折扣(%)</label>
                                {!! Form::open([
                                    'id' => 'allweb', 'method' => 'PUT',
                                    'action' => ['OnlineProductDiscountController@allwebupdate','1'],
                                    'files' => true ])
                                !!}
                                <div class="row">
                                    <div class="col-md-8">
                                        <input disabled id="allwebipnut" name="allwebipnut" type="number" min="1" max="100" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <button id="editallweb" onclick="btneditallweb()" type="button" class="btn btn-block btn-primary">修改</button>
                                        <button id="updateallweb" onclick="btnupdateallweb()" style="display: none;margin: 0px;" type="button" class="btn btn-block btn-warning">確定修改</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">滿額折扣(%)</label>
                                {!! Form::open(['id' => 'fullamount', 'method' => 'PUT', 'action' => ['OnlineProductDiscountController@fullamountupdate','1'] ]) !!}
                                <div class="row">
                                    <div class="col-md-4">
                                        <input id="fullinput" name="fullinput" disabled type="number" value="" max="9999" min="1" class="form-control" placeholder="滿額金">
                                    </div>
                                    <div class="col-md-4">
                                        <input id="cutinput" name="cutinput" disabled type="number" value="" max="100" min="1" class="form-control" placeholder="折數">
                                    </div>
                                    <div class="col-md-4">
                                        <button id="editfullamount" onclick="btneditfullamount()" type="button" class="btn btn-block btn-primary">修改</button>
                                        <button id="updatefullamount" onclick="btnupdatefullamount()" style="display: none;margin: 0px;" type="button" class="btn btn-block btn-warning">確定修改</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">紅利比例</label>
                                {!! Form::open(['id' => 'bonus', 'method' => 'PUT' ,'action' => ['OnlineProductDiscountController@bonusupdate','1'] ]) !!}
                                <div class="row">
                                    <div class="col-md-4">
                                        <input disabled id="moneyinput" name="moneyinput" type="number" max="99999" min="1" value="" class="form-control" placeholder="金額">
                                    </div>
                                    <div class="col-md-4">
                                        <input disabled id="rateinput" name="rateinput" type="number" max="100" min="1" value="" class="form-control" placeholder="比例">
                                    </div>
                                    <div class="col-md-4">
                                        <button id="editbouns" onclick="btnbonus()" type="button" class="btn btn-block btn-primary">修改</button>
                                        <button id="updatebouns" onclick="btnupdatebouns()" style="display: none;margin: 0px;" type="button" class="btn btn-block btn-warning">確定修改</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <a href="{{ url('onlineproductdiscount/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">新增折扣</a>
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>名稱</th>
                                    <th>折扣數</th>
                                    <th>數量</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @for($i=0;$i<count($tmp);$i++)
                                    <tr style="cursor: default;">
                                        <td style="width:20%;font-size: 20px;">{{$tmp[$i]['name']}}</td>
                                        <td style="width:20%;font-size: 20px;">{{$tmp[$i]['discount']}}%</td>
                                        <td style="width:20%;font-size: 20px;">
                                            @foreach($tmp[$i]['checkgroup'] as $grplist)
                                                <p style="margin: 0px;">{{$grplist}}</p>
                                            @endforeach
                                        </td>
                                        <td style="width:10%;">
                                            {!! Form::open([
                                                'id' => ('rmdiscountform'.$tmp[$i]['id']), 'method' => 'DELETE',
                                                'action' => ['OnlineProductDiscountController@destroy', $tmp[$i]['id']]
                                                ])
                                            !!}
                                                <button onclick="rmdiscount('{{$tmp[$i]['id']}}')" type="button" class="btn btn-block btn-danger">刪除</button>
                                            {!! Form::close() !!}
                                            <a href="{{ route('onlineproductdiscount.edit', $i) }}" style="margin-top: 5px;" class="btn btn-block btn-warning">修改</a>
                                        </td>
                                    </tr>
                                @endfor
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
        var _main_table = $( window ).height() - 300;
        $("#main_table").css({"height":_main_table, "overflow-y": "scroll"});

        $("#moneyinput").change(function () {
            if($(this).val() <=0 ){
                alert("紅利金不能底於零");
                $(this).val('');
            }else{
                if($(this).val() >=9999 ){
                    alert("紅利金不能高於9999");
                    $(this).val('');
                };
            };
        });

        $("#rateinput").change(function () {
            if($(this).val() <=0 ){
                alert("比例不能底於零");
                $(this).val('');
            }else{
                if($(this).val() >=100 ){
                    alert("比例不能高於100");
                    $(this).val('');
                };
            };
        });

        function btnbonus(){
            $("#editbouns").css({ "display" : "none" });
            $("#updatebouns").css({ "display" : "block" });
            document.getElementById('moneyinput').disabled = false;
            document.getElementById('rateinput').disabled = false;
        };

        function btnupdatebouns(){
            if(confirm("確定修改??")){
                $("#bonus").submit();
            };
        };


        $("#fullinput").change(function () {
            if($(this).val() <=0 ){
                alert("滿額金不能底於零");
                $(this).val('');
            }else{
                if($(this).val() >=9999 ){
                    alert("滿額金不能高於9999");
                    $(this).val('');
                };
            };
        });

        $("#cutinput").change(function () {
            if($(this).val() <=0 ){
                alert("折扣數不能底於零");
                $(this).val('');
            }else{
                if($(this).val() >=100 ){
                    alert("折扣數不能高於100");
                    $(this).val('');
                };
            };
        });

        function btneditfullamount(){
            $("#editfullamount").css({ "display" : "none" });
            $("#updatefullamount").css({ "display" : "block" });
            document.getElementById('fullinput').disabled = false;
            document.getElementById('cutinput').disabled = false;
        };

        function btnupdatefullamount(){
            if(confirm("確定修改??")){
                $("#fullamount").submit();
            };
        };

        $("#allwebipnut").change(function () {
            if($(this).val() <=0 ){
                alert("全館折扣不能底於零");
                $(this).val('');
            }else{
                if($(this).val() >=100 ){
                    alert("全館折扣不能高於100");
                    $(this).val('');
                };
            };
        });

        function btneditallweb(){
            $("#editallweb").css({ "display" : "none" });
            $("#updateallweb").css({ "display" : "block" });
            document.getElementById('allwebipnut').disabled = false;
        };

        function btnupdateallweb() {
            if(confirm("確定修改??")){
                $("#allweb").submit();
            };
        };

        function rmdiscount($id) {
            if(confirm("確定刪除??")){
                $("#rmdiscountform"+$id).submit();
            };
        };

    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection


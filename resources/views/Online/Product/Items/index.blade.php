@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div id="main_right" class="col-md-12" style="margin-top: 55px;">
        <div class="container">

            <div class="row" style="padding-top: 20px;">
                <div class="col-md-4">
                    <a href="{{ url('onlineproduct') }}" class="btn btn-warning">返回</a>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p style="font-size: 30px;">電商-商品大小項</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div id="" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>商品大項</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="cursor: default;">
                                    {!! Form::open(
                                        [
                                            'id' => 'bigitemform', 'method' => 'POST',
                                            'action' => 'OnlineProductItemsController@bigitemstore',
                                            'files' => true
                                        ])
                                    !!}
                                    <td style="width: 15%;font-size: 20px;">
                                        <input name="bigitemtitle" type="text" style="width: 100%;" class="form-control">
                                    </td>
                                    <td style="width: 15%;">
                                        <button onclick="btnbigitem()" type="button" class="btn btn-block btn-primary">新增</button>
                                    </td>
                                    {!! Form::close() !!}
                                </tr>
                                @for($i=0;$i<count($bigitem);$i++)
                                    <tr style="cursor: default;">
                                        <td style="font-size: 20px;">
                                            {!! form::open(
                                                [
                                                    'id' => 'updatebigitemform', 'method' => 'PUT',
                                                    'action' => [
                                                        'OnlineProductItemsController@bigitemupdate', $bigitem[$i]['id']
                                                    ]
                                                ])
                                            !!}
                                                <input disabled id="editbigitem{{ $bigitem[$i]['id'] }}" name="editbigitem" value="{{ $bigitem[$i]['name'] }}" type="text" class="form-control">
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <div id="editbigitemdiv{{$bigitem[$i]['id']}}">
                                                {!! form::open(
                                                    [
                                                        'id' => 'rmbigitem', 'method' => 'DELETE',
                                                        'action' => [
                                                            'OnlineProductItemsController@bigitemdestroy', $bigitem[$i]['id']
                                                        ]
                                                    ])
                                                !!}
                                                    <button onclick="btnrmbigitem()" type="button" style="margin-bottom: 5px;" class="btn btn-block btn-danger">刪除</button>
                                                {!! Form::close() !!}
                                                <button onclick="btneditbigitem({{$bigitem[$i]['id']}})" type="button" class="btn btn-block btn-warning">修改</button>
                                            </div>
                                            <button id="btnupdatebigitem{{$bigitem[$i]['id']}}" onclick="btnupdatebigitem()" type="button" style="display: none;" class="btn btn-block btn-info">確定修改</button>
                                        </td>
                                    </tr>

                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            {!!
                                 Form::select('smallselect', $smallitem , 0, ['class' => 'form-control'])
                            !!}
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>商品小項</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="addsmalltable">
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

        $('[name=smallselect]').change(function () {
            if($(this).val() != "請選擇大項"){
                $.ajax({
                    type:'get',
                    url: "{{ url('/OnlineProductItemsController/small/123123') }}",
                    data:'_token = <?php echo csrf_token() ?>',
                    async: true,
                    success:function(data){
                        let smallmaxJson = JSON.parse(data);
                        smalltable(smallmaxJson);
                    }
                });
            };
        });

        function smalltable($data) {
            $("#addsmalltable").empty();
            $tmp  = "";
            $tmp += '<tr style="cursor: default;">';
                $tmp += '<?php echo Form::open(['id' => 'smallitemform','files' => true ]); ?>';
                    $tmp += '<td style="width: 15%;font-size: 20px;">';
                        $tmp += '<input name="smallitemtitle" type="text" style="width: 100%;" class="form-control">';
                    $tmp += '</td>';
                    $tmp += '<td style="width: 15%;">';
                        $tmp += '<button onclick="btnsmallitem()" type="button" class="btn btn-block btn-primary">新增</button>';
                    $tmp += '</td>';
                $tmp += '<?php Form::close(); ?>'
            $tmp += '</tr>';
            $.each($data, function (key, val) {
                $tmp += '<tr style="cursor: default;">';
                    $tmp += '<td style="font-size: 20px;">';
                            $tmp += '<input disabled id="editsmallitem'+key+'" name="editsmallitem" value="'+val+'" type="text" class="form-control">';
                    $tmp += '</td>';
                    $tmp += '<td>';
                        $tmp += '<div id="editsmallitemdiv'+key+'">';
                            $tmp += '<button onclick="btnrmsmallitem('+key+')" type="button" style="margin-bottom: 5px;" class="btn btn-block btn-danger">刪除</button>';
                            $tmp += '<button onclick="btneditsmallitem('+key+')" type="button" class="btn btn-block btn-warning">修改</button>';
                        $tmp += '</div>';
                        $tmp += '<button id="btnupdatesmallitem'+key+'" onclick="btnupdatesmallitem()" type="button" style="display: none;" class="btn btn-block btn-info">確定修改</button>';
                    $tmp += '</td>';
                $tmp += '</tr>';
            });

            $("#addsmalltable").html($tmp);
        }
        var smallupdateid;
        function btneditsmallitem($id) {
            smallupdateid = $id;
            if(confirm("確定修改??")){
                $("#editsmallitemdiv"+$id).css({"display":"none"});
                $("#btnupdatesmallitem"+$id).css({"display":"block"});
                document.getElementById(('editsmallitem'+$id)).disabled = false;
            };
        };

        function btnupdatesmallitem() {
            const _updatesmallitle = $("#editsmallitem"+smallupdateid).val();
            if(_updatesmallitle === ""){
                alert("未填...");
            }else{
                if(confirm("確定更新???")){
                    // $("#updatesmallitemform").submit();
                    $.ajax({
                        type:'PUT',
                        url: "{{ url('/OnlineProductItemsController/small') }}"+'/'+smallupdateid,
                        data: {
                            "editsmallitem":_updatesmallitle
                        },
                        async: true,
                        success:function(data){
                            alert("修改成功!!");
                            window.location.href = "OnlineProductItemsController";
                        }
                    });
                };
            };
        };

        function btnrmsmallitem($id) {
            if(confirm("確定刪除???")){
                // $("#rmbigitem").submit();
                $.ajax({
                    type:'DELETE',
                    url: "{{ url('/OnlineProductItemsController/small') }}"+'/'+$id,
                    data: {},
                    async: true,
                    success:function(data){
                        alert("刪除成功!!");
                        window.location.href = "OnlineProductItemsController";
                    }
                });
            };
        };

        function btnsmallitem(){
            const _smallitemtitle = $('[name=smallitemtitle]').val();
            const _smallselect =  $('[name=smallselect]').val();
            if(_smallitemtitle === ""){
                alert("新增小項欄位未填");
            }else{
                if(confirm("確定新增小項")){
                    // $("#smallitemform").submit();
                    $.ajax({
                        type:'POST',
                        url: "{{ url('/OnlineProductItemsController/small') }}",
                        data: {
                            "smallitemtitle":_smallitemtitle,
                            "smallid":_smallselect
                        },
                        async: true,
                        success:function(){
                            alert("新增成功!!");
                            window.location.href = "OnlineProductItemsController";
                        }
                    });
                };
            };
        }

        {{--BigItem--}}
        function btneditbigitem($id) {
            if(confirm("確定修改??")){
                $("#editbigitemdiv"+$id).css({"display":"none"});
                $("#btnupdatebigitem"+$id).css({"display":"block"});
                document.getElementById(('editbigitem'+$id)).disabled = false;
            };
        };

        function btnupdatebigitem() {
            if(confirm("確定更新???")){
                $("#updatebigitemform").submit();
            };
        };

        function btnrmbigitem() {
            if(confirm("確定刪除???")){
                $("#rmbigitem").submit();
            };
        };

        function btnbigitem(){
            const _bigitemtitle = $('[name=bigitemtitle]').val();
            if(_bigitemtitle === ""){
                alert("新增大項欄位未填");
            }else{
                if(confirm("確定新增大項")){
                    $("#bigitemform").submit();
                };
            };
        }
    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection
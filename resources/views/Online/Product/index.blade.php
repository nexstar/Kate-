@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">
            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">
                <div class="col-md-12">

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-4 col-md-offset-4" style="text-align: center;">
                            <p style="font-size: 30px;">電商-商品設定</p>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-9">
                            <div class="col-md-3">
                                <a href="{{ url('onlineproduct/create') }}" class="btn btn-block btn-success" style="background-color: #4A90E2;border-color: #4A90E2;">新增商品</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('OnlineProductItemsController') }}" class="btn btn-block btn-success" style="background-color: #4A90E2;border-color: #4A90E2;">商品大小項</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('onlineproductdiscount') }}" class="btn btn-block btn-success" style="background-color: #4A90E2;border-color: #4A90E2;">折扣</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('onlineproducttpye') }}" class="btn btn-block btn-success" style="background-color: #4A90E2;border-color: #4A90E2;">分類區</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="#" style="float: right;width: 30%;background-color: #4A90E2;border-color: #4A90E2;" class="btn btn-success">搜尋</a>
                            <input style="width: 70%;float: right;" type="text" placeholder="檢索: 編號,名稱" class="form-control">
                            <div style="clear: both;"></div
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>照片</th>
                                    <th>商品編號</th>
                                    <th>名稱</th>
                                    <th>大項</th>
                                    <th>小項</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @for($i=0;$i<10;$i++)
                                    <tr style="cursor: default;">
                                        <td style="width:20%;">
                                            <img src="http://placehold.it/1170x613" style="width:100%;">
                                        </td>
                                        <td style="font-size: 20px;">12312213131</td>
                                        <td style="font-size: 20px;">我是名稱</td>
                                        <td style="font-size: 20px;">我是大項</td>
                                        <td style="font-size: 20px;">我是小項</td>
                                        <td style="width:15%;">
                                            <a href="#" class="btn btn-block btn-success">網站</a>
                                            <a href="{{ route('onlinetransactionrecordcontroller.info', $i) }}" class="btn btn-block btn-info">資訊</a>
                                            <a href="#" class="btn btn-block btn-primary">上架</a>
                                            <a href="#" class="btn btn-block btn-info" style="background-color: #C10066;border-color: #C10066;">下架</a>
                                            <a href="#" class="btn btn-block btn-danger">刪除</a>
                                            <a href="{{ route('onlineproduct.edit', $i) }}" class="btn btn-block btn-warning">修改</a>
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

    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection


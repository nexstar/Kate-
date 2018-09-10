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
                                <label for="name">全館折扣</label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-block btn-primary">修改</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">滿額折扣</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" value="" class="form-control" placeholder="滿額金">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" value="" class="form-control" placeholder="折數">
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-block btn-primary">修改</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">紅利比例</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" value="" class="form-control" placeholder="金額">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" value="" class="form-control" placeholder="比例">
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-block btn-primary">修改</button>
                                    </div>
                                </div>
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
                                @for($i=0;$i<10;$i++)
                                    <tr style="cursor: default;">
                                        <td style="width:20%;font-size: 20px;">我是名稱</td>
                                        <td style="width:20%;font-size: 20px;">20%</td>
                                        <td style="width:20%;font-size: 20px;">9999</td>
                                        <td style="width:10%;">
                                            <a href="#" class="btn btn-block btn-danger">刪除</a>
                                            <a href="{{ route('onlineproductdiscount.edit', $i) }}" class="btn btn-block btn-warning">修改</a>
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


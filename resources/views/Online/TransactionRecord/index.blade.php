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
                            <p style="font-size: 30px;">電商-交易記錄</p>
                        </div>
                    </div>

                    <div class="row" style="margin:20px 0px;">
                        <div class="col-md-12" style="height: 40px;">
                            <div class="col-md-2" style="text-align: right;">
                                <a href="#" class="btn btn-primary" style="font-size: 20px;">顯示全部</a>
                            </div>
                            <div class="col-md-2" style="text-align: right;">
                                <a href="#" class="btn btn-success" style="font-size: 20px;">交易完成</a>
                            </div>
                            <div class="col-md-2" style="text-align: right;">
                                <a href="#" class="btn btn-warning" style="font-size: 20px;">交易處理中</a>
                            </div>
                            <div class="col-md-2" style="text-align: right;">
                                <a href="#" class="btn btn-danger" style="font-size: 20px;">交易失敗</a>
                            </div>
                            <div class="col-md-2" style="text-align: right;">
                                <a href="#" class="btn btn-primary" style="background-color: #29947C;border-color: #29947C;font-size: 20px;">商品處理中</a>
                            </div>
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>訂單編號</th>
                                    <th>會員編號</th>
                                    <th>商品</th>
                                    <th>交易狀態</th>
                                    <th>商品狀態</th>
                                    <th>送達日期</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @for($i=0;$i<10;$i++)
                                    <tr style="cursor: default;">
                                        <td style="font-size: 20px;">76543276543</td>
                                        <td style="font-size: 20px;">6543265432</td>
                                        <td style="font-size: 20px;">我是商品</td>
                                        <td style="font-size: 20px;">我是交易狀態</td>
                                        <td style="font-size: 20px;">我是商品狀態</td>
                                        <td style="font-size: 20px;">我是抵達時間</td>
                                        <td style="width:15%;">
                                            <a href="#" class="btn btn-block btn-primary" style="background-color: #BD10E0;border-color: #BD10E0;">修改狀態</a>
                                            <a href="#" class="btn btn-block btn-info">可出貨</a>
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


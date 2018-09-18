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
                            <p style="font-size: 30px;">電商-數據中心</p>
                        </div>
                    </div>

                    <div class="row" style="margin:20px 0px;">
                        <div class="col-md-6 col-md-offset-3" style="height: 40px;">
                            <div class="col-md-6" style="text-align: right;border-right: 2px solid #dddddd;">
                                <a href="{{ url('onlinedatacenternetworktraffic/y') }}" class="btn btn-primary" style="font-size: 20px;border: 0;background-color: #80B1EA;">網路流量</a>
                            </div>
                            <div class="col-md-6">
                                <span>男(總人數：100):50%</span>
                                <br>
                                <span>女(總人數：100):50%</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            {{--<a href="{{ url('onlinedatacenter/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">新增文章</a>--}}
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-success">匯出</a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" style="float: right;" class="btn btn-success">匯出</a>
                            <input style="width: 30%;float: right;" type="text" placeholder="檢索: 電話,姓名" class="form-control">
                            <div style="clear: both;"></div>
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>會員編號</th>
                                    <th>姓名</th>
                                    <th>電話</th>
                                    <th>信箱</th>
                                    <th>性別</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @for($i=0;$i<10;$i++)
                                    <tr style="cursor: default;">
                                        <td style="width: 15%;font-size: 20px;">6543765432765432</td>
                                        <td style="font-size: 20px;">鄒年寶</td>
                                        <td style="font-size: 20px;">09xxxxxxxx</td>
                                        <td style="font-size: 20px;">abc@gmail.com</td>
                                        <td style="width: 15%;font-size: 20px;">男</td>
                                        <td style="width: 15%;">
                                            <a href="{{ route('Online.DataCenter.clientinfosheet', $i) }}" class="btn btn-block btn-info">查閱</a>
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


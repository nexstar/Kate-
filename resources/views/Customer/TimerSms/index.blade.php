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
                            <p style="font-size: 30px;">客戶-(簡訊群組)預約發送</p>
                        </div>
                    </div>

                    <div class="row" style="margin:20px 0px;">
                        <p>工具說明</p>
                        <p>利用簡訊群組來進行預約自動發送。</p>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <a href="{{ url('customertimersms/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">新增預約</a>
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 15px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead style="">
                                <tr>
                                    <th>預約時間</th>
                                    <th>名稱</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @for($i=0;$i<10;$i++)
                                    <tr style="cursor: default;">
                                        <td style="font-size: 20px;">3月14日 13:00</td>
                                        <td style="font-size: 20px;">某某節慶</td>
                                        <td>
                                            <a href="#" style="width:45%;" class="btn btn-danger">刪除</a>
                                            <a href="{{ route('customertimersms.edit','1') }}" style="width:45%;" class="btn btn-warning">修改</a>
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
        var _main_table = $( window ).height() - 285;
        $("#main_table").css({"height":_main_table, "overflow-y": "scroll"});

    </script>

    <style type="text/css">
        table, th{
            text-align: center;
        }
    </style>
@endsection


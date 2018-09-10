@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">
            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">

                <div class="row" style="padding-top: 20px;">

                    <div class="col-md-4">
                        <a href="{{ url('/customertimersms') }}" class="btn btn-warning">返回</a>
                    </div>
                    <div class="col-md-4" style="text-align: center;">
                        <p style="font-size: 30px;">客戶-(修改)預約發送</p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">名稱</label>
                            <input value="" id="name" name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">月份</label>
                            {!!
                                Form::select(
                                    'month',
                                    [
                                        0 => '1月', 1 => '2月', 2 => '3月', 3 => '4月', 4 => '5月',
                                        5 => '6月', 6 => '7月', 7 => '8月', 8 => '9月', 9 => '10月',
                                        10 => '11月', 11 => '12月'
                                    ], 0,
                                    ['class' => 'form-control']
                                )
                            !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">日期</label>
                            {!!
                                Form::select(
                                    'day',
                                    [
                                        0 => '1', 1 => '2', 2 => '3', 3 => '4', 4 => '5',
                                        5 => '6', 6 => '7', 7 => '8', 8 => '9', 9 => '10',
                                        10 => '11', 11 => '12', 12 => '13', 13 => '14', 14 => '15',
                                        15 => '16', 16 => '17', 17 => '18', 18 => '19', 19 => '20',
                                        20 => '21', 21 => '22', 22 => '23', 23 => '24', 24 => '25',
                                        25 => '26', 26 => '27', 27 => '28', 28 => '29', 29 => '30',
                                        30 => '31'
                                    ], 0,
                                    ['class' => 'form-control']
                                )
                            !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">小時</label>
                            {!!
                                Form::select(
                                    'hour',
                                    [
                                        0 => '12:00', 1 => '13:00', 2 => '13:00', 3 => '14:00', 4 => '15:00',
                                        5 => '16:00', 6 => '17:00', 7 => '18:00', 8 => '19:00', 9 => '20:00'
                                    ], 0,
                                    ['class' => 'form-control']
                                )
                            !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">群組名單</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="grouplist" class="form-group" style="border-radius: 5px;overflow-y: scroll;border: 1px solid #dddddd;">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="text-align: right;">
                        <button onclick="" type="button" class="btn btn-primary">送出</button>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        var _main_table = $( window ).height() - 306;
        $("#grouplist").css({"height":_main_table, "overflow-y": "scroll"});
    </script>

    <style type="text/css">
        table, th{
            text-align: center;
        }
    </style>
@endsection


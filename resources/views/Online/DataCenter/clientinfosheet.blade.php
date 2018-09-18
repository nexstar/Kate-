@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div id="main_right" class="col-md-12" style="margin-top: 55px;">

        <div class="container">
            <div class="row" style="padding-top: 20px;">
                <div class="col-md-4">
                    <a href="{{ url('OnlineDataCenterPage') }}" class="btn btn-warning">返回</a>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p style="font-size: 30px;">數據中心-客戶查閱</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>會員編號</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>姓名</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>電話</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>信箱</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>性別</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>生日</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>消費總額</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>下單次數</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>郵局編號</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>地址</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>統編</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>交易資訊單</label>
                    </div>
                </div>
                @for($i=0;$i<20;$i++)
                    <div class="col-md-3">
                        <div class="panel panel-success" style="text-align: center;">
                            <div class="panel-heading">2018/03/13_18:00</div>
                            <div class="panel-body">
                                <p>J123dw1323132131</p>
                                <p style="color:red;">交易狀態完成</p>
                                <a href="{{ route('Online.DataCenter.clientinfobought',$i) }}" class="btn btn-block btn-default" style="background-color: #50E3C2;border-color: #50E3C2;">查閱</a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript">

    </script>

    <style type="text/css">

    </style>
@endsection
@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div id="main_right" class="col-md-12" style="margin-top: 55px;">

        <div class="container">
            <div class="row" style="padding-top: 20px;">
                <div class="col-md-4">
                    <a href="{{ route('Online.DataCenter.clientinfosheet',$id) }}" class="btn btn-warning">返回</a>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p style="font-size: 30px;">數據中心-交易資訊單</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>交易編號</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>交易狀態</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>交易金額</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>紅利獲得</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>收貨人</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>收貨人電話</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>收貨地址</label>
                        <input value="" disabled type="text" class="form-control">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>商品出貨資訊單</label>
                    </div>
                </div>
                @for($i=0;$i<3;$i++)
                    <div class="col-md-4">
                        <div class="panel panel-success">
                            <div class="panel-heading" style="text-align: center;">AAAdd123123123</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>商品名稱</label>
                                            <input value="" disabled type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>出貨照片</label>
                                            <img id="imagesrc" src="http://placehold.it/1170x613" alt="" style="width: 100%;height: 210px;margin-bottom: 1px;">
                                            <input id="imagesrcupload" name="imagesrcupload" type="hidden" value="">
                                            <input id="imagesrcuploadFe" name="imagesrcuploadFe" type="hidden" value="">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-block btn-default" style="background-color: #50E3C2;border-color: #50E3C2;">照片上傳</button>
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
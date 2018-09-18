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
                    <p style="font-size: 30px;">商品名稱</p>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12">
                    <div class="form-group">
                        <h3>資料</h3>
                    </div>
                    <div style="margin-left: 80px;">
                        <div class="col-md-4">
                            <h4>價格: {{ $TmpDB['money'] }}</h4>
                        </div>
                        <div class="col-md-4">
                            <h4>紅利: {{ $TmpDB['bouns'] }}</h4>
                        </div>
                        <div class="col-md-4">
                            <h4>庫存: {{ $TmpDB['inventory'] }}</h4>
                        </div>
                        <div class="col-md-4">
                            <h4>購買次數: {{ $TmpDB['buycount'] }}</h4>
                        </div>
                        <div class="col-md-4">
                            <h4>觀看次數: {{ $TmpDB['seecount'] }}</h4>
                        </div>
                        <div class="col-md-4">
                            <h4>上架日期: {{ $TmpDB['date'] }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h3>分類</h3>
                    </div>

                    <div style="margin-left: 80px;">
                        @for($i=0; $i<count($TmpType); $i++)
                        <div class="col-md-3">
                            <h4>{{ $TmpType[$i]['name'] }}</h4>
                        </div>
                        @endfor
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h3>加購</h3>
                    </div>

                    <div style="margin-left: 80px;">
                        @for($i=0; $i<count($TmpDB['addpd']); $i++)
                            <div class="col-md-4" style="text-align: center;">
                                <div class="thumbnail">
                                    <span>第{{ $i+1 }}個加購</span>
                                    <img style="margin: 5px 0px;width: 100%;" src="{{ $TmpDB['addpd'][$i]['src'] }}" alt="#">
                                    <p>名稱: {{ $TmpDB['addpd'][$i]['name'] }}</p>
                                    <p>加購價: {{ $TmpDB['addpd'][$i]['money'] }}</p>
                                </div>
                            </div>
                        @endfor
                    </div>

                </div>
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
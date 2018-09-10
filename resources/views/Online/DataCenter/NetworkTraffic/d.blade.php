@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div id="main_right" class="col-md-12" style="margin-top: 55px;">
        <div class="container">

            <div class="row" style="padding-top: 20px;">
                <div class="col-md-4">
                    <a href="{{ route('onlinedatacenternetworktrafficM',[ $m, $y ]) }}" class="btn btn-warning">返回</a>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p style="font-size: 30px;">電商-網路流量(日)</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="border-bottom: 2px solid #dddddd;">
                    <div class="form-group">
                        <h3>{{ $y }}年{{ $m }}月{{ $d }}日</h3>
                    </div>

                    <div style="margin-top: 30px;">
                        <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
                            <div class="form-group">
                                <label>上午</label>
                            </div>
                            <div style="text-align: center;">
                                <div class="col-md-6">
                                    <p style="font-size: 20px;">00:00 人數: 9999</p>
                                    <p style="font-size: 20px;">01:00 人數: 9999</p>
                                    <p style="font-size: 20px;">02:00 人數: 9999</p>
                                    <p style="font-size: 20px;">03:00 人數: 9999</p>
                                    <p style="font-size: 20px;">04:00 人數: 9999</p>
                                    <p style="font-size: 20px;">05:00 人數: 9999</p>
                                </div>

                                <div class="col-md-6">
                                    <p style="font-size: 20px;">06:00 人數: 9999</p>
                                    <p style="font-size: 20px;">07:00 人數: 9999</p>
                                    <p style="font-size: 20px;">08:00 人數: 9999</p>
                                    <p style="font-size: 20px;">09:00 人數: 9999</p>
                                    <p style="font-size: 20px;">10:00 人數: 9999</p>
                                    <p style="font-size: 20px;">11:00 人數: 9999</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
                            <div class="form-group">
                                <label>下午</label>
                            </div>

                            <div style="text-align: center;">
                                <div class="col-md-6">
                                    <p style="font-size: 20px;">12:00 人數: 9999</p>
                                    <p style="font-size: 20px;">13:00 人數: 9999</p>
                                    <p style="font-size: 20px;">14:00 人數: 9999</p>
                                    <p style="font-size: 20px;">15:00 人數: 9999</p>
                                    <p style="font-size: 20px;">16:00 人數: 9999</p>
                                    <p style="font-size: 20px;">17:00 人數: 9999</p>
                                </div>

                                <div class="col-md-6">
                                    <p style="font-size: 20px;">18:00 人數: 9999</p>
                                    <p style="font-size: 20px;">19:00 人數: 9999</p>
                                    <p style="font-size: 20px;">20:00 人數: 9999</p>
                                    <p style="font-size: 20px;">21:00 人數: 9999</p>
                                    <p style="font-size: 20px;">22:00 人數: 9999</p>
                                    <p style="font-size: 20px;">23:00 人數: 9999</p>
                                </div>
                            </div>

                        </div>
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
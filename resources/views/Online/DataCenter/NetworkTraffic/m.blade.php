@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div id="main_right" class="col-md-12" style="margin-top: 55px;">
        <div class="container">

            <div class="row" style="padding-top: 20px;">
                <div class="col-md-4">
                    <a href="{{ url('onlinedatacenternetworktraffic/y') }}" class="btn btn-warning">返回</a>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p style="font-size: 30px;">電商-網路流量(月)</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="border-bottom: 2px solid #dddddd;">
                    <div class="form-group">
                        <h3>{{ $y }}年{{ $m }}月</h3>
                    </div>
                    @for($j=1; $j<=31; $j++)
                        <div class="col-md-2" style="padding-left: 0px;margin-bottom: 20px;">
                            <a href="{{ route('onlinedatacenternetworktrafficD',[$j, $m, $y]) }}" style="font-size: 15px;" class="btn btn-block btn-primary">
                                <span style="font-size: 20px;">{{ $j }}日</span>
                                <br>
                                <span>瀏覽人數: 999999</span>
                            </a>
                        </div>
                    @endfor
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
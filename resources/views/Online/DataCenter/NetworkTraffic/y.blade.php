@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div id="main_right" class="col-md-12" style="margin-top: 55px;">
        <div class="container">

            <div class="row" style="padding-top: 20px;">
                <div class="col-md-4">
                    <a href="{{ url('onlinedatacenter') }}" class="btn btn-warning">返回</a>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p style="font-size: 30px;">電商-網路流量(年)</p>
                </div>
            </div>

            <div class="row">
                @for($k=2; $k>=0; $k--)
                <div class="col-md-12" style="border-bottom: 2px solid #dddddd;">
                    <div class="form-group">
                        <h3>{{ 2018+$k }} ( 瀏覽總數: 9999 人 )</h3>
                    </div>
                    @for($j=1; $j<=12; $j++)
                        <div class="col-md-2" style="padding-left: 0px;margin-bottom: 20px;">
                            <a href="{{ route('onlinedatacenternetworktrafficM', [$j, (2018+$k)] ) }}" class="btn btn-block btn-primary">{{ $j }}月( 9999人)</a>
                        </div>
                    @endfor
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
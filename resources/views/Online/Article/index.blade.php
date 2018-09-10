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
                            <p style="font-size: 30px;">電商-文章設定</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <a href="{{ url('onlinearticle/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">新增文章</a>
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>照片</th>
                                    <th>點擊率</th>
                                    <th>標題</th>
                                    <th>類型</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @for($i=0;$i<10;$i++)
                                    <tr style="cursor: default;">
                                        <td style="width:20%;">
                                            <img src="http://placehold.it/1170x613" style="width:100%;">
                                        </td>
                                        <td style="font-size: 20px;">9999</td>
                                        <td style="font-size: 20px;">我是標題</td>
                                        <td style="font-size: 20px;">我是類型</td>
                                        <td style="width:15%;">
                                            <a href="#" class="btn btn-block btn-primary">上架</a>
                                            <a href="#" class="btn btn-block btn-info">下架</a>
                                            <a href="#" class="btn btn-block btn-danger">刪除</a>
                                            <a href="{{ route('onlinearticle.edit', $i) }}" class="btn btn-block btn-warning">修改</a>
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
        var _main_table = $( window ).height() - 180;
        $("#main_table").css({"height":_main_table, "overflow-y": "scroll"});

    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection


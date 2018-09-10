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
                    <p style="font-size: 30px;">電商-商品大小項</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div id="" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>商品大項</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                <tr style="cursor: default;">
                                    <td style="width: 15%;font-size: 20px;">
                                        <input type="text" style="width: 100%;" class="form-control">
                                    </td>
                                    <td style="width: 15%;">
                                        <a href="#" class="btn btn-block btn-primary">新增</a>
                                    </td>
                                </tr>
                                @for($i=0;$i<10;$i++)
                                    <tr style="cursor: default;">
                                        <td style="font-size: 20px;">大項Ａ</td>
                                        <td style="">
                                            <a href="#" class="btn btn-block btn-danger">刪除</a>
                                            <a href="#" class="btn btn-block btn-warning">修改</a>
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <label>選擇大項</label>
                            {!!
                                Form::select(
                                    '',
                                    [

                                    ], 0,
                                    ['class' => 'form-control']
                                )
                            !!}
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>商品小項</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                <tr style="cursor: default;">
                                    <td style="width: 15%;font-size: 20px;">
                                        <input type="text" style="width: 100%;" class="form-control">
                                    </td>
                                    <td style="width: 15%;">
                                        <a href="#" class="btn btn-block btn-primary">新增</a>
                                    </td>
                                </tr>
                                @for($i=0;$i<10;$i++)
                                    <tr style="cursor: default;">
                                        <td style="font-size: 20px;">大項Ａ</td>
                                        <td style="">
                                            <a href="#" class="btn btn-block btn-danger">刪除</a>
                                            <a href="#" class="btn btn-block btn-warning">修改</a>
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

    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection
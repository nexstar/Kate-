@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div id="main_right" class="col-md-12" style="margin-top: 55px;">
        <div class="container">

            <div class="row" style="padding-top: 20px;">
                <div class="col-md-4">
                    <a href="{{ url('onlinecourse') }}" class="btn btn-warning">返回</a>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p style="font-size: 30px;">電商-(修改)課程</p>
                </div>
            </div>
            {!! Form::open([ 'method' => 'PUT', 'action' => ['OnlineCourseController@update', '1'] ]) !!}
            <div class="row" style="padding: 10px 50px 0px 50px;margin-bottom: 20px;">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">課程標題</label>
                        <input id="" name="" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">課程價位</label>
                        <input id="" name="" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">照片</label>
                        <input id="" type="file" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <img id="" src="http://placehold.it/1170x613" alt="" style="width: 100%;height: 210px;margin-bottom: 1px;">
                        <input id="" name="" type="hidden" value="">
                        <input id="" name="" type="hidden" value="">
                    </div>
                </div>

                <div class="col-md-6">
                    <label>時段</label>
                </div>

                <div class="col-md-6" style="text-align: right;margin-bottom: 10px;">
                    <button id="" type="button" class="btn btn-info">＋0</button>
                </div>

                <div class="col-md-12">
                    <div class="row" id="period">
                        @for($i=0;$i<4;$i++)
                            <div class="col-md-3" style="padding-left: 0px;padding-right: 0px;">
                                <div class="col-md-12" style="text-align: right;">
                                    <i style="cursor: pointer;" class="fas fa-trash-alt"></i>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>月份</label>
                                        {!!
                                           Form::select(
                                               'month[]',
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">日期</label>
                                        {!!
                                            Form::select(
                                                'day[]',
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">小時</label>
                                        {!!
                                            Form::select(
                                                'hour[]',
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
                        @endfor
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>內容</label>
                        <textarea id="" name="" rows="10" style="width:100%;resize:none;border-color: #dddddd;"></textarea>
                    </div>
                </div>

                <div class="col-md-6" style="height: 34px;padding-top: 5px;margin-bottom: 10px;">
                    <label>介紹標題</label>
                </div>

                <div class="col-md-6" style="text-align: right;margin-bottom: 10px;">
                    {{--<button id="addgc" class="btn btn-info">＋</button>--}}
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addgc">+</button>
                </div>

                <div class="modal fade" id="addgc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">增加介紹</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="margin-bottom: 2px;">
                                    <div class="col-md-6">
                                        <input id="modaltitle" type="text" class="form-control" placeholder="標題">
                                    </div>
                                    <div class="col-md-6">
                                        <input id="modalpicload" type="file" accept="image/*" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <img id="modalimg" src="http://placehold.it/1170x613" style="width: 100%;height: 210px;margin-bottom: 1px;">
                                    <textarea style="resize: none;" id="modalcontents" rows="5" placeholder="內容" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-primary">儲存</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="groupcontents">
                    <div class="col-md-12">
                        <p>請新增介紹。</p>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12" style="text-align: right;">
                    <button type="button" class="btn btn-primary">送出</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript">

    </script>

    <style type="text/css">

    </style>
@endsection
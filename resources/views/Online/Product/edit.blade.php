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
                    <p style="font-size: 30px;">電商-(修改)商品</p>
                </div>
            </div>
            {!! Form::open([ 'method' => 'POST', 'action' => 'OnlineProductController@store', 'files' => true ]) !!}
            <div class="row" style="padding: 10px 50px 0px 50px;margin-bottom: 20px;">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">商品名稱</label>
                        <input id="" name="" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">商品價位</label>
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
                    <label>小提示</label>
                </div>

                <div class="col-md-6" style="text-align: right;margin-bottom: 10px;">
                    <button id="" type="button" class="btn btn-info">＋6</button>
                </div>

                <div class="col-md-12" style="margin-bottom: 20px;">
                    <div class="row">
                        @for($i=0;$i<6;$i++)
                            <div class="col-md-4" style="padding-left: 0px;padding-right: 0px;margin-bottom: 10px;">
                                <div class="col-md-12" style="text-align: right;">
                                    <i style="cursor: pointer;" class="fas fa-trash-alt"></i>
                                    <input type="text" value="" class="form-control">
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="col-md-4" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label>大項</label>
                        {!!
                            Form::select(
                                '',
                                [

                                ], 0,
                                ['class' => 'form-control']
                            )
                        !!}
                    </div>
                </div>

                <div class="col-md-4" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label>小項</label>
                        {!!
                            Form::select(
                                '',
                                [

                                ], 0,
                                ['class' => 'form-control']
                            )
                        !!}
                    </div>
                </div>

                <div class="col-md-4" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label>紅利</label>
                        <input type="text" value="" class="form-control">
                    </div>
                </div>

                <div class="col-md-4" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label>加購價</label>
                        <input type="text" value="" class="form-control">
                    </div>
                </div>

                <div class="col-md-4" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label>庫存</label>
                        <input type="text" value="" class="form-control">
                    </div>
                </div>

                <div class="col-md-4" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label>預計上架日期</label>
                        <input type="text" value="" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <label>加購商品</label>
                </div>

                <div class="col-md-6" style="text-align: right;margin-bottom: 10px;">
                    <button id="" type="button" class="btn btn-info">＋3</button>
                </div>

                <div class="row" style="padding-right: 15px;padding-left: 15px;">
                    @for($i=0;$i<3;$i++)
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>第一個加購</label>
                                <i style="cursor: pointer;float: right;" class="fas fa-trash-alt"></i>
                                <div style="clear: both;"></div>
                                {!!
                                   Form::select(
                                       '',
                                       [

                                       ], 0,
                                       ['class' => 'form-control']
                                   )
                               !!}
                                <input type="text" value="" placeholder="加購金" class="form-control">
                            </div>
                        </div>
                    @endfor
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
                                <button onclick="modelsave()" type="button" class="btn btn-primary">儲存</button>
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
                    <button type="button" href="#" class="btn btn-primary">送出</button>
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
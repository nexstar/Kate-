@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">
            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">

                <div class="row" style="padding-top: 20px;">
                    <div class="col-md-4 col-md-offset-4" style="text-align: center;">
                        <p style="font-size: 30px;">電商-首頁設定</p>
                    </div>
                </div>

                <div class="row" style="margin:20px 0px;">
                    <p>工具說明</p>
                    <p>幻燈片：</p>
                    <p>熱銷商品：</p>
                    <p>熱門文章：</p>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>幻燈片</label>
                        </div>
                    </div>
                    @for($i=0; $i<3; $i++)
                    <div class="col-md-4" style="text-align: center;">
                        <div class="thumbnail">
                            <span>1號.幻燈片</span>
                            <img style="margin: 5px 0px;width: 100%;" src="http://placehold.it/1170x613" alt="#">
                            <button class="btn btn-block btn-warning">修改</button>
                        </div>
                    </div>
                    @endfor
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>熱銷商品</label>
                        </div>
                    </div>
                    @for($i=0; $i<4; $i++)
                        <div class="col-md-3" style="text-align: center;">
                            <div class="thumbnail">
                                <span>1號.熱銷商品</span>
                                <img style="margin: 5px 0px;width: 100%;" src="http://placehold.it/1170x613" alt="#">
                                <button class="btn btn-block btn-warning">修改</button>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>熱門文章</label>
                        </div>
                    </div>
                    @for($i=0; $i<4; $i++)
                        <div class="col-md-3" style="text-align: center;">
                            <div class="thumbnail">
                                <span>1號.熱門文章</span>
                                <img style="margin: 5px 0px;width: 100%;" src="http://placehold.it/1170x613" alt="#">
                                <button class="btn btn-block btn-warning">修改</button>
                            </div>
                        </div>
                    @endfor
                </div>

            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $("#main_left").css({ "height" : ($( document ).height()) });
    </script>

    <style type="text/css">

    </style>
@endsection


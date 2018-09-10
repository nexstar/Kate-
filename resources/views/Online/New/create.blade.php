@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">

            <div id="main_right" class="col-md-12">

                <div class="row" style="margin: 20px 80px 0px 80px;">
                    <div class="col-md-4">
                        <a href="{{ url('onlinenew') }}" class="btn btn-warning">返回</a>
                    </div>
                    <div class="col-md-4" style="text-align: center;">
                        <p style="font-size: 30px;">電商-(新增)新聞</p>
                    </div>
                    <div class="col-md-4" style="text-align: right;">
                        <a href="#" class="btn btn-primary">送出</a>
                    </div>

                    <div id="newsleft" class="col-md-6">
                        <div class="form-group">
                            <label for="name">新聞標題</label>
                            <input id="title" name="title" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">新聞日期</label>
                            <input id="date" name="date" type="text" class="form-control">
                        </div>
                        <div class="col-md-6" style="padding-left: 0px;">
                            <div class="form-group">
                                <label for="name">照片</label>
                                <input id="picload" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-right: 0px;">
                            <div class="form-group">
                                <img id="imagesrc" src="http://placehold.it/1170x613" alt="" style="width: 100%;margin-bottom: 1px;">
                                <input id="imagesrcupload" name="imagesrcupload" type="hidden" value="">
                                <input id="imagesrcuploadFe" name="imagesrcuploadFe" type="hidden" value="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="col-md-6" style="padding-right: 0px;">
                            <div class="form-group">
                                <label for="name">照片</label>
                                <input id="" type="file" class="form-control">
                            </div>
                        </div>

                        <div id="newsright" class="col-md-6" style="overflow-y: scroll;">
                            <div class="form-group">
                                <img   id="" src="http://placehold.it/1170x4000" style="width: 100%;margin-bottom: 1px;">
                                <input id="" name="" type="hidden" value="">
                                <input id="" name="" type="hidden" value="">
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
        let _newsleft = ($("#newsleft").height() + 300);
        $("#newsright").css({ 'height' : _newsleft});
    </script>

    <style type="text/css">

    </style>
@endsection


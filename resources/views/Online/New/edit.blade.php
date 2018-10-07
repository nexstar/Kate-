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
                        <p style="font-size: 30px;">電商-(修改)新聞</p>
                    </div>
                    {!! Form::open(['id' => 'editNewsform', 'method' => 'PUT', 'action' => ['OnlineNewController@update', $TestData['_id']] ]) !!}
                    <div class="col-md-4" style="text-align: right;">
                        <button onclick="newsave()" type="button" class="btn btn-primary">送出</button>
                    </div>
                    <div id="newsleft" class="col-md-6">
                        <div class="form-group">
                            <label>新聞標題</label>
                            <input value="{{ $TestData['title'] }}" id="title" name="title" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>參考</label>
                            <input value="{{ $TestData['ref'] }}" id="ref" name="ref" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>新聞日期</label>
                            <input value="{{ $TestData['date'] }}" id="date" name="date" type='text' class="form-control"/>
                        </div>
                        <div class="col-md-6" style="padding-left: 0px;">
                            <div class="form-group">
                                <label>照片</label>
                                <input id="Newpicloadleft" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-right: 0px;">
                            <div class="form-group">
                                <img id="imagesrcleft" src="{{ $TestData['left']['url'] }}" alt="" style="width: 100%;margin-bottom: 1px;">
                                <input id="newssrcleft" name="newssrcleft" type="hidden" value="{{ $TestData['left']['url'] }}">
                                <input id="newsfeleft" name="newsfeleft" type="hidden" value="{{ $TestData['left']['fe'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6" style="padding-right: 0px;">
                            <div class="form-group">
                                <label>照片</label>
                                <input id="Newpicloadright" type="file" class="form-control">
                            </div>
                        </div>
                        <div id="newsright" class="col-md-6" style="overflow-y: scroll;padding-right: 0px;">
                            <div class="form-group">
                                <img   id="imagesrcright" src="{{ $TestData['right']['url'] }}" style="width: 100%;margin-bottom: 1px;">
                                <input id="newssrcright" name="newssrcright" type="hidden" value="{{ $TestData['right']['url'] }}">
                                <input id="newsferight" name="newsferight" type="hidden" value="{{ $TestData['right']['fe'] }}">
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        let _newsleft = ($("#newsleft").height() + 270);
        $("#newsright").css({ 'height' : _newsleft});

        function newsave() {
            let _title = $("#title").val();
            let _date = $("#date").val();
            let _newssrcleft = $("#newssrcleft").val();
            let _newssrcright = $("#newssrcright").val();
            let _ref = $("#ref").val();
            if(_title === ""){
                alert("標題未填寫");
            }else{
                if(_ref === ""){
                    alert("參考網址未填寫");
                }else{
                    if(_date === ""){
                        alert("日期未填寫");
                    }else{
                        if(_newssrcleft.length < 100){
                            alert("封面照片尚未上傳");
                        }else{
                            if(_newssrcright.length < 100){
                                alert("內容照片尚未上傳");
                            }else{
                                if(confirm("確定修改新聞??")){
                                    $("#editNewsform").submit();
                                };
                            };
                        };
                    };
                };
            };
        };

        function readURL(input,type){
            if(input.files && input.files[0]){
                let reader = new FileReader();
                reader.onload = function(e){
                    if("left" === type){
                        $("#imagesrcleft").attr('src', e.target.result);
                        document.getElementById("newssrcleft").value = e.target.result;
                    }else{
                        $("#imagesrcright").attr('src', e.target.result);
                        document.getElementById("newssrcright").value = e.target.result;
                    };
                };
                reader.readAsDataURL(input.files[0]);
            };
        };

        $("#Newpicloadleft").change(function () {
            readURL(this,'left');
            document.getElementById("newsfeleft").value = $(this).val().split('.').pop();
        });

        $("#Newpicloadright").change(function () {
            readURL(this,'right');
            document.getElementById("newsferight").value = $(this).val().split('.').pop();
        });

        $(function () {
            $('#date').datetimepicker({
                format:"YYYY/M/D, h:mm:ss A"
            });
        });

    </script>

    <style type="text/css">

    </style>
@endsection


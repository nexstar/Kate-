@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div id="main_right" class="col-md-12" style="margin-top: 55px;">
        <div class="container">

            <div class="row" style="padding-top: 20px;">
                <div class="col-md-4">
                    <a href="{{ url('fblive') }}" class="btn btn-warning">返回</a>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p style="font-size: 30px;">綠寵物-直播(修改)</p>
                </div>
            </div>

            {!! Form::open([ 'id' => 'editfblivefrom', 'method' => 'PUT', 'action' => ['fblivecontroller@update',$DataToView['id']] ]) !!}
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>標題</label>
                        <input value="{{ $DataToView['title'] }}" id="title" name="title" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>直播時間</label>
                        <input style="cursor: pointer;" id="date" name="date" type="text" value="{{ $DataToView['date'] }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>照片</label>
                        <input id="titlepicload" type="file" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <img id="imagesrc" src="{{ $DataToView['src'] }}" style="width: 100%;height: 210px;margin-bottom: 1px;">
                        <input id="imagesrcupload" name="imagesrcupload" type="hidden" value="{{ $DataToView['src'] }}">
                        <input id="imagesrcuploadFe" name="imagesrcuploadFe" type="hidden" value="{{ $DataToView['fe'] }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>內容(不能超過90字)</label>
                        <textarea id="contents" name="contents" rows="10" style="width:100%;resize:none;border-color: #dddddd;">{{ $DataToView['contents'] }}</textarea>
                    </div>
                </div>

            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12" style="text-align: right;">
                    <button onclick="btnToStore()" type="button"class="btn btn-primary">送出</button>
                </div>
            </div>

            {!! Form::close() !!}

        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript">

        function btnToStore() {
            $_title = $("#title").val();
            $_date  = $('#date').val();
            $_src   = $('#imagesrcupload').val();
            $_contents = $('#contents').val();

            if($_title == ""){
                alert("尚未填寫標題");
            }else{
                if($_date == ""){
                    alert("尚未填寫時間");
                }else{
                    if($_src.length <= 10){
                        alert("尚未上傳封面照");
                    }else{
                        if($_contents == ""){
                            alert("尚未填寫內容");
                        }else{
                            if(confirm("確定修改新臉書直播")){
                                $("#editfblivefrom").submit();
                            };
                        };
                    };
                };
            };

        };

        function readURL(input){
            if(input.files && input.files[0]){
                let reader = new FileReader();
                reader.onload = function(e){
                    $("#imagesrc").attr('src', e.target.result);
                    document.getElementById("imagesrcupload").value = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            };
        };

        $("#titlepicload").change(function () {
            readURL(this);
            document.getElementById("imagesrcuploadFe").value = $(this).val().split('.').pop();
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
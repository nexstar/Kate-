@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div id="main_right" class="col-md-12" style="margin-top: 55px;">
        <div class="container">

            <div class="row" style="padding-top: 20px;">
                <div class="col-md-4">
                    <a href="{{ url('greenpetblog') }}" class="btn btn-warning">返回</a>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p style="font-size: 30px;">綠寵物-Blog(修改)</p>
                </div>
            </div>

            {!! Form::open([ 'id' => 'editgreenpetblogfrom', 'method' => 'PUT', 'action' => ['GreenPetBlogController@update', $DataToView['id'] ] ]) !!}
            <div class="row" style="padding: 10px 50px 0px 50px;margin-bottom: 20px;">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>標題</label>
                        <input value="{{ $DataToView['title'] }}" id="title" name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>網址</label>
                        <input value="{{ ( $DataToView['link'] == "沒有連結" )? "" : $DataToView['link'] }}" id="link" name="link" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>照片</label>
                        <input id="titlepicload" type="file" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <img id="imagesrc" src="{{ $DataToView['src']  }}" alt="" style="width: 100%;height: 210px;margin-bottom: 1px;">
                        <input id="imagesrcupload" name="imagesrcupload" type="hidden" value="{{ $DataToView['src'] }}">
                        <input id="imagesrcuploadFe" name="imagesrcuploadFe" type="hidden" value="{{ $DataToView['fe'] }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">內容(不能超過90個字)</label>
                        <textarea id="contents" name="contents" rows="10" style="width:100%;resize:none;border-color: #dddddd;">{{ $DataToView['contents'] }}</textarea>
                    </div>
                </div>

            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12" style="text-align: right;">
                    <button onclick="TitleSubmit()" type="button" href="#" class="btn btn-primary">送出</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
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

        function TitleSubmit() {
            let _title    = $("[name=title]").val();
            let _imagesrc = $("#imagesrcupload").val();
            let _contents = $("[name=contents]").val();

            if( (_contents.length > 90) || (_contents.length <= 0) ){
                alert('內容格式錯誤...');
                $("[name=contents]").val();
            }else{
                if(_title == ""){
                    alert("綠寵物Blog標題未填");
                }else{
                    if(_imagesrc.length < 100){
                        alert("綠寵物Blog封面未上傳");
                    }else{
                        if(_contents == ""){
                            alert("內容標題未填");
                        }else{
                            if(confirm("確定修改綠寵物Blog??")){
                                $("#editgreenpetblogfrom").submit();
                            };
                        };
                    };
                };
            };
        };
    </script>

    <style type="text/css">

    </style>
@endsection
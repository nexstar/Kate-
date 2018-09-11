@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div id="main_right" class="col-md-12" style="margin-top: 55px;">
        <div class="container">

            <div class="row" style="padding-top: 20px;">
                <div class="col-md-4">
                    <a href="{{ url('onlinearticle') }}" class="btn btn-warning">返回</a>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <p style="font-size: 30px;">電商-(新增)文章</p>
                </div>
            </div>

            {!! Form::open([ 'id' => 'createarticlefrom', 'method' => 'POST', 'action' => 'OnlineArticleController@store', 'files' => true ]) !!}
            <div class="row" style="padding: 10px 50px 0px 50px;margin-bottom: 20px;">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">文章標題</label>
                        <input id="title" name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">文章類型</label>
                        {!!
                            Form::select(
                                'articletype',
                                [
                                    1 => '春', 2 => '夏', 3 => '秋',
                                    4 => '冬', 5 => '照顧小秘訣'
                                ], 0,
                                ['class' => 'form-control']
                            )
                        !!}

                    </div>
                    <div class="form-group">
                        <label for="name">照片</label>
                        <input id="titlepicload" type="file" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <img id="imagesrc" src="http://placehold.it/1170x613" alt="" style="width: 100%;height: 210px;margin-bottom: 1px;">
                        <input id="imagesrcupload" name="imagesrcupload" type="hidden" value="">
                        <input id="imagesrcuploadFe" name="imagesrcuploadFe" type="hidden" value="">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">內容</label>
                        <textarea id="contents" name="contents" rows="10" style="width:100%;resize:none;border-color: #dddddd;"></textarea>
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
                                <button onclick="modelsave()" type="button" class="btn btn-primary">儲存</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="groupcontents">
                    <div class="col-md-12">
                        <p>請新增介紹。</p>
                    </div>
                    {{--<div class="col-md-6">--}}
                    {{--<div class="col-md-11" style="padding-left: 0;">--}}
                    {{--<lable>1號</lable>--}}
                    {{--<input id="gctitle1" name="gctitle[]" type="text" class="form-control" placeholder="標題">--}}
                    {{--<div class="form-group">--}}
                    {{--<div id="onclickpic1" onclick="onclickpic('1')" style="cursor:pointer;width:100%;height: 50px;text-align: center;padding-top: 3%;border-right: 1px solid #dddddd;border-left: 1px solid #dddddd;">按我增加照片</div>--}}
                    {{--<img name="gcimg[]" id="gcimg1" src="" style="width: 100%;height: 210px;margin-bottom: 1px;display: none;">--}}
                    {{--<textarea name="contents[]" id="contents1" rows="5" style="width:100%;resize:none;border-color: #dddddd;" placeholder="內容" class="form-control"></textarea>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-1">--}}
                    {{----}}
                    {{--<i id="gctrash1" onclick="gctrash()" style="cursor: pointer;" class="fas fa-trash-alt"></i>--}}
                    {{----}}
                    {{--<i id="gcpen1" onclick="gcpen('1')" style="margin-top: 20px;cursor: pointer;" class="fas fa-pen"></i>--}}
                    {{--</div>--}}
                    {{--</div>--}}

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

        function readURL(input, type){
            if(input.files && input.files[0]){
                let reader = new FileReader();
                reader.onload = function(e){
                    switch(type) {
                        case "modal":
                            $("#modalimg").attr('src', e.target.result).css({ "display" : "block"});
                            break;
                        case "title":
                            $("#imagesrc").attr('src', e.target.result);
                            document.getElementById("imagesrcupload").value = e.target.result;
                            break;
                    };
                };
                reader.readAsDataURL(input.files[0]);
            };
        };

        var arraygc_id       = [];
        var arraygc_title    = [];
        var arraygc_src      = [];
        var arraygc_contents = [];
        var arraygc_fe       = [];

        $("#modalpicload").change(function () {
            readURL(this, 'modal');
            arraygc_fe.push($(this).val().split('.').pop());
        });

        $("#titlepicload").change(function () {
            readURL(this, 'title');
            document.getElementById("imagesrcuploadFe").value = $(this).val().split('.').pop();
        });

        function modelsave() {
            let title    = $("#modaltitle").val();
            let imgsrc   = $("#modalimg")[0].src;
            let contents = $("#modalcontents").val();

            if(imgsrc.length < 100){
                alert("照片尚未上傳");
            }else{
                if(title == ""){
                    alert("標題尚未填寫");
                }else{
                    if(contents == ""){
                        alert("內容尚未填寫");
                    }else{
                        $("#addgc").modal('hide');
                        $("#modalpicload").val('');
                        $("#modaltitle").val("");
                        $("#modalimg")[0].src = "http://placehold.it/1170x613";
                        $("#modalcontents").val("");

                        arraygc_id.push(Date.now());
                        arraygc_title.push(title);
                        arraygc_src.push(imgsrc);
                        arraygc_contents.push(contents);

                        gc_update();
                    };
                };
            };
        };

        function gc_update() {
            $("#groupcontents").empty('');

            if(arraygc_id.length <= 0){
                $("#groupcontents").html('<div class="col-md-12"><p>請新增介紹。</p></div>');
            };

            for($i=0; $i<arraygc_id.length; $i++){
                getgcdiv(arraygc_id[$i], arraygc_src[$i], arraygc_title[$i], arraygc_contents[$i], arraygc_fe[$i]);
            };
        };

        function getgcdiv($i, $_src, $_title, $_contents, $_fe) {
            let addgcdiv = "";
            addgcdiv += '<div class="col-md-6">';
            addgcdiv += '<div class="col-md-11" style="padding-left: 0;">';
            // addgcdiv += '<lable>'+($i+1)+'號</lable>';
            addgcdiv += '<input value="'+$_title+'" name="gcdivtitle[]" type="text" class="form-control">';
            addgcdiv += '<div class="form-group">';
            addgcdiv += '<img src="'+$_src+'" style="width: 100%;height: 210px;margin-bottom: 1px;">';
            addgcdiv += '<input type="hidden" name="gcsrc[]" value="'+$_src+'">';
            addgcdiv += '<input type="hidden" name="gcsrcfe[]" value="'+$_fe+'">';
            addgcdiv += '<textarea name="gcdivcontents[]" rows="5" style="width:100%;resize:none;border-color: #dddddd;" class="form-control">'+$_contents+'</textarea>';
            addgcdiv += '</div>';
            addgcdiv += '</div>';
            addgcdiv += '<div class="col-md-1">';
            addgcdiv += '<i onclick="gctrash('+($i)+')" style="cursor: pointer;" class="gctrash fas fa-trash-alt"></i>';
            // addgcdiv += '<i id="gcpen'+($i+1)+'" onclick="gcpen('+($i+1)+')" style="margin-top: 20px;cursor: pointer;" class="gcpen fas fa-pen"></i>';
            addgcdiv += '</div>';
            addgcdiv += '</div>';
            $("#groupcontents").append(addgcdiv);
        };

        function gctrash($id){
            let tmp_id       = [];
            let tmp_title    = [];
            let tmp_src      = [];
            let tmp_contents = [];
            let tmp_fe       = [];

            for($i=0; $i<arraygc_id.length; $i++){
                if(arraygc_id[$i] != $id){
                    tmp_id.push(arraygc_id[$i]);
                    tmp_title.push(arraygc_src[$i]);
                    tmp_src.push(arraygc_title[$i]);
                    tmp_contents.push(arraygc_contents[$i]);
                    tmp_fe.push(arraygc_fe[$i]);
                };
            };

            arraygc_id       = tmp_id;
            arraygc_src      = tmp_title;
            arraygc_title    = tmp_src;
            arraygc_contents = tmp_contents;
            arraygc_fe       = tmp_fe;
            gc_update();
        };

        function TitleSubmit() {
            let _title         = $("[name=title]").val();
            let _articletype   = $("[name=articletype]").val();
            let _imagesrc      = $("#imagesrc")[0].src;
            let _contents      = $("[name=contents]").val();

            if(_title == ""){
                alert("文章標題未填");
            }else{
                if(_imagesrc.length < 100){
                    alert("文章封面未上傳");
                }else{
                    if(_contents == ""){
                        alert("內容標題未填");
                    }else{
                        if(arraygc_id.length <= 0){
                            alert("文章介紹上傳");
                        }else{
                            if(confirm("確定新增文章??")){
                                $("#createarticlefrom").submit();
                            };
                        };
                    };
                };
            };

        };

        // function gcpen($id){
        //     console.log($("#gcpen"+$id));
        // };

    </script>

    <style type="text/css">

    </style>
@endsection
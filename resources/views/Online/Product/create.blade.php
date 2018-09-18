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
                    <p style="font-size: 30px;">電商-(新增)商品</p>
                </div>
            </div>
            {!! Form::open([ 'id' => 'createproductfrom','method' => 'POST', 'action' => 'OnlineProductController@store', 'files' => true ]) !!}
                <div class="row" style="padding: 10px 50px 0px 50px;margin-bottom: 20px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">商品名稱</label>
                            <input id="title" name="title" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">商品價位</label>
                            <input id="money" name="money" max="9999" min="1" type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">照片</label>
                            <input id="titlepicload" type="file" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <img id="imagesrc" src="http://placehold.it/1170x613" style="width: 100%;height: 210px;margin-bottom: 1px;">
                            <input id="imagesrcupload" name="imagesrcupload" type="hidden" value="">
                            <input id="imagesrcuploadFe" name="imagesrcuploadFe" type="hidden" value="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label>小提示</label>
                    </div>

                    <div class="col-md-6" style="text-align: right;margin-bottom: 10px;">
                        <button onclick="btnadddivsix()" type="button" class="btn btn-info">＋
                            <span id="adddivsixspan">
                            </span>
                        </button>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <div class="row" id="divprompt">
                            <div class="col-md-12">
                                <p>請新增小提示。</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <div class="form-group">
                            <label>大項</label>
                            {!!
                                Form::select(
                                    'pdbigitem', $tmpbigitem , '請選擇大項',
                                    ['class' => 'form-control','id' => 'pdbigitem']
                                )
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <div class="form-group">
                            <label>小項</label>
                            <select name="pdsmallitem" id="pdsmallitem" class="form-control"></select>
                        </div>
                    </div>

                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <div class="form-group">
                            <label>紅利</label>
                            <input max="999" min="1" type="number" id="bouns" name="bouns" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <div class="form-group">
                            <label>庫存</label>
                            <input max="999" min="1"  type="number" id="inventory" name="inventory" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <div class="form-group">
                            <label>預計上架日期</label>
                            <input id="date" name="date" type="text" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label>加購商品</label>
                    </div>

                    <div class="col-md-6" style="text-align: right;margin-bottom: 10px;">
                        <button onclick="btnaddproduct()" type="button" class="btn btn-info">＋
                            <span id="addproductspan"></span>
                        </button>
                    </div>

                    <div id="pdmodel" class="row" style="padding-right: 15px;padding-left: 15px;">
                        <div class="col-md-12"><p>請新增小提示。</p></div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>內容</label>
                            <textarea id="contents" name="contents" rows="10" style="width:100%;resize:none;border-color: #dddddd;"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6" style="height: 34px;padding-top: 5px;margin-bottom: 10px;">
                        <label>介紹標題</label>
                    </div>

                    <div class="col-md-6" style="text-align: right;margin-bottom: 10px;">
                        <button onclick="btnaddgc()" type="button" class="btn btn-info btn-lg">+</button>
                    </div>

                    <div id="groupcontents">
                        <div class="col-md-12">
                            <p>請新增介紹。</p>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12" style="text-align: right;">
                        <button onclick="TitleSubmit()" type="button" href="#" class="btn btn-primary">送出</button>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="modal fade" id="addgc" tabindex="-1" role="dialog">
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
            <div class="modal fade" id="addpdmodel" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">增加加購商品</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>商品大項</label>
                                {!!
                                    Form::select('', $tmpbigitem, '選擇大項', [
                                        'class' => 'form-control', 'id' => 'modelbigitem'
                                    ]);
                                !!}
                            </div>
                            <div class="form-group">
                                <label>商品小項</label>
                                <select id="modelsmallitem" class="form-control"></select>
                            </div>
                            <div class="form-group">
                                <label>商品加購金</label>
                                <input id="modeladdmoney" max="9999" min="1" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button onclick="modeladdpdsave()" type="button" class="btn btn-primary">儲存</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addsixspangc" tabindex="-1" role="dialog" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">增加小提示</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="margin-bottom: 2px;">
                                <div class="col-md-12">
                                    <input id="modaldivsixtitle" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button onclick="modelsixspansave()" type="button" class="btn btn-primary">儲存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript">

        {{-- 大項 --}}

        $("#pdbigitem").change(function () {
            let _pdbigitemid = $(this).val();
            let _ajaxsuccessdata;
            if( _pdbigitemid != ""){
                $.ajax({
                    type:'GET',
                    url: "{{ url('OnlineProductController/small') }}"+'/'+_pdbigitemid,
                    data: {},
                    async: false,
                    success:function(data){
                        _ajaxsuccessdata = JSON.parse(data);
                    }
                });
                $("#pdsmallitem").empty();
                let $tmpsmallmodel = "";
                $.each(_ajaxsuccessdata, function (key,val) {
                    $tmpsmallmodel += '<option value="'+val+'" selected>'+val+'</option>';
                });
                $("#pdsmallitem").append($tmpsmallmodel);
            };
        });

        {{-- 加購模組 --}}
        $("#modelbigitem").change(function () {
            let _bigitemid = $(this).val();
            let _ajaxsuccessdata;
            if( _bigitemid != ""){
                $.ajax({
                    type:'GET',
                    url: "{{ url('OnlineProductController/small') }}"+'/'+_bigitemid,
                    data: {},
                    async: false,
                    success:function(data){
                        _ajaxsuccessdata = JSON.parse(data);
                    }
                });
                $("#modelsmallitem").empty();
                let $tmpsmallmodel = "";
                $.each(_ajaxsuccessdata, function (key,val) {
                    $tmpsmallmodel += '<option value="'+val+'" selected>'+val+'</option>';
                });
                $("#modelsmallitem").append($tmpsmallmodel);
            };
        });

        $("#modeladdmoney").change(function () {
            if($(this).val() >= 9999){
                alert("價格超過9999");
                $(this).val('');
            };
        });

        function modeladdpdsave(){
            let _modelbigitem  = $("#modelbigitem").val();
            let _modelsmallitem  = $("#modelsmallitem").val();
            let _modeladdmoney = $("#modeladdmoney").val();

            if( (_modelbigitem == "請選擇大項") || (String(_modelbigitem) == "undefined") ){
                alert("加購大項未選");
            }else{
                if( (_modelsmallitem  == "請選擇小項") || (String(_modelsmallitem) == "null") ){
                    alert("加購小項未選");
                }else{
                    if(_modeladdmoney <= 0){
                        alert("加購金不能底於零");
                    }else{
                        if(confirm("確定新增加購模組")){
                            maxaddpdspan--;
                            divaddpttitle.push(_modelsmallitem);
                            divaddpmoney.push(_modeladdmoney);
                            update_addpdmodel();
                            $("#addpdmodel").modal('hide');
                        };
                    };
                };
            };

        };

        {{-- 加購商品 --}}
        var maxaddpdspan = 3;
        $("#addproductspan").html(maxaddpdspan);

        var divaddptid = [];
        var divaddpttitle = [];
        var divaddpmoney = [];

        function btnaddproduct() {
            if(maxaddpdspan <= 0) return;
            if(maxaddpdspan >= 4){
                window.location.href = "create";
            };
            $("#modelbigitem").val('請選擇大項');
            $("#modelsmallitem").empty();
            $("#addpdmodel").modal();
            divaddptid.push(Date.now()+1);
        };

        function update_addpdmodel() {
            $("#pdmodel").empty();

            if(divaddptid.length <= 0){
                $("#pdmodel").html('<div class="col-md-12"><p>請新增小提示。</p></div>');
            };

            for ($i=0; $i<divaddptid.length;$i++){
                pdmodel(divaddptid[$i],divaddpttitle[$i],divaddpmoney[$i]);
            };
            $("#addproductspan").html(maxaddpdspan);
        }

        function pdmodel($date,$title,$money) {
            $tmp = "";
            $tmp += '<div class="col-md-4">';
                $tmp += '<div class="form-group">';
                    $tmp += '<i onclick="btnrmaddpdmodel('+$date+')" style="cursor: pointer;float: right;" class="fas fa-trash-alt"></i>';
                    $tmp += '<div style="clear: both;"></div>';
                    $tmp += '<input name="pdmodeltitle[]" type="text" value="'+$title+'" style="background-color: #dddddd" class="form-control">';
                    $tmp += '<input name="pdmodelmoney[]" type="text" value="'+$money+'" style="background-color: #dddddd" class="form-control">';
                $tmp += '</div>';
            $tmp += '</div>';
            $("#pdmodel").append($tmp);
        };

        function btnrmaddpdmodel($id) {
            let tmp_id    = [];
            let tmp_title = [];
            let tmp_money = [];

            for($i=0; $i<divaddptid.length; $i++){
                if(divaddptid[$i] != $id){
                    tmp_id.push(divaddptid[$i]);
                    tmp_title.push(divaddpttitle[$i]);
                    tmp_money.push(divaddpmoney[$i]);
                };
            };

            maxaddpdspan++;
            console.log(maxaddpdspan);
            divaddptid    = tmp_id;
            divaddpttitle = tmp_title;
            divaddpmoney  = tmp_money;

            update_addpdmodel();
        };

        {{-- 小提示 --}}
            var maxspan = 6;
            $("#adddivsixspan").html(maxspan);

            var divsixmodelid = [];
            var divsixmodeltitle = [];

            function btnadddivsix(){
                if(maxspan <= 0) return;
                if(maxspan >= 7){
                    window.location.href = "create";
                };
                $("#addsixspangc").modal();
                divsixmodelid.push(Date.now());
            };

            function modelsixspansave(){
                let _modaltitle = $("#modaldivsixtitle").val();
                if(_modaltitle == ""){
                    alert("小標題不能為空");
                }else{
                    maxspan--;
                    divsixmodeltitle.push(_modaltitle);
                    $("#addsixspangc").modal('hide');
                    update_divappend();
                };
                $("#modaldivsixtitle").val('');
            };

            function update_divappend() {
                $("#divprompt").empty();

                if(divsixmodelid.length <= 0){
                    $("#divprompt").html('<div class="col-md-12"><p>請新增小提示。</p></div>');
                };

                for($i=0; $i<divsixmodelid.length;$i++){
                    divappend(divsixmodelid[$i],divsixmodeltitle[$i]);
                };
                $("#adddivsixspan").html(maxspan);
            };

            function divappend($date,$title){
                let $tmp = "";
                $tmp += '<div class="col-md-4" style="padding-left: 0px;padding-right: 0px;margin-bottom: 10px;">';
                    $tmp += '<div class="col-md-12" style="text-align: right;">';
                        $tmp += '<i onclick="rmdivsix('+$date+')" style="cursor: pointer;" class="fas fa-trash-alt"></i>';
                        $tmp += '<input value="'+$title+'" style="background-color: #dddddd;" type="text" name="prompt[]" class="form-control">';
                    $tmp += '</div>';
                $tmp += '</div>  ';
                $("#divprompt").append($tmp);
            };

            function rmdivsix($data){
                let tmp_id    = [];
                let tmp_title = [];

                for($i=0; $i<divsixmodelid.length; $i++){
                    if(divsixmodelid[$i] != $data){
                        tmp_id.push(divsixmodelid[$i]);
                        tmp_title.push(divsixmodeltitle[$i]);
                    };
                };

                maxspan++;
                divsixmodelid    = tmp_id;
                divsixmodeltitle = tmp_title;
                update_divappend();
            };

            $("#money").change(function () {
                if($(this).val() >= 9999){
                  alert("金額超過9999");
                  $(this).val('').focus();
                };
            });

        {{--Model--}}
            function readURL(input, type){
                if(input.files && input.files[0]){
                    let reader = new FileReader();
                    reader.onload = function(e){
                        switch(type) {
                            case "modal":
                                $("#modalimg").attr('src',e.target.result).css({ "display" : "block"});
                                break;
                            case "title":
                                $("#imagesrc").attr('src',e.target.result);
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

            function btnaddgc(){
                $("#addgc").modal();
            };

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
                let _title      = $("#title").val();
                let _money      = $("#money").val();
                let _imagesrc   = $("#imagesrc")[0].src;
                let _contents   = $("#contents").val();
                let _bouns      = $("#bouns").val();

                let _inventory  = $("#inventory").val();
                let _date       = $("#date").val();

                if(_title == ""){
                    alert("商品標題未填");
                }else{
                    if(_money == ""){
                        alert("商品訂價未填寫");
                    }else{
                        if(_imagesrc.length < 100){
                            alert("商品封面未上傳");
                        }else{
                            if(_bouns == ""){
                                alert("紅利未填寫");
                            }else{
                                if(_inventory == ""){
                                    alert("庫存未填寫");
                                }else{
                                    if(_date == ""){
                                        alert("預計上架未填寫");
                                    }else{
                                        if(_contents == ""){
                                            alert("內容標題未填");
                                        }else{
                                            if(arraygc_id.length <= 0){
                                                alert("文章介紹未上傳");
                                            }else{
                                                if( (divsixmodelid.length <= 0) ){
                                                    alert("小提示未上傳");
                                                }else{
                                                    if( (divaddptid.length <= 0) ){
                                                        alert("加購商品未上傳");
                                                    }else{
                                                        if(confirm("確定新增商品??")){
                                                            $("#createproductfrom").submit();
                                                        };
                                                    };
                                                };
                                            };
                                        };
                                    };
                                };
                            };
                        };
                    };
                };
            };
    //-----------------
        $(function () {
            $('#date').datetimepicker({
                format:"YYYY/M/D, h:mm:ss A"
            });
        });
    </script>

    <style type="text/css">

    </style>
@endsection
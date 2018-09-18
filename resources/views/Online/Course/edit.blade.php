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

            {!! Form::open([ 'id' => 'editcoursefrom', 'method' => 'PUT', 'action' => ['OnlineCourseController@update', '1'] ]) !!}
            <div class="row" style="padding: 10px 50px 0px 50px;margin-bottom: 20px;">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">課程標題</label>
                        <input value="{{ $TestData['title'] }}" id="title" name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">課程價位</label>
                        <input value="{{ $TestData['money'] }}" id="money" name="money" min="1" max="99999" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">照片</label>
                        <input id="titlepicload" type="file" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <img id="imagesrc" src="{{ $TestData['src'] }}" alt="" style="width: 100%;height: 210px;margin-bottom: 1px;">
                        <input value="{{ $TestData['src'] }}" id="imagesrcupload" name="imagesrcupload" type="hidden">
                        <input  value="{{ $TestData['fe'] }}" id="imagesrcuploadFe" name="imagesrcuploadFe" type="hidden">
                    </div>
                </div>

                <div class="col-md-6">
                    <label>時段</label>
                </div>

                <div class="col-md-6" style="text-align: right;margin-bottom: 10px;">
                    <button id="btnperiodedit" type="button" class="btn btn-info">＋
                        <span id="btnperioadcount"></span>
                    </button>
                </div>

                <div class="col-md-12">
                    <div class="row" id="perioddiv">
                        <div class="col-md-12">
                            <p>請新增時段。</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>內容</label>
                        <textarea id="contents" name="contents" rows="10" style="width:100%;resize:none;border-color: #dddddd;">{{ $TestData['contents'] }}</textarea>
                    </div>
                </div>

                <div class="col-md-6" style="height: 34px;padding-top: 5px;margin-bottom: 10px;">
                    <label>介紹標題</label>
                </div>

                <div class="col-md-6" style="text-align: right;margin-bottom: 10px;">
                    <button onclick="btneditCoursegc()" type="button" class="btn btn-info btn-lg">+</button>
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

            <div class="modal fade" id="editperioad" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">增加時段</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>月份</label>
                                        {!!
                                             Form::select('modelmonth',
                                                [
                                                    '1月' => '1月', '2月'  => '2月',  '3月'  => '3月',  '4月'  => '4月',
                                                    '5月' => '5月', '6月'  => '6月',  '7月'  => '7月',  '8月'  => '8月',
                                                    '9月' => '9月', '10月' => '10月', '11月' => '11月', '12月' => '12月',
                                                ], 0,['class' => 'form-control']
                                             )
                                        !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">日期</label>
                                        {!!
                                             Form::select('modelday',
                                                [
                                                    '1號'  => '1號',   '2號' => '2號',  '3號'  => '3號',  '4號'  => '4號',  '5號'  => '5號',  '6號' => '6號',
                                                    '7號'  => '7號',   '8號' => '8號',  '9號'  => '9號',  '10號' => '10號', '11號' => '11號', '12號' => '12號',
                                                    '13號' => '13號', '14號' => '14號', '15號' => '15號', '16號' => '16號', '17號' => '17號', '18號' => '18號',
                                                    '19號' => '19號', '20號' => '20號', '21號' => '21號', '22號' => '22號', '23號' => '23號', '24號' => '24號',
                                                    '25號' => '25號', '26號' => '26號', '27號' => '27號', '29號' => '28號', '29號' => '29號', '30號' => '30號',
                                                    '31號' => '31號'
                                                ], 0,['class' => 'form-control']
                                             )
                                        !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">小時</label>
                                        {!!
                                             Form::select('modelhour',
                                                [
                                                    '12:00' => '12:00', '13:00' => '13:00', '14:00' => '14:00',
                                                    '15:00' => '15:00', '16:00' => '16:00', '17:00' => '17:00',
                                                    '18:00' => '18:00', '19:00' => '19:00', '20:00' => '20:00'
                                                ], 0,['class' => 'form-control']
                                             )
                                        !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button onclick="modelperioadsave()" type="button" class="btn btn-primary">儲存</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editCoursegc" tabindex="-1" role="dialog">
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
        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript">

        {{-- 課程價錢 change--}}
        $("#money").change(function (i) {
            if($(this).val() >= 99999){
                alert("金額超過...");
                $(this).val('');
            };
        });

        {{-- 時段 --}}
        var perioadarrayid    = [];
        var perioadarraymonth = [];
        var perioadarrayday   = [];
        var perioadarrayhour  = [];
        var max;
        function modelperioadsave(){

            let _modelmonth = $('[name=modelmonth]').val();
            let _modelday   = $('[name=modelday]').val();
            let _modelhour  = $('[name=modelhour]').val();

            perioadarrayid.push(Date.now());
            perioadarraymonth.push(_modelmonth);
            perioadarrayday.push(_modelday);
            perioadarrayhour.push(_modelhour);

            $("#editperioad").modal('hide');
            update_perioad();
        };

        $("#btnperiodedit").on('click',function (i) {
            if( (max <= 0) ) return;
            $("#editperioad").modal();
        });

        function fas($removeid) {
            let tmp_id = [];
            for($i=0; $i<perioadarrayid.length; $i++){
                if(perioadarrayid[$i] != $removeid){
                    tmp_id.push(perioadarrayid[$i]);
                };
            };
            perioadarrayid = tmp_id;
            max++
            $("#btnperioadcount").html(max);
            update_perioad();
        };

        function update_perioad() {
            $("#perioddiv").empty('');

            if(perioadarrayid.length <= 0){
                $("#perioddiv").html('<div class="col-md-12"><p>請新增時段。</p></div>');
            };

            for($i=0; $i<perioadarrayid.length; $i++){
                editdivperioad(perioadarrayid[$i],perioadarraymonth[$i],perioadarrayday[$i],perioadarrayhour[$i]);
            };

            max = (4 - perioadarrayid.length);
            $("#btnperioadcount").html(max);
        };

        function editdivperioad($time,$month,$day,$hour) {
            let $period = "";
            $period += '<div class="col-md-3" style="padding-left: 0px;padding-right: 0px;">';
            $period += '<div class="col-md-10" style="left: 32%;">';
            $period += '<p style="cursor: default;">時段</p>';
            $period += '</div>';
            $period += '<div class="col-md-1">';
            $period += '<i onclick="fas('+$time+')" style="cursor: pointer;" class="fas fa-trash-alt"></i>';
            $period += '</div>';
            $period += '<div class="col-md-6">';
            $period += '<div class="form-group">';
            $period += '<label>月份</label>';
            $period += '<p style="background-color: #dddddd;" class="form-control">'+$month+'<p>';
            $period += '<input name="month[]" type="hidden" value="'+$month+'">';
            $period += '</div>';
            $period += '</div>';
            $period += '<div class="col-md-6">';
            $period += '<div class="form-group">';
            $period += '<label for="name">日期</label>';
            $period += '<p style="background-color: #dddddd;" class="form-control">'+$day+'<p>';
            $period += '<input name="day[]" type="hidden" value="'+$day+'">';
            $period += '</div>';
            $period += '</div>';
            $period += '<div class="col-md-12">';
            $period += '<div class="form-group">';
            $period += '<label for="name">小時</label>';
            $period += '<p style="background-color: #dddddd;" class="form-control">'+$hour+'<p>';
            $period += '<input name="hour[]" type="hidden" value="'+$hour+'">';
            $period += '</div>';
            $period += '</div>';
            $period += '</div>';
            $("#perioddiv").append($period);
        };

        //介紹標題

        function btneditCoursegc() {
            $("#editCoursegc").modal();
        };

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
                        $("#editCoursegc").modal('hide');
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
                        if(perioadarrayid.length <= 0){
                            alert("時段未填");
                        }else{
                            if(arraygc_id.length <= 0){
                                alert("課程介紹未上傳");
                            }else{
                                if(confirm("確定修改課程??")){
                                    $("#editcoursefrom").submit();
                                };
                            };
                        }
                    };
                };
            };

        };

        $(document).ready(function () {
            var $modelTimeslot = {!! json_encode($TestData['Timeslot']) !!};

            for($i=0; $i<$modelTimeslot.length; $i++){
                perioadarrayid.push( Date.now() + $i );
                perioadarraymonth.push($modelTimeslot[$i]['month']);
                perioadarrayday.push($modelTimeslot[$i]['day']);
                perioadarrayhour.push($modelTimeslot[$i]['hour']);
            };
            update_perioad();

            //模組
            var $model = {!! json_encode($TestData['modelarray']) !!};

            for($i=0; $i<$model.length; $i++){
                arraygc_id.push( Date.now() + $i );
                arraygc_title.push($model[$i]['title']);
                arraygc_contents.push($model[$i]['contents']);
                arraygc_src.push($model[$i]['src']);
                arraygc_fe.push($model[$i]['fe']);
            };

            gc_update();
        });

    </script>

    <style type="text/css">

    </style>
@endsection
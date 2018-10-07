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

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>幻燈片</label>
                        </div>
                    </div>
                    @for($i=0;$i<count($slidesArray);$i++)
                        {!! Form::open(['id' => ('slide'.($slidesArray[$i]['id'])), 'method' => 'PUT', 'action' => ['OnlineController@slide', ($slidesArray[$i]['id'])] ]) !!}
                            <div class="col-md-4" style="text-align: center;">
                                <div class="thumbnail">
                                    <span>{{ $i+1 }}號.幻燈片</span>
                                    <img style="margin: 5px 0px;width: 100%;" src="{{ ($slidesArray[$i]['src']) }}" alt="#">
                                    <input id="slidesrc{{ ($slidesArray[$i]['id']) }}" name="slidesrc" type="hidden" value="{{ ($slidesArray[$i]['src']) }}">
                                    <input id="slidefe{{ ($slidesArray[$i]['id']) }}" name="slidefe" type="hidden" value="{{ ($slidesArray[$i]['fe']) }}">
                                    <button onclick="slidejump('{{ ($slidesArray[$i]['id']) }}')" type="button" class="btn btn-block btn-warning">修改</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    @endfor
                    <div class="modal fade" id="slidemodel" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">修改幻燈片</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row" style="margin-bottom: 2px;">
                                        <div class="col-md-12">
                                            <input id="slidemodalpicload" type="file" accept="image/*" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <img id="slidemodalimg" src="http://placehold.it/1170x613" style="width: 100%;height: 210px;margin-bottom: 1px;">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    <button onclick="slidemodalsave()" type="button" class="btn btn-primary">儲存</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>熱銷商品</label>
                        </div>
                    </div>
                    @for($i=0; $i<count($ToShowProDucts); $i++)
                        {!! Form::open(['id' => ('pdform'.$i), 'method' => 'PUT','action' => ['OnlineController@hotproduct', $ToShowProDucts[$i]['hotpd_id'] ]]) !!}
                            <div class="col-md-3" style="text-align: center;">
                                <div class="thumbnail">
                                    <span>熱銷商品{{ ($i + 1) }}</span>
                                    <p style="cursor: default;">
                                        @if(mb_strlen($ToShowProDucts[$i]['title'],"utf-8") < 33)
                                            {{$ToShowProDucts[$i]['title']}}
                                        @else
                                            {{mb_substr($ToShowProDucts[$i]['title'],0,33,"utf-8").'...'}}
                                        @endif
                                    </p>
                                    <img style="margin: 5px 0px;width: 100%;" src="{{ url('images/product/',$ToShowProDucts[$i]['src']) }}">
                                    <input id="pdradioid{{$i}}" name="pdradioid" type="hidden" value="">
                                    <button onclick="productedit({{$i}})" type="button" class="btn btn-block btn-warning">修改</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    @endfor
                    <div class="modal fade" id="productmodel" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">修改熱銷商品</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="productmodelH" class="row" style="height: 300px;overflow-y: scroll;">
                                        @for($i=0;$i<count($ToRadioProducts);$i++)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <input name="productradio" type="radio" value="{{ $ToRadioProducts[$i]['_id'] }}">
                                                        </div>
                                                        <textarea style="resize: none;" rows="3" cols="10" disabled type="text" class="form-control text-justify">{{$ToRadioProducts[$i]['title']}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    <button onclick="productmodalsave()" type="button" class="btn btn-primary">儲存</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>熱門文章</label>
                        </div>
                    </div>
                    @for($i=0; $i<count($ToShowarticles); $i++)
                        <div class="col-md-3" style="text-align: center;">
                            {!! Form::open(['id' => ('articleform'.$i), 'method' => 'PUT','action' => ['OnlineController@hotarticle', $ToShowarticles[$i]['hotart_id'] ]]) !!}
                            <div class="thumbnail">
                                <span>熱門文章{{ $i + 1 }}</span>
                                <p style="cursor: default;">
                                    @if(mb_strlen($ToShowarticles[$i]['title'],"utf-8") < 33)
                                        {{ $ToShowarticles[$i]['title'] }}
                                    @else
                                        {{ mb_substr($ToShowarticles[$i]['title'],0,33,"utf-8").'...' }}
                                    @endif
                                </p>
                                <img style="margin: 5px 0px;width: 100%;" src="{{ url('images/article/',$ToShowarticles[$i]['src']) }}" alt="#">
                                <input id="articleradioid{{$i}}" name="articleradioid" type="hidden" value="">
                                <button onclick="articleedit({{$i}})" type="button" class="btn btn-block btn-warning">修改</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    @endfor
                    <div class="modal fade" id="articlemodel" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">修改熱門文章</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="articlemodelH" class="row" style="height: 300px;overflow-y: scroll;">
                                        @for($j=0;$j<count($ToRadioArticles);$j++)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <input name="articleradio" type="radio" value="{{ $ToRadioArticles[$j]['_id'] }}">
                                                        </div>
                                                        <textarea style="resize: none;" rows="3" cols="10" disabled type="text" class="form-control text-justify">{{ $ToRadioArticles[$j]['title'] }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    <button onclick="articlemodalsave()" type="button" class="btn btn-primary">儲存</button>
                                </div>
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
        $("#main_left").css({ "height" : ($( document ).height()) });

        //熱門文章
        function articlemodalsave() {
            let status = false;
            $("input:radio:checked[name='articleradio']").each(function(i) {
                document.getElementById("articleradioid" + $articleid).value = $(this).val();
                status = true;
            });
            if(status){
                if(confirm("確定修改熱門文章")){
                    $("#articleform"+$articleid).submit();
                };
            };
        };

        var $articleid;
        function articleedit($id) {
            $articleid = $id;
            $("#articlemodelH").height(300);
            $("#articlemodel").modal();
        };

        //熱銷商品
        function productmodalsave() {
            let status = false;
            $("input:radio:checked[name='productradio']").each(function(i) {
                document.getElementById("pdradioid" + $productid).value = $(this).val();
                status = true;
            });
            if(status){
                if(confirm("確定修改熱銷商品")){
                    $("#pdform"+$productid).submit();
                };
            };
        };

        var $productid;
        function productedit($id) {
            $productid = $id;
            $("#productmodelH").height(300);
            $("#productmodel").modal();
        };

        //幻燈片
        var $slideid;
        function slidemodalsave() {
            if(confirm("確定修改幻燈片？？")){
                $("#slide"+$slideid).submit();
            };
        }

        function slidejump($id) {
            $slideid = $id;
            $("#slidemodalpicload").val('');
            $("#slidemodalimg").attr('src', "http://placehold.it/1170x613");
            $("#slidemodel").modal();
        };

        function readURL(input){
            if(input.files && input.files[0]){
                let reader = new FileReader();
                reader.onload = function(e){
                    $("#slidemodalimg").attr('src', e.target.result);
                    document.getElementById("slidesrc" + $slideid).value = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            };
        };

        $("#slidemodalpicload").change(function () {
            readURL(this);
            document.getElementById("slidefe" + $slideid).value = $(this).val().split('.').pop()
        });

    </script>

    <style type="text/css">

    </style>
@endsection


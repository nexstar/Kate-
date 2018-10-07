@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">
            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">

                <div class="row" style="padding-top: 20px;">
                    <div class="col-md-4 col-md-offset-4" style="text-align: center;">
                        <p style="font-size: 30px;">綠寵物幻燈片</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>幻燈片</label>
                        </div>
                    </div>
                    @for($i=0;$i<count($slidesArray);$i++)
                        {!! Form::open(['id' => ('slide'.$slidesArray[$i]['id']), 'method' => 'PUT', 'action' => ['GreenPetSlideController@store', ($slidesArray[$i]['id'])] ]) !!}
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

            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
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


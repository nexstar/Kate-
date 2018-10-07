@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">
            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">

                <div class="row" style="padding-top: 20px;">
                    <div class="col-md-4 col-md-offset-4" style="text-align: center;">
                        <p style="font-size: 30px;">電商-朋友們的肯定設定</p>
                    </div>
                </div>

                <div class="row">
                    @for($i=0;$i<count($goblade);$i++)
                        {!! Form::open([ 'id' => ('editfriendfrom'.($i+1)), 'method' => 'PUT', 'action' => ['OnlineFriendController@update', ($i+1)] ]) !!}
                        <div class="col-md-4" style="text-align: center;">
                            <div class="thumbnail">
                                <span>{{ ($i+1) }}.朋友們的肯定</span>
                                <img style="margin: 5px 0px;width: 100%;" src="{{ $goblade[$i]['src'] }}" alt="#">
                                <input id="friendsrc{{ ($i+1) }}" name="friendsrc"  type="hidden" value="{{ $goblade[$i]['src'] }}">
                                <input id="friendfe{{ ($i+1) }}" name="friendfe" type="hidden" value="{{ $goblade[$i]['fe'] }}">
                                <input name="friendid" type="hidden" value="{{ $goblade[$i]['_id'] }}">
                                <button onclick="editFriend({{ ($i+1) }})" type="button" class="btn btn-block btn-warning">修改</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    @endfor
                    <div class="modal fade" id="editfriend" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">修改朋友們的肯定</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row" style="margin-bottom: 2px;">
                                        <div class="col-md-12">
                                            <input id="modalpicload" type="file" accept="image/*" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <img id="modalimg" src="http://placehold.it/1170x613" style="width: 100%;height: 210px;margin-bottom: 1px;">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    <button onclick="yeseditfriend()" type="button" class="btn btn-primary">進行更換</button>
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

        var $editid;
        function editFriend($id) {
            $("#editfriend").modal();
            $editid = $id;
        };

        function yeseditfriend() {
            $_friendsrc =  $("#friendsrc"+$editid).val();

            if($_friendsrc.length <100 ){
                alert("照片尚未上傳");
            }else{
                if(confirm("確定修改朋友的肯定？？")){
                    $("#editfriendfrom" + $editid).submit();
                };
            };
        };

        function readURL(input){
            if(input.files && input.files[0]){
                let reader = new FileReader();
                reader.onload = function(e){
                    $("#modalimg").attr('src', e.target.result);
                    document.getElementById( ("friendsrc" + $editid) ).value = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            };
        };

        $("#modalpicload").change(function () {
            readURL(this);
            document.getElementById( ("friendfe" + $editid) ).value = $(this).val().split('.').pop();
            // $("#modalpicload").val('');
            // $("#modalimg")[0].src = "http://placehold.it/1170x613";
        });

    </script>

    <style type="text/css">

    </style>
@endsection


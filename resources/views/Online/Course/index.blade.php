@extends('Layouts.background')

@section('contents')

    @include('Repeat.header')

    <div class="container-fluid" style="margin-top: 55px;">
        <div class="row">
            @include('Repeat.leftmenu')

            <div id="main_right" class="col-md-10" style="width:88.33333333%;">
                <div class="col-md-12">

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-4 col-md-offset-4" style="text-align: center;">
                            <p style="font-size: 30px;">電商-課程設定</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <a href="{{ url('onlinecourse/create') }}" class="btn btn-primary" style="border: 0;background-color: #80B1EA;">新增課程</a>
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>照片</th>
                                    <th>點擊率</th>
                                    <th>標題</th>
                                    <th>時段</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @foreach($courses as $courses)
                                    <tr style="cursor: default;">
                                        <td style="width:20%;">
                                            <img src="{{ url('/images/course/'.$courses->imgjson['img']) }}" style="width:100%;">
                                        </td>
                                        <td style="font-size: 20px;">{{ count($courses->point) }}</td>
                                        <td style="font-size: 20px;">{{ $courses->title }}</td>
                                        <td style="font-size: 20px;">
                                            @for($i=0;$i<count($courses->Timeslot);$i++)
                                                <p style="font-size: 15px;">{{ $courses->Timeslot[$i]['year'].'年'.$courses->Timeslot[$i]['month'].'月'.$courses->Timeslot[$i]['day'].'號_'.$courses->Timeslot[$i]['hour'].'點' }}</p>
                                            @endfor
                                        </td>
                                        <td style="width:15%;">
                                            @if($courses->onffonline)
                                                <a href="{{ route('course.onoff',[$courses->_id,0]) }}" class="btn btn-block btn-info">下架</a>
                                            @else
                                                <a href="{{ route('course.onoff',[$courses->_id,1]) }}" class="btn btn-block btn-primary">上架</a>
                                            @endif
                                            {!! Form::open([
                                                'id' => ('rmcourse'.$courses->_id), 'method' => 'DELETE',
                                                'action' => ['OnlineCourseController@destroy',$courses->_id]])
                                            !!}
                                            {!! Form::close() !!}
                                            <button onclick="btnrmcourse('{{$courses->_id}}')" type="button" style="margin-top: 5px;" class="btn btn-block btn-danger">刪除</button>
                                            <a href="{{ route('onlinecourse.edit', $courses->_id) }}" class="btn btn-block btn-warning">修改</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        var _main_table = $( window ).height() - 200;
        $("#main_table").css({"height":_main_table, "overflow-y": "scroll"});
        function btnrmcourse($id) {
             if(confirm("確定刪除此課程??")){
                 $("#rmcourse"+$id).submit();
             };
        };
    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection


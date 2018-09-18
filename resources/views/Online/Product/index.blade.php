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
                            <p style="font-size: 30px;">電商-商品設定</p>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-9">
                            <div class="col-md-3">
                                <a href="{{ url('onlineproduct/create') }}" class="btn btn-block btn-success" style="background-color: #4A90E2;border-color: #4A90E2;">新增商品</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('OnlineProductItemsController') }}" class="btn btn-block btn-success" style="background-color: #4A90E2;border-color: #4A90E2;">商品大小項</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('onlineproductdiscount') }}" class="btn btn-block btn-success" style="background-color: #4A90E2;border-color: #4A90E2;">折扣</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('onlineproducttpye') }}" class="btn btn-block btn-success" style="background-color: #4A90E2;border-color: #4A90E2;">分類區</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="#" style="float: right;width: 30%;background-color: #4A90E2;border-color: #4A90E2;" class="btn btn-success">搜尋</a>
                            <input style="width: 70%;float: right;" type="text" placeholder="檢索: 編號,名稱" class="form-control">
                            <div style="clear: both;"></div>
                        </div>
                    </div>

                    <div id="main_table" class="col-md-12" style="margin-top: 10px;">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>照片</th>
                                    <th>商品編號</th>
                                    <th>名稱</th>
                                    <th>大項</th>
                                    <th>小項</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="main_table_tbody">
                                @for($i=0;$i<count($TmpDB);$i++)
                                    @if( ((int)$TmpDB[$i]['inventory']) > 5 )
                                        <tr style="cursor: default;">
                                            <td style="width:20%;">
                                                <img src="{{ $TmpDB[$i]['src'] }}" style="width:100%;">
                                            </td>
                                            <td style="font-size: 20px;">{{ $TmpDB[$i]['id'] }}</td>
                                            <td style="font-size: 20px;">{{ $TmpDB[$i]['title'] }}</td>
                                            <td style="font-size: 20px;">{{ $TmpDB[$i]['pdbigitem'] }}</td>
                                            <td style="font-size: 20px;">{{ $TmpDB[$i]['pdsmallitem'] }}</td>
                                            <td style="width:15%;">
                                                <a target="_blank" href=".../{{$TmpDB[$i]['id']}}" class="btn btn-block btn-success">網站</a>
                                                <a href="{{ route('onlinetransactionrecordcontroller.info', $TmpDB[$i]['id']) }}" class="btn btn-block btn-info">資訊</a>
                                                @if( ((int)$TmpDB[$i]['onoff']) )
                                                    <a href="{{ route('Online.Product.offline','1') }}" class="btn btn-block btn-info" style="background-color: #C10066;border-color: #C10066;">下架</a>
                                                @else
                                                    <a href="{{ route('Online.Product.online', '0') }}" class="btn btn-block btn-primary" style="margin-top: 5px;">上架</a>
                                                @endif
                                                {!! Form::open([
                                                    'id' => ('rmpdfrom'.$TmpDB[$i]['id']), 'method' => 'DELETE',
                                                    'action' => ['OnlineProductController@destroy',$TmpDB[$i]['id']],
                                                    ])
                                                !!}
                                                    <button onclick="btnrmpd('{{ $TmpDB[$i]['id'] }}')" style="margin-top: 5px;" type="button" class="btn btn-block btn-danger">刪除</button>
                                                {!! Form::close() !!}
                                                <a href="{{ route('onlineproduct.edit', $TmpDB[$i]['id']) }}" style="margin-top: 5px;" class="btn btn-block btn-warning">修改</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endfor
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
        var _main_table = $( window ).height() - 300;
        $("#main_table").css({"height":_main_table, "overflow-y": "scroll"});
        function btnrmpd($id) {
          if(confirm("確定要刪除??")){
              $("#rmpdfrom"+$id).submit();
          };
        };
    </script>

    <style type="text/css">
        tr,th{
            text-align: center;
        }
    </style>
@endsection


@extends('layout._back')

@section('title') 市场管理 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        市场管理
        <small>会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">市场管理</li>
    </ol>
@stop

@section('content')
    <a href="{{ route('card.market.create') }}" class="btn btn-primary margin-bottom">添加新市场</a>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                </div><!-- /.box-header -->


                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>

                            <th>id</th>
                            <th>市场编号</th>
                            <th>市场名称</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($markets as $key => $li)

                            <tr>

                                <td class="text-aqua">{{ $li -> id }}</td>
                                <td class="">{{ $li -> no }}</td>
                                <td class="text-green">{{ $li -> name }}</td>
                                <td class="">{{ $li -> created_at }}</td>
                                <td> <a href="{{ route('card.market.index') }}/{{ $li->id }}/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>  </td>
                            </tr>

                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>

                            <th>id</th>
                            <th>市场编号</th>
                            <th>市场名称</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop
@section('footer_js')
    <script type="text/javascript">
        $(function () {

            $('#example1').DataTable({
                "aaSorting": [[ 0, "desc" ]],
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@stop

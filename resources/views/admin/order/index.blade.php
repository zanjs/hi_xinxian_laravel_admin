@extends('layout._back')

@section('title') 订单管理 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        订单管理
        <small>列表</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">订单管理</li>
    </ol>
@stop

@section('content')

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
                            <th>下单时间</th>
                            <th>订单编号</th>
                            <th>收货人姓名</th>
                            <th>收货人电话</th>
                            <th>收货人地址</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($order as $key => $li)
                            <tr>
                                <td class="text-blue">{{ $li -> created_at }}</td>
                                <td class="text-yellow">{{ $li -> order_no }}</td>
                                <td class="text-red">{{ $li -> user_name }}</td>
                                <td class="text-green">{{ $li -> user_phone }}</td>
                                <td class="text-orange">{{ $li -> user_address }}</td>
                                <td> <a href="{{ route('admin.order.index') }}/{{ $li->id }}"><i class="fa fa-expand fa-pencil" title="查看详情"></i></a>  </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>最后修改时间</th>
                            <th>分类名称</th>
                            <th>分类图片</th>
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
                /*  "paging": true,
                 "lengthChange": false,
                 "searching": false,
                 "ordering": true,*/
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@stop
@extends('layout._backP')

@section('title') 付款记录 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        付款记录
        <small>会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">付款记录</li>
    </ol>
@stop

@section('content')
    {{--<a href="{{ route('card.card.create') }}" class="btn btn-primary margin-bottom">添加新会员</a>--}}

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
                            <th>卡号</th>
                            <th>手机号</th>
                            <th>付款金额</th>
                            <th>操作ip地址</th>
                            <th>付款时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $key => $li)
                            <tr>
                                <td class="text-aqua">{{ $li -> id }}</td>
                                <td class="text-green">{{ $li -> card }}</td>
                                <td class="text-green">{{ $li -> phone }}</td>
                                <td class="text-red">{{ $li -> price }}</td>
                                <td class="text-green">{{ $li -> ip }}</td>
                                <td class="text-green">{{ $li -> created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>卡号</th>
                            <th>手机号</th>
                            <th>付款金额</th>
                            <th>操作ip地址</th>
                            <th>付款时间</th>
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

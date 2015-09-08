@extends('layout._backP')

@section('title') 返现记录 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        返现记录
        <small>会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">返现记录</li>
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
                            <th>充值金额</th>
                            <th>操作员</th>
                            <th>市场</th>
                            <th>操作ip地址</th>
                            <th>充值时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($recharges as $key => $li)
                            <tr>
                                <td class="text-aqua">{{ $li -> id }}</td>
                                <td class="text-green">{{ $li -> card }}</td>
                                <td class="text-green">{{ $li -> phone }}</td>
                                <td class="text-red">{{ $li -> price }}</td>
                                <td>{{ $li -> operator->name or '未知' }}</td>
                                <td>{{ $li -> market->name or '未知' }}</td>
                                <td class="text-green">{{ $li -> ip }}</td>
                                <td class="text-green">{{ $li -> created_at }}</td>
                                <td>
                                    <a href="javascript:void(0);" style="margin-left: 30px"><i class="fa fa-trash delete_item" title="删除" data-id="{{ $li->id }}"></i></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>卡号</th>
                            <th>手机号</th>
                            <th>充值金额</th>
                            <th>操作员</th>
                            <th>市场</th>
                            <th>操作ip地址</th>
                            <th>充值时间</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <form method="post" action="{{ route('card.cash_back.index') }}" accept-charset="utf-8" id="hidden-delete-form">
        <input name="_method" type="hidden" value="delete">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    <div id="" class="">
        <?php echo $recharges->render(); ?>
    </div>
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
        $('.delete_item').click(function(){
            var action = '{{ route('card.cash_back.index') }}';
            var id = $(this).data('id');
            var new_action = action + '/' + id;
            $('#hidden-delete-form').attr('action', new_action);
            $('#hidden-delete-form').submit();
        });
    </script>
@stop

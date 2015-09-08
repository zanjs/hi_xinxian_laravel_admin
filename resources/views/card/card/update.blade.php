@extends('layout._back')

@section('title') 补卡记录 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        补卡记录
        <small>会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">补卡记录</li>
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
                            <th>新卡号</th>
                            <th>旧卡号</th>
                            <th>手机号</th>
                            <th>市场</th>
                            <th>操作员</th>
                            <th>操作ip</th>
                            <th>创建时间</th>
                            <th>操作</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($cards as $key => $li)

                            <tr>
                                <td class="text-aqua">{{ $li -> id }}</td>
                                <td class="text-green">{{ $li -> news_card }}</td>
                                <td class="text-green">{{ $li -> order_card }}</td>
                                <td class="text-red">{{ $li -> phone }}</td>
                                <td>{{ $li -> market->name or '未知'}}</td>
                                <td>{{ $li -> operator->name or '未知人员' }}</td>
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
                            <th>新卡号</th>
                            <th>旧卡号</th>
                            <th>手机号</th>
                            <th>市场</th>
                            <th>操作员</th>
                            <th>操作ip</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!--隐藏型删除表单-->

    <form method="post" action="{{ route('card.card_update.index') }}" accept-charset="utf-8" id="hidden-delete-form">
        <input name="_method" type="hidden" value="delete">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
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

        <!--jQuery 提交表单，实现DELETE删除资源-->
        //jQuery submit form
        $('.delete_item').click(function(){
            var action = '{{ route('card.card_update.index') }}';
            var id = $(this).data('id');
            var new_action = action + '/' + id;
            $('#hidden-delete-form').attr('action', new_action);
            $('#hidden-delete-form').submit();
        });
    </script>
@stop

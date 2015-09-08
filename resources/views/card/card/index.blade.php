@extends('layout._backP')

@section('title') 会员管理 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        会员管理
        <small>会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">会员管理</li>
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
                            <th>现金余额</th>
                            {{--<th>虚拟余额</th>--}}
                            <th>姓名</th>
                            <th>性别</th>
                            <th>开通市场</th>
                            <th>开通操作员</th>
                            <th>开通时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($cards as $key => $li)
                                <tr>
                                    <td class="text-aqua">{{ $li -> id }}</td>
                                    <td class="text-green">{{ $li -> card }}</td>
                                    <td class="text-green">{{ $li -> phone }}</td>
                                    <td class="text-red">{{ $li -> price }}</td>
                                    {{--<td class="text-green">{{ $li -> price_x }}</td>--}}
                                    <td>{{ $li -> name }}</td>
                                    <td class="text-green">@if ($li -> sex === 0) 男 @else 女 @endif</td>
                                    <td>{{ $li -> market->name or '未知'}}</td>
                                    <td>{{ $li -> operator->name or '未知' }}</td>
                                    <td class="text-green">{{ $li -> created_at }}</td>
                                    <td>
                                        <a href="{{ route('card.card.index') }}/{{ $li->id }}/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                                        <a href="javascript:void(0);" style="margin-left: 30px"><i class="fa fa-trash delete_item" title="删除该会员" data-id="{{ $li->id }}"></i></a>
                                    </td>

                                </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>

                            <th>id</th>
                            <th>卡号</th>
                            <th>手机号</th>
                            <th>现金余额</th>
                            {{--<th>虚拟余额</th>--}}
                            <th>姓名</th>
                            <th>性别</th>
                            <th>开通市场</th>
                            <th>开通操作员</th>
                            <th>开通时间</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!--隐藏型删除表单-->
    <div id="" class="">
        <?php echo $cards->render(); ?>
    </div>
    <form method="post" action="{{ route('card.card.index') }}" accept-charset="utf-8" id="hidden-delete-form">
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
            var action = '{{ route('card.card.index') }}';
            var id = $(this).data('id');
            var new_action = action + '/' + id;

            layer.open({
                content: '您确认要删除吗,按错点取消',
                btn: ['确认', '取消'],
                shadeClose: false,
                yes: function(){
                    $('#hidden-delete-form').attr('action', new_action);
                    $('#hidden-delete-form').submit();
                }, no: function(){
                }
            });


        });
    </script>
@stop

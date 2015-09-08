@extends('layout._back')

@section('title') 产品管理 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        产品管理
        <small>会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">产品管理</li>
    </ol>
@stop

@section('content')
    <a href="{{ route('card.product.create') }}" class="btn btn-primary margin-bottom">添加新产品</a>

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
                            <th>产品编号</th>
                            <th>产品名称</th>
                            <th>进货价</th>
                            <th>零售价</th>
                            <th>数量</th>
                            <th>更新时间</th>
                            <th>所属市场</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $key => $li)

                            <tr>

                                <td class="text-aqua">{{ $li -> id }}</td>
                                <td class="">{{ $li -> no }}</td>
                                <td class="text-green">{{ $li -> name }}</td>
                                <td class="text-red">{{ $li -> b_price }}</td>
                                <td class="text-green">{{ $li -> price }}</td>
                                <td class="text-green">{{ $li -> number }}</td>
                                <td class="">{{ $li -> updated_at }}</td>
                                <td class="">{{ $li -> market ->name or ''}}</td>
                                <td>
                                    <a href="{{ route('card.product.index') }}/{{ $li->id }}/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                                    <a href="javascript:void(0);" style="margin-left: 30px"><i class="fa fa-trash delete_item" title="删除" data-id="{{ $li->id }}"></i></a>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>

                            <th>id</th>
                            <th>产品编号</th>
                            <th>产品名称</th>
                            <th>进货价</th>
                            <th>零售价</th>
                            <th>数量</th>
                            <th>更新时间</th>
                            <th>所属市场</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <form method="post" action="{{ route('card.product.index') }}" accept-charset="utf-8" id="hidden-delete-form">
        <input name="_method" type="hidden" value="delete">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    <div id="" class="">
        <?php echo $products->render(); ?>
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
            var action = '{{ route('card.product.index') }}';
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

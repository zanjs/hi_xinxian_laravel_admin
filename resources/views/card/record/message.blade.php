@extends('layout._back')

@section('title') 短信记录 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        短信记录
        <small>会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">短信记录</li>
    </ol>
@stop

@section('content')

    <a href="{{ route('card.sms.create') }}" class="btn btn-primary margin-bottom">添加群发</a>
    <a href="{{ route('card_sms_record') }}" class="btn bg-purple margin-bottom">群发任务</a>
    <a href="{{ route('card_sms_jobs') }}" class="btn bg-maroon margin-bottom">群发队列</a>
    <a href="{{ route('card.sms.index') }}" class="btn bg-navy margin-bottom">群发记录</a>
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
                            <th>手机号</th>
                            <th>发送内容</th>
                            <th>发送状态</th>
                            <th>发送时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($messages as $key => $li)

                            <tr>

                                <td class="text-aqua">{{ $li -> id }}</td>
                                <td class="text-green">{{ $li -> phone }}</td>
                                <td class="text-red">{{ $li -> count }}</td>
                                <td class="text-green">@if ( $li -> start === 1) 成功 @else 失败 @endif</td>

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
                            <th>手机号</th>
                            <th>发送内容</th>
                            <th>发送状态</th>
                            <th>发送时间</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <form method="post" action="{{ route('card.message.index') }}" accept-charset="utf-8" id="hidden-delete-form">
        <input name="_method" type="hidden" value="delete">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    <div id="" class="">
        <?php echo $messages->render(); ?>
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
            var action = '{{ route('card.message.index') }}';
            var id = $(this).data('id');
            var new_action = action + '/' + id;
            $('#hidden-delete-form').attr('action', new_action);
            $('#hidden-delete-form').submit();
        });
    </script>
@stop

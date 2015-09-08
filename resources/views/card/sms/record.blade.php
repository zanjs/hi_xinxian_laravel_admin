@extends('layout._back')

@section('title') 群发操作记录 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        群发操作记录
        <small>会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">群发操作记录</li>
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
                            <th>开始时间</th>
                            <th>结束时间</th>
                            <th>发送内容</th>
                            <th>发送人数</th>
                            <th>操作人</th>
                            <th>任务创建时间</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($records as $key => $li)

                            <tr>
                                <td class="text-aqua">{{ $li -> id }}</td>
                                <td class="text-green">{{ $li -> startTime }}</td>
                                <td class="text-red">{{ $li -> endTime }}</td>
                                <td class="text-green">{{ $li -> text }}</td>
                                <td class="text-green">{{ $li -> mumber }}</td>
                                <td class="text-green">{{ $li -> user->name }}</td>
                                <td class="text-green">{{ $li -> created_at }}</td>

                            </tr>



                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>

                            <th>id</th>
                            <th>开始时间</th>
                            <th>结束时间</th>
                            <th>发送内容</th>
                            <th>发送人数</th>
                            <th>操作人</th>
                            <th>任务创建时间</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div id="" class="">
        <?php echo $records->render(); ?>
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
    </script>
@stop

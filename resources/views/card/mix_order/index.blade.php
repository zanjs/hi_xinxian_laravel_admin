@extends('layout._backP')

@section('title') 混合支付订单 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        混合支付订单
        <small>会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">混合支付订单</li>
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
                            <th>消费金额</th>
                            <th>现金支付</th>
                            <th>创建时间</th>
                            <th>市场</th>
                            <th>操作员</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $key => $li)

                            <tr>
                                <td class="text-aqua">{{ $li -> id }}</td>
                                <td class="text-green">@if ($li -> user_card === 0) 现金支付 @else {{ $li -> user_card }} @endif</td>
                                <td class="text-green">{{ $li -> user_phone }}</td>
                                <td class="text-red">{{ $li -> price }}</td>
                                <td class="text-red">{{ $li -> price_cash }}</td>
                                <td class="text-green">{{ $li -> created_at }}</td>
                                <td>{{ $li -> market ->name or ''}}</td>
                                <td>{{ $li -> operator->name or '未知' }}</td>
                                <td>
                                    <a href="{{ route('card.mix_order.index') }}/{{ $li->id }}"><i class="fa fa-building-o" title="详情"></i></a>
                                    <a href="javascript:void(0);" style="margin-left: 30px"><i class="fa fa-trash delete_item" title="删除改订单" data-id="{{ $li->id }}"></i></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>卡号</th>
                            <th>手机号</th>
                            <th>消费金额</th>
                            <th>现金支付</th>
                            <th>创建时间</th>
                            <th>市场</th>
                            <th>操作员</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <form method="post" action="{{ route('card.mix_order.index') }}" accept-charset="utf-8" id="hidden-delete-form">
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
                "autoWidth": false,
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                        i : 0;
                    };

                    // Total over all pages
                    total = api
                            .column( 4 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );

                    // Total over this page
                    pageTotal = api
                            .column( 4, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                    if(data.length >1){
                        total = total.toFixed(2);
                    }
                    // Update footer
                    $( api.column( 4 ).footer() ).html(
                            '￥'+pageTotal.toFixed(2) +' ( ￥'+ total +' 总)'
                    );
                }
            });
        });

        $('.delete_item').click(function(){
            var action = '{{ route('card.mix_order.index') }}';
            var id = $(this).data('id');
            var new_action = action + '/' + id;
            $('#hidden-delete-form').attr('action', new_action);
            $('#hidden-delete-form').submit();
        });
    </script>
@stop

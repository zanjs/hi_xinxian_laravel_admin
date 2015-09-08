@extends('layout._back')

@section('title') 订单详细 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        订单详细
        <small>{{ $order -> user_name }} -- 的订单</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">订单详细</li>
    </ol>
@stop

@section('content')
    @if(Session::has('fail'))
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>  <i class="icon icon fa fa-warning"></i> 提示！</h4>
            {{ Session::get('fail') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> 警告！</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('admin.sort.store') }}" accept-charset="utf-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">订单产品信息</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">订单商户信息</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label>订单编号 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $order-> order_no }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>收货人名称 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $order-> user_name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>收货人电话 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $order-> user_phone }}"  readonly>
                    </div>

                    <div class="form-group">
                        <label>收货地址 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $order-> user_address }}"  readonly>
                    </div>

                    <div class="form-group">
                        <label>配送时间 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $order-> timePei }}"  readonly>
                    </div>

                    <div class="form-group">
                        <label>下单时间 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $order-> created_at }}"  readonly>
                    </div>

                    <div class="form-group">
                        <label>用户ID <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $order-> user_id }}"  readonly>
                    </div>

                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <table class="table table-hover table-bordered">
                        <tbody>
                        <!--tr-th start-->
                        <tr>
                            <th>产品名称</th>
                            <th>产品单价</th>
                            <th>产品数量</th>
                        </tr>
                        <!--tr-th end-->
                        @foreach ($goods as $key => $li)
                            <tr>
                                <td>
                                    {{ $li -> product_name }}
                                </td>
                                <td class="text-red">
                                    {{ $li -> product_price }}
                                </td>
                                <td class="text-green">
                                    {{ $li -> number }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.tab-pane -->

                <div class="tab-pane" id="tab_3">
                    <div class="form-group">
                        <label>商户名称 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $merchant-> name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>所在城市 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $merchant-> city }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>商户地址 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $merchant-> address }}" readonly>
                    </div>

                </div><!-- /.tab-pane -->



            </div><!-- /.tab-content -->

        </div>
    </form>
    <div id="layerPreviewPic" class="fn-hide">

    </div>

@stop

@section('footer_js')

    <!--引入iCheck组件-->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}"/>
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <!--引入Chosen组件-->
    <script src="{{ asset('plugins/layer/layer.min.js') }}"></script>
    @include('scripts.endChosen')

    <script>

        $('input[type="radio"]').iCheck({
            radioClass: 'iradio_flat-blue',
            increaseArea: '20%' // optional
        });
        @include('scripts.endSinglePic') {{-- 引入单个图片上传与预览JS，依赖于Layer --}}
    </script>
@stop
@extends('layout._back')

@section('title') 现金支付订单详情 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        现金支付订单详情
        <small> 会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">现金支付订单详情</li>
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


    <input name="_method" type="hidden" value="put">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="nav-tabs-custom">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
            {{--<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">用户信息</a></li>--}}
        </ul>

        <div class="tab-content">

            <div class="tab-pane active" id="tab_1">
                <div class="form-group">
                    <label>产品总价 <small class="text-red">*</small></label>

                    <input type="text" class="form-control" autocomplete="off" value="{{ $data->price }}"  readonly>
                </div>
                <div class="form-group">
                    <label>产品列表 <small class="text-red">*</small></label>
                    <table  class="table table-bordered table-striped">
                        <thead>
                        <tr>

                            <th>菜名</th>
                            <th>重量 Kg</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data->goods as $li)
                            <tr>
                                <td>{{ $li->name }}</td>
                                <td>{{ $li->weight }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="form-group">
                    <label>支付方式 <small class="text-red">*</small></label>
                    <input type="text" class="form-control" autocomplete="off" value="@if ($data->type === 0) 会员卡 @elseif($data->type === 1) 抵扣卡 @elseif($data->type === 2) 现金 @endif"  readonly>
                </div>
                <div class="form-group">
                    <label>用户卡号 <small class="text-red">*</small></label>
                    <input type="text" class="form-control" autocomplete="off" value="{{ $data->user_card }}"  readonly>
                </div>
                <div class="form-group">
                    <label>用户手机 <small class="text-red">*</small></label>
                    <input type="text" class="form-control" autocomplete="off" value="{{ $data->user_phone }}"  readonly>
                </div>


            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">

            </div><!-- /.tab-pane -->



        </div><!-- /.tab-content -->

    </div>

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
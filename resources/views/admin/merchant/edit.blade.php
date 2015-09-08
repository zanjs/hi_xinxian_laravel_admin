@extends('layout._back')

@section('title') 商户编辑 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        商户编辑
        <small> 您正在编辑 【{{ isset($data) ? $data->name : null }} 】</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">商户编辑</li>
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

    <form method="post" action="{{ route('admin.merchant.update', $data->id) }}" accept-charset="utf-8">
        <input name="_method" type="hidden" value="put">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">商户地址坐标</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">打印机信息</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label>商户菜场名称 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ Input::old('name',isset($data) ? $data->name : null) }}" placeholder="请输入您的菜场的名字吧,让她看起来更舒服">
                    </div>
                    <div class="form-group">
                        <label>手机号 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="mobile" autocomplete="off" value="{{ Input::old('mobile',isset($data) ? $data->mobile : null) }}" placeholder="只可以输入手机号哦 ： 150 0000 0000">
                    </div>
                    <div class="form-group">
                        <label>配送人姓名 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="dist_name" autocomplete="off" value="{{ Input::old('dist_name',isset($data) ? $data->dist_name : null ) }}" placeholder="配送人如何称呼呢？">
                    </div>

                    <div class="form-group">
                        <label>配送费用 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="fare" autocomplete="off" value="{{ Input::old('fare',isset($data) ? $data->fare : null ) }}" placeholder="只可以输入数字哦">
                    </div>

                    <div class="form-group">
                        <label>满多少免运费 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="full_price" autocomplete="off" value="{{ Input::old('full_price',isset($data) ? $data->full_price : null ) }}" placeholder="只可以输入数字哦">
                    </div>



                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="form-group">
                        <label>商户所在城市 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="city" autocomplete="off" value="{{ Input::old('city',isset($data) ? $data->city : null ) }}" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>商户地址 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="address" autocomplete="off" value="{{ Input::old('address',isset($data) ? $data->address : null ) }}" placeholder="地址需要验证通过百度解析地址,所有请熟悉完整详细坐标">
                    </div>
                    <div class="form-group">
                        <label>商户坐标 经度 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="gps_x" autocomplete="off" value="{{ Input::old('gps_x',isset($data) ? $data->gps_x : null ) }}" placeholder="百度地图解析后的数据">
                    </div>
                    <div class="form-group">
                        <label>商户坐标 纬度 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="gps_y" autocomplete="off" value="{{ Input::old('gps_y',isset($data) ? $data->gps_y : null ) }}" placeholder="百度地图解析后的数据">
                    </div>

                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    <div class="form-group">
                        <label>打印机 key :</label>
                        <input type="text" class="form-control" name="printer_key" value="{{ Input::old('printer_key',isset($data) ? $data->printer_key : null ) }}" placeholder="请输入 key">
                    </div>
                    <div class="form-group">
                        <label>打印机终端号 :</label>
                        <input type="text" class="form-control" name="printer_code" value="{{ Input::old('printer_code',isset($data) ? $data->printer_code : null ) }}" placeholder="请输入 code">
                    </div>
                    <div class="form-group">
                        <label>打印机编号 :</label>
                        <input type="text" class="form-control" name="printer_id" value="{{ Input::old('printer_id',isset($data) ? $data->printer_id : null ) }}" placeholder="请输入 id">
                    </div>
                    <div class="form-group">
                        <label>打印机号码 :</label>
                        <input type="text" class="form-control" name="printer_mobile" value="{{ Input::old('printer_mobile',isset($data) ? $data->printer_mobile : null ) }}" placeholder="请输入打印机手机号">
                    </div>


                </div><!-- /.tab-pane -->

                <button type="submit" class="btn btn-primary">修改商户</button>

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
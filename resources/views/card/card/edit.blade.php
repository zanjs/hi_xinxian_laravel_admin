@extends('layout._back')

@section('title') 会员更新  会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        您正在编辑 【{{ isset($data) ? $data->name : null }} 】
        <small> 会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">会员更新</li>
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

    <form method="post" action="{{ route('card.card.update', $data->id) }}" accept-charset="utf-8">
        <input name="_method" type="hidden" value="put">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">附加内容</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label>卡号 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="card" autocomplete="off" value="{{ Input::old('card',isset($data) ? $data->card : null) }}" required>
                    </div>
                    <div class="form-group">
                        <label>手机号<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="phone" autocomplete="off" value="{{ Input::old('phone',isset($data) ? $data->phone : null) }}"  required>
                    </div>
                    <div class="form-group">
                        <label>余额 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="price" autocomplete="off" value="{{ Input::old('price',isset($data) ? $data->price : null) }}" required>
                    </div>
                    <div class="form-group">
                        <label>虚拟币 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="price_x" autocomplete="off" value="{{ Input::old('price_x',isset($data) ? $data->price_x : null) }}"  required>
                    </div>
                    <div class="form-group">
                        <label>姓名 </label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ Input::old('name',isset($data) ? $data->name : null) }}" placeholder="" >
                    </div>
                    <div class="form-group">
                        <label>所属市场<small class="text-red">*</small></label>
                        <div class="input-group">
                            <select data-placeholder="选择市场..." class="chosen-select" style="min-width:200px;" name="market_id">
                                @foreach ($markets as $li)
                                    <option value="{{ $li->id }}" {{ (Input::old('market_id', isset($data) ? $data->market_id : null)  === $li->id) ? 'selected' : '' }}>{{ $li->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="form-group">
                        <label>性别 <small class="text-red">*</small></label>
                        <div class="input-group">
                            <input type="radio" name="sex" value="0" {{ ((isset($data) ? $data->sex : 0) === 0) ? 'checked' : '' }}>
                            <label class="choice" for="radiogroup">男 &nbsp;&nbsp;</label>
                            <input type="radio" name="sex" value="1" {{ ((isset($data) ? $data->sex : 0) === 1) ? 'checked' : '' }}>
                            <label class="choice" for="radiogroup">女</label>
                        </div>
                    </div>

                </div><!-- /.tab-pane -->

                <button type="submit" class="btn btn-primary">更新用户</button>

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
@extends('layout._back')

@section('title') 新增操作员  会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        新增操作员
        <small> 会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">新增操作员</li>
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

    <form method="post" action="{{ route('card.operator.store') }}" accept-charset="utf-8" style="position: relative" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">附加内容</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label>操作员姓名<small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ Input::old('name') }}" placeholder="起一个 漂亮的名字吧,让她看起来更舒服" required>
                    </div>
                    <div class="form-group">
                        <label>操作员手机号 <small class="text-red">*</small></label>
                        <input type="number" class="form-control" name="phone" autocomplete="off" value="{{ Input::old('phone') }}" placeholder="登录的唯一凭证" required>
                    </div>
                    <div class="form-group">
                        <label>操作员工号 <small class="text-red">*</small></label>
                        <input type="number" class="form-control" name="login_name" autocomplete="off" value="{{ Input::old('login_name') }}" placeholder="只能是数字哦" required>
                    </div>
                    <div class="form-group">
                        <label>操作员邮箱 <small class="text-red">*</small></label>
                        <input type="email" class="form-control" name="email" autocomplete="off" value="{{ Input::old('email') }}" placeholder="具有唯一性,找回密码有力凭证" required>
                    </div>
                    <div class="form-group">
                        <label>登录密码<small class="text-red">*</small></label>
                        <input type="password" class="form-control" name="password" autocomplete="off" value="{{ Input::old('password') }}" placeholder="不得大于20位" required>
                    </div>
                    <div class="form-group">
                        <label>安全密钥 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="safety_key" autocomplete="off" value="{{ Input::old('safety_key') }}" placeholder="用于数据传输使用,为了安全起见,建议定期修改" required>
                    </div>
                    <div class="form-group">
                        <label>负责市场<small class="text-red">*</small></label>
                        <div class="input-group">
                            <select data-placeholder="选择市场..." class="chosen-select" style="min-width:200px;" name="market_id">
                                @foreach ($markets as $li)
                                    <option value="{{ $li->id }}" {{ Input::old('market_id')}}>{{ $li->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="form-group">
                        <label>操作员状态<small class="text-red">*</small></label>
                        <div class="input-group">
                            <input type="radio" name="status" value="0" checked>
                            <label class="choice" for="radiogroup">正常 &nbsp;&nbsp;</label>
                            <input type="radio" name="status" value="1">
                            <label class="choice" for="radiogroup">锁定</label>
                        </div>
                    </div>

                </div><!-- /.tab-pane -->

                <button type="submit" class="btn btn-primary">确认新增</button>

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
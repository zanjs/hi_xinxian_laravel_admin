@extends('layout._back')

@section('title') 用户编辑 后台管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        用户编辑
        <small>编辑</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">用户编辑</li>
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

    <form method="post" action="{{ route('rbac.user.update', $user->id) }}" accept-charset="utf-8">
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">附加内容</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
                    @if($roles)
                        <div class="form-group">
                            <label>角色组 <small class="text-red"> * </small></label>
                            <div class="am-u-sm-8 am-u-md-4">
                                <ul >
                                    @foreach($roles as $role)

                                        <li>
                                            <label class="am-checkbox-inline">
                                                    <input name="roles[]" type="checkbox" value="{{ $role->id }}" @if($user->hasRole($role->name)) checked  @else  @endif> {{ $role->display_name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="am-hide-sm-only am-u-md-6"></div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>用户名 <small class="text-red">* 不可重复</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ Input::old('name',isset($user) ? $user->name : null) }}" placeholder="用户名">
                    </div>
                    <div class="form-group">
                        <label>邮箱 <small class="text-red">*不可重复</small></label>
                        <input type="text" class="form-control" name="email" autocomplete="off" value="{{ Input::old('email',isset($user) ? $user->email : null) }}" placeholder="邮箱">
                    </div>
                    <div class="form-group">
                        <label>密码 <small class="text-red">*</small></label>
                        <input type="password" class="form-control" name="password" autocomplete="off" value="" placeholder="只修改密码时填写">
                    </div>
                    <div class="form-group">
                        <label>职位 </label>
                        <input type="text" class="form-control" name="position" autocomplete="off" value="{{ Input::old('position',isset($user) ? $user->position : null) }}" placeholder="给他一个漂亮的职位吧">
                    </div>
                    <div class="form-group">
                        <label>介绍 </label>
                        <input type="text" class="form-control" name="description" autocomplete="off" value="{{ Input::old('description',isset($user) ? $user->description : null) }}" placeholder="给他一个签名简介吧">
                    </div>

                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="form-group">

                    </div>

                </div><!-- /.tab-pane -->

                <button type="submit" class="btn btn-primary">提交保存</button>

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
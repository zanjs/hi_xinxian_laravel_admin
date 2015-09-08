@extends('layout._back')

@section('title') 编辑角色权限 后台管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        编辑角色权限
        <small>编辑</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">编辑角色权限</li>
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

    <form method="POST"  accept-charset="utf-8">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">附加内容</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label>角色组权限所有 <small class="text-red"></small></label>
                        <ul class="am-avg-sm-4">
                            @foreach($permissions as $permission)
                                <li class="am-fl">
                                    <label class="am-checkbox-inline">
                                        @if(in_array($permission->name,$rolePerms))
                                            <input name="permissions[]" type="checkbox" value="{{ $permission->id }}"  checked > <strong  data-am-popover="{content: '{{ $permission->description }}', trigger: 'hover'}">{{ $permission->display_name }}</strong>
                                        @else
                                            <input name="permissions[]" type="checkbox" value="{{ $permission->id }}"> <strong  data-am-popover="{content: '{content: '{{ $permission->description }}', trigger: 'hover'}', trigger: 'hover focus'}">{{ $permission->display_name }}</strong>
                                        @endif
                                    </label>
                                </li>
                            @endforeach
                        </ul>
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
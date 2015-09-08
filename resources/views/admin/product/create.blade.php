@extends('layout._back')

@section('title') 新增产品 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        产品管理
        <small>新增</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">新增产品</li>
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

    <form method="post" action="{{ route('admin.product.store') }}" accept-charset="utf-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">附加内容</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label>产品名称 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ Input::old('name') }}" placeholder="起一个 漂亮的名字吧,让她看起来更舒服">
                    </div>
                    <div class="form-group">
                        <label>产品价格 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="price" autocomplete="off" value="{{ Input::old('price') }}" placeholder="价格只能输入阿拉伯数字哦 如 19.8">
                    </div>
                    <div class="form-group">
                        <label>产品规格 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="spec" autocomplete="off" value="{{ Input::old('spec') }}" placeholder="规格 如：一斤">
                    </div>
                    <div class="form-group">
                        <label>缩略图 <small class="text-red">*</small> <a href="javascript:void(0);" class="uploadPic" data-id="thumb"><i class="fa fa-fw fa-picture-o" title="上传"></i></a>  <a href="javascript:void(0);" class="previewPic" data-id="thumb"><i class="fa fa-fw fa-eye" title="预览小图"></i></a></label>
                        <input type="text" class="form-control" id="thumb" name="thumb" value="{{ Input::old('thumb') }}" placeholder="缩略图地址：如{{ url('') }}/assets/img/logo.png">
                    </div>
                    <div class="form-group">
                        <label>分类 <small class="text-red">*</small></label>
                        <div class="input-group">
                            <select data-placeholder="选择文章分类..." class="chosen-select" style="min-width:200px;" name="sort">
                                @foreach ($sorts as $li)
                                    <option value="{{ $li->id }}"  {{ Input::old('sort' ) === $li->id ? 'selected' : '' }}>{{ $li->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>正文 <small class="text-red">*</small></label>
                        <textarea class="form-control" id="ckeditor" name="body">{{ Input::old('body') }}</textarea>
                        @include('scripts.endCKEditor'){{-- 引入CKEditor编辑器相关JS依赖 --}}
                    </div>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="form-group">
                        <label>产品标签</label>
                        <input type="text" class="form-control" name="tag" value="{{ Input::old('tag') }}" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>是否存入草稿箱 <small class="text-red">*</small></label>
                        <div class="input-group">
                            <input type="radio" name="status" value="0" checked>
                            <label class="choice" for="radiogroup">否 &nbsp;&nbsp;</label>
                            <input type="radio" name="status" value="1">
                            <label class="choice" for="radiogroup">是</label>
                        </div>
                    </div>

                </div><!-- /.tab-pane -->

                <button type="submit" class="btn btn-primary">发布产品</button>

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
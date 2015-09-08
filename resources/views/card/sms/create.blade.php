@extends('layout._back')

@section('title') 发送短信 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        发送短信
        <small>会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">发送短信</li>
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

    <form method="post" action="{{ route('card.sms.store') }}" accept-charset="utf-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">附加内容</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label>开始时间 <small class="text-red">*</small></label>
                        <input type="text" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="form-control " name="startTime" autocomplete="off" value="{{ Input::old('startTime') }}" placeholder="选择要发送的开始时间吧" required>
                    </div>
                    <div class="form-group">
                        <label>结束时间 <small class="text-red">*</small></label>
                        <input type="text" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  class="form-control" name="endTime" autocomplete="off" value="{{ Input::old('endTime' ) }}" placeholder="选择要发送的结束时间吧？" required>
                    </div>

                    <div class="form-group">
                        <label>推送内容 <small class="text-red">*</small></label>
                        <textarea class="form-control" name="text" rows="3" placeholder="输入要发送给客户的信息吧！" value="{{ Input::old('text' ) }}" required></textarea>
                    </div>


                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">


                </div><!-- /.tab-pane -->

                <button type="submit" class="btn btn-primary">确认发送</button>

            </div><!-- /.tab-content -->

        </div>
    </form>
    <div id="layerPreviewPic" class="fn-hide">

    </div>

@stop

@section('footer_js')
    <style>
        .laydate_box{
            -webkit-box-sizing:content-box;
        }
        .laydate_box *,.laydate_box *:before,.laydate_box *:after{
            -webkit-box-sizing:content-box;
        }

    </style>
    <script src="/libs/laydate/laydate.js"></script>

@stop
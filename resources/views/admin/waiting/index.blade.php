@extends('layout._back')

@section('title') 等待开发 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        等待开发
        <small>...</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">等待开发</li>
    </ol>
@stop

@section('content')
    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">等待开发</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <p>等待后续开发...</p>
        </div><!-- /.box-body -->

    </div>
@stop

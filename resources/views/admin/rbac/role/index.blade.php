@extends('layout._back')

@section('title') 角色组 后台管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        角色组
        <small>列表</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">角色组</li>
    </ol>
@stop

@section('content')
    <a href="{{ route('rbac.role.create') }}" class="btn btn-primary margin-bottom">添加角色组</a>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                </div><!-- /.box-header -->


                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>角色标识</th>
                            <th>角色名</th>
                            <th>说明</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($roles as $key => $li)

                                <tr>
                                    <td class="text-aqua">{{ $li -> id }}</td>
                                    <td class="text-green">{{ $li -> name }}</td>
                                    <td class="text-green">{{ $li -> display_name }}</td>
                                    <td class="text-green">{{ $li -> description }}</td>
                                    <td class="text-green">{{ $li -> created_at }}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a class="am-btn am-btn-default am-btn-xs am-text-primary" href="{{ route('rbac.role.edit',['id'=>$li->id]) }}"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                                                <a class="am-btn am-btn-default am-btn-xs am-text-primary" href="{{ route('rbac.role.permissions',$li->id) }}"><span class="am-icon-pencil-square-o"></span> 权限</a>
                                                <a class="am-btn am-btn-default am-btn-xs am-text-danger am-permission-delete" data-href="{{ route('rbac.role.destroy',['id'=>$li->id]) }}"><span class="am-icon-trash-o"></span> 删除</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>



                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>角色标识</th>
                            <th>角色名</th>
                            <th>说明</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop
@section('footer_js')
    <script type="text/javascript">
        $(function () {

            $('#example1').DataTable({

                "ordering": false

            });
        });
    </script>
@stop

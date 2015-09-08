@extends('layout._back')

@section('title') 城市管理 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')
    <h1>
        城市管理
        <small>列表</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">城市列表</li>
    </ol>
@stop

@section('content')
    <a href="{{ route('admin.city.create') }}" class="btn btn-primary margin-bottom">添加新城市</a>

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

                            <th>城市名称</th>
                            <th>城市标签</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($cities as $key => $li)
                            @if($li->pid == 0)
                                <tr>

                                    <td class="text-aqua">{{ $li -> name }}</td>
                                    <td class="text-green">{{ $li -> tag }}</td>
                                    <td> <a href="{{ route('admin.city.index') }}/{{ $li->id }}/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>  </td>
                                </tr>
                                @foreach($li->childrenCities as $li2)
                                    <tr>

                                        <td class="text-aqua">  &nbsp;&nbsp; -- {{ $li2 -> name }}</td>
                                        <td class="text-green">{{ $li2 -> tag }}</td>
                                        <td> <a href="{{ route('admin.city.index') }}/{{ $li2->id }}/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>  </td>
                                    </tr>
                                @endforeach
                            @endif

                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>

                            <th>城市名称</th>
                            <th>城市标签</th>
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

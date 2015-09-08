@extends('layout._back')

@section('title') 后台首页 @stop
{{-- 高亮显示 --}}
@section('sidebar_home')active @stop

@section('content-header')
    <h1>
        仪表板
        <small>控制盘</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">仪表板</li>
    </ol>
@stop

@section('content')
    <?php
    //检测PHP设置参数
    function show($varName)
    {
        switch($result = get_cfg_var($varName))
        {
            case 0:
                return '<font color="red">×</font>';
                break;

            case 1:
                return '<font color="green">√</font>';
                break;

            default:
                return $result;
                break;
        }
    }

    ?>
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
            <div class="box box-solid">
                <div class="content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="form-group">
                            <label>系统类型及版本号 </label>
                            <input type="text" class="form-control" value="{{  php_uname()  }}"  readonly>
                        </div>
                        <div class="form-group">
                            <label> 运行方式</label>
                            <input type="text" class="form-control" value="{{ php_sapi_name()  }}"  readonly>
                        </div>
                        <div class="form-group">
                            <label> 进程用户名</label>
                            <input type="text" class="form-control" value="{{ Get_Current_User() }}" readonly>
                        </div>
                        <div class="form-group">
                            <label> PHP版本</label>
                            <input type="text" class="form-control"  value="{{ PHP_VERSION }}" readonly>
                        </div>
                        <div class="form-group">
                            <label> PHP安全模式</label>
                            <?php echo show("safe_mode");?>
                        </div>
                        <div class="form-group">
                            <label> Zend版本</label>
                            <input type="text" class="form-control"  value="{{ Zend_Version() }}"  readonly>
                        </div>
                        <div class="form-group">
                            <label> 服务器IP</label>
                            <input type="text" class="form-control"  value="{{ GetHostByName($_SERVER['SERVER_NAME']) }}"  readonly>
                        </div>
                        <div class="form-group">
                            <label> 服务器解译引擎</label>
                            <input type="text" class="form-control"  value="{{ $_SERVER['SERVER_SOFTWARE'] }}"  readonly>
                        </div>
                        <div class="form-group">
                            <label> 服务器语言</label>
                            <input type="text" class="form-control"  value="{{ $_SERVER['HTTP_ACCEPT_LANGUAGE'] }}"  readonly>
                        </div>
                        <div class="form-group">
                            <label> 脚本占用最大内存</label>
                            <input type="text" class="form-control"  value="<?php echo show("memory_limit");?>"  readonly>
                        </div>
                        <div class="form-group">
                            <label> 脚本超时时间</label>
                            <input type="text" class="form-control"  value="<?php echo show("max_execution_time");?>秒"  readonly>
                        </div>
                        <div class="form-group">
                            <label> POST方法提交最大限制</label>
                            <input type="text" class="form-control"  value="<?php echo show("post_max_size");?>"  readonly>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="col-lg-6 connectedSortable">
            <!-- Map box -->
            <div class="box box-solid bg-light-blue-gradient">

            </div>
            <!-- /.box -->
        </section><!-- right col -->
    </div><!-- /.row (main row) -->
@stop

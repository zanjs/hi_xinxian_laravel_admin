<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>@section('title')  @show{{-- 页面标题 --}} | 嗨新鲜 </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="renderer" content="webkit">{{-- 360浏览器使用webkit内核渲染页面 --}}
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />{{-- IE(内核)浏览器优先使用高版本内核 --}}
    <meta name="author" content="{{ config('app.author') }}" />
    @include('widgets.head_links')
    <style>
        body{
            font-family: "Microsoft YaHei", "微软雅黑", "宋体";
        }
        .form_load{
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            height: 100%;
            background-color: rgba(0,0,0,0.3);

        }
        @media (max-width: 639px){
            .col-sm-12{
                overflow-x: scroll;
            }
            .table{
                width: 250%;

            }
        }
        /****DEBUT SPINNER****/
        #spinner {
            height : 40px;
            width : 40px;
            /*background-color : rgba(255,255,255,.3);*/
            border : 2px solid #61615e;
            border-left-color : transparent;
            border-right-color : transparent;
            border-radius : 50%;
            animation : spin 2s infinite;
            -webkit-animation : spin 2s infinite;
            position: absolute;
            top:  50%;
            left: 50%;
            margin-left: -20px;
        }

        @-webkit-keyframes spin {
            0% {-webkit-transform : rotate(0deg);}
            50% {-webkit-transform : rotate(360deg);}
            100% {-webkit-transform : rotate(0deg);}
        }

        @keyframes spin {
            0% {transform : rotate(0deg);}
            50% {transform : rotate(360deg);}
            100% {transform : rotate(0deg);}
        }
        /****FIN SPINNER****/
    </style>
</head>
<body class="skin-green sidebar-mini">
<div class="wrapper">
    @include('widgets.main_header')
    <!-- Left side column. contains the logo and sidebar -->
    @include('widgets.main_sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @section('content-header')  @show
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            @section('content')  @show

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>嗨新鲜后台管理系统</b> 2.0.1
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://blog.zanJs.com">YouYa</a></strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-user bg-yellow"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked />
                        </label>
                        <p>
                            Some information about this general settings option
                        </p>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked />
                        </label>
                        <p>
                            Other sets of options are available
                        </p>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked />
                        </label>
                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div><!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked />
                        </label>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right" />
                        </label>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->
    @include('widgets.foot_js')
    @section('footer_js')

    @show
<script type="text/javascript">
    $(document).ready(function(){
        <!--highlight main-sidebar-->
        {{-- URL::current() --}}
        {{-- Route::currentRouteName() --}}

        $('ul.treeview-menu>li').find('a[href="{{ cur_nav(Route::currentRouteName()) }}"]').closest('li').addClass('active');  //二级链接高亮
        $('ul.treeview-menu>li').find('a[href="{{ cur_nav(Route::currentRouteName()) }}"]').closest('li.treeview').addClass('active');  //一级栏目[含二级链接]高亮
        $('.sidebar-menu>li').find('a[href="{{ cur_nav(Route::currentRouteName()) }}"]').closest('li').addClass('active');  //一级栏目[不含二级链接]高亮

        $(document).pjax('a', 'body');

        @section('filledScript')
        @show{{-- 在document ready 里面填充一些JS代码 --}}
    });


</script>

</body>
</html>

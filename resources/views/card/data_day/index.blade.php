@extends('layout._back')

@section('title') 每日数据统计|总计 会员卡管理系统 @stop
{{-- 高亮显示 --}}
{{--@section('sidebar_product')active @stop--}}

@section('content-header')


    <link href="/echarts.baidu/asset/css/carousel.css" rel="stylesheet">
    <link href="/echarts.baidu/asset/css/echartsHome.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="/echarts.baidu/www/js/echarts.js"></script>
    <script src="/echarts.baidu/asset/js/codemirror.js"></script>
    <script src="/echarts.baidu/asset/js/javascript.js"></script>

    <link href="/echarts.baidu/asset/css/codemirror.css" rel="stylesheet">
    <link href="/echarts.baidu/asset/css/monokai.css" rel="stylesheet">
    <h1>
        每日数据统计|
        <small>会员卡管理系统</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">每日数据统计 | 总计</li>
    </ol>
@stop

@section('content')
    <a href="{{ route('card.data_day.index') }}" class="btn bg-navy margin-bottom">每日市场总和</a>
    @foreach($markets as $li)
        <a href="{{ route('card.data_day.index') }}/{{ $li->id }}" class="btn bg-purple margin-bottom">每日 - {{ $li->name }}</a>
    @endforeach
    <div class="row">
        <div class="col-xs-12">
            <div class="box content">
                <div class="container-fluid">
                    <div class="row-fluid example">
                        <div id="sidebar-code">
                            <div class="well sidebar-nav" style="display:none">
                                <div class="nav-header"><a href="#" onclick="autoResize()" class="glyphicon glyphicon-resize-full" id ="icon-resize" ></a>option</div>
                    <textarea id="code" name="code" >
option = {
    tooltip : {
        trigger: 'axis',
        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
        }
    },
    legend: {
        data:['充值金额','订单金额','混合订单','会员人数']
    },
    toolbox: {
        show : true,
        orient: 'vertical',
        x: 'right',
        y: 'center',
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : ['周一','周二','周三','周四','周五','周六','周日']
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'充值金额',
            type:'bar',

            data:[@foreach($rechargePrice as $li){{ $li }}, @endforeach]
        },
        {
            name:'订单金额',
            type:'bar',

            data:[@foreach($orderPrice as $li){{ $li }}, @endforeach]
        },
        {
            name:'混合订单',
            type:'bar',

            data:[@foreach($mixOrderPrice as $li){{ $li }}, @endforeach]
        },
        {
            name:'会员人数',
            type:'bar',
            data:[@foreach($cards as $li){{ $li }}, @endforeach]
        }

    ]
};
                    </textarea>
                            </div><!--/.well -->
                        </div><!--/span-->
                        <div id="graphic" class="col-md-12">
                            <div id="main" class="main"></div>
                            <div>
                                {{--<button type="button" class="btn btn-sm btn-success" onclick="refresh(true)">刷 新</button>--}}
                                <span class="text-primary">切换主题</span>
                                <select id="theme-select"></select>

                                <span id='wrong-message' style="color:red"></span>
                            </div>
                        </div><!--/span-->
                    </div><!--/row-->

                </div><!--/.fluid-container-->


            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->


@stop
@section('footer_js')

    <script src="/echarts.baidu/asset/js/echartsExample.js"></script>
    <script type="text/javascript">


    </script>
@stop

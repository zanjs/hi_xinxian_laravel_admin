{{-- widgets.main_sidebar --}}
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
       {{-- <div class="user-panel">
            <div class="pull-left image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>HiXinXian</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>--}}
        <!-- search form -->
       {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..." />
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>--}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            {{--<li class="header">主导航</li>
            <li class="@section('sidebar_home') @show treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>仪表盘</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route("admin.home") }}"><i class="fa fa-circle-o"></i>控制盘</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> 待开发 v2</a></li>
                </ul>
            </li>--}}
            <li class="@section('sidebar_product') @show treeview">
                <a href="#">
                    <i class="fa fa-weixin"></i>
                    <span>微商城系统</span>
                   {{-- <span class="label label-primary pull-right">6</span>--}}
                    {{--<i class="fa fa-angle-left pull-right"></i>--}}
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.product.index') }}"><i class="fa fa-sitemap"></i> 产品管理</a></li>
                    <li><a href="{{ route('admin.sort.index') }}"><i class="fa fa-navicon"></i> 产品分类</a></li>
                    <li><a href="{{ route('admin.order.index') }}"><i class="fa fa-calendar"></i> 订单管理</a></li>
                    <li><a href="{{ route('admin.merchant.index') }}"><i class="fa fa-user-md"></i> 商户管理</a></li>
                    <li><a href="{{ route('admin.city.index') }}"><i class="fa fa-paper-plane"></i> 城市管理</a></li>
                    <li><a href="#"><i class="fa fa-user-plus"></i> 用户管理</a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-credit-card"></i>
                    <span>会员卡系统</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('card.home') }}"><i class="fa fa-line-chart"></i> 今日大盘</a></li>
                    <li><a href="{{ route('card.data.index') }}"><i class="fa fa-bar-chart"></i> 总和数据</a></li>
                    <li><a href="{{ route('card.data_day.index') }}"><i class="fa fa-bar-chart"></i> 每日数据</a></li>
                    <li><a href="{{ route('card.card.index') }}"><i class="fa fa-user-plus"></i> 用户管理</a></li>
                    <li><a href="{{ route('card.product.index') }}"><i class="fa fa-reddit"></i> 产品管理</a></li>
                    <li><a href="{{ route('card.market.index') }}"><i class="fa fa-university"></i> 市场管理</a></li>
                    <li><a href="{{ route('card.operator.index') }}"><i class="fa fa-hand-o-up"></i> 职员管理</a></li>
                    {{--<li><a href="{{ route('card_record_payment') }}"><i class="fa fa-jpy"></i> 付款统计</a></li>--}}
                    <li><a href="{{ route('card.card_update.index') }}"><i class="fa fa-cc-mastercard"></i> 补卡记录</a></li>
                    <li><a href="{{ route('card.recharge.index') }}"><i class="fa fa-jpy"></i> 充值记录</a></li>
                    <li><a href="{{ route('card.cash_back.index') }}"><i class="fa fa-jpy"></i> 返现记录</a></li>
                    <li><a href="{{ route('card.message.index') }}"><i class="fa  fa-database"></i> 短信记录</a></li>
                    {{--<li><a href="{{ route('card.sms.index') }}"><i class="fa fa-envelope"></i> 短信群发</a></li>--}}
                    {{--<li><a href="{{ route('card_sms_jobs') }}"><i class="fa fa-envelope"></i> 群发队列</a></li>--}}
                    {{--<li><a href="{{ route('card_sms_record') }}"><i class="fa fa-envelope"></i> 群发任务</a></li>--}}
                    <li><a href="{{ route('card.order_count.index') }}"><i class="fa fa-bar-chart"></i> 订单统计</a></li>
                    <li><a href="{{ route('card.cash_order.index') }}"><i class="fa  fa-cart-plus"></i> 现金支付订单</a></li>
                    <li><a href="{{ route('card.mix_order.index') }}"><i class="fa  fa-cart-plus"></i> 混合支付订单</a></li>
                    <li><a href="{{ route('card.order.index') }}"><i class="fa  fa-cart-plus"></i> 会员卡支付订单</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa  fa-gears"></i>
                    <span>后台管理系统</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route("admin.home") }}"><i class="fa fa-circle-o"></i>控制盘</a></li>
                    <li><a href="{{ route('rbac.user.index') }}"><i class="fa fa-wrench"></i> 管理员</a></li>
                    <li><a href="{{ route('rbac.role.index') }}"><i class="fa fa-group"></i> 角色组</a></li>
                    <li><a href="{{ route('rbac.permission.index') }}"><i class="fa fa-sitemap"></i> 权限</a></li>
                    <li><a href="#"><i class="fa fa-book"></i> <span>后台使用说明</span></a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
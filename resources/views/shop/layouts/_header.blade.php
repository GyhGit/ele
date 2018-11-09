<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route("shop.user.index")}}">饿了吗</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">首页 <span class="sr-only">(current)</span></a></li>
                <li><a href="{{route("shop.activity.index")}}">活动</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商户管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shop.menu.index")}}">菜品分类列表</a></li>
                        <li><a href="{{route("shop.dishis.index")}}">菜品列表</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("shop.order.index")}}">用户订单</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("shop.order.day")}}">订单日销售</a></li>
                        <li><a href="{{route("shop.order.month")}}">订单月销售</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("shop.order.cday")}}">菜品日销售</a></li>
                        <li><a href="{{route("shop.order.cmonth")}}">菜品月销售</a></li>
                        <li><a href="{{route("shop.order.ctotal")}}">菜品总销售</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("shop.event.index")}}">活动列表</a></li>
                    </ul>
                </li>


            </ul>


            <ul class="nav navbar-nav navbar-right">
            @auth
                {{--// 用户已经通过身份认证...--}}

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i>欢迎：</i>{{\Illuminate\Support\Facades\Auth::user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shop.shops.apply")}}">申请店铺</a></li>
                        <li><a href="{{route("shop.user.edit")}}">修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("shop.user.logout")}}">安全退出</a></li>
                    </ul>
                </li>

            @endauth

            @guest
                {{--// 用户没有通过身份认证...--}}
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route("shop.user.login")}}">登录</a></li>
                    <li><a href="{{route("shop.user.reg")}}">注册</a></li>

                    @endguest






















            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
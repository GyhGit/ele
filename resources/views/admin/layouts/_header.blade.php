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
            <a class="navbar-brand" href="{{route("admin.admin.index")}}">饿了么管理后台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li><a href="#">管理守则</a></li>
            @foreach(\App\Models\Nav::where("pid",0)->get() as $k1=>$v1)
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$v1->name}} <span class="caret"></span></a>
                {{--@foreach(\App\Models\Nav::where("pid",$v1->id)->get() as $k7=>$v7)--}}

                    <ul class="dropdown-menu">
                        @foreach(\App\Models\Nav::where("pid",$v1->id)->get() as $k2=>$v2)
                        <li><a href="{{route($v2->url)}}">{{$v2->name}}</a></li>
                        @endforeach
                        {{--<li><a href="{{route("admin.shop_category.index")}}">店铺分类</a></li>--}}
                        {{--<li><a href="{{route("admin.admin.user")}}">商家信息</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{route("admin.activity.index")}}">活动列表</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{route("admin.admin.main")}}">管理列表</a></li>--}}
                        {{--<li><a href="{{route("admin.per.index")}}">权限设置</a></li>--}}
                        {{--<li><a href="{{route("admin.role.index")}}">权限角色</a></li>--}}
                    </ul>

                    {{--@endforeach--}}
                </li>

            @endforeach


            </ul>
            <ul class="nav navbar-nav navbar-right">

            @auth("admin")
                {{--// 用户已经通过身份认证...--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i>欢迎：</i>{{\Illuminate\Support\Facades\Auth::guard("admin")->user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("admin.admin.alter")}}">修改密码</a></li>

                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("admin.admin.logout")}}">安全退出</a></li>
                    </ul>
                </li>
            @endauth

            @guest("admin")
                {{--// 用户没有通过身份认证...--}}
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route("admin.admin.login")}}">登录</a></li>

                </ul>
            @endguest



        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
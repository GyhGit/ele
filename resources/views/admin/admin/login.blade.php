@extends("admin.layouts.main")
@section("title","管理员登录")
@section("content")

    <form class="form-horizontal" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">管理员名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="管理员名称" name="name" value="{{old("name")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">管理员密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" placeholder="管理员密码" name="password">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> 记住我
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">登录</button>
            </div>
        </div>
    </form>

@endsection

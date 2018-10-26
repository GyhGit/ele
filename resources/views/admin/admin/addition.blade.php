@extends("admin.layouts.main")
@section("title","管理员添加")
@section("content")

    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">管理员名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="管理员名称" name="name" value="{{old("name")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">管理员邮箱</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="管理员邮箱" name="email" value="{{old("email")}}">
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">管理员密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" placeholder="管理员密码" name="password" value="{{old("password")}}">
            </div>
        </div>



        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>

@endsection
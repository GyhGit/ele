@extends("shop.layouts.main")
@section("title","用户注册")
@section("content")
    <div class="box-header with-border" >
        <i class="box-title" ><font size="6" color="#8a2be2" >商户注册</font></i>
    </div>


    <form class="form-horizontal" method="post" >
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">商户名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="商户名称" name="name" value="{{old("name")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="邮箱" name="email" value="{{old("email")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="密码" name="password" value="{{old("password")}}">
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="确认密码" name="password_confirmation" value="{{old("password_confirmation")}}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">注册</button>
            </div>
        </div>
    </form>

@endsection
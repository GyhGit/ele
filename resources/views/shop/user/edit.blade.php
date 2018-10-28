@extends("shop.layouts.main")
@section("title","修改密码")
@section("content")
    <div class="box-header with-border" >
        <i class="box-title" ><font size="6" color="#8a2be2" >修改个人密码</font></i>
    </div>



    <div class="rows">
        {{--<div class="box-header with-border">--}}
            {{--<h3 class="box-title">商家密码修改</h3>--}}
        {{--</div>--}}
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="">
            {{ csrf_field() }}
            <div class="box-body">

                {{--<table class="table ">--}}
                    {{--<tr>--}}
                        {{--<label  class="col-sm-2 control-label">用户昵称</label>--}}
                        {{--<input  class="form-control"   value="{{route($user->name)}}">--}}

                    {{--</tr>--}}
                {{--</table>--}}

                <div class="form-group">
                    <label  class="col-sm-2 control-label">旧密码密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="旧密码密码" name="old_password" value="{{old("password")}}">
                    </div>
                </div>



                <div class="form-group">
                    <label  class="col-sm-2 control-label">新密码</label>

                    <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="新密码" name="password" value="{{old("password")}}">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-2 control-label">确认密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="确认密码" name="password_confirmation" value="{{old("password")}}">
                    </div>
                </div>


            </div>
            <!-- /.box-body -->
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">修改</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>

@endsection

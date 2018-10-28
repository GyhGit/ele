@extends("admin.layouts.main")
@section("title","用户列表")
@section("content")

    <div class="rows" >
        {{--<h3 style="color: #00a7d0"> >>>>>商户信息 </h3>--}}
        <table class="table table-bordered">
            <tr>
                <td>账户编号</td>
                <td>用户名称</td>
                <td>店铺名称</td>
                <td>用户邮箱</td>
                <td>操作</td>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>

                    <td>
                        @if($user->shop){{$user->shop->shop_name}}@endif
                    </td>
                    <td>{{$user->email}}</td>

                    <td>
                        {{--<a href="#" class="btn btn-success">编辑</a>--}}
                        <a href="{{route("admin.admin.default",$user->id)}}" class="btn btn-warning">重置密码</a>
                        @if(!$user->shop)
{{--                            {{route('admin.shop.add')}}--}}
                            <a href="#" class="btn btn-success">添加店铺</a>
                        @endif
                        <a href="{{route("admin.admin.delete",$user->id)}}" class="btn btn-danger">删除</a>

                    </td>
                </tr>
            @endforeach
        </table>
    </div>


@endsection
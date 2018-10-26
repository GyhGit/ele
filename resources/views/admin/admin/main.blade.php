@extends("admin.layouts.main")
@section("title","管理员列表")


@section("content")
    <a href="{{route("admin.admin.addition")}}" class="btn btn-info">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>管理员编号</th>
            <th>管理员名称</th>
            <th>管理员邮箱</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>
                    <a href="{{route("admin.admin.redact",$admin->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route("admin.admin.rm",$admin->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach



    </table>



@endsection
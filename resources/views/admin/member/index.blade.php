@extends("admin.layouts.main")
@section("title","会员列表")
@section("content")



    <table class="table">
        <tr>
            <th>ID</th>
            <th>用户名称</th>
            <th>用户电话</th>
            <th>用户余额</th>
            <th>用户积分</th>
            <th>用户状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>{{$member->username}}</td>
                <td>{{$member->tel}}</td>
                <td>{{$member->money}}</td>
                <td>{{$member->jifen}}</td>
                <td>
                    @if($member->status == 1)
                        <span class="btn  btn-danger">会员</span>
                    @elseif($member->status == 0)
                        <span class="btn  btn-default">非会员</span>
                    @endif
                </td>
                <td>
                    <a href="#" class="btn btn-info">查看</a>

                    @if($member->status===0)
                        <a href="#" class="btn btn-info">禁用</a>
                    @endif

                </td>
            </tr>
        @endforeach

    </table>


@endsection
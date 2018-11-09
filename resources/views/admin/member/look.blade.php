@extends("admin.layouts.main")
@section("title","会员管理")

@section("content")

    <div class="container-fluid">
        <div class="pull-right">
            <a href="javascript:history.back(-1)" class="btn btn-info">返回</a>
        </div>

            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>会员名称</th>
                    <th>电话</th>
                    <th>余额</th>
                    <th>积分</th>
                </tr>
                {{--@foreach($members as $member)--}}
                    <tr>
                        <td>{{$members->id}}</td>
                        <td>{{$members->username}}</td>
                        <td>{{$members->tel}}</td>
                        <td>{{$members->money}}</td>
                        <td>{{$members->jifen}}</td>
                    </tr>
                {{--@endforeach--}}
            </table>

    </div>

@endsection

@extends("admin.layouts._footer")
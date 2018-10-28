@extends("shop.layouts.main")
@section("title","活动列表")


@section("content")
    {{--<a href="{{route("admin.activity.add")}}" class="btn btn-info">添加</a>--}}
    <table class="table table-bordered">
        <tr>
            <th>活动编号</th>
            <th>活动标题</th>
            {{--<th>活动内容</th>--}}
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($activitys as $activity)
            <tr>
                <td>{{$activity->id}}</td>
                <td>{{$activity->title}}</td>
{{--                <td>{{$activity->content}}</td>--}}
                <td>{{$activity->start_time}}</td>
                <td>{{$activity->end_time}}</td>
                <td>
                    <a href="{{route("shop.activity.check",$activity->id)}}" class="btn btn-success">查看</a>
{{--                    <a href="{{route("admin.activity.del",$activity->id)}}" class="btn btn-danger">删除</a>--}}
                </td>
            </tr>
        @endforeach



    </table>



@endsection
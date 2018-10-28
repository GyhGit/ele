@extends("admin.layouts.main")
@section("title","活动列表")


@section("content")


    <div class="row">
        <div class="col-md-4">
            <a href="{{route("admin.activity.add")}}" class="btn btn-info">添加活动</a>
        </div>
        <div class="col-md-8">
            <form class="form-inline pull-right" method="get">
                <div class="form-group">
                    <select name="time" class="form-control">
                        <option value="">请选择时间</option>
                        {{--@foreach($cate as $a)--}}
                        {{--<option value="{{$a->id}}">{{$a->name}}</option>--}}
                        {{--@endforeach--}}
                        <option value="1">活动进行中</option>
                        <option value="2">已结束活动</option>
                        <option value="3">未开展活动</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keyword")}}">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
    </div>












{{--    <a href="{{route("admin.activity.add")}}" class="btn btn-info">添加</a>--}}
    <table class="table table-bordered">
        <tr>
            <th>活动编号</th>
            <th>活动标题</th>
            <th>活动内容</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($activitys as $activity)
            <tr>
                <td>{{$activity->id}}</td>
                <td>{{$activity->title}}</td>
                <td>{{$activity->content}}</td>
                <td>{{$activity->start_time}}</td>
                <td>{{$activity->end_time}}</td>
                <td>
                    <a href="{{route("admin.activity.edit",$activity->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route("admin.activity.del",$activity->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach



    </table>

    {{$activitys->links()}}
@endsection
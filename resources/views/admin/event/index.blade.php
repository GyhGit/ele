@extends("admin.layouts.main")
@section("title","活动列表")
@section("content")
    <div class="container-fluid">
        <a href="{{route("admin.event.add")}}" class="btn btn-info">添加</a>
        <table class="table table-bordered">

            <tr>
                <th>编号</th>
                <th>名称</th>
                <th>详情</th>
                <th>报名开始时间</th>
                <th>报名结束时间</th>
                <th>开奖时间</th>
                <th>报名人数限制/总数</th>
                <th>是否已开奖</th>
                <th>操作</th>

            </tr>
            @foreach($events as $event)
                <tr>
                    <td>{{$event->id}}</td>
                    <td>{{$event->title}}</td>
                    <td>{{$event->content}}</td>
                    <td>{{date('y-m-d H:i:s',$event->start_time)}}</td>
                    <td>{{date('y-m-d H:i:s',$event->end_time)}}</td>
                    <td>{{date('y-m-d H:i:s',$event->prize_time)}}</td>
                    <td>{{$event->users->count()}}/{{$event->num}}</td>
                    <td>
                        @if($event->is_prize == 0)
                            <a href="{{route("admin.event.open",[$event->id])}}" class="btn btn-danger">未开奖</a>
                        @elseif($event->is_prize == 1)
                            <a href="#" class="btn btn-info">已开奖</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{route("admin.event.edit",$event->id)}}" class="btn btn-success">编辑</a>
                        <a href="{{route("admin.event.result",$event->id)}}" class="btn btn-success">中奖</a>
                        <a href="{{route("admin.event.del",$event->id)}}" class="btn btn-danger">删除</a>
                    </td>
                </tr>

            @endforeach
        </table>

    </div>
@endsection
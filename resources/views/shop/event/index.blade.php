@extends("shop.layouts.main")
@section("title","抽奖活动")
@section("content")

<br/><br/>
    <table class="table">
        <tr>
            <th>活动编号</th>
            <th>活动标题</th>
            <th>活动内容</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>开奖时间</th>
            <th>报名人数限制</th>
            <th>是否开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{{$event->content}}</td>
                <td>{{date('Y-m-d H:i:s',$event->start_time)}}</td>
                <td>{{date('Y-m-d H:i:s',$event->end_time)}}</td>
                <td>{{date('Y-m-d H:i:s',$event->prize_time)}}</td>
                <td>@if(\Illuminate\Support\Facades\Redis::scard("event:".$event->id))
                        {{\Illuminate\Support\Facades\Redis::scard("event:".$event->id)}}
                    @else
                        {{\App\Models\EventUser::where('event_id',$event->id)->count()}}
                    @endif
                    /{{$event->num}}


                </td>
                <td>
                @if($event->is_prize == 1)
                    <span class="btn  btn-danger">已开奖</span>
                @elseif($event->is_prize == 0)
                    <span class="btn  btn-default">未开奖</span>
                @endif
                </td>
                <td>
                    @if(time()>$event->start_time && time()<$event->end_time && $event->users->count()<$event->num)
                        <a href="{{route("shop.event.sign",[$event->id])}}" class="btn btn-danger">报名</a>
                    @endif
                        <a href="{{route("shop.event.result",[$event->id])}}" class="btn btn-danger">中奖情况</a>

                </td>
            </tr>
        @endforeach

    </table>


@endsection


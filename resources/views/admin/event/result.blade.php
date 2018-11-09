@extends("admin.layouts.main")
@section("title","中奖列表")
@section("content")

    <br/><br/>
    <table class="table">
        <tr>
            <th>获奖编号</th>
            <th>活动id</th>
            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖用户</th>


        </tr>
        @foreach($eventPrizes as $eventPrize)
            <tr>
                <td>{{$eventPrize->id}}</td>
                <td>{{$eventPrize->event->title}}</td>
                <td>{{$eventPrize->name}}</td>
                <td>{{$eventPrize->description}}</td>
                <td>{{$eventPrize->users->name}}</td>
            </tr>
        @endforeach

    </table>


@endsection

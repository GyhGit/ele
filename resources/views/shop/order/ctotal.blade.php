@extends("shop.layouts.main")
@section("title","菜品总销售")
@section("content")

    <table class="table">
        <tr>
            {{--<th>日期</th>--}}
            <th>订单数量</th>
            <th>总计金额</th>
        </tr>
        @foreach($data as $datas)
            <tr>
{{--                <td>{{$datas->date}}</td>--}}
                <td>{{$datas->nums}}</td>
                <td>{{$datas->money}}</td>
            </tr>
        @endforeach

    </table>


@endsection

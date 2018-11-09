@extends("admin.layouts.main")
@section("title","订单整体")

@section("content")

    <div class="container-fluid">

        <table class="table">
                <tr>
                    <th>全部订单数量</th>
                    <th>金额</th>
                </tr>
                @foreach($data as $dt)
                    <tr>
                        <td>{{$dt->nums}}</td>
                        <td>{{$dt->money}}</td>
                    </tr>
                @endforeach
        </table>

    </div>

@endsection

@extends("admin.layouts._footer")
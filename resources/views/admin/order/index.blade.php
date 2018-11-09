@extends("admin.layouts.main")
@section("title","订单展示")

@section("content")

    <div class="container-fluid">
        <div class="col-md-12">

            <form class="form-inline pull-right" method="get">

                <div class="form-group">
                    <input type="date" class="form-control" placeholder="开始时间" size="5" name="start_time"
                           value="{{request()->get("start_time")}}">
                </div>
                -
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="结束时间" size="5" name="end_time"
                           value="{{request()->get("end_time")}}">
                </div>

                <button type="submit" class="btn btn-primary">搜索</button>

            </form>

        </div>

        <table class="table">

            <tr>
                <th>店铺Id</th>
                <th>订单数量</th>
                <th>金额</th>

            </tr>
            @foreach($data as $dat)
                <tr>
                    <td>{{$dat->shop_id}}</td>
                    <td>{{$dat->nums}}</td>
                    <td>{{$dat->money}}</td>
                </tr>
            @endforeach
        </table>

    </div>

@endsection

@extends("admin.layouts._footer")
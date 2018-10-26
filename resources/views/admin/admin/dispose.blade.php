@extends("admin.layouts.main")
@section("title","申请处理")
@section("content")
    <div class="rows">
        <table class="table table-bordered">
            <tr>
                <td>申请编号</td>
                <td>申请账号</td>
                <td>店铺名字</td>
                <td>店铺分类</td>
                <td>起送金额</td>
                <td>配送金额</td>
                <td>品牌连锁店</td>
                <td>准时送达</td>
                <td>蜂鸟配送</td>
                <td>保</td>
                <td>票</td>
                <td>准</td>
                <td>图片</td>
                <td>状态</td>
                <td>操作</td>
            </tr>
            @foreach($shopse as $shops)
                <tr>
                    <td>{{$shops->id}}</td>
                    <td>{{$shops->user->name}}</td>
                    <td>{{$shops->shop_name}}</td>
                    <td>{{$shops->shop_category->name}}</td>
                    <td>{{$shops->start_send}}</td>
                    <td>{{$shops->send_cost}}</td>
                    <td>@if($shops->brand)是@else否@endif</td>
                    <td>@if($shops->on_time)是@else否@endif</td>
                    <td>@if($shops->fengniao)是@else否@endif</td>
                    <td>@if($shops->bao)是@else否@endif</td>
                    <td>@if($shops->piao)是@else否@endif</td>
                    <td>@if($shops->zhun)是@else否@endif</td>
                    <td><img src="/{{$shops->shop_img}}" width="50" alt=""></td>
                    <td>
                        @if($shops->status == 1)
                         <spaan class="btn btn-block btn-success">已审核</spaan>
                        @elseif($shops->status == 0)
                            <span class="btn btn-block btn-info">待审核</span>
                            @elseif($shops->status == -1)
                               <span class="btn btn-block btn-danger">已禁用</span>
                        @endif
                    </td>
                    <td>
                        <a href="#" class="btn  btn-danger">删除</a>

                        <a href="{{route("admin.admin.audit",$shops->id)}}" class="btn  btn-success">已审核</a>
                        <a href="{{route("admin.admin.check",$shops->id)}}" class="btn  btn-info">待审核</a>

                        <a href="{{route("admin.admin.forbidden",$shops->id)}}" class="btn btn-danger">禁用</a>
                    </td>
                </tr>
            @endforeach
        </table></div>


@endsection
@extends("shop.layouts.main")
@section("title","菜品列表")


@section("content")
    <div>
    <a href="{{route("shop.dishis.add")}}" class="btn btn-info pull-left">添加</a>
    </div>
    <div class="col-md-8">
        <form class="form-inline pull-right" method="get">
            <div class="form-group">
                <select name="shop_id" class="form-control">
                    <option value="">请选择分类</option>
                    @foreach($cate as $a)
                        <option value="{{$a->id}}">{{$a->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  placeholder="最低价" size="5" name="minPrice" value="{{request()->get("minPrice")}}">
            </div>
            -
            <div class="form-group">
                <input type="text" class="form-control"  placeholder="最高价" size="5" name="maxPrice"  value="{{request()->get("maxPrice")}}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keword")}}">
            </div>
            <button type="submit" class="btn btn-primary">搜索</button>
        </form>

    </div>



        <table class="table table-bordered">
        <tr>
            <th>菜品编号</th>
            <th>菜品名称</th>
            <th>菜品评分</th>
            <th>所属商家</th>
            <th>所属分类</th>
            <th>菜品价格</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>商品图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->rating}}</td>
                <td>

                    @if($menu->menu_shop)
                        {{$menu->menu_shop->shop_name}}
                    @endif
                </td>
                <td>
                    @if($menu->menu_category)
                        {{$menu->menu_category->name}}
                    @endif
                </td>

                {{--<td>{{$menu->shop_id}}</td>--}}
                {{--<td>{{$menu->category_id}}</td>--}}
                <td>{{$menu->goods_price}}</td>
                <td>{{$menu->month_sales}}</td>
                <td>{{$menu->rating_count}}</td>
                <td>{{$menu->satisfy_count}}</td>
                <td>{{$menu->satisfy_rate}}</td>
                <td><img src="{{$menu->goods_img}}?x-oss-process=image/resize,m_fill,w_60,h_60"></td>

                <td>
                    <?php if ($menu['status']==1)
                    {echo "上架";}
                    else{echo "下架";} ?>

                </td>
                <td>
                    <a href="{{route("shop.dishis.edit",$menu->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route("shop.dishis.del",$menu->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach



    </table>

{{$menus->appends($url)->links()}}


@endsection
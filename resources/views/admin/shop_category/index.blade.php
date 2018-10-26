@extends("admin.layouts.main")
@section("title","分类首页")


@section("content")
    <a href="{{route("admin.shop_category.add")}}" class="btn btn-info">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>分类编号</th>
            <th>分类名称</th>
            <th>分类图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shop_categorys as $shop_category)
            <tr>
                <td>{{$shop_category->id}}</td>
                <td>{{$shop_category->name}}</td>
                {{--<td>{{$shop_category->img}}</td>--}}
                <td><img src="/{{$shop_category->img}}" width="50" alt=""></td>
                <td>
                    <?php if ($shop_category['status']===1)
                    {echo "显示";}
                    else{echo "隐藏";} ?>

                </td>
                <td>
                    <a href="{{route("admin.shop_category.edit",$shop_category->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route("admin.shop_category.del",$shop_category->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach



    </table>



@endsection
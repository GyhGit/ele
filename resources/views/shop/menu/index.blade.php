@extends("shop.layouts.main")
@section("title","菜品分类")







@section("content")
    <a href="{{route("shop.menu.add")}}" class="btn btn-info">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>分类编号</th>
            <th>分类名称</th>
            <th>菜品编号</th>
            <th>所属商家</th>
            <th>是否默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->name}}</td>
                <td>{{$menu->type_accumulation}}</td>
                <td>
                    @if($menu->menu_category)
                        {{$menu->menu_category->shop_name}}
                      @endif
                </td>
                <td>
                    <?php if ($menu['is_selected']==1)
                    {echo "是";}
                    else{echo "否";} ?>

                </td>
                <td>
                    <a href="{{route("shop.menu.edit",$menu->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route("shop.menu.del",$menu->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach



    </table>



@endsection
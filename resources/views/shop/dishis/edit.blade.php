
@extends("shop.layouts.main")
@section("title","菜品添加")
@section("content")
    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  placeholder="菜品名称" name="goods_name" value="{{"$menu->goods_name"}}">
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label">类型</label>
            <div class="col-sm-10">
                <select name="category_id"  class="form-control">
                    <option value="">选择菜品分类</option>
                    @foreach($menus as $men)
                        <option value="{{$men->id}}"  @if($men->id == $menu->category_id) selected @endif >
                            {{$men->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">价格</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  placeholder="价格" name="goods_price" value="
{{$menu->goods_price}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">提示信息</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  placeholder="提示信息" name="tips" value="{{"$menu->tips"}}">
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label">图片</label>
            <div class="col-sm-10">
                <input type="file" name="img">
                <img src="/{{$menu->goods_img}}" width="50" >
            </div>
        </div>


        <div class="form-group">
            <label  class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <textarea rows="4"  class="form-control" name="description" placeholder="描述">{{"$menu->description"}}</textarea>

            </div>
        </div>



        <div class="form-group">
            <label for="discount" class="col-sm-2 control-label">是否上架</label>
            <div class="col-sm-10">
                <input name="status" type="radio" value="1"  @if ($menu->status==1) checked @endif>上架
                <input name="status" type="radio" value="0" @if($menu->status==0) checked @endif>下架

            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">编辑</button>
            </div>
        </div>
    </form>
@endsection





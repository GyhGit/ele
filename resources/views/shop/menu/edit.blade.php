@extends("shop.layouts.main")
@section("title","菜品分类编辑")
@section("content")
<div class="box-header with-border" >
    <i class="box-title" ><font size="6" color="#8a2be2" >菜品分类编辑</font></i>
</div>




    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="分类名称" name="name" value="{{$menu->name}}">
            </div>
        </div>

        <div class="form-group">
            <label for="type_accumulation" class="col-sm-2 control-label">菜品编号</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="type_accumulation" placeholder="菜品编号" name="type_accumulation" value="{{$menu->type_accumulation}}">
            </div>
        </div>


        {{--<div class="form-group">--}}
            {{--<label for="shop_id" class="col-sm-2 control-label">所属商家</label>--}}
            {{--<div class="col-sm-10">--}}

                {{--<select class="form-control" name="shop_id">--}}

                    {{--@foreach($menus as $menu)--}}
                        {{--<option value="{{$menu->id}}">{{$menu->name}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">分类描述</label>
            <div class="col-sm-10">
                <textarea rows="3" class="form-control"  name="description" placeholder="分类描述">{{$menu->description}}</textarea>
                {{--<input type="text" class="form-start_send" id="discount" placeholder="店铺信息" name="discount" value="{{old("discount")}}">--}}
            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--<label  class="col-sm-2 control-label">店铺图片</label>--}}
            {{--<div class="col-sm-10">--}}
                {{--<input type="file" class="" name="img">--}}

            {{--</div>--}}
        {{--</div>--}}



        <div class="form-group">
            <label for="is_selected" class="col-sm-2 control-label">分类是否默认</label>
            <div class="col-sm-10">
                <input type="radio" name="is_selected" value="1" @if (old("is_selected")==1) checked @endif>是
                <input type="radio" name="is_selected" value="0" @if(old("is_selected")==1) checked @endif>否

            </div>
        </div>







        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">修改</button>
            </div>
        </div>
    </form>

@endsection
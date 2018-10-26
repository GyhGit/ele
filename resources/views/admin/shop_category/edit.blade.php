@extends("admin.layouts.main")
@section("title","分类修改")
@section("content")

    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="店铺名称" name="name" value="{{$shop_category->name}}">
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label">店铺图片</label>
            <div class="col-sm-10">
                <input type="file" class="" name="img" value="">
                <img src="/{{$shop_category->name}}" width="50" alt="">

            </div>
        </div>



        <div class="form-group">
            <label for="status" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-10">
                <input type="radio" name="status" value="1" @if($shop_category->status==1 )
                    checked
                @endif>显示
                <input type="radio" name="status" value="0"  @if($shop_category->status==0 )
                checked
                        @endif>隐藏
            </div>
        </div>






        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>

@endsection
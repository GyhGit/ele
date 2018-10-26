@extends("admin.layouts.main")
@section("title","分类添加")
@section("content")

    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="店铺名称" name="name" value="{{old("name")}}">
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label">店铺图片</label>
            <div class="col-sm-10">
                <input type="file" class="" name="img">

            </div>
        </div>



        <div class="form-group">
            <label for="status" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-10">
                <input type="radio" name="status" value="1" >显示
                <input type="radio" name="status" value="0" >隐藏
            </div>
        </div>






        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>

@endsection
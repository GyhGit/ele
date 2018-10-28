@extends("admin.layouts.main")
@section("title","活动添加")
@include('vendor.ueditor.assets')

@section("content")
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>

    <div class="box-header with-border" >
        <i class="box-title" ><font size="6" color="#8a2be2" >活动添加</font></i>
    </div>


    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">活动标题</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" placeholder="活动标题" name="title" value="{{old("title")}}">
            </div>
        </div>

        <div class="form-group">


            <div class="form-group">
                <label for="content" class="col-sm-2 control-label">活动详情</label>
                <div class="col-sm-10">
                    <script id="container" name="content" type="text/plain"></script>
                </div>
            </div>
         </div>
        <div class="form-group">
            <label for="start_time" class="col-sm-2 control-label">活动开始时间</label>
            <div class="col-sm-10">
                <input type="date"  class="form-control" placeholder="活动结束时间" name="start_time" value="{{old("start_time")}}">
            </div>
        </div>


        <div class="form-group">
            <label for="end_time" class="col-sm-2 control-label">活动结束时间</label>
            <div class="col-sm-10">
                <input type="date"  class="form-control" placeholder="活动结束时间" name="end_time" value="{{old("end_time")}}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>

@endsection
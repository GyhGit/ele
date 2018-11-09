@extends("admin.layouts.main")
@section("title","抽奖活动添加")
@section("content")
    <div class="box-header with-border" >
        <i class="box-title" ><font size="6" color="#8a2be2" >抽奖活动添加</font></i>
    </div>

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" placeholder="名称">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">详情</label>
            <div class="col-sm-10">
                <input type="text" name="content" class="form-control" placeholder="详情">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">报名开始时间</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="start_time" class="form-control" placeholder="报名开始时间">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">报名结束时间</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="end_time" class="form-control" placeholder="报名结束时间">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">开奖时间</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="prize_time" class="form-control" placeholder="开奖时间">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">报名人数限制</label>
            <div class="col-sm-10">
                <input type="text" name="num" class="form-control" placeholder="报名人数限制">
            </div>
        </div>

        {{--<div class="form-group">--}}
            {{--<label for="status" class="col-sm-2 control-label">是否已开奖</label>--}}
            {{--<div class="col-sm-10">--}}
                {{--<input type="radio" name="is_prize" value="1" >未开奖--}}
                {{--<input type="radio" name="is_prize" value="0" >已开奖--}}
            {{--</div>--}}
        {{--</div>--}}



        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>
@endsection
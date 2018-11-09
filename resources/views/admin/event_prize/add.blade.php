@extends("admin.layouts.main")
@section("title","奖品添加")
@section("content")
    <div class="box-header with-border" >
        <i class="box-title" ><font size="6" color="#8a2be2" >奖品添加</font></i>
    </div>

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">活动id</label>
            <div class="col-sm-10">
                <select name="event_id" class="form-control" >
                    <option value="">请选择活动</option>
                    @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">奖品名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="奖品名称">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">奖品详情</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="description"  rows="3"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>
@endsection
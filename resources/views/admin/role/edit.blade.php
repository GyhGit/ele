@extends("admin.layouts.main")

@section("content")
    <a href="javascript:history.go(-1);" class="btn btn-info">返回</a>
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" value="{{$roles->name}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">权限</label>
            <div class="col-sm-10">
                @foreach( $pers as $per)
                <input type="checkbox" name="pers[]"  value="{{$per->id}}" {{in_array($per->id,$rol)?'checked':""}}>
                {{$per->intro}}
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>
@endsection
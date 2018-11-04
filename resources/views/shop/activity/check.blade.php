@extends("admin.layouts.main")
@section("title","活动详情")
@include('vendor.ueditor.assets')

@section("content")


    <div class="form-group">
        <div class="form-group">
            <label for="content" class="col-sm-2 control-label">活动详情</label>
            {{--<div class="col-sm-10">--}}
                {{--<input type="text" name="content" value="{{$activity->content}}">--}}
                {{--<script id="container" name="content" type="text/plain">{{$activity->content}}</script>--}}
                <textarea class="form-control" rows="38" disabled>
                    {{$activity->content}}
                </textarea>
            {{--</div>--}}
        </div>
    </div>

@endsection
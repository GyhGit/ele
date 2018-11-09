<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends BaseController
{


    //显示所有活动列表
    public function index(Request $request)
    {
        $url = $request->query();
        $time = $request->get("time");
        $keyword = $request->get("keyword");
        //有效期内
        //$date = date('Y-m-d',time());
        $query = Activity::orderBy("id");
        //得到当前时间
        $date = date('Y-m-d H:i:s', time());
        //判断时间  1 进行 2 结束 3 未开始
        if ($time == 1) {
            $query->where("start_time", "<=", $date)->where("end_time", ">", $date);
        }
        if ($time == 2) {
            $query->where("end_time", "<", $date);
        }
        if ($time == 3) {
            $query->where("start_time", ">", $date);
        }
        //内容搜索
        if ($keyword !== null) {
            $query->where("title", "like", "%{$keyword}%")->orWhere("content", "like", "%{$keyword}%");
        }

        $activitys = $query->paginate(2);
//        dd($date);
        return view("admin.activity.index", compact("activitys", "url"));

    }




    //活动添加
    public function add(Request $request)
    {
        if ($request->isMethod("post")) {
            $this->validate($request, [
                'title' => 'required',
                "content" => "required",

            ]);

//         $id = Auth::user()->id;
//         //dd($id);
//         $data['shop_id'] = $id;
            //添加
            $data = $request->post();
            Activity::create($data);
//         Activity::create($data);
            //跳转
            return redirect()->route("admin.activity.index")->with("success", "活动添加成功");
        }
        return view("admin.activity.add");
    }

    //活动编辑
    public function edit(Request $request, $id)
    {
        //找到id
        $activity = Activity::find($id);
        //判断提交方式
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'title' => 'required',
                "content" => "required",
            ]);
            //接收数据
            $data = $request->post();
            //添加
            if ($activity->update($data)) {
                return redirect()->route("admin.activity.index")->with("success", "修改活动成功");
            }
        }
        //跳转
        return view("admin.activity.edit", compact("activity"));
    }

    public function del($id)
    {

        $activity = Activity::find($id);

        if ($activity->delete()) {
            return redirect()->route("admin.activity.index")->with("success", "删除活动成功");
        }
    }


}

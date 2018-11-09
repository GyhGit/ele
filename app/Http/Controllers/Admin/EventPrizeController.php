<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventPrizeController extends BaseController
{

    /**奖品列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $prizes = EventPrize::all();
//        dd($prizes);
        return view("admin.event_prize.index", compact("prizes"));
    }


    //添加活动奖品
    public function add(Request $request)
    {
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'name' => 'required',
                'event_id' => 'required'
            ]);
            $data =$request->post();
            //dd($data);
            EventPrize::insert([
                'event_id'=>$data['event_id'],
               'name'=>$data['name'],
                'description'=>$data['description'],
                'user_id'=>0
            ]);
            $data['user_id']=0;
           // EventPrize::create($data);
            return redirect()->route('admin.event_prize.index')->with('success', '添加奖品成功');
        }
        $events = Event::all();
//         dd($events);
        return view("admin.event_prize.add", compact("events"));
    }


    //编辑活动奖品
    public function edit(Request $request, $id)
    {
        $prize = EventPrize::find($id);
        //判断提交方式
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                "title" => 'required',
                "num" => 'required',
            ]);
            //接收参数
            $data = $request->post();
            if ($prize->update($data)) {
                return redirect()->route('admin.event_prize.index')->with("修改奖品成功");
            }
        }

        return view("admin.event_prize.edit", compact("prize"));
    }


    //删除
    public function del($id)
    {
        $prize = EventPrize::find($id);
        if ($prize->delete()) {
            return redirect()->route('admin.event_prize.index')->with("删除奖品成功");
        }

    }
}

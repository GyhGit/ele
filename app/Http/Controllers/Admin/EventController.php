<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class EventController extends BaseController
{

    /**抽奖列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Event::all();
        return view("admin.event.index", compact("events"));
    }

    /**抽奖添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    public function add(Request $request)
    {
        if ($request->isMethod("post")) {


            $this->validate($request, [
                'title' => 'required',
                'num' => 'required',
            ]);
            $data = $request->post();
            $data['start_time'] = strtotime($data['start_time']);
            $data['end_time'] = strtotime($data['end_time']);
            $data['prize_time'] = strtotime($data['prize_time']);
            $data['is_prize'] = 0;
            if (Event::create($data)) {
                //把报名人数添加到redis中
                Redis::set("event_num:".$event->id,$event->num);
                return redirect()->route('admin.event.index')->with("添加抽奖活动成功");
            }
        }
        return view('admin.event.add');
    }

    /**编辑抽奖活动
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    public function edit(Request $request, $id)
    {
        $event = Event::find($id);
        //判断提交方式
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                "title" => 'required',
                "num" => 'required',
            ]);
            //接收参数
            $data = $request->post();
            $data['start_time'] = strtotime($data['start_time']);
            $data['end_time'] = strtotime($data['end_time']);
            $data['prize_time'] = strtotime($data['prize_time']);
            if ($event->update($data)) {
                return redirect()->route('admin.event.index')->with("添加修改成功");
            }
        }

        return view("admin.event.edit", compact("event"));
    }

    /**删除抽奖活动
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del($id)
    {
        $event = Event::find($id);
        if ($event->delete()) {
            return redirect()->route('admin.event.index')->with("删除成功");
        }

    }

    //活动开奖
    public function open(Request $request, $id)
    {
        //开奖把数据从redis同步过来
        $users = Redis::smembers("event:" . $id);
//         dd($users);
        foreach ($users as $user) {
            EventUser::insert([
                "event_id" => $id,
                "user_id" => $user
            ]);
        }
        //1.通过当前活动ID把已经报名的用户ID取出来、
        $userIds = DB::table('event_users')->where('event_id', $id)->pluck('user_id')->toArray();
//           dd($userId);
        //打乱ID
        shuffle($userIds);
        //找出当前活动的奖品 并随机打乱
        $prizes = EventPrize::where("event_id", $id)->get()->shuffle();
//         dd($prizes);
        //奖品表
        foreach ($prizes as $k => $prize) {
            //给用户赋值
            $prize->user_id = $userIds[$k];
            //得到用户信息
            $userId = User::find($prize->user_id);

            //得到用户邮箱
            $email = $userId['email'];
            //用户名字
            $name = $userId['name'];
            $shopName = $name;
            $to = $email;
            $subject = $shopName . '中奖通知';
            \Illuminate\Support\Facades\Mail::send(
                'emails.prize',
                compact("shopName"),
                function ($message) use ($to, $subject) {
                    $message->to($to)->subject($subject);
                }
            );

            //保存修改状态
            $prize->save();


        }
        //修改活动状态
        $event = Event::findOrFail($id);
        $event->is_prize = 1;
        $event->save();
        return redirect()->route('admin.event.index')->with('success', '开奖成功');
    }

    //中奖列表
    public function result($id){
        $eventPrizes=EventPrize::where("event_id",$id)->get();

        return view("admin.event.result",compact("eventPrizes"));

    }


}

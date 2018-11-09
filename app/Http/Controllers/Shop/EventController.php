<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class EventController extends MainController
{
    public function index()
    {
        $events = Event::all();
        return view("shop.event.index", compact('events'));
    }

    //报名抽奖活动
    public function sign(Request $request, $id)
    {
//        $event=Event::find($id);
        $eventId = $id;
        $userId = $request->input('user_id');
//        dd (111);
        //得到当前报名人数
//        $num=EventUser::where("event_id",$event->id)->count();

//        $user=EventUser::where("user_id",Auth::user()->id)->first();
        //取出报名人数
        $num = Redis::get("event_num:" . $eventId);

        //取出已报名人数
        $users = Redis::scard("event:" . $eventId);

//        dd($users);
        //dd($user);
        if ($num > $users) {
            Redis::sadd("event:" . $eventId, $userId);
            return back()->with("success", "报名成功, 等待开奖.");
        } else {
            return back()->with("success", "人数已满");
        }
//        //得到当前用户ID
//        $data['user_id']=Auth::user()->id;
////        dd($data['user_id']);
//        if(isset($user->user_id)){
//            return back()->with("warning","你已报名");
//        }
//        EventUser::create($data);
//        return back()->with("success","报名成功");

    }

//中奖列表
    public function result($id)
    {
        $eventPrizes = EventPrize::where("event_id", $id)->get();
        return view("shop.event.result", compact("eventPrizes"));

    }

}

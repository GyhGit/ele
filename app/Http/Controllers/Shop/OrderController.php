<?php

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use App\Models\OrderGood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends MainController
{
    public function index()
    {
        //通过用户找到店铺id
        $shopId = Auth::user()->shop->id;
        //通过店铺找到订单id
        $orders = Order::where("shop_id", $shopId)->paginate(3);
        return view("shop.order.index", compact("orders"));

    }

    public function hair($id, $status)
    {
        $result = Order::where("id", $id)->where("shop_id", Auth::id())->update(['status' => $status]);
        if ($result) {
            return back()->with("success", "更改状态成功");
        }

    }
    //订单统计
    public function day(Request $request)
    {
        $query = Order::where("shop_id",Auth::user()->shop->id)->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as day,SUM(total) AS money,count(*) AS count"))->groupBy("day")->orderBy("day", 'desc')->limit(30);
        //dd($query);
        //接收参数
        $start = $request->input('start');
        $end = $request->input('end');
        // var_dump($start,$end);
        //如果有起始时间
        if ($start !== null) {
            $query->whereDate("created_at", ">=", $start);
        }
        if ($end !== null) {
            $query->whereDate("created_at", "<=", $end);
        }
        //得到每日统计数据
        $orders = $query->get();
        //dd($orders->toArray());
        //显示视图
        return view('shop.order.day', compact('orders'));
    }

    //菜品统计
    public function month(Request $request)
    {
        $query = Order::where("shop_id",Auth::user()->shop->id)->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as day,SUM(total) AS money,count(*) AS count"))->groupBy("day")->orderBy("day", 'desc')->limit(30);
        //dd($query);
        //接收参数
//        $start = $request->input('start');
//        $end = $request->input('end');
        // var_dump($start,$end);
        //如果有起始时间
//        if ($start !== null) {
//            $query->whereDate("created_at", ">=", $start);
//        }
//        if ($end !== null) {
//            $query->whereDate("created_at", "<=", $end);
//        }
        //得到每月统计数据
        $orders = $query->get();
        //dd($orders->toArray());
        //显示视图
        return view('shop.order.month', compact('orders'));
    }


    public function cday()
    {
        //读取商家所有订单
        $order=Order::where("shop_id",Auth::id())->whereIn("status",[1,2,3])->pluck("id");
        $data=OrderGood::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,SUM(amount) as nums,SUM(amount * goods_price) as money"))
            ->whereIn("order_id",$order)
            ->groupBy('date')
            ->get();

        return view("shop.order.cday", compact("data"));
    }
//y月
    public function cmonth()
    {
        //读取商家所有订单
        $order=Order::where("shop_id",Auth::id())->whereIn("status",[1,2,3])->pluck("id");
        $data= OrderGood::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date,SUM(amount) as nums,SUM(amount * goods_price) as money"))
            ->whereIn("order_id",$order)
            ->groupBy('date')
            ->get();

        return view("shop.order.cmonth", compact("data"));
    }
//总
    public function ctotal()
    {
        $order=Order::where("shop_id",Auth::id())->whereIn("status",[1,2,3])->pluck("id");
        $data= OrderGood::select(DB::raw("SUM(amount) as nums,SUM(amount * goods_price) as money"))
            ->whereIn("order_id",$order)
            ->get();
        return view("shop.order.ctotal", compact("data"));
    }




}

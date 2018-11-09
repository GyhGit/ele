<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Order;
use App\Models\OrderGood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    //订单量 日月总
    public function index(Request $request)
    {
        //所有参数
        $url = $request->query();
        //接受
        $start = $request->get("start_time");
        $end = $request->get("end_time");
//        查
        $query = Order::whereIn('status', [1, 2, 3])
            ->select(DB::raw("shop_id,COUNT(*) as nums,SUM(total) as money"))
//            ->groupBy('shop_id')
            ->groupBy('shop_id');
//            ->get();
        //判断
        if ($start !== null) {
            $query->where("created_at", ">=", "$start");
        }
        if ($end !== null) {
            $query->where("created_at", "<=", $end);
        }

        $data = $query->get();
//        dd($data->toArray());

        return view("admin.order.index", compact("data", "url"));

    }

    //商家整体统计
    public function dall()
    {
        $data = Order::whereIn('status', [1, 2, 3])
            ->select(DB::raw("COUNT(*) as nums,SUM(total) as money"))
            ->groupBy('shop_id')
            ->get();
//        dd($data->toArray());
        return view("admin.order.dall", compact("data"));
    }

    //菜品量 日月总
    //日
    public function lists()
    {
        $orderId = OrderGood::pluck("id");
        dd($orderId->toArray());
    }

    //整体统计s
    public function mall()
    {
        //找出全部的订单数量
        $data = OrderGood::select(DB::raw('SUM(amount) as nums,SUM(amount * goods_price) as money'))
            ->get();
//        dd($data->toArray());
        return view("admin.order.mall", compact("data"));

    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    public function add(Request $request)
    {
        //验证
        //清空当前用户购物车
        Cart::where("user_id", $request->post('user_id'))->delete();
        //接收参数
        $goods = $request->post('goodsList');//[2,3,4]
        $counts = $request->post('goodsCount');//[4,2,1]
        foreach ($goods as $k => $good) {
            $data = [
                'user_id' => $request->post('user_id'),
                'goods_id' => $good,
                'amount' => $counts[$k]
            ];
            Cart::create($data);
        }
        return [
            'status' => "true",
            'message' => "添加成功"
        ];
    }













    //显示购物车列表
    public function index(Request $request)
    {
        //获取用户id
        $userId=$request->input('user_id');

        $carts=Cart::where('user_id',$userId)->get();
        $goodsList=[];
        $totalCost=0;
        //循环取值
        foreach ($carts as $k => $v){

            $good=Menu::where('id',$v->goods_id)->first(['id as goods_id','goods_name', 'goods_img', 'goods_price']);

            $good->amount=$v->amount;
            //算总价
            $totalCost += $good->amount * $good->goods_price;
            $goodsList[] = $good;
        }

        return [
            'goods_list' => $goodsList,
            'totalCost' => $totalCost
        ];
    }

}

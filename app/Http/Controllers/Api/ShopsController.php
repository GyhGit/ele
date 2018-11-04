<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuCategory;
use App\Models\Shops;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopsController extends Controller
{
    public function index()
    {
        //得到所有上线店铺
        $shopse = Shops::where("status", 1)->get();

        //追加时间 距离
        foreach ($shopse as $k => $v) {
            $shopse[$k]->distance = rand(1000,5000);
            $shopse[$k]->estimate_time = ceil($shopse[$k]->distance / rand(100, 150));

        }
        return $shopse;
    }

    public function detail()
    {
        $id=request() ->get('id');

        $shop=Shops::find($id);

//        $shop->shop_img=
//        $shop->shop_img=env("ALIYUN_OSS_URL").$shop->shop_img;
        $shop->service_code=4.9;
        $shop->evaluate=[
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "特别好"],
            ["user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 4.5,
                "send_time" => 30,
                "evaluate_details" => "很好吃"]
        ];
        $cates=MenuCategory::where("shop_id",$id)->get();
        //查找当前分类商品
        foreach ($cates as $k=>$cate){
            $cates[$k]->goods_list=$cate->menus;
        }
        $shop->commodity=$cates;

        return $shop;
        
    }
}

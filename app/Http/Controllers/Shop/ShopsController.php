<?php

namespace App\Http\Controllers\Shop;

use App\Models\Activity;
use App\Models\ShopCategory;
use App\Models\Shops;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShopsController extends MainController
{
    //店铺申请
    public function apply(Request $request)
    {
        //判断POST提交
        if ($request->isMethod("post")) {

           // dd($request->post());
            //验证
            $this->validate($request, [
                "shop_name" => "required|unique:shops",
                "start_send"=>"required",
                "send_cost"=>"required",

            ]);
            //接收数据
            //$shop_category_id=\Illuminate\Support\Facades\Auth::guard()->user()->id();
            // dd($shop_category_id);
            $data = $request->post();
            $data['shop_img'] = $request->file("img")->store("images", "image");
            //添加
            $data['status']=0;
            $data['user_id']=Auth::user()->id;
//            dd($data['user_id']);

            Shops::create($data);
            //跳转


            return redirect()->route("shop.user.index")->with("success", "申请已提交,请等待审核");
        }
        $categories=ShopCategory::all();
        return view("shop.shops.apply",compact("categories"));
    }

    public function index()
    {
      $activitys=Activity::all();

      return view("shop.activity.index",compact("activitys"));
    }

    public function check($id)
    {
        $activity=Activity::find($id);

        return view("shop.activity.check",compact("activity"));



    }

}

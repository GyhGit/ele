<?php

namespace App\Http\Controllers\Shop;

use App\Models\Admin;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\ShopCategory;
use App\Models\Shops;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuCategoryController extends BaseController
{
    public function index()
    {
        $menus = MenuCategory::where("shop_id", Auth::user()->shop->id)->get();
        //Auth::shop();
        return view("shop.menu.index", compact("menus"));
    }

    public function add(Request $request)
    {
        //判断接收方式
        if ($request->isMethod("post")) {
            $data = $this->validate($request, [
                'name' => 'required',
                "type_accumulation" => "required",
                "description" => "required",
                "is_selected" => "required",
            ]);
            $id = Auth::user()->id;
            //dd($id);
            $data['shop_id'] = $id;
            //添加
            MenuCategory::create($data);
            //跳转
            return redirect()->route("shop.menu.index")->with("success", "分类添加成功");
        }
        //显示视图
        return view("shop.menu.add");
    }

    public function edit(Request $request, $id)
    {
        //找到id
        $menu = MenuCategory::find($id);
        //判断提交方式
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'name' => 'required',
                "type_accumulation" => "required",
                "description" => "required",
                "is_selected" => "required",
            ]);
            //接收数据
            $data = $request->post();
            //添加
            // $data['password'] = bcrypt($data['password']);
            //MenuCategory::create($data);


            if ($menu->update($data)) {
                return redirect()->route("shop.menu.index")->with("success","修改成功");
            }
        }
        //跳转
        return view("shop.menu.edit", compact("menu"));

    }

    //删除
    public function del($id){
        //得到当前分类
        $cate=MenuCategory::find($id);

        //得到当前分类对应的店铺数
        $shopCount=Menu::where('category_id',$cate->id)->count();
        //判断当前分类店铺数
        if ($shopCount){
            //回跳
            return  back()->with("danger","当前分类下有店铺，不能删除");
        }
        //否则删除

        $cate->delete();
        //跳转
        return redirect()->route('shop.menu.index')->with('success',"删除成功");
    }

}


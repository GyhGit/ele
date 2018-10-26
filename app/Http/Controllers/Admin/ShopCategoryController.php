<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Shop\BaseController;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCategoryController extends BaseController
{
    //分类显示
    public function index()
    {
        $shop_categorys=ShopCategory::all();
        return view("admin/shop_category/index",compact("shop_categorys"));
    }
    //分类添加
    public function add(Request $request)
    {
        //验证
        if ($request->isMethod("post")){


            $this->validate($request, [
                "name" => "required|unique:shop_categories",
                "img" => "required",
            ]);

            $data=$request->post();
            $data['img'] = $request->file("img")->store("images", "image");
            ShopCategory::create($data);
            return redirect()->route("admin/shop_category/index")->with("success","添加成功");
        }
        return view("admin/shop_category/add");
    }
    //分类编辑
    public function edit(Request $request,$id)
    {
        //找到id
        $shop_category = ShopCategory::find($id);
        //判断提交方式
        if ($request->isMethod("post")) {
            //数据验证
            $this->validate($request, [
                "name" => "required",
            ]);
            //接收数
            $data = $request->post();
            //判断是否上传了图片
            if ($request->file("img") !== null) {
                $data['img'] = $request->file("img")->store("images", "image");
            } else {
                $data['img'] = $shop_category->img;
            }
            if ($shop_category->update($data)) {
                return redirect("admin/shop_category/index");
            }
        } else {

            return view("admin.shop_category.edit", compact("shop_category"));
        }

    }
    //删除分类
    public function del($id)
    {
        $shop_category = ShopCategory::find($id);
        $img = $shop_category['img'];
        unlink($img);
        if ($shop_category->delete()) {
            return redirect("/admin/shop_category/index");
        }
    }
}

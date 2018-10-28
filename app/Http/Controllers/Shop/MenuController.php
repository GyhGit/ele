<?php

namespace App\Http\Controllers\Shop;

use App\Models\Admin;
use App\Models\Menu;
use App\Models\MenuCategory;
use Composer\Util\AuthHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuController extends BaseController
{
    //菜品显示
    //显示所有菜品
    public function index(Request $request){
        $url=$request->query();
        //搜索
        //接收
        $cateId=$request->get("shop_id");
//        dd($cateId);
        $keyword=$request->get("keyword");
        $minPrice=$request->get("minPrice");
        $maxPrice=$request->get("maxPrice");
        //得到所有并要有分页
        $query=Menu::orderBy("id");
        if ($keyword!==null){
            $query->where("goods_name","like","%{$keyword}%");
        }
        if ($cateId!==null){
            $query->where("category_id",$cateId);
        }
        if ($minPrice!==null){
            $query->where("goods_price",">=",$minPrice);
        }
        if ($maxPrice!==null){
            $query->where("goods_price","<=",$maxPrice);
        }
        //得到所有数据
        $menus=$query->paginate(2);
        //引入视图分配数据
        $cate=MenuCategory::all();
        return view("shop.dishis.index",compact("cate","menus","url"));

    }

    //添加菜品

    //添加
    public function add(Request $request){
        //判断接收方式

        if($request->isMethod("post")){
            $this->validate( $request, [
                'goods_name'=> 'required |unique:menus',
                "category_id" => "required",
                "description" => "required",
                "goods_price" => "required",
                "img" => "required",
                "status" => "required",
            ] );
            $data=$request->post();
            $data['shop_id']=Auth::user()->shop->id;
            $data['goods_img']=$request->file("img")->store("menu","image");
            //添加
            //dd($data);
            Menu::create($data);
            //跳转
            return redirect()->route("shop.dishis.index")->with("success","添加成功");
        }
        //显示视图
        //查询所有分类
        $menus = MenuCategory::all();
        return view("shop.dishis.add",compact("menus"));

    }

    //编辑
    public function edit(Request $request,$id){
        $menu=Menu::find($id);
        //判断接收方式
        if($request->isMethod("post")){
            $this->validate( $request, [
                'goods_name'=> 'required ',
                "category_id" => "required",
                "goods_price" => "required",
                "status" => "required",

            ] );
            $data=$request->post();
            $file=$request->file("img");
            //判断图片
            if($file){
                //有图片删除原来的图片
                @unlink($menu->goods_img);
//                $data['goods_img']=$request->file("img")->store("menu","image");

                $data['goods_img']=$file->store("menu","image");
            }

            $menu->update($data);
            //修改成功跳转
            return redirect()->route("shop.dishis.index")->with("success","修改成功");
        }
        //回显

        $menus=MenuCategory::all();
        //显示视图
        return view("shop.dishis.edit",compact("menu","menus"));
    }
























}

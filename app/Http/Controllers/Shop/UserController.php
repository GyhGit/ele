<?php

namespace App\Http\Controllers\Shop;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    //饿了吗首页
    public function index()
    {

        return view("shop.user.index");
    }

    //用户注册
    public function reg(Request $request)
    {
        //判断POST提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                "name" => "required|unique:users",
                "email" => "required",
                "password" => "required|min:6|confirmed",
            ]);
            //接收数据
            $data = $request->post();
            //添加
            $data['password'] = bcrypt($data['password']);
            User::create($data);
            //跳转
            return redirect()->route("shop.user.login")->with("success", "注册成功");
        }
        return view("shop.user.reg");
    }

    //用户登录
    public function login(Request $request)
    {
        //判断提交方式
        if ($request->isMethod("post")) {
            //验证
            $data = $this->validate($request, [
                "name" => "required",
                "password" => "required"
            ]);

            //验证账号密码
            if (Auth::attempt($data)) {
                //当前登录id
                $user = Auth::user();

                $shop = $user->shop;

                //通过用户找店铺
                if ($shop) {

                    //如果有店铺 状态 -1 0 1
                    switch ($shop->status) {
                        case -1:
                            //禁用
                            Auth::logout();
                            return back()->withInput()->with("danger", "店铺已禁用");
                            break;
                        case 0:
                            //未审核
                            Auth::logout();
                            return back()->withInput()->with("danger", "店铺还未通过审核");
                            break;
                    }
                }else{
                    //shop为空
                    return redirect()->route("shop.shops.apply")->with("danger", "还未申请店铺");
                }

                //登录成功
                return redirect()->intended(route("shop.user.index"))->with("success", "登录成功");

            }





        }

        //显示示图
        return view("shop.user.login");
    }


    //商户退出
    public function logout()
    {

        //注销
        Auth::logout();

        return redirect()->route("shop.user.index");

    }

    //商户修改个人密码
    public function edit(Request $request)
    {
        //
        $id = Auth::guard()->id();
        $user = User::find($id);
        if ($request->isMethod("post")) {

            $this->validate($request, [
                "password" => "required|confirmed",
                "old_password" => "required",
            ]);


            $oldPassword = $request->post('old_password');
            //判断老密码是否正确
            //dd(Hash::check($oldPassword, $admin['password']));返回true或者false
            if (Hash::check($oldPassword, $user['password'])) {
                //如果老密码正确 设置新密码
                $admin['password'] = Hash::make($request->post('password'));
                // 保存修改
                $user->save();
                //跳转
                return redirect()->route('shop.user.login')->with("success", "密码修改成功");
            }
            //4.老密码不正确
            return back()->with("danger", "旧密码不正确");

        }
        //显示视图
        return view("shop.user.edit", compact("user"));
    }


}

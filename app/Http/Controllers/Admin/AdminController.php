<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Shop\BaseController;
use App\Models\Admin;
use App\Models\Shops;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseController
{
    //显示首页
    public function index()
    {

        return view("admin.admin.index");
    }

    //
    public function dispose()
    {
        $shopse = Shops::all();
        return view("admin.admin.dispose", compact("shopse"));
    }


    //处理
    public function audit($id)
    {
        //判断状态
        //dd($data);
        DB::update('update shops set status = 1 where id =:id', [$id]);
        //跳转
        return redirect()->route("admin.admin.dispose");

    }

    //禁用处理
    public function forbidden($id)
    {
        //判断状态
        //dd($data);
        DB::update('update shops set status = -1 where id =:id', [$id]);
        //跳转
        return redirect()->route("admin.admin.dispose");

    }

    //禁用处理
    public function check($id)
    {
        //判断状态
        //dd($data);
        DB::update('update shops set status = 0 where id =:id', [$id]);
        //跳转
        return redirect()->route("admin.admin.dispose");

    }

    //删除
    public function del($id)
    {

    }

    //后台管理登录
    public function login(Request $request)
    {
        //判断提交方式
        if ($request->isMethod("post")) {
            //验证
            $data = $this->validate($request, [
                "name" => "required",
                "password" => "required"
            ]);
            //验证账号密码是否正确
            if (Auth::guard("admin")->attempt($data, $request->has("remember"))) {

                //登录成功
                return redirect()->intended(route("admin.admin.index"))->with("success", "登录成功");

            } else {
                return redirect()->back()->withInput()->with("danger", "账号或密码错误");
            }

        }
        //显示示图
        return view("admin.admin.login");
    }

    //管理员退出
    public function logout()
    {

        //注销
        Auth::guard("admin")->logout();

        return redirect()->route("admin.admin.login");

    }

    //管理员修改密码
    public function alter(Request $request)
    {
        //找到id
        $admin = Auth::guard("admin")->user();
        //判断提交方式

        if ($request->isMethod("post")) {
            if ($admin->update($request->post())) {
                return redirect("admin/admin/index")->with("success", "添加成功");
            }

        }
        return view("admin.admin.alter", compact("admin"));
    }

    //商铺列表
    public function user()
    {
        $users = User::all();
        return view("admin.admin.user", compact("users"));
    }

    //给商铺重置密码
    public function default($id)
    {
        $user = User::find($id);
        $password = Hash::make(789520);
        //dd($password);
        $user['password'] = $password;
        $user->save();
        return redirect()->route("admin.admin.user")->with("success", "789520");
    }

    //删除商铺
    public function delete($id)
    {
        //事务
        DB::transaction(function () use ($id) {

            User::find($id)->delete();
            Shops::where("user_id", $id)->delete();

        });
        return redirect()->route("admin.admin.user")->with("success", "删除成功");

    }

    //管理员列表显示

    public function main()
    {
        $admins = Admin::all();
        return view("admin.admin.main", compact("admins"));

    }

    //管理员列表添加
    public function addition(Request $request)
    {
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "name" => "required|unique:users",
                "email" => "required",
                "password" => "required",
            ]);
            $data = $request->post();
            $data['password'] = bcrypt($data['password']);

            Admin::create($data);
            return redirect()->route("admin.admin.main")->with("success", "添加成功");
        }
        return view("admin.admin.addition");
    }

    //管理员列表编辑
    public function redact(Request $request, $id)
    {
        $admin = Admin::find($id);
        //判断post
        if ($request->isMethod("post")) {
            //添加
            $data = $request->post();
            if ($admin->update($data)) {
                //跳转
                return redirect()->route("admin.admin.main")->with("success", "修改成功");
            }
        }
        //显示视图
        return view("admin.admin.redact", compact('admin'));
    }

    //管理员列表删除
    public function rm($id)
    {
        //如果没有找到，会友好提示
        $admin = Admin::findOrFail($id);
        if ($admin->delete()) {
            return redirect()->route("admin.admin.main")->with("success", "删除成功");
        }
    }















}
